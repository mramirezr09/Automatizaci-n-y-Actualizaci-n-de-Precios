<?php
  require ('App/Model/Model_View.adg.model.php');

  class iniciar_Sesion extends vistas {
    public function inicio_sesion() {
      return require('App/View/inicio.adg.view.php');
    }

    public function vistas() {
	  	if (isset($_GET['url'])) {
        // var_dump ($_GET['url']);
		  	$parteRuta = explode ('/', $_GET['url']);
		  	$ruta  =  vistas :: arreglo_Vistas($parteRuta[0]);
		  }
		  else {
				$ruta = 'sesion';
			}
			return $ruta;
		}
  }
