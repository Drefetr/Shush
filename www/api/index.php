<?php
require('../../common.php');

/**
 * ShushFrontController; Entry point to the Shush application.
 */
class ShushFrontController extends FrontControllerAbstract {
	/**
	 *
	 */
	public function execute() {
		$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
			$r->addRoute('POST', 'create', 'CreateController');
			$r->addRoute('GET', 'delete', 'DeleteController');
			$r->addRoute('GET', 'read/{message-id}', 'ReadController');
		});

		$uri = $_GET['q'];

		if (false !== $pos = strpos($uri, '?')) {
			$uri = substr($uri, 0, $pos);
		}

		$uri = rawurldecode($uri);
		$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);
		$pageController = null;

		switch ($routeInfo[0]) {
			case FastRoute\Dispatcher::NOT_FOUND:
				print "404";
				break;

			case FastRoute\Dispatcher::FOUND:
				$handler = $routeInfo[1];
				$vars = $routeInfo[2];
				$handler = explode('/', $handler);
				$fileName = DIR_CONTROLLERS;
				$fileName .= $handler[0];
				$fileName .= '.php';
				require($fileName);
				break;
		}
	}
}

$frontController = new ShushFrontController();
$frontController->execute();
