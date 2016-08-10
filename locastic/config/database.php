<?php
class Database {
	private $host = "localhost";
	private $dbName = "tododb";
	private $username = "vodosiosk";
	private $password = "";
	public $conn;

	public function getConnection(){
		$this->conn = null;

		try {
			$this->conn = new PDO(
				"mysql:host=" . $this->host . ";dbname=" . $this->dbName,
				$this->username,
				$this->password
				);
		} catch(PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}
}
?>