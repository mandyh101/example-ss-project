<?php

namespace SilverStripe\Example;

use Page;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class RegionPage extends Page
{
    /**
     * Regions relationship: a region page can have many regions.
     */
    private static $has_many = [
        'Regions' => Region::class,
    ];

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        $fields->addFieldToTab(('Root.Regions'), GridField::create(
            'Regions', // the name of the gridfield - needed if you ever want to make updates to your GridField after it's been added to the FieldList
            'Regions on this page', //the user friendly title for the gridfield
            $this->Regions(), // get the data to dispaly via the relationship on this class
            GridFieldConfig_RecordEditor::create() //It creates a object that contains a number of GridFieldComponent objects, which provide various UI tools to the grid which you can add or remove inside the create parenthesis. By default the Record_Editor grid field provides good basic UI for managing data objects.
        ));
    }
}
