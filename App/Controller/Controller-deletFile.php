<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);
  $idn = $_GET['idn'];

  $del = "SELECT
  t2.Clave_Empresa as 'fie',
  t3.Nombre_Area as 'fia',
  FK_IdArea as 'ida',
  Nombre_Archivo as 'na'
  FROM `adg.archivos` t1
  left join `adg.empresa`t2 on t2.PK_IdEmpresa = t1.FK_IdEmpresa
  left join `adg.area`t3 on t3.PK_IdArea = t1.FK_IdArea
  WHERE
  PK_IdArchivo = '$idn'
  ";
  $del = $conn -> query($del);

  while ($d = mysqli_fetch_array($del)) {
    $empresa = $d['fie'];
    $area = $d['fia'];
    $namef = $d['na'];
    $ida = $d['ida'];
  }

  print_r($area);
  $query = "
  UPDATE `adg.archivos`
  SET
    FK_IdStatus_Archivo = 5,
    Status = 0
  WHERE
    PK_IdArchivo = '$idn'
  ";
  $upd = $conn -> query($query);

  if ($ida == 3) {
    $delr = "
    UPDATE `adg.registros_compras`
    SET
    Status = 0
    WHERE
    FK_IdArchivo = '$idn'
    ";
  }
  else if ($ida == 4) {
    $delr = "
    UPDATE `adg.registros`
    SET
    Status = 0
    WHERE
    FK_IdArchivo = '$idn'
    ";
  }
  $delr = $conn -> query($delr);


  $ruta = "C:/xampp/htdocs/Proyecto/Web/$area/$empresa/";

  unlink($ruta.$namef);
