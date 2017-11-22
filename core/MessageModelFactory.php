<?php
/**
 *
 */
class MessageModelFactory {
	/**
 	 *
	 */
	private static $messageID;

	/**
	 *
	 */
	private static $messageTTL;

	/**
	 *
	 */
	private static $messageDKey;

	/**
	 *
	 */
	private static $messageText = '';

	/**
	 * 
	 */
	public static function createMessage($messageIDLength = MESSAGE_ID_LENGTH_DEFAULT, $messageTTL = MESSAGE_TTL_DEFAULT, $messageText) {
		self::$messageTTL = $messageTTL;
		self::$messageText = $messageText;
		$messageID = '';

		do {
			$messageID = substr(str_shuffle(MESSAGE_ID_CHARSET), 0, $messageIDLength);
		} while (self::MIDExists($messageID));

		$messageDKey = '';

		for ($i = 0; $i < MESSAGE_KEY_LENGTH_DEFAULT; $i++) {
			$messageDKey .= substr(str_shuffle(MESSAGE_ID_CHARSET), 0, 1);
		}

		self::$messageDKey = $messageDKey;
		self::$messageID = $messageID;
		$dataLink = DataLink::getInstance();

		$query = $dataLink->prepare("INSERT INTO Messages (MID, CTIME, TTL, DKey, Text) VALUES (?, ?, ?, ?, ?)");
		$query->bind_param('siiss', $messageID, $messageCTime, $messageTTL, $messageDKey, $messageText);

		$messageID = self::$messageID;
		$messageCTime = time();
		$messageTTL = self::$messageTTL;
		$messageDKey = self::$messageDKey;
		$messageText = self::$messageText;

		$query->execute();
		$message = new MessageModel(self::$messageID);
		return $message;
	}

	/**
	 * Determines whether or not the specified MID $messsageID exists within the database.
	 */
	public static function MessageIDExists($messageID) {
                $DB = DataLink::getInstance();
                $query = $DB->prepare("SELECT * FROM Messages WHERE MID=?;");
                $query->bind_param('s', $MID);
                $MID = $messageID;
                $query->execute();
                $result = $query->get_result();
                $query->close();

		if ($result->num_rows != 0) {
			// MID $messageID exists.
			return true;
		}

		// MID $messageID does not exist.
		return false;
	}
}
