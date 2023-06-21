<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	session_start();
//	print_r($_POST);
	//$requiredFields = ["firstName", "lastName", "email", "confirm_email", "pass", "confirm_pass", "birthday", "city_id"];

	$errors = [];
	foreach ($_POST as $key => $value){
		if (empty($value)){
			$errors[] = "Pole <b>$key</b> jest wymagane";
		}
	}

	if (!empty($errors)){
//		print_r($errors);
		echo "test: ".$errors[0];
		$_SESSION['error_message'] = implode("<br>", $errors);
		echo "<script>history.back();</script>";
		exit();
	}

	foreach ($_POST as $key => $value){
		${$key} = $value;
	}
	require_once "./connect.php";

	try{
		$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
		$stmt->bind_param("s", $login);
		$stmt->execute();
		$result = $stmt->get_result();
		//echo $result->num_rows;
		if ($result->num_rows == 1){
			$user = $result->fetch_assoc();
			//echo $user["password"];
			if (password_verify($pass, $user["password"])){
				$_SESSION["logged"]["firstName"] = $user["firstName"];
				$_SESSION["logged"]["lastName"] = $user["lastName"];
				//echo session_id();
				$_SESSION["logged"]["session_id"] = session_id();
				//$_SESSION["logged"]["role_id"] = $user["role_id"];
				$stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
				$stmt->bind_param("s", $login);
				$stmt->execute();
				$roleResult = $stmt->get_result();
				$roleRow = $roleResult->fetch_assoc();
				$role = $roleRow['role'];
				if ($role == "student"){
					$_SESSION["id"] = $user["id"];
					header("Location: ../pages/view/student.php");
					exit();
				} elseif ($role == "teacher"){
					$_SESSION["id"] = $user["id"];
					header("Location: ../pages/view/teacher.php");
					exit();
				} elseif($role == "admin"){
					header("Location: ../pages/view/admin.php");
					exit();
				}
			}else{
				$_SESSION["error_message"] = "Błędny login lub hasło!";
				echo "<script>history.back();</script>";
				exit();
			}
		}else{
			$_SESSION["error_message"] = "Błędny login lub hasło!";
			echo "<script>history.back();</script>";
			exit();
		}

	} catch(mysqli_sql_exception $e){
		$_SESSION["error_message"] = "Error: ".$e->getMessage();
		echo "<script>history.back();</script>";
		exit();
	}

}else{
	header("location: ../pages/view/register.php");
}