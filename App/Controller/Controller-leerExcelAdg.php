<?php
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  require_once '../../vendor/autoload.php';
  require_once('../../App/Model/Modelo_principal.adg.model.php');
  use PhpOffice\PhpSpreadsheet\IOFactory; //espacio de memoria / importación de clase IOFactory
  use PhpOffice\PhpSpreadsheet\Cell\Coordinate; //espacio de memoria / importación de clase Coordinate
  use PHPMailer\PHPMailer\PHPMailer; //espacio de memoria / importación de clase PHPMailer
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception; //espacio de memoria / importación de clase Exception

  class leerExcel extends modelADG {
    function readxlsx() {
      session_start(array('name' => 'ADG'));
      $area = $_SESSION['area'];

      $conDB = modelADG :: mysqlcon(); //genera la conexion a la DB
      $url = 'cargaArchivo';

      if($area == 3) {
        $ruta = "C:/xampp/htdocs/Proyecto/Web/Compras/ADG/";
      }
      else if($area == 4) {
        $ruta = "C:/xampp/htdocs/Proyecto/Web/Ventas/ADG/";
      }
      else if($area == 5) {
        $ruta = "C:/xampp/htdocs/Proyecto/Web/Sistemas/ADG/";
      }

      $sa = "SELECT
        FK_IdStatus_Archivo as 'sa'
      FROM proyecto_adg.`adg.archivos`
      WHERE
        FK_IdEmpresa = 1 and
        FK_IdArea = $area and
        FK_IdStatus_Archivo in (2,4,6)
      ";
      $fsa = $conDB -> query($sa); //realiza la consulta ala DB
      while ($r=mysqli_fetch_array($fsa)) {
        $rsa = $r['sa'];
      }
      // print_r($sa);
      // $nfsa1 = $fsa1 -> num_rows;
      $nfsa = $fsa -> num_rows;
      // echo $rsa.'<br/>';
      // echo $nfsa.'<br/>';
      // echo $rsa.'<br/>';
      if($nfsa == 0) {
        if ($rsa == 2 || $rsa == 4 || $rsa == 6) {
          return $alerta = modelADG :: alertas('Hay archivos pendentes por validar, no puedes cargar archivos por ahora!',$url);
        }
        else {
          $ide = $_GET['e'];
          $mes = $_POST['mes1'];
          $anho = $_POST['anho1'];
          $namef = $_FILES['carga_archivo1']['name'];
          $notas = $_POST['notas1'];
          $statusA = 1;
          $status = 1;
          $fechaA = date('Y-m-d H:m:s');

          $insertA = array(
            'ide' => $ide,
            'mes' => $mes,
            'anho' => $anho,
            'nombreA' => $namef,
            'notas' => $notas,
            'area' => $area,
            'statusA' =>$statusA,
            'status' => $status,
            'fechaA' => $fechaA
          );

          // if ($guarda) {
          $carga_archivo = $ruta.basename($_FILES['carga_archivo1']['name']);
          if(file_exists($ruta.$namef)) {
            return $alerta = modelADG :: alertas('El archivo ya existe!',$url);
          }
          else {
            if (move_uploaded_file($_FILES['carga_archivo1']['tmp_name'], $carga_archivo)) {


              //insertar datos de archivo a DB
              $documento = IOFactory :: load($ruta.$namef);
              $numHojas = $documento -> getSheetCount();

              if ($numHojas != 1) {
                unlink($ruta.$namef); //borra archivo copiado
                return $alerta = modelADG :: alertas('Tines mas de una Hoja en tu archivo, favor de eliminarlas y conservar solo una.',$url);
              }
              else {

                $guardaA = modelADG :: insertRegistroA($insertA);
                $query = "SELECT
                PK_IdArchivo as 'pk',
                FK_IdEmpresa as 'empresa',
                Nombre_Archivo as 'nombre'
                FROM proyecto_adg.`adg.archivos`
                ORDER BY PK_IdArchivo desc
                LIMIT 1
                ";
                $redycon = $conDB -> query($query); //realiza la consulta ala DB
                while ($r=mysqli_fetch_array($redycon)) {
                  $pk = $r['pk'];
                }
                $fK_IdArchivo = $pk;

                $status = 1;
                $fecha_Actualiza = $fechaA;

                $hojaActual = $documento -> getSheet(0); //se posiciona en la primera hoja
                $numfilas = $hojaActual -> getHighestDataRow(); //indica el numero de filas con datos
                $column = $hojaActual -> getHighestColumn(); //indica el numero de columnas con datos
                $valc = Coordinate :: columnIndexFromString($column);

                //almacena el identificador en caso de error para borrarlo
                $deletR = array('pk' => $pk);

                if($area == 3){
                  for($if = 9; $if <= $numfilas; $if++) { //recorre la fila
                    // for ($ic = 1; $ic <= $valc; $ic++) { //recorre la columna
                    // $res = $hojaActual -> getCellByColumnAndRow($ic,$if);
                    $id_companhia = $hojaActual -> getCellByColumnAndRow(1,$if);
                    $id_division = $hojaActual -> getCellByColumnAndRow(2,$if);
                    $codigo_proveedor = $hojaActual -> getCellByColumnAndRow(3,$if);
                    $codigo_producto = $hojaActual -> getCellByColumnAndRow(4,$if);
                    $almacen = $hojaActual -> getCellByColumnAndRow(5,$if);
                    $fecha_valida_desde = $hojaActual -> getCellByColumnAndRow(6,$if);
                    $fec=explode("/",$fecha_valida_desde);
                    $fechad=$fec[2]."-".$fec[1]."-".$fec[0];
                    $fecha_valida_hasta = $hojaActual -> getCellByColumnAndRow(7,$if);
                    $fech=explode("/",$fecha_valida_hasta);
                    $fechah=$fech[2]."-".$fech[1]."-".$fech[0];
                    $moneda_contrato = $hojaActual -> getCellByColumnAndRow(8,$if);
                    $precio_sin_iva = $hojaActual -> getCellByColumnAndRow(9,$if);
                    $precio_incluyendo_iva = $hojaActual -> getCellByColumnAndRow(10,$if);

                    //validaciones
                    if ($id_companhia == '#REF!' || $id_companhia == '' || $id_companhia == ' ' || $id_companhia == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion en {id_companhia}, favor de corregir tu archivo!',$url);
                    }
                    else if ($id_division == '#REF!' || $id_division == '' || $id_division == ' ' || $id_division == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {id_division}, favor de corregir tu archivo!',$url);
                    }
                    else if ($codigo_proveedor == '#REF!' || $codigo_proveedor == '' || $codigo_proveedor == ' ' || $codigo_proveedor == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {codigo_proveedor}, favor de corregir tu archivo!',$url);
                    }
                    else if ($codigo_producto == '#REF!' || $codigo_producto == '' || $codigo_producto == ' ' || $codigo_producto == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {codigo_producto}, favor de corregir tu archivo!',$url);
                    }
                    else if ($almacen == '#REF!' || $almacen == '' || $almacen == ' ' || $almacen == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {almacen}, favor de corregir tu archivo!',$url);
                    }
                    else if ($fecha_valida_desde == '#REF!' || $fecha_valida_desde == '' || $fecha_valida_desde == ' ' || $fecha_valida_desde == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {fecha_valida_desde}, favor de corregir tu archivo!',$url);
                    }
                    else if ($fecha_valida_hasta == '#REF!' || $fecha_valida_hasta == '' || $fecha_valida_hasta == ' ' || $fecha_valida_hasta == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {fecha_valida_hasta}, favor de corregir tu archivo!',$url);
                    }
                    else if ($moneda_contrato == '#REF!' || $moneda_contrato == '' || $moneda_contrato == ' ' || $moneda_contrato == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {moneda_contrato}, favor de corregir tu archivo!',$url);
                    }
                    else if($precio_sin_iva == '#REF!' || $precio_sin_iva == '' || $precio_sin_iva == ' ' || $precio_sin_iva == '-') {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {precio_sin_iva}, favor de corregir tu archivo!',$url);
                    }
                    else if($precio_incluyendo_iva == '#REF!' || $precio_incluyendo_iva == '' || $precio_incluyendo_iva == ' ' || $precio_incluyendo_iva == '-') {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! o celda vacia o espacios o guion {precio_incluyendo_iva}, favor de corregir tu archivo!',$url);
                    }
                    else if (!checkdate($fec[1],$fec[0],$fec[2])) {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('El largo de {fecha_valida_desde} es erroneo, favor de corregir tu archivo!',$url);
                    }
                    else if (!checkdate($fech[1],$fech[0],$fech[2])) {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('El largo de {fecha_valida_hasta} es erroneo, favor de corregir tu archivo!',$url);
                    }
                    else if($precio_sin_iva == '-' || $precio_sin_iva == '' || $precio_sin_iva == ' '){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor {-} en campo {precio_sin_iva}, favor de corregir tu archivo!',$url);
                    }
                    else if($precio_incluyendo_iva == '-' || $precio_incluyendo_iva == '' || $precio_incluyendo_iva == ' '){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor {-} en campo {precio_incluyendo_iva}, favor de corregir tu archivo!',$url);
                    }
                    else {
                      // echo $fecha_valida_desde;
                      // unlink($ruta.$namef); //borra archivo copiado
                      // exit;
                      $insertRC = array(
                      'fK_IdArchivo' => $fK_IdArchivo,
                      'id_companhia' => $id_companhia,
                      'id_division' => $id_division,
                      'codigo_proveedor' => $codigo_proveedor,
                      'codigo_producto' => $codigo_producto,
                      'almacen' => $almacen,
                      'fechad' => $fechad,
                      'fechah' => $fechah,
                      'moneda_contrato' => $moneda_contrato,
                      'precio_sin_iva' => $precio_sin_iva,
                      'precio_incluyendo_iva' => $precio_incluyendo_iva,
                      'status' => $status,
                      'fecha_Actualiza' => $fecha_Actualiza
                      );

                      $guardaR = modelADG :: insertRegistroRC($insertRC);
                    }
                    //   echo $res.' ';
                    // }
                    // echo '</br>';
                  }
                }
                else {
                  for($if = 9; $if <= $numfilas; $if++) {
                    $id_companhia = $hojaActual -> getCellByColumnAndRow(1,$if);
                    $id_division = $hojaActual -> getCellByColumnAndRow(2,$if);
                    $numero_concecutivo = $hojaActual -> getCellByColumnAndRow(3,$if);
                    $codigo_cliente = $hojaActual -> getCellByColumnAndRow(4,$if);
                    $almacen = $hojaActual -> getCellByColumnAndRow(5,$if);
                    $codigo_producto = $hojaActual -> getCellByColumnAndRow(6,$if);
                    $moneda_contrato = $hojaActual -> getCellByColumnAndRow(7,$if);
                    $unidad_medida_kg = $hojaActual -> getCellByColumnAndRow(8,$if);
                    $codigo_precio = $hojaActual -> getCellByColumnAndRow(9,$if);
                    $descripcion = $hojaActual -> getCellByColumnAndRow(10,$if);
                    $fecha_valida_desde = $hojaActual -> getCellByColumnAndRow(11,$if);
                    $date = explode("/",$fecha_valida_desde);
                    // $fec = explode('/',$fecha_valida_desde);
                    list($d,$m,$y) = $date;
                    // $fechad = $fec[2].'-'.$fec[1].'-'.$fec[0];
                    $fechad = $y."-".$m."-".$d;
                    // echo $fechad.' ';
                    $fd = strlen($fechad);
                    // echo $fd.'<br/>';
                    $fecha_valida_hasta = $hojaActual -> getCellByColumnAndRow(12,$if);
                    $fech = explode('/',$fecha_valida_hasta);
                    $fechah = $fech[2].'-'.$fech[1].'-'.$fech[0];
                    $fh = strlen($fecha_valida_hasta);
                    $precio = $hojaActual -> getCellByColumnAndRow(13,$if);

                    //validaciones
                    if ($id_companhia == '#REF!' || $id_companhia == '' || $id_companhia == ' ' || $id_companhia == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! en {id_companhia}, favor de corregir tu archivo!',$url);
                    }
                    else if ($id_division == '#REF!' || $id_division == '' || $id_division == ' ' || $id_division == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {id_division}, favor de corregir tu archivo!',$url);
                    }
                    else if ($numero_concecutivo == '#REF!' || $numero_concecutivo == '' || $numero_concecutivo == ' ' || $numero_concecutivo == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {numero_concecutivo}, favor de corregir tu archivo!',$url);
                    }
                    else if ($codigo_cliente == '#REF!' || $codigo_cliente == '' || $codigo_cliente == ' ' || $codigo_cliente == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {codigo_cliente}, favor de corregir tu archivo!',$url);
                    }
                    else if ($almacen == '#REF!' || $almacen == '' || $almacen == ' ' || $almacen == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {almacen}, favor de corregir tu archivo!',$url);
                    }
                    else if ($codigo_producto == '#REF!' || $codigo_producto == '' || $codigo_producto == ' ' || $codigo_producto == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {codigo_producto}, favor de corregir tu archivo!',$url);
                    }
                    else if ($moneda_contrato == '#REF!' || $moneda_contrato == '' || $moneda_contrato == ' ' || $moneda_contrato == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {moneda_contrato}, favor de corregir tu archivo!',$url);
                    }
                    else if ($unidad_medida_kg == '#REF!' || $unidad_medida_kg == '' || $unidad_medida_kg == ' ' || $unidad_medida_kg == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {unidad_medida_kg}, favor de corregir tu archivo!',$url);
                    }
                    else if ($codigo_precio == '#REF!' || $codigo_precio == '' || $codigo_precio == ' ' || $codigo_precio == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {codigo_precio}, favor de corregir tu archivo!',$url);
                    }
                    else if ($descripcion == '#REF!' || $descripcion == '' || $descripcion == ' ' || $descripcion == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {descripcion}, favor de corregir tu archivo!',$url);
                    }
                    else if ($fecha_valida_desde == '#REF!' || $fecha_valida_desde == '' || $fecha_valida_desde == ' ' || $fecha_valida_desde == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {fecha_valida_desde}, favor de corregir tu archivo!',$url);
                    }
                    else if ($fecha_valida_hasta == '#REF!' || $fecha_valida_hasta == '' || $fecha_valida_hasta == ' ' || $fecha_valida_hasta == '-'){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {fecha_valida_hasta}, favor de corregir tu archivo!',$url);
                    }
                    else if($precio == '#REF!' || $precio == '' || $precio == ' ' || $precio == '-') {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor #REF! {precio}, favor de corregir tu archivo!',$url);
                    }
                    else if ($fd != 10) {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('El largo de {fecha_valida_desde} es erroneo, favor de corregir tu archivo!',$url);
                    }
                    else if ($fh != 10) {
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('El largo de {fecha_valida_hasta} es erroneo, favor de corregir tu archivo!',$url);
                    }
                    else if($precio == '-' || $precio == '' || $precio == ' '){
                      unlink($ruta.$namef); //borra archivo copiado
                      $alerta = modelADG :: borraR($deletR); //borra el registro
                      return $alerta = modelADG :: alertas('Tines un valor {-} en campo {precio}, favor de corregir tu archivo!',$url);
                    }
                    else {
                      // echo $fecha_valida_desde;
                      // unlink($ruta.$namef); //borra archivo copiado
                      // exit;

                      $insertR = array(
                      'fK_IdArchivo' => $fK_IdArchivo,
                      'id_companhia' => $id_companhia,
                      'id_division' => $id_division,
                      'numero_concecutivo' => $numero_concecutivo,
                      'codigo_cliente' => $codigo_cliente,
                      'almacen' => $almacen,
                      'codigo_producto' => $codigo_producto,
                      'moneda_contrato' => $moneda_contrato,
                      'unidad_medida_kg' => $unidad_medida_kg,
                      'codigo_precio' => $codigo_precio,
                      'descripcion' => $descripcion,
                      'fecha_valida_desde' => $fechad,
                      'fecha_valida_hasta' => $fechah,
                      'precio' => $precio,
                      'status' => $status,
                      'fecha_Actualiza' => $fecha_Actualiza
                      );

                      $guardaR = modelADG :: insertRegistroR($insertR);
                    }
                  }
                }
                // unlink($ruta.$namef);
                // exit;
                return $alerta = modelADG :: alertas('Datos Guardados con Exito!',$url);
              }
            }
            else {
              return $alerta = modelADG :: alertas('Fallo al cargar el archivo!',$url);
            }
          }
        }
      }
      else {
        return $alerta = modelADG :: alertas('Hay archivos pendentes por validar, no puedes cargar archivos por ahora!',$url);
      }
    }
  }
