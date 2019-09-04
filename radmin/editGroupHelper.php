<?php
include 'header.php';

if ($_POST['action']=="edit")
{
  $query ="update grupo set nombre='".$_POST["nombre"]."'";
  if(isset($_FILES["archivo"]["name"])) //audio
  {
    $target_dir = "../assets/files/groups/";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
      $query.=", archivo='".basename($_FILES["archivo"]["name"])."'";
    }
  }

  if(isset($_FILES["imagen"]["name"])) //imagen
  {
    $target_dir = "../assets/files/groups/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
      $query.=", imagen='".basename($_FILES["imagen"]["name"])."'";
    }
  }

  $query.=" where idgrupo=".$_POST["idgroup"];
  $stmt = $dbh->prepare($query);
  $stmt->execute();
}

if ($_POST['action']=="add")
{
  $query ="insert into grupo (idgrupo,nombre,archivo,imagen) values(null,'".$_POST["nombre"]."'";
  if(isset($_FILES["archivo"]["name"])) //audio
  {
    $target_dir = "../assets/files/groups/";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
      $query.=",'".basename($_FILES["archivo"]["name"])."'";
    }
  }
  else{$query.=",''";}

  if($_FILES["imagen"]["name"]!="") //imagen
  {
    $target_dir = "../assets/files/groups/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
      $query.=", '".basename($_FILES["imagen"]["name"])."'";
    }
  }else{$query.=",''";}

  $query.=")";
  $stmt = $dbh->prepare($query);
  $stmt->execute();
}

if (isset($_REQUEST["action"]))
{
  if($_REQUEST["action"]=="delete")
  {
    $query.="delete from grupo where idgrupo=".$_REQUEST["id"];
    $stmt = $dbh->prepare($query);
    $stmt->execute();
  }
}
//echo $query;
echo '<script>window.location.href="admingroups.php";</script>';
exit(0);
?>
