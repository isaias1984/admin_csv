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

if(isset($_POST['registro']) && ($_POST['registro'] == 'nuevo' || $_POST['registro'] == 'actualizar')) {
 
  if ($_POST['registro'] == 'nuevo') { 
  
    $lista = [];

    for ($i=0; $i < count($archivo[0]); $i++) { 
      if ( $_POST[$archivo[0][$i]] === "") {
        $respuesta = array(
          'respuesta' => 'empty'
        );
        die(json_encode($respuesta));
      } else {
        $lista[] = $_POST[$archivo[0][$i]];
      }
      
    }

    if (($gestor = fopen("csv/galletas.csv", "a")) !== FALSE) {
      fputcsv($gestor, $lista);
      
      $respuesta = array(
        'respuesta' => 'exito',
        'id_insertado' => count($archivo)
      );

      die(json_encode($respuesta));
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
    }
    
    fclose($gestor);
  } 

  if ($_POST['registro'] == 'actualizar') { 
      
    for ($j=0; $j < count($archivo[$i]); $j++) { 
      $archivo[$_POST['id_registro']][$j] = $_POST[$archivo[0][$j]];
    }    

    if (($gestor = fopen("csv/galletas.csv", "w")) !== FALSE) {
      foreach ($archivo as $campos) {
        fputcsv($gestor, $campos);
      }
      $respuesta = array(
        'respuesta' => 'exito',
        'id_insertado' => $_POST['id_registro']
      );
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
    }
    
    fclose($gestor);

    die(json_encode($respuesta));
  }
}

if (isset ($_POST['registro']) && $_POST['registro'] == 'eliminar') {
  
  unset($archivo[$_POST['id']]);

  if (($gestor = fopen("csv/galletas.csv", "w")) !== FALSE) {
    foreach ($archivo as $campos) {
      fputcsv($gestor, $campos);
    }
    $respuesta = array(
      'respuesta' => 'exito',
      'id_eliminado' => $_POST['id']
    );
  } else {
    $respuesta = array(
      'respuesta' => 'error'
    );
  }

  die(json_encode($respuesta));
}

if (isset ($_POST['registro']) && $_POST['registro'] == 'modificar') {

  $archivo[0][count($archivo[0])] = $_POST['campo'];

  for ($i=1; $i < count($archivo); $i++) { 
    $archivo[$i][count($archivo[$i])] = "";  
  } 

  if (($gestor = fopen("csv/galletas.csv", "w")) !== FALSE) {
    foreach ($archivo as $campos) {
      fputcsv($gestor, $campos);
    }
    $respuesta = array(
      'respuesta' => 'exito',
      'campo_num' => count($archivo[0])
    );
  } else {
    $respuesta = array(
      'respuesta' => 'error'
    );
  } 

  die(json_encode($respuesta));
}

if (isset ($_POST['registro']) && $_POST['registro'] == 'editar') {
  
 $archivo[0][$_POST['id']] = $_POST['valor'];

  if (($gestor = fopen("csv/galletas.csv", "w")) !== FALSE) {
    foreach ($archivo as $campos) {
      fputcsv($gestor, $campos);
    }
    $respuesta = array(
      'respuesta' => 'exito',
      'campo_num' => count($archivo[0])
    );
  } else {
    $respuesta = array(
      'respuesta' => 'error'
    );
  }
  
  die(json_encode($respuesta));

}

if (isset ($_POST['registro']) && $_POST['registro'] == 'borrar') {
   
  $archivo2 = [];

  for ($i=0; $i < count($archivo) ; $i++) {
    for ($j=0; $j < count($archivo[$i]); $j++) { 
      if ( $j < $_POST['id']) {
        $archivo2[$i][$j] = $archivo[$i][$j];
      } else if ($j > $_POST['id']) {
        $archivo2[$i][$j-1] = $archivo[$i][$j];
      }
    }
  } 
    
  if (($gestor = fopen("csv/galletas.csv", "w")) !== FALSE) {
    foreach ($archivo2 as $campos) {
      fputcsv($gestor, $campos);
    }
    $respuesta = array(
      'respuesta' => 'exito',
      'id_eliminado' => $_POST['id']
    );
  } else {
    $respuesta = array(
      'respuesta' => 'error'
    );
  }

  die(json_encode($respuesta));
}
?>