<?php
/**
**** 
* Archivo: form_people_action_mover_pagp.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de mover pago
**** 
*/





/*
######## #### ######## ##       ########   ######
##        ##  ##       ##       ##     ## ##    ##
##        ##  ##       ##       ##     ## ##
######    ##  ######   ##       ##     ##  ######
##        ##  ##       ##       ##     ##       ##
##        ##  ##       ##       ##     ## ##    ##
##       #### ######## ######## ########   ######
*/
$concepts=[
    'curso_elit'=>'Curso Elit',
    'seguro_rimac'=>'Seguro Rimac',
];

$fields=[

    'concept'=>[
        'label' =>'Tipo',
        'divclass'  =>'col-4',
        'type' => 'select',
        'options'=>$concepts,
    ], 
    'type'=>[
        'label' =>'Tipo',
        'divclass'  =>'col-3',
        'type'  =>'select',
        'value'=>'Voucher',
        'class' =>'validate',
        'options'=>[
            'Voucher'=>'Deposito',
            'Voucher2'=>'FORMATO ESSALUD'
        ]
        // 'disabled'  =>'1'
    ],     
    'monto_mes'=>[
        'label' =>'Monto',
        'divclass'  =>'col-5',
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
        'value'     => date("Y-m-d"),
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

/*
88      dP"Yb     db    8888b.      8888b.     db    888888  dP"Yb  .dP"Y8
88     dP   Yb   dPYb    8I  Yb      8I  Yb   dPYb     88   dP   Yb `Ybo."
88  .o Yb   dP  dP__Yb   8I  dY      8I  dY  dP__Yb    88   Yb   dP o.`Y8b
88ood8  YbodP  dP""""Yb 8888Y"      8888Y"  dP""""Yb   88    YbodP  8bodP'
*/
if($_GET['id']!=''){

    if($_GET['from']=='primary'){

        $document=fila( 
            [
                'id_persona',
                'amount as monto_mes',

                'voucher as operacion',

                'fecha_creacion as fecha_pago',
                'comment as comentario',

                'type',
                'month',
                'operation_id'

            ]
            ,"primaryshares"
            ,"where id=".$_GET['id']
            ,0
        );

    } elseif($_GET['from']=='secondary'){

        $document=fila( 
            [
                'id_persona',
                'amount as monto_mes',
                
                'voucher as operacion',
    
                'fecha_creacion as fecha_pago',
                'comment as comentario',
                
                'type',
                'month',
    
            ]
            ,"secondaryshares"
            ,"where id=".$_GET['id']
            ,0
        );
            
    } elseif($_GET['from']=='payment'){
        
        $document=fila( 
            [
                'id_persona',
                'concept',
                'type',
                'amount as monto_mes',
                'voucher as operacion',
                'fecha_creacion as fecha_pago',
                'comment as comentario',
                'operation_id'
            ]
            ,"payments"
            ,"where id=".$_GET['id']
            ,0
        );
    
    }
    
    $document['monto_mes']=number_format($document['monto_mes'],'2');

    $_GET['id_person']=$document['id_persona'];
    
}

$persona=fila(
    [
        "people.id_group as id_group",
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
 #######  ##    ##    ########   #######   ######  ########
##     ## ###   ##    ##     ## ##     ## ##    ##    ##
##     ## ####  ##    ##     ## ##     ## ##          ##
##     ## ## ## ##    ########  ##     ##  ######     ##
##     ## ##  ####    ##        ##     ##       ##    ##
##     ## ##   ###    ##        ##     ## ##    ##    ##
 #######  ##    ##    ##         #######   ######     ##
*/
if($_SERVER['REQUEST_METHOD']=='POST'){


    $more=null;

    /*
    8b    d8  dP"Yb  Yb    dP 888888
    88b  d88 dP   Yb  Yb  dP  88__
    88YbdP88 Yb   dP   YbdP   88""
    88 YY 88  YbodP     YP    888888
    */

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

    $payment=insert(
        [
            'type'=>'Voucher',
            'new_imported'=>'2',
            'id_settlement'=>$persona['id_settlement'],
            'id_persona'=>$_GET['id_person'],

            'concept'=>$_POST['concept'],
            'type'=>$_POST['type'],
            'voucher'=>$_POST['operacion'],
            'amount'=>$_POST['monto_mes'],
            'comment'=>$_POST['comentario'],
            'fecha_creacion'=>$_POST['fecha_pago']." 00:00:00",

            'operation_id'=>$operation['id'],
            'registered_by'=>$_SESSION['usuario_datos_nombre'],                    
        ],
        'payments'
    );

    /*
    888888 88     88 8b    d8 88 88b 88    db    88""Yb
    88__   88     88 88b  d88 88 88Yb88   dPYb   88__dP
    88""   88  .o 88 88YbdP88 88 88 Y88  dP__Yb  88"Yb
    888888 88ood8 88 88 YY 88 88 88  Y8 dP""""Yb 88  Yb
    */
    if($_GET['from']=='primary'){

        delete("primaryshares","where id=".$_GET['id']);

    } elseif($_GET['from']=='secondary'){

        delete("secondaryshares","where id=".$_GET['id']);

    } elseif($_GET['from']=='payment'){
        
        delete("payments","where id=".$_GET['id']);

    }    
    // $more='<div class="text-right"><button type="button" data-url="modal.php?page=print_operation&id='.$operation['id'].'&mode=print" class="btn btn-primary modal-page print_operation" >Ver operación</button></div>';

    $text_success="Movido Exitosamente";




    /*
    888888 88 88b 88    db    88     88     Yb  dP
    88__   88 88Yb88   dPYb   88     88      YbdP
    88""   88 88 Y88  dP__Yb  88  .o 88  .o   8P
    88     88 88  Y8 dP""""Yb 88ood8 88ood8  dP
    */


    echo json_encode([
        'status'=>'success',
        'text'=>$text_success,
        // 'eval'=>'location.reload();',
        // 'eval'=>"ax('paginaUrl','','1','PAYMENTS','inner_after','&id_persona=".$_GET['id_person']."','sub')",
        'eval'=>"document.querySelector('.nav-link.link-payments').click();",
        'more'=>$more

    ]);
    
    exit();

}

/*
########  #######  ########  ##     ##
##       ##     ## ##     ## ###   ###
##       ##     ## ##     ## #### ####
######   ##     ## ########  ## ### ##
##       ##     ## ##   ##   ##     ##
##       ##     ## ##    ##  ##     ##
##        #######  ##     ## ##     ##
*/




$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

$title="Mover a Pago";

$button='Mover';

$viewFile="view_form_general";

$fields['monto_mes']['value']=$document['monto_mes'];
$fields['monto_mes']['readonly']='1';


$fields['comentario']['value']=$document['comentario'];

$fields['type']['value']=$document['type'];
$fields['type']['readonly']='1';

$fields=processFields($fields);


$maxwidth="100%";