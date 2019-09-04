<?php
include 'header.php';
?>

<style>
img {width: 150px;}
</style>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" style="padding-top:20px">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Codigos QR</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
              <?php
                include('../api/phpqrcode/qrlib.php');
              $host= gethostname();
              $ip = gethostbyname($host);
              $carpeta= split('/',$_SERVER["REQUEST_URI"]);
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
              ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php
      include 'footer.php';
      ?>
