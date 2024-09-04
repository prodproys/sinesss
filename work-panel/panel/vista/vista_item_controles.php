<?php




    /*
    ##     ## #### ######## ##      ##
    ##     ##  ##  ##       ##  ##  ##
    ##     ##  ##  ##       ##  ##  ##
    ##     ##  ##  ######   ##  ##  ##
    ##   ##   ##  ##       ##  ##  ##
    ## ##    ##  ##       ##  ##  ##
    ###    #### ########  ###  ###
    */
    if( (!isset($_GET['i'])) and ($_GET['justlist']!='1') ){ 

        $controles_crud[]= '<a id="av_'.$linea[$datos_tabla['id']].'" '.
            ' href="custom/'.$datos_tabla['archivo'].'.php?i='.$linea[$datos_tabla['id']].'" '.
            ' class="i_ev" '.
            ' title="ver '.$datos_tabla['nombre_singular'].'" >Ver '.$datos_tabla['nombre_singular'].'</a>';

    }




    /*
    ##     ## ####  ######  #### ########  #### ##       #### ########     ###    ########
    ##     ##  ##  ##    ##  ##  ##     ##  ##  ##        ##  ##     ##   ## ##   ##     ##
    ##     ##  ##  ##        ##  ##     ##  ##  ##        ##  ##     ##  ##   ##  ##     ##
    ##     ##  ##   ######   ##  ########   ##  ##        ##  ##     ## ##     ## ##     ##
    ##   ##   ##        ##  ##  ##     ##  ##  ##        ##  ##     ## ######### ##     ##
    ## ##    ##  ##    ##  ##  ##     ##  ##  ##        ##  ##     ## ##     ## ##     ##
    ###    ####  ######  #### ########  #### ######## #### ########  ##     ## ########
    */

    if(0)
    if($datos_tabla['vis']!='' and $datos_tabla['visibilidad']!='0' ){

        $controles_crud[]= '<a id="av_'.$linea[$datos_tabla['id']].'" '.
            ' onclick="ax(\'v\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
            ' class="i_m" '.
            ' title="habilitar '.$datos_tabla['nombre_singular'].'" >Habilitar '.$datos_tabla['nombre_singular'].'</a>';

        $controles_crud[]= '<a id="ah_'.$linea[$datos_tabla['id']].'" '.
            ' onclick="ax(\'o\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
            ' class="i_o" '.
            ' title="deshabilitar '.$datos_tabla['nombre_singular'].'" >Deshabilitar '.$datos_tabla['nombre_singular'].'</a>';

    }

    /*
    ########  ######  ######## ########  ######## ##       ##          ###     ######
    ##       ##    ##    ##    ##     ## ##       ##       ##         ## ##   ##    ##
    ##       ##          ##    ##     ## ##       ##       ##        ##   ##  ##
    ######    ######     ##    ########  ######   ##       ##       ##     ##  ######
    ##             ##    ##    ##   ##   ##       ##       ##       #########       ##
    ##       ##    ##    ##    ##    ##  ##       ##       ##       ##     ## ##    ##
    ########  ######     ##    ##     ## ######## ######## ######## ##     ##  ######
    */
    if(0)
    if($datos_tabla['cal']!='' and $datos_tabla['calificacion']!='0' ){

        $controles_crud[]= '<a id="as_'.$linea[$datos_tabla['id']].'" '.
            ' onclick="ax(\'star\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
            ' class="bl1 itr ico_star_'.( ($linea[$datos_tabla['cal']])?$linea[$datos_tabla['cal']]:'0'  ).' z" '. 
            ' rel="'. ( ($linea[$datos_tabla['cal']]==5)?'0':($linea[$datos_tabla['cal']]+1) ).'" '.
            ' title="calificar '.$datos_tabla['nombre_singular'].'" >Calificar '.$datos_tabla['nombre_singular'].'</a>';

    }

    /*
    ######## ########  #### ########    ###    ########
    ##       ##     ##  ##     ##      ## ##   ##     ##
    ##       ##     ##  ##     ##     ##   ##  ##     ##
    ######   ##     ##  ##     ##    ##     ## ########
    ##       ##     ##  ##     ##    ######### ##   ##
    ##       ##     ##  ##     ##    ##     ## ##    ##
    ######## ########  ####    ##    ##     ## ##     ##
    */
    if($datos_tabla['editar']=='1'){

        if($datos_tabla['edicion_completa']=='1'){

            $controles_crud[]= '<a id="ae_'.$linea[$datos_tabla['id']].'" '.
                ' onclick="ax(\'ec\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
                ' class="i_ec" '.
                ' title="editar '.$datos_tabla['nombre_singular'].'" >Editar '.$datos_tabla['nombre_singular'].'</a>';

        }



    }

    /*
    ######## ##       #### ##     ## #### ##    ##    ###    ########
    ##       ##        ##  ###   ###  ##  ###   ##   ## ##   ##     ##
    ##       ##        ##  #### ####  ##  ####  ##  ##   ##  ##     ##
    ######   ##        ##  ## ### ##  ##  ## ## ## ##     ## ########
    ##       ##        ##  ##     ##  ##  ##  #### ######### ##   ##
    ##       ##        ##  ##     ##  ##  ##   ### ##     ## ##    ##
    ######## ######## #### ##     ## #### ##    ## ##     ## ##     ##
    */
    if($ct['eliminar']=='1'){
        
        $controles_crud[]=  '<a id="ad_'.$linea[$datos_tabla['id']].'" '.
            ' onclick="ax(\'x\',\''.$linea[$datos_tabla['id']].'\');return false;" '.
            ' class="i_x" '.
            ' title="Eliminar '.$datos_tabla['nombre_singular'].'" >Eliminar '.$datos_tabla['nombre_singular'].'</a>';

    }    

    /*
    ##     ## ######## ##    ## ##     ##
    ###   ### ##       ###   ## ##     ##
    #### #### ##       ####  ## ##     ##
    ## ### ## ######   ## ## ## ##     ##
    ##     ## ##       ##  #### ##     ##
    ##     ## ##       ##   ### ##     ##
    ##     ## ######## ##    ##  #######
    */

    foreach($ct['procesos'] as $iproceso=>$proceso){

        if($ct['procesos'][$iproceso]['disabled']=='1'){ unset($ct['procesos'][$iproceso]); }

    }


    if(
        sizeof($ct['procesos'])>0 and $ct['procesos']!=0 
        or sizeof($controles_bufer)>0 
        or sizeof($controles_crud)>0 
    ){

        $linkks=[];
        foreach($ct['procesos'] as $iproceso=>$proceso){

            $href= ( ($proceso['file']!='')?$proceso['file']:'formulario_quick.php' ) 
            .'?proceso='.$iproceso
            .'&L='.$linea[$datos_tabla['id']]
            .'&OT='
            .( ($proceso['ot'])?$proceso['ot']."&parent=".$objeto_tabla[$this_me]['archivo']:$objeto_tabla[$this_me]['archivo']."&parent=")
            .( ($proceso['ran']=='null')?"":"&ran=1" )
            .( ($proceso['accion'])?"&accion=".$proceso['accion']:'')
            .( (sizeof($proceso['cargar'])>0)?'&load='.urlencode(json_encode($proceso['cargar'])):'')

            .( ($proceso['extra'])?"&".str_replace(
                ["[id]","[id_grupo]"],
                [$linea[$datos_tabla['id']],$linea['id_grupo']],
                $proceso['extra']):'');

            
            $linkk = '<a rel="';
            $linkk.= ($proceso['rel'])?$proceso['rel']:'width:1250,height:900';
            $linkk.= '" href="';
            
            $linkk.= $href;

            $linkk.= '"'
            .' class="'. ( (isset($proceso['class']))?$proceso['class']:'mb' )
            .'"'
            .' >';
            
            $linkk.= $proceso['label'];
            $linkk.= '</a>';

            $linkks[]=$linkk;
            
            unset($linkk);

        }




        echo "<div class='menudown'>";

        // echo '<a id="exl_'.$linea[$datos_tabla['id']].'" '.
        // ' class="corner expanlink" '.
        // ' onclick="ax(\'set_fila_2\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
        // ' title="expandir"></a>';
        
        // echo '<a id="cll_'.$linea[$datos_tabla['id']].'" '.
        // ' class="corner colaplink" '.
        // ' onclick="ax(\'set_fila_4\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
        // ' title="colapsar"></a>';        

        $options_detail=[];
        $randon="me_".rand();
        // echo '<label for="'.$randon.'" class="menu_icono_delgado"></label>';
        echo '<a class="menu_icono_delgado"></a>';

            if($_GET['i']!=''){

                foreach($MEEE['options_detail'] as $opti){
                    $options_detail[]=str_replace("[id]",$_GET['i'],$opti);
                }
                // prin($MEEE['options_detail']);
                // prin($datos_tabla);
                // if(sizeof($controles_crud)>0)$controles_crud= array_merge($controles_crud,["<div class='menu_limiter'></div>"]);
            } else {
                foreach($MEEE['options_list'] as $opti){
                    $options_detail[]=str_replace("[id]",$linea[$datos_tabla['id']],$opti);
                }                
            }

            if(sizeof($options_detail)>0)$options_detail= array_merge($options_detail,["<div class='menu_limiter'></div>"]);
            if(sizeof($controles_crud)>0)$controles_crud= array_merge($controles_crud,["<div class='menu_limiter'></div>"]);
            if(sizeof($controles_bufer)>0)$controles_bufer= array_merge($controles_bufer,["<div class='menu_limiter'></div>"]);
            if(sizeof($linkks)>0)$linkks= array_merge($linkks,["<div class='menu_limiter'></div>"]);

            $linkks=array_merge($options_detail,$controles_bufer,$linkks,$controles_crud);
            
            // echo '<input type="checkbox" id="'.$randon.'" >';
            render_view(['items'=>$linkks],'menu_float.php'); 


        echo  "</div>";

        // prin($controles_crud,'glow');

        unset($controles_crud);
        unset($controles_bufer);
        unset($linkks);
    }



