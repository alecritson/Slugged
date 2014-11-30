<?php
namespace Craft;

class SluggedVariable
{
    public function decode($hash)
    {
        return craft()->slugged->decode($hash);
    }
}