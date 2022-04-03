<?php // Definicion de MSSQL
  define('SERVER', '192.168.1.201:3306');// Instancia Productiva
  define('BBDD_MSSQL','proyecto_adg');
  define('USER','DSBM');// Usuario Productivo
  define('PASS_','Uz./w@xZpd5O4cJc');

  define('SERVERMS', 'AZRDBSERVER');
  define('BBDD_SQL','RossFin_demo');
  define('USERMS','sa');
  define('PASSMS_','Alim3nt0s');

  define('PARAMS',array());
  define('OPTION',array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));


  define('CONNINF',array("Database"=>BBDD_SQL,"Uid"=>USERMS,"Pwd"=>PASSMS_));


  define ('ADGMS','odbc:Driver={SQL Server};Server='.SERVERMS.';Database='.BBDD_SQL.';Uid='.USERMS.';Pwd='.PASSMS_);

  // print_r(PDO::getAvailableDrivers());
  define ('ADGDB',"mysql:host=".SERVER."; dbname=".BBDD_MSSQL."; charset=UTF-8,".USER.",".PASS_); //
  // $conn = new PDO('mysql:host='.$h.'; dbname='.$d."'","'".$u."'","'".$p."'");


  define ('METHOD','AES-256-CBC');
  define ('SECRET_KEY','@SCLP$ppro123!"#');
  define ('SECRET_IV','123');

?>
