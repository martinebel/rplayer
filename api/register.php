<?php
require '../db.php';
$array=array();
switch($_REQUEST['action'])
{
  case "getGroups":
  $stmt = $dbh->prepare("select * from grupo");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){
  	array_push($array,array("idgrupo"=> $row["idgrupo"],"nombre"=>mb_strtoupper($row["nombre"],'UTF-8')));

  }
  echo json_encode($array);
  break;

  case "getConfig":
  $stmt = $dbh->prepare("select * from config");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){
    array_push($array,array("appname"=> $row["nombre"],"logo"=>'assets/files/config/'.$row["logo"]));

  }
  echo json_encode($array);
  break;

  case "register":
  //insert client data into database
  $nombre=$_REQUEST["nombre"];
  $grupo=$_REQUEST["grupo"];
  $key=$_REQUEST["key"];
  $lastID=0;
  $stmt = $dbh->prepare("insert into cliente (idcliente,nombre,identificacion,fecha) values (null,'".$nombre."','".$key."','".date('Y-m-d')."')");
  $stmt->execute();
  //get last inserted ID
  $stmt = $dbh->prepare("select max(idcliente) as maximo from cliente");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){
  	$lastID=$row["maximo"];
  }
  //insert client into group
  $stmt = $dbh->prepare("insert into clientexgrupo (idcliente,idgrupo,status) values ('".$lastID."','".$grupo."',0)");
  $stmt->execute();
  echo json_encode($lastID);
  break;
}
?>
