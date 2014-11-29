<?php
namespace Craft;

class SluggedFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Slugged');
    }

    public function getInputHtml($name, $value)
    {
        return craft()->templates->render('slugged/input', array(
            'name'  => $name,
            'value' => $value
        ));
    }
    public function prepValue($value)
    {   
        $value = craft()->slugged->encodeById($this->element->id);
        return $value;
    }
}