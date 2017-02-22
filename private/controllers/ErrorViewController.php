<?php
/**
 * ErrorViewController -- Handles Error logic.
 */
class ErrorViewController extends PageControllerAbstract {
	/**
	 *
	 */
	public function execute($viewHelper) {
		$this->viewHelper = $viewHelper;
		$this->viewHelper->queueTemplate('HTMLHeader');
		$this->viewHelper->queueTemplate('PageHeader');
        $this->viewHelper->queueTemplate('ErrorView');
		$this->viewHelper->queueTemplate('PageFooter');
		$this->viewHelper->queueTemplate('HTMLFooter');
		$this->viewHelper->execute();
	}
}