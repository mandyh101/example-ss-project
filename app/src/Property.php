<?php

namespace SilverStripe\Example;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CurrencyField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\ArrayLib;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TabSet;

class Property extends DataObject
{
    private static $table_name = "Property";

    private static $db = [
        'Title' => 'Varchar',
        'PricePerNight' => 'Currency',
        'Bedrooms' => 'Int',
        'Bathrooms' => 'Int',
        'FeaturedOnHomepage' => 'Boolean'
    ];

    private static $has_one = [
        'Region' => Region::class,
        'PrimaryPhoto' => Image::class,
    ];

    public function getCMSfields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            CurrencyField::create('PricePerNight', 'Price (per night)'),
            DropdownField::create('Bedrooms')
                ->setSource(ArrayLib::valuekey(range(1, 10))), //takes and array where the keys are the data that will be saved when the option is selected
            DropdownField::create('Bathrooms')
                ->setSource(ArrayLib::valuekey(range(1, 10))),
            // explicitly append the ID vecuase dropdown field doesn't always save to a has_one an this ensures we can resolve the name of a relationship to a db column.
            DropdownField::create('RegionID', 'Region')
                ->setSource(Region::get()->map('ID', 'Title')) //set souurce tells the dropdown what options to use
                ->setEmptyString('Select a region'), //use if you don't want a preselected value
            CheckboxField::create('FeaturedOnHomepage', 'Feature on homepage')
        ]);
        $fields->addFieldToTab('Root.Photos', $upload = UploadField::create(
            'PrimaryPhoto',
            'Primary photo'
        ));

        $upload->getValidator()->setAllowedExtensions(array(
            'png',
            'jpeg',
            'jpg',
            'gif'
        ));
        $upload->setFolderName('property-photos');

        return $fields;
    }
}
