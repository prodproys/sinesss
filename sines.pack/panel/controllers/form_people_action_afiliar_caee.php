<?php
/**
**** 
* Archivo: form_people_action_afiliar_caee.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de afiliación caee
**** 
*/






$persona=fila(
    "id_location,
    people.code as code,
    people.nombre as nombre,
    apellidos,
    locations.id_settlement as id_settlement",
    "people",
    "
    left join locations on locations.id=people.id_location
    where people.id=".$_GET['id_person'],
    0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    update([
        'is_caee'=>'1'
    ],"people","where id=".$_GET['id_person'],0);

    insert([
        'description'=>$_POST['motivo'],
        'fecha_creacion'=>'now()',
        'type'=>'SecondaryShareAffiliation',
        'id_persona'=>$_GET['id_person'],
    ],"records");

    echo json_encode([
        'status'=>'success',
        'text'=>"Aceptación Exitosa",
        'eval'=>'location.reload();'
    ]);

    exit();

}


$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";


$fields=[
    
    'motivo'=>[
        'class' =>'validate',
        'label' =>'Describe el motivo',
        'type' => 'textarea',
        'legend' => 'Atención! se procederá a registar a la persona'
    ],
    
];

$title="Acepta CAEE";

$button='PROCESAR CAMBIOS';

$fields=processFields($fields);

$viewFile="view_form_general";
