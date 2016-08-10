<?php
class User {
	private $conn;
	private $tableName = "users";

	public $id;
	public $email;
	public $password;
	public $name;
	public $lastName;
	public $regDate;
	public $lastLogDate;
	public $status;
	public $code;	

	public function __construct($db){
		$this->conn = $db;
	}

	function getUser(){
		$query = "SELECT id, email, password 
				FROM " . $this->tableName . 
				" WHERE email = :email AND password = :password";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $this->password);

		$stmt->execute();

		return $stmt;
	}	

	function register(){

		$query = "INSERT INTO " . $this->tableName . 
				" SET email=:email, password=:password, name=:name, lastName=:lastName, regDate=:regDate, status=:status, code=:code";

		$stmt = $this->conn->prepare($query);

		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->password=htmlspecialchars(strip_tags($this->password));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->lastName=htmlspecialchars(strip_tags($this->lastName));
		$this->regDate=htmlspecialchars(strip_tags($this->regDate));
		$this->status=0;
		do{
			$this->code = rand();
			$count=$this->checkCode()->rowCount();
		}while($count>0);
		

		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":password", $this->password);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":lastName", $this->lastName);
		$stmt->bindParam(":regDate", $this->regDate);
		$stmt->bindParam(":status", $this->status);		
		$stmt->bindParam(":code", $this->code);		

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function updateLastLogin(){
		$query = "UPDATE " . $this->tableName . 
				 " SET 
				 		lastLogDate = :lastLogDate				 		
				 WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		$this->lastLogDate=date('Y-m-d H:i:s');		

		$stmt->bindParam(':lastLogDate', $this->lastLogDate);		
		$stmt->bindParam(':id', $this->id);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function checkEmail(){
		$query = "SELECT id, email, password 
				FROM " . $this->tableName . 
				" WHERE email = :email";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':email', $this->email);

		$stmt->execute();

		return $stmt;
	}

	function checkCode(){
		$query = "SELECT id, email, password
				FROM " . $this->tableName . 
				" WHERE code = :code";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':code', $this->code);

		$stmt->execute();

		return $stmt;
	}
}
?>