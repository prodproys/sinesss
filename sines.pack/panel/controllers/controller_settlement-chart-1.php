<?php
/**
**** 
* Archivo: controller_settlement-chart-1.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo provee los datos backend que usa la grafica "ingreso aportaciones regulares" de la pagina "dashboard" de una base
**** 
*/





$rango=12*1+6;
$ultimo=1;

$from=date("Y-m-01 00:00:00",strtotime(" " . ( $ultimo + $rango ) . " month ago"));
$to=date("Y-m-01 00:00:00",strtotime(" $ultimo month ago"));


for($ii=$ultimo; $ii<=$ultimo+$rango; $ii++){
    $months[]=fecha_formato(date("Y-m-01 00:00:00",strtotime(" $ii month ago")),'4b');
}
$months=array_reverse($months);


$income_types=[
    '0'=>"Agremiados",
    '1'=>"Agremiados Aceptan CAEE"
];
$income_tabla=[
    '0'=>"primaryshares",
    '1'=>"secondaryshares"
];

foreach($income_types as $type=>$name){

    if(0)
    $series_sql[$type]=opciones(
        [
            'month as id',
            'total as nombre'
        ],
        "people_evolution",
        "
        where month between '$from' and '$to' 
        and is_caee = $type
        and id_settlement= ".$_GET['id_settlement']."
        ",
        0,
        [
            'id'=>['fecha'=>['fecha'=>'{id}','formato'=>'4b']],
        ]
    );

    $series_sql[$type]=opciones(
        [
            'month as id',
            'count(*) as nombre'
        ],
        $income_tabla[$type],
        "
        where month between '$from' and '$to' 
        and id_settlement= ".$_GET['id_settlement']."
        group by month
        order by month asc
        ",
        0,
        [
            'id'=>['fecha'=>['fecha'=>'{id}','formato'=>'4b']],
        ]
    );    

}

// prinx($series_sql);

foreach($series_sql as $type=>$series_sql){

    $series_type['name']=$income_types[$type];

    foreach($months as $month){

        $series_type['data'][]=$series_sql[$month]*1;

    }
    $series[]=$series_type;
    unset($series_type);

}



echo json_encode([
    'series'=>$series,
    'categories'=>$months,
]);
