<script src="https://code.highcharts.com/highcharts.js"></script><script src="https://code.highcharts.com/modules/exporting.js"></script><?php if ($id_settlement) : ?><div class="container div_bloque_cuerpo"><div class="row"><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Total personas <span><?php echo htmlspecialchars($total_personas) ?></span></div></div></div><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Total agremiados <span><?php echo htmlspecialchars($total_agremiados) ?></span></div></div></div><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Aceptan CAEE <span><?php echo htmlspecialchars($aceptan_caee) ?></span></div></div></div></div><div class="row"><div class="col-lg-6"><figure class="highcharts-figure"><div id="dashboard-image-2" data-url="ajax_page.php?page=controllers/controller_settlement-chart-2&id_settlement=<?php echo htmlspecialchars($id_settlement) ?>"></div></figure></div><div class="col-lg-6"><figure class="highcharts-figure"><div id="dashboard-image-1" data-url="ajax_page.php?page=controllers/controller_settlement-chart-1&id_settlement=<?php echo htmlspecialchars($id_settlement) ?>"></div></figure></div></div></div><?php else : ?><div class="container div_bloque_cuerpo"><div class="row"><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Total agremiados <span><?php echo htmlspecialchars($total_agremiados) ?></span></div></div></div><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Aceptan CAEE <span><?php echo htmlspecialchars($aceptan_caee) ?></span></div></div></div><div class="col-lg-4"><div class="dashboard-car"><div class="nolink">Bases activas <span><?php echo htmlspecialchars($bases_activas) ?></span></div></div></div></div><div class="row"><div class="col-lg-12"><figure class="highcharts-figure"><div id="dashboard-image-1" data-url="ajax_page.php?page=controllers/controller_home-chart-1"></div></figure></div><div class="col-lg-6"><figure class="highcharts-figure"><div id="dashboard-image-2" data-url="ajax_page.php?page=controllers/controller_home-chart-2"></div></figure></div><div class="col-lg-6"><figure class="highcharts-figure"><div id="dashboard-image-3" data-url="ajax_page.php?page=controllers/controller_home-chart-3"></div></figure></div></div></div><?php endif ?>