<?php

header('Content-type: application/json');
require_once __DIR__ . '/dataLayer.php';
$action = $_POST["action"];
switch($action){
	case "LOGIN" : loginFunction();
		break;
	case "GETCircular" : getCircularFunction();
		break;
	case "GETAbanico" : getAbanicoFunction();
		break;
	case "GETTriangular" : getTriangularFunction();
		break;
	case "hacerPedido" : getPedidoFunction();
		break;
	case "LOADPROFILE" : loadProfileFunction();
		break;
	case "REGISTER" : registerFunction();
		break;
	case "ACTIVESESSION" : activeSessionFunction();
		break;
	case "ENDSESSION" : endSessionFunction();
		break;	
	case "GETWishList" : getWishListFunction();
		break;
	case "SEARCHUSER" : searchUsersFunction();
		break;
	case "SEARCHCOOKIE" : createSearchCookie();
		break;
	case "borrarArreglo" : getBorrarFunction();
		break;
	case "GETArreglos" : getArreglosFunction();
		break;
}

function loginFunction(){
	$userName = $_POST['username'];
	$userPassword = $_POST['userPassword'];
	$result = attemptLogin($userName, $userPassword);
	if ($result["status"] == "SUCCESS"){
		$remember = $_POST["remember"];
		if($remember == "true"){
			setcookie("user", "$userName", time() + (86400 * 30), "/", "", 0);
		}
		session_start();
		$_SESSION['user'] = $userName;
		$_SESSION['loginTime'] = time();
		echo json_encode(array("message" => "Login Successful"));
	}	
	else{
		header('HTTP/1.1 500' . $result["status"]);
		die($result["status"]);
	}	
}

function registerFunction(){
	$userName = $_POST['username'];
	$result = attemptValidateUser($userName);
	if ($result["status"] == "SUCCESS"){
		session_start();
		$_SESSION['user'] = $userName;
		$_SESSION['loginTime'] = time();
		$userPassword = $_POST['userPassword'];
		$userFirstName = $_POST['userFirstName'];
		$userLastName = $_POST['userLastName'];
		$userEmail = $_POST['userEmail'];
		$userCountry= $_POST['country'];
		$userGender= $_POST['gender'];
		$userName = $_POST['username'];
		$direccion = $_POST['direccion'];
		$completeResult = attemptRegister($userName, $userPassword, $userFirstName, $userLastName, $userEmail, $userCountry, $userGender, $direccion);
		if ($completeResult["status"] == "SUCCESS"){
			echo json_encode(array("message" => "New record created successfully!")); 
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($completeResult["status"]);
		}
	}
	else{
		header('HTTP/1.1 500' . $result["status"]);
		die($result["status"]);
	}
}

function getCircularFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$result = attemptGetCircular();
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["arrayCircular"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function getAbanicoFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$result = attemptGetAbanico();
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["arrayAbanico"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function getTriangularFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$result = attemptGetTriangular();
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["arrayTriangular"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function loadProfileFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$username = $_SESSION['user'];
		$result = attemptLoadProfile($username);
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["profileData"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function activeSessionFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		echo json_encode(array("message" => "Session is active"));
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function endSessionFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		session_unset();
		session_destroy();
		echo json_encode(array("message" => "End Session"));
	}
	else {
		header('HTTP/1.1 410 Something went wrong');
		die("Something went wrong");
	}

}

function getWishListFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$username = $_SESSION['user'];
		$result = attemptGetWishList($username);
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["arrayWishList"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function getPedidoFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$username = $_SESSION['user'];
		$name = $_POST['name'];
		$result = attemptPedido($username, $name);
		if ($result["status"] == "SUCCESS"){
			echo json_encode(array("message" => "Pedido exitoso"));
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function searchUsersFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$username = $_SESSION['user'];
		$searchBox = $_COOKIE['search'];
		$result = attemptSearchUsers($username, $searchBox);		
		if ($result["status"] == "SUCCESS"){
			
			echo json_encode($result["arrayUsersList"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function createSearchCookie(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$searchBox = $_POST['searchName'];
		setcookie("search", "$searchBox", time() + 20, "/", "",0);
		echo json_encode(array("message" => "SUCCESS"));
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function getBorrarFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$name = $_POST['name'];		
		$result = attemptBorrar($name);
		echo json_encode($result);
		if ($result["status"] == "SUCCESS"){
			echo json_encode(array("message" => "Elemento borrado con exito.")); 
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

function getArreglosFunction(){
	session_start();
	if(isset($_SESSION['user']) && time() - $_SESSION['loginTime'] < 1800){ 
		$result = attemptGetArreglos();
		if ($result["status"] == "SUCCESS"){
			echo json_encode($result["arrayArreglos"]);
		}
		else {
			header('HTTP/1.1 500' . $result["status"]);
			die($result["status"]);
		}
	}
	else {
		header('HTTP/1.1 410 Session has expired');
		die("Session has expired");
	}
}

?>