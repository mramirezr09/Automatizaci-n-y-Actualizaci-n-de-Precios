<?php
  require ('../../Static/ConstGlobal.php');
  require_once('../../App/Model/Modelo_principal.adg.model.php');

  class salir extends modelADG {
    function ex() {
      $url = '';
      session_start(array('name' => 'ADG'));
      session_destroy();
      return $alerta = modelADG :: alertas('Cierre de sesion exitosa!',$url);
    }
  }

  $inp = new salir();
  echo $inp -> ex();
