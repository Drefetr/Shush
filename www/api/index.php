<?php
require('../private/core/common.php');

// Block Facebook's spider:
if (preg_match('/facebookexternalhit/si', $_SERVER['HTTP_USER_AGENT'])) {
	exit();
}

/**
 * ShushFrontController; Entry point to the Shush application.
 */
class ShushFrontController extends FrontControllerAbstract {
	/**
	 *
	 */
	public function execute() {
		$errorMessages = array();

		if (!isset($_GET['q']) || empty($_GET['q'])) {
			// A MessageID & MessageKey pair has not been supplied --
			$this->pageController = new MessageCreateController();
		} else {
			// A MessageID & MessageKey pair has been supplied --
			$q = explode('/', $_GET['q']);

			// Validate MessageID:
			if (!array_key_exists('0', $q) || empty($q[0])) {
				// The supplied MessageID is null or empty --
				$errorMessages[] = ERROR_MESSAGE_ID_NULL_OR_EMPTY;
			} else if (strlen($q[0]) < MESSAGE_ID_LENGTH_MIN) {
				// The supplied MessageID is too short --
				$errorMessages[] = ERROR_MESSAGE_ID_TOO_SHORT;
			} else if (strlen($q[0]) > MESSAGE_ID_LENGTH_MAX) {
				// The MessageID supplied exceeds the maximum length permitted --
				$errorMessages[] = ERROR_MESSAGE_ID_TOO_LONG;
			}

			// Validate MessageKey:

			if (!array_key_exists('1', $q) || empty($q[1])) {
				// The supplied MessageKey is null or empty --
				$errorMessages[] = ERROR_MESSAGE_KEY_NULL_OR_EMPTY;
			} else if (strlen($q[1]) < MESSAGE_KEY_LENGTH_MIN) {
				// The supplied MessageKey is too short --
				$this->pageController = new MessageCreateController();
			} else if (strlen($q[1]) > MESSAGE_ID_LENGTH_MAX) {
				// The MessageKey supplied exceeds the maximum length permitted --
				$this->pageController = new MessageCreateController();
			}

			if (MessageModelFactory::MessageIDExists($q[0])) {
				// A valid MessageID & MessageKey pair has been supplied;
				// & A Message w/ the supplied MessageID exists within the database:
				$this->viewHelper->messageID = $q[0];
				$this->viewHelper->messageKey = $q[1];
				$this->pageController = new MessageViewController();

			} else {
				if (count($errorMessages) > 0) {
					// A valid MessageID & MessageKey pair has been supplied;
					// However, a Message w/ the supplied MessageID does not exist --
					$this->viewHelper->errorMessages = $errorMessages;
					$this->pageController = new ErrorViewController();
				} else {
					$this->pageController = new MessageCreateController();
				}
			}
		}

		$this->pageController->execute($this->viewHelper);
	}
}

$frontController = new ShushFrontController();
$frontController->execute();
