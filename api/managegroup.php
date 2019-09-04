<?php
require '../db.php';
$array=array();
switch($_REQUEST['action'])
{

  case "getStatus":
  $stmt = $dbh->prepare("SELECT cliente.nombre,cliente.idcliente,clientexgrupo.status FROM `clientexgrupo` inner join cliente on cliente.idcliente=clientexgrupo.idcliente where cliente.fecha>='".date('Y-m-d')."' and idgrupo=".$_REQUEST["idGroup"]);
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){

    	array_push($array,array(
        "nombre"=> $row["nombre"],
        "identificacion"=>$row["idcliente"],
        "estado"=>$row["status"]
      ));
    }
  echo json_encode($array);

  break;

  case 'playClient':
  $stmt = $dbh->prepare("update clientexgrupo set  `status` =1 where idcliente='".$_REQUEST["idClient"]."'");
  $stmt->execute();
  $result = $stmt->fetchAll();
  break;

  case 'deleteClient':
  $stmt = $dbh->prepare("delete from clientexgrupo where idcliente='".$_REQUEST["idClient"]."'");
  $stmt->execute();
  $stmt = $dbh->prepare("delete from cliente where idcliente='".$_REQUEST["idClient"]."'");
  $stmt->execute();
  break;

  case 'playAll':
  $stmt = $dbh->prepare("update clientexgrupo set  `status` =1 where idgrupo='".$_REQUEST["idGroup"]."'");
  $stmt->execute();
  $result = $stmt->fetchAll();
  break;

  case 'stopClient':
  $stmt = $dbh->prepare("update clientexgrupo set  `status` =0 where idcliente='".$_REQUEST["idClient"]."'");
  $stmt->execute();
  $result = $stmt->fetchAll();
  break;
}
?>
