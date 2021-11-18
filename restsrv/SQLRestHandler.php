<?php

require_once("SimpleRest.php");
require_once("QuerySQL.php");
		
class SQLRestHandler extends SimpleRest {

	function getRecord($table, $input, $cond) {	

		$sQuery = new QuerySQL();
		$rawData = $sQuery->Fetch($table, $input, $cond);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No info found!');		
		} else {
			$statusCode = 200;
		}		
		
		$requestContentType = 'application/json';//$_POST['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result[$table] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function setRecord($table, $input, $cond) {	

		$sQuery = new QuerySQL();
		$rawData = $sQuery->Update($table, $input, $cond);

		if(empty($rawData)) {
			$statusCode = 404;	
			echo "0";
		} else {
			$statusCode = 200;
			echo "1";
		}		
		
		$requestContentType = 'application/json';//$_POST['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
	}
	
	function remRecord($table, $input) {	

			$sQuery = new QuerySQL();
			$rawData = $sQuery->Remove($table, $input);
		file_put_contents("remvar.txt", $rawData);


		if(empty($rawData)) {
			$statusCode = 404;
			echo "0";
		} else {
			$statusCode = 200;
			echo "1";
		}		
		
		$requestContentType = 'application/json';//$_POST['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
	}
	
	function insRecord($table, $keys, $vals) {	

		$sQuery = new QuerySQL();
		$rawData = $sQuery->Insert($table, $keys, $vals);
		file_put_contents("insvar.txt", $rawData);

		if(empty($rawData)) {
			$statusCode = 404;
			echo "0";
		} else {
			$statusCode = 200;
			echo "1";
		}		
		
		$requestContentType = 'application/json';//$_POST['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}	
}

?>