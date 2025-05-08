<?php

namespace SilverStripe\Example;

use Page;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class ArticlePage extends Page
{
    /**
     * use on page classes that you don't want to be created at the root level
     * @var bool
     */
    private static $can_be_root = false;
    /**
     * A description of the class. This is used in the CMS to describe the class.
     */
    private static $class_description = 'A page for a single article.';
    /**
     * Recommended to define a table name for all name spaced classes
     */
    private static $table_name = 'Article';

    private static $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'Author' => 'Varchar',
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'Brochure' => File::class
    ];

    /**
     * Returns a field list object of the tabs and fields to make available in the CMS to edit this page type.
     *
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', DateField::create('Date', 'Date of article'), 'Content');
        $fields->addFieldToTab('Root.Main', TextareaField::create('Teaser', 'Summary of article')
            ->setDescription('Optional text that will be used to display a summary of the article in the list view. If not provided, a summary will be taken from the article content.'), 'Content');
        $fields->addFieldToTab('Root.Main', TextareaField::create('Author', 'Author of article'), 'Content');
        // Add file upload fields in a new tab called attachments
        $fields->addFieldToTab('Root.Attachments', $photo = UploadField::create('Photo'));
        // assign the field to a variable here so we can make further updates to it once instantiated
        $fields->addFieldToTab('Root.Attachments', $brochure = UploadField::create('Brochure')
            ->setDescription('Optional. Upload a travel brochure (PDF format only).'));

        $photo
            ->setFolderName('travel-photos')
            ->getValidator()->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif']);

        //add folder destination and allowed file types to brochure
        $brochure
            ->setFolderName('travel-brochures')
            ->getValidator()->setAllowedExtensions(['pdf']);


        return $fields;
    }
}
