<?php
/**
 * Fetches & prints the specified Message from the database (by MID)
 * -- Message still requires decryption (on the client-side).
 */

class ReadController
{
	public function execute($vars)
	{
		print_r($vars);
	}
}

$pageController = new ReadController();
$pageController->execute($vars);


//print_r($_GET);

//$message = new MessageModel($_GET['i']);

//print $message->getMessageText();

//$message->destroy();
exit();
