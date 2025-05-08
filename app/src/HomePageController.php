<?php

namespace SilverStripe\Example;

use PageController;

class HomePageController extends PageController
{
    /**
     * Gets the latest articles, defaults to a limit of three but the count can be changed.
     *
     * @param int $count The number of articles to return. Defaults to 3.
     * @return \SilverStripe\ORM\DataList
     */
    public function LatestArticles(int $count = 3)
    {
        return ArticlePage::get()
            ->sort('Created', 'DESC')
            ->limit($count);
    }
}
