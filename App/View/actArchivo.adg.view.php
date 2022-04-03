<?php
  require_once('Static/nav.adg.view.php');
  include_once('Static/loader.adg.modal.php');
  $pkid = $_GET['pkid'];
  $par = $_GET['par'];
?>
<main class="dashboard-a">
  <h2>Actualización de Precios a Sistema ERP</h2>
  <form enctype="multipart/form-data" class="form" action="<?php echo SRVURL.'App/Ajax/funcion-actRegistrosERPAjax.php?pkid='.$pkid.'&par='.$par;?>" method="POST">
    <div class="contenido--form sombra">
      <legend class="leg-f flex">Indique una nota si es necesario.</legend> <!--  <?php echo $e;?> -->

      <div class="flex">
        <label for="notas">Notas:</label>
        <textarea class="flex-c" name="notas1" id="notas1" title="Nombre de su archivo" rows="5" cols="80"></textarea>
      </div>

      <div class="btn">
        <input class="boton boton--primario" type="submit" value="Actualizar Precios" onclick="loader()">
      </div>

    </div>
  </form>
</main>
