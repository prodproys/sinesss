<?php

unset($objeto_tabla_comp);

/*
 ######   #######  ##    ## ######## ####  ######
##    ## ##     ## ###   ## ##        ##  ##    ##
##       ##     ## ####  ## ##        ##  ##
##       ##     ## ## ## ## ######    ##  ##   ####
##       ##     ## ##  #### ##        ##  ##    ##
##    ## ##     ## ##   ### ##        ##  ##    ##
 ######   #######  ##    ## ##       ####  ######
*/
$objecto_tabla_common['issues']['config']=[

    'eliminar'		=> '0',
    'editar'		=> '0',
    'crear'			=> '0',
    'duplicar'		=> '0',
    'altura_listado'	=> 'auto',
    'visibilidad'	=> '1',
    'buscar'		=> '1',
    'bloqueado'		=> '0',
    'menu'			=> '1',
    'por_pagina'	=> '100',
    'orden'			=> '1',
    'crear_label'	=> '80px',
    'crear_txt'		=> '660px',
    'filtros_extra'	=> '',

    'edicion_completa'=> '1',
    'edicion_rapida'=> '0',
    'calificacion'	=> '1',
    'importar_csv'	=> '0',
    // 'order_by'		=> 'orden desc, id_grupo desc',
    'width_listado'	=> '',
    'crear_pruebas'	=> '0',

    'order_by'		=> 'id asc',

];

/*
 #######  ########   ######      ###    ##    ## #### ########    ###     ######  ####  #######  ##    ##    ###    ##
##     ## ##     ## ##    ##    ## ##   ###   ##  ##       ##    ## ##   ##    ##  ##  ##     ## ###   ##   ## ##   ##
##     ## ##     ## ##         ##   ##  ####  ##  ##      ##    ##   ##  ##        ##  ##     ## ####  ##  ##   ##  ##
##     ## ########  ##   #### ##     ## ## ## ##  ##     ##    ##     ## ##        ##  ##     ## ## ## ## ##     ## ##
##     ## ##   ##   ##    ##  ######### ##  ####  ##    ##     ######### ##        ##  ##     ## ##  #### ######### ##
##     ## ##    ##  ##    ##  ##     ## ##   ###  ##   ##      ##     ## ##    ##  ##  ##     ## ##   ### ##     ## ##
 #######  ##     ##  ######   ##     ## ##    ## #### ######## ##     ##  ######  ####  #######  ##    ## ##     ## ########
*/

