<?php
/**
 * Creates a new Message from the HTTP_POST data provided --
 * (or throws an error / quits if) --
 * On success: Print the ID of the new Message.
 */
class CreateController
{
	/**
	 *
	 */
	public function execute($vars)
	{
        $post = json_decode(file_get_contents("php://input"), true);
        $m = MessageFactory::createMessage($post['mid_length'], $post['ttl'], $post['contents']);
        $post['mid'] = $m->getMID();
        print json_encode($post, true);
	}
}

// Instantiate & execute CreateController object:
$pageController = new CreateController();
$pageController->execute($vars);

