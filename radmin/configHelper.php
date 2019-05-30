<?php
include 'header.php';

  $query ="update config set nombre='".$_POST["nombre"]."'";

  if(isset($_FILES["imagen"]["name"])) //imagen
  {
    $target_dir = "../assets/files/config/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
      $query.=", logo='".basename($_FILES["imagen"]["name"])."'";
    }
  }

  $stmt = $dbh->prepare($query);
  $stmt->execute();


//echo $query;
echo '<script>window.location.href="index.php";</script>';
exit(0);
?>
