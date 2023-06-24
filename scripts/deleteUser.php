<?php
	require_once "./connect.php";
	$userId = $_GET['userDeleteId'];
	$sql = "DELETE FROM users WHERE `users`.`id` = '$userId'";
	$conn->query($sql);
	if ($conn->affected_rows == 0) {
		echo "<h4>Nie znaleziono użytkownika do usunięcia</h4>";
	} else {
		echo "<h4>Usunięto rekord o ID: $userId</h4>";
	}
?>
