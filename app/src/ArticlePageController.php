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

        return $form;
    }

    public function handleComment($data, $form)
    {
        //initialise the article comment object as the first operation
        // - we know we can do this atthis point becasue the form has already passed validation
        // - ofetn you may want some logic that determines comment creation based on values provided, but keeping it simple for now
        $comment = ArticleComment::create();
        // $comment->Name = $data['Name'];
        // $comment->Email = $data['Email'];
        // $comment->CommentText = $data['CommentText'];
        //this line binds the comment back to the Article Page using the has_many relation convention
        //- 4this->ID refers to the current page ID has has_one fields are always suffixed with ID
        $comment->ArticlePageID = $this->ID;
        // use saveInto instead of explicitly saving each parameter (as commented out above)
        // - this is a convenience method to use when the form params are named exactly the same as the ArticleComment db fields
        $form->saveInto($comment);
        //write is needed to save the comment to the database
        $comment->write();

        $form->sessionMessage('Comment submitted successfully!', 'good');

        return $this->redirectBack();
    }
}
