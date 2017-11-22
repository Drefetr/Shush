<?php
/**
 * Describes, and provide skeleton functionality for all the PageControllers.
 */
abstract class PageControllerAbstract {
	/**
	 * An instance of ViewHelper.
	 */
	protected $viewHelper;
	
	/** 
	 *
	 */
	abstract public function execute($viewHelper);
}