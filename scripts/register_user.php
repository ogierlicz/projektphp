<?php
function sanitizeInput($input){
		$input = htmlentities(stripslashes(trim($input)));
		return $input;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		session_start();
		$requiredFields = ["firstName", "lastName", "email", "confirm_email", "pass", "confirm_pass", "birthday"];

		$errors = [];
		foreach ($requiredFields as $key => $value){
			if (empty($_POST[$value])){
				$errors[] = "Pole <b>$value</b> jest wymagane";
			}
		}

		if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $_POST["pass"])) {
			if (!preg_match('/[A-Z]/', $_POST["pass"])) {
				$errors[] = "<b>Hasło musi zawierać co najmniej jedną dużą literę</b>.";
			}
			if (!preg_match('/\d/', $_POST["pass"])) {
				$errors[] = "<b>Hasło musi zawierać co najmniej jedną cyfrę</b>.";
			}
			if (!preg_match('/[!@#$%^&*]/', $_POST["pass"])) {
				$errors[] = "<b>Hasło musi zawierać co najmniej jeden znak specjalny (!@#$%^&*)</b>.";
			}
			if (strlen($_POST["pass"]) < 8) {
				$errors[] = "<b>Hasło musi mieć co najmniej 8 znaków</b>.";
			}
		}

		if (!preg_match('/^([A-ZĄĆĘŁŃÓŚŹŻ])/u', $_POST["firstName"])) {
			$errors[] = "<b>Imię musi się zaczynać z dużej litery (A-Z)</b>.";
		}
		
		if (!preg_match('/[a-ząćęłńóśźż]+$/u', $_POST["firstName"])) {
			$errors[] = "<b>Imię może zawierać jedynie litery (a-z)</b>.";
		}

		if (!preg_match('/^([A-ZĄĆĘŁŃÓŚŹŻ])/u', $_POST["lastName"])) {
			$errors[] = "<b>Nazwisko musi się zaczynać z dużej litery (A-Z)</b>.";
		}
		
		if (!preg_match('/[a-ząćęłńóśźż]+$/u', $_POST["lastName"])) {
			$errors[] = "<b>Nazwisko może zawierać jedynie litery (a-z)</b>.";
		}	
		
		if ($_POST["email"] != $_POST["confirm_email"])
			$errors[] = "<b>Adresy email muszą być identyczne</b>.";

		if ($_POST["pass"] != $_POST["confirm_pass"])
			$errors[] = "<b>Hasła muszą być identyczne</b>.";

		if (!isset($_POST["terms"]))
			$errors[] = "<b>Zatwierdź regulamin</b>.";

		if (!empty($errors)){
			print_r($errors);
			echo "test: ".$errors[0];
			$_SESSION['error_message'] = implode("<br>", $errors);
			echo "<script>history.back();</script>";
			exit();
		}

		foreach ($_POST as $key => $value){
			${$key} = sanitizeInput($value);
		}
		require_once "./connect.php";

		try{
			$role = "student";
			$stmt = $conn->prepare("INSERT INTO `users` (`email`, `firstName`, `lastName`, `birthday`, `password`, `role`) VALUES (?, ?, ?, ?, ?, ?)");

			$pass = password_hash($pass, PASSWORD_ARGON2ID);
			$stmt->bind_param("ssssss", $email, $firstName, $lastName, $birthday, $pass, $role);
			if ($stmt->execute()){
				$_SESSION["success"] = "Prawidłowo dodano użytkownika $firstName $lastName";
				header("location: ../pages/view");
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
