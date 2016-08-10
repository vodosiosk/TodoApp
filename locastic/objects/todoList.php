<?php
class TodoList {
	private $conn;
	private $tableName = "lists";

	public $id;
	public $name;
	public $created;
	public $userId;

	public $cnt;
	public $todoCnt;
	public $doneCnt;
	public $progress;

	public function __construct($db){
		$this->conn = $db;
	}	

	function create(){
		$query = "INSERT INTO " . $this->tableName .
				" SET name=:name, created=:created, users_id=:users_id";

		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->created=htmlspecialchars(strip_tags($this->created));
		$this->userId=htmlspecialchars(strip_tags($this->userId));

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":created", $this->created);
		$stmt->bindParam(":users_id", $this->userId);
		

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readById($id){
		$query = "SELECT id, name, created, users_id 
				FROM " . $this->tableName . 
				" WHERE users_id = :users_id AND id = :id ORDER BY id ASC";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':users_id', $id);
		$stmt->bindParam(':id', $this->id);

		$stmt->execute();

		return $stmt;
	}	

	function readLatest($id){
		$query = "SELECT id, name, created, users_id 
				FROM " . $this->tableName . 
				" WHERE users_id = :users_id ORDER BY id DESC LIMIT 1";

		$stmt = $this->conn->prepare($query);		

		$stmt->bindParam(':users_id', $id);
		
		$stmt->execute();

		return $stmt;
	}

	function readSortedByParam($id, $param){
		$query = "SELECT id, name, created, users_id 
				FROM " . $this->tableName . 
				" WHERE users_id = :users_id ORDER BY ".$param." ASC";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':users_id', $id);		

		$stmt->execute();

		return $stmt;
	}

	function readByUserId($id){

		$query = "SELECT id, name, created, users_id 
				FROM " . $this->tableName . 
				" WHERE users_id = :users_id ORDER BY id ASC";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':users_id', $id);

		$stmt->execute();

		return $stmt;
	}

	function delete(){
		$query= "DELETE FROM " . $this->tableName . 
				" WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function calculateProgress(){
		if($this->cnt > 0){
			$this->doneCnt = $this->cnt - $this->todoCnt;
			$this->progress = intval($this->doneCnt/$this->cnt*100);
		}else{
			$this->doneCnt = $this->todoCnt = $this->progress = 0;
		}
	}
}
?>