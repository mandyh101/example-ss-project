<?php

namespace SilverStripe\Example;

use PHPUnit\Runner\Version;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Versioned\Versioned;

class Region extends DataObject
{
    /**
     * Config
     * Applies the version data extension to support versioning of records
     */
    private static $extensions = [
        Versioned::class,
    ];
    /**
     * Config
     * This is used to enable versioning on the grid field so we can use features like archive
     */
    private static $versioned_gridfield_extensions = true;

    /**
     * config
     */
    private static $class_description = 'A region';

    /**
     * config
     */
    private static $table_name = 'Region';

    /**
     * db properties
     */
    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
    ];

    /**
     * relations
     */
    private static $has_one = [
        'Photo' => Image::class,
        'RegionPage' => RegionPage::class,
    ];

    /**
     * ownership binding
     */
    private static $owns = [
        'Photo',
    ];

    /**
     * By default only db fields are shown in the grid field.
     * With summary fields we can add other fields to the grid field (the grid field is on the parent class)
     */
    private static $summary_fields = [
        'GridThumbnail' => '',
        'Photo.Filename' => 'Filename of photo',
        'Title' => 'Title of region',
        'Description' => 'Short description'
    ];

    /**
     * Get a thumbnail of the region's photo for display in the grid
     * NOTE: an alternative to using the getCMSFields() method would be to use the SS syntax: Photo.CMSThumbnail (minus the option of having a no image string returned if no photo exists)
     * @return string
     */
    public function getGridThumbnail()
    {
        if ($this->Photo()->exists()) {
            return $this->Photo()->ScaleWidth(100);
        }

        return "(no image)";
    }

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
