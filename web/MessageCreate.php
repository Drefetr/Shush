<?php
/**
 * Creates a new Message from the HTTP_POST data provided --
 * (or throws an error / quits if) --
 * On success: Print the ID of the new Message.
 */
require('../private/core/common.php');

if (!isset($_POST['JSON']) || empty($_POST['JSON'])) {
	// The HTTP_POST variable NewMessage_Text is either empty, or in some way
	// misformed.
	exit();
}

$json = json_decode($_POST['JSON'], true);
$m = MessageFactory::createMessage($json['NewMessage_MIDLength'], $json['NewMessage_TTL'], $json['NewMessage_Text']);
print $m->getMessageID();
exit();
