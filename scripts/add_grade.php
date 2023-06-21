<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uczenId = $_POST["uczen"];
    $przedmiot = $_POST["przedmiot"];
    $ocena = $_POST["ocena"];
  
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
    $insertQuery = "INSERT INTO oceny (user_id, przedmiot, ocena) VALUES ($uczenId, '$przedmiot', $ocena)";
  
    if ($conn->query($insertQuery) === TRUE) {
        echo "Ocena została dodana.";
    } else {
        echo "Wystąpił błąd podczas dodawania oceny: " . $conn->error;
    }
  
    $conn->close();
}
?>
