<?php
  require_once('Static/nav.adg.view.php');
  include("updClientes.adg.modal.php");
  include_once('Static/loader.adg.modal.php');
  $pkid = $_GET['pkid'];
  $par = $_GET['par'];
  $em = $_GET['emp'];
?>
<script type="text/javascript">
  let pkid = "<?php echo $pkid; ?>";
  let par = "<?php echo $par; ?>";
  let em = "<?php echo $em; ?>";
</script>
<main class="dashboard-a">
  <h2>Revise los registros <?php echo $em; ?></h2>
  <?php
  if ($perfil == 2) {
    ?>
    <button class="boton boton--secundario upd__modal" type="button" onclick="updc()">Actualizar Clientes</button>
    <?php
  }
  ?>
  <div class="flex">
    <div class="search">
      <?php
      if($par == 3){
        ?>
        <label class="search--i" for="f1">Filtre por codigo producto</label>
        <?php
      }
      else {
        ?>
        <label class="search--i" for="f1">Filtre por codigo precio</label>
        <?php
      }
      ?>
      <input class="search--i" type="text" name="f1" id="f1">
      <button class="boton boton--secundario" type="button" name="bf1" id="bf1">Fitrar</button>
    </div>

    <div class="search">
      <?php
      if($par == 3){
        ?>
        <label class="search--i" for="f2">Filtre por precio sin IVA</label>
        <?php
      }
      else {
        ?>
        <label class="search--i" for="f2">Filtre por descripción</label>
        <?php
      }
      ?>
      <input class="search--i" type="text" name="f2" id="f2">
      <button class="boton boton--secundario" type="bf2" name="bf2" id="bf2">Fitrar</button>
    </div>

    <div class="search">
      <?php
      if($par == 3){
        ?>
        <label class="search--i" for="f3">Filtre por precio con IVA</label>
        <?php
      }
      else {
        ?>
        <label class="search--i" for="f3">Filtre por precio</label>
        <?php
      }
      ?>
      <input class="search--i" type="text" name="f3" id="f3">
      <button class="boton boton--secundario" type="button" name="bf3" id="bf3">Fitrar</button>
    </div>
  </div>
  <div>
    <div class="updRegistros"></div><!--resultados de la base-->
  </div>
</main>
<script src="/Proyecto/JS/jQuery.updArchivo.js"></script>
<script src="/Proyecto/JS/jQuery.buscarArchivo.js"></script>
<script src="/Proyecto/JS/Modal.js"></script>
