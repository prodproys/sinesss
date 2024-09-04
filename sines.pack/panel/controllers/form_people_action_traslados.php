<?php
/**
**** 
* Archivo: form_people_action_traslados.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de traslado de "ente" de la persona
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

    // $id_location=dato("id","locations",'where code="'.$_POST['new_location'].'"',0);

    insert([
        'description'=>$_POST['motivo'],
        'fecha_creacion'=>'now()',
        'type'=>'Move',
        'id_persona'=>$_GET['id_person'],
        'start_location'=>$persona['id_location'],
        'end_location'=>$_POST['new_location'],
    ],"records");

    update([
        'id_location'=>$_POST['new_location']
    ],"people","where id=".$_GET['id_person'],0);

    /*
    
    $location=fila('id_settlement,id_group','locations','where id='.$_POST['new_location']);

    $current=date('Y-m-01 00:00:00');

    update(
        ['id_settlement'=>$location['id_settlement']],
        'primaryshares',
        'where 
        month="'.$current.'" and 
        id_persona='.$_GET['id_person']
    );
    update(
        ['id_settlement'=>$location['id_settlement']],
        'secondaryshares',
        'where 
        month="'.$current.'" and 
        id_persona='.$_GET['id_person']
    );

    update_evolution([$current],[0,1],[$location['id_settlement']],[$location['id_group']]);

    */

    echo json_encode([
        'status'=>'success',
        'text'=>"Traslado Exitoso",
        'eval'=>'location.reload();',
    ]);

    exit();

}

$persona=fila(
    "id_location,code,nombre,apellidos",
    "people",
    "where id=".$_GET['id_person'],
    0);

$locations=opciones(
    ["code as nombre","id"],
    "locations",
    "where id!=".$persona['id_location']." order by code asc",
    0
);

$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

$fields=[
    
    'motivo'=>[
        'class' =>'validate',
        'label' =>'Describe el motivo',
        'type' => 'textarea',
        'legend' => '¡ATENCIÓN! Si se traslada a un ente de otra base, en un futuro cambiará la asignación de sus aportaciones.',
    ],        
    'new_location'=>[
        'class' =>'validate',
        'label' =>'Trasladar a',
        'type' => 'select',
        'options'=>$locations,
    ],
];
$title="Traslado";

$button='PROCESAR CAMBIOS';

$fields=processFields($fields);

$viewFile="view_form_general";

