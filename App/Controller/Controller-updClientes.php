<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);
  $truc = "
    TRUNCATE `proyecto_adg`.`adg.clientes`
  ";
  // print_r($truc);
  $truc = $conn -> query($truc);

  $trup = "
    TRUNCATE `proyecto_adg`.`adg.productos`
  ";
  // print_r($trup);
  $trup = $conn -> query($trup);

  $connms = sqlsrv_connect(SERVERMS,CONNINF);

  $selu = "SELECT
    COMPANY_CODE as 'cc',
    CUSTOMER_NUMBER as 'cbe',
    CUSTOMER_NAME as 'nom'
  FROM [RossFin_demo].[dbo].[CUSTOMERS]
  ORDER BY GEM_DBKEY
  ";
  $selu = sqlsrv_query($connms,$selu,PARAMS,OPTION);

  $fechaA = date('Y-m-d H:m:s');
  $cara = array(".",",","'");
  while ($ms = sqlsrv_fetch_array($selu)) {
    $cc = $ms['cc'];
    $cbe = $ms['cbe'];
    // $nom = $ms['nom'];
    $nom = rtrim(str_replace($cara,"",$ms['nom'])); //str_replace($cara,"",$ms['nom'])
    $insc = "
    INSERT INTO proyecto_adg.`adg.clientes` (
      Company_Code,
      Codigo_Cliente,
      Customer_Name,
      Status,
      Fecha_Actualiza
    )
    VALUES (
      $cc,
      '$cbe',
      '$nom',
      1,
      '$fechaA'
    )
    ";
    // print_r($insc);
    $insc = $conn -> query($insc);
  }

  $selp = "SELECT
      COMPANY_CODE as 'cc',
      PART_CODE as 'pc',
      PART_DESC_1 as 'pd'
  FROM [RossFin_demo].[dbo].[PRODUCT_MASTER]
  ORDER BY GEM_DBKEY
  ";
  $selp = sqlsrv_query($connms,$selp,PARAMS,OPTION);

  while ($msc = sqlsrv_fetch_array($selp)) {
    $cc = $msc['cc'];
    $pc = $msc['pc'];
    // $nom = $ms['nom'];
    $pd = rtrim(str_replace($cara,"",$msc['pd'])); //str_replace($cara,"",$ms['pd'])
    $insp = "
    INSERT INTO proyecto_adg.`adg.productos` (
      Company_Code,
      Part_Code,
      Part_Desc_1,
      Status,
      Fecha_Actualiza
    )
    VALUES (
      $cc,
      '$pc',
      '$pd',
      1,
      '$fechaA'
    )
    ";
    print_r($insp);
    $insp = $conn -> query($insp);
  }
