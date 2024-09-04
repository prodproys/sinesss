<?php
/**
**** 
* Archivo: form_people_status_document.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario para cambiar el estado de un documento
**** 
*/




// prin($_SESSION);

$persona=fila(
    [
        "people.id_location as id_location",
        "people.code as code",
        "people.nombre as nombre",
        "people.apellidos as apellidos",
        "settlements.nombre as settlement"
    ],
    "people",
    "
    left join locations on locations.id=people.id_location
    left join settlements on settlements.id=locations.id_settlement
    where people.id=".$_GET['id_person'],
    0);
    

if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_POST['state_id']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Escoja un Estado",
        ]);
        exit();
    }      

    update(
        [
            'state_id'=>$_POST['state_id'],
        ],"documents",
        "where id=".$_GET['id']
    );

    $text_success="Cambio de Estado exitoso";

    echo json_encode([
        'status'=>'success',
        'text'=>$text_success,
        'eval'=>"ax('paginaUrl','','1','DOCUMENTOS','inner_after','&id_persona=".$_GET['id_person']."','sub')"
    ]);    

    exit();

}



$locations=opciones(
    ["code as nombre","id"],
    "locations",
    "where id!=".$persona['id_location']." order by code asc",
    0
);

$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

$settlement=$persona['settlement'];

$fields=[

    'state_id'=>[
        'class' =>'validate',
        'label' =>'Estado',
        'divclass'  =>'col-7',
        'type' => 'select',
        'options'  => [
            '1' => 'Registrado',
            '2' => 'Finalizado',
            '3' => 'Rechazado',
            '4' => 'En evaluación',
            '5' => 'Asignando depósitos',
        ],
    ],

];


$title="Cambio de Estado ".dato("code","documents","where id=".$_GET['id']);

$button='Cambiar';

  
$document=fila( [

    'state_id',

],"documents","where id=".$_GET['id']);

$fields['state_id']['value']=$document['state_id'];

// $fields['mode']=['type'=>'hidden','value'=>'edit'];
// $fields['id']=['type'=>'hidden','value'=>$_GET['id']];






$fields=processFields($fields);

$viewFile="view_form_general";

