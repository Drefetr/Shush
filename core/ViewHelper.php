<?php
/**
 * ViewHelper:
 */

class ViewHelper {
	/**
	 *
	 */
	private $view = array();
	
	/**
	 *
	 */
	private $templates = array();

	/**
	 *
	 */
	function __get($key) {
		return $this->view[$key];
	}

	/**
	 *
	 */
	function __set($key, $value) {
		$this->view[$key] = $value;
	}

	/**
	 *
	 */
	function __isset($key) {
		return isset($this->view[$key]);
	}

	/**
	 *
	 */
	public function queueTemplate($templateName) {
	        $fileName = DIR_TEMPLATES . $templateName . '.tpl.php';

	        if (file_exists($fileName)) {
	                $this->templates[] = $fileName;
	        }
	}

	/**
	 *
	 */
	public function loadTemplate($templateName) {
	        $fileName = DIR_TEMPLATES . $templateName . '.tpl.php';		

	        if (file_exists($fileName))
	                require($fileName);			
	}
	
	public function execute() {
		foreach ($this->templates as $k => $v) {
			require($v);
		}
	}
}