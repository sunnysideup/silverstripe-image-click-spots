<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\AssetAdmin\Forms\UploadField;


namespace Sunnysideup\ImageClickSpots\Extension;


class ImageClickSpotsExtension extends DataExtension
{
    private static $has_one = [
        'DataPointImage' => Image::class,
    ];

    private static $has_many = [
        'DataPoints' => DataPoints::class.'.Parent',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab(
            'Root.ImageWithDataPoints',
            [
                UploadField::create(
                    'DataPointImage',
                    'Image'
                )
                    ->setFolderName('data-point-images'),
                GridField::create(
                    'DataPoints',
                    'Data Points',
                    $this->DataPoints(),
                    GridFieldConfig_RelationEditor::create()
                )->setDescription('Please add as many datapoints as needed.'),
            ]
        );
        return $fields;
    }
}
