<?php
namespace Libs;

/**
 * Database Helper for easy and almost dummy PDO layer
 * Class databaseHelper
 * @version 0.6.0.2
 */
class databaseHelper {
	/**
	 * @var string
	 */
	protected $dbHost = '';

	/**
	 * @var string
	 */
	protected $dbUser = '';

	/**
	 * @var string
	 */
	protected $dbPass = '';

	/**
	 * @var string
	 */
	protected $dbName = '';

	/**
	 * @var null
	 */
	protected $dbConnection = null;

	/**
	 * @param string $host
	 * @param string $dbName
	 * @param string $user
	 * @param string $pass
	 */
	public function __construct($host = '', $dbName = '', $user = '', $pass = '') {
		$this->setDbHost($host);
		$this->setDbName($dbName);
		$this->setDbPass($pass);
		$this->setDbUser($user);
	}

	/**
	 * @param string $dbHost
	 */
	public function setDbHost($dbHost) {
		$this->dbHost = $dbHost;
	}

	/**
	 * @param string $dbUser
	 */
	public function setDbUser($dbUser) {
		$this->dbUser = $dbUser;
	}

	/**
	 * @param string $dbPass
	 */
	public function setDbPass($dbPass) {
		$this->dbPass = $dbPass;
	}

	/**
	 * @param string $dbName
	 */
	public function setDbName($dbName) {
		$this->dbName = $dbName;
	}


	/**
	 * Minimalist db helper for mysql via pdo.
	 *
	 * @return \PDO
	 */
	public function getDB() {
		$this->connectDatabase();

		return $this->getDbConnection();
	}

	/**
	 * Close connection & clear cached details.
	 */
	public function closeDB() {
		//$this->setDbConnection(null);
	}

	/**
	 * Fetching a raw sql query via PDO. Prepare method will auto clear the query.
	 *
	 * @param string $sql
	 * @return null|object
	 */
	public function fetchQueryAsObject($sql = '') {
		$result = null;

		if ('' != $sql) {
			$query = $this->dbConnection->prepare($sql);
			$query->execute();
			$queryResult = $query->fetchAll(\PDO::FETCH_OBJ);
			if ($queryResult) {
				$result = $queryResult;
			}
		}

		return $result;
	}


	/**
	 * @param null $dbConnection
	 */
	private function setDbConnection($dbConnection = null) {
		$this->dbConnection = $dbConnection;
	}

	/**
	 * @return null|\PDO connection
	 */
	private function getDbConnection() {
		return $this->dbConnection;
	}

    /**
     * Get connection by \PDO
     * @throws \Exception
     */
    private function connectDatabase() {
	    try {
		    $mysql_conn_string = "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName;
		    $dbConnection      = new \PDO( $mysql_conn_string, $this->dbUser, $this->dbPass );
		    $dbConnection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

		    $this->setDbConnection( $dbConnection );
	    } catch (\Exception $e) {
		    throw new \Exception('Connection error: ' . $e->getMessage());
	    }
    }
}
