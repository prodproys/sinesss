<?php

if($_GET['ran']==0){ unset($_GET['ran']); }

include("objeto.php");
include("vista_ax.php");
?>
<div id="bloque_content_crear" class="bloque_content_crear"></div>
<div class="inner_listado" id="inner" ></div>
<div class="segunda_barra" id="segunda_barra_2"><b id="inner_span_num" ></b></div>
<div class="cover" id="refresh-cover" style="display:none;"></div>
<div class="refreshing" id="refresh" style="display:none;">cargando......</div>
<li id="i_19"></li>
