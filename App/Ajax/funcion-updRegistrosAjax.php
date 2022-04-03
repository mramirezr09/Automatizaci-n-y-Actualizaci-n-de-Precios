<?php
  require ('../../Static/ConstGlobal.php');
  if(isset($_GET['res'])) {
    require('../../App/Controller/Controller-updRegistro.php');
    $ee = new updRegistros();
    echo $ee -> updR();
  }
  else {
    echo "No hay archivo...";
    require_once('../../App/View/error.adg.view.php');
  }
