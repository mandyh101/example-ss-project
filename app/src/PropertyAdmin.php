<?php

namespace SilverStripe\Example;

use SilverStripe\Admin\ModelAdmin;

class PropertyAdmin extends ModelAdmin
{
    private static $menu_icon_class = 'font-icon-home'; // set a specific icon for the cms list

    private static $menu_title = 'Properties'; // this is the title that will be displayed in the CMS menu

    private static $url_segment = 'properties'; // this is the URL segment that will be used to access the model admin

    /**
     * An array of class names that can be managed by this model admin.
     */
    private static $managed_models = [
        Property::class,
    ];

    /**
     * Summary fields give control over what fields are displayed in the list view of the model admin.
     * - data => name of the field in the model admin
     */
    private static $summary_fields = [
        'Title' => 'Title',
        'Region.Title' => 'Region', //use dot syntax to access properties...
        'PricePerNight.Nice' => 'Price', // ...or built in SS methods that are available e.g. to get nicely formatted currency
        'FeaturedOnHomepage.Nice' => 'Featured?' // returns yes or no instead of 1 or 0 / true or false
    ];
}
