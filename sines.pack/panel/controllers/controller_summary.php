<?php
/**
**** 
* Archivo: controller_summary.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "resumen" de la pagina de detalle de una persona
**** 
*/




$monthA=[1=>'Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic'];

$class=[
    'Imported'=>'payed',
    'Voucher'=>'payed',
    'Voucher2'=>'payed',
    'Empty'=>'debt',
    'null'=>'empty',
];

// prin($_GET);
// $_GET['id_persona']='1010';


$shares['regulares']=[
    'nombre'=>'Resumen de aportaciones regulares',
    'calendar'=>opciones(
            [
                "month as id",
                "type as nombre"
            ]
            ,"primaryshares"
            ,"where id_persona=".$_GET['id_persona'].' order by month asc'
            ,0
    )
];

$shares['caee']=[
    'nombre'=>'Resumen de aportaciones CAEE',
    'calendar'=>opciones(
            [
                "month as id",
                "type as nombre"
            ]
            ,"secondaryshares"
            ,"where id_persona=".$_GET['id_persona'].' order by month asc'
            ,0
    )
];
// $shares['caee']=select("id","secondaryshares","where id_persona=".$_GET['id_persona']);

// $shares['caee']=select("id","secondaryshares","where id_persona=".$_GET['id_persona']);

foreach($shares as $id_share => $share_item){

    $share=$share_item['calendar'];

    $keys=array_keys($share);

    $min=$keys[0];
    $max=end($keys);

    list($minYear,$minMonth)=explode("-",$min);
    list($maxYear,$maxMonth)=explode("-",$max);

    // prin([$minMonth,$maxMonth]);
    // prin([$minYear,$maxYear]);

    for($yy=$maxYear;$yy>=$minYear;$yy--){
        for($mm=1;$mm<=12;$mm++){

            $value=$share[$yy."-". sprintf("%02d",$mm) ."-01 00:00:00"];
            $blocks[$id_share]['calendar'][$yy][$monthA[$mm]]=$class[($value!='')?$value:'null'];

        }
    }
    
    $blocks[$id_share]['nombre']=$share_item['nombre'];

}


unset($html_filter_A);
unset($html_filter_fecha_A);

$pagina_items['total']='1';

$datos_tabla['include_list']="view_people_summary.php";


