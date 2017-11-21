<?php
/**
 * Fetches & prints the specified Message from the database (by MID)
 * -- Message still requires decryption (on the client-side).
 */

require('../private/core/common.php');

$dataLink = DataLink::getInstance();

if (!isset($_GET['i']) || !ctype_alnum($_GET['i'])) {
	// The MID is malformed, return an error & exit:
	print '?';
	exit();
}

$message = new MessageModel($_GET['i']);

print $message->getMessageText();

$message->destroy();
exit();
