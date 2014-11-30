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

		$this->encoder = new \Hashids\Hashids($this->salt, $this->length, $this->alphabet);
	}

	/**
	 * Encode the id and return it
	 *
	 * This method will take EntryModel that's passed and encode it's ID, the entries slug attribute will then be replaced
	 * with the encoded ID and saved.
	 *
	 * @param $id  A number to hash.
	 *
	 *
	 * @return string|$encodedId the encoded ID
	 */
	public function encodeById($id)
	{
		$encodedId = $this->encoder->encode($id);
		return $encodedId;
	}

	public function decode($hash)
	{
		$id = $this->encoder->decode($hash);
		return reset($id);
	}
}
