<?php
namespace WDGWV\CMS\controllers;

class menu extends \WDGWV\CMS\controllers\base {
	private static $databaseConnection = '';

	public function __construct($databaseConnection) {
		static::$databaseConnection = $databaseConnection;
	}

	public function getUserById($userID) {
		return;
	}
}

?>