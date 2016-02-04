<?php
namespace Libs;

/**
 * Output helper for restAPI & basic json encoded messaging
 * Class outputHelper
 * @package backend\Libs
 * @version 0.3.0.1*/
class outputHelper {
	/**
	 * @var null|mixed array
	 */
	protected $message;

	/**
	 * Init base messaging
	 */
	public function __construct() {
		$this->setMessage(null);
	}

	/**
	 * Format base message and place data and error details
	 * @param $data
	 */
	public function formatOutput($data) {
		$formedMessage = array(
			"error" => "",
			"data" => array(),
		);

		if ($data) {
			if (isset($data['error'])) {
				$formedMessage['error'] = $data['error'];
			}
			if (isset($data['data'])) {
				$formedMessage['data'] = $data['data'];
			}
		}

		$this->setMessage($formedMessage);
	}

	/**
	 * Print message
	 */
	public function printMessage() {
		print json_encode($this->getMessage());
	}

	/**
	 * Cleanup
	 */
	public function __destruct() {
		$this->setMessage(null);
	}

	/**
	 * @return null
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param null $message
	 */
	public function setMessage( $message ) {
		$this->message = $message;
	}

}