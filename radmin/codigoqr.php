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
              $ip="";
              exec("ipconfig /all", $output);

              foreach($output as $line){
                $line=htmlentities($line,ENT_IGNORE);
                //echo $line;
                if (preg_match("/(.*)IPv4 Address(.*)/", $line)){
                  $ip = $line;
                  $ip = str_replace("IPv4 Address. . . . . . . . . . . :","",$ip);
                  $ip = str_replace("Direccin IPv4. . . . . . . . . . . . . . :","",$ip);
                  $ip = str_replace("(Preferred)","",$ip);
                  $ip = str_replace("(Preferido)","",$ip);
                  break;
                }
                if (preg_match("/(.*)IPv4(.*)/", $line)){
                  $ip = $line;
                  $ip = str_replace("IPv4 Address. . . . . . . . . . . :","",$ip);
                  $ip = str_replace("Direccin IPv4. . . . . . . . . . . . . . :","",$ip);
                  $ip = str_replace("(Preferred)","",$ip);
                  $ip = str_replace("(Preferido)","",$ip);
                  break;
                }
              }
              $host= trim($ip);
              //$host= gethostname();
              $port = ":".$_SERVER['SERVER_PORT'];
              if($port==":80"){$port="";}
              $carpeta= explode('/',$_SERVER["REQUEST_URI"]);
               ?>
               <div class="row">
                 <div class="col-12 form-inline">
                   <div class="form-group ">
                     <label for="ipserver">IP del Servidor </label>
                     <input type="text" id="ipserver" class="form-control ml-2 mr-2" value="<?php echo $host.$port; ?>">
                   </div>
                   <a href="#" id="generateQR" class="btn btn-success">Generar</a>
                 </div>
                 <div class="col-6 text-center"><a href="#" id="linkAdmin" target="_blank"><img id="qrAdmin"></a><p><small id="dataAdmin"></small></div>
                 <div class="col-6 text-center"><a href="#" id="linkCliente" target="_blank"><img id="qrCliente"></a><p><small id="dataCliente"></small></p></div>
               </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php
      include 'footer.php';
      ?>
<script>
generar();

function generar()
{
  $.ajax({
  url: 'qrHelper.php?ip='+$("#ipserver").val(),
  async: true,
  contentType: "application/json",
     success: function(data) {
       var obj=JSON.parse(data);
       $("#qrAdmin").attr('src',obj[0].qrAdmin);
       $("#qrCliente").attr('src',obj[0].qrCliente);
       $("#linkAdmin").attr('href',obj[0].qrAdmin);
       $("#linkCliente").attr('href',obj[0].qrCliente);
       $("#dataAdmin").html('Panel de Administracion<br>'+obj[0].dataAdmin);
       $("#dataCliente").html('Reproductor para Clientes<br>'+obj[0].dataCliente);

      }


  });
}

$(document).on('click','#generateQR',function(e){
  generar();
});
</script>
