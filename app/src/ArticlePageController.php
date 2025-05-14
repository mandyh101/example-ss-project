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
                TextareaField::create('Comment', 'Your comment*')
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
                'Comment'
            ),
        );

        $form->addExtraClass('form-style');

        return $form;
    }
}
