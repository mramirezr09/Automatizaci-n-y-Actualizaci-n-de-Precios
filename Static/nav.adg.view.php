<?php
  require_once('Static/ConstGlobal.php');
  session_start(array('name'=>'ADG'));
  $perfil = $_SESSION['perfil'];
  $nombre = $_SESSION['nombre'];
  if ($perfil == 2){
  ?>
    <header>
      <nav>
        <ul class="ul1">
          <li class="prod">
            <a href="<?php echo SRVURL.'cargaArchivo/'; ?>">Inicio</a>
          </li>
          <li class="prodt">
            Archivos
            <ul class="ul2">
              <li class="prod">
                <a href="<?php echo SRVURL.'dashboardUsuario/';?>">
                  Lista Archivos
                </a>
              </li>
            </ul>
          </li>
          <li class="prod">
            <a href="<?php echo SRVURL.'historico/';?>">Historico</a>
          </li>
        </ul>
        <ul class="ul1">
          <li class="prodt">
            <?php echo $nombre; ?>
            <ul class="ul2">
              <li class="prod">
                <a href="<?php echo SRVURL; ?>App/Controller/Controller-salir.php">
                  Cerrar Sesion
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
  <?php
  }
  else if($perfil == 3 || $perfil == 5){
    ?>
    <header>
      <nav>
        <ul class="ul1">
          <li class="prod">
            <a href="<?php echo SRVURL; ?>dashboardAuto/">Inicio</a>
          </li>
          <li class="prod">
            <a href="<?php echo SRVURL.'historico/';?>">Historico</a>
          </li>
        </ul>
        <ul class="ul1">
          <li class="prodt">
            <?php echo $nombre; ?>
            <ul class="ul2">
              <li class="prod">
                <a href="<?php echo SRVURL; ?>App/Controller/Controller-salir.php">
                  Cerrar Sesion
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <?php
  }
  else {
    ?>
    <header>
      <nav>
        <ul class="ul1">
          <li class="prod">
            <a href="<?php echo SRVURL.'dashboardAdmin/';?>">Inicio</a>
          </li>
          <li class="prodt">
            Archivos
            <ul class="ul2">
              <li class="prod">
                <a href="<?php echo SRVURL.'cargaArchivo/'; ?>">
                  Cargar archivo
                </a>
              </li>
            </ul>
          </li>
          <li class="prod">
            <a href="<?php echo SRVURL.'historico/';?>">Historico</a>
          </li>
        </ul>
        <ul class="ul1">
          <li class="prodt">
            <?php echo $nombre; ?>
            <ul class="ul2">
              <li class="prod">
                <a href="<?php echo SRVURL; ?>App/Controller/Controller-salir.php">
                  Cerrar Sesion
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <?php
  }
