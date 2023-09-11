<?php

namespace Sunnysideup\ImageClickSpots\Model;

use JonoM\ImageCoord\ImageCoordField;
use SilverStripe\ORM\DataObject;

class DataPoint extends DataObject
{
    private static $table_name = 'Sunnysideup_clickspots_DataPoint';

    private static $db = [
       'Title' => 'Varchar',
       'Description' => 'HTMLText',
    ];

    private static $has_one = [
        'Parent' => DataObject::class,
    ];

    public function getCMSFields()
    {
       $fields = parent::getCMSFields();
       $fields->addFieldToTab(
           'Root.Main',
           ImageCoordField::create(
               $name = 'DataPointImageCoordinates',
               $xFieldName = 'XCoordinate',
               $yFieldName = 'YCoordinate',
               $imageURL = $this->Parent()->DataPointImage()->Link(),
               $width = $this->Parent()->DataPointImage()->getWidth(),
               $height = $this->Parent()->DataPointImage()->getHeight(),
               $cssGrid = true
           )
       );
       return $fields;
    }
}
