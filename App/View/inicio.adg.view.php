<?php
  require_once('App/Controller/funcion_inicio.adg.function.php');

  $oi = New iniciar_Sesion();
  $vista = $oi -> vistas(); //ejecuta la funcion y valida si la vista existe

  if($vista == 'sesion' || $vista == 'error') {
    if($vista == 'sesion') {
      require_once('App/View/sesion.adg.view.php');
    }
    else {
      require_once('App/View/error.adg.view.php');
    }
  }
  else {
    // if(!isset($_SESSION)) {
    //   session_start(array('name'=>'ADG'));
    // }
    require_once($vista);
  }
