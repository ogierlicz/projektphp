<?php
    session_start();

    require_once "./connect.php";
	$gradeId = $_GET['deleteGradeId'];
	$sql = "DELETE FROM oceny WHERE id = '$gradeId'";
	$conn->query($sql);
	if ($conn->affected_rows == 0) {
		echo "<h4>Nie znaleziono ocen do usunięcia</h4>";
	} else {
		echo "<h4>Usunięto rekord o ID: $gradeId</h4>";
	}

    $nauczycielId = $_SESSION["id"];
    $checkroleQuery = "SELECT id, role FROM users WHERE id = $nauczycielId";
    $checkroleResult = $conn->query($checkroleQuery);
    $rowRole = $checkroleResult->fetch_assoc();
    $role = $rowRole['role'];
    if ($role == "teacher"){
            header("Location: ../pages/view/teacher.php");
        }
    elseif($role == "admin"){
            header("Location: ../pages/view/admin.php");
        }
	// header("location: ../pages/view/admin.php");
?>