<?php
namespace Libs;

/**
 * Dummy|fake route helper, just handle get requests
 * Class routeHelper
 * @package backend\Libs
 */
class routeHelper {
	/**
	 * @var string
	 */
	protected $get = '';

	/**
	 * @var array
	 */
	protected $routeMap = array();

	/**
	 * routeHelper constructor.
	 */
	public function __construct() {
		$this->setGet($_GET);
	}

	/**
	 * Clear cache
	 */
	public function __destruct() {
		$this->setGet('');
		$this->setRouteMap(array());
	}

	/**
	 * Route trigger
	 */
	public function route() {
		$routed = $this->getRouteMap();
		$getVars = $this->getGet();

		foreach ($routed as $key => $val) {
			if (isset($getVars[$key])) {
				$val();
			}
		}
		unset($routed, $getVars);
	}

	/**
	 * Route adder, public
	 * @param string $pattern
	 * @param null $callable the callable function
	 * @access public
	 */
	public function addRoute($pattern = '', $callable = null) {
		if ('' != $pattern && null != $callable) {
			$this->addRouteToMap($pattern, $callable);
		}
	}

	/**
	 * Route adder
	 * @param $pattern
	 * @param $callback
	 * @access private
	 */
	private function addRouteToMap($pattern, $callback) {
		$temp = $this->getRouteMap();
		$temp[$pattern] = $callback;
		$this->setRouteMap($temp);
		unset($temp, $pattern, $callback);
	}

	/**
	 * @return string
	 */
	private function getGet() {
		return $this->get;
	}

	/**
	 * @param string $get
	 */
	private function setGet( $get ) {
		$this->get = $get;
	}

	/**
	 * @return array
	 */
	private function getRouteMap() {
		return $this->routeMap;
	}

	/**
	 * @param array $routeMap
	 */
	private function setRouteMap( $routeMap ) {
		$this->routeMap = $routeMap;
	}
}
