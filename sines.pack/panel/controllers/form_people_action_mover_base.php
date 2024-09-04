<?php
/**
**** 
* Archivo: form_people_action_mover_base.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de mover base
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

$tabla=[
    'primary'=>'primaryshares',
    'secondary'=>'secondaryshares',
    'payment'=>'payments',
];
$bases=opciones("id,nombre","settlements","",0);

$fields=[

    'id_settlement'=>[
        'label' =>'Base',
        'divclass'  =>'col-12',
        'type' => 'select',
        'options'=>$bases,
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
                'id_settlement',
            ]
            ,$tabla[$_GET['from']]
            ,"where id=".$_GET['id']
            ,0
        );

    } elseif($_GET['from']=='secondary'){

        $document=fila( 
            [
                'id_persona',
                'id_settlement',
            ]
            ,"secondaryshares"
            ,"where id=".$_GET['id']
            ,0
        );

    } elseif($_GET['from']=='payment'){
        
        $document=fila( 
            [
                'id_persona',
                'id_settlement',
            ]
            ,"payments"
            ,"where id=".$_GET['id']
            ,0
        );

    }
    
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

    if($_POST['id_settlement']==''){
        echo json_encode([
            'status'=>'danger',
            'text'=>"Escoja una base",
        ]);
        exit();
    }

    $payment=update(
        [
            'id_settlement'=>$_POST['id_settlement'],                    
        ],
        $tabla[$_GET['from']],
        "where id=".$_GET['id'],
        0
    );

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
        'eval'=>"document.querySelector('.nav-link.link-".$tabla[$_GET['from']]."').click();",
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

$title="Mover de Base";

$button='Mover';

$viewFile="view_form_general";



$fields['id_settlement']['value']=$document['id_settlement'];


$fields=processFields($fields);


$maxwidth="100%";