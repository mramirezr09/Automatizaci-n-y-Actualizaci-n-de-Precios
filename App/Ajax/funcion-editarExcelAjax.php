<?php
  require ('../../Static/ConstGlobal.php');

  if(isset($_GET['pkid'])) {
    // echo $pass;
    require('../../App/Controller/Controller-editarExcel.php');
    $ee = new editarExcel();
    echo $ee -> editxlsx();
  }
  else {
    echo "No hay archivo...";
    require_once('../../App/View/error.adg.view.php');
  }
