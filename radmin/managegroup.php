<?php
include 'header.php';

$stmt = $dbh->prepare("SELECT * from grupo where idgrupo=".$_REQUEST['id']);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
  $nombregrupo=$row["nombre"];
}
?>


  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" style="padding-top:20px">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Administrando: <strong><?php echo $nombregrupo;?></strong></h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
              <input type="hidden" id="idgrupo" value="<?php echo $_REQUEST["id"];?>">
              <a href="#" class="btn btn-secondary btn-sm reproducir-todo"><i class="fas fa-fw fa-play"></i> Reproducir Todos</a>
              
              <p></p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody id="tabla">

                  </tbody>
                </table>
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
<script src="../assets/js/actions/managegroup.js"></script>
