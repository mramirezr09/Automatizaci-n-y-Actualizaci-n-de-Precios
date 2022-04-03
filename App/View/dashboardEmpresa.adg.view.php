<?php
  $adg = 1;
  $paf = 2;
?>
<main class="dashboard-e">
  <h2 class="center">Seleccione una empresa</h2>
  <div class="panel">

    <div class="block">
      <a href="<?php echo SRVURL.'dashboardUsuarioAdg/?id='.$adg; ?>">
        <img class="" src="/Proyecto/Style/img/adg.png" alt="adg">
        ADG
      </a>
    </div>
    <div class="block">
      <a href="<?php echo SRVURL.'dashboardUsuarioPaf/?id='.$paf; ?>">
        <img class="imgp" src="/Proyecto/Style/img/adg1.png" alt="adg">
        PAF
      </a>
    </div>

  </div>
</main>
