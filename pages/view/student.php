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
            <a href="student.php" class="nav-link">Plan zajęć</a>
          </li>
            </ul>
          </li>
        </ul>
</nav>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Oceny</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Przedmiot</th>
                      <th>Data</th>
                      <th>Prowadzący</th>
                      <th>Ocena</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Elektronika</td>
                      <td>11-7-2014</td>
                      <td>Adam Burdelski</td>
                      <td>5.5</td>
                    </tr>
                    <tr>
                      <td>Programowanie strukturalne</td>
                      <td>11-7-2014</td>
                      <td>Adam Burdelski</td>
                      <td>5.0</td>
                    </tr>
                    <tr>
                      <td>Technologie internetowe</td>
                      <td>11-7-2014</td>
                      <td>Adam Burdelski</td>
                      <td>3.5</td>
                    </tr>
                    <tr>
                      <td>Uczenie maszynowe</td>
                      <td>11-7-2014</td>
                      <td>Adam Burdelski</td>
                      <td>4.0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


</body>