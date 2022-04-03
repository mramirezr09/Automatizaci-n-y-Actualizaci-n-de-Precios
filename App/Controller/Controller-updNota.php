<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);

  $pi = $_GET['pi'];
  $nota = $_GET['nota'];
  $ar = $_GET['ar'];
  $fechaA = date('Y-m-d H:m:s');

  if($ar == 3){
    $query = "
    UPDATE `adg.registros_compras`
    SET
      Notas = '$nota',
      Fecha_Actualiza = '$fechaA'
    WHERE
      PK_IdRegistroc = '$pi'
    ";
    // var_dump($query);
    $upd = $conn -> query($query);
    // print_r($upd);
  }
  else if($ar == 4){
    $query = "
    UPDATE `adg.registros`
    SET
      Notas = '$nota',
      Fecha_Actualiza = '$fechaA'
    WHERE
      PK_IdRegistro = '$pi'
    ";
    // var_dump($query);
    $upd = $conn -> query($query);
    // print_r($upd);
  }
