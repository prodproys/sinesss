<?php

// prin($datos_tabla);exit();
if(!$ocultar_opciones_filas and $vars['GENERAL']['controles_listados']){ 
    
    $menu_tipo_listado=[];
    /*
    ##       ####  ######  ########     #######  ########  ######## ####  #######  ##    ##  ######
    ##        ##  ##    ##    ##       ##     ## ##     ##    ##     ##  ##     ## ###   ## ##    ##
    ##        ##  ##          ##       ##     ## ##     ##    ##     ##  ##     ## ####  ## ##
    ##        ##   ######     ##       ##     ## ########     ##     ##  ##     ## ## ## ##  ######
    ##        ##        ##    ##       ##     ## ##           ##     ##  ##     ## ##  ####       ##
    ##        ##  ##    ##    ##       ##     ## ##           ##     ##  ##     ## ##   ### ##    ##
    ######## ####  ######     ##        #######  ##           ##    ####  #######  ##    ##  ######
    */
    if($datos_tabla['list_options']){

        $menu_tipo_listado=array_merge($menu_tipo_listado,$datos_tabla['list_options']);
    
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
    if($datos_tabla['exportar_excel']=='1'){

        $menu_tipo_listado[]=[
            'name'=>'Imprimir',
            'onclick'=>
            "window.print();".
            'return false;',
            'class'=>'link_print',
        ];

        $menu_tipo_listado[]=[
            'name'=>'Exportar Excel',
            'onclick'=>"ax('excel','','','".$datos_tabla['me']."','','".$datos_tabla['get_id']."');".
                'return false;',
            'class'=>'link_excel',
        ];
        
    }

    if(1){

        $menu_tipo_listado[]=[
            'name'=>'Vista de Resúmen',
            'onclick'=>"set_filas_x('".$tb."','modificador');".
                'return false;',
            'class'=>'link_modificador',
        ];
        $menu_tipo_listado[]=[
            'name'=>'Vista de Tabla',
            'onclick'=>"set_filas_x('".$tb."','modificador_grilla');".
                'return false;',
            'class'=>'link_modificador_grilla',
        ];

    }


        
        render_view([
            'items'=>[
                [
                    'class'=>'menudown switch_type_list',
                    'aclass'=>'menu_icono',
                    'items'=>$menu_tipo_listado,
                ]
            ]
        ],'links_float.php'); 


    if(0){

        echo '<a class=" open_modificador_grilla link_modificador" '.
        ' onclick="set_filas_x(\''.$tb.'\',\'modificador\'); return false;" '.
        ' title="Vista de Resúmen" '.
        ' ></a>';

        echo '<a class=" open_modificador link_modificador_grilla" '.
        ' onclick="set_filas_x(\''.$tb.'\',\'modificador_grilla\'); return false;" '.
        ' title="Vista de Tabla" '.
        ' ></a>';

    } 

}