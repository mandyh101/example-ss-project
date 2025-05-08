<?php

namespace SilverStripe\Example;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class Region extends DataObject
{
    private static $class_description = 'A region';

    private static $table_name = 'Region';

    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'RegionPage' => RegionPage::class,
    ];

    public function getCMSFields()
    {
        // create a simple field list for editing page objects - different to how we get CMS fields for pages
        $fields = FieldList::create(
            TextField::create('Title', 'Region Title'),
            TextareaField::create('Description', 'Region Description')
                ->setDescription('A description of the region.'),
            $uploader = UploadField::create('Photo', 'Region Photo')
        );

        $uploader
            ->setFolderName('region-photos')
            ->getValidator()->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif']);

        return $fields;
    }
}
