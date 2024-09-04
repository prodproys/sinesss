<?php
/**
**** 
* Archivo: form_new_asigment.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de agregar y editar una asignación
**** 
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
    where people.id=".$_GET['id_person']
    ,0
);

$document_parent=fila( 
    [
        'code',
        'document_type_id as tipo_documento',
        'document_type_value_id as tipo_evento',
        
        'classifier_a as ficha_cancelacion',
        'classifier_b as resolucion',

        'event_date as fecha_evento',
        'document_entry_date as fecha_input',

    ]
    ,"documents","where id=".$_GET['id_document']
    ,0
);
/*
########   #######   ######  ########
##     ## ##     ## ##    ##    ##
##     ## ##     ## ##          ##
########  ##     ##  ######     ##
##        ##     ##       ##    ##
##        ##     ## ##    ##    ##
##         #######   ######     ##
*/
if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_POST['amount']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Ingrese un monto",
        ]);
        exit();
    }  
    
 

    /*
    88   88 88""Yb 8888b.     db    888888 888888
    88   88 88__dP  8I  Yb   dPYb     88   88__
    Y8   8P 88"""   8I  dY  dP__Yb    88   88""
    `YbodP' 88     8888Y"  dP""""Yb   88   888888
    */
    if($_GET['mode']=='edit'){

        update(
            [
                'fecha_edicion'=>'now()',
                'amount'=>$_POST['amount'],
                'operation_bank'=>$_POST['operation_bank'],
                'transaction_date'=>$_POST['transaction_date'],
            ],"asigments",
            "where id=".$_GET['id']
        );

        echo json_encode([
            'status'=>'success',
            'text'=>"Edición Exitosa",
            'eval'=>"ax('paginaUrl','','1','DOCUMENTOS','inner_after','&id_persona=".$_GET['id_person']."','sub')"
        ]);  

        exit();

    }

    /*
    88 88b 88 .dP"Y8 888888 88""Yb 888888
    88 88Yb88 `Ybo." 88__   88__dP   88
    88 88 Y88 o.`Y8b 88""   88"Yb    88
    88 88  Y8 8bodP' 888888 88  Yb   88
    */

    insert(
        [
            'fecha_creacion'=>'now()',

            'amount'=>$_POST['amount'],
            'operation_bank'=>$_POST['operation_bank'],
            'transaction_date'=>$_POST['transaction_date'],

            'id_document'=>$_GET['id_document'],
            'created_by'=>$_SESSION['usuario_datos_nombre'],

        ],
        "asigments"
    );

    $text_success="Creación Exitosa";

    

    echo json_encode([
        'status'=>'success',
        'text'=>"Creación Exitosa",
        'eval'=>"ax('paginaUrl','','1','DOCUMENTOS','inner_after','&id_persona=".$_GET['id_person']."','sub','3')"
    ]);    

    exit();

}




$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

// $settlement=$persona['settlement'];


$fields=[
    'amount'=>[
        'class' =>'validate',
        'label' =>'Monto',
        'divclass'  =>'col-6',
    ],
    'operation_bank'=>[
        // 'class' =>'validate',
        'label' =>'Operación Bancaria',
        'divclass'  =>'col-6',
    ],      
    'transaction_date'=>[
        'label' =>'Fecha de transacción',
        'divclass'  =>'col-6',
        'readonly'  =>'1',
        'type'  =>'date',
        'value'     => date("Y-m-d"),
    ], 

];

$title="Nueva Asignación - Documento ".$document_parent['code'];

$button='CREAR';

if($_GET['mode']=='edit'){
  
    $document=fila( [
        'amount',
        'operation_bank',
        'transaction_date'
    ],"asigments","where id=".$_GET['id']);
    
    $fields['amount']['value']=$document['amount'];
    $fields['transaction_date']['value']=$document['transaction_date'];
    $fields['transaction_date']['value']=fecha_formato($document['transaction_date'],'11b');

    $title="Editar Asignación";

    $button='GUARDAR';

}



$fields=processFields($fields);

$viewFile="view_form_general";

