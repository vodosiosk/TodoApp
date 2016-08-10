<?php
class Task {
	private $conn;
	private $tableName = "tasks";

	public $id;
	public $name;
	public $priority;
	public $deadline;
	public $status;
	public $listId;

	public $currentDate;


	public function __construct($db){
		$this->conn = $db;
		$this->currentDate = date('Y-m-d');
	}

	function create(){
		$query = "INSERT INTO " . $this->tableName .
				" SET name=:name, priority=:priority, deadline=:deadline, status=:status, lists_id=:lists_id";

		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->priority=htmlspecialchars(strip_tags($this->priority));
		$this->deadline=htmlspecialchars(strip_tags($this->deadline));
		$this->status=htmlspecialchars(strip_tags($this->status));
		$this->listId=htmlspecialchars(strip_tags($this->listId));



		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":priority", $this->priority);
		$stmt->bindParam(":deadline", $this->deadline);
		$stmt->bindParam(":status", $this->status);
		$stmt->bindParam(":lists_id", $this->listId);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readOne(){
		$query = "SELECT id, name, priority, DATE_FORMAT(deadline, '%Y-%m-%d') as ymdDeadline, status, lists_id
				FROM " . $this->tableName . 
				" WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->name = $row['name'];
		$this->priority = $row['priority'];
		$this->deadline = $row['ymdDeadline'];
		$this->status = $row['status'];
		$this->listId = $row['lists_id'];
	}	

	function readByList($id){

		$query = "SELECT id, name, priority, deadline, status, lists_id 
				FROM " . $this->tableName . 
				" WHERE lists_id=:lists_id ORDER BY id ASC";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':lists_id', $id);

		$stmt->execute();

		return $stmt;
	}

	function readSortedByParam($id, $param){
		$query = "SELECT id, name, priority, deadline, status, lists_id 
				FROM " . $this->tableName . 
				" WHERE lists_id=:lists_id ORDER BY ".$param." ASC";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':lists_id', $id);		

		$stmt->execute();

		return $stmt;
	}

	function deleteByList($id){

		$query = "DELETE FROM " . $this->tableName . 
				" WHERE lists_id=:lists_id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':lists_id', $id);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readByStatus($id, $status){

		$query = "SELECT id, name, priority, deadline, status, lists_id 
				FROM " . $this->tableName . 
				" WHERE lists_id=:lists_id AND status=:status";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':lists_id', $id);
		$stmt->bindParam(':status', $status);

		$stmt->execute();

		return $stmt;
	}

	function update(){
		$query = "UPDATE " . $this->tableName . 
				 " SET 
				 		name = :name,
				 		priority = :priority,
				 		deadline = :deadline,
				 		status = :status
				 WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->priority=htmlspecialchars(strip_tags($this->priority));
		$this->deadline=htmlspecialchars(strip_tags($this->deadline));
		$this->status=htmlspecialchars(strip_tags($this->status));

		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':priority', $this->priority);
		$stmt->bindParam(':deadline', $this->deadline);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':id', $this->id);


		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
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

	function daysRemaining(){		
		$date1 = date_create($this->deadline);
		$date2 = date_create($this->currentDate);
		$diff = date_diff($date2, $date1);
		return $diff->format('%R%a');
	}
}
?>