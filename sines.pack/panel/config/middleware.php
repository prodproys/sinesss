<?php

function middleware_menu($menu){
    
    global $SERVER;
    global $_SESSION;

    $menu_before=[];
    $menu_after=[];
    
    $menu_before=[
        'principal'=>[
            'ite' => 'Dashboard',
            'item' => 'Principal',
            'class' => 'group_link_principal',
            'text' => 'Principal',
            'items' => [
                [
                    'class' => 'menu_link_dashboard ',
                    'href' => 'pages.php?page=dashboard',
                    'text' => 'Dashboard',
                ],
                [
                    'class' => 'seccion_link_monitor seccion',
                    'text' => 'monitoreo'
                ],
                [
                    'class' => 'menu_link_alerts ',
                    'href' => 'pages.php?page=alerts',
                    'text' => 'Alertas',
                ],  
                [
                    'class' => 'menu_link_general ',
                    'href' => 'pages.php?page=general',
                    'text' => 'General',
                ],                                
            ]
        ],
    ];

    foreach($menu_before as $id_group=> $group){
        foreach($group['items'] as $id_link=> $link){
            if($link['href']==$SERVER['RUTA_RELATIVA']){
                $menu_before[$id_group]['items'][$id_link]['class'].=" selected";
                $menu_before[$id_group]['checked']='1';
            }
        }
    }
    
    if($_SESSION['usuario_datos_id_grupo']==''){


        $menu_after=[
            'informes'=>[
                'ite' => 'Informe',
                'item' => 'Informes',
                'class' => 'group_link_informes',
                'text' => 'Informes',
                'items' => [
                    // [
                    //     'class' => 'menu_link_informe',
                    //     'href' => 'pages.php?page=informe',
                    //     'text' => 'Informe de Casos Repetidos',
                    // ], 
                    [
                        'class' => 'menu_link_informe',
                        'href' => 'pages.php?page=md_general-1',
                        'text' => 'Informe General',
                    ], 
                    [
                        'class' => 'menu_link_trporte',
                        'href' => 'pages.php?page=md_reportes',
                        'text' => 'Informe Reportes',
                    ],                                                              
                    [
                        'class' => 'menu_link_informe',
                        'href' => 'pages.php?page=md_informe-20200802',
                        'text' => 'Informe de Cierre',
                    ], 
                    [
                        'class' => 'menu_link_new-importer',
                        'href' => 'pages.php?page=md_informe-new-importer',
                        'text' => 'Importador de Excel V 2.0',
                    ],   
                    [
                        'class' => 'menu_link_2_etapa',
                        'href' => 'pages.php?page=md_etapa-2',
                        'text' => 'Informe 2da Etapa',
                    ],                                                           
                ]
            ],
        ];

        foreach($menu_after as $id_group=> $group){
            foreach($group['items'] as $id_link=> $link){
                if($link['href']==$SERVER['RUTA_RELATIVA']){
                    $menu_after[$id_group]['items'][$id_link]['class'].=" selected";
                    $menu_after[$id_group]['checked']='1';
                }
            }
        }

    }

    $menu=array_merge($menu_before,$menu,$menu_after);

    return $menu;

}

function middleware_menu_header(){
 
    global $_SESSION;
    echo "<div class='middleware_header'>";
        echo "<div class='nombre_completo'>".$_SESSION['usuario_datos_nombre']."</div>";
        echo "<div class='butones'>
            <a onclick=\"javascript:document.body.classList.add('dark');fetch('ajax_change_cookie.php?var=dark&val=1');theme='dark';return false;\" class='link_dark_mode' title='Modo Oscuro'></a>
            <a onclick=\"javascript:document.body.classList.remove('dark');fetch('ajax_change_cookie.php?var=dark&val=0');theme='light';return false;\" class='link_light_mode' title='Modo Claro'></a>
            <a data-url='modal.php?page=form_user_change_password' class='modal-link form_user_change_password' title='Cambiar Contraseña'></a>
            <a data-url='modal.php?page=form_user_edit' class='modal-link form_user_edit' title='Editar Perfil'></a>
            <a href='salir.php' class='logout_link' title='Salir'></a>
        </div>";
        
    echo "</div>";

}

