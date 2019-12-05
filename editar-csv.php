<?php
  if ($_GET) {
    $id = $_GET['id']; 
    if(!filter_var($id, FILTER_VALIDATE_INT)){
        die("Error!");
    }
  }
  include_once 'includes/templates/header.php';
  include_once 'includes/templates/barra.php';
  include_once 'includes/templates/navegacion.php';
?>
<?php
    $fila = 0;
    $cabeceras = [];
    $archivo = [];

    if (($gestor = fopen("csv/galletas.csv", "r")) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            $numero = count($datos);
            if($fila == 0) {
                for ($i=0; $i < $numero; $i++) {
                    $cabeceras[]=$datos[$i];
                }
            } elseif ($fila == $id) {
                for ($i=0; $i < $numero; $i++) {
                    $archivo[]=$datos[$i];
                }
            }
            $fila++;
        }
        fclose($gestor);
    }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Producto
        <small>llena el formulario para editar un producto</small>
      </h1>
    </section>
    <div class="row">
        <div class="col-md-8">
                <!-- Main content -->
            <section class="content">
            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Editar Producto</h3>
                    </div>
                    <!-- /.box-body -->
                    <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-csv.php">
                        <div class="box-body">
                            <?php
                                for ($i=0; $i < count($archivo); $i++) { 
                                    ?>
                                    <div class="form-group">
                                        <label for="<?php echo $cabeceras[$i];?>"><?php echo $cabeceras[$i];?>:</label>
                                        <input type="text" class="form-control" id="<?php echo $cabeceras[$i];?>" name="<?php echo $cabeceras[$i];?>" placeholder="<?php echo $archivo[$i];?>" value="<?php echo $archivo[$i];?>">
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>                
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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