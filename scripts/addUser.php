<?php
	foreach ($_POST as $key => $value){
		if (empty($value)){
			echo "<script>history.back();</script>";
			exit();
		}
	}
	require_once "./connect.php";
	$_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2ID);
	$sql = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `birthday`, `role`) VALUES ('$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$_POST[password]', '$_POST[birthday]', '$_POST[role]');";
	$conn->query($sql);

if ($conn->affected_rows ==0){
	header("location: ../pages/view/admin.php");
}else{
	header("location: ../pages/view/admin.php");
}
