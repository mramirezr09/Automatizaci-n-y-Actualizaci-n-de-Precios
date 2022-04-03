<?php
  require('../../App/Controller/funcion_DB.adg.function.php');
  $con = mysqli_connect(SERVER,USER,PASS_,BBDD_MSSQL);

  $query= "SELECT
    t2.Nombre_Empresa as 'Empresa',
    t3.Nombre_Area as 'Area',
    t4.Nombre_Departamento as 'Departamento',
    t1.Nombre_Usuario as 'Usuario',
    t1.Login as 'Login',
    t1.Pass as 'Pass'
    FROM proyecto_adg.`adg.usuarios` t1
    left join `adg.empresa` t2 on t2.PK_IdEmpresa = t1.FK_IdEmpresa
    left join `adg.area` t3 on t3.PK_IdArea = t1.FK_IdArea
    left join `adg.departamento` t4 on t4.PK_IdDepartamento = t1.FK_IdDepartamento
  ";
  // print_r($query);
  $query= $con -> query($query);
  // print_r($inve);
  $res = $query -> num_rows;
  // print_r($res);
  if ($res>0) {
    $n = 1;
?>
  <table class="table sombra">
    <thead>
      <tr class="titles">
        <th class="titles-head">N°</th>
        <th class="titles-head">Usuario</th>
        <th class="titles-head">Empresa</th>
        <th class="titles-head">Area</th>
        <th class="titles-head">Departamento</th>
        <th class="titles-head">Login</th>
        <th class="titles-head">Pass</th>
      </tr>
    </thead>
    <tbody>
<?php
  while ($r=mysqli_fetch_array($query)) {
    $usuario = $r['Usuario'];
    $empresa = $r['Empresa'];
    $area = $r['Area'];
    $departamento = $r['Departamento'];
    $login = $r['Login'];
    $pass = $r['Pass'];
?>
      <tr class="row">
        <td class="row-cont"><?php echo $n ++;?></td>
        <td class="row-cont"><?php echo $usuario;?></td><!--  Mau puñetas -->
        <td class="row-cont"><?php echo $empresa;?></td>
        <td class="row-cont"><?php echo $area;?></td>
        <td class="row-cont"><?php echo $departamento;?></td>
        <td class="row-cont"><?php echo $login;?></td>
        <td class="row-cont"><?php echo $pass;?></td>
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
    <strong>Aviso!</strong> Excelente, No hay productos en compra urgente!
  </div>
<?php
  }
