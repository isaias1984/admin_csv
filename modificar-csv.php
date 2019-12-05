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
        Listado de Campos
        <small>Aquí podrás editar o borrar los campos de tu CSV</small>
      </h1>
    </section>

    <?php
      $fila = 0;
      $cabeceras = [];

      if (($gestor = fopen("csv/galletas.csv", "r")) !== FALSE) {
          while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE && $fila == 0) {
              $numero = count($datos);
              for ($i=0; $i < $numero; $i++) {
                  $cabeceras[]=$datos[$i];
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
              <h3 class="box-title">Agrega los Campos en esta sección</h3>
              <a href="#" data-id="<?php echo $i;?>" data-tipo="csv" class="btn bg-green btn-flat pull-right add-csv-field">
                <i class="fa fa-plus"></i>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Campos</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    for ($i=0; $i < count($cabeceras); $i++) { 
                      ?>
                        <tr>
                          <td><?php echo $cabeceras[$i];?></td>
                          <td>
                            <a href="#" data-id="<?php echo $i;?>" data-tipo="csv" class="btn bg-orange btn-flat margin edit-csv-field">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" data-id="<?php echo $i;?>" data-tipo="csv" class="btn bg-maroon btn-flat margin delete-csv-field">
                                <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Campos</th>
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