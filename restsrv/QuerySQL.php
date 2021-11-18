<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class QuerySQL {
	private $data = array();
	/*
		you should hookup the DAO here
	*/
	public function Fetch($table, $input, $cond){
		if($cond == "null"){
			$query = "SELECT ".$input." FROM ".$table;
		}else{
			$query = "SELECT ".$input." FROM ".$table." WHERE ".$cond;
		}
		
		file_put_contents("gquery.txt", $query);
		$dbcontroller = new DBController();
		$this->QuerySQL = $dbcontroller->executeSelectQuery($query);
		return $this->QuerySQL;
	}

	public function Remove($table, $input){
		$query = "DELETE FROM ".$table." WHERE ".$input;
		//file_put_contents("rquery.txt", $query);
		
		$dbcontroller = new DBController();
		$this->QuerySQL = $dbcontroller->executeSelectQuery($query);
		return $this->QuerySQL;
	}

	public function Update($table, $input, $cond){
		if($cond == "null"){
			return;
		}else{
			$query = "UPDATE ".$table." SET ".$input." WHERE ".$cond;
		}
		//file_put_contents("uquery.txt", $query);
		$dbcontroller = new DBController();
		
		$this->QuerySQL = $dbcontroller->executeSelectQuery($query);
		return $this->QuerySQL;
	}

	public function Insert($table, $keys, $vals){
		$trimKeys = str_replace(" ", "", $keys);
		$explodeKeys = explode(",", $trimKeys);
		$trimVals = str_replace(" ", "", $vals);
		$explodeVals = explode(",", $trimVals);
		$outStr = "";
		file_put_contents("explodeKeys.txt", implode(";", $explodeKeys));
		file_put_contents("explodeVals.txt", implode(";", $explodeVals));
		for ($x = 0; $x < count($explodeKeys); $x++) {
		$outStr = $outStr.$explodeKeys[$x]."=".$explodeVals[$x].", ";
		}
		$outStrCount = count(str_split($outStr));
		//file_put_contents("icount.txt", $outstr." ".$outStrCount);
		$query = "INSERT INTO ".$table." (".$keys.") VALUES (".$vals.") ON DUPLICATE KEY UPDATE ".substr($outStr, 0, $outStrCount-2);
		file_put_contents("iquery.txt", $query);
		$dbcontroller = new DBController();
		$this->QuerySQL = $dbcontroller->executeSelectQuery($query);
		return $this->QuerySQL;
	}	
}
?>