function middleware_object($objeto){

    global $_GET;
    global $MEEE;
    $mi =($_GET['OB']!='')?$_GET['OB']:$MEEE['me'];
    // prin($_GET);
    if( $_GET['mw']=='1' or $_GET['mw']=='2' )
    {
        if( $_GET['mw']=='1' ){

            $objeto[$mi]['campos']['last_primary']['queries']='1';
            $objeto[$mi]['campos']['last_primary']['listable']='1';
            $objeto[$mi]['campos']['is_caee']['listable']='0';

        } elseif( $_GET['mw']=='2' ){

            $objeto[$mi]['campos']['last_secondary']['queries']='1';        
            $objeto[$mi]['campos']['last_secondary']['listable']='1';        
            $objeto[$mi]['campos']['is_member']['listable']='0';

        }
        // quitar queries
        $objeto[$mi]['campos']['id_group']['queries']='0';
        $objeto[$mi]['campos']['is_member']['queries']='0';
        $objeto[$mi]['campos']['id_location']['queries']='0';
        $objeto[$mi]['campos']['is_caee']['queries']='0';

        // quitar queries
        $objeto[$mi]['campos']['id_location']['listable']='0';         
        
        $objeto[$mi]['campos']['code']['label']='Cod. Planilla';
        $objeto[$mi]['campos']['code']['width']='100px';

        $objeto[$mi]['campos']['nombre']['label']='Nombre y Apellidos';
        $objeto[$mi]['campos']['nombre']['width']='250px';

        $objeto[$mi]['campos']['id_group']['width']='130px';

    }
    if( $_GET['mw']=='3' ){

        $objeto[$mi]['include_controller']='controller_documentos.php';
        $objeto[$mi]['include_list']='view_documentos_list.php';

    }

    return $objeto;
}

/*
function middleware_header(){
 
    global $_SESSION;
    echo "<div class='middleware_header'>";
        echo "<div class='nombre_completo'>".$_SESSION['usuario_datos_nombre']."</div>";
        echo "<div class='butones'>
            <a onclick=\"javascript:document.body.classList.add('dark');fetch('ajax_change_cookie.php?var=dark&val=1');theme='dark';return false;\" class='link_dark_mode' title='Modo Oscuro'></a>
            <a onclick=\"javascript:document.body.classList.remove('dark');fetch('ajax_change_cookie.php?var=dark&val=0');theme='light';return false;\" class='link_light_mode' title='Modo Claro'></a>
            <a data-url='modal.php?page=form_user_change_password' class='modal-link form_user_change_password' title='Cambiar Contraseña'></a>
            <a data-url='modal.php?page=form_user_edit' class='modal-link form_user_edit' title='Editar Perfil'></a>
            <a href='salir.php' class='logout_link' title='Salir'></a>
        </div>";
        
    echo "</div>";

}
*/

function middleware_header_menu(){
    if(1)
    echo "<div class='div-search'>
        <i class='search-icon'></i>
        <input class='form-control form-control-sm' type='text' id='main-search_dl' placeholder='búsqueda de personas: código, nombre, apellido o dni'>
        <input type='hidden' id='main-search' >
    </div>";
    if(0)
    echo "<div class='div-search'>
        <i class='search-icon'></i>
        <input class='form-control form-control-sm' type='text' id='main-search_documents_dl' placeholder='búsqueda de documentos: seguimiento, código, nombre, apellido o dni'>
        <input type='hidden' id='main-search_documents' >
    </div>";    
}

