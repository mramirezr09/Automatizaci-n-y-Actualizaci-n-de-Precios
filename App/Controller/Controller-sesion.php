<?php
require_once('../../App/Model/Modelo_principal.adg.model.php');
require_once('funcion_DB.adg.function.php');
require_once('../../Static/ConstGlobal.php');

  class sesionCon extends modelADG {
    public function iniciarSesion() {

      $user = $_POST['user'];
      $pass = $_POST['pass'];

      $conDB = modelADG :: mysqlcon(); //genera la conexion a la DB
      $query = "SELECT
        FK_IdPerfil as 'perfil',
        FK_IdArea as 'area',
        Nombre_Usuario as 'nombre',
        Login,
        Pass,
        Status
      FROM proyecto_adg.`adg.usuarios`
      WHERE
        Login = '$user' and
        Pass = '$pass' and
        status = 1
      ";
      // print_r($query);

      $redycon = $conDB -> query($query); //realiza la consulta ala DB
      $numFilas = $redycon -> num_rows; //cuenta el numero de filas que regresa la consulta

      while ($r=mysqli_fetch_array($redycon)) {
        $nombre = $r['nombre'];
        $perfil = $r['perfil'];
        $area = $r['area'];
      }

      if ($numFilas == 1) { //si el numero de filas resultado de la consulta es igual a 1
        session_start(array('name'=>'ADG'));
        $_SESSION['nombre'] = $nombre;
        $_SESSION['perfil'] = $perfil;
        $_SESSION['area'] = $area;

        if($perfil == 4){
          $vista = SRVURL."dashboardAdmin/"; //me da acceso al sistema
        }
        else if ($perfil == 3) {
          $vista = SRVURL."dashboardAuto/";
        }
        else if ($perfil == 2) {
          $vista = SRVURL."cargaArchivo/";
        }
        else if ($perfil == 5) {
          $vista = SRVURL."dashboardAuto/";
        }
        else{
          $vista = SRVURL."sesion/";
        }
      }
      else {
        // $vista = SRVURL."sesion/"; //si no hay resultado me regresa a la vista de sesion
        $url = 'sesion/';
        return $alertas = modelADG :: alertas('Usuario o Contraseña incorrecta!',$url);
      }
      return $respuesta = '<script>window.location.assign("'.$vista.'")</script>';
    }
  }
