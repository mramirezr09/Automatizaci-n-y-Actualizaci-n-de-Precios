<?php
  require ('../../Static/ConstGlobal.php');

  if(!isset($_POST['carga_archivo'])) {
    // echo $nombre;
    // echo $pass;
    require('../../App/Controller/Controller-leerExcelAdg.php');
    $le = new leerExcel();
    echo $le -> readxlsx();
  }
  else {
    require_once('../../App/View/cargaArchivo.adg.view.php');
    echo "No hay archivo...";
  }
