<?php
/**
 * Fetches & prints the specified Message from the database (by MID)
 * -- Message still requires decryption (on the client-side).
 */
class ReadController
{
	/**
	 *
	 */
	public function execute($vars)
	{
		// Instantiate MessageModel object --
		$message = new MessageModel($vars['message-id']);

		// Build JSON formatted response:
		$response = array();
		$response['contents'] = $message->getContents();

		// Return JSON formatted response:
		print json_encode($response, true);
	}
}

// Instantiate & execute ReadController object:
$pageController = new ReadController();
$pageController->execute($vars);
