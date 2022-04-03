<?php
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
	if(!isset($_SESSION)) { //valida si esta definido el perfil, si no lo esta, lo inicia
		session_start(array('name'=>'ADG')); //inicio de sesion del perfil
	}

	class vistas {
    //los funciones del modelo son protegidas
		protected function arreglo_Vistas($vista) {

			$perfil= isset($_SESSION['perfil']) ? $_SESSION['perfil'] : null ;
			$perfil=$_SESSION['perfil'];

			if($perfil == 2){
				$listaURL = array('index','inicio','sesion','error','cargaArchivo','dashboardUsuario','updArchivo','historico','archivosh');
			}
			else if($perfil == 3){
				$listaURL = array('index','inicio','sesion','error','dashboardAuto','updArchivo','historico','archivosh');
			}
			else if($perfil == 4){
				$listaURL = array('index','inicio','sesion','error','cargaArchivo','dashboardAdmin','dashboardUsuario','dashboardAuto','dashboardEmpresa','updArchivo','actArchivo','historico','archivosh');
			}
			else if($perfil == 5){
				$listaURL = array('index','inicio','sesion','error','dashboardAuto','updArchivo','historico','archivosh');
			}
			else {
				$listaURL = array('index','inicio','sesion','error');
			}

			if(in_array($vista, $listaURL)) {
				if(is_file("APP/View/".$vista.".adg.view.php")) { //is_file indica si en la ruta contiene la variable
					$vistaR = "APP/View/".$vista.".adg.view.php";
				}
				else {
					$vistaR = "sesion";
				}
			}
			elseif($vista == "sesion") {
				$vistaR = "sesion";
			}
			elseif($vista == "index") {
				$vistaR = "sesion";
			}
			else {
				$vistaR = "error";
			}
			return $vistaR;
		}
	}
