<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DziennikLTE | Uczeń</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="layout-top-nav" style="height: auto;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="student.php" class="navbar-brand">
        <span class="brand-text font-weight-dark"><b>Dziennik</b>LTE</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="student.php" class="nav-link">Oceny</a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Wyloguj</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Oceny</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Przedmiot</th>
                  <th>Data</th>
                  <th>Ocena</th>
                  <th>Prowadzący</th>
                </tr>
              </thead>
              <tbody>
                <!-- Tutaj zostaną wyświetlone oceny z bazy danych -->
                <?php
                // Pobierz identyfikator użytkownika z sesji
                $studentId = $_SESSION["id"];

                $conn = new mysqli("localhost", "root", "", "projekt_db");

                if ($conn->connect_error) {
                    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT oceny.przedmiot, oceny.data_oceny, oceny.ocena, users.firstName, users.lastName, nauczyciele.firstName AS prowadzacyFirstName, nauczyciele.lastName AS prowadzacyLastName 
                                      FROM oceny 
                                      INNER JOIN users ON oceny.user_id = users.id 
                                      INNER JOIN users AS nauczyciele ON oceny.nauczyciel_id = nauczyciele.id 
                                      WHERE oceny.user_id = '$studentId'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["przedmiot"] . "</td>";
                        echo "<td>" . $row["data_oceny"] . "</td>";
                        echo "<td>" . $row["ocena"] . "</td>";
                        echo "<td>" . $row["prowadzacyFirstName"] . " " . $row["prowadzacyLastName"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Brak ocen</td></tr>";
                }

                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
