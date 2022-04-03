<?php
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Model/Modelo_principal.adg.model.php');

  session_start(array('name'=>'ADG'));
  $perfil = $_SESSION['perfil'];
  $con = mysqli_connect(SERVER,USER,PASS_,BBDD_MSSQL);

  $url = 'dashboardUsuario/';
  $pkid = $_GET['pkid'];
  $par = $_GET['par'];
  $em = $_GET['em'];

  if ($em == 'ADG') {
    $company = 01;
  }
  else{
    $company = 02;
  }

  if ($par == 3) {
    if(!isset($_GET['fcp']) && !isset($_GET['fd']) && !isset($_GET['fp'])){
      $where = "WHERE FK_IdArchivo = ".$pkid;
    }
    else if($_GET['fcp'] != '') {
      $fcp = $_GET['fcp'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      codigo_producto like '%".$fcp."%'";
      if($_GET['fd'] != '') {
        $fd = $_GET['fd'];
        $where .= " and
        precio_sin_iva like '%".$fd."%'";
        if($_GET['fp'] != '') {
          $fp = $_GET['fp'];
          $where .= " and
          precio_incluyendo_iva like '%".$fp."%'";
        }
      }
      else if($_GET['fp'] != '') {
        $fp = $_GET['fp'];
        $where .= " and
        precio_incluyendo_iva like '%".$fp."%'";
        if($_GET['fd'] != '') {
          $fd = $_GET['fd'];
          $where .= " and
          precio_sin_iva like '%".$fd."%'";
        }
      }
    }
    else if($_GET['fd'] != '') {
      $fd = $_GET['fd'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      precio_sin_iva like '%".$fd."%'";
      if($_GET['fd'] != '') {
        $fcp = $_GET['fcp'];
        $where .= " and
        codigo_producto like '%".$fcp."%'";
        if($_GET['fp'] != '') {
          $fp = $_GET['fp'];
          $where .= " and
          precio_incluyendo_iva like '%".$fp."%'";
        }
      }
      else if($_GET['fp'] != '') {
        $fp = $_GET['fp'];
        $where .= " and
        precio_incluyendo_iva like '%".$fp."%'";
        if($_GET['fd'] != '') {
          $fcp = $_GET['fcp'];
          $where .= " and
          codigo_producto like '%".$fcp."%'";
        }
      }
    }
    else if($_GET['fp'] != '') {
      $fp = $_GET['fp'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      precio_incluyendo_iva like '%".$fp."%'";
      if($_GET['fd'] != '') {
        $fd = $_GET['fd'];
        $where .= " and
        precio_sin_iva like '%".$fd."%'";
        if($_GET['fp'] != '') {
          $fcp = $_GET['fp'];
          $where .= " and
          codigo_producto like '%".$fcp."%'";
        }
      }
      else if($_GET['fcp'] != '') {
        $fcp = $_GET['fcp'];
        $where .= " and
        codigo_producto like '%".$fcp."%'";
        if($_GET['fd'] != '') {
          $fd = $_GET['fd'];
          $where .= " and
          precio_sin_iva like '%".$fd."%'";
        }
      }
    }
    else {
      $where = "WHERE FK_IdArchivo = ".$pkid;
    }

    $query = "SELECT
      PK_IdRegistroc as 'pkr',
      FK_IdStatus_Archivo as 'fsa',
      id_companhia as 'idc',
      id_division as 'idd',
      codigo_proveedor as 'cpr',
      codigo_producto as 'cp',
      almacen as 'a',
      date_format(fechad, '%d-%m-%Y') as 'fvd',
      date_format(fechah, '%d-%m-%Y') as 'fvh',
      moneda_contrato as 'mc',
      precio_sin_iva as 'psi',
      precio_incluyendo_iva as 'pii',
      t1.Notas as 'not'
    FROM proyecto_adg.`adg.registros_compras`t1
    left join `adg.Archivos`t2 on t2.PK_IdArchivo = t1.FK_IdArchivo
    $where
    order by PK_IdRegistroc asc
    ";

    $q1 = "SELECT
      PK_IdRegistroc as 'pkr1'
    FROM proyecto_adg.`adg.registros_compras`
    $where
    order by PK_IdRegistroc asc
    ";
  }
  else if($par == 4) {
    if(!isset($_GET['fcp']) && !isset($_GET['fd']) && !isset($_GET['fp'])){
      $where = "WHERE FK_IdArchivo = ".$pkid;
    }
    else if($_GET['fcp'] != '') {
      $fcp = $_GET['fcp'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      codigo_precio like '%".$fcp."%'";
      if($_GET['fd'] != '') {
        $fd = $_GET['fd'];
        $where .= " and
        descripcion like '%".$fd."%'";
        if($_GET['fp'] != '') {
          $fp = $_GET['fp'];
          $where .= " and
          precio like '%".$fp."%'";
        }
      }
      else if($_GET['fp'] != '') {
        $fp = $_GET['fp'];
        $where .= " and
        precio like '%".$fp."%'";
        if($_GET['fd'] != '') {
          $fd = $_GET['fd'];
          $where .= " and
          descripcion like '%".$fd."%'";
        }
      }
    }
    else if($_GET['fd'] != '') {
      $fd = $_GET['fd'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      descripcion like '%".$fd."%'";
      if($_GET['fd'] != '') {
        $fcp = $_GET['fcp'];
        $where .= " and
        codigo_precio like '%".$fcp."%'";
        if($_GET['fp'] != '') {
          $fp = $_GET['fp'];
          $where .= " and
          precio like '%".$fp."%'";
        }
      }
      else if($_GET['fp'] != '') {
        $fp = $_GET['fp'];
        $where .= " and
        precio like '%".$fp."%'";
        if($_GET['fd'] != '') {
          $fcp = $_GET['fcp'];
          $where .= " and
          codigo_precio like '%".$fcp."%'";
        }
      }
    }
    else if($_GET['fp'] != '') {
      $fp = $_GET['fp'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      precio like '%".$fp."%'";
      if($_GET['fd'] != '') {
        $fd = $_GET['fd'];
        $where .= " and
        descripcion like '%".$fd."%'";
        if($_GET['fp'] != '') {
          $fcp = $_GET['fp'];
          $where .= " and
          codigo_precio like '%".$fcp."%'";
        }
      }
      else if($_GET['fcp'] != '') {
        $fcp = $_GET['fcp'];
        $where .= " and
        codigo_precio like '%".$fcp."%'";
        if($_GET['fd'] != '') {
          $fd = $_GET['fd'];
          $where .= " and
          descripcion like '%".$fd."%'";
        }
      }
    }
    else {
      $where = "WHERE FK_IdArchivo = ".$pkid;
    }

    $query = "SELECT
      PK_IdRegistro as 'pkr',
      FK_IdStatus_Archivo as 'fsa',
      id_companhia as 'idc',
      id_division as 'idd',
      numero_concecutivo as 'nc',
      t3.customer_name as 'cn',
      almacen as 'a',
      codigo_producto as 'cp',
      moneda_contrato as 'mc',
      unidad_medida_kg as 'umk',
      codigo_precio as 'cpr',
      descripcion as 'd',
      date_format(fecha_valida_desde, '%d-%m-%Y') as 'fvd',
      date_format(fecha_valida_hasta, '%d-%m-%Y') as 'fvh',
      precio as 'p',
      t1.Notas as 'not'
    FROM proyecto_adg.`adg.registros`t1
    left join `adg.Archivos`t2 on t2.PK_IdArchivo = t1.FK_IdArchivo
    left join `adg.Clientes`t3 on t3.codigo_cliente = t1.FK_IdCodigo_Cliente
    $where and Company_Code = $company
    order by PK_IdRegistro asc
    ";

    $q1 = "SELECT
      PK_IdRegistro as 'pkr1'
    FROM proyecto_adg.`adg.registros`
    $where
    order by PK_IdRegistro asc
    ";

  }
  // OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
  // print_r($query);
  $query= $con -> query($query);
  $res = $query -> num_rows;
  // print_r($res);
  if ($res>0) {
    $nna = 1;
    $nid = 1;
    $pkn = 1;
    $nls = 1;

    if ($par == 3) {
      ?>
      <div class="main">
        <input type="hidden" name="res" id="res" value="<?php echo $res;?>">
        <form action="<?php echo SRVURL.'App/Ajax/funcion-updRegistrosAjax.php?res='.$res.'&pka='.$pkid;?>" method="post">
          <table class="table display" id="tbl">
            <thead>
              <tr class="titles">
                <th class="titles-head">id companhia</th>
                <th class="titles-head">id division</th>
                <th class="titles-head">codigo proveedor</th>
                <th class="titles-head">codigo producto</th>
                <th class="titles-head">almacen</th>
                <th class="titles-head">moneda contrato</th>
                <th class="titles-head">fecha valida desde</th>
                <th class="titles-head">fecha valida hasta</th>
                <th class="titles-head">precio sin iva</th>
                <th class="titles-head">Notas</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($r=mysqli_fetch_array($query)) {
                $pkr = $r['pkr'];
                $fsa = $r['fsa'];
                $idc = $r['idc'];
                $idd = $r['idd'];
                $cpr = $r['cpr'];
                $cp = $r['cp'];
                $a = $r['a'];
                $mc = $r['mc'];
                $fvd = $r['fvd'];
                $fvh = $r['fvh'];
                $psi = $r['psi'];
                $not = $r['not'];
                ?>
                <input type="hidden" name="pkr<?php echo $pkr;?>" value="<?php echo $pkr;?>">
                <tr class="row">
                  <td class="row-cont"><?php echo $idc;?></td>
                  <td class="row-cont"><?php echo $idd;?></td><!--  Mau puñetas -->
                  <td class="row-cont"><?php echo $cpr;?></td>
                  <td class="row-cont"><?php echo $cp;?></td>
                  <td class="row-cont"><?php echo $a;?></td>
                  <td class="row-cont"><?php echo $mc;?></td>
                  <td class="row-cont"><?php echo $fvd;?></td>
                  <td class="row-cont"><?php echo $fvh;?></td>
                  <td class="row-cont"><?php echo $psi;?></td>
                  <td class="row-cont"><?php echo $not;?></td>
                </tr>
                <?php
              } //en while
              ?>
            </tbody>
          </table>
        </form>
        <?php
    }
    else if($par == 4) {
      ?>
      <div class="main">
        <input type="hidden" name="res" id="res" value="<?php echo $res;?>">
        <form action="<?php echo SRVURL.'App/Ajax/funcion-updRegistrosAjax.php?res='.$res1.'&pka='.$pkid.'&par='.$par;?>" method="post">
          <table class="table display" id="tbl">
            <thead>
              <tr class="titles">
                <th class="titles-head">id companhia</th>
                <th class="titles-head">id division</th>
                <th class="titles-head">numero concecutivo</th>
                <th class="titles-head">nombre cliente</th>
                <th class="titles-head">almacen as</th>
                <th class="titles-head">codigo producto</th>
                <th class="titles-head">moneda contrato</th>
                <th class="titles-head">unidad medida kg</th>
                <th class="titles-head">codigo precio</th>
                <th class="titles-head">descripcion</th>
                <th class="titles-head">fecha valida desde</th>
                <th class="titles-head">fecha valida hasta</th>
                <th class="titles-head">precio</th>
                <th class="titles-head">Notas</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($r=mysqli_fetch_array($query)) {
                $pkr = $r['pkr'];
                $fsa = $r['fsa'];
                $idc = $r['idc'];
                $idd = $r['idd'];
                $nc = $r['nc'];
                $cn = $r['cn'];
                $a = $r['a'];
                $cp = $r['cp'];
                $mc = $r['mc'];
                $umk = $r['umk'];
                $cpr = $r['cpr'];
                $d = $r['d'];
                $fvd = $r['fvd'];
                $fvh = $r['fvh'];
                $p = $r['p'];
                $not = $r['not'];
                ?>
                <input type="hidden" name="pkr<?php echo $pkr;?>" value="<?php echo $pkr;?>">
                <tr class="row">
                  <td class="row-cont"><?php echo $idc;?></td>
                  <td class="row-cont"><?php echo $idd;?></td><!--  Mau puñetas -->
                  <td class="row-cont"><?php echo $nc;?></td>
                  <td class="row-cont"><?php echo $cn;?></td>
                  <td class="row-cont"><?php echo $a;?></td>
                  <td class="row-cont"><?php echo $cp;?></td>
                  <td class="row-cont"><?php echo $mc;?></td>
                  <td class="row-cont"><?php echo $umk;?></td>
                  <td class="row-cont"><?php echo $cpr;?></td>
                  <td class="row-cont"><?php echo $d;?></td>
                  <td class="row-cont"><?php echo $fvd;?></td>
                  <td class="row-cont"><?php echo $fvh;?></td>
                  <td class="row-cont"><?php echo $p;?></td>
                  <td class="row-cont"><?php echo $not;?></td>
                </tr>
                <?php
              } //en while
              ?>
            </tbody>
          </table>
        </form>
        <?php
      }
    }
    else {
    ?>
    <div>
      <strong>Aviso!</strong> No se encontraron resultados!
    </div>
    <?php
    }
    ?>
  </div>
