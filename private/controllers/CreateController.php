<?php
/**
 * Creates a new Message from the HTTP_POST data provided --
 * (or throws an error / quits if) --
 * On success: Print the ID of the new Message.
 */

$post = json_decode(file_get_contents("php://input"));
$m = MessageFactory::createMessage($post->mid_length, $post->ttl, $post->contents);
print_r($post);
exit();
