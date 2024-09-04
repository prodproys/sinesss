<?php

if(sizeof($datos_tabla['fulltext'])>0 or sizeof($datos_tabla['like'])>0){ ?>
    <form 
    id="form_buscar"
    action="<?php echo "custom/".$datos_tabla['archivo'].".php";?>" 
    onsubmit="if($v('buscar')=='buscar <?php echo $datos_tabla['nombre_singular'];?>'){ return false; }"
    method="get">
        <div id="linea_buscador">
            <span class="z ico_search"></span>
            <input id="buscar" 
                type="text" 
                class="<?php echo ($_GET['buscar']!='')?"inuse":"";?>" 
                value='<?php echo $_GET['buscar'];?>' 
                autocomplete="off" 
                placeholder="buscar <?php echo $datos_tabla['nombre_singular'];?>"
                name="buscar" />
            <span id="buscar_span"></span>
        </div>
    </form>
    <?php 
}