<div class="bloque_titulo">

    <span class='titulo' name="titulo" ><?php echo $tbtitulo?></span>

    <?php

    $saved[$datos_tabla['me']]['crearopen']=($saved[$datos_tabla['me']]['crearopen']=='')?0:$saved[$datos_tabla['me']]['crearopen'];

    /*
    ########  ######## ########   #######  ########  ######## ########  ######
    ##     ## ##       ##     ## ##     ## ##     ##    ##    ##       ##    ##
    ##     ## ##       ##     ## ##     ## ##     ##    ##    ##       ##
    ########  ######   ########  ##     ## ########     ##    ######    ######
    ##   ##   ##       ##        ##     ## ##   ##      ##    ##             ##
    ##    ##  ##       ##        ##     ## ##    ##     ##    ##       ##    ##
    ##     ## ######## ##         #######  ##     ##    ##    ########  ######
    */
    if($datos_tabla['repos']!=''){ ?>
        <span id="abri_cerrar_repos">
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#repos" id="abrir_repos" onclick="abrir_repos('1','0');" class="btn btn-small btn-info" 
            style=" <?php echo ($saved[$datos_tabla['me']]['repos']=='1')?"display:none;":""?>" >
                <i class="itl ico_reportes"></i>
                reportes
            </a>
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#repos" id="cerrar_repos" onclick="abrir_repos('0','0');" class="btn btn-small btn-inverse" 
            style=" <?php echo ($saved[$datos_tabla['me']]['repos']=='1')?"":"display:none;"?>" >
                cerrar reportes
            </a> 
        </span>
    <?php } 

    /*
    ##     ##    ###     ######   ######
    ###   ###   ## ##   ##    ## ##    ##
    #### ####  ##   ##  ##       ##
    ## ### ## ##     ##  ######   ######
    ##     ## #########       ##       ##
    ##     ## ##     ## ##    ## ##    ##
    ##     ## ##     ##  ######   ######
    */
    if($datos_tabla['mass_actions']!=''){ ?>
        <span id="abri_cerrar_mass">
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#mass" id="abrir_mass" onclick="abrir_mass('1','0');" class="btn btn-small" 
            style=" <?php echo ($saved[$datos_tabla['me']]['mass']=='1')?"display:none;":""?>" >
                Acciones
            </a>
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#mass" id="cerrar_mass" onclick="abrir_mass('0','0');" class="btn btn-small btn-inverse" 
            style=" <?php echo ($saved[$datos_tabla['me']]['mass']=='1')?"":"display:none;"?>" >
                cerrar acciones
            </a>
        </span>
    <?php }


    /*
     ######  ########    ###    ########
    ##    ##    ##      ## ##      ##
    ##          ##     ##   ##     ##
     ######     ##    ##     ##    ##
          ##    ##    #########    ##
    ##    ##    ##    ##     ##    ##
     ######     ##    ##     ##    ##
    */
    if($datos_tabla['stat']=='1'){ ?>
        <span id="abri_cerrar_stat">
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#stat" id="abrir_stat" onclick="abrir_stat('1','0');" class="btn btn-small" 
            style=" <?php echo ($saved[$datos_tabla['me']]['stat']=='1')?"display:none;":""?>" >
                gráficos
            </a>
            <a href="custom/<?php echo $SERVER['ARCHIVO'];?>#stat" id="cerrar_stat" onclick="abrir_stat('0','0');" class="btn btn-small btn-inverse" 
            style=" <?php echo ($saved[$datos_tabla['me']]['stat']=='1')?"":"display:none;"?>" >
                cerrar gráficos
            </a> 
        </span>
    <?php }

    /*
     ######   #######  ##    ## ######## ########   #######  ##        ######
    ##    ## ##     ## ###   ##    ##    ##     ## ##     ## ##       ##    ##
    ##       ##     ## ####  ##    ##    ##     ## ##     ## ##       ##
    ##       ##     ## ## ## ##    ##    ########  ##     ## ##        ######
    ##       ##     ## ##  ####    ##    ##   ##   ##     ## ##             ##
    ##    ## ##     ## ##   ###    ##    ##    ##  ##     ## ##       ##    ##
     ######   #######  ##    ##    ##    ##     ##  #######  ########  ######
    */
    if($_GET['i']=='')
    if(trim($datos_tabla['controles'])!=''){ 
        echo procesar_controles_html($datos_tabla['controles']); 
    }
    /*
    ##    ## ##     ## ######## ##     ##  #######
    ###   ## ##     ## ##       ##     ## ##     ##
    ####  ## ##     ## ##       ##     ## ##     ##
    ## ## ## ##     ## ######   ##     ## ##     ##
    ##  #### ##     ## ##        ##   ##  ##     ##
    ##   ### ##     ## ##         ## ##   ##     ##
    ##    ##  #######  ########    ###     #######
    */
    if(!($datos_tabla['crear']=='0' or $tblistadosize=='0' )){

        if(!isset($_GET['i'])){

            $saved[$datos_tabla['me']]['crearopen']=0; ?>
            <span id="abri_cerrar_crear">
                <a href="custom/<?php echo $SERVER['URL'];?>#create" 
                id="abrir_crear" 
                onclick="abrir_crear('1','0');" 
                class="btn btn-small btn-primary boton_crear_open" 
                style=" <?php echo ($saved[$datos_tabla['me']]['crearopen']=='1')?"display:none;":""?>" >
                    crear <?php echo $datos_tabla['nombre_singular']?>
                </a>
                <a href="custom/<?php echo $SERVER['URL'];?>#list" 
                id="cerrar_crear" 
                onclick="abrir_crear('0','0');" 
                class="btn btn-small btn-inverse boton_crear_close" 
                style=" <?php echo ($saved[$datos_tabla['me']]['crearopen']=='1')?"":"display:none;"?>" >
                    cancelar crear
                </a>
            </span>
        <?php 
        }

    }

  



    /*
     ######   ##     ##
    ##    ##  ###   ###
    ##        #### ####
    ##   #### ## ### ##
    ##    ##  ##     ##
    ##    ##  ##     ##
     ######   ##     ##
    */
    if($datos_tabla['exportar_gm']=='1' and 0){

        ?>
        <a href="#" onclick="javascript:exportar_gm();return false;" class="btn btn-small exportar_gm" title="Descargar Base para Group Mail">
            <i class="itl ico_gm"></i>
            Exportar Group Mail
        </a>
        <script>
            function exportar_gm(){ ax('gm'); var url='exportar_gm.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }
        </script> 
        <?php

    }


    /*
     ######    #######
    ##    ##  ##     ##
    ##        ##     ##
    ##   #### ##     ##
    ##    ##  ##     ##
    ##    ##  ##     ##
     ######    #######
    */
    if($datos_tabla['exportar_go']=='1'){

        ?>
        <a href="#" onclick="javascript:exportar_go();return false;" class="btn btn-small exportar_go" title="Descargar Base para Gmail">
            <i class="itl ico_gm"></i>
            Exportar GMail
        </a>
        <script>
            function exportar_go(){ ax('gm'); var url='exportar_go.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }
        </script>
        <?php

    }			

    /*
    ######## ##     ##  ######  ######## ##
    ##        ##   ##  ##    ## ##       ##
    ##         ## ##   ##       ##       ##
    ######      ###    ##       ######   ##
    ##         ## ##   ##       ##       ##
    ##        ##   ##  ##    ## ##       ##
    ######## ##     ##  ######  ######## ########
    */
    if(0)
    if($datos_tabla['exportar_excel']=='1'){

        ?>
        <!--<a href="#" id="boton_imprimir" onclick="javascript:$('div_allcontent').addClass('menu_colapsed');window.print();return false;" class="btn btn-small exportar_excel" title="Imprimir"><i class="itl ico_Print"></i>Imprimir</a>-->
        <a href="#" id="boton_excel" onclick="javascript:ax('excel');return false;" class="btn btn-small" title="Descargar Excel">Exportar Excel</a>
        <?php

    }

    
    /*
     ######   ######  ##     ##
    ##    ## ##    ## ##     ##
    ##       ##       ##     ##
    ##        ######  ##     ##
    ##             ##  ##   ##
    ##    ## ##    ##   ## ##
     ######   ######     ###
    */
    if($datos_tabla['importar_csv']=='1'){

        ?>
        <a href="#" rel="nofollow" onclick="javascrip:procesar_recargar('<?php echo 'importar_csv.php?conf='.$_GET['conf'].'&me='.$datos_tabla['me']."&".$SERVER['PARAMS'];?>');return false;" class="btn btn-small" title="Importar CSV"><i class="itl ico_Excel"></i>Importar CSV</a>
        <?php

    }



    if(sizeof($datos_tabla['exports'])>0){

        foreach($datos_tabla['exports'] as $nonbe=>$axion){

            $Aaxion=explode("/",$axion);
            $axionEnd=end($Aaxion);

            ?>
            <a href="#" onclick="javascript:<?php echo $axionEnd;?>();return false;" class="btn btn-small exports exportar_<?php echo $axionEnd;?>" title="Descargar <?php echo $nonbe;?>">
                <i class="itl ico_gm"></i>
                <?php echo strtoupper($nonbe);?>
            </a>
            <script>
                function <?php echo $axionEnd;?>(){ ax('gm'); var url='exports.php?name=<?php echo $axionEnd;?>&file=<?php echo $axion;?>&&<?php echo $axion;?>.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }
            </script>
            <?php

        }
        
    }


 
    
    ?>


</div>