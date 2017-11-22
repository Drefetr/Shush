<?php
class DataLink {
	/**
	 * Provides a MySQLi data connection.
	 */
	public static function getInstance() {
		return mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	}
}
