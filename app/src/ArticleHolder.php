<?php

namespace SilverStripe\Example;

use SilverStripe\Example\ArticlePage;

use Page;

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
}
