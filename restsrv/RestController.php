<?php
require_once("SQLRestHandler.php");

$cmd = "";
$cmd = $_POST["cmd"];
$val1 = "";
$val1 = $_POST["val1"];
$val2 = "";
$val2 = $_POST["val2"];
$val3 = "";
if(isset($_POST["val3"])){
	$val3 = $_POST["val3"];
}else{
	$val3 = "null";
}
/*
controls the RESTful services
URL mapping
*/

switch($cmd){

	case "get":
		// to handle REST Url /mobile/list/
		$sqlRestHandler = new SQLRestHandler();
		$sqlRestHandler->getRecord($val1, $val2, $val3);
		break;
		
	case "set":
		// to handle REST Url /mobile/list/
		$sqlRestHandler = new SQLRestHandler();
		$sqlRestHandler->setRecord($val1, $val2, $val3);
		break;

	case "rem":
		// to handle REST Url /mobile/list/
		$sqlRestHandler = new SQLRestHandler();
		$sqlRestHandler->remRecord($val1, $val2);
		break;

	case "ins":
		// to handle REST Url /mobile/list/
		$sqlRestHandler = new SQLRestHandler();
		$sqlRestHandler->insRecord($val1, $val2, $val3);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
