<?php
/**
 *
 */
class MessageModel {
	/**
	 *
	 */
	private $messageID;

	/**
	 *
	 */
	private $messageCTime;

	/**
	 *
	 */
	private $messageTTL;

	/**
	 *
	 */
	private $messageText;

	/**
 	 *
	 */
	private $messageDKey;

	/*
	 *
	 */
	public function __construct($messageID) {
		$this->messageID = $messageID;
		$DB = DataLink::getInstance();
		$query = $DB->prepare("SELECT * FROM Messages WHERE MID=?;");
		$query->bind_param('i', $MID);
		$MID = $messageID;
		$query->execute();
		$result = $query->get_result();
		$message = $result->fetch_assoc();
		$query->close();
		$this->messageTTL = $message['TTL'];
		$this->messageCTime = $message['CTIME'];
		$this->messageDKey = $message['DKey'];
		$this->messageText = $message['Text'];

	}

	/**
	 * Destroys the Message: Expunges it from the database.
	 */
	public function destroy() {
		$DB = DataLink::getInstance();		
		$query = $DB->prepare("DELETE FROM Messages WHERE MID=?;");
		$query->bind_param('i', $MID);
		$MID = $this->messageID;
		$query->execute();
		$query->close();
	}

	/**
	 * Returns the MessageID.
	 */
	public function getMessageID() {
		return $this->messageID;
	}

	/**
	 * Returns the MessageTTL (Time-to-Live).
	 */
	public function getMessageTTL() {
		return $this->messageTTL;
	}

	/**
	 * Returns the MessageCTime (Creation Time).
	 */
	public function getMessageCTime() {
		return $this->messageCTime;
	}

	/**
	 * Returns the MessageDKey.
	 */
	public function getMessageDKey() {
		return $this->messageDKey;
	}

	/**
	 * Returns the MessageText.
	 */
	public function getMessageText() {
		return $this->messageText;
	}
}
