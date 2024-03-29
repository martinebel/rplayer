<?php

require '../db.php';

$stmt = $dbh->prepare("SELECT * from config");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
  $apptitle=$row["nombre"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $apptitle.' - Administracion'; ?></title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

        <div class="sidebar-brand-text mx-3"><?php echo $apptitle; ?></div>

      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Grupos
      </div>

      <li class="nav-item">
        <a class="nav-link" href="admingroups.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Administrar</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="addgroup.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Crear</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Config
      </div>

      <li class="nav-item">
        <a class="nav-link" href="config.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Datos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="codigoqr.php">
          <i class="fas fa-fw fa-qrcode"></i>
          <span>Codigos QR</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