// * PERSONAS
$PEOPLE=array_merge(
    [
        'me'			=> 'PEOPLE',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Personas',
        'nombre_singular'=> 'persona',
        'nombre_plural'	=> 'personas',
        'tabla'			=> 'people',
        'archivo'		=> 'people',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'pep',
        'menu_label'	=> 'Personas',

        'main_campo'    => 'apellidos;nombre',

        'controles'			=> '<a class="btn controles" id="controles_reportes" data-status="on" onclick="'
        .'if(document.getElementById(\'controles_reportes\').dataset.status==\'on\'){'
            .'document.getElementById(\'controles_reportes\').dataset.status=\'off\';'
            .'document.querySelector(\'body\').classList.add(\'mode_sub\');'
            .'document.querySelector(\'body\').classList.remove(\'mode_main\');'
        .'} else {'
            .'document.getElementById(\'controles_reportes\').dataset.status=\'on\';'
            .'document.querySelector(\'body\').classList.remove(\'mode_sub\');'
            .'document.querySelector(\'body\').classList.add(\'mode_main\');'
        .'}'
        .'">Reportes</a>',
                
        'joins'			=>[
            'locations'		=> 'people.id_location=locations.id',
        ],

		'more'			=>[
            'locations'		=> '
                id_settlement?listable=1&queries=1&label=Base&after=id_location,
                id_zone?listable=1&queries=0&label=Red Asistencial&after=id_location			
            ',
                // 'usuarios'		=> 'id_jefe?listable=1&queries=1&after=id_usuario',
        ], 
        
        'include_detail_after'=>'people_detail_after.php',

        'include_list_after'=>'people_list_after.php',

        'postscript'=>'

            $people=select("id,birthday","people","where birthday is not null and birthday!=\"0000-00-00 00:00:00\" ");
            foreach($people as $person){
                $fecha = new DateTime(substr($person["birthday"],0,10));
                $ahora = new DateTime(date("Y-m-d"));
                $interval = $fecha->diff($ahora);
            
                $age=$interval->y . " años " . $interval->m." meses ";
                update(["edad"=>$age],"people","where id=".$person["id"],0);
            }

            $rango["39"]=["hasta"=>"0","desde"=>"39"];
            $rango["49"]=["hasta"=>"40","desde"=>"49"];
            $rango["59"]=["hasta"=>"50","desde"=>"59"];
            $rango["64"]=["hasta"=>"60","desde"=>"64"];
            $rango["150"]=["hasta"=>"65","desde"=>"150"];
            foreach($rango as $ee=>$rang){
                $from=$rango[$ee]["from"]=date("Y-01-01 00:00:00",strtotime("-".$rang["desde"]." years"));
                $to=$rango[$ee]["to"]=date("Y-12-31 23:59:59",strtotime("-".$rang["hasta"]." years"));
                update(["rango_edad"=>$ee],"people","where birthday between \"$from\" and \"$to\"");
            }
            
            update(["rango_edad"=>"sf"],"people","where birthday is null or birthday=\"0000-00-00 00:00:00\"");
            
        ',

        'special_queries'=>[
            'query-1'=>[
                'options'=>[
                    'value1'=>'sin aportaciones el último mes',
                    'value2'=>'sin aportaciones los 2 últimos meses',
                    'value3'=>'sin aportaciones los 3 últimos meses',
                ]
            ]
        ],

        'exportar_excel'=>'1',

        'list_options'=> [
			[
				'name'=>'Importar Aportaciones desde un archivo',
				'url'=>'pages.php?page=import2',
            ],
			[
				'name'=>'Códigos para Otros Pagos',
				'url'=>'custom/conceptos.php',
			]            
		],

        'options_detail'=>[
            '<a data-url="modal.php?page=form_people_action_agregar_aportacion&id_person=[id]" class="modal-share-link form_people_action_agregar_aportacion" >Registrar aportaciones regulares</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_caee&id_person=[id]" class="modal-share-link form_people_action_agregar_caee" >Registrar aportaciones CAEE</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_pagp&id_person=[id]" class="modal-share-link form_people_action_agregar_pagp" >Registrar otro pago</a>',

            '<a data-url="modal.php?page=form_people_action_afiliar_person&id_person=[id]" class="modal-link form_people_action_afiliar_person" >Afiliación</a>',
            '<a data-url="modal.php?page=form_people_action_desafiliar_person&id_person=[id]" class="modal-link form_people_action_desafiliar_person" >Desafiliar</a>',

            '<a data-url="modal.php?page=form_people_action_afiliar_caee&id_person=[id]" class="modal-link form_people_action_afiliar_caee" >Acepta CAEE</a>',
            '<a data-url="modal.php?page=form_people_action_desafiliar_caee&id_person=[id]" class="modal-link form_people_action_desafiliar_caee" >Cancelación CAEE</a>',

            '<a data-url="modal.php?page=form_people_action_traslados&id_person=[id]" class="modal-link form_people_action_traslados" >Traslados</a>',


        ],

        'campos'		=>array_merge(
            $objeto_tabla_common['base'],
            [
                'code'			=>array_merge(
                    [
                        'campo'			=> 'code',
                        'label'			=> 'Código de planilla',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '1',
                        'validacion'      => '1',
                        'style'			=> 'width:150px;',
                    ]
                ),
                'edad'			=>array_merge(
                    [
                        'indicador'		=> '1',
                        'campo'			=> 'edad',
                        'label'			=> 'Edad',
                        'tipo'			=> 'inp',
                        'width'         => '75px',
                        'listable'      => '1',
                        'validacion'      => '0',
                        'style'			=> 'width:150px;',
                        'noedit'		=> '1',
                    ]
                ),   
                       
                'rango_edad'		=>array(
                    'campo'			=> 'rango_edad',
                    'label'			=> 'Rango Edad',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    // 'validacion'	=> '1',
                    'opciones'		=>array(
                        '39' => '< 40 años',
                        '49' => '40 a 49',
                        '59' => '50 a 59',
                        '64' => '60 a 65',
                        '150' => '>  65',
                        'sf' => 'Sin fecha',
                    ),
                    'noedit'		=> '1',
                    'queries'		=> '1',
                    'default'		=> 'sf',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),
				'nombre'	=>array_merge(
                    [
                        'campo'			=> 'nombre',
                        'label'			=> 'Nombre',
                    ]
                    ,$objeto_fields_common['first_name']
                    ,[
                        // 'directlink'	=> 'id,apellidos;nombres;code;document_number|people',
                        'campo_query'   => "apellidos;nombre as nombre",
                        'width'         => '200px',
                        'controles_noquery'=>'1',
                        'tip_foreig'     => '1',
                        // 'directlink_include'=>'base2/apps/directlink_cliente_hack.php',
						'queries'		=> '1',
                        'dlquery'		=> '1',
                        'campos_search'  => "code;nombre;apellidos;document_number",
                        'dl_placeholder' => 'código nombre apellidos dni',
                        'noedit'     => '0',
                    ]
                ), 
				'apellidos'	=>array_merge(
                    [
                        'campo'			=> 'apellidos',
                        'label'			=> 'Apellidos',
                    ]
                    ,$objeto_fields_common['last_name']
                    ,[
                        'listable'       => '0',
                        'validacion'     => '1',
                        'noedit'     => '0',
                    ]
                ),
				'id_group'		=>array(
                    'campo'			=> 'id_group',
                    'label'			=> 'Régimen Laboral',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'opciones'		=>array(
                        'cn' => 'Contratados/Nombrados',
                        'cas' => 'CAS',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),
                'id_location'		=>array(
                    'campo'			=> 'id_location',
                    'label'			=> 'Trabaja en',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|locations|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '1',
                    'tip_foreig'	=> '1',
                    'width'			=> '120px',
                    //! LINK EXTERNO
                    'foreigkey'     => 'LOCATIONS',
                    'foreig'        => '1',
                    'default'       => '[id_location]',
                    'noedit'		=> '1',


                    // 'select_multiple'=> '1',
                ), 

                'is_member'		=>array(
                    'campo'			=> 'is_member',
                    'label'			=> 'Estado de Agremiado',
                    'tipo'			=> 'com',
                    // 'indicador'		=> '1',
                    'opciones'		=>array(
                        '1' => 'Agremiado|#00c292;white',
                        '0' => 'No agremiado|#465161;white',
                        '2' => 'Desafiliado|#1859a7;white',
                        '3' => 'Cesante|#be252b;white',
                        '4' => 'Fallecido|#000000;white',
                    ),
                    'options-row-style'=>[
                        '1' => 'line-member',
                        '0' => 'line-nomember',
                        '2' => 'line-nomember',
                        '3' => 'line-nomember',
                        '4' => 'line-nomember',
                    ],                    
                    'validacion'	=> '0',
                    'listable'		=> '1',
                    'queries'		=> '1',
                    'default'		=> '0',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px',
                    // 'constante'		=> '1',
                ), 
				'is_caee'		=>array(
                    'campo'			=> 'is_caee',
                    'label'			=> 'CAEE',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'constante'		=> '0',
                    'indicador'		=> '1',
                    // 'validacion'	=> '0',
                    'opciones'		=>array(
                        '1' => 'Acepta CAEE|#ab8ce4;#ffffff',
                        '0' => 'Nunca Acepto CAEE|#465161;white',
                        '2' => 'Desafiliado de CAEE|#1859a7;white',
                    ),
                    'options-row-style'=>[
                        '1' => 'line-iscaee',
                        '0' => 'line-nocaee',
                        '2' => 'line-nocaee',
                    ],                       
                    'queries'		=> '1',
                    'default'		=> '0',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px'
                ),
                
				'phone'	=>array_merge(
                    [
                    'campo'			=> 'phone',
                    'label'			=> 'Teléfono',
                    ]
                    ,$objeto_fields_common['phone']
                    ,[
                        'listable'			=> '1',
                    ]
                ),
                'email' => array_merge(
                    [
                    'campo' => 'email',
                    'label' => 'Email',
                    ]
                    ,$objeto_fields_common['email']
                    ,[
                        'listable'			=> '0',
                    ]
                ),
                'document_number' => array(
                    'campo' => 'document_number',
                    'label' => 'DNI',
                    'width'			=> '80px',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'style'			=> 'width:150px;',
                    'derecha'		=> '1'
                ),
                'other_organization1' => array_merge(
                    [
                    'campo' => 'other_organization1',
                    'label' => '¿Afiliado al FEDCUT?',
                    ]
                    ,$objeto_fields_common['bit']
                    ,[
                        'listable'			=> '1',
                    ]
                ),  
                'other_organization2' => array_merge(
                    [
                    'campo' => 'other_organization2',
                    'label' => '¿Afiliado a FAMENSALUD?',
                    ]
                    ,$objeto_fields_common['bit']
                    ,[
                        'listable'			=> '1',
                    ]
                ),
                'other_organization3' => array_merge(
                    [
                    'campo' => 'other_organization3',
                    'label' => '¿Afiliado a CUT?',
                    ]
                    ,$objeto_fields_common['bit']
                    ,[
                        'listable'			=> '1',
                    ]                    
                ),
                'other_organization4' => array_merge(
                    [
                    'campo' => 'other_organization4',
                    'label' => '¿Afiliado a otros sindicatos?',
                    ]
                    ,$objeto_fields_common['bit']
                    ,[
                        'listable'			=> '0',
                    ]                    
                ),
                
                's_activity_1' => array(
                    'campo' => 's_activity_1',
                    'label' =>  'S.Actividad.1',
                    'width'			=> '130px',
                    'tipo'			=> 'inp',
                    'listable'		=> '0',
                    // 'validacion'	=> '1',
                    'style'			=> 'width:450px;',
                    'derecha'		=> '1'
                ),
                's_activity_2' => array(
                    'campo' => 's_activity_2',
                    'label' =>  'S.Actividad.2',
                    'width'			=> '130px',
                    'tipo'			=> 'inp',
                    'listable'		=> '0',
                    // 'validacion'	=> '1',
                    'style'			=> 'width:450px;',
                    'derecha'		=> '1'
                ),
                'speciality' => array(
                    'campo' => 'speciality',
                    'label' =>  'Especialidad',
                    'width'			=> '130px',
                    'tipo'			=> 'inp',
                    'listable'		=> '0',
                    // 'validacion'	=> '1',
                    'style'			=> 'width:450px;',
                    'derecha'		=> '1'
                ),
                
                'publications' => array(
                    'campo' => 'publications',
                    'label' =>  'Publicaciones',
                    'tipo'			=> 'txt',
                    'listable'		=> '0',
                    'validacion'	=> '0',
                    'width'			=> '700px',
                    'style'			=> 'min-width:450px;width:450px;height:80px;'
                ),
                
                
				        'birthday'	=>array_merge(
                    [
                    'campo'			=> 'birthday',
                    'label'			=> 'Fecha de nacimiento',
                    ]
                    ,$objeto_fields_common['date']
                    ,[
                        'listable'			=> '0',
                        // 'queries'=>'1',
                        // 'query-options'=>[
                        //     // 'year-month'=>'1',
                        //     'year'=>'1',
                        //     'no-specific'=>'1',
                        //     'no-show-days'=>'1',
                        // ],                        
                    ]
                ),
                
                
                'last_primary'=>array_merge(
                    [
                        'campo'	=> 'last_primary',
                        'label'	=> 'Último Aporte Regular',
                        'tipo'  => 'fch',
                        'formato'  => '4b',
                        'rango'  => '-10 years,+0years' ,
                        'width' => '160px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'queries' => '0',
                        'query-options'=>[
                            'year-month'=>'1',
                            'no-specific'=>'1',
                            'no-show-days'=>'1',
                            'last-months'=>'6',
                            'middleware'=>'last-months',
                        ],
                        'constante'		=> '1'
                    ]
                ),
                
                'last_secondary'=>array_merge(
                    [
                        'campo'	=> 'last_secondary',
                        'label'	=> 'Último Aporte CAEE',
                        'tipo'  => 'fch',
                        'formato'  => '4b',
                        'rango'  => '-10 years,+0years' ,
                        'width' => '160px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'queries' => '0',
                        'query-options'=>[
                            'year-month'=>'1',
                            'no-specific'=>'1',
                            'no-show-days'=>'1',
                            'last-months'=>'6',
                            'middleware'=>'last-months',
                        ],
                        'constante'		=> '1'

                    ]
                ),
                
                'id_personalink'=>array(
                    'campo'			=> 'id_personalink',
                    'label'			=> 'eliminado',
                    'listable'		=> '0',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre;apellidos|peopleold|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '0',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    'width'			=> '120px',
                    'constante'		=> '1',
                ), 
                'codeold'=>array_merge(
                    [
                        'campo'			=> 'codeold',
                        'label'			=> 'Codigo de eliminado',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '0',
                        'constante'		=> '1'
                    ]
                ),  

                
                
            ]
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'por_pagina'=>'25',
        'order_by'		=> 'apellidos asc',
        'crear' => '1',
        'editar' => '1',
        'edicion_completa'=>'1'
        // 'listado_web'=>'code,nombre',
        // 'listado_mobile'=>'code,nombre',
    ]
);

// * BASES
$SETTLEMENTS=array_merge(
    [
        'me'			=> 'SETTLEMENTS',
        'grupo'			=> 'organizacional',
        'seccion'		=> 'canales',
        'titulo'		=> 'Bases',
        'nombre_singular'=> 'base',
        'nombre_plural'	=> 'bases',
        'tabla'			=> 'settlements',
        'archivo'		=> 'settlements',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'set',
        'menu_label'	=> 'Bases',
        'main_campo'    => 'nombre',

        'exportar_excel'=>'1',

        'include_detail_after'=>'settlements_detail_after.php',
        'include_list_after'=>'settlements_list_after.php',
        
        'controles'			=> '<a class="btn controles" id="controles_reportes" data-status="on" onclick="'
        .'if(document.getElementById(\'controles_reportes\').dataset.status==\'on\'){'
            .'document.getElementById(\'controles_reportes\').dataset.status=\'off\';'
            .'document.querySelector(\'body\').classList.add(\'mode_sub\');'
            .'document.querySelector(\'body\').classList.remove(\'mode_main\');'
        .'} else {'
            .'document.getElementById(\'controles_reportes\').dataset.status=\'on\';'
            .'document.querySelector(\'body\').classList.remove(\'mode_sub\');'
            .'document.querySelector(\'body\').classList.add(\'mode_main\');'
        .'}'
        .'">Reportes</a>',


        'campos'		=>array_merge(
            [
              /*
              'birthday'	=>array_merge(
                [
                'campo'			=> 'birthday',
                'label'			=> 'Fecha de nacimiento',
                ]
                ,$objeto_fields_common['date']
                ,[
                    'listable'			=> '0',
                    // 'queries'=>'1',
                    // 'query-options'=>[
                    //     // 'year-month'=>'1',
                    //     'year'=>'1',
                    //     'no-specific'=>'1',
                    //     'no-show-days'=>'1',
                    // ],                        
                ]
                ),
                */
                'code'			=>array(
                    'campo'			=> 'code',
                    'tipo'			=> 'inp',
                    'label'			=> 'Código',
                    'validacion'	=> '1',
                    // 'variable'		=> 'int',
                    // 'size'		    => '10',
                    'listable'		=> '1',
                    'width'			=> '150px',
                    'style'			=> 'width:450px;',
                ),

                'nombre'		=>array(
                        'campo'			=> 'nombre',
                        'label'			=> 'Nombre',
                        'unique'		=> '0',
                        'width'			=> '200px',
                        'tipo'			=> 'inp',
                        'listable'		=> '1',
                        'validacion'	=> '1',
                        'like'			=> '0',
                        'size'			=> '140',
                        'style'			=> 'width:450px;',
                        'tags'			=> '1',
                        'derecha'		=> '1',
                        'controles'     => '<a 
                        class="control-menu-item"
                        data-item="locations"
                        href="custom/locations.php?id_settlement=[id]">{select count(*) from locations where id_settlement=[id]} Entes</a>',

                        'queries'		=> '1',
                        'dlquery'		=> '1',
                        'campos_search'  => "nombre",
                        'dl_placeholder' => 'nombre',

                ),
                
                /*
                'rowid'			=>array(
                    'campo'			=> 'rowid',
                    'tipo'			=> 'inp',
                    'label'			=> 'RowId',
                    'variable'		=> 'int',
                    'size'		    => '10',
                    'listable'		=> '0',
                    'width'			=> '70px',
                    'style'			=> 'width:70px;',
                ),
                */  
                
				'description'		=>array(
                    'campo'			=> 'description',
                    'label'			=> 'Descripción',
                    'tipo'			=> 'txt',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '170px',
                    'style'			=> 'height:80px;width:550px;'
                ), 

				'is_closed'		=>array(
                    'campo'			=> 'is_closed',
                    'label'			=> 'Estado',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        '1'			=> 'Cerrada|#465161;white',
                        '0'			=> 'Activa|#00c292;white',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '80px'
                ),

                'id_zone'		=>array(
                    'campo'			=> 'id_zone',
                    'label'			=> 'Red Asistencial',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|zones|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'ZONES',
                    'foreig'        => '1',
                    'default'       => '[id_zone]',                    
                    // 'select_multiple'=> '1',
                ),                 
            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '1',
                    'width'         => '150px',
                    'formato'		=> '0a',                    
                ],                                

            ]
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        // 'order_by'		=> 'id_zone asc,code asc',
        'order_by'		=> 'code asc',
        'crear' => '1',
        'editar' => '1',
        'edicion_completa'=>'1'
    ]
);

// * REDES ASISTENCIALES
$ZONES=array_merge(
    [
        'me'			=> 'ZONES',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Redes Asistenciales',
        'nombre_singular'=> 'red asistencial',
        'nombre_plural'	=> 'redes asistenciales',
        'tabla'			=> 'zones',
        'archivo'		=> 'zones',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'zon',
        'menu_label'	=> 'Redes Asistenciales',
        'main_campo'    => 'nombre',

        'include_detail_after'=>'zones_detail_after.php',

        'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [

                'code'			=>array(
                    'campo'			=> 'code',
                    'tipo'			=> 'inp',
                    'label'			=> 'Código',
                    'validacion'	=> '1',
                    // 'variable'		=> 'int',
                    // 'size'		    => '10',
                    'listable'		=> '1',
                    'width'			=> '150px',
                    'style'			=> 'width:450px;',
                ),
                                
                'nombre'		=>array(
                        'campo'			=> 'nombre',
                        'label'			=> 'Nombre',
                        'unique'		=> '0',
                        'width'			=> '200px',
                        'tipo'			=> 'inp',
                        'listable'		=> '1',
                        'validacion'	=> '1',
                        'like'			=> '0',
                        'size'			=> '140',
                        'style'			=> 'width:450px;',
                        'tags'			=> '1',
                        'derecha'		=> '1',
                        'controles'     => '<a 
                        class="control-menu-item"
                        data-item="locations"
                        href="custom/locations.php?id_zone=[id]"
                        >{select count(*) from locations where id_zone=[id]} Entes</a>',
                        
                        'queries'		=> '1',
                        'dlquery'		=> '1',
                        'campos_search'  => "nombre",
                        'dl_placeholder' => 'nombre',
                ),	
                
                /*
                'rowid'			=>array(
                    'campo'			=> 'rowid',
                    'tipo'			=> 'inp',
                    'label'			=> 'RowId',
                    'variable'		=> 'int',
                    'size'		    => '10',
                    'listable'		=> '0',
                    'width'			=> '70px',
                    'style'			=> 'width:70px;',
                ),  
                */

				'description'		=>array(
                    'campo'			=> 'description',
                    'label'			=> 'Descripción',
                    'tipo'			=> 'txt',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '170px',
                    'style'			=> 'height:80px;width:550px;'
                ),  
                
               

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '1',
                    'width'         => '150px',
                    'formato'		=> '8c',                    
                ],                             

            ]       
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'nombre asc',
        'crear' => '1',
        'editar' => '1',
        'edicion_completa'=>'1'        
    ]
    
);

// * ENTES
$LOCATIONS=array_merge(
    [
        'me'			=> 'LOCATIONS',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Entes',
        'nombre_singular'=> 'ente',
        'nombre_plural'	=> 'entes',
        'tabla'			=> 'locations',
        'archivo'		=> 'locations',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'loc',
        'menu_label'	=> 'Entes',
        'main_campo'    => 'nombre',

        'include_detail_after'=>'locations_detail_after.php',

        'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [

                'code'			=>array(
                    'campo'			=> 'code',
                    'tipo'			=> 'inp',
                    'label'			=> 'Código',
                    'validacion'	=> '1',
                    // 'variable'		=> 'int',
                    // 'size'		    => '10',
                    'listable'		=> '1',
                    'width'			=> '150px',
                    'style'			=> 'width:450px;',
                ),

                'nombre'		=>array(
                    'campo'			=> 'nombre',
                    'label'			=> 'Nombre',
                    'unique'		=> '0',
                    'width'			=> '200px',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'like'			=> '0',
                    'size'			=> '140',
                    'style'			=> 'width:450px;',
                    'tags'			=> '1',
                    'derecha'		=> '1',
                    'controles'     => '<a 
                                    class="control-menu-item"
                                    data-item="people"
                                    href="custom/people.php?id_location=[id]"
                                    >{select count(*) from people where id_location=[id]} Personas</a>',
                  
                    'queries'		=> '1',
                    'dlquery'		=> '1',
                    'campos_search'  => "nombre",
                    'dl_placeholder' => 'nombre',                                    
                ),		



                /*
                'rowid'			=>array(
                    'campo'			=> 'rowid',
                    'tipo'			=> 'inp',
                    'label'			=> 'RowId',
                    'variable'		=> 'int',
                    'size'		    => '10',
                    'listable'		=> '0',
                    'width'			=> '70px',
                    'style'			=> 'width:70px;',
                ), 
                */   

				'description'		=>array(
                    'campo'			=> 'description',
                    'label'			=> 'Descripción',
                    'tipo'			=> 'txt',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '170px',
                    'style'			=> 'height:80px;width:550px;'
                ),   

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'listable'      => '1',
                    'label'         => 'Registrado el',
                    'width'         => '150px',
                    'formato'		=> '8c',
                ],

                'id_zone'		=>array(
                    'campo'			=> 'id_zone',
                    'label'			=> 'Red Asistencial',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|zones|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'ZONES',
                    'foreig'        => '1',
                    'default'       => '[id_zone]',                    
                    // 'select_multiple'=> '1',
                ),

                'id_settlement'		=>array(
                    'campo'			=> 'id_settlement',
                    'label'			=> 'Base',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|settlements|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'SETTLEMENTS',
                    'foreig'        => '1',
                    'default'       => '[id_settlement]',                    
                    // 'select_multiple'=> '1',
                ),                  
            ]
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'nombre asc',
        'crear' => '1',
        'editar' => '1',
        'edicion_completa'=>'1'        
    ]
);

$PEOPLEOLD=array_merge($PEOPLE,[
    'me'			=> 'PEOPLEOLD',
    'grupo'			=> 'organizacional',
    'titulo'		=> 'Personas repetidas',
    'nombre_singular'=> 'persona repetida',
    'nombre_plural'	=> 'personas repetidas',
    'tabla'			=> 'peopleold',
    'archivo'		=> 'peopleold',
    // 'archivo_hijo'	=> 'productos_fotos',
    'prefijo'		=> 'pepold',
    'menu_label'	=> 'Personas repetidas',
    'menu'          => '0',
    'eliminar'          => '0',
    'editar'          => '0',
    'joins'			=>[
        'locations'		=> 'peopleold.id_location=locations.id',
    ],
    'include_detail_after'=>null,


]);

// * PEOPLE EVOLUTION
$PEOPLE_EVOLUTION=array_merge(
    [
        'me'			=> 'PEOPLE_EVOLUTION',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Evoluciòn de aportantes',
        'nombre_singular'=> 'registro',
        'nombre_plural'	=> 'registros',
        'tabla'			=> 'people_evolution',
        'archivo'		=> 'people_evolution',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'zon',
        'menu_label'	=> 'Evolución de aportantes',
        // 'main_campo'    => 'nombre',

        // 'include_detail_after'=>'zones_detail_after.php',

        // 'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [

                'id_settlement'		=>array(
                    'campo'			=> 'id_settlement',
                    'label'			=> 'Base',
                    'width'			=> '200px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|settlements|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'SETTLEMENTS',
                    'foreig'        => '1',
                    'default'       => '[id_settlement]',                    
                    // 'select_multiple'=> '1',
                ),  
                                
				'is_caee'		=>array(
                    'campo'			=> 'is_caee',
                    'label'			=> 'CAEE',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        '1' => 'Acepta CAEE|#ab8ce4;#ffffff',
                        '0' => 'No acepta CAEE|#465161;white',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px'
                ),    
                
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ), 

                'total'			=>array_merge(
                    [
                        'campo'			=> 'total',
                        'label'			=> 'Total',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '1'
                    ]
                ), 
                
               

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '0',
                    'width'         => '150px',
                    'formato'		=> '8c',                    
                ],                             

            ]       
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'month desc,id_settlement desc',
        'menu'	        => '0',
    ]
    
);

