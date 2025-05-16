<?php

namespace SilverStripe\Example;

use SilverStripe\ORM\DataObject;

class ArticleComment extends DataObject
{
    private static $table_name = 'ArticleComment';

    private static $db = [
        'Name' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'CommentText' => 'Text',
    ];

    private static $has_one = [
        'ArticlePage' => ArticlePage::class,
    ];
}
