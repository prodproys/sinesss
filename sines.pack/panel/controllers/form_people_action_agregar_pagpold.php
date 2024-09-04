<?php
/**
**** 
* Archivo: form_people_action_agregar_pagpold.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción: Este archivo tiene la finalidad de 
**** 
*/


/**
* 
* Archivo: form_people_action_agregar_pagpold.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción: Este archivo tiene la finalidad de 
* 
*/



$persona=fila(
    [
        "people.id_location as id_location",
        "people.code as code",
        "people.nombre as nombre",
        "people.apellidos as apellidos",
        "locations.id_settlement as id_settlement",
        "settlements.nombre as settlement"
    ],
    "people",
    "
    left join locations on locations.id=people.id_location
    left join settlements on settlements.id=locations.id_settlement
    where people.id=".$_GET['id_person'],
    0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_POST['type']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Escoja un tipo de pago",
        ]);
        exit();
    } 
    if($_POST['monto_mes']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Ingrese Monto por Mes",
        ]);
        exit();
    } 

    insert(
        [
            'type'=>$_GET['type'],
            'concept'=>$_POST['type'],
            'id_persona'=>$_GET['id_person'],
            'amount'=>$_POST['monto_mes'],
            'id_settlement'=>$persona['id_settlement'],
            'comment'=>$_POST['comentario'],
            'fecha_creacion'=>$_POST['fecha_pago']." 00:00:00",
            'new_imported'=>'2',
        ],
        'payments'
    );

     

     

    echo json_encode([
        'status'=>'success',
        'text'=>"Aportes agregados Exitosamente",
        // 'eval'=>'location.reload();',
        'eval'=>"ax('paginaUrl','','1','PAYMENTS','inner_after','&id_persona=".$_GET['id_person']."','sub')",
    ]);

    
    exit();

}


$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

$types=[
    'curso_elit'=>'Curso Elit',
    'seguro_rimac'=>'Seguro Rimac',
];

$fields=[

    'type'=>[
        'label' =>'Tipo',
        'divclass'  =>'col-6',
        'type' => 'select',
        'options'=>$types,
    ], 
    'monto_mes'=>[
        'label' =>'Monto',
        'divclass'  =>'col-6',
        'pre'=>'S/.',
    ], 
    'operacion'=>[
        'label' =>'Operación',
        'divclass'  =>'col-6',
        // 'disabled'  =>'1'
    ], 
    'fecha_pago'=>[
        // 'class' =>'validate',
        'label' =>'Fecha de Pago',
        'divclass'  =>'col-6',
        'readonly'  =>'1',
        'value'     => date("Y-m-h"),
        'type'  =>'date',
        // 'value'     => '2020-08-23',
    ], 
    'comentario'=>[
        // 'class' =>'validate',
        'label' =>'Comentario',
        // 'type' => 'textarea',
        // 'legend' => 'Atención! se procederá a desafiliar a la persona'
    ],
    
];

// $fields['comentario']['value']='yala';
// $fields['operacion']['value']='90210';
// $fields['monto_mes']['value']='120';


$title="Registro de otro pago";

$button='Registrar pago';

$fields=processFields($fields);

$viewFile="view_form_shares";

$maxwidth="100%";