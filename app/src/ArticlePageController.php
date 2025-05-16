<?php

namespace SilverStripe\Example;

use PageController;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;

class ArticlePageController extends PageController
{
    /**
     * Defines methods that can be called directly on this controller
     * @var array
     */
    private static $allowed_actions = [
        'CommentForm' => true
    ];
    /**
     * CommentForm is a form that is embedded in the ArticlePage.
     * It requires a name, email and comment and sends an email to the site admin when submitted.
     * @return Form
     */
    public function CommentForm()
    {
        $form = Form::create(
            $this,
            'CommentForm', //references the controller method, can also use PHP syntax _FUNCTION_
            FieldList::create(
                TextField::create('Name', 'Your name*')
                    ->setAttribute('placeholder', 'Enter your name'),
                EmailField::create('Email', 'Your email*')
                    ->setAttribute('placeholder', 'email@example.com'),
                TextareaField::create('CommentText', 'Your comment*')
                    ->setAttribute('placeholder', 'Write your comment here')
            ),
            FieldList::create(
                FormAction::create('handleComment', 'Post Comment')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-default-color btn-lg')
            ),
            RequiredFields::create(
                'Name',
                'Email',
                'CommentText'
            ),
        );


        $form->addExtraClass('form-style');

        // check if we have existing form data in the session
        $data = $this->getRequest()->getSession()->get("FormData.{$form->getName()}.data");
        // add return the form pre-populated or empty if no existing data still in session
        return $data ? $form->loadDataFrom($data) : $form;
    }

    public function handleComment($data, $form)
    {
        //* use the form name to store the data in the session
        // - this is useful if you want to repopulate the form with the data after a failed submission so the user doesn't have to re-enter everything
        $session = $this->getRequest()->getSession();
        $session->set("FormData.{$form->getName()}.data", $data);

        //* add some custom vlaidation
        if ($this->handleCommentFormValidation($data, $form) === false) {
            return $this->redirectBack();
        };
        //*initialise the article comment object as the first operation
        // - we know we can do this atthis point becasue the form has already passed validation
        // - ofetn you may want some logic that determines comment creation based on values provided, but keeping it simple for now
        $comment = ArticleComment::create();
        // $comment->Name = $data['Name'];
        // $comment->Email = $data['Email'];
        // $comment->CommentText = $data['CommentText'];
        //*the below line binds the comment back to the Article Page using the has_many relation convention
        //- $this->ID refers to the current page ID has has_one fields are always suffixed with ID
        $comment->ArticlePageID = $this->ID;
        //* use saveInto instead of explicitly saving each parameter (as commented out above)
        // - this is a convenience method to use when the form params are named exactly the same as the ArticleComment db fields
        $form->saveInto($comment);
        //* write is needed to save the comment to the database
        $comment->write();

        // comment is successfully submitted, so we can clear the session data and form
        $session->clear("FormData.{$form->getName()}.data");

        $form->sessionMessage('Comment submitted successfully!', 'good');

        return $this->redirectBack();
    }

    /**
     * Validates the comment form submission.
     *
     * Checks if a submitted comment already exists in the system and if it is longer than 20 characters to prevent duplicate comments.
     * A session message is set if the comment already exists.
     *
     * @param array $data The form data submitted by the user.
     * @param Form $form The form object used for the submission.
     * @return bool Returns true if the comment is valid, false otherwise.
     */

    public function handleCommentFormValidation($data, $form)
    {
        $existingComment = $this->Comments()->filter([
            'CommentText' => $data['CommentText'],
        ]);
        // check if commetn exists and is longer than 20 characters to rue out generic messages - seems like a silly check really but go along with it as an example of how to handle form validation
        if ($existingComment->exists() && strlen($data['CommentText']) > 20) {
            $form->sessionMessage('You have already submitted this comment.', 'bad'); //TODO this works but the bad is supposed to determine styling but it doesn't seem to work...
            return false;
        };

        return true;
    }
}
