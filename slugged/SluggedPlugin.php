<?php
namespace Craft;

class SluggedPlugin extends BasePlugin
{

    public function getName()
    {
        return 'Slugged';
    }

    public function getVersion()
    {
        return '1.0';
    }

    public function getDeveloper()
    {
        return 'Alec Ritson';
    }

    public function getDeveloperUrl()
    {
        return 'https://github.com/alecritson/slugged';
    }
    protected function defineSettings()
    {
        return array(
            'salt' => array(AttributeType::String, 'default' => 'Change me to something else', 'required' => true),
            'alphabet' => array(AttributeType::String, 'default' => 'abcdefghijklmnopqrstuvwxyz123456789', 'required' => true),
            'length' => array(AttributeType::Number, 'default' => 8, 'required' => true),
            'sections' => array(AttributeType::Mixed, 'default' => array())
        );
    }
    public function getSettingsHtml()
    {
        return craft()->templates->render('slugged/settings', array(
            'settings' => $this->getSettings()
        ));
    }
    public function init()
    {
        require CRAFT_PLUGINS_PATH . '/slugged/vendor/autoload.php';

        craft()->on('entries.saveEntry', function(Event $event){
            // Only hash if new entry
            if($event->params['isNewEntry'])
            {
                // Get the entry
                $pluginSettings = $this->getSettings();
                // Get the entry
                $entry = $event->params['entry'];
                // Get the section
                $section = $entry->section;
                // Get the slugged settings
                $settings = $pluginSettings['sections'][$section->handle];

                // We only want to generate the slug if its enabled in the slugged settings
                if($settings['enabled'])
                {
                    $slug = craft()->slugged->encodeById($entry->id);
                    $entry->setAttribute('slug', $slug);
                    craft()->entries->saveEntry($entry);
                }
            }
        });
    }
}
