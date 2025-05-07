<?php

namespace SilverStripe\Example;

use Page;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextareaField;

use function PHPSTORM_META\type;

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

    /**
     * Returns a field list object of the tabs and fields to make available in the CMS to edit this page type.
     *
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', DateField::create('Date', 'Date of article'), 'Content');
        $fields->addFieldToTab(
            'Root.Main',
            TextareaField::create('Teaser', 'Summary of article')
                ->setDescription('This is a short summary of the article. It will be displayed on the article list page.'),
            'Content'
        );
        $fields->addFieldToTab('Root.Main', TextareaField::create('Author', 'Author of article'), 'Content');


        return $fields;
    }
}
