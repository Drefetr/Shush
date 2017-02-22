<?php
/**
 *
 */
abstract class FrontControllerAbstract {
	/**
	 *
	 */
	protected $pageController = null;

	/**
	 *
	 */
	protected $viewHelper;

	/**
	 *
	 */
	abstract public function execute();

	/**
	 *
	 */
	function __construct() {
		$this->viewHelper = new ViewHelper();
	}
}
