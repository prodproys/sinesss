<?php

$concepts  = [
    'seguro_rimac' => 'Seguro RIMAC',
    'curso_elit' => 'Curso ELIT',
    'regularizaciones'=>'Regularizaciones',//SETIEMBRE2021
];

$share_tables=[
    'PrimaryShareOperation'=>'primaryshares',
    'SecondaryShareOperation'=>'secondaryshares',
    'PaymentOperation'=>'payments',
];
$share_types=[
    'PrimaryShareOperation'=>'Aporte regular',
    'SecondaryShareOperation'=>'Aporte CAEE',
    'PaymentOperation'=>'Otro Pago',
];

$operation=fila(
    [
        'operations.id as id',
        'operations.submitted_at_label as submitted_at',
        'operations.deposit_at_label as deposit_at',
        'operations.share_type as share_type',
        'operations.total_amount as total_amount',
        'operations.total_shares as total_shares',
        'operations.monthly_amount_label as monthly_amount',
        'people.nombre as nombre',
        'people.apellidos as apellidos',
        'people.code as code',
    ],"operations"
    ,"left join people on people.id=operations.id_persona
    where operations.id=".$_GET['id']
);
$operation['submitted_at']=fecha_formato($operation['submitted_at'],'0a');
$operation['deposit_at']=fecha_formato($operation['deposit_at'],'0a');
$operation['type']=$share_types[$operation['share_type']];
$operation['total_amount']=number_format($operation['total_amount'],'2');

$tabla=$share_tables[$operation['share_type']];

$shares=select(
    [
        // $tabla.'id as id',
        $tabla.'.month as month',
        $tabla.'.amount as amount',
        $tabla.'.concept as concept',
        $tabla.'.registered_by as registered_by',
        'settlements.nombre as base',
    ]
    ,$tabla
    ,"left join settlements on settlements.id=".$tabla.".id_settlement
    where operation_id=".$_GET['id']
    ,0
);

foreach($shares as $i=>$share){
    $shares[$i]['month']=fecha_formato($shares[$i]['month'],'4b');
    $shares[$i]['amount']=number_format($shares[$i]['amount'],'2');
    $shares[$i]['number']=$i+1;
    $shares[$i]['concept']=$concepts[$shares[$i]['concept']];
}

$operation['registered_by']=$shares[0]['registered_by'];

// prin($operation);
// prin($shares);
$title="Operación";
$button="Imprimir";

$viewFile="view_print_operation";
