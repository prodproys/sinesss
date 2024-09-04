<?php

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

    if($_POST['tipo_documento']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Escoja un tipo de documento",
        ]);
        exit();
    }  
    
    if($_POST['tipo_evento']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Escoja un tipo de evento",
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
                'document_type_id'=>$_POST['tipo_documento'],
                'document_type_value_id'=>$_POST['tipo_evento'],
                
                'classifier_a'=>$_POST['ficha_cancelacion'],
                'classifier_b'=>$_POST['resolucion'],

                'event_date'=>$_POST['fecha_evento'],
                'document_entry_date'=>$_POST['fecha_input'],
            ],"documents",
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
    $maxCode=dato("code","documents","order by code desc  limit 0,1");
    $nextCode_number=str_replace("CA-","",$maxCode)*1 + 1;
    $newCode="CA-".str_pad($nextCode_number,9,"0",STR_PAD_LEFT);
    // $id_location=dato("id","locations",'where code="'.$_POST['new_location'].'"',0);

    insert(
        [
            'fecha_creacion'=>'now()',
            'code'=>$newCode,
            'state_id'=>'1',
            'id_persona'=>$_GET['id_person'],

            'document_type_id'=>$_POST['tipo_documento'],
            'document_type_value_id'=>$_POST['tipo_evento'],
            
            'classifier_a'=>$_POST['ficha_cancelacion'],
            'classifier_b'=>$_POST['resolucion'],

            'event_date'=>$_POST['fecha_evento'],
            'document_entry_date'=>$_POST['fecha_input'],

            'id_settlement'=>$persona['id_settlement'],

            'created_by'=>$_SESSION['usuario_datos_nombre'],
        ],
        "documents"
    );

    $text_success="Creación Exitosa";

    

    echo json_encode([
        'status'=>'success',
        'text'=>"Creación Exitosa",
        'eval'=>"ax('paginaUrl','','1','DOCUMENTOS','inner_after','&id_persona=".$_GET['id_person']."','sub','3')"
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
      
    'fecha_input'=>[
        'label' =>'Fecha de ingreso del documento',
        'divclass'  =>'col-6',
        'readonly'  =>'1',
        'type'  =>'date',
        'value'     => date("Y-m-d"),
    ],    
    'tipo_documento'=>[
        'class' =>'validate',
        'label' =>'Tipo de documento',
        'type' => 'select',
        'divclass'  =>'col-12',
        'options'=>[
            '1'=>'CAEE - Requerimiento de Asignación',
            '2' => 'Requerimiento FAS',
        ],        

    ],
    'tipo_evento'=>[
        'class' =>'validate',
        'label' =>'Tipo del evento',
        'divclass'  =>'col-7',
        'type' => 'select',
        'options'  => [
            // '1' => 'Fallecimiento madre',
            // '2' => 'Fallecimiento padre',
            // '3' => 'Cese',
            // '4' => 'Renuncia',
            // '5' => 'Fallecimiento hijo',
            // '6' => 'Fallecimiento hija',
            // '7' => 'Fallecimiento conyugue',
            // '8' => 'Fallecimiento titular',                        
        ],
    ],

    'fecha_evento'=>[
        'label' =>'Fecha del Evento',
        'readonly'  =>'1',
        'divclass'  =>'col-5',
        'type'  =>'date',
        'value'     => date("Y-m-d"),
    ], 
    
    'ficha_cancelacion'=>[
        'label' =>'Ficha de cancelación',
    ],
    'resolucion'=>[
        'label' =>'Resolución',
    ],    

];

$title="Nuevo Documento";

$button='CREAR';

if($_GET['mode']=='edit'){
  
    $document=fila( [
        'code',
        'document_type_id as tipo_documento',
        'document_type_value_id as tipo_evento',
        
        'classifier_a as ficha_cancelacion',
        'classifier_b as resolucion',

        'event_date as fecha_evento',
        'document_entry_date as fecha_input',

    ],"documents","where id=".$_GET['id']);
    
    $fields['tipo_documento']['value']=$document['tipo_documento'];
    $fields['tipo_evento']['value']=$document['tipo_evento'];
    $fields['ficha_cancelacion']['value']=$document['ficha_cancelacion'];
    $fields['resolucion']['value']=$document['resolucion'];
    $fields['fecha_evento']['value']=fecha_formato($document['fecha_evento'],'11b');
    $fields['fecha_input']['value']=fecha_formato($document['fecha_input'],'11b');

    // $fields['mode']=['type'=>'hidden','value'=>'edit'];
    // $fields['id']=['type'=>'hidden','value'=>$_GET['id']];

    $title="Editar Documento ".$document['code'];

    $button='GUARDAR';

}



$fields=processFields($fields);

$viewFile="view_form_general";

