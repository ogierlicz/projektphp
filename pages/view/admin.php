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
      <a href="admin.php" class="navbar-brand">
        <span class="brand-text font-weight-dark"><b>Dziennik</b>LTE</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Oceny</a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Plan zajęć</a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Użytkownicy</a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Wyloguj</a>
          </li>
            </ul>
          </li>
        </ul>
</nav>


  <div class="card-header">
  <h3 class="card-title">Użytkownicy</h3>
</div>
<?php
if (isset($_GET['userIdDelete'])) {
	$deletedUserId = $_GET['userIdDelete'];
	if ($deletedUserId == 0) {
		echo "<h4>Nie znaleziono użytkownika do usunięcia</h4>";
	} else {
		echo "<h4>Usunięto rekord o ID: $deletedUserId</h4>";
	}
}

if (isset($_GET["addUser"])){
  if ($_GET["addUser"] == 0){
    echo "<h4>Nie udało się dodać użytkownika!</h4>";
  }else{
    echo "<h4>Dodano nowego użytkownika</h4>";
  }
}

if (isset($_GET["updateUser"])){
	if ($_GET["updateUser"] == 0){
		echo "<h4>Nie udało się zaktualizować użytkownika!</h4>";
	}else{
		echo "<h4>Zaktualizowano użytkownika</h4>";
	}
  unset($_SESSION["userUpdateId"]);
}
?>

<table class="table table-hover">
	<tr>
		<th>Imię</th>
		<th>Nazwisko</th>
		<th>Email</th>
		<th>Hasło</th>
		<th>Data urodzenia</th>
    <th>Rola</th>
	</tr>

	<?php
	require_once "../../scripts/connect.php";
	$sql = "SELECT id userId, firstName, lastName, email, password, birthday, role FROM users";
	$result = $conn->query($sql);
	//echo $result->num_rows;

	if ($result->num_rows == 0){
		echo "<tr><td colspan='100%'>Brak rekordów do wyświetlenia</td></tr>";
	}else{
		while($user = $result->fetch_assoc()){
			echo <<< TABLEUSERS
      <tr>
        <td>$user[firstName]</td>
        <td>$user[lastName]</td>
        <td>$user[email]</td>
        <td>$user[password]</td>
        <td>$user[birthday]</td>
        <td>$user[role]</td>
        <td><a href="../../scripts/delete_user.php?userDeleteId=$user[userId]">Usuń</a></td>
        <td><a href="./admin.php?userUpdateId=$user[userId]">Edytuj</a></td>
      </tr>
TABLEUSERS;
		}
	}
	echo "</table><hr>";

 //formularz dodawania użytkownika
  if (isset($_GET["showFormAddUser"])){
    echo "<h4>Dodawanie użytkownika</h4>";
    echo <<< ADDUSERFORM
      <form action="../../scripts/addUser.php" method="POST">
        <input type="text" name="firstName" placeholder="Podaj imię"><br><br>
        <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
        <input type="text" name="email" placeholder="Podaj email"><br><br>
        <input type="text" name="password" placeholder="Podaj hasło"><br><br>
        <input type="date" name="birthday"> Data urodzenia <br><br>
        <select name="role">
<!--        <input type="number" name="role" placeholder="Podaj rolę"><br><br>-->
ADDUSERFORM;
      //rola
      $sql = "SELECT DISTINCT role FROM users;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      while ($role = $result->fetch_assoc()){
        echo "<option value='$role[id]'>$role[role]</option>";
      }
    }
	  echo <<< ADDUSERFORM
    </select><br><br>
        <input type="submit" value="Dodaj użytkownika">
      </form>
ADDUSERFORM;
  }else{
    echo '<a href="./admin.php?showFormAddUser=1">Dodaj użytkownika</a>';
  }

	// formularz aktualizacji użytkownika
if (isset($_GET["userUpdateId"])){
  $_SESSION["userUpdateId"] = $_GET["userUpdateId"];
  echo "<h4>Aktualizacja użytkownika</h4>";
  $sql = "SELECT * FROM users WHERE users.`id`='$_GET[userUpdateId]'";
  $result = $conn->query($sql);
  $updateUser = $result->fetch_assoc();

  echo <<< UPDATEUSERFORM
    <form action="./scripts/updateUser.php" method="POST">
      <input type="text" name="firstName" value="$updateUser[firstName]"><br><br>
      <input type="text" name="lastName" value="$updateUser[lastName]"><br><br>
      <input type="text" name="email" value="$updateUser[email]"><br><br>
      <input type="text" name="password" value="$updateUser[password]"><br><br>
      <input type="date" name="birthday" value="$updateUser[birthday]"> Data urodzenia <br><br>
      <select name="role">
UPDATEUSERFORM;

  // rola
  $sql = "SELECT DISTINCT role FROM users;";
  $result = $conn->query($sql);
  while ($role = $result->fetch_assoc()) {
    if ($role["role"] == $updateUser["role"]) {
      echo "<option value='$role[role]' selected>$role[role]</option>";
    } else {
      echo "<option value='$role[role]'>$role[role]</option>";
    }
  }

  echo <<< UPDATEUSERFORM
      </select><br><br>
      <input type="submit" value="Aktualizuj użytkownika">
    </form>
UPDATEUSERFORM;
}


	$conn->close();
	?>


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

                $result = $conn->query("SELECT o.przedmiot, o.data_oceny, CONCAT(u.firstName, ' ', u.lastName) AS uczen, o.ocena FROM oceny o JOIN users u ON o.user_id = u.id WHERE u.role = 'student'");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["przedmiot"] . "</td>";
                        echo "<td>" . $row["data_oceny"] . "</td>";
                        echo "<td>" . $row["uczen"] . "</td>";
                        echo "<td>" . $row["ocena"] . "</td>";
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
                <input type="text" name="przedmiot" id="przedmiot" class="form-control">
              </div>
              <div class="form-group">
                <label for="ocena">Ocena:</label>
                <input type="text" name="ocena" id="ocena" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




</body>