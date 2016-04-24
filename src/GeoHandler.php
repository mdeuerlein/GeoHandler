<?php

/**
*
* Provides an functions to handle different kinds of geodata.
* Please see the documentation at {@TODO link_to_github}
*
* @package GeoHandler
*
* @author Markus M. Deuerlein <deuerlein@entidia.de>
*
* @license http://www.gnu.org/copyleft/lesser.html LGPL
*
* @version $Id: GeoHandler.php,v 0.1 2016/04/24
*
*/

class GeoHandler {


	static $version = "0.1";
	private $error_msg = '';


	static function getVersion(){
		return self::$version;
	}

	public function __construct($config = null) {

	}



	/**
	*
	* @TODO Better error handling;
	*
	*/

	public function getAddress($lat,$lng) {

		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim(urlencode($lat)).','.trim(urlencode($lng)).'&sensor=false';

		$response  = @file_get_contents($url);
		$response  = json_decode($response);
		$getAdress = new StdClass;

		if($response->status=="OK") {
			$getAdress->all = $response->results[0]->formatted_address;
			return $getAdress;
		} else {
			$this->error_msg .= '<b>Error:</b> No address found or invalid geo data.<br>';
			return FALSE;
		}
	}




	/**
	*
	* @TODO Implement function to read data from image;
	*
	*/
	public function getImageGeo($imagefile) {

		if (!file_exists($imagefile)) {
			$this->error_msg .= '<b>Error:</b> Imagefile  <i>"'.$imagefile.'"</i> not found.<br>';
			return FALSE;
		}

		return 'test';

	}




	/**
	*
	* @TODO Implement function to get data from browser;
	*
	*/

	public function getBrowserGeo() {

		return FALSE;

	}



	/**
	*
	* @TODO integrate function to set debug mode;
	*
	*/
	function getErrorMessage() {

		return $this->error_msg;

	}

}
