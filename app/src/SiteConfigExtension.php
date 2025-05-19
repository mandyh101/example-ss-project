<?php

namespace SilverStripe\Example;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

class SiteConfigExtension extends DataExtension
{

    private static $db = [
        'FacebookLink' => 'Varchar',
        'TwitterLink' => 'Varchar',
        'GoogleLink' => 'Varchar',
        'YouTubeLink' => 'Varchar',
        'FooterContent' => 'Text'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Social', array(
            TextField::create('FacebookLink', 'Facebook')
                ->setDescription('Please include https:// at the beginning, e.g. https://www.facebook.com'),
            TextField::create('TwitterLink', 'Twitter')
                ->setDescription('Please include https:// at the beginning, e.g. https://www.twitter.com'),
            TextField::create('GoogleLink', 'Google')
                ->setDescription('Please include https:// at the beginning, e.g. https://www.google.com'),
            TextField::create('YouTubeLink', 'YouTube')
                ->setDescription('Please include https:// at the beginning, e.g. https://www.youtube.com'),
        ));
        $fields->addFieldsToTab('Root.Main', TextareaField::create('FooterContent', 'Content for footer'));
    }
}
