<?php
  require_once('Static/nav.adg.view.php');
  require_once('App/Controller/funcion_DB.adg.function.php');
  include_once('Static/loader.adg.modal.php');
  session_start(array('name' => 'ADG'));
  $area = $_SESSION['area'];

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);
  $query2 = "SELECT PK_IdMes as 'id', Nombre_Mes as 'nombre' FROM proyecto_adg.`adg.mes`";
  $op1 = $conn -> query($query2);

  $query3 = "SELECT PK_IdAnho as 'id', Nombre_Anho as 'nombre' FROM proyecto_adg.`adg.anho` ORDER BY PK_IdAnho desc";
  $op2 = $conn -> query($query3);

  if ($area == 3) {
  ?>
  <div class="main">
    <main class="dashboard">
      <div class="dash-flex">
        <div class="dash-flex__block">
          <h2 class="hs">Carga Archivo ADG</h2>
          <form enctype="multipart/form-data" class="form" action="<?php echo SRVURL.'App/Ajax/funcion-leerExcelAdgAjax.php?e=1';?>" method="POST">
            <div class="contenido--form sombra">
              <legend class="leg-f flex">Cargue su archivo de Excel</legend> <!--  <?php echo $e;?> -->

              <div class="flex">
                <label for="notas">Mes:</label>
                <select class="flex-c" name="mes1" id="mes1" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op1 as $opm): ;?>
                    <option value="<?php echo $opm['id']; ?>">
                      <?php echo $opm['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Año:</label>
                <select class="flex-c" name="anho1" id="anho1" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op2 as $opa): ;?>
                    <option value="<?php echo $opa['id']; ?>">
                      <?php echo $opa['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Notas:</label>
                <textarea class="flex-c" name="notas1" id="notas1" title="Nombre de su archivo" rows="5" cols="80"></textarea>
              </div>

              <div class="flex">
                <label for="carga_archivo">Archivo:</label>
                <input class="flex-f" type="file" name="carga_archivo1" id="carga_archivo1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" required>
              </div>

              <div class="btn">
                <input class="boton boton--primario" type="submit" value="Guardar Archivo"  onclick="loader()">
              </div>

            </div>
          </form>
        </div>
        <div class="dash-flex__block">
          <!-- <h2 class="hs">Carga Archivo PAF</h2>
          <form enctype="multipart/form-data" class="form" action="<?php echo SRVURL.'App/Ajax/funcion-leerExcelPafAjax.php?e=2';?>" method="POST">
            <div class="contenido--form sombra">
              <legend class="leg-f flex">Cargue su archivo de Excel</legend>

              <div class="flex">
                <label for="notas">Mes:</label>
                <select class="flex-c" name="mes2" id="mes2" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op1 as $opm): ;?>
                    <option value="<?php echo $opm['id']; ?>">
                      <?php echo $opm['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Año:</label>
                <select class="flex-c" name="anho2" id="anho2" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op2 as $opa): ;?>
                    <option value="<?php echo $opa['id']; ?>">
                      <?php echo $opa['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Notas:</label>
                <textarea class="flex-c" name="notas2" id="notas2" title="Nombre de su archivo" rows="5" cols="80"></textarea>
              </div>

              <div class="flex">
                <label for="carga_archivo">Archivo:</label>
                <input class="flex-f" type="file" name="carga_archivo2" id="carga_archivo2" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" required>
              </div>

              <div class="btn">
                <input class="boton boton--primario" type="submit" value="Guardar Archivo">
              </div>

            </div>
          </form> -->
        </div>
      </div>
    </main>
  </div>

  <?php
  }
  else {
  ?>
  <div class="main">
    <main class="dashboard">
      <div class="dash-flex">
        <div class="dash-flex__block">
          <h2 class="hs">Carga Archivo ADG</h2>
          <form enctype="multipart/form-data" class="form" action="<?php echo SRVURL.'App/Ajax/funcion-leerExcelAdgAjax.php?e=1';?>" method="POST">
            <div class="contenido--form sombra">
              <legend class="leg-f flex">Cargue su archivo de Excel</legend> <!--  <?php echo $e;?> -->

              <div class="flex">
                <label for="notas">Mes:</label>
                <select class="flex-c" name="mes1" id="mes1" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op1 as $opm): ;?>
                    <option value="<?php echo $opm['id']; ?>">
                      <?php echo $opm['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Año:</label>
                <select class="flex-c" name="anho1" id="anho1" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op2 as $opa): ;?>
                    <option value="<?php echo $opa['id']; ?>">
                      <?php echo $opa['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Notas:</label>
                <textarea class="flex-c" name="notas1" id="notas1" title="Nombre de su archivo" rows="5" cols="80"></textarea>
              </div>

              <div class="flex">
                <label for="carga_archivo">Archivo:</label>
                <input class="flex-f" type="file" name="carga_archivo1" id="carga_archivo1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" required>
              </div>

              <div class="btn">
                <input class="boton boton--primario opm" type="submit" value="Guardar Archivo" onclick="loader()">
              </div>

            </div>
          </form>
        </div>
        <div class="dash-flex__block">
          <h2 class="hs">Carga Archivo PAF</h2>
          <form enctype="multipart/form-data" class="form" action="<?php echo SRVURL.'App/Ajax/funcion-leerExcelPafAjax.php?e=2';?>" method="POST">
            <div class="contenido--form sombra">
              <legend class="leg-f flex">Cargue su archivo de Excel</legend>

              <div class="flex">
                <label for="notas">Mes:</label>
                <select class="flex-c" name="mes2" id="mes2" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op1 as $opm): ;?>
                    <option value="<?php echo $opm['id']; ?>">
                      <?php echo $opm['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Año:</label>
                <select class="flex-c" name="anho2" id="anho2" required>
                  <option hidden value="">--Seleccione--</option>
                  <?php foreach ($op2 as $opa): ;?>
                    <option value="<?php echo $opa['id']; ?>">
                      <?php echo $opa['nombre']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex">
                <label for="notas">Notas:</label>
                <textarea class="flex-c" name="notas2" id="notas2" title="Nombre de su archivo" rows="5" cols="80"></textarea>
              </div>

              <div class="flex">
                <label for="carga_archivo">Archivo:</label>
                <input class="flex-f" type="file" name="carga_archivo2" id="carga_archivo2" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" required>
              </div>

              <div class="btn">
                <input class="boton boton--primario opm" type="submit" value="Guardar Archivo"  onclick="loader()">
              </div>

            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
  <?php
  }