function middleware_context_list($MI){

    global $objeto_tabla;

    global $_SESSION;

    if($_SESSION['permisos']['PERMISOS_ID']=='2'){

        if($_SESSION['usuario_datos_id_grupo']!=''){

            $id_grupo=$_SESSION['usuario_datos_id_grupo'];

            if($MI['me']=='PEOPLE'){
                
                $objeto_tabla['PEOPLE']['more']['locations']=
                $MI['more']['locations']=
                'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                // $MI['campos']['id_settlement']['listable']='0';
                // $MI['campos']['id_settlement']['queries']='0';
                return [
                    $MI,
                    // " and locations.id_settlement='$id_grupo' "
                    " and id_location in (select id from locations where id_settlement='$id_grupo')"
                ];

            }

            if($MI['me']=='LOCATIONS'){
                
                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['LOCATIONS']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['LOCATIONS']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and id_settlement='$id_grupo' "
                ];

            }

            if($MI['me']=='SETTLEMENTS'){
            
                return [
                    $MI,
                    " and id='$id_grupo' "
                ];

            }    

            if($MI['me']=='ZONES'){
                
                return [
                    $MI,
                    " and id in (select id_zone from settlements where id='$id_grupo' ) "
                ];

            }

            if($MI['me']=='DOCUMENTOS'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['DOCUMENTOS']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['DOCUMENTOS']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and locations.id_settlement='$id_grupo' "

                ];

            }

            if($MI['me']=='PRIMARY_SHARES'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['PRIMARY_SHARES']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['PRIMARY_SHARES']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and primaryshares.id_settlement='$id_grupo' "

                ];

            }  
            
            if($MI['me']=='SECONDARY_SHARES'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['SECONDARY_SHARES']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['SECONDARY_SHARES']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and secondaryshares.id_settlement='$id_grupo' "

                ];

            }          

            if($MI['me']=='SETTLEMENT_MANAGMENT_GROUP'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['SETTLEMENT_MANAGMENT_GROUP']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['SETTLEMENT_MANAGMENT_GROUP']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and settlement_managment_group.id_settlement='$id_grupo' "

                ];

            }  

            if($MI['me']=='RECORDS'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['RECORDS']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['RECORDS']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and records.id_settlement='$id_grupo' "

                ];

            }         

            if($MI['me']=='PAYMENTS'){

                // $objeto_tabla['PEOPLE']['more']['locations']=
                // $MI['more']['locations']=
                // 'id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location';
                $objeto_tabla['PAYMENTS']['campos']['id_settlement']['listable']=
                $MI['campos']['id_settlement']['listable']='0';

                $objeto_tabla['PAYMENTS']['campos']['id_settlement']['queries']=
                $MI['campos']['id_settlement']['queries']='0';
                
                // prin(" and id_settlement='$id_grupo' ");

                return [
                    $MI,
                    " and payments.id_settlement='$id_grupo' "

                ];

            }          
            
        } 
        else {

            return [$MI,' and 0 '];

        }

    }

    return [$MI,'  '];

}

function middleware_onload(){
    global $_GET;
    global $SERVER;
    list($archivo,$params)=explode('.php',$SERVER['ARCHIVO']);
    if($archivo=='documents' and $_GET['sub']=='documents'){
        $id_persona=dato('id_persona','documents','where id='.$_GET['i']);
        // $url = $SERVER['PANEL']."/custom/people.php?i=".$id_persona."&sub=documents";
        $url = "people.php?i=".$id_persona."&sub=documents";
        @header("Location: $url");
        die();
    }
}

/*
##       #### ########
##        ##  ##     ##
##        ##  ##     ##
##        ##  ########
##        ##  ##     ##
##        ##  ##     ##
######## #### ########
*/

