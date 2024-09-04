<?php
/**
**** 
* Archivo: controller_edades.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "rango por edades" del item "reportes" en el módulo de "personas" del menú
**** 
*/




function numero($number,$decimales=2){
    global $_GET;
    if($_GET['format']=='excel')
        return number_format($number,$decimales,'.','');
    else
        return number_format($number,$decimales,'.',',');
}

unset($html_filter_A['type']);


if(0)
if($_GET['filter']==''){

    $_GET['filter']="primaryshares[]=month|2020-01-01|2020-01-01&";
    $monthh='2015-01-01 00:00:00';
    $monthh='2018-01-01 00:00:00';
    $busqueda_query=" and (  primaryshares.month between '$monthh' and '$monthh'  )  
    ";
    // $busqueda_query=" ";

}


$settlements=opciones(["nombre","id",],"settlements");
// $settlements=opciones(["nombre","id",],"settlements","where id in (24)"); //rebagliati
// $settlements=opciones(["nombre","id",],"settlements","where id in (2)"); //sabogal


// prin($settlements);

$settlements_keys=array_keys($settlements);

// $settlements_keys=[12];
// $settlements_keys=array_slice($settlements_keys,0,3);


// prin($settlements_keys);

$rangos[]="39";
$rangos[]="49";
$rangos[]="59";
$rangos[]="64";
$rangos[]="150";
// $rangos[]="sf";


foreach($rangos as $rango){

    $ranges=select(
        [
            "count(*) as nombre",
            "locations.id_settlement as id"
        ],
        "people",
        "right join locations on locations.id=people.id_location
        where people.rango_edad='$rango'
        group by locations.id_settlement
        ",
        0
    );
    foreach($ranges as $range){
        $rangus[$range['id']][$rango]=$range['nombre'];
    }
}
// unset($aportaciones);
// prin($rangus);



foreach($rangus as $id_settlement=>$aporta){

    $line=[];

    $line['id_settlement']=['text'=>$settlements[$id_settlement],'url'=>'custom/settlements.php?i='.$id_settlement];


    foreach($rangos as $ranx){
        $line['rango_'.$ranx]=['text'=>$aporta[$ranx]];    
        $suma['rango_'.$ranx]+=$aporta[$ranx];
    }


    $reports[]=$line;

}



// prin($failes);



$headers[]=[
    'id_settlement'=>[
        'text'=>'Bases',
        'rowspan'=>'2'
    ],
    'regularcn_aportantes'=>[
        'text'=>'RANGO DE EDADES',
        'colspan'=>'5'
    ],

    /*
    'caee_aportantes'=>[
        'text'=>'CAEE',
        'colspan'=>'2'
    ],   
    'total_aportantes'=>[
        'text'=>'Total General',
        'colspan'=>'2'
    ],
    */    
    
];

$headers[]=[
    'rango_edad_1'=>[
        'text'=>'< 40 años',
        'listable'=>'1',
    ],
    'rango_edad_2'=>[
        'text'=>'De 40 a 49 años',
        'listable'=>'1',
    ],  

    'rango_edad_3'=>[
        'text'=>'De 50 a 59 años',
        'listable'=>'1',
    ],
    'rango_edad_4'=>[
        'text'=>'De 60 a 65 años',
        'listable'=>'1',
    ],      

    'rango_edad_5'=>[
        'text'=>'> 65 años',
        'listable'=>'1',
    ],
 

];

// prin($suma);

$footers[]=[
        
    'id_settlement'=>['text'=>'Total General'],

    'rango_39'=>['text'=>$suma['rango_39']],
    'rango_49'=>['text'=>$suma['rango_49']],
    'rango_59'=>['text'=>$suma['rango_59']],
    'rango_64'=>['text'=>$suma['rango_64']],
    'rango_150'=>['text'=>$suma['rango_150']],


];


$labels=[
    'id_settlement'=>[
        'campo'=>'id_settlement',
        'label'=>'Base',
        'listable'=>'1',
    ],
    'regularcn_aportantes'=>[
        'campo'=>'regularcn_aportantes',
        'label'=>'Nombrados/Contrados',
        'listable'=>'1',
    ],
    'regularcas_aportantes'=>[
        'campo'=>'regularcas_aportantes',
        'label'=>'CAS',
        'listable'=>'1',
    ],    
    'regular_aportantes'=>[
        'campo'=>'regular_aportantes',
        'label'=>'Total Regulares',
        'listable'=>'1',
    ],
    'regular_total'=>[
        'campo'=>'regular_total',
        'label'=>'Total',
        'listable'=>'1',
    ],   

    'deduccion'=>[
        'campo'=>'deduccion',
        'label'=>'Monto a Transferir',
        'listable'=>'1',
    ],     
];


$foots=[
    'TOTALES',
    '',
    $footers[0]['regularcn_total']['text'],
    '',
    $footers[0]['regularcas_total']['text'],    
    '',
    $footers[0]['regular_total']['text'],
    '',
    $footers[0]['caee_total']['text'],
    '',
    $footers[0]['total_total']['text'],
    $footers[0]['deduccion']['text'],            
];


$tabla_class='tabla_standard';

$tblistado=$datos_tabla['list']=$labels;

// $reports[]=$footers[0];

$items=$pagina_items['filas']=$reports;
// prin($items);

$pagina_items['total']=sizeof($items);

$datos_tabla['include_list']="view_table_list.php";

unset($html_filter_A['id_settlement']);
unset($html_filter_A['birthday']);
unset($html_filter_A['rango_edad']);
unset($html_filter_A['id_group']);
unset($html_filter_A['id_location']);
unset($html_filter_A['is_member']);
unset($html_filter_A['nombre']);

$objeto_tabla['PEOPLE']['titulo']="Rango de Edades";

$controls=[
    "<a class='btn-print' onclick='window.print();return false;' data-url='' >Imprimir</a>",
    // "<a class='btn-excel' onclick=\"ax('excel','','','PEOPLE','&middlewarelist=".$_GET['middlewarelist']."','');return false;\" >Exportar Excel</a>",
];
