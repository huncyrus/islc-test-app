<?php

namespace backend\Controllers;

use Libs\outputHelper;
use Libs\routeHelper;
use Models\islCollectTestAppModel;

require_once ROOT . DS . 'Libs' . DS . 'routeHelper.php';
require_once ROOT . DS . 'Libs' . DS . 'outputHelper.php';
require_once ROOT . DS . 'Models' . DS . 'islCollectTestApModel.php';

/**
 * Controller for test task by islCollect
 * Class islCollectTestAppController
 * @package backend\Controllers\islCollect
 */
class islCollectTestAppController {
	/**
	 * @var null|Mixed
	 */
	protected $model = null;

	/**
	 * @var null|string
	 */
	protected $output = null;

	/**
	 * @var null|Mixed
	 */
	protected $router = null;

	public function __construct() {
		$this->setModel(new islCollectTestAppModel());
		$this->setOutput(new outputHelper());
		$this->setRouter(new routeHelper());
	}

	/**
	 * Main router method, print message as json_encoded string
	 */
	public function run() {
		// routing
		$router = $this->getRouter();
		$router->addRoute('getFirst', function () {
			$data = $this->callQuery('one');
			$this->finalizeOutput($data);
		});
		$router->addRoute('getSecond', function () {
			$data = $this->callQuery('two');
			$this->finalizeOutput($data); // two line, reason: debug
		});
		$router->addRoute('getThird', function () {
			$data = $this->callQuery('three');
			$this->finalizeOutput($data);
		});
		$router->route(); // Trigger the calls
	}

	/**
	 * Erase cache and unused parts
	 */
	public function __destruct() {
		$this->setModel(null);
		$this->setOutput(null);
		$this->setRouter(null);
	}

	/**
	 * @return Mixed|null
	 */
	public function getRouter() {
		return $this->router;
	}

	/**
	 * @param Mixed|null $router
	 */
	public function setRouter( $router ) {
		$this->router = $router;
	}

	/**
	 * @return Mixed|null
	 */
	private function getModel() {
		return $this->model;
	}

	/**
	 * @param Mixed|null $model
	 */
	private function setModel( $model ) {
		$this->model = $model;
	}

	/**
	 * @return null|string
	 */
	private function getOutput() {
		return $this->output;
	}

	/**
	 * @param null|string $output
	 */
	private function setOutput( $output ) {
		$this->output = $output;
	}

	/**
	 * Final frontier
	 * @param $data
	 */
	private function finalizeOutput ($data) {
		$output = $this->getOutput();
		$output->formatOutput($data);
		$output->printMessage();
	}

	/**
	 * Query handler
	 * @param string $queryVersion
	 * @return array
	 */
	protected function callQuery($queryVersion = 'one') {
		$tempModel = $this->getModel();
		$dataResult = $tempModel->getBaseTableDetails($queryVersion);

		$result = array(
			'error' => '',
			'data' => '',
		);

		if (null != $dataResult) {
			$result['data'] = $dataResult;
		} else {
			$result['error'] = 'Missing query-' . $queryVersion . ' result';
		}

		return $result;
	}
}
