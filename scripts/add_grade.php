<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: ../pages/view/teacher.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uczenId = $_POST["uczen"];
    $przedmiot = $_POST["przedmiot"];
    $ocena = $_POST["ocena"];

    // Pobierz identyfikator nauczyciela z sesji
    $nauczycielId = $_SESSION["id"];
    if (isset($_SESSION['id'])) {
        $nauczycielId = $_SESSION["id"];
    }
    else{
        echo "Błąd";
    }

    $conn = new mysqli("localhost", "root", "", "projekt_db");

    if ($conn->connect_error) {
        die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
    }

    // Sprawdź, czy wybrany uczeń istnieje
    $checkQuery = "SELECT id FROM users WHERE id = $uczenId AND role = 'student'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows == 0) {
        echo "Wybrany uczeń nie istnieje.";
        $conn->close();
        exit;
    }

    // Dodaj ocenę do bazy danych
    $insertQuery = "INSERT INTO oceny (user_id, przedmiot, ocena, data_oceny, nauczyciel_id) VALUES ($uczenId, '$przedmiot', $ocena, CURDATE(), $nauczycielId)";

    if ($conn->query($insertQuery) === TRUE) {
        // redirect("../pages/view/teacher.php");
        // header('Location: '.$_SERVER['PHP_SELF']);
        // die;
        $checkroleQuery = "SELECT role FROM users WHERE id = $nauczycielId";
        $checkroleResult = $conn->query($checkroleQuery);
        $rowRole = $checkroleResult->fetch_assoc();
        $role = $rowRole['role'];
        if ($role == "teacher"){
            header("Location: ../pages/view/teacher.php");
        }
        elseif($role == "admin"){
            header("Location: ../pages/view/admin.php");
        }
    } else {
        echo "Wystąpił błąd podczas dodawania oceny: " . $conn->error;
    }
    
    $conn->close();
}
?>
