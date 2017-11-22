<?php
/**
 * Encapsulates a MessageModel and exposes appropriate access & mutation
 * behavior(s).
 */
class MessageModel {
	/**
	 * Encrypted contents.
	 */
	private $contents;

	/**
	 * Creation time; numbers of seconds since UNIX epoch.
	 */
	private $CTIME;

	/**
 	 * Unique one-time key for deletion.
	 */
	private $DKey;

	/**
	 * Unique alphanumeric identifier.
	 */
	private $MID;

	/**
	 * Time-to-live (minutes since creation).
	 */
	private $TTL;

	/**
	 * Default constructor.
	 *
	 * @param $mid Unique alphanumeric identifier.
	 */
	public function __construct($mid) {
		$DB = DataLink::getInstance();
		$query = $DB->prepare("SELECT * FROM Messages WHERE MID=?;");
		$query->bind_param('i', $mid);
		$query->execute();
		$result = $query->get_result();
		$message = $result->fetch_assoc();
		$query->close();

		// Populate class data-members:
		$this->contents = $message['Text'];
		$this->CTIME = $message['CTIME'];
		$this->DKEY = $message['DKey'];
		$this->MID = $mid;
		$this->TTL = $message['TTL'];
	}

	/**
	 *
	 */
	public static function create() {

	}

	/**
	 * Destroys the Message: Expunges it from the database.
	 */
	public function delete() {
		$DB = DataLink::getInstance();
		$query = $DB->prepare("DELETE FROM Messages WHERE MID=?;");
		$query->bind_param('i', $MID);
		$MID = $this->messageID;
		$query->execute();
		$query->close();
	}

	/**
	 * Accessor to `$this->contents`.
	 */
	public function getContents() {
		return $this->contents;
	}

	/**
	 * Accessor to `$this->CTIME`.
	 */
	public function getCTIME() {
		return $this->CTIME;
	}

	/**
	 * Accessor to `$this->DKEY`.
	 */
	public function getDKEY() {
		return $this->DKEY;
	}

	/**
	 * Accessor to `$this->MID`.
	 */
	public function getMID() {
		return $this->MID;
	}

	/**
	 * Accessor to `$this->TTL`.
	 */
	public function getTTL() {
		return $this->TTL;
	}
}
