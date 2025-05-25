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
}
