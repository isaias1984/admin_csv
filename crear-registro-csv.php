<?php
  include_once 'includes/templates/header.php';
  include_once 'includes/templates/barra.php';
  include_once 'includes/templates/navegacion.php';
?>
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

    var_dump($cabeceras);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Crear Registro de Producto
        <small>llena el formulario para crear un nuevo producto</small>
      </h1>
    </section>
    <div class="row">
        <div class="col-md-8">
                <!-- Main content -->
            <section class="content">
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Crear Producto</h3>
                    </div>
                    <!-- /.box-body -->
                    <form role="form" name="nuevo-registro" id="nuevo-registro" method="post" action="modelo-csv.php">
                        <div class="box-body">
                            <?php
                                for ($i=0; $i < count($cabeceras); $i++) { 
                                    ?>
                                    <div class="form-group">
                                        <label for="<?php echo $cabeceras[$i];?>"><?php echo $cabeceras[$i];?>:</label>
                                        <input type="text" class="form-control" id="<?php echo $cabeceras[$i];?>" name="<?php echo $cabeceras[$i];?>" placeholder="<?php echo $cabeceras[$i];?>">
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>                
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'includes/templates/footer.php';