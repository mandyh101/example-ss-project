<?php

namespace SilverStripe\Example;

use SilverStripe\Forms\CheckboxSetField;
use Page;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextField;
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

    private static $has_many = [
        'Comments' => ArticleComment::class
    ];

    /**
     * An article page can have many categories
     * In many many relationships, the way to define the 'parent' or the class that gets the many_many vs the belongs_many_many is to typically choose the class that contains the interface e.g. here we will add categories to articles using checkboxes on the article page.
     */
    private static $many_many = [
        'Categories' => ArticleCategory::class,
    ];

    /**
     * A list of relationships that this page type owns. We declare images and files here so that they auto publish when we publish the article.
     * @var array
     */
    private static $owns = [
        'Photo',
        'Brochure',
    ];

    /**
     * A simple helper method to get a comma separated list of category titles an article belongs to
     * @return string|null
     */
    public function getCategoriesList()
    {
        if ($this->Categories()->exists()) {
            // invoking column on the realtion will return an array of only the values in the column specified
            return implode(', ', $this->Categories()->column('Title'));
        }

        return null;
    }

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
        $fields->addFieldToTab('Root.Main', TextField::create('Author', 'Author of article'), 'Content');

        // CMS fields on the Attachments tab
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

        // CMS fields on the Categories tab
        $fields->addFieldToTab(('Root.Categories'), CheckboxSetField::create(
            'Categories',
            'Selected article categories',
            $this->Parent->Categories()->map('ID', 'Title') //our list of categories to select from is defiend on the article holder that this article page belongs to. Use map to create an array that maps each category ID to its title so the checkbox field knows to save the ID in the relation but present the title field as the label.
        ));

        return $fields;
    }
}
