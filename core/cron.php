<?php
// Bind to a cron-job for automatic clean-up of expired Messages.

require('conf.php');
require('common.php');

$dataLink = DataLink::getInstance();

$time = time();

$sql = 'SELECT * FROM Messages';
$query = mysqli_query($dataLink, $sql);

// Loop through all Messages.
while ($row = mysqli_fetch_assoc($query)) {
	if (($row['CTIME'] + $row['TTL']) < $time) {
		// The message has expired -- remove it.
		mysqli_query($dataLink, 'DELETE FROM Messages WHERE MID="' . $row['MID'] . '"');
	}
}