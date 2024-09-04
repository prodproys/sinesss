<?php
/**
**** 
* Archivo: controller_informe.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la pagina "informes" del menú
**** 
*/





$to_update=false;

$name_cache=$_GET['page'];

if( ! ($data=use_cache($_GET['page'],$to_update)) ){



    $locations_options=opciones("id,nombre","locations");

    foreach(['id_group','is_member','is_caee'] as $campo){
        foreach($objeto_tabla['PEOPLE']['campos'][$campo]['opciones'] as $ii=> $opcion){
            list( $objeto_tabla['PEOPLE']['campos'][$campo]['opciones'][$ii] )= explode("|",$objeto_tabla['PEOPLE']['campos'][$campo]['opciones'][$ii]);
        }
    }

    // prin($objeto_tabla['PEOPLE']['campos']);
    // prin($objeto_tabla['PEOPLE']['campos']['id_group']['opciones']);
    function get_casos($casos){

        global $objeto_tabla;
        global $locations_options;

        foreach($casos as $caso){

            $ret[]=[
                'id'=>$caso['id'],
                'code'=>$caso['code'],

                'subs'=>[
                    'primaryshares'=>contar("primaryshares","where id_persona=".$caso['id']),
                    'secondaryshares'=>contar("secondaryshares","where id_persona=".$caso['id']),
                    'payments'=>contar("payments","where id_persona=".$caso['id']),
                    'documents'=>contar("documents","where id_persona=".$caso['id']),
                    'records'=>contar("records","where id_persona=".$caso['id']),
                    'operations'=>contar("operations","where id_persona=".$caso['id']),
                ],

                'profile'=>fila(
                    "is_caee,is_member,id_group,document_number,id_location,last_primary,last_secondary",
                    "people","where id=".$caso['id'],
                    0,[
                        'replace'=>[
                            'id_group'=>$objeto_tabla['PEOPLE']['campos']['id_group']['opciones'],
                            'is_member'=>$objeto_tabla['PEOPLE']['campos']['is_member']['opciones'],
                            'is_caee'=>$objeto_tabla['PEOPLE']['campos']['is_caee']['opciones'],
                            'id_location'=>$locations_options,
                        ],
                        'last_primary'=>['fecha_formato'=>['fecha'=>'{last_primary}','formato'=>'4b']],
                        'last_secondary'=>['fecha_formato'=>['fecha'=>'{last_secondary}','formato'=>'4b']],
                    ]
                )            
            ];

        }
        return $ret;

    }
    // 
    $page_title="Informe";


    $people=select(
        "id,nombre,apellidos,code",
        "people",
        "".
        "order by apellidos asc, nombre asc , id asc".
        // "limit 0,10 ".
        ""
    );

    foreach($people as $person){

        // $index=$person['nombre']." ".$person['apellidos'];
        $index=$person['apellidos']." ".$person['nombre'];
        $person_repeated[$index][]=$person;

    }

    $nom=1;
    foreach($person_repeated as $ii=>$personR){

        if(sizeof($personR)>1){

            $people_reports[]=[
                'nombre'=>$ii,
                'numero'=>$nom++,
                'casos'=>get_casos($personR),
            ];
        }

    }

    $numero_people_reports=sizeof($people_reports);

    $data=[
        'people_reports'=>$people_reports,
        'numero_people_reports'=>$numero_people_reports,
    ];


    save_cache($data,$name_cache);

}

extract($data);


$viewFile="view_informe";
