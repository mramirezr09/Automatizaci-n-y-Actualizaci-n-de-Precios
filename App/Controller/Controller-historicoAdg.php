<?php
  require_once('../../Static/ConstGlobal.php');
  require('../../App/Controller/funcion_DB.adg.function.php');
  session_start(array('name'=>'ADG'));
  $perfil = $_SESSION['perfil'];
  $area = $_SESSION['area'];
  $con = mysqli_connect(SERVER,USER,PASS_,BBDD_MSSQL);

  if($perfil == 2){
    $where = "WHERE FK_IdEmpresa = 1 and
    FK_IdArea = $area and
    t1.Status != 0";
  }
  else {
    $where = "WHERE FK_IdEmpresa = 1 and
    t1.Status != 0";
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
          <th class="titles-head">Vizualizar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($r=mysqli_fetch_array($query)) {
          $ar = $r['ar'];
          $par = $r['par'];
          $emp = $r['emp'];
          $pkid = $r['pk'];
          $m = $r['m'];
          $a = $r['a'];
          $nombreA = $r['nombreA'];
          $ns = $r['ns'];
          $notas = $r['notas'];
          $fechaA = $r['fechaA'];
          ?>
          <tr class="row">
            <td class="row-cont"><?php echo $n ++;?></td>
            <td class="row-cont"><?php echo $nombreA;?></td><!--  Mau puñetas -->
            <td class="row-cont"><?php echo $fechaA;?></td>
            <td class="row-cont"><?php echo $m;?></td>
            <td class="row-cont"><?php echo $a;?></td>
            <td class="row-cont"><?php echo $ns;?></td>
            <td class="row-cont"><?php echo $ar;?></td>
            <td class="row-cont"><?php echo $notas;?></td>
            <td class="row-cont">
              <a href="<?php echo SRVURL.'archivosh/?pkid='.$pkid.'&par='.$par.'&emp='.$emp; ?>">
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
