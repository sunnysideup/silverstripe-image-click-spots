<?php

namespace Sunnysideup\ImageClickSpots\Modeel;

class DataPoint extends DataObject
{
    private static $db = [
       'Title' => 'Varchar',
       'Description' => 'HTMLText',
       'XCoordinate' => 'Float', //todo: check if this works or try Varchar
       'YCoordinate' => 'Float',
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
               $width = $this->Parent()->DataPointImage()->width(),
               $height = $this->Parent()->DataPointImage()->height(),
               $cssGrid = true
           )
       );
       return $fields;
    }
}
