<?php
/**
**** 
* Archivo: controller_evolution_general.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "evolucion anual general" del item "reportes" en el módulo de "personas" del menú
**** 
*/




if(1)
if($_GET['filter']==''){

    $_GET['filter']="people_evolution_general[]=month|2020-01-01|2020-12-31&";
    $busqueda_query=" and (  people_evolution_general.month between '2020-01-01:00:00:00' and '2020-12-31:23:59:59'  )  
    ";

}

// prin($queries);
// prin($MEEE);
// prin($datos_tabla);
// prin($_GET['filter']);
parse_str($_GET['filter'],$output);

list($mon,$mfrom,$mto)=explode('|',$output['people_evolution_general'][0]);

$mess=$mfrom;
do {
    $Months[]=$mess." 00:00:00";
    $mess= date("Y-m-d",strtotime("$mess + 1 month"));
} while( $mess<$mto );

// prin($Months);
// $mfrom2 = date("Y-m-d",strtotime("$mfrom + 1 month"));





$tipos=[
    '0'=>'Agremiados',
    '1'=>'Aportantes CAEE',
];



$filas=select(
    [
        'is_caee as tipo',
        'month',
        'total',
    ],
    'people_evolution_general',
    ""
    // ." left join settlements on settlements.id=people_evolution_general.id_settlement "
    ." where 1 "
    ." $busqueda_query "
    .' order by 
        is_caee,
        month asc '
    // .' limit 0,10'
    ,
    0
);

foreach($filas as $fila){

    $regimenes[$tipos[$fila['tipo']]][$fila['month']]=$fila['total'];

}


foreach($regimenes as $tipo=>$months){

    $repor['tipo']=['text'=>$tipo];
    foreach($Months as $month){
        $repor[$month]=['text'=>$months[$month]];
    }
    // foreach($months as $month=>$total){
    //     $repor[$month]=['text'=>$total];
    // }
    $reports[]=$repor;
    // prin($repor);
    unset($repor);
}

// prin($reports);

$labels=[

    'tipo'=>[
        'label'=>'Tipo',
        'campo'=>'tipo',
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'150px'
    ],

];



// $labels_=$reports[0];
// unset($labels_['base']);
// unset($labels_['tipo']);
foreach($Months as $month){
    $labels[$month]=[
        'label'=>fecha_formato($month,'4b'),
        'campo'=>$month,
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'65px'
    ];
}

// prinx($reports[0]);

$tblistado=$datos_tabla['list']=$labels;

$items=$pagina_items['filas']=$reports;
// prin($items);

$pagina_items['total']=sizeof($items);

$datos_tabla['include_list']="view_people_evolution_list.php";

$controls=[
    "<a class='btn-print' onclick='window.print();return false;' data-url='' >Imprimir</a>",
    "<a class='btn-excel' onclick=\"ax('excel','','','PEOPLE','&middlewarelist=".$_GET['middlewarelist']."','');return false;\" >Exportar Excel</a>",
];
