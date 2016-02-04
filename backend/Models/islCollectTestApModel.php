<?php
namespace Models;

use Libs\databaseHelper;

require_once ROOT . DS . 'Libs' . DS . 'databaseHelper.php';

/**
 * Simple model file for ISLCollect Test App
 * Class islCollectTestAppModel
 * @package Models
 */
class islCollectTestAppModel {

	/**
	 * @var null|\PDO database instance
	 */
	protected $db = null;

	/**
	 * @var null|databaseHelper
	 */
	protected $dH = null;

	/**
	 * @var null|array
	 */
	protected $result = null;

	/**
	 * Init database
	 */
	public function __construct() {
		// connect db
		$databaseHelper = new databaseHelper(DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$this->setDb($databaseHelper->getDB());
		$this->setDH($databaseHelper);
	}

	/**
	 * Get & cache db resulst for querys
	 * @param string $tableType
	 *
	 * @return null|Mixed
	 */
	public function getBaseTableDetails($tableType = 'one') {
		switch ($tableType) {
			case 'two':
				$this->setResult($this->getQueryTwo());
				break;
			case 'three':
				$this->setResult($this->getQueryThee());
				break;
			case 'one':
			default:
				$this->setResult($this->getQueryOne());
				break;
		}

		return $this->getResult();
	}

	/**
	 * Close database connection and clear cached database
	 */
	public function __destruct() {
		$this->clearDb();
	}

	/**
	 * @return null
	 */
	public function getDb() {
		return $this->db;
	}

	/**
	 * @param null $db
	 */
	public function setDb( $db ) {
		$this->db = $db;
	}

	/**
	 * @return null|\PDO
	 */
	public function getDH()
	{
		return $this->dH;
	}

	/**
	 * @param null|\PDO $dH
	 */
	public function setDH($dH)
	{
		$this->dH = $dH;
	}

	/**
	 * @return null
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param null $result
	 */
	public function setResult( $result ) {
		$this->result = $result;
	}

	/**
	 * Set back the database to null (soft-erase cache)
	 */
	private function clearDB() {
		$this->setResult(null);
		$this->setDb(null);
	}

	/**
	 * Trigger the first query (check documentation 'queries - 1.' point).
	 * @return null|Object
	 */
	private function getQueryOne() {
		$result = null;

		$sql = '
			SELECT
				islc_users.user_name,
				islc_users.email_address,
				islc_users.last_login,
				COUNT(islc_taskdocs.id) AS number_of_created_docs,
				SUM(islc_taskdocs.downloads) AS downloaded_doc_num
			FROM
				islc_users
				LEFT JOIN
					islc_taskdocs
				ON
					islc_taskdocs.created_by = islc_users.id
			WHERE
				islc_users.user_name <> ""
			GROUP BY
				islc_users.id
		';

        $databaseWorker = $this->getDH();
        $result = $databaseWorker->fetchQueryAsObject($sql);

		return $result;
	}

	/**
	 * Query for monitoring monthly downloads what users did. Also there is no any pagination or extra rule implemented
	 *
	 * @return null|Object
	 */
	private function getQueryTwo() {
		$result = null;

		$sql = '
			SELECT
			  islc_users.user_name,
			  YEAR(islc_task_downloads.create_date) AS target_year,
			  MONTH(islc_task_downloads.create_date) AS target_month,
			  COUNT(islc_task_downloads.id) AS counted
			FROM
			  islc_task_downloads
			LEFT JOIN
			  islc_users
			ON
			  islc_users.id = islc_task_downloads.user_id
			WHERE
			  islc_task_downloads.user_id <> ""
			AND
			  islc_task_downloads.taskdoc_id <> ""
			GROUP BY
			  target_month, target_year
			ORDER BY
			  target_year, target_month ASC;
		';

        $databaseWorker = $this->getDH();
        $result = $databaseWorker->fetchQueryAsObject($sql);

		return $result;
	}

	/**
	 * Get small chunck info from two table
	 * @return null|Object
	 */
	private function getQueryThee() {
		$result = null;

		$sql = '
			SELECT
				islc_taskdocs.downloads,
				islc_taskdocs.title,
				islc_users.user_name
			FROM
				islc_taskdocs
			LEFT JOIN
				islc_users
			ON
				islc_users.id = islc_taskdocs.created_by
			WHERE
				islc_taskdocs.downloads > 0
			ORDER BY
				islc_taskdocs.downloads
			DESC
			LIMIT 10;
		';

        $databaseWorker = $this->getDH();
        $result = $databaseWorker->fetchQueryAsObject($sql);

		return $result;
	}
}
