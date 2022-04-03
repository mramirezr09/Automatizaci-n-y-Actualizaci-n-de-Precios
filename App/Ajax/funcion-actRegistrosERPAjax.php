<?php
  require ('../../Static/ConstGlobal.php');
  if(isset($_GET['pkid'])) {
    require('../../App/Controller/Controller-actRegistro.php');
    $ee = new actRegistros();
    echo $ee -> actR();
  }
  else {
    echo "No hay archivo...";
    require_once('../../App/View/error.adg.view.php');
  }
