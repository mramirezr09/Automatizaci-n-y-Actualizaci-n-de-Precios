<?php
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  if($user != '' && $pass != '') {
    // echo $user;
    // echo $pass;
    require('../../App/Controller/Controller-sesion.php');
    $conse = new sesionCon();
    echo $conse -> iniciarSesion();
  }
  else {
    require_once('/App/View/sesion.adg.view.php');
    echo "No se ha podido iniciar sesion...";
  }
