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
use SilverStripe\Versioned\Versioned;


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

    private static $searchable_fields = [
        'Title',
        'Region.Title',
        'FeaturedOnHomepage'
    ];

    private static $owns = [
        'PrimaryPhoto',
    ];

    private static $extensions = [
        Versioned::class,
    ];

    private static $versioned_gridfield_extensions = true;

    /**
     * Defines the fields that will be used for searching a property in the property model admin. Returns customised search fields instead of returning the default ones if we just use the private static $searchable_fields array.
     *
     * @return array
     *  - filter=> The type of filter that should be used in the search. For a full list of available filters, see framework/src/ORM/Filters. For title, we want a fuzzy match, so we use PartialMatchFilter, and since regions are filtered by ID, we want that to be an ExactMatchFilter
     * - title => The title of the field that will be displayed in the search form
     * - field => The type of field that will be used in the search form. This is optional, and if not provided, the default field type will be used based on the filter value type.
     */
    public function searchableFields()
    {
        return [
            'Title' => [
                'filter' => 'PartialMatchFilter',
                'title' => 'Title',
                'field' => TextField::class
            ],
            'Region.Title' => [
                'filter' => 'PartialMatchFilter',
                'title' => 'Region',
                'field' => DropdownField::create('RegionID')
                    ->setSource(Region::get()->map('ID', 'Title'))
                    ->setEmptyString('-- Select a region --')
            ],
            'FeaturedOnHomepage' => [
                'filter' => 'ExactMatchFilter',
                'title' => 'Featured on homepage'
                // if you don't add the field element here, the firled type will default to the appropriate
                // field type for the filter, in this case a yes/no/any for the boolean value
            ]
        ];
    }

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
