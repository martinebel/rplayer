<?php
include 'header.php';
?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" style="padding-top:20px">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Crear Grupo</h1>



          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
              <form id="formulario" action="editGroupHelper.php" method="post" enctype="multipart/form-data">
              <div class="row">

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label>Nombre del Grupo*</label>
                      <input type="text" class="form-control form-control-user" name="nombre"  required>
                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group" id="audiogroup">
                      <label>Archivo de Audio* <small class="text-info">Sólo .mp3</small></label>
                      <input type="file" class="form-control form-control-user" name="archivo" id="archivo" required="">


                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group" id="imggroup">
                      <label>Imagen <small class="text-info">Recomendado: 1920x1080px</small></label>
                      <input type="file" class="form-control form-control-user" name="imagen" id="imagen" >



                    </div>
                  </div>
  <div class="col-md-12 col-xs-12">

    <small><strong>Tamaño máximo de archivo: <?php echo  ini_get('post_max_size');?></strong></small>
    <br>
      <hr>
                    <a href="admingroups.php" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Cancelar</a>
                    <input type="submit" value="Guardar" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right">
                    <input type="hidden" name="action" value="add">
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
