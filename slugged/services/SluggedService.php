<?php
namespace Craft;

/**
 * The main service class for Slugged
 *
 * This class handles all the encoding and saving of entry slugs
 *
 * @author    Alec Ritson <info@alecritson.co.uk>
 * @copyright Copyright (c) 2014, Alec Ritson.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @link      http://alecritson.co.uk
 * @package   craft.plugins.slugged.services
 * @since     1.0
 */

class SluggedService extends BaseApplicationComponent
{	
	protected $length;
	protected $alphabet;
	protected $salt;
	protected $encoder;

	public function __construct()
	{
		$settings = craft()->plugins->getPlugin('slugged')->getSettings();

		$this->length = $settings['length'];
		$this->salt = $settings['salt'];
		$this->alphabet = $settings['alphabet'];

	}

	/**
	 * Encode the entry slug and save the entry
	 *
	 * This method will take EntryModel that's passed and encode it's ID, the entries slug attribute will then be replaced
	 * with the encoded ID and saved.
	 *
	 * @param EntryModel $entry  The EntryModel representing the entry that has just been saved.
	 *
	 *
	 * @return bool|null true if the method was successful
	 */
	public function encode(EntryModel $entry)
	{

		$encoder = new \Hashids\Hashids($this->salt, $this->length, $this->alphabet);

		$encodedSlug = $encoder->encode($entry->id);
		
		return $encodedSlug;
	}
	public function encodeById($id = null)
	{
		$entry = craft()->entries->getEntryById($id);

		if(!$entry)
		{
			return false;
		}
		else {
			return $this->encode($entry);
		}
	}
}
