<?php

namespace SilverStripe\Example;

use PageController;
use SilverStripe\Control\HTTPRequest;

class RegionPageController extends PageController
{
    private static $allowed_actions = [
        'show'
    ];
    public function show(HTTPRequest $request)
    {
        // get the region ID from the request
        $region = Region::get()->byID($request->param('ID'));

        if (!$region) {
            // if the region does not exist, return a 404 response
            return $this->httpError(404, 'Region not found');
        }

        return [
            'Region' => $region
        ];
    }
}
