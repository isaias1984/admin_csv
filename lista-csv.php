<?php
  include_once 'includes/templates/header.php';
  include_once 'includes/templates/barra.php';
  include_once 'includes/templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Productos
        <small>Aquí podrás editar o borrar los productos de tu CSV</small>
      </h1>
    </section>

    <?php
      $fila = 0;
      $archivo = [];

      if (($gestor = fopen("csv/galletas.csv", "r")) !== FALSE) {
          while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
              $numero = count($datos);
              for ($i=0; $i < $numero; $i++) {
                  $archivo[$fila][]=$datos[$i];
              }
              $fila++;
          }
          fclose($gestor);
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los productos en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?php
                    for ($i=0; $i < count($archivo[0]); $i++) { 
                      echo '<th>' . $archivo[0][$i] . '</th>';
                    }
                  ?>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      for ($j=1; $j < count($archivo); $j++) { 
                        echo '<tr>';
                        for ($k=0; $k < count($archivo[$j]); $k++) { 
                            echo '<td>' . $archivo[$j][$k] . '</td>';
                        }
                        ?>
                          <td>
                            <a href="editar-csv.php?id=<?php echo $j;?>" class="btn bg-orange btn-flat margin">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" data-id="<?php echo $j;?>" data-tipo="csv" class="btn bg-maroon btn-flat margin borrar-registro">
                                <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        <?php
                        echo '</tr>';
                      }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <?php
                    for ($i=0; $i < count($archivo[0]); $i++) { 
                      echo '<th>' . $archivo[0][$i] . '</th>';
                    }
                  ?>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'includes/templates/footer.php';
?>