<?php
	session_start();
//	print_r($_POST);
	foreach ($_POST as $key => $value){
		//echo "$key: $value<br>";
		if (empty($value)){
			echo "<script>history.back();</script>";
			exit();
		}
	}

	require_once "./connect.php";
	//$sql = "INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `birthday`) VALUES ('$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
	$sql = "UPDATE `users` SET `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `email` = '$_POST[email]', `password` = '$_POST[password]', `birthday` = '$_POST[birthday]', `role` = '$_POST[role]'WHERE `users`.`id` = $_SESSION[userUpdateId];";
	$conn->query($sql);

	//echo $conn->affected_rows; //1-ok, 0-

if ($conn->affected_rows ==0){
	header("location: ../admin.php?updateUser=0");
}else{
	header("location: ../admin.php?updateUser=1");
}
