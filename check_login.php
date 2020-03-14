<?php

	session_start();
	
	require_once "connection.php";

	$username = $_POST['username'];
	$password = sha1($_POST['password']);	

  	$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_row($result);

	if(mysqli_num_rows($result) > 0){

		$_SESSION['id_user'] = $row[0];
		$_SESSION['username'] = $row[1];
		
		echo 1;
		
	}else{
		echo 0;		
	}

?>
