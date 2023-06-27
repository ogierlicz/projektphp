<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DziennikLTE  | Uczeń</title>

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
      <a href="teacher.php" class="navbar-brand">
        <span class="brand-text font-weight-dark"><b>Dziennik</b>LTE</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="teacher.php" class="nav-link">Wystawianie Ocen</a>
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
                  <th>Uczeń</th>
                  <th>Ocena</th>
                </tr>
              </thead>
              <tbody>
                <!-- Tutaj zostaną wyświetlone oceny z bazy danych -->
                <?php
                $conn = new mysqli("localhost", "root", "", "projekt_db");

                if ($conn->connect_error) {
                    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT o.id, o.przedmiot, o.data_oceny, CONCAT(u.firstName, ' ', u.lastName) AS uczen, o.ocena FROM oceny o JOIN users u ON o.user_id = u.id WHERE u.role = 'student'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["przedmiot"] . "</td>";
                        echo "<td>" . $row["data_oceny"] . "</td>";
                        echo "<td>" . $row["uczen"] . "</td>";
                        echo "<td>" . $row["ocena"] . "</td>";
                        echo "<td><a href='../../scripts/deleteGrade.php?deleteGradeId={$row["id"]}'>Usuń</a></td>";
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

        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title">Dodaj ocenę</h3>
          </div>
          <div class="card-body">
            <form action="../../scripts/add_grade.php" method="POST">
              <div class="form-group">
                <label for="uczen">Uczeń:</label>
                <select name="uczen" id="uczen" class="form-control">
                  <?php
                  $conn = new mysqli("localhost", "root", "", "projekt_db");

                  if ($conn->connect_error) {
                      die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
                  }

                  $result = $conn->query("SELECT id, CONCAT(firstName, ' ', lastName) AS uczen FROM users WHERE role = 'student'");

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row["id"] . "'>" . $row["uczen"] . "</option>";
                      }
                  }

                  $conn->close();
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="przedmiot">Przedmiot:</label>
                <select name="przedmiot" id="przedmiot" class="form-control">
                  <option>Programowanie</option>
                  <option>Matematyka</option>
                  <option>Technologie Internetowe</option>
                  <option>Wychowanie Fizyczne</option>
                  <option>Webdesign</option>
                </select>
              </div>
              <div class="form-group">
                <label for="ocena">Ocena:</label>
                <input type="number" name="ocena" id="ocena" class="form-control" min="1" max="6">
              </div>
              <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
