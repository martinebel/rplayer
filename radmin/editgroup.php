<?php
include 'header.php';
$stmt = $dbh->prepare("SELECT * from grupo where idgrupo=".$_REQUEST['id']);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
  $nombregrupo=$row["nombre"];
  $imagen=$row["imagen"];
  $archivo=$row["archivo"];
}
?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" style="padding-top:20px">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Editar Grupo: <strong><?php echo $nombregrupo; ?></strong></h1>



          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
              <form id="formulario" action="editGroupHelper.php" method="post" enctype="multipart/form-data">
              <div class="row">

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label>Nombre del Grupo*</label>
                      <input type="text" class="form-control form-control-user" name="nombre" value="<?php echo $nombregrupo; ?>" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group" id="audiogroup">
                      <label>Archivo de Audio* <small class="text-info">Sólo .mp3</small></label>
                      <?php if($archivo=="")
                      {
                        echo '<input type="file" class="form-control form-control-user" name="archivo" id="archivo" required="">';
                      }
                      else {
                      echo '<p id="naudio">'.$archivo.'&nbsp;<a href="#" id="subiraudio">Cambiar</a></p>';
                      }
                      ?>

                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group" id="imggroup">
                      <label>Imagen <small class="text-info">Recomendado: 1920x1080px</small></label>
                      <?php if($imagen=="")
                      {
                        echo '<input type="file" class="form-control form-control-user" name="imagen" id="imagen" >';
                      }
                      else {
                      echo '<p id="nimg">'.$imagen.'&nbsp;<a href="#" id="subirimg">Cambiar</a></p>';
                      }
                      ?>


                    </div>
                  </div>
  <div class="col-md-12 col-xs-12">

    <small><strong>Tamaño máximo de archivo: <?php echo  ini_get('post_max_size');?></strong></small>
    <br>
      <hr>
                    <a href="admingroups.php" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Cancelar</a>
                    <input type="submit" value="Guardar" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idgroup" value="<?php echo $_REQUEST['id']; ?>">
          </div>

              </div>
              </form>
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
  $(document).on("click","#subiraudio",function(e){
    $("#naudio").remove();
    $("#audiogroup").append('<input type="file" class="form-control form-control-user" name="archivo" id="archivo" required="">');
  });

  $(document).on("click","#subirimg",function(e){
    $("#nimg").remove();
    $("#imggroup").append('<input type="file" class="form-control form-control-user" name="imagen" id="imagen">');
  });
</script>
