<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);

  $pi = $_GET['pi'];
  $pr = $_GET['pr'];
  $piv = $pr + ($pr * 0.16);
  $ar = $_GET['ar'];
  $fechaA = date('Y-m-d H:m:s');

  if($ar == 3){
    $query = "
    UPDATE `adg.registros_compras`
    SET
    precio_sin_iva = '$pr',
    precio_incluyendo_iva = '$piv',
    Fecha_Actualiza = '$fechaA'
    WHERE
    PK_IdRegistroc = '$pi'
    ";
    // var_dump($query);
    $upd = $conn -> query($query);
    // print_r($upd);
  }
  else if($ar == 4){
    $query = "
    UPDATE `adg.registros`
    SET
    precio = '$pr',
    Fecha_Actualiza = '$fechaA'
    WHERE
    PK_IdRegistro = '$pi'
    ";
    var_dump($query);
    $upd = $conn -> query($query);
    // print_r($upd);
  }

  if($_GET['pi'] == $pi){
		$query1 = "SELECT PK_IdRegistroc as 'pkr', precio_incluyendo_iva as 'pii' from `adg.registros_compras` where PK_IdRegistroc = ".$pi;
    $upd1 = $conn -> query($query1);
    // print_r($upd1);

    while ($r=mysqli_fetch_array($upd1)) {
      $pkr = $r['pkr'];
      $pii = $r['pii'];
    }
    ?>
      <span name="<?php echo 'prec'.$pkr;?>" id="<?php echo 'prec'.$pkr;?>"><?php echo $pii;?></span>
    <?php
	}
