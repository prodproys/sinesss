<?php
/**
**** 
* Archivo: controller_home-chart-2.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo provee los datos backend que usa la grafica "ingreso aportaciones regulares" de la pagina "dashboard"
**** 
*/





$rango=16;
$ultimo=1;

$from=date("Y-m-01 00:00:00",strtotime(" " . ( $ultimo + $rango ) . " month ago"));
$to=date("Y-m-01 00:00:00",strtotime(" $ultimo month ago"));


for($ii=$ultimo; $ii<=$ultimo+$rango; $ii++){
    $months[]=fecha_formato(date("Y-m-01 00:00:00",strtotime(" $ii month ago")),'4b');
}
$months=array_reverse($months);


// prin(['from'=>$from,'to'=>$to,'month'=>$months]);



$income_types=[
    "'Imported'"=>"Ingreso descuento directo ESSALUD",
    "'Voucher','Voucher2'"=>"Ingreso depósitos",
];

foreach($income_types as $type=>$name){

    $series_sql[$type]=opciones(
        [
            'primaryshares.month as id',
            'sum(primaryshares.amount) as nombre'
        ],
        "people",
        "
        left join primaryshares on people.id=primaryshares.id_persona
        where month between '$from' and '$to' 
        and type in (".$type.")
        group by month",
        0,
        [
            'id'=>['fecha'=>['fecha'=>'{id}','formato'=>'4b']],
        ]
    );

}


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
