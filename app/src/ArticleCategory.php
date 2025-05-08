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

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Title')
        );
    }
}
