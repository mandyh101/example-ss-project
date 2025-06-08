<?php

namespace SilverStripe\Example;

use PageController;

class RegionPageController extends PageController
{
    private static $allowed_actions = [
        'test'
    ];
    public function test()
    {
        die('it works');
    }
}
