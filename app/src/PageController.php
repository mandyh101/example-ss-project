<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;

/**
 * @template T of Page
 * @extends ContentController<T>
 */
class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    protected function init()
    {
        parent::init();
        // You can include any CSS or JS required by your project here.
        // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
        Requirements::css('css/bootstrap.min.css');
        Requirements::css('css/style.css');
        Requirements::css('css/style.less');
        Requirements::javascript('javascript/common/modernizr.js');
        Requirements::javascript('javascript/common/jquery-1.11.1.min.js');
        Requirements::javascript('javascript/common/bootstrap.min.js');
        Requirements::javascript('javascript/common/bootstrap-datepicker.js');
        Requirements::javascript('javascript/common/chosen.min.js');
        Requirements::javascript('javascript/common/bootstrap-checkbox.js');
        Requirements::javascript('javascript/common/nice-scroll.js');
        Requirements::javascript('javascript/common/jquery-browser.js');
        Requirements::javascript('javascript/scripts.js');
    }
}
