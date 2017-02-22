<?php
/**
 * ErrorViewController
 */
class ErrorViewController extends PageControllerAbstract {
	/**
	 *
	 */
	public function execute($viewHelper) {
		$this->viewHelper = $viewHelper;
		$this->viewHelper->loadTemplate('HTMLHeader');
		$this->viewHelper->loadTemplate('PageHeader');
		$this->viewHelper->loadTemplate('PageFooter');
		$this->viewHelper->loadTemplate('HTMLFooter');
		$this->viewHelper->execute();
	}
}
