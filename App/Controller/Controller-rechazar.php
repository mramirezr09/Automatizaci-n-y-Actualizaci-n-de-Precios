<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);


  $idr = $_GET['idr'];
  $query = "
  UPDATE `adg.archivos`
  SET
    FK_IdStatus_Archivo = 3
  WHERE
    PK_IdArchivo = '$idr'
  ";
  $upd = $conn -> query($query);

  $del = "SELECT
    t2.Clave_Empresa as 'fie',
    t3.Nombre_Area as 'fia',
    Nombre_Archivo as 'na'
  FROM `adg.archivos` t1
  left join `adg.empresa`t2 on t2.PK_IdEmpresa = t1.FK_IdEmpresa
  left join `adg.area`t3 on t3.PK_IdArea = t1.FK_IdArea
  WHERE
    PK_IdArchivo = '$idr'
  ";
  $del = $conn -> query($del);

  while ($d = mysqli_fetch_array($del)) {
    $empresa = $d['fie'];
    $area = $d['fia'];
    $namef = $d['na'];
  }

  $ruta = "C:/xampp/htdocs/Proyecto/Web/$area/$empresa/";

  unlink($ruta.$namef);
