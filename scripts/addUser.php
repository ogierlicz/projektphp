<?php
	foreach ($_POST as $key => $value){
		if (empty($value)){
			echo "<script>history.back();</script>";
			exit();
		}
	}
	require_once "./connect.php";

	$sql = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `birthday`, `role`) VALUES ('$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$_POST[password]', '$_POST[birthday]', '$_POST[role]');";
	$conn->query($sql);

if ($conn->affected_rows ==0){
	header("location: ../admin.php?addUser=0");
}else{
	header("location: ../admin.php?addUser=1");
}
