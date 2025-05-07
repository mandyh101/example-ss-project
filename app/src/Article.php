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
}
