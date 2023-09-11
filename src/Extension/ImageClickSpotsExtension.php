<?php

namespace Sunnysideup\ImageClickSpots\Extension;

use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use Sunnysideup\ImageClickSpots\Model\DataPoint;

class ImageClickSpotsExtension extends DataExtension
{
    private static $has_one = [
        'DataPointImage' => Image::class,
    ];

    private static $has_many = [
        'DataPoints' => DataPoint::class.'.Parent',
    ];

    public function updateCMSFields(FieldList $fields)
    {
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
                    $this->owner->DataPoints(),
                    GridFieldConfig_RelationEditor::create()
                )->setDescription('Please add as many datapoints as needed.'),
            ]
        );
    }
}
