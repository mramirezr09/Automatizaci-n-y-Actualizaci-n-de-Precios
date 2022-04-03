<?php
  require_once('Static/nav.adg.view.php');
  include("rechazar.adg.modal.php");
  include("notificar.adg.modal.php");
?>
<div class="main">
  <main class="dashboard">
    <div class="dash-flex">
      <h2>Archivos pendientes por autorizar ADG</h2>
      <img class="dash-imgp" src="/Proyecto/Style/img/adg.png" alt="adg">
    </div>
    <div>
      <div class="archivosAdg"></div><!--resultados de la base-->
    </div>
    <div class="dash-flex">
      <h2>Archivos pendientes por autorizar PAF</h2>
      <img class="dash-imgp" src="/Proyecto/Style/img/adg1.png" alt="adg">
    </div>
    <div>
      <div class="archivosPaf"></div><!--resultados de la base-->
    </div>
  </main>
</div>

<script src="/Proyecto/JS/Modal.js"></script>
