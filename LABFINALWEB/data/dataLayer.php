<?php

function connectionToDataBase(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "LabFinal";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error){
		return null;
	}
	else{
		return $conn;
	}
}

function attemptLogin($userName, $userPassword){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT username, passwrd FROM UsersDatabase WHERE username = '$userName' AND passwrd = '$userPassword'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$conn -> close();
			return array("status" => "SUCCESS");
		}
		else{
			$conn -> close();
			return array("status" => "WRONG CREDENTIALS!");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptBorrar($name){
	$conn = connectionToDataBase();
	if ($conn != null){
		//echo $name;
		$name = trim($name);
		$sql = "DELETE FROM Arreglos WHERE nombre = '{$name}'";
		//echo $sql;
		$result = $conn->query($sql);
		//echo $result;
		if ($result) {
			$conn -> close();
			return array("status" => "SUCCESS");
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptGetArreglos(){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT idArreglo, nombre, precio FROM Arreglos";
		$result = $conn->query($sql);
		$arrArreglos = array();
		while($row = $result->fetch_assoc()) {
			$response = array('idArreglo' => $row['idArreglo'], 'nombre' => $row['nombre'], 'precio' => $row['precio']);  
			array_push($arrArreglos, $response);
		}
		$conn -> close();
		return array("status" => "SUCCESS", "arrayArreglos" => $arrArreglos);
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptValidateUser($username){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT username FROM UsersDatabase WHERE username = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$conn -> close();
			return array("status" => "USERNAME ALREADY IN USE");
		}
		else{
			$conn -> close();
			return array("status" => "SUCCESS");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptRegister($userName, $userPassword, $userFirstName, $userLastName, $userEmail, $userCountry, $userGender, $direccion){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "INSERT INTO UsersDatabase (fName, lName, direccion, username, passwrd, email, country, gender) VALUES ('$userFirstName', '$userLastName', '$direccion','$userName', '$userPassword', '$userEmail', '$userCountry', '$userGender')";
		$result = $conn->query($sql);
		if ($result) {
			$conn -> close();
			return array("status" => "SUCCESS");
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptGetCircular(){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT idArreglo, nombre, precio FROM Arreglos WHERE tipo = 'Circular'";
		$result = $conn->query($sql);
		$arrCirculo = array();
		while($row = $result->fetch_assoc()) {
			$response = array('idArreglo' => $row['idArreglo'], 'nombre' => $row['nombre'], 'precio' => $row['precio']);  
			array_push($arrCirculo, $response);
		}
		$conn -> close();
		return array("status" => "SUCCESS", "arrayCircular" => $arrCirculo);
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptGetAbanico(){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT idArreglo, nombre, precio FROM Arreglos WHERE tipo = 'Abanico'";
		$result = $conn->query($sql);
		$arrAbanico = array();
		while($row = $result->fetch_assoc()) {
			$response = array('idArreglo' => $row['idArreglo'], 'nombre' => $row['nombre'], 'precio' => $row['precio']);  
			array_push($arrAbanico, $response);
		}
		$conn -> close();
		return array("status" => "SUCCESS", "arrayAbanico" => $arrAbanico);
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptGetTriangular(){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT idArreglo, nombre, precio FROM Arreglos WHERE tipo = 'Triangular'";
		$result = $conn->query($sql);
		$arrTriangular = array();
		while($row = $result->fetch_assoc()) {
			$response = array('idArreglo' => $row['idArreglo'], 'nombre' => $row['nombre'], 'precio' => $row['precio']);  
			array_push($arrTriangular, $response);
		}
		$conn -> close();
		return array("status" => "SUCCESS", "arrayTriangular" => $arrTriangular);
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptLoadProfile($username){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT * FROM UsersDatabase WHERE username = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
	    	$response = array('fName' => $row['fName'], 'lName' => $row['lName'], 'username' => $row['username'], 'email' => $row['email'], 'gender' => $row['gender'], 'country' => $row['country']); 
		}
			$conn -> close();
			return array("status" => "SUCCESS", "profileData" => $response);
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptGetWishList($username){
	$conn = connectionToDataBase();
	if ($conn != null){
		$getIDsql = "SELECT idUser FROM UsersDatabase WHERE username = '$username'";
		$resultID = $conn->query($getIDsql);
		while($row = $resultID->fetch_assoc()) {
			$usernameID = $row['idUser'];
		}
		$sql = "SELECT * FROM Pedidos WHERE (idUser1 = '$usernameID') AND status = 1";
		$result = $conn->query($sql);
		$friendsList = array();

		if ($result->num_rows > 0){
			$rows = $result->num_rows;
			while($row = $result->fetch_assoc()) {
				$usernameIDFriend1 = $row['idUser1'];
				$usernameIDFriend2 = $row['idArreglo1'];
				$sqlGetFriends = "SELECT nombre, tipo, precio FROM Arreglos WHERE idArreglo = '$usernameIDFriend2' ";
				$resultFriends = $conn->query($sqlGetFriends);
				if ($resultFriends->num_rows > 0){
					while($row = $resultFriends->fetch_assoc()) {
						$response = array('nombre' => $row['nombre'], 'tipo' => $row['tipo'], 'precio' => $row['precio']);  
						array_push($friendsList, $response);
					}
				}
				else{
					$conn -> close();
					return array("status" => "ERROR");
				}	
			}
			$conn -> close();
			return array("status" => "SUCCESS", "arrayWishList" => $friendsList);
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

function attemptPedido($username, $name){
	$conn = connectionToDataBase();
	if ($conn != null){
		$getIDsql1 = "SELECT idUser FROM UsersDatabase WHERE username = '$username'";
		$resultID1 = $conn->query($getIDsql1);
		while($row = $resultID1->fetch_assoc()) {
			$usernameID1 = $row['idUser'];
		}
		$getIDsql2 = "SELECT idArreglo FROM Arreglos WHERE nombre = '$name'";
		$resultID2 = $conn->query($getIDsql2);
		while($row = $resultID2->fetch_assoc()) {
			$usernameID2 = $row['idArreglo'];
		}
		$sql = "INSERT INTO Pedidos (idUser1, idArreglo1, status) VALUES ('$usernameID1', '$usernameID2', 1)";
		$result = $conn->query($sql);
		if ($result) {
			$conn -> close();
			return array("status" => "SUCCESS");
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}
function attemptSearchUsers($username, $searchBox){
	$conn = connectionToDataBase();
	if ($conn != null){
		$sql = "SELECT nombre, tipo, precio FROM Arreglos WHERE nombre LIKE '%$searchBox%'";
		$result = $conn->query($sql);
		$userList = array();
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$response = array('nombre' => $row['nombre'], 'tipo' => $row['tipo'], 'precio' => $row['precio']);  
				array_push($userList, $response);

			}
			$conn -> close();
			return array("status" => "SUCCESS", "arrayUsersList" => $userList);
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}
	else{
		$conn -> close();
		return array("status" => "CONNECTION WITH DB WENT WRONG");
	}
}

?>