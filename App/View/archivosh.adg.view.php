<?php
  require_once('Static/nav.adg.view.php');
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
  <!-- <input type="hidden" id="<?php echo $pkid; ?>" value="<?php echo $pkid; ?>"> -->
  <h2>Revise los registros <?php echo $em; ?></h2>
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
    <div class="archivosh"></div><!--resultados de la base-->
  </div>
</main>
<script src="/Proyecto/JS/jQuery.archivosh.js"></script>
<script src="/Proyecto/JS/jQuery.buscarArchivoh.js"></script>
