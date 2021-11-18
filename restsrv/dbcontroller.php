<?php
class DBController {
	private $conn = "";
	private $host = "localhost";
	private $user = "mcl_db";
	private $password = "MidlakesDB1.";
	private $database = "MCL_db";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function executeSelectQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if(is_bool($result)){
			return $result;
		}else{
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
		}
	}
}
?>
