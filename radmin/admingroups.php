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
          <h1 class="h3 mb-2 text-gray-800">Administrar Grupos</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-body">
              <a href="addgroup.php" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> Crear Grupo</a>
              <p></p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Clientes</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmt = $dbh->prepare("SELECT grupo.idgrupo,grupo.nombre,count(clientexgrupo.idcliente) as clientes FROM `grupo` inner join clientexgrupo on clientexgrupo.idgrupo=grupo.idgrupo group by grupo.idgrupo,grupo.nombre");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $row){
                      echo '<tr>
                        <td>'.$row["nombre"].'</td>
                        <td>'.$row["clientes"].'</td>
                        <td><a href="editgroup.php?id='.$row["idgrupo"].'" class="btn btn-secondary"><i class="fas fa-fw fa-edit"></i> Editar</a>
                        <a href="managegroup.php?id='.$row["idgrupo"].'" class="btn btn-primary"><i class="fas fa-fw fa-cog"></i> Administrar</a></td>
                        </tr>';


                    }
                     ?>
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
