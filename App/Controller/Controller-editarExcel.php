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
  $f = date("m") - 1;

  if ($em == 'ADG') {
    $company = '01';
  }
  else if ($em == 'PAF'){
    $company = '02';
  }

  // print_r($_GET);

  if ($par == 3) {
    if(!isset($_GET['fcp']) && !isset($_GET['fd']) && !isset($_GET['fp'])){
      $where = "WHERE FK_IdArchivo = ".$pkid;
    }
    else if($_GET['fcp'] != '') {
      $fcp = $_GET['fcp'];
      $where = "WHERE
      FK_IdArchivo = ".$pkid." and
      part_desc_1 like '%".$fcp."%'";
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
        part_desc_1 like '%".$fcp."%'";
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
          part_desc_1 like '%".$fcp."%'";
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
          part_desc_1 like '%".$fcp."%'";
        }
      }
      else if($_GET['fcp'] != '') {
        $fcp = $_GET['fcp'];
        $where .= " and
        part_desc_1 like '%".$fcp."%'";
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
        part_desc_1 as 'cp',
        almacen as 'a',
        date_format(fechad, '%d-%m-%Y') as 'fvd',
        date_format(fechah, '%d-%m-%Y') as 'fvh',
        moneda_contrato as 'mc',
        precio_sin_iva as 'psi',
        precio_incluyendo_iva as 'pii',
        t1.Notas as 'not'
      FROM proyecto_adg.`adg.registros_compras`t1
      left join `adg.Archivos`t2 on t2.PK_IdArchivo = t1.FK_IdArchivo
      left join `adg.productos`t3 on t3.Part_Code = t1.codigo_producto
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
      $where = "WHERE FK_IdArchivo = ".$pkid; //
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

    // $precioa = "SELECT
    //   CONCAT(FK_IdCodigo_Cliente,codigo_producto,codigo_precio) as 'conpa',
    //   precio as 'pa'
    // FROM proyecto_adg.`adg.registros`t4
    // LEFT join `adg.Archivos`t2 on t2.PK_IdArchivo = t4.FK_IdArchivo
    // where FK_IdMes = $f and t4.status = 1 and FK_IdEmpresa = $company
    // order by PK_IdRegistro asc
    // ";
    //where Company_Code = $company and t2.FK_IdMes = 0$f
    // print_r($precioa);
    // echo '<br/>';
    // $precioa = $con -> query($precioa);
    // $rest = $precioa -> num_rows;
    // print_r($rest);

    $query = "SELECT
        PK_IdRegistro as 'pkr',
        FK_IdStatus_Archivo as 'fsa',
        id_companhia as 'idc',
        id_division as 'idd',
        numero_concecutivo as 'nc',
        #FK_IdCodigo_cliente as 'cn',
        t3.customer_name as 'cn',
        almacen as 'a',
        codigo_producto as 'cp',
        moneda_contrato as 'mc',
        unidad_medida_kg as 'umk',
        codigo_precio as 'cpr',
        descripcion as 'd',
        date_format(fecha_valida_desde, '%d-%m-%Y') as 'fvd',
        date_format(fecha_valida_hasta, '%d-%m-%Y') as 'fvh',
        CONCAT(FK_IdCodigo_Cliente,codigo_producto,codigo_precio) as 'conp',
        precio as 'p',
        t1.notas as 'not'
      FROM proyecto_adg.`adg.registros`t1
      left join `adg.Archivos`t2 on t2.PK_IdArchivo = t1.FK_IdArchivo
      left join `adg.Clientes`t3 on  t1.FK_IdCodigo_Cliente = t3.codigo_cliente
      #inner join `adg.Clientes`t3 on t2.FK_IdEmpresa = t3.company_code
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

  // print_r($query);
  $query = $con -> query($query);
  $res = $query -> num_rows;
  // print_r($res);
  $q1= $con -> query($q1);
  while ($a=mysqli_fetch_array($q1)) {
    $res1 = $a['pkr1'];
  }
  // OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
  // print_r($res1);
  if ($res>0) {
    $nna = 1;
    $nid = 1;
    $pkn = 1;
    $nls = 1;

    if($par == 3) {
      ?>
      <div class="main">
        <input type="hidden" name="res" id="res" value="<?php echo $res;?>">
        <form action="<?php echo SRVURL.'App/Ajax/funcion-updRegistrosAjax.php?res='.$res1.'&pka='.$pkid.'&par='.$par;?>" method="post" onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
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
                  <?php
                  if ($perfil == 5) {
                    ?>
                      <td class="row-cont"><?php echo $psi;?></td>
                    <?php
                    if ($fsa == 6) {
                      ?>
                      <td class="row-cont">
                        <input type="text" class="<?php echo'pk-id'.$pkr;?>" name="<?php echo 'pre'.$pkr;?>" id="<?php echo 'pre'.$pkr;?>" value="<?php echo $not ?>" onchange="rev(<?php echo $pkr.','.$par; ?>)" required>
                      </td>
                      <?php
                    }
                    else {
                      ?>
                      <td class="row-cont">
                        <?php echo $not;?>
                      </td>
                      <?php
                    }
                  }
                  else if ($perfil == 3 || $perfil == 4){
                    if ($fsa == 2) {
                    ?>
                      <td class="row-cont">
                        <input type="number" class="<?php echo'pk-id'.$pkr;?>" step="0000.0001" min="0" name="<?php echo 'pre'.$pkr;?>" id="<?php echo 'pre'.$pkr;?>" value="<?php echo $psi;?>" onchange="upd(<?php echo $pkr.','.$par; ?>)" required> <!---->
                        <!-- //onchange="upd(<?php echo $pkr;?>)" -->
                      </td>
                      <td class="row-cont">
                        <?php echo $not;?>
                      </td>
                    <?php
                    }
                    else {
                      ?>
                      <td class="row-cont">
                        <?php echo $psi;?>
                      </td>
                      <td class="row-cont">
                        <?php echo $not;?>
                      </td>
                      <?php
                    }
                  }
                  else {
                    ?>
                    <td class="row-cont">
                      <?php echo $psi;?>
                    </td>
                    <td class="row-cont">
                      <?php echo $not;?>
                    </td>
                    <?php
                  }
                  ?>
                </tr>
                <?php
              } //en while
              ?>
            </tbody>
          </table>
          <?php
          if (($perfil == 3 || $perfil == 4)) {
            if ($where == "WHERE FK_IdArchivo = ".$pkid) {
              if ($fsa == 2) {
                ?>
                <div class="btn">
                  <input class="boton boton--primario opm" type="submit" value="Actuaizar Registros"  onclick="loader()"> <!--id="btnup" onclick="mensajea('Se estan acutalizando los datos, clickee de nuevo','mensaje-correcto','btnup')"-->
                </div>
                <?php
              }
            }
          }
          ?>
        </form>
        <?php
      }
      else if($par == 4) {
      ?>
      <div class="main">
        <input type="hidden" name="res" id="res" value="<?php echo $res;?>">
        <form action="<?php echo SRVURL.'App/Ajax/funcion-updRegistrosAjax.php?res='.$res1.'&pka='.$pkid.'&par='.$par;?>" method="post" onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
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
                <th class="titles-head">mes anterior</th>
                <th class="titles-head">precio actual</th>
                <th class="titles-head">Notas</th>
              </tr>
            </thead>
            <tbody>
            <?php
            while ($r = mysqli_fetch_array($query)) {
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
              $conp = $r['conp'];
              $p = $r['p'];
              $not = $r['not'];

              $pra = "SELECT
                  CONCAT(FK_IdCodigo_Cliente,codigo_producto,codigo_precio) as 'conpa',
                  precio as 'pa'
                FROM proyecto_adg.`adg.registros`t4
                LEFT join `adg.Archivos`t2 on t2.PK_IdArchivo = t4.FK_IdArchivo
                where FK_IdMes = $f and CONCAT(FK_IdCodigo_Cliente,codigo_producto,codigo_precio) = '$conp'
                order by PK_IdRegistro asc
              ";
              $pra = $con -> query($pra);
              $rpra = $pra -> num_rows;
              // print_r($rpra);
              // echo '<br/>';

              if ($rpra > 0) {
                $pr = $pra -> fetch_assoc();
                // $p = mysqli_fetch_array($pra);
                if(isset($pr['conpa']) || isset($pr['pa'])){
                  $conpa = $pr['conpa'];
                  $pa = $pr['pa'];
                }
              }
              else if($rpra == 0) {
                $conpa = '';
                $pa = 'No hay registro anterior';
              }
              // print_r($conpa);
              // echo ' ';
              // print_r($pa);
              // echo '<br/>';
              // while ($p = mysqli_fetch_array($pra)) {
              //   $conpa = $p['conpa'];
              //   $pa = $p['pa'];
              // }
              ?>
              <input type="hidden" name="pkr<?php echo $pkr;?>" value="<?php echo $pkr;?>">
              <tr class="row">
                <td class="row-cont"><?php echo $idc;?></td>
                <td class="row-cont"><?php echo $idd;?></td><!--  Mau puñetas -->
                <td class="row-cont"><?php echo $nc;?></td>
                <td class="row-cont"><?php echo $cn;?></td> <!--$cn-->
                <td class="row-cont"><?php echo $a;?></td>
                <td class="row-cont"><?php echo $cp;?></td>
                <td class="row-cont"><?php echo $mc;?></td>
                <td class="row-cont"><?php echo $umk;?></td>
                <td class="row-cont"><?php echo $cpr;?></td>
                <td class="row-cont"><?php echo $d;?></td>
                <td class="row-cont"><?php echo $fvd;?></td>
                <td class="row-cont"><?php echo $fvh;?></td>
                <td class="row-cont"><?php echo $pa; ?></td> <!--$pa-->
                <?php
                if ($conp == $conpa) {
                  if ($pa > $p) {
                    $bcolor = "#a2231d";
                  }
                  else if($pa < $p) {
                    $bcolor = "#008000";
                  }
                  else if($pa == $p) {
                    $bcolor = "#919191";
                  }
                  else if($pa == '') {
                    $bcolor = "#000";
                  }
                }
                else {
                  $bcolor = "#000";
                }
                if($perfil == 5){
                ?>
                <td class="row-cont" style="background-color: <?php echo $bcolor ?>; color: #ffffff;">
                  <?php echo $p;?>
                </td>
                  <?php
                  if ($fsa == 6) {
                  ?>
                <td class="row-cont">
                  <input type="text" style="background-color: <?php echo $bcolor ?>; color: #ffffff;" class="<?php echo'pk-id'.$pkr;?>" name="<?php echo 'pre'.$pkr;?>" id="<?php echo 'pre'.$pkr;?>" value="<?php echo $not ?>" onchange="rev(<?php echo $pkr.','.$par; ?>)" required>
                </td>
                  <?php
                  }
                  else {
                  ?>
                <td class="row-cont">
                  <?php echo $not;?>
                </td>
                  <?php
                  }
                }
                else if ($perfil == 3 || $perfil == 4){
                  if ($fsa == 2) {
                    ?>
                <td class="row-cont">
                  <input type="number" style="background-color: <?php echo $bcolor ?>; color: #ffffff;" class="<?php echo'pk-id'.$pkr;?>" step="0000.0001" min="0" name="<?php echo 'pre'.$pkr;?>" id="<?php echo 'pre'.$pkr;?>" value="<?php echo $p;?>" onchange="upd(<?php echo $pkr.','.$par; ?>)" required>
                  <!-- //onchange="upd(<?php echo $pkr;?>)" -->
                </td>
                <td class="row-cont">
                  <?php echo $not;?>
                </td>
                    <?php
                  }
                  else {
                    ?>
                <td class="row-cont"  style="background-color: <?php echo $bcolor ?>; color: #ffffff;">
                  <?php echo $p;?>
                </td>
                <td class="row-cont">
                  <?php echo $not;?>
                </td>
                    <?php
                  }
                }
                else {
                  ?>
                <td class="row-cont"  style="background-color: <?php echo $bcolor ?>; color: #ffffff;">
                  <!-- <?php echo $conpa;?> -->
                  <?php echo $p;?>
                </td>
                <td class="row-cont">
                  <?php echo $not;?>
                </td>
                  <?php
                }
                ?>
              </tr>
              <?php
            } //en while
            ?>
            </tbody>
          </table>
          <?php
          if (($perfil == 3 || $perfil == 4)) {
            if ($where == "WHERE FK_IdArchivo = ".$pkid) {
              if ($fsa == 2) {
                ?>
                <div class="btn">
                  <input class="boton boton--primario opm" type="submit" value="Autorizar Precios"  onclick="loader()"> <!--id="btnup" onclick="mensajea('Se estan acutalizando los datos, clickee de nuevo','mensaje-correcto','btnup')"-->
                </div>
                <?php
              }
            }
          }
          ?>
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
