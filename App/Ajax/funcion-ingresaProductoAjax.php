<?php
  require ('../../Static/ConstGlobal.php');
  $numc = $_POST['numc'];
  // $url =$_GET['url'];
  if($numc != '') {
    // echo $user;
    // echo $pass;
    require('../../App/Controller/Controller-ingresaProducto.php');
    $inp = new ingrePro();
    echo $inp -> ingresa_Producto();
  }
  else {
    echo "No hay campos definidos...";
    require_once('../../App/View/ingresaProducto.inv.view.php');
  }
