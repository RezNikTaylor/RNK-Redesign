<?php
/*
 *
 */
class MySQLDatabase
{
	private $connection;
	public $lastQuery;

	public function __construct()
	{
		$this->connect();
	}

	public function connect()
	{
		$this->connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

		if ($this->connection->connect_error) {
			die("Database connection failed: " . $this->connection->connect_error);
		}
	}

	public function disconnect()
	{
		if (isset($this->connection)) {
			$this->connection->close();
			unset($this->connection);
		}
	}

	public function query($sql)
	{
		$this->lastQuery = $sql;
		$result = $this->connection->query($sql);
		$this->confirmQuery($result);

		return $result;
	}

	public function real_escape_string($string)
	{
		return $this->connection->real_escape_string($string);
	}

	public function fetch_array($result, $type = MYSQLI_ASSOC)
	{
		return $result->fetch_array($type);
	}

	public function fetch_object($result)
	{
		return $result->fetch_object();
	}

	public function num_rows($result)
	{
		return $result->num_rows;
	}

	public function insert_id()
	{
		// get last id inserted over the current db connection
		return $this->connection->insert_id;
	}

	public function affected_rows()
	{
		return $this->connection->affected_rows;
	}

	private function confirmQuery($result)
	{
		if (!$result) {
			$output = "Database query failed: {$this->connection->error}<br><br>";
			$output .= "Last SQL query: {$this->lastQuery}";
			die($output);
		}
	}
}

$database = new MySQLDatabase();
$db =& $database;