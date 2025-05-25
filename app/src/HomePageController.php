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

    /**
     * Retrieves a list of featured properties for the homepage.
     *
     * @return \SilverStripe\ORM\DataList A list of properties that are marked as featured on the homepage, limited to 6 entries.
     */
    public function FeaturedProperties()
    {
        return Property::get()
            ->filter(array(
                'FeaturedOnHomepage' => true
            ))
            ->limit(3);
    }
}
