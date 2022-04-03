<?php
  require_once('../../Static/ConstGlobal.php');
  require('../../App/Controller/funcion_DB.adg.function.php');
  session_start(array('name'=>'ADG'));
  $perfil = $_SESSION['perfil'];
  $area = $_SESSION['area'];
  $con = mysqli_connect(SERVER,USER,PASS_,BBDD_MSSQL);

  if($perfil == 2){
    $where = "WHERE FK_IdEmpresa = 2 and
    FK_IdArea = $area and
    FK_IdStatus_Archivo in(1,2,4,6) and
    t1.Status = 1";
  }
  else {
    $where = "WHERE FK_IdEmpresa = 2 and
    FK_IdStatus_Archivo in(1,2,4,6) and
    t1.Status = 1";
  }

  $query= "SELECT
    PK_IdArchivo as 'pk',
    FK_IdEmpresa as 'em',
    t6.Clave_Empresa as 'emp',
    t5.PK_IdArea as 'par',
    t5.Nombre_Area as 'ar',
    FK_IdStatus_Archivo as 'fsa',
    t2.Nombre_Mes as 'm',
    t3.Nombre_Anho as 'a',
    t4.Nombre_Status as 'ns',
    Nombre_Archivo as 'nombreA',
    Notas as 'notas',
    t1.Fecha_Actualiza as 'fechaA'
    FROM proyecto_adg.`adg.archivos`t1
    left join `adg.mes`t2 on t2.PK_IdMes = t1.FK_IdMes
    left join `adg.anho`t3 on t3.PK_IdAnho = t1.FK_IdAnho
    left join `adg.status_archivo`t4 on t4.PK_IdStatus_Archivo = t1.FK_IdStatus_Archivo
    left join `adg.area`t5 on t5.PK_IdArea = t1.FK_IdArea
    left join `adg.empresa`t6 on t6.PK_IdEmpresa = t1.FK_IdEmpresa
    $where
  ";
  // print_r($query);
  $query= $con -> query($query);
  // print_r($inve);
  $res = $query -> num_rows;
  // print_r($res);

  $qfsa= "SELECT
    FK_IdStatus_Archivo as 'fsa'
    FROM proyecto_adg.`adg.archivos`t1
    left join `adg.mes`t2 on t2.PK_IdMes = t1.FK_IdMes
    left join `adg.anho`t3 on t3.PK_IdAnho = t1.FK_IdAnho
    left join `adg.status_archivo`t4 on t4.PK_IdStatus_Archivo = t1.FK_IdStatus_Archivo
    left join `adg.area`t5 on t5.PK_IdArea = t1.FK_IdArea
    left join `adg.empresa`t6 on t6.PK_IdEmpresa = t1.FK_IdEmpresa
    $where
  ";
  $qfsa= $con -> query($qfsa);

  while ($s=mysqli_fetch_array($qfsa)) {
    $sa = $s['fsa'];
  }

  if ($res>0) {
    $n = 1;
?>
  <div class="cont-t sombra">
    <table class="table">
      <thead>
        <tr class="titles">
          <th class="titles-head">N°</th>
          <th class="titles-head">Nombre Archivo</th>
          <th class="titles-head">Fecha Carga </th>
          <th class="titles-head">Mes</th>
          <th class="titles-head"><?php echo utf8_decode((utf8_encode('Año')));  ?></th>
          <th class="titles-head">Status</th>
          <th class="titles-head">Area</th>
          <th class="titles-head">Notas</th>
          <?php
          if($perfil == 2) {
            ?>
            <th class="titles-head">Vizualizar</th>
            <th class="titles-head">Borrar</th>
            <th class="titles-head">Preautorizar</th>
            <?php
          }
          else if($perfil == 3){
          ?>
          <th class="titles-head">Editar</th>
          <?php
          }
          else if($perfil == 4) {
          ?>
          <th class="titles-head">Actualizar</th>
          <?php
          }
          else if($perfil == 5) {
          ?>
          <th class="titles-head">Vizualizar</th>
          <th class="titles-head">Rechazar</th>
          <th class="titles-head">Confirmar</th>
          <?php
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($r=mysqli_fetch_array($query)) {
          $pkid = $r['pk'];
          $par = $r['par'];
          $emp = $r['emp'];
          $fsa = $r['fsa'];
          $ar = $r['ar'];
          $m = $r['m'];
          $a = $r['a'];
          $nombreA = $r['nombreA'];
          $ns = $r['ns'];
          $notas = $r['notas'];
          $fechaA = $r['fechaA'];
          ?>
          <input type="hidden" value="<?php echo $pkid;?>" id="id<?php echo $pkid;?>">

          <tr class="row">
            <td class="row-cont"><?php echo $n ++;?></td>
            <td class="row-cont"><?php echo $nombreA;?></td><!--  Mau puñetas -->
            <td class="row-cont"><?php echo $fechaA;?></td>
            <td class="row-cont"><?php echo $m;?></td>
            <td class="row-cont"><?php echo $a;?></td>
            <td class="row-cont"><?php echo $ns;?></td>
            <td class="row-cont"><?php echo $ar;?></td>
            <td class="row-cont"><?php echo $notas;?></td>
            <?php
            if ($perfil == 2) {
              ?>
              <td class="row-cont">
                <a href="<?php echo SRVURL.'updArchivo/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <rect x="9" y="3" width="6" height="4" rx="2" />
                    <line x1="9" y1="12" x2="9.01" y2="12" />
                    <line x1="13" y1="12" x2="15" y2="12" />
                    <line x1="9" y1="16" x2="9.01" y2="16" />
                    <line x1="13" y1="16" x2="15" y2="16" />
                  </svg>
                </a>
              </td>
              <?php
              if ($fsa == 1) {
                ?>
                <td class="row-cont">
                  <a href="#" class="borrar__modal" onclick="modalb(event, <?php echo $pkid; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <line x1="4" y1="7" x2="20" y2="7" />
                      <line x1="10" y1="11" x2="10" y2="17" />
                      <line x1="14" y1="11" x2="14" y2="17" />
                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                  </a>
                </td>
                <td class="row-cont">
                  <a href="#" class="confi__modal" onclick="modalc(event, <?php echo $pkid; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                      <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                      <path d="M9 15l2 2l4 -4" />
                    </svg>
                  </a>
                </td>
                <?php
              }
              else {
                ?>
                <td class="row-cont">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <circle cx="12" cy="16" r="1" />
                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                  </svg>
                </td>
                <td class="row-cont">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <circle cx="12" cy="16" r="1" />
                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                  </svg>
                </td>
                <?php
              }
            }
            else if ($perfil == 3) {
              if ($fsa == 2) {
              ?>
              <td class="row-cont">
                <a href="<?php echo SRVURL.'updArchivo/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" />
                    <path d="M16 5l3 3" />
                    <path d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999" />
                  </svg>
                </a>
              </td>
              <?php
              }
              else {
              ?>
              <td class="row-cont">
                <a href="<?php echo SRVURL.'updArchivo/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <rect x="9" y="3" width="6" height="4" rx="2" />
                    <line x1="9" y1="12" x2="9.01" y2="12" />
                    <line x1="13" y1="12" x2="15" y2="12" />
                    <line x1="9" y1="16" x2="9.01" y2="16" />
                    <line x1="13" y1="16" x2="15" y2="16" />
                  </svg>
                </a>
              </td>
              <?php
              }
            }
            else if($perfil == 4) {
            ?>
            <td class="row-cont">
              <a href="<?php echo SRVURL.'actArchivo/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <ellipse cx="12" cy="6" rx="8" ry="3" />
                  <path d="M4 6v8m5.009 .783c.924 .14 1.933 .217 2.991 .217c4.418 0 8 -1.343 8 -3v-6" />
                  <path d="M11.252 20.987c.246 .009 .496 .013 .748 .013c4.418 0 8 -1.343 8 -3v-6m-18 7h7m-3 -3l3 3l-3 3" />
                </svg>
              </a>
            </td>
            <?php
            }
            else if($perfil == 5) {
              ?>
                <td class="row-cont">
                  <a href="<?php echo SRVURL.'updArchivo/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="12" cy="12" r="2" />
                      <path d="M12 19c-4 0 -7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7c-.42 .736 -.858 1.414 -1.311 2.033" />
                      <path d="M15 19l2 2l4 -4" />
                    </svg>
                  </a>
                </td>
              <?php
              if ($fsa == 6) {
              ?>
                <td class="row-cont">
                  <a href="#" class="rechazar__modal" onclick="modalr(event, <?php echo $pkid; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="12" cy="12" r="9" />
                      <path d="M10 10l4 4m0 -4l-4 4" />
                    </svg>
                  </a>
                </td>
                <td class="row-cont">
                  <a href="#" class="notificar__modal" onclick="modaln(event, <?php echo $pkid; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="12" cy="12" r="9" />
                      <path d="M9 12l2 2l4 -4" />
                    </svg>
                  </a>
                </td>
              <?php
              }
              else {
              ?>
                <td class="row-cont">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <circle cx="12" cy="16" r="1" />
                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                  </svg>
                </td>
                <td class="row-cont">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <circle cx="12" cy="16" r="1" />
                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                  </svg>
                </td>
              <?php
              }
            }
            ?>
          </tr>
          <?php
        } //en while
        ?>
      </tbody>
    </table>
    <?php
  }
  else {
    ?>
    <div>
      <strong>Aviso!</strong> Excelente, No hay precios para actualizar!
    </div>
    <?php
  }
  ?>
  </div>