function update_evolution($months,$types=[0,1],$settlements=[],$groups=[]){
    
    if(sizeof($settlements)==0){
        $settlements_a=select([
            "distinct id_settlement as id_settlement"]
            ,"primaryshares"
        );
        foreach($settlements_a as $sett){
            $settlements[]=$sett['id_settlement'];
        }
    }

    if(sizeof($groups)==0){

        $groups=[
            'cas',
            'cn',
        ];

    }
    
    if(0)
    prin(
        [
            'months'=>$months,
            'types'=>$types,
            'settlements'=>$settlements,
            'groups'=>$groups,
        ]
    );
    // exit();


    
    // prin($settlements);
    
    // prin(['from'=>$from,'to'=>$to]);
    
    
    
    $types_tables=[
        '0'=>"primaryshares",
        '1'=>"secondaryshares"
    ];
    

    foreach($months as $month){

        foreach($types as $type){
            
            /*
            ########  #######  ########    ###    ##
               ##    ##     ##    ##      ## ##   ##
               ##    ##     ##    ##     ##   ##  ##
               ##    ##     ##    ##    ##     ## ##
               ##    ##     ##    ##    ######### ##
               ##    ##     ##    ##    ##     ## ##
               ##     #######     ##    ##     ## ########
            */
            if(1)
            {
                $series_sql1[$type][$month]=contar(
                    $types_tables[$type],
                    "
                    where month ='$month' 
                    and type!='Empty'
                    ",
                    0
                );
                if(1)
                foreach($series_sql1[$type] as $month=>$total){
        
                    if(hay("people_evolution_general","where month='$month' and is_caee='$type' "))
                        update(
                            ['total'=>$total],
                            "people_evolution_general",
                            "where month='$month' and is_caee='$type' "
                        );
                    else
                        insert([
                            'total'=>$total,
                            'month'=>$month,
                            'is_caee'=>$type,
                        ],"people_evolution_general");
        
                }
            }

            /*
            ########     ###     ######  ########  ######
            ##     ##   ## ##   ##    ## ##       ##    ##
            ##     ##  ##   ##  ##       ##       ##
            ########  ##     ##  ######  ######    ######
            ##     ## #########       ## ##             ##
            ##     ## ##     ## ##    ## ##       ##    ##
            ########  ##     ##  ######  ########  ######
            */
            if(1)
            foreach($settlements as $id_settlement){
        
                if(1)
                $series_sql2[$id_settlement][$type][$month]=contar(
                    $types_tables[$type],
                    "
                    where month ='$month' 
                    and type!='Empty'
                    and id_settlement= ".$id_settlement."
                    ",
                    0
                );
        
                if(1)
                foreach($series_sql2[$id_settlement][$type] as $month=>$total){
        
                    if(hay("people_evolution","where month='$month' and is_caee='$type' and id_settlement='$id_settlement' "))
                        update(
                            ['total'=>$total],
                            "people_evolution",
                            "where month='$month' and is_caee='$type' and id_settlement='$id_settlement' "
                        );
                    else
                        insert([
                            'total'=>$total,
                            'month'=>$month,
                            'is_caee'=>$type,
                            'id_settlement'=>$id_settlement,
                        ],"people_evolution");
        
                }
                // prin($series_sql2[$type]);
        
        

        
            }

            /*
            ########  ########  ######   #### ##     ## ######## ##    ## ########  ######
            ##     ## ##       ##    ##   ##  ###   ### ##       ###   ## ##       ##    ##
            ##     ## ##       ##         ##  #### #### ##       ####  ## ##       ##
            ########  ######   ##   ####  ##  ## ### ## ######   ## ## ## ######    ######
            ##   ##   ##       ##    ##   ##  ##     ## ##       ##  #### ##             ##
            ##    ##  ##       ##    ##   ##  ##     ## ##       ##   ### ##       ##    ##
            ##     ## ########  ######   #### ##     ## ######## ##    ## ########  ######
            */
            if(1)
            foreach($groups as $id_group){
        
                if(1)
                $series_sql3[$id_group][$type][$month]=contar(
                    $types_tables[$type],
                    "
                    where month ='$month' 
                    and type!='Empty'
                    and id_group= '".$id_group."'
                    ",
                    0
                );
        
                if(1)
                foreach($series_sql3[$id_group][$type] as $month=>$total){
        
                    if(hay("people_evolution_group","where month='$month' and is_caee='$type' and id_group='$id_group' "))
                        update(
                            ['total'=>$total],
                            "people_evolution_group",
                            "where month='$month' and is_caee='$type' and id_group='$id_group' "
                        );
                    else
                        insert([
                            'total'=>$total,
                            'month'=>$month,
                            'is_caee'=>$type,
                            'id_group'=>$id_group,
                        ],"people_evolution_group");
        
                }
                // prin($series_sql2[$type]);
            }

        }

    }
    
    if(0){
    prin($series_sql1,'total');
    prin($series_sql2,'base');
    prin($series_sql3,'regimen');
    }
}

// prin($_SESSION);