<div class="main">
  <main class="center">
    <div class="header">
      <h1>Sistema de Carga y Actualización de Precios</h1>
      <form class="inicio formulario" action="<?php echo SRVURL; ?>App/Ajax/funcion-inicioAjax.php" method="POST">
        <div class="inicio-border contenido">
          <legend class="inicio--legend">Inicio de Sesión</legend>

          <div class="campos">
            <label for="user">Usuario:</label>
          </div>
          <div>
            <input type="text" name="user" id="user">
          </div>

          <div>
            <label for="pass">Contraseña:</label>
          </div>
          <div>
            <input type="password" name="pass" id="pass">
          </div>

          <div class="inicio-b">
            <input class="boton boton--primario" type="submit" value="Iniciar Sesion">
          </div>

        </div>
      </form>
    </div>
  </main>
</div>
<script src="/Proyecto/JS/validador-form.js"></script>
