<?php

namespace SilverStripe\Example;

use Page;

class ArticlePage extends Page
{
    /**
     * use on page classes that you don't want to be created at the root level
     * @var bool
     */
    private static $can_be_root = false;
    /**
     * A description of the class. This is used in the CMS to describe the class.
     */
    private static $class_description = 'A page for a single article.';
    /**
     * Recommended to define a table name for all name spaced classes
     */
    private static $table_name = 'Article';

    private static $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'Author' => 'Varchar',
    ];
}
