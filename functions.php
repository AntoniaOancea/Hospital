<?php
session_start();

$conn = mysqli_connect('localhost','root','antonia','hospital');

function check_login($redirect = true){
	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){
		return true;
	}
	if($redirect){
		header("Location: index.php");
		die;
	}else{
		return false;
	}
}

function database_run($query,$vars = array())
{
	$string = "mysql:host=localhost;dbname=hospital";
	$con = new PDO($string,'root','antonia');

	if(!$con){
		return false;
	}

	$stm = $con->prepare($query);
	$check = $stm->execute($vars);

	if($check){
		
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		if(count($data) > 0){
			return $data;
		}
	}
	return false;
}