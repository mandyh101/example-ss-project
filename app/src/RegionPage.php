<?php

namespace SilverStripe\Example;

use Page;

class RegionPage extends Page
{
    /**
     * Regions relationship: a region page can have many regions.
     */
    private static $has_many = [
        'Regions' => Region::class,
    ];
}