// * PEOPLE EVOLUTION GROUPS
$PEOPLE_EVOLUTION_GROUP=array_merge(
    [
        'me'			=> 'PEOPLE_EVOLUTION_GROUP',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Evoluciòn de aportantes',
        'nombre_singular'=> 'registro',
        'nombre_plural'	=> 'registros',
        'tabla'			=> 'people_evolution_group',
        'archivo'		=> 'people_evolution_group',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'zon',
        'menu_label'	=> 'Evolución de aportantes',
        // 'main_campo'    => 'nombre',

        // 'include_detail_after'=>'zones_detail_after.php',

        // 'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [

				'id_group'		=>array(
                    'campo'			=> 'id_group',
                    'label'			=> 'Régimen Laboral',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        'cn' => 'Contratados/Nombrados',
                        'cas' => 'CAS',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),
                                
				'is_caee'		=>array(
                    'campo'			=> 'is_caee',
                    'label'			=> 'CAEE',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        '1' => 'Acepta CAEE|#ab8ce4;#ffffff',
                        '0' => 'No acepta CAEE|#465161;white',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px'
                ),    
                
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ), 

                'total'			=>array_merge(
                    [
                        'campo'			=> 'total',
                        'label'			=> 'Total',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '1'
                    ]
                ), 
                
               

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '0',
                    'width'         => '150px',
                    'formato'		=> '8c',                    
                ],                             

            ]       
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'month desc,id_settlement desc',
        'menu'	        => '0',
    ]
    
);

// * PEOPLE EVOLUTION GENERAL
$PEOPLE_EVOLUTION_GENERAL=array_merge(
    [
        'me'			=> 'PEOPLE_EVOLUTION_GENERAL',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Evoluciòn de aportantes',
        'nombre_singular'=> 'registro',
        'nombre_plural'	=> 'registros',
        'tabla'			=> 'people_evolution_general',
        'archivo'		=> 'people_evolution_general',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'zon',
        'menu_label'	=> 'Evolución de aportantes',
        // 'main_campo'    => 'nombre',

        // 'include_detail_after'=>'zones_detail_after.php',

        // 'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [
                                
				'is_caee'		=>array(
                    'campo'			=> 'is_caee',
                    'label'			=> 'CAEE',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        '1' => 'Acepta CAEE|#ab8ce4;#ffffff',
                        '0' => 'No acepta CAEE|#465161;white',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px'
                ),    
                
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ), 

                'total'			=>array_merge(
                    [
                        'campo'			=> 'total',
                        'label'			=> 'Total',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '1'
                    ]
                ), 
                
               

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '0',
                    'width'         => '150px',
                    'formato'		=> '8c',                    
                ],                             

            ]       
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'month desc,id_settlement desc',
        'menu'	        => '0',
    ]
    
);

// * PEOPLE EVOLUTION ALL
$PEOPLE_EVO=array_merge(
    [
        'me'			=> 'PEOPLE_EVO',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Evolución All',
        'nombre_singular'=> 'registro',
        'nombre_plural'	=> 'registros',
        'tabla'			=> 'people_evo',
        'archivo'		=> 'people_evo',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'zon',
        'menu_label'	=> 'Evolución All',
        // 'main_campo'    => 'nombre',

        // 'include_detail_after'=>'zones_detail_after.php',

        // 'exportar_excel'=>'1',

        'campos'		=>array_merge(
            [

                'id_settlement'		=>array(
                    'campo'			=> 'id_settlement',
                    'label'			=> 'Base',
                    'width'			=> '200px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|settlements|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'SETTLEMENTS',
                    'foreig'        => '1',
                    'default'       => '[id_settlement]',                    
                    // 'select_multiple'=> '1',
                ),  
                                
				'is_caee'		=>array(
                    'campo'			=> 'is_caee',
                    'label'			=> 'CAEE',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        '1' => 'Acepta CAEE|#ab8ce4;#ffffff',
                        '0' => 'No acepta CAEE|#465161;white',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '120px'
                ),

				'id_group'		=>array(
                    'campo'			=> 'id_group',
                    'label'			=> 'Régimen Laboral',
                    'tipo'			=> 'com',
                    'listable'		=> '1',
                    'indicador'		=> '1',
                    'validacion'	=> '0',
                    'opciones'		=>array(
                        'cn' => 'Contratados/Nombrados',
                        'cas' => 'CAS',
                    ),
                    'queries'		=> '1',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),

                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ), 

                'total'			=>array_merge(
                    [
                        'campo'			=> 'total',
                        'label'			=> 'Total',
                    ]
                    ,$objeto_fields_common['number']
                    ,[
                        'width'         => '75px',
                        'listable'      => '1'
                    ]
                ),

                'amount'=>array_merge(
                    [
                    'campo'	=> 'amount',
                    'label'	=> 'Monto',
                    ],
                    $objeto_fields_common['money']
                ),                 
               

            ],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '0',
                    'width'         => '150px',
                    'formato'		=> '8c',                    
                ],                             

            ]       
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'month desc,id_settlement desc',
        'menu'	        => '0',
    ]
    
);

$PEOPLEOLD['campos']['id_personalink']['label']='relevante';
$PEOPLEOLD['campos']['id_personalink']['opciones']='id,nombre;apellidos|people|order by nombre asc';



// prin($PEOPLE); exit();

/*
 ######  ##     ## ########     ######## ##       ######## ##     ## ######## ##    ## ########  ######
##    ## ##     ## ##     ##    ##       ##       ##       ###   ### ##       ###   ##    ##    ##    ##
##       ##     ## ##     ##    ##       ##       ##       #### #### ##       ####  ##    ##    ##
 ######  ##     ## ########     ######   ##       ######   ## ### ## ######   ## ## ##    ##     ######
      ## ##     ## ##     ##    ##       ##       ##       ##     ## ##       ##  ####    ##          ##
##    ## ##     ## ##     ##    ##       ##       ##       ##     ## ##       ##   ###    ##    ##    ##
 ######   #######  ########     ######## ######## ######## ##     ## ######## ##    ##    ##     ######


*/

$objeto_tabla_common['sub-elements']['campos']=[

    'id_persona'=>array_merge(
        [
        'campo'	=> 'id_persona',
        'label'	=> 'Persona',
        'tipo'  => 'hid',
        'width' => '180px',
        'style' => 'width:150px',
        'derecha' => '1',
        'validacion' => '0',
        'listable' => '1',
        'query' => '0',
        'default'		=> '[id_persona]',
        'opciones'		=> 'id,nombre;apellidos|people',
        'tip_foreig'	=> '1',
        'foreig'	=> '1',
        // 'foreigkey'	=> 'RECORDS',
        ]
    ),

    'id_personaold'=>array_merge(
        [
        'campo'	=> 'id_personaold',
        'label'	=> 'Persona',
        'tipo'  => 'hid',
        'width' => '180px',
        'style' => 'width:150px',
        'derecha' => '1',
        'validacion' => '0',
        'listable' => '0',
        'query' => '0',
        'default'		=> '[person_id]',
        'opciones'		=> 'id,nombre;apellidos|peopleold',
        'tip_foreig'	=> '1',
        'foreig' => '1',
        ]
    ),    
    'id_settlement'		=>array(
        'campo'			=> 'id_settlement',
        'label'			=> 'Base',
        'width'			=> '120px',
        'listable'		=> '1',
        'tipo'			=> 'hid',
        'opciones'		=> 'id,nombre|settlements|order by nombre asc',
        'derecha'		=> '1',
        'tags'			=> '1',
        'queries'		=> '1',
        'validacion'	=> '0',
        'tip_foreig'	=> '1',
        //! LINK EXTERNO
        'foreigkey'     => 'SETTLEMENTS',
        'foreig'        => '1',
        'default'       => '[id_settlement]',                    
        // 'select_multiple'=> '1',
    ), 
    'settlement_label'		=>array(
        'campo'			=> 'settlement_label',
        'label'			=> 'Base',
        'tipo'          => 'inp',  
        'disabled'      => '1',                 
        // 'select_multiple'=> '1',
    ),     
    'rowid'=>array_merge(
        [
            'campo'	=> 'rowid',
            'label'	=> 'rowid',
        ],
        $objeto_fields_common['number']
    ),    
    'new_imported'=>array_merge(
        [
        'campo'	=> 'new_imported',
        'label'	=> 'new_imported',
        ],
        $objeto_fields_common['bit']
    ),
];


