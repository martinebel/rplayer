<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Martin Ebel">

  <title>rPlayer</title>

  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <style>
  img {width: 150px;}
  </style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-xl-8 col-lg-8 col-md-8 col-xs-12">

        <div class="card o-hidden border-0 shadow-lg my-5" id="step1">
          <div class="card-body p-0">

            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4" id="nombreGrupo">Instalación rPlayer</h1>
              </div>
              <p>
                <?php
                  include('../api/phpqrcode/qrlib.php');
                try {
                $dbh = new PDO('mysql:host=localhost;dbname=information_schema', 'root', '');
                } catch(Exception $e) {
                 exit('<p class="text-danger text-center"><i class="fa fa-times"></i> Error conectando al Motor de Base de Datos</p>');
                }
                $dbh->query("CREATE DATABASE IF NOT EXISTS `rplayer` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
                USE `rplayer`;

                CREATE TABLE `archivos` (
                  `idarchivo` int(11) NOT NULL,
                  `idgrupo` int(11) NOT NULL,
                  `archivo` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                CREATE TABLE `cliente` (
                  `idcliente` int(11) NOT NULL,
                  `nombre` text NOT NULL,
                  `identificacion` text NOT NULL,
                  `fecha` datetime NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


                CREATE TABLE `clientexgrupo` (
                  `idcliente` int(11) NOT NULL,
                  `idgrupo` int(11) NOT NULL,
                  `status` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                CREATE TABLE `config` (
                  `nombre` text NOT NULL,
                  `logo` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                INSERT INTO `config` (`nombre`, `logo`) VALUES
                ('rPlayer', 'iStock-636156852.jpg');

                CREATE TABLE `grupo` (
                  `idgrupo` int(11) NOT NULL,
                  `nombre` text NOT NULL,
                  `imagen` text NOT NULL,
                  `archivo` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                INSERT INTO `grupo` (`idgrupo`, `nombre`, `imagen`, `archivo`) VALUES
                (1, 'Grupo de Prueba', 'testGroup.jpg', 'testAudio.mp3');


                ALTER TABLE `archivos`
                  ADD PRIMARY KEY (`idarchivo`);

                ALTER TABLE `cliente`
                  ADD PRIMARY KEY (`idcliente`);

                ALTER TABLE `grupo`
                  ADD PRIMARY KEY (`idgrupo`);


                ALTER TABLE `archivos`
                  MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT;

                ALTER TABLE `cliente`
                  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

                ALTER TABLE `grupo`
                  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;") or die(print_r($dbh->errorInfo()));

                  try {
                  $dbh = new PDO('mysql:host=localhost;dbname=rplayer', 'root', '');
                  } catch(Exception $e) {
                   exit('<p class="text-danger text-center"><i class="fa fa-times"></i> No se puede conectar a la base de datos</p>');
                  }
                  echo '<p class="text-success text-center"><i class="fa fa-check"></i> Base de datos creada!</p>';
                  $host= gethostname();
                  $ip = gethostbyname($host);
                  $carpeta= split('/',$_SERVER["REQUEST_URI"]);
                  echo '<p>Para ingresar al panel de administracion, vaya a <a href="http://'.$ip."/".$carpeta[1].'/radmin">http://'.$ip."/".$carpeta[1].'/radmin</a></p>';
                  echo '<p>Sus clientes deben ingresar al reproductor en <a href="http://'.$ip."/".$carpeta[1].'">http://'.$ip."/".$carpeta[1].'</a></p>';
                  echo '<hr>';
                  echo '<p class=" text-center">Puede usar estos códigos QR para facilitar el acceso.<br>Los puede volver a generar en cualquier momento desde el panel de administracion.</p>';

                  echo '<div class="row"><div class="col-md-6 text-center">';
                  $tempDir = "../assets/img/";
                  $codeContents = 'http://'.$ip."/".$carpeta[1].'/radmin';
                  $fileName = 'QRCode_Admin.png';
                  $pngAbsoluteFilePath = $tempDir.$fileName;
                  QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 10);
                  echo '<a href="'.$pngAbsoluteFilePath.'" target="_blank"><img src="'.$pngAbsoluteFilePath.'" /></a>';
                  echo '<p><small>Panel de Administracion<br>http://'.$ip."/".$carpeta[1].'/radmin</small></p></div><div class="col-md-6  text-center">';
                  $codeContents = 'http://'.$ip."/".$carpeta[1];
                  $fileName = 'QRCode_Clientes.png';
                  $pngAbsoluteFilePath = $tempDir.$fileName;
                  QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 10);
                  echo '<a href="'.$pngAbsoluteFilePath.'" target="_blank"><img src="'.$pngAbsoluteFilePath.'" /></a>';
                  echo '<p><small>Reproductor para Clientes<br>http://'.$ip."/".$carpeta[1].'</small></p></div></div><hr>';
                  echo '<p>No es necesario que vuelva a ingresar a esta instalación. Si lo desea, puede eliminar la carpeta <strong>install</strong> de su servidor.</p>';
                 ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>
<script>
$("body").css("background-image","url('../assets/files/config/iStock-636156852.jpg')");
$("body").css("background-size","contain");
</script>
