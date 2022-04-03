<?php
  require('../../App/Controller/funcion_DB.adg.function.php');

  class modelADG {

    protected function mysqlcon(){
      $con = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);
      if ($con) {
        // echo 'Conexion exitosa';
      }
      else {
        echo "No se pudo conectar, favor de validar";
      }
      return $con; //retorna la conexion
    }

    protected function pdoDB() { //indicamos que la funcion es de tipo protected para poder usar las variables y subclases
      $connect = new PDO (ADGDB); //creamos un objeto de tipo PDO propio del lenguaje php para realizar conexion a DB
      if ($connect) {
        echo 'Conexion exitosa';
      }
      else {
        echo "No se pudo conectar, favor de validar";
      }
      return $connect; //retorna la conexion
    }

    protected function connect_ODBC() {
		  $get_DB = new PDO (ADGMS);
      if( $get_DB ) {
				//echo "Conexión establecida.<br />";
			}
      else {
				 echo "Conexión no se pudo establecer.<br/>";
				 die( print_r( sqlsrv_errors(), true));
			}
		  return $get_DB;
	  }

	  // protected function connect_MSSQL() {
    //   $get_MSSQL = sqlsrv_connect(SERVERMS,CONNINF);
		//   return $get_MSSQL;
	  // }

	  protected function consultasql($consulta){
		  $result= self::connect_ODBC() -> prepare($consulta);
		  $result -> execute();
		  return $result;
	  }

    protected function insertRegistroA($array){
      $statusA = $array['statusA'];
      $ide = $array['ide'];
      $area = $array['area'];
      $mes = $array['mes'];
      $anho = $array['anho'];
      $nombreA = $array['nombreA'];
      $notas = $array['notas'];
      $status = $array['status'];
      $fechaA = $array['fechaA'];

      $query = "
      INSERT INTO proyecto_adg.`adg.archivos` (
          FK_IdStatus_Archivo,
          FK_IdEmpresa,
          FK_IdArea,
          FK_IdMes,
          FK_IdAnho,
          Nombre_Archivo,
          notas,
          Status,
          Fecha_Actualiza
        )
        VALUES (
          '$statusA',
          '$ide',
          '$area',
          '$mes',
          '$anho',
          '$nombreA',
          '$notas',
          '$status',
          '$fechaA'
        )
      ";

      // print_r($array);
      $insert_sql = self :: mysqlcon() -> query($query);
		  return $insert_sql;
    }

    protected function insertRegistroR($array){
      $fK_IdArchivo = $array['fK_IdArchivo'];
      $id_companhia = $array['id_companhia'];
      $id_division = $array['id_division'];
      $numero_concecutivo = $array['numero_concecutivo'];
      $codigo_cliente = $array['codigo_cliente'];
      $almacen = $array['almacen'];
      $codigo_producto = $array['codigo_producto'];
      $moneda_contrato = $array['moneda_contrato'];
      $unidad_medida_kg = $array['unidad_medida_kg'];
      $codigo_precio = $array['codigo_precio'];
      $descripcion = $array['descripcion'];
      $fecha_valida_desde = $array['fecha_valida_desde'];
      $fecha_valida_hasta = $array['fecha_valida_hasta'];
      $precio = $array['precio'];
      $status = $array['status'];
      $fecha_Actualiza = $array['fecha_Actualiza'];

      $query = "
      INSERT INTO proyecto_adg.`adg.registros` (
        FK_IdArchivo,
        id_companhia,
        id_division,
        numero_concecutivo,
        FK_IdCodigo_cliente,
        almacen,
        codigo_producto,
        moneda_contrato,
        unidad_medida_kg,
        codigo_precio,
        descripcion,
        fecha_valida_desde,
        fecha_valida_hasta,
        precio,
        Status,
        Fecha_Actualiza
        )
        VALUES (
          '$fK_IdArchivo',
          '$id_companhia',
          '$id_division',
          '$numero_concecutivo',
          '$codigo_cliente',
          '$almacen',
          '$codigo_producto',
          '$moneda_contrato',
          '$unidad_medida_kg',
          '$codigo_precio',
          '$descripcion',
          '$fecha_valida_desde',
          '$fecha_valida_hasta',
          '$precio',
          '$status',
          '$fecha_Actualiza'
        )
      ";

      // print_r($array);
      $insert_sql = self :: mysqlcon() -> query($query);
		  return $insert_sql;
    }

    protected function insertRegistroRC($array){
      $fK_IdArchivo = $array['fK_IdArchivo'];
      $id_companhia = $array['id_companhia'];
      $id_division = $array['id_division'];
      $codigo_proveedor = $array['codigo_proveedor'];
      $codigo_producto = $array['codigo_producto'];
      $almacen = $array['almacen'];
      $fechad = $array['fechad'];
      $fechah = $array['fechah'];
      $moneda_contrato = $array['moneda_contrato'];
      $precio_sin_iva = $array['precio_sin_iva'];
      $precio_incluyendo_iva = $array['precio_incluyendo_iva'];
      $status = $array['status'];
      $fecha_Actualiza = $array['fecha_Actualiza'];

      $query = "
      INSERT INTO proyecto_adg.`adg.registros_compras` (
        FK_IdArchivo,
        id_companhia,
        id_division,
        codigo_proveedor,
        codigo_producto,
        almacen,
        fechad,
        fechah,
        moneda_contrato,
        precio_sin_iva,
        precio_incluyendo_iva,
        Status,
        Fecha_Actualiza
        )
        VALUES (
          '$fK_IdArchivo',
          '$id_companhia',
          '$id_division',
          '$codigo_proveedor',
          '$codigo_producto',
          '$almacen',
          '$fechad',
          '$fechah',
          '$moneda_contrato',
          '$precio_sin_iva',
          '$precio_incluyendo_iva',
          '$status',
          '$fecha_Actualiza'
        )
      ";

      // print_r($array);
      $insert_sql = self :: mysqlcon() -> query($query);
		  return $insert_sql;
    }

    protected function insertp($array){
      $pkr = $array['pkr'];
      $pre = $array['pre'];
      $fechaA = $array['fechaA'];

      $query = "
      UPDATE `adg.registros`
      SET
        precio = '$pre',
        Fecha_Actualiza = '$fechaA'
      WHERE
        PK_IdRegistro = '$pkr'
      ";
      // print_r($query);
      $upd_sql = self :: mysqlcon() -> query($query);
		  return $upd_sql;
    }

    protected function insertpc($array){
      $pkr = $array['pkr'];
      $pre = $array['pre'];
      $fechaA = $array['fechaA'];

      $query = "
      UPDATE `adg.registros_compras`
      SET
        precio_sin_iva = '$pre',
        Fecha_Actualiza = '$fechaA'
      WHERE
        PK_IdRegistroc = '$pkr'
      ";
      // print_r($query);
      $upd_sql = self :: mysqlcon() -> query($query);
		  return $upd_sql;
    }

    protected function upds($array){
      $pka = $array['pka'];
      $status = $array['status'];
      $fechaA = $array['fechaA'];

      $query = "
      UPDATE `adg.archivos`
      SET
        FK_IdStatus_Archivo = '$status',
        Fecha_Actualiza = '$fechaA'
      WHERE
        PK_IdArchivo = '$pka'
      ";
      // print_r($query);
      $upd_sql = self :: mysqlcon() -> query($query);
		  return $upd_sql;
    }

    protected function actSOP_PRICES($array){
      $sql = self:: connect_ODBC() -> prepare("UPDATE [RossFin_demo].[dbo].[SOP_PRICES]
        SET
          [CUSTOMER_NUMBER] = :cc,
          [WAREHOUSE] = :a,
          [PRICE_CODE] = :cpr,
          [DESCRIPTION] = :d,
          [PART_CODE] = :cp,
          [SYS_CURRENCY_CODE] = :mc,
          [UNIT_PRICE] = :umk,
          [VALID_FROM_DATE] = :fvd,
          [VALID_TO_DATE] = :fvh,
          [PRICE_RECORD_NUMBER] = :nc
        WHERE
          COMPANY_CODE= :idc AND
          PRICE_RECORD_NUMBER = :ncc
      ");

      $sql -> bindparam(":cc",$array['cc']);
      $sql -> bindparam(":a",$array['a']);
      $sql -> bindparam(":cpr",$array['cpr']);
      $sql -> bindparam(":d",$array['d']);
      $sql -> bindparam(":cp",$array['cp']);
      $sql -> bindparam(":mc",$array['mc']);
      $sql -> bindparam(":umk",$array['umk']);
      $sql -> bindparam(":fvd",$array['fvd']);
      $sql -> bindparam(":fvh",$array['fvh']);
      $sql -> bindparam(":nc",$array['nc']);
      $sql -> bindparam(":idc",$array['idc']);
      $sql -> bindparam(":ncc",$array['nc']);
      // print_r($sql);
      $sql -> execute();// ejecuta consulta
		  return $sql;
    }

    protected function actSOP_PRICE_LINES($array){
      $sql = self:: connect_ODBC() -> prepare("UPDATE [RossFin_demo].[dbo].[SOP_PRICE_LINES]
        SET
          [SALES_PRICE] = :p,
          [PRICE_RECORD_NUMBER] = :nc
        WHERE
          [COMPANY_CODE] = :idc AND
          [PRICE_RECORD_NUMBER] = :nc1
      ");

      $sql -> bindparam(":p",$array['p']);
      $sql -> bindparam(":nc",$array['nc']);
      $sql -> bindparam(":idc",$array['idc']);
      $sql -> bindparam(":nc1",$array['nc']);
      // print_r($query);
      $sql -> execute();// ejecuta consulta
		  return $sql;
    }

    protected function actPOP_CONTRACT_PRICES($array){
      $sql = self:: connect_ODBC() -> prepare("UPDATE [RossFin_demo].[dbo].[POP_CONTRACT_PRICES]
        SET
        VALID_FROM_DATE = :fvd,
        VALID_TO_DATE = :fvh
        WHERE
        COMPANY_CODE = :idc AND
        DIVISION = :idd AND
        VENDOR_NUMBER = :cpr AND
        PART_CODE = :cp AND
        WAREHOUSE = :a AND
        SYS_CURRENCY_CODE = :mc
        ");

        $sql -> bindparam(":fvd",$array['fvd']);
        $sql -> bindparam(":fvh",$array['fvh']);
        $sql -> bindparam(":idc",$array['idc']);
        $sql -> bindparam(":idd",$array['idd']);
        $sql -> bindparam(":cpr",$array['cpr']);
        $sql -> bindparam(":cp",$array['cp']);
        $sql -> bindparam(":a",$array['a']);
        $sql -> bindparam(":mc",$array['mc']);
        // print_r($query);
        $sql -> execute();// ejecuta consulta
        return $sql;
      }

    protected function actPOP_CONTRACT_PRICE_LINES($array){
      $sql = self:: connect_ODBC() -> prepare("UPDATE [RossFin_demo].[dbo].[POP_CONTRACT_PRICE_LINES]
        SET
        	PURCHASE_PRICE = :psi,
        	PURCHASE_PRICE_INC_TAX = :pii
        WHERE
        	COMPANY_CODE = :idc AND
        	DIVISION = :idd AND
        	VENDOR_NUMBER = :cpr AND
        	WAREHOUSE = :a AND
        	PART_CODE = :cp
      ");

      $sql -> bindparam(":psi",$array['psi']);
      $sql -> bindparam(":pii",$array['pii']);
      $sql -> bindparam(":idc",$array['idc']);
      $sql -> bindparam(":idd",$array['idd']);
      $sql -> bindparam(":cpr",$array['cpr']);
      $sql -> bindparam(":a",$array['a']);
      $sql -> bindparam(":cp",$array['cp']);

      // print_r($sql);
      $sql -> execute();// ejecuta consulta
		  return $sql;
    }

    protected function borraR($array){
      $pk = $array['pk'];
      $query = "
      DELETE FROM `adg.archivos`
      WHERE PK_IdArchivo = '$pk'
      ";
      $del_sql = self :: mysqlcon() -> query($query);
		  return $del_sql;
    }

    protected function encrypt($string, $key) {
       $result = '';
       for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)+ord($keychar));
          $result.=$char;
       }
       return base64_encode($result);
    }

    protected function alertas($mensaje,$vista){
      $alerta = '
        <script>
          alert("'.$mensaje.'");
          window.location.assign("'.SRVURL.$vista.'");
          pause;
        </script>
      ';
      // exit;
      return $alerta;
    }
  }
