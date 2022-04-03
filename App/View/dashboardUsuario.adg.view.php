<?php
  require_once('Static/nav.adg.view.php');
  include("borrar.adg.modal.php");
  include("confirmar.adg.modal.php");
?>
<div class="main">
  <main class="dashboard">
    <div class="dash-flex">
      <h2>Ultimos Archivos Cargados ADG</h2>
      <img class="dash-imgp" src="/Proyecto/Style/img/adg.png" alt="adg">
    </div>
    <div>
      <div class="archivosAdg"></div><!--resultados de la base-->
    </div>
    <div class="dash-flex">
      <h2>Ultimos Archivos Cargados PAF</h2>
      <img class="dash-imgp" src="/Proyecto/Style/img/adg1.png" alt="paf">
    </div>
    <div>
      <div class="archivosPaf"></div><!--resultados de la base-->
    </div>
  </main>
</div>

<script src="/Proyecto/JS/Modal.js"></script>
