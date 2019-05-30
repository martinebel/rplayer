<?php
include 'header.php';
?>
<link href="../assets/vendor/morrisjs/morris.css" rel="stylesheet" type="text/css">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="padding-top:20px">


        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Visitas Totales</div>
                      <?php
                      $stmt = $dbh->prepare("SELECT count(*) as total from cliente");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                      foreach($result as $row){
                        $total=$row["total"];
                      }
                       ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Visitas de Hoy</div>
                      <?php
                      $stmt = $dbh->prepare("SELECT count(*) as total from cliente where fecha='".date('Y-m-d')."'");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                      foreach($result as $row){
                        $total=$row["total"];
                      }
                       ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Visitas Diarias</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div id="myAreaChart"></div>

                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Visitas por Grupo</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div id="myPieChart"></div>


                </div>
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
      <!-- Page level plugins -->
      <script src="../assets/vendor/raphael/raphael.min.js"></script>
      <script src="../assets/vendor/morrisjs/morris.min.js"></script>

      <script>
      $(function() {

        Morris.Donut({
            element: 'myPieChart',
            data: [
            <?php
            $datos="";
            $stmt = $dbh->prepare("SELECT grupo.idgrupo,grupo.nombre,coalesce(count(clientexgrupo.idcliente),0) as clientes FROM `grupo` LEFT  join clientexgrupo on clientexgrupo.idgrupo=grupo.idgrupo group by grupo.idgrupo,grupo.nombre");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row){
            $datos.= "{label: '".$row['nombre']."',value: ".$row['clientes']."},";
            }

        $datos=substr($datos,0,-1);
        echo $datos;
        ?>

             ],
             colors: ['#34495E', '#26B99A',  '#666', '#3498DB'],
      labels: ['Visitas'],
      hideHover: true,
      parseTime: false,
            pointSize: 2
        });

      });

      $(function() {

        Morris.Line({
            element: 'myAreaChart',
            data: [
            <?php
            $datos="";
            $stmt = $dbh->prepare("SELECT coalesce(count(cliente.idcliente),0) as total,day(fecha) as dia,month(fecha) as mes,year(fecha) as ano FROM `cliente` group by fecha");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row){
            $datos.= "{fecha: '".date('d/m', mktime(0, 0, 0, $row['mes'], $row['dia'],$row['ano']))."',value: ".$row['total']."},";
            }

        $datos=substr($datos,0,-1);
        echo $datos;
        ?>

             ],
             colors: ['#34495E', '#26B99A',  '#666', '#3498DB'],
             xkey: 'fecha',
 ykeys: ['value'],
      labels: ['Visitas'],
      hideHover: true,
      parseTime: false,
            pointSize: 2
        });

      });
      </script>
