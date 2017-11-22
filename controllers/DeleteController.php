<?php
/**
 * Destroys the Message w/ the MID as specified by the $_GET['i'] variable;
 * & redirects to the Frontpage.
 */

$dataLink = DataLink::getInstance();

if (!isset($_GET['i']) || !ctype_alnum($_GET['i'])) {
	// The MID is malformed, return an error & exit:
	print ERROR_INVALID_MID;
	exit();
}

$message = new MessageModel($_GET['i']);
$message->destroy();

header('location: ' . DIR_WEBROOT . '?s=' . STATUS_MESSAGE_DESTROYED . '');
