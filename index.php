<?php
  ob_start(); //alacena el buffer
  try {
    require('App/Controller/funcion_inicio.adg.function.php');
    require_once('Static/ConstGlobal.php');
    $inicio = new iniciar_Sesion(); //se instancia un objeto de la clase inicio
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, inital-scale=1.0">
  <meta name="author" content="Mauricio Ramírez Rojas">
  <meta name="description" content="Sistema de Gestion de Inventarios">
  <link rel="stylesheet" href="/Proyecto/Style/normalize.css">
  <link rel="stylesheet" href="/Proyecto/Style/global.css">
  <link rel="stylesheet" href="/Proyecto/Style/nav.css">
  <link rel="stylesheet" href="/Proyecto/Style/footer.css">
  <link rel="stylesheet" href="/Proyecto/Style/inicio.css">
  <link rel="stylesheet" href="/Proyecto/Style/alerta.css">
  <link rel="stylesheet" href="/Proyecto/Style/formularios.css">
  <link rel="stylesheet" href="/Proyecto/Style/dashboard.css">
  <link rel="stylesheet" href="/Proyecto/Style/tablas.css">
  <link rel="stylesheet" href="/Proyecto/Style/empresa.css">
  <link rel="stylesheet" href="/Proyecto/Style/modal.css">
  <link rel="stylesheet" href="/Proyecto/Style/loader.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap"  crossorigin="crossorigin" as="font">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
  <script src="/Proyecto/JS/JQuery/jquery-3.6.0.min.js"></script>
  <title>Proyecto ADG</title>
</head>
<body>
  <?php
    $inicio -> inicio_sesion(); //se accede al metodo __sesion del objeto inicio
    require_once('Static/footer.inv.view.php');
  ?>
  <script src="/Proyecto/JS/modernizr.js"></script>
  <!-- <script src="/Proyecto/JS/jQuery.alert.js"></script> -->
  <script src="/Proyecto/JS/jQuery.dashboardUsuarioAdg.js"></script>
  <script src="/Proyecto/JS/jQuery.dashboardUsuarioPaf.js"></script>
  <script src="/Proyecto/JS/jQuery.localStorage.js"></script>
  <script src="/Proyecto/JS/jQuery.historicoAdg.js"></script>
  <script src="/Proyecto/JS/jQuery.historicoPaf.js"></script>
  <script src="/Proyecto/JS/loader.js"></script>

</body>
<?php
  }
  catch (Exception $e) {
    echo 'Ocurrio un error, favor de notificar al Administrador del sitio!';
  }
?>
</html>