// * APORTACIONES REGULARES
$PRIMARY_SHARES=array_merge(
    [
        'me'			=> 'PRIMARY_SHARES',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Aportaciones Regulares',
        'nombre_singular'=> 'aportación regular',
        'nombre_plural'	=> 'aportaciones regulares',
        'tabla'			=> 'primaryshares',
        'archivo'		=> 'primaryshares',
        'prefijo'		=> 'pri',
        'menu_label'	=> 'Aportaciones Regulares',
        'main_campo'    => 'rowid',

        'joins'			=>[
            'people'		=> 'primaryshares.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
            id_location?listable=0&label=Ente&after=amount,
            ',
            // 'locations'		=> '
            //     id_settlement?listable=1&queries=1&label=Base&after=amount,
            // ',            
        ],          

        'exportar_excel'=>'1',

        'options_list'=>[
            
            '<a data-url="modal.php?page=form_people_action_agregar_aportacion&id=[id]&mode=edit" class="modal-share-link form_people_action_agregar_aportacion" >Editar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_aportacion&id=[id]&mode=delete" class="modal-share-link form_people_action_agregar_aportacion" >Eliminar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_aportacion&id=[id]&mode=revision" class="modal-share-link form_people_action_agregar_aportacion revision" >Revisión</a>',

            '<a data-url="modal.php?page=form_people_action_mover_aportacion&id=[id]&from=primary" class="modal-share-link form_people_action_mover_aportacion" >Mover a aportacion regular</a>',
            '<a data-url="modal.php?page=form_people_action_mover_caee&id=[id]&from=primary" class="modal-share-link form_people_action_mover_caee" >Mover a aportaciones CAEE</a>',
            '<a data-url="modal.php?page=form_people_action_mover_pagp&id=[id]&from=primary" class="modal-share-link form_people_action_mover_pagp" >Mover a otro pago</a>',

            '<a data-url="modal.php?page=form_people_action_mover_base&id=[id]&from=primary" class="modal-share-link form_people_action_mover_base" >Mover a otra Base</a>',

        ],
        'list_options'=> [
			[
                'name'=>'Marcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=1&share=primaryshares&id_person='.$_GET['id_persona']
            ],
			[
                'name'=>'Desmarcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=0&share=primaryshares&id_person='.$_GET['id_persona']
			]            
        ], 
		'mass_actions'	=> 'revisado',

        'campos'		=>array_merge(
            [

                'rowid'=>array_merge(
                    [
                    'campo'	=> 'rowid',
                    'label'	=> 'rowid',
                    ],
                    $objeto_fields_common['number']
                ),
            
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ),   

                'id_persona'=>[],                                
                
                'revisado'=>array_merge(
                    [
                    'campo'	=> 'revisado',
                    'label'	=> 'Revisado',
                    'label'	=> 'Revisado',
                    ],
                    $objeto_fields_common['bit'],
                    [
                        'listable' => '1',
                    ]
                ),

                'amount'=>array_merge(
                    [
                    'campo'	=> 'amount',
                    'label'	=> 'Monto',
                    ],
                    $objeto_fields_common['money']
                ), 

                'id_settlement'=>[],                                

                'type'=>array_merge(
                    [
                    'campo'	=> 'type',
                    'label'	=> 'Tipo',
                    'tipo'  => 'com',
                    'opciones'  => [
                        'Imported' => 'Descuento directo ESSALUD',
                        'Voucher' => 'Depósito',
                        'Voucher2' => 'Formato ESSALUD',
                        'Empty' => 'Deuda',
                    ],
                    'options-row-style'=>[
                        'Imported' => 'line-none',
                        'Voucher' => 'line-none',
                        'Voucher2' => 'line-none',
                        'Empty' => 'line-red',
                    ],
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ),

				'id_group'		=>array(
                    'campo'			=> 'id_group',
                    'label'			=> 'Régimen Laboral',
                    'tipo'			=> 'com',
                    'listable'		=> '0',
                    'validacion'	=> '1',
                    'opciones'		=>array(
                        'cn' => 'Contratados/Nombrados',
                        'cas' => 'CAS',
                    ),
                    'queries'		=> '0',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),    
       
                'registered_by'=>array_merge(
                    [
                    'campo'	=> 'registered_by',
                    'label'	=> 'Registrado por',
                    'tipo'  => 'inp',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ), 
            
                'fecha_creacion'=>[],                                
                
                'voucher'=>array_merge(
                    [
                    'campo'	=> 'voucher',
                    'label'	=> 'Voucher',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),

                'comment'=>array_merge(
                    [
                    'campo'	=> 'comment',
                    'label'	=> 'Comentario',
                    'tipo'  => 'txt',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),

                'operation_id'=>array_merge(
                    [
                    'campo'	=> 'operation_id',
                    'label'	=> 'operation_id',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),

                'can_view_aporation_amount'=>array_merge(
                    [
                    'campo'	=> 'can_view_aporation_amount',
                    'label'	=> 'can_view_aporation_amount',
                    ],
                    $objeto_fields_common['bit']
                ),

                'concept'=>array_merge(
                    [
                    'campo'	=> 'concept',
                    'label'	=> 'concept',
                    'tipo'  => 'com',
                    'opciones'  => [
                        '1' => 'yes|lightgreen;black',
                        '0' => 'no|grey',
                    ],
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                
                                
            ],
            $objeto_tabla_common['sub-elements']['campos'],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '1',
                    'width'         => '160px',
                    'formato'		=> '8c',                    
                ], 
            ]
        ),

    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'=>'month desc'
    ],
    [
        'listado_web'=>'',
        'listado_mobile'=>'',
    ]
);

// * APORTACIONES CAEE
$SECONDARY_SHARES=array_merge(
    [
        'me'			=> 'SECONDARY_SHARES',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Aportaciones CAEE',
        'nombre_singular'=> 'aportación CAEE',
        'nombre_plural'	=> 'aportaciones CAEE',
        'tabla'			=> 'secondaryshares',
        'archivo'		=> 'secondaryshares',
        'prefijo'		=> 'sec',
        'menu_label'	=> 'Aportaciones CAEE',
        'main_campo'    => 'rowid',
        'joins'			=>[
            'people'		=> 'secondaryshares.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
                id_location?listable=0&label=Ente&after=amount,
            ',
            // 'locations'		=> '
            //     id_settlement?listable=1&label=Base&after=amount,
            // ',            
        ],         
        'options_list'=>[
            '<a data-url="modal.php?page=form_people_action_agregar_caee&id=[id]&mode=edit" class="modal-share-link form_people_action_agregar_aportacion" >Editar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_caee&id=[id]&mode=delete" class="modal-share-link form_people_action_agregar_aportacion" >Eliminar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_caee&id=[id]&mode=revision" class="modal-share-link form_people_action_agregar_aportacion revision" >Revision</a>',

            '<a data-url="modal.php?page=form_people_action_mover_aportacion&id=[id]&from=secondary" class="modal-share-link form_people_action_mover_aportacion" >Mover a aportacion regular</a>',
            '<a data-url="modal.php?page=form_people_action_mover_caee&id=[id]&from=secondary" class="modal-share-link form_people_action_mover_caee" >Mover a aportaciones CAEE</a>',
            '<a data-url="modal.php?page=form_people_action_mover_pagp&id=[id]&from=secondary" class="modal-share-link form_people_action_mover_pagp" >Mover a otro pago</a>',

            '<a data-url="modal.php?page=form_people_action_mover_base&id=[id]&from=secondary" class="modal-share-link form_people_action_mover_base" >Mover a otra Base</a>',

        ],
        'exportar_excel'=>'1',

        'list_options'=> [
			[
                'name'=>'Marcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=1&share=secondaryshares&id_person='.$_GET['id_persona']
            ],
			[
                'name'=>'Desmarcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=0&share=secondaryshares&id_person='.$_GET['id_persona']
            ],            
        ], 
        'mass_actions'	=> 'revisado',
                
        'campos'		=>array_merge(
            [
   
                'rowid'=>array_merge(
                    [
                    'campo'	=> 'rowid',
                    'label'	=> 'rowid',
                    ],
                    $objeto_fields_common['number']
                ),
            
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ),   
                'revisado'=>array_merge(
                    [
                    'campo'	=> 'revisado',
                    'label'	=> 'Revisado',
                    'label'	=> 'Revisado',
                    ],
                    $objeto_fields_common['bit'],
                    [
                        'listable' => '1',
                    ]
                ),  
                'id_persona'=>[],                                

                'amount'=>array_merge(
                    [
                    'campo'	=> 'amount',
                    'label'	=> 'Monto',
                    ],
                    $objeto_fields_common['money']
                ), 
                
                'id_settlement'=>[],                                

                'type'=>array_merge(
                    [
                    'campo'	=> 'type',
                    'label'	=> 'Tipo',
                    'tipo'  => 'com',
                    'opciones'  => [
                        'Imported' => 'Descuento directo ESSALUD',
                        'Voucher' => 'Depósito',
                        'Voucher2' => 'Formato ESSALUD',
                        'Empty' => 'Deuda',
                    ],
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ),
				'id_group'		=>array(
                    'campo'			=> 'id_group',
                    'label'			=> 'Régimen Laboral',
                    'tipo'			=> 'com',
                    'listable'		=> '0',
                    'validacion'	=> '1',
                    'opciones'		=>array(
                        'cn' => 'Contratados/Nombrados',
                        'cas' => 'CAS',
                    ),
                    'queries'		=> '0',
                    'default'		=> '1',
                    'style'			=> 'width:150px;',
                    'width'			=> '84px'
                ),                
                'registered_by'=>array_merge(
                    [
                    'campo'	=> 'registered_by',
                    'label'	=> 'Registrado por',
                    'tipo'  => 'inp',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ), 
            
                'fecha_creacion'=>[],                                
                
                'voucher'=>array_merge(
                    [
                    'campo'	=> 'voucher',
                    'label'	=> 'Voucher',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                'comment'=>array_merge(
                    [
                    'campo'	=> 'comment',
                    'label'	=> 'Comentario',
                    'tipo'  => 'txt',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                'operation_id'=>array_merge(
                    [
                    'campo'	=> 'operation_id',
                    'label'	=> 'operation_id',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                'can_view_aporation_amount'=>array_merge(
                    [
                    'campo'	=> 'can_view_aporation_amount',
                    'label'	=> 'can_view_aporation_amount',
                    ],
                    $objeto_fields_common['bit']
                ),
                'concept'=>array_merge(
                    [
                    'campo'	=> 'concept',
                    'label'	=> 'concept',
                    'tipo'  => 'com',
                    'opciones'  => [
                        '1' => 'yes|lightgreen;black',
                        '0' => 'no|grey',
                    ],
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                
            ],
            $objeto_tabla_common['sub-elements']['campos'],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '1',
                    'width'         => '160px',
                    'formato'		=> '8c',                    
                ], 
            ]            
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'=>'month desc'    
    ]    
);

// * OTRAS APORTACIONES
$PAYMENTS=array_merge(
    [
        'me'			=> 'PAYMENTS',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Otras Aportaciones',
        'nombre_singular'=> 'otra aportación',
        'nombre_plural'	=> 'otras aportaciones',
        'tabla'			=> 'payments',
        'archivo'		=> 'payments',
        'prefijo'		=> 'pay',
        'menu_label'	=> 'Otras Aportaciones',
        'main_campo'    => 'rowid',
        'joins'			=>[
            'people'		=> 'payments.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
                id_location?listable=0&label=Ente&after=amount,
            ',
            // 'locations'		=> '
            //     id_settlement?listable=1&label=Base&after=amount,
            // ',            
        ],   
        'options_list'=>[
            '<a data-url="modal.php?page=form_people_action_agregar_pagp&id=[id]&mode=edit" class="modal-share-link form_people_action_agregar_aportacion" >Editar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_pagp&id=[id]&mode=delete" class="modal-share-link form_people_action_agregar_aportacion" >Eliminar</a>',
            '<a data-url="modal.php?page=form_people_action_agregar_pagp&id=[id]&mode=revision" class="modal-share-link form_people_action_agregar_aportacion revision" >Revisión</a>',

            '<a data-url="modal.php?page=form_people_action_mover_aportacion&id=[id]&from=payment" class="modal-share-link form_people_action_mover_aportacion" >Mover a aportacion regular</a>',
            '<a data-url="modal.php?page=form_people_action_mover_caee&id=[id]&from=payment" class="modal-share-link form_people_action_mover_caee" >Mover a aportaciones CAEE</a>',
            '<a data-url="modal.php?page=form_people_action_mover_pagp&id=[id]&from=payment" class="modal-share-link form_people_action_mover_pagp" >Mover a otro pago</a>',

            '<a data-url="modal.php?page=form_people_action_mover_base&id=[id]&from=payment" class="modal-share-link form_people_action_mover_base" >Mover a otra Base</a>',

        ],        
        'exportar_excel'=>'1',

        'list_options'=> [
			[
                'name'=>'Marcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=1&share=payments&id_person='.$_GET['id_persona']
            ],
			[
                'name'=>'Desmarcar como Revisado',
                'aclass'=>'modal-revisado-link form_revisado modal-share-massive ',
                'dataurl'=>'modal.php?page=form_people_revisado&check=0&share=payments&id_person='.$_GET['id_persona']
			]            
        ], 
        'mass_actions'	=> 'revisado',
        
        'campos'		=>array_merge(
            [
   
                'rowid'=>array_merge(
                    [
                    'campo'	=> 'rowid',
                    'label'	=> 'rowid',
                    ],
                    $objeto_fields_common['number']
                ),
                /*
                'month'=>array_merge(
                    [
                    'campo'	=> 'month',
                    'label'	=> 'Año y Mes',
                    'tipo'  => 'fch',
                    'formato'  => '4b',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],
                    ]
                ), 
                */  

                'id_persona'=>[],                                

                'amount'=>array_merge(
                    [
                    'campo'	=> 'amount',
                    'label'	=> 'monto',
                    ],
                    $objeto_fields_common['money']
                ), 

                'id_settlement'=>[],                                

                'revisado'=>array_merge(
                    [
                    'campo'	=> 'revisado',
                    'label'	=> 'Revisado',
                    'label'	=> 'Revisado',
                    ],
                    $objeto_fields_common['bit'],
                    [
                        'listable' => '1',
                    ]
                ),                  
                'concept'=>array_merge(
                    [
                    'campo'	=> 'concept',
                    'label'	=> 'Concepto',
                    'tipo'  => 'com',
                    'opciones'  => [
                        'seguro_rimac' => 'Seguro RIMAC',
                        'curso_elit' => 'Curso ELIT',
                    ],
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ),                
                'type'=>array_merge(
                    [
                    'campo'	=> 'type',
                    'label'	=> 'Tipo',
                    'tipo'  => 'com',
                    'opciones'  => [
                        'Imported' => 'Descuento directo ESSALUD',
                        'Voucher' => 'Depósito',
                        'Voucher2' => 'Formato ESSALUD',
                        'Empty' => 'Deuda',
                    ],
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
            
                'registered_by'=>array_merge(
                    [
                    'campo'	=> 'registered_by',
                    'label'	=> 'Registrado por',
                    'tipo'  => 'inp',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ), 
            
                'fecha_creacion'=>[],                                
                
                'voucher'=>array_merge(
                    [
                    'campo'	=> 'voucher',
                    'label'	=> 'Voucher',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                'comment'=>array_merge(
                    [
                    'campo'	=> 'comment',
                    'label'	=> 'Comentario',
                    'tipo'  => 'txt',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                'operation_id'=>array_merge(
                    [
                    'campo'	=> 'operation_id',
                    'label'	=> 'operation_id',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                'can_view_aporation_amount'=>array_merge(
                    [
                    'campo'	=> 'can_view_aporation_amount',
                    'label'	=> 'can_view_aporation_amount',
                    ],
                    $objeto_fields_common['bit']
                ),

                                
            ],
            $objeto_tabla_common['sub-elements']['campos'],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Registrado el',
                    'listable'		=> '1',
                    'width'         => '160px',
                    'formato'		=> '8c',                    
                ], 
            ] 
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'=>'id desc'    
    ]    
);

// * DOCUMENTOS
$DOCUMENTOS=array_merge(
    [
        'me'			=> 'DOCUMENTOS',
        'grupo'			=> 'Gestión documentaria',
        'titulo'		=> 'Documentos',
        'nombre_singular'=> 'documento',
        'nombre_plural'	=> 'documentos',
        'tabla'			=> 'documents',
        'archivo'		=> 'documents',
        'prefijo'		=> 'doc',
        'menu_label'	=> 'Documentos',
        'main_campo'    => 'code',
        'crear'    => '0',
        'joins'			=>[
            'people'		=> 'documents.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
                id_location?listable=0&label=Ente&after=event_date,
            ',
            'locations'		=> '
                id_settlement?listable=1&label=Base&after=event_date,
            ',            
        ],  
        

        'list_options'=> [
			[
                'name'=>'Crear Nuevo Documento',
                // 'onclick'=>'releaseClick("modal-link.form_people_new_document")',
                'aclass'=>'modal-new-document-link form_people_new_document',
                'dataurl'=>'modal.php?page=form_people_new_document&id_person='.$_GET['id_persona']
                // '<a data-url="modal.php?page=form_people_new_document&id_person=[id]" class="modal-new-document-link form_people_new_document" ></a>',
				// 'url'=>'pages.php?page=import',
			]
        ],        
        'exportar_excel'=>'1',



        'campos'		=>array_merge(
            [
                'code'=>array_merge(
                    [
                    'campo'	=> 'code',
                    'label'	=> 'Seguimiento',
                    'tipo'  => 'inp',
                    'width' => '110px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries'		=> '1',
                    'dlquery'		=> '1',
                    // 'campo_query'   => "code",
                    'campos_search'  => "documents.code;people.code;people.nombre;people.apellidos;people.document_number",
                    'extra_where'  => "left join people on people.id=documents.id_persona",
                    'dl_placeholder' => 'Busqueda de documento por Seguimiento código nombres apellidos DNI',  
                    'link-params'=>'&sub=documents',
                    ]
                ), 
                'state_id'=>array_merge(
                    [
                    'campo'	=> 'state_id',
                    'label'	=> 'Estado',
                    'tipo'  => 'com',
                    'opciones'  => [
                        '1' => 'Registrado|#f1c40f',
                        '2' => 'Finalizado|#27ae60',
                        '3' => 'Rechazado|#e74c3c',
                        '4' => 'En evaluación|#3498db',
                        '5' => 'Asignando depósitos|#2980b9',
                    ],
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ),                 
                'id_persona'=>[],   

                'document_type_id'=>array_merge(
                    [
                    'campo'	=> 'document_type_id',
                    'label'	=> 'Requerimiento',
                    'tipo'  => 'com',
                    'opciones'  => [
                        '1' => 'CAEE - Requerimiento de Asignación',
                        '2' => 'Requerimiento FAS',//setiembre2021
                    ],
                    'width' => '220px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ),                
                
                'fecha_creacion'=>[],
                
                'created_by'=>array_merge(
                    [
                        'campo'	=> 'created_by',
                        'label'	=> 'Registrado por',
                        'tipo'  => 'inp',
                        'width' => '130px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),                 

                'document_type_value_id'=>array_merge(
                    [
                    'campo'	=> 'document_type_value_id',
                    'label'	=> 'Tipo',
                    'tipo'  => 'com',
                    'opciones'  => [
                        '1' => 'Fallecimiento madre',
                        '2' => 'Fallecimiento padre',
                        '3' => 'Cese',
                        '4' => 'Renuncia',
                        '5' => 'Fallecimiento hijo',
                        '6' => 'Fallecimiento hija',
                        '7' => 'Fallecimiento conyugue',
                        '8' => 'Fallecimiento titular',    
                        '9' => 'Oncológicos',    
                        '10' => 'Tuberculosis',    
                        '11' => 'Otros',    
                    ],
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'queries' => '1',
                    ]
                ), 

                'document_entry_date'=>array_merge(
                    [
                    'campo'	=> 'document_entry_date',
                    'label'	=> 'Fecha Recepción',
                    'tipo'  => 'fch',
                    'formato'  => '0a',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '130px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                
                'event_date'=>array_merge(
                    [
                    'campo'	=> 'event_date',
                    'label'	=> 'Fecha del evento',
                    'tipo'  => 'fch',
                    'formato'  => '0a',
                    'rango'  => '-10 years,+0years' ,
                    'width' => '130px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                // base
                'classifier_a'=>array_merge(
                    [
                    'campo'	=> 'classifier_a',
                    'label'	=> 'Ficha de cancelación',
                    'tipo'  => 'inp',
                    'width' => '150px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                'classifier_b'=>array_merge(
                    [
                    'campo'	=> 'classifier_b',
                    'label'	=> 'Resolución',
                    'tipo'  => 'inp',
                    'width' => '90px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ),
                'can_edit'=>array_merge(
                    [
                    'campo'	=> 'can_edit',
                    'label'	=> 'can_edit',
                    ],
                    $objeto_fields_common['bit']
                ),
                'can_create_assignation'=>array_merge(
                    [
                    'campo'	=> 'can_create_assignation',
                    'label'	=> 'can_create_assignation',
                    ],
                    $objeto_fields_common['bit']
                ),
                'can_create_attachment'=>array_merge(
                    [
                    'campo'	=> 'can_create_attachment',
                    'label'	=> 'can_create_attachment',
                    ],
                    $objeto_fields_common['bit']
                ),
                'can_delete_attachment'=>array_merge(
                    [
                    'campo'	=> 'can_delete_attachment',
                    'label'	=> 'can_delete_attachment',
                    ],
                    $objeto_fields_common['bit']
                ),
                'can_delete'=>array_merge(
                    [
                    'campo'	=> 'can_delete',
                    'label'	=> 'can_delete',
                    ],
                    $objeto_fields_common['bit']
                ),

                'document_type_has_assigments'=>array_merge(
                    [
                    'campo'	=> 'document_type_has_assigments',
                    'label'	=> 'document_type_has_assigments',
                    ],
                    $objeto_fields_common['bit']
                ),

                'on_start_state'=>array_merge(
                    [
                    'campo'	=> 'on_start_state',
                    'label'	=> 'on_start_state',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),
                'on_end_state'=>array_merge(
                    [
                    'campo'	=> 'on_end_state',
                    'label'	=> 'on_end_state',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),

            ],
            $objeto_tabla_common['sub-elements']['campos'],
            $objeto_tabla_common['base'],
            [
                'fecha_creacion'=>array_merge(
                    [
                        'campo'	=> 'fecha_creacion',
                        'label'	=> 'Registrado el',
                        'tipo'  => 'fcr',
                        
                        'formato'		=> '0a',                    
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:170px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'queries' => '0',
                        
                    ]
                ),
                'id_persona'=>array_merge(
                    [
                    'campo'	=> 'id_persona',
                    'label'	=> 'Persona',
                    'tipo'  => 'hid',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '0',
                    'tip_foreig'	=> '1',
                    'default'		=> '[id_persona]',
                    'opciones'		=> 'id,apellidos;nombre|people',
                    'foreig'		=> '1',
                    'link-params'=>'&sub=documents',
                    ]
                ),                                 
            ]         
        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        // 'menu'		=> 0,
        // 'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'		=> 'id desc',
        'editar'		=> '0',
        'edicion_completa'		=> '0',

    ]    
);

// * ASIGMENTS BY DOCUMENT
$DOCUMENTS_ASIGMENTS=array_merge(
    [
        'me'			=> 'DOCUMENTS_ASIGMENTS',
        'grupo'			=> 'Gestión documentaria',
        'titulo'		=> 'Asignaciones',
        'nombre_singular'=> 'asignación',
        'nombre_plural'	=> 'asignaciones',
        'tabla'			=> 'asigments',
        'archivo'		=> 'asigments',
        'prefijo'		=> 'asi',
        'menu_label'	=> 'Asignaciones',
        // 'main_campo'    => 'rowid',
        /*
        'joins'			=>[
            'people'		=> 'primaryshares.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
            id_location?listable=0&label=Ente&after=amount,
            ',
            'locations'		=> '
                id_settlement?listable=1&queries=1&label=Base&after=amount,
            ',            
        ],          
        */
        // 'exportar_excel'=>'1',

        'campos'		=>array_merge(
            $objeto_tabla_common['base'],
            [

                'id_document'		=>array(
                    'campo'			=> 'id_document',
                    'label'			=> 'Documento',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,code|documents|order by code asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'DOCUMENTOS',
                    'foreig'        => '1',
                    'default'       => '[id_document]',                    
                    // 'select_multiple'=> '1',
                ),

                'amount'=>array_merge(
                    [
                    'campo'	=> 'amount',
                    'label'	=> 'monto',
                    ],
                    $objeto_fields_common['money']
                ),

                'operation_bank'=>array_merge(
                    [
                    'campo'	=> 'operation_bank',
                    'label'	=> 'Operación bancaria',
                    'tipo'  => 'inp',
                    'width' => '100px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '0',
                    'query' => '1',
                    ]
                ),

                'transaction_date'=>array_merge(
                    [
                        'campo'	=> 'transaction_date',
                        'label'	=> 'Inicia gestión',
                        'tipo'  => 'fch',
                        'formato'  => '0a',
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),

                'created_by'=>array_merge(
                    [
                    'campo'	=> 'created_by',
                    'label'	=> 'Creado por',
                    'tipo'  => 'inp',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'query' => '1',
                    ]
                ), 

                'can_view_assignation'=>array_merge(
                    [
                    'campo'	=> 'can_view_assignation',
                    'label'	=> 'can_view_assignation',
                    ],
                    $objeto_fields_common['bit']
                ),                

            ]

        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'DOCUMENTOS',
        'por_pagina'=>'20',
        'order_by'=>'id desc'
    ]
);

// * OPERACIONES
$OPERATIONS=array_merge(
    [
        'me'			=> 'OPERATIONS',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Operaciones',
        'nombre_singular'=> 'operación',
        'nombre_plural'	=> 'operaciones',
        'tabla'			=> 'operations',
        'archivo'		=> 'operations',
        'prefijo'		=> 'ope',
        'menu_label'	=> 'Operaciones',
        'main_campo'    => 'rowid',
        'options_list'=>[
            '<a data-url="modal.php?page=print_operation&id=[id]&mode=print" class="modal-page print_operation" >ver operación</a>',
        ],        
        'campos'		=>array_merge(
            $objeto_tabla_common['base'],
            $objeto_tabla_common['sub-elements']['campos'],
            [
                'submitted_at_label'=>array_merge(
                    [
                        'campo'	=> 'submitted_at_label',
                        'label'			=> 'Registrado el',
                        'tipo'  => 'fch',
                        'formato'		=> '0a',                    
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:170px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        // 'queries' => '1',
                        'query-options'=>[
                            'year-month'=>'1',
                            'no-specific'=>'1',
                        ],
                    ]
                ),                
                'deposit_at_label'=>array_merge(
                    [
                        'campo'	=> 'deposit_at_label',
                        'label'	=> 'Pagado el',
                        'tipo'  => 'fch',
                        'formato'		=> '0a',                    
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        // 'queries' => '1',
                        'query-options'=>[
                            'year-month'=>'1',
                            'no-specific'=>'1',
                        ],
                    ]
                ),
                'share_type'=>array_merge(
                    [
                        'campo'	=> 'share_type',
                        'label'	=> 'Tipo',
                        'tipo'  => 'com',
                        'opciones'  => [
                            'SecondaryShareOperation' => 'Aporte CAEE',
                            'PrimaryShareOperation' => 'Aporte Regular',
                            'PaymentOperation' => 'Otro Pago',
                        ],
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'queries' => '1',
                    ]
                ),
                'total_shares'=>array_merge(
                    $objeto_fields_common['number'],
                    [
                        'campo'	=> 'total_shares',
                        'label'	=> 'Meses',
                        'listable' => '1',
                    ]
                ),
                'monthly_amount_label'=>array_merge(
                    $objeto_fields_common['money'],
                    [
                        'campo'	=> 'monthly_amount_label',
                        'label'	=> 'Aporte Mensual',
                        'width' => '120px'
                    ]
                ),
                'total_amount'=>array_merge(
                    [
                        'campo'	=> 'total_amount',
                        'label'	=> 'Monto Total',
                    ],
                    $objeto_fields_common['money']
                ),

                /*
                'total_amount_label'=>array_merge(
                    $objeto_fields_common['money'],
                    [
                        'campo'	=> 'total_amount_label',
                        'label'	=> 'total_amount_label',
                        'listable' => '1',
                    ]
                ),
                
                'share_type_label'=>array_merge(
                    [
                        'campo'	=> 'share_type_label',
                        'label'	=> 'share_type_label',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                */
            ]
        )      
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'		=> 'id desc',

    ]    
);

// * RECORDS
$RECORDS=array_merge(
    [
        'me'			=> 'RECORDS',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Historial',
        'nombre_singular'=> 'registro',
        'nombre_plural'	=> 'registros',
        'tabla'			=> 'records',
        'archivo'		=> 'records',
        'prefijo'		=> 'rec',
        'menu_label'	=> 'Historial',
        'main_campo'    => 'rowid',

        'exportar_excel'=>'1',

        'campos'		=>array_merge(
            $objeto_tabla_common['base'],
            $objeto_tabla_common['sub-elements']['campos'],
            [
                // Generado el
                'fecha_creacion'=>[
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr',
                    'label'			=> 'Generado el',
                    'listable'		=> '1',
                    'width'         => '110px',
                    'formato'		=> '0a',  
                    'queries' => '1', 
                    'query-options'=>[
                        'year-month'=>'1',
                        'no-specific'=>'1',
                        'no-show-days'=>'1',
                    ],                                     
                ], 
                // Tipo
                'type'=>array_merge(
                    [
                        'campo'	=> 'type',
                        'label'	=> 'Tipo',
                        'tipo'  => 'com',
                        'opciones'  => [
                            'PrimaryShareAffiliation'=>'Afiliación|#07d73d;#000000',
                            'PrimaryShareDisaffiliation' => 'Desafiliación|#fb9678;#000000',
                            'SecondaryShareAffiliation' => 'Acepta CAEE|#07d73d;#000000',
                            'SecondaryShareDisaffiliation' => 'Cancela CAEE|#fb9678;#000000',
                            'Move' => 'Traslado',
                            'Other' => 'Otros',
                        ],
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'queries' => '1',
                    ]
                ),
                // descripcion
                'description'=>array_merge(
                    [
                        'campo'	=> 'description',
                        'label'	=> 'descripción',
                        'tipo'  => 'txt',
                        'width' => '350px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'disabled' => '1',
                    ]
                ),
                // 'registered_at'=>array_merge(
                //     [
                //         'campo'	=> 'registered_at',
                //         'label'	=> 'registered_at',
                //         'tipo'  => 'fch',
                //         'formato'  => '5b',
                //         'rango'  => '-10 years,+0years' ,
                //         'width' => '100px',
                //         'style' => 'width:150px',
                //         'derecha' => '1',
                //         'validacion' => '0',
                //         'listable' => '1',
                //         'query' => '1',
                //     ]
                // ),
                
                
                'label'=>array_merge(
                    [
                        'campo'	=> 'label',
                        'label'	=> 'label',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                
                'state'=>array_merge(
                    [
                        'campo'	=> 'state',
                        'label'	=> 'state',
                        'tipo'  => 'com',
                        'opciones'  => [
                        ],
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                
                'state_label'=>array_merge(
                    [
                        'campo'	=> 'state_label',
                        'label'	=> 'state_label',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                
                'start_location_label'=>array_merge(
                    [
                        'campo'	=> 'start_location_label',
                        'label'	=> 'start_location_label',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                
                'end_location_label'=>array_merge(
                    [
                        'campo'	=> 'end_location_label',
                        'label'	=> 'end_location_label',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                'start_location'		=>array(
                    'campo'			=> 'start_location',
                    'label'			=> 'ente de procedencia',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|locations|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    'width'			=> '120px',
                    // 'foreigkey'     => 'LOCATIONS',
                    // 'foreig'        => '1',
                    // 'default'       => '[id_location]',
                    'noedit'		=> '1',
                ),   
                'end_location'		=>array(
                    'campo'			=> 'end_location',
                    'label'			=> 'ente de destino',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|locations|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    'width'			=> '120px',
                    // 'foreigkey'     => 'LOCATIONS',
                    // 'foreig'        => '1',
                    // 'default'       => '[id_location]',
                    'noedit'		=> '1',
                ),                                 
                'changed_settlement'=>array_merge(
                    [
                        'campo'	=> 'changed_settlement',
                        'label'	=> 'changed_settlement',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1',
                    ]
                ),
                'registered_by'=>array_merge(
                    [
                    'campo'	=> 'registered_by',
                    'label'	=> 'Registrado por',
                    'tipo'  => 'inp',
                    'width' => '200px',
                    'style' => 'width:150px',
                    'derecha' => '1',
                    'validacion' => '0',
                    'listable' => '1',
                    'disabled' => '1',
                    // 'query' => '1',
                    ]
                ),                 
                
            ]
        )     
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'PEOPLE',
        'por_pagina'=>'20',
        'order_by'=>'fecha_creacion desc,id desc',

    ]    
);

// * JUNTAS BY BASES
$SETTLEMENT_MANAGMENT_GROUP=array_merge(
    [
        'me'			=> 'SETTLEMENT_MANAGMENT_GROUP',
        'grupo'			=> 'organizacional',
        'titulo'		=> 'Juntas en Base',
        'nombre_singular'=> 'miembro de junta',
        'nombre_plural'	=> 'miembros de junta',
        'tabla'			=> 'settlement_managment_group',
        'archivo'		=> 'settlement_managment_group',
        'prefijo'		=> 'smg',
        'menu_label'	=> 'Juntas en Base',
        // 'main_campo'    => 'rowid',
        /*
        'joins'			=>[
            'people'		=> 'primaryshares.id_persona=people.id',
            'locations'		=> 'people.id_location=locations.id',
        ],
		'more'			=>[
            'people'		=> '
            id_location?listable=0&label=Ente&after=amount,
            ',
            'locations'		=> '
                id_settlement?listable=1&queries=1&label=Base&after=amount,
            ',            
        ],          
        */
        'exportar_excel'=>'1',
        'list_options'=> [
			[
				'name'=>'Módulo de Miembro de Junta',
				'url'=>'custom/settlement_managment_group.php',
			]
        ],
        
        'campos'		=>array_merge(
            $objeto_tabla_common['base'],
            [
                
                'id_settlement'		=>array(
                    'campo'			=> 'id_settlement',
                    'label'			=> 'Base',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|settlements|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '0',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'SETTLEMENTS',
                    'foreig'        => '1',
                    'default'       => '[id_settlement]',                    
                    // 'select_multiple'=> '1',
                ), 
                

                
                'nombre'=>array_merge(
                    [
                        'campo'	=> 'nombre',
                        'label'	=> 'Secretario General',
                        'tipo'  => 'inp',
                        'width' => '300px',
                        'style' => 'width:300px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                
                'email'=>array_merge(
                    [
                        'campo'	=> 'email',
                        'label'	=> 'Email de contacto',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                
                'phone'=>array_merge(
                    [
                        'campo'	=> 'phone',
                        'label'	=> 'Teléfono de contacto',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                
                'description'=>array_merge(
                    [
                        'campo'	=> 'description',
                        'label'	=> 'Descripción',
                        'tipo'  => 'inp',
                        'width' => '100px',
                        'style' => 'width:350px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '0',
                        'query' => '1'
                    ]
                ),
                'beggin_on'=>array_merge(
                    [
                        'campo'	=> 'beggin_on',
                        'label'	=> 'Inicia gestión',
                        'tipo'  => 'fch',
                        'formato'  => '0a',
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                
                'end_on'=>array_merge(
                    [
                        'campo'	=> 'end_on',
                        'label'	=> 'Finaliza gestión',
                        'tipo'  => 'fch',
                        'formato'  => '0a',
                        'rango'  => '-10 years,+0years' ,
                        'width' => '100px',
                        'style' => 'width:150px',
                        'derecha' => '1',
                        'validacion' => '0',
                        'listable' => '1',
                        'query' => '1',
                    ]
                ),
                'expired'=>array_merge(
                    [
                        'campo'	=> 'expired',
                        'label'	=> 'Expirado',
                    ],
                    $objeto_fields_common['bit'],
                    [
                        'options-row-style'=>[
                            '0' => 'line-none',
                            '1' => 'line-red',
                        ], 
                        'listable' => '1',
                    ]
                ),
                
                // 'state'=>array_merge(
                //     [
                //     'campo'	=> 'state',
                //     'label'	=> 'Estado',
                //     'tipo'  => 'com',
                //     'opciones'  => [
                //         'closed' => 'Cerrada|#f1c40f',
                //         'active' => 'Activa|#27ae60',
                //     ],
                //     'options-row-style'=>[
                //         'active' => 'line-none',
                //         'closed' => 'line-red',
                //     ],                    
                //     'width' => '100px',
                //     'style' => 'width:150px',
                //     'derecha' => '1',
                //     'validacion' => '0',
                //     'listable' => '1',
                //     'queries' => '1',
                //     ]
                // ),  
                
                                
            ]

        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'menu'		=> 0,
        'menu_forced'=>'SETTLEMENTS',
        'por_pagina'=>'20',
        'order_by'=>'end_on asc',
        'eliminar'      => '1',
        'editar'      => '1',
        'crear'      => '1',

    ],
    [
        'listado_web'=>'',
        'listado_mobile'=>'',
    ]
);

// * CONCEPTOS
$CONCEPTOS=array_merge(
    [
        'me'			=> 'CONCEPTOS',
        // 'grupo'			=> 'organizacional',
        'titulo'		=> 'Códigos para otros pagos',
        'nombre_singular'=> 'Código para otros pagos',
        'nombre_plural'	=> 'Códigos para otros pagos',
        'tabla'			=> 'conceptos',
        'archivo'		=> 'conceptos',
        // 'archivo_hijo'	=> 'productos_fotos',
        'prefijo'		=> 'conc',
        'menu_label'	=> 'Códigos para otros pagos',
        'main_campo'    => 'nombre',
        // 'menu'          => '0',


        'campos'		=>array_merge(
            [
                'nombre'		=>array(
                    'campo'			=> 'nombre',
                    'label'			=> 'Nombre',
                    'unique'		=> '0',
                    'width'			=> '200px',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'like'			=> '0',
                    'size'			=> '140',
                    'style'			=> 'width:450px;',
                    'tags'			=> '1',
                    'derecha'		=> '1',

                ),
                'code'			=>array(
                    'campo'			=> 'code',
                    'tipo'			=> 'inp',
                    'label'			=> 'Código',
                    'validacion'	=> '1',
                    // 'variable'		=> 'int',
                    // 'size'		    => '10',
                    'listable'		=> '1',
                    'width'			=> '150px',
                    'style'			=> 'width:450px;',
                ),

		



 

				'description'		=>array(
                    'campo'			=> 'description',
                    'label'			=> 'Descripción',
                    'tipo'			=> 'txt',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '170px',
                    'style'			=> 'height:80px;width:550px;'
                ),   

            ],
            $objeto_tabla_common['base'],

        ),
    ],
    $objecto_tabla_common['issues']['config'],
    [
        'order_by'		=> 'nombre asc',
        'crear' => '1',
        'editar' => '1',
        'menu' => '0',
        'edicion_completa'=>'1'        
    ]
);




$objeto_tabla_comp=tabla_chain(compact(
    [
        'PEOPLE',
        'PEOPLEOLD',
        'PEOPLE_EVO',
        'PEOPLE_EVOLUTION',
        'PEOPLE_EVOLUTION_GROUP',
        'PEOPLE_EVOLUTION_GENERAL',
        'SETTLEMENTS',
        'SETTLEMENT_MANAGMENT_GROUP',
        'DOCUMENTS_ASIGMENTS',
        'ZONES',
        'LOCATIONS',
        'PRIMARY_SHARES',
        'SECONDARY_SHARES', 
        'PAYMENTS',
        'RECORDS',
        'DOCUMENTOS',
        'OPERATIONS',
        'CONCEPTOS'
    ]
    ),
	array_merge(
        [
            // 'PEOPLE',
            // 'PRIMARY_SHARES,SECONDARY_SHARES,PAYMENTS,RECORDS,DOCUMENTOS,OPERATIONS',
        ]	
    )
	
);

// prinx($objeto_tabla_comp['RECORDS']['campos']['id_persona']); 
// echo '<textarea style="width:1100px;height:400px;">';
// echo $objeto_tabla_comp['PEOPLE']['campos']['nombre']['controles'];
// echo '</textarea>';

// prin($objeto_tabla_comp['PEOPLE']['campos']['nombre']['controles']);exit();

// prin($objeto_tabla_comp['SECONDARY_SHARES']); exit();
// prin($objeto_tabla_comp['PRIMARY_SHARES']); exit();

return $objeto_tabla_comp;
