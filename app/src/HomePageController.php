<?php

namespace SilverStripe\Example;

use PageController;

class HomePageController extends PageController
{
    public function LatestArticles()
    {
        return ArticlePage::get()
            ->sort('Created', 'DESC')
            ->limit(3);
    }
}
