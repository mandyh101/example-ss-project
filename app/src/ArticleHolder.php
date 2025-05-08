<?php

namespace SilverStripe\Example;

use Page;

use SilverStripe\Example\ArticlePage;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class ArticleHolder extends Page
{
    /**
     * a list of the page types that are allowed to be created under this page type. Note that a scalar value is also accepted here if you have only one page type.
     * private statics are functionally the same as updates to the config YAML files, sometimes allowed_children will be set in the config file like so which has the same effect as th eprivate static variable.
     *
     * SilverStripe\Lessons\ArticleHolder:
     *  allowed_children:
     *      - SilverStripe\Lessons\ArticlePage
     */
    private static $allowed_children = [
        ArticlePage::class
    ];

    private static $table_name = 'ArticleHolder';

    /**
     * An artcle holder can have many categories
     */
    private static $has_many = [
        'Categories' => ArticleCategory::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Categories', GridField::create(
            'Categories',
            'Article Categories',
            $this->Categories(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}
