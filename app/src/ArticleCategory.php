<?php

namespace SilverStripe\Example;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

class ArticleCategory extends DataObject
{
    private static $table_name = 'ArticleCategory';

    private static $db = [
        'Title' => 'Varchar',
    ];
    /**
     * An article category belongs to an article holder
     */
    private static $has_one = [
        'ArticleHolder' => ArticleHolder::class,
    ];

    /**
     * Optional but reommended reciprocal relationship to a many many relationship. Allows us to implement features that can get ALL related parent objects for the category e.g. all the articles that have this category.
     */
    private static $belongs_many_many = [
        'Articles' => ArticlePage::class,
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Title')
        );
    }
}
