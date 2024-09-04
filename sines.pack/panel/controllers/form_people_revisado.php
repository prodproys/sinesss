<?php
/**
**** 
* Archivo: form_people_revisado.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario para marcar una aportación como revisada
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

$fields=[
    'revisados'=>[
        'type' => 'hidden',
    ],
];






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

    // print_r($_POST);print_r($_GET);exit();
    $more=null;
    /*
    88""Yb 888888 Yb    dP 88 .dP"Y8    db    8888b.   dP"Yb
    88__dP 88__    Yb  dP  88 `Ybo."   dPYb    8I  Yb dP   Yb
    88"Yb  88""     YbdP   88 o.`Y8b  dP__Yb   8I  dY Yb   dP
    88  Yb 888888    YP    88 8bodP' dP""""Yb 8888Y"   YbodP
    */
    $revisados=explode(',',$_POST['revisados']);
    if(sizeof($revisados)>0)
    foreach($revisados as $revisado){

        update(
            [
                'revisado'=>$_GET['check'],
            ],
            $_GET['share'],
            "where id=".$revisado,
            0
        );

    }

    if($_GET['check']=='1')
        $text_success="Marcado como revisado Exitosamente";
    if($_GET['check']=='0')
        $text_success="Desmarcado como revisado Exitosamente";



 




    // RETURN THE RESPONSE
    echo json_encode([
        'status'=>'success',
        'text'=>$text_success,
        // 'eval'=>'location.reload();',
        // 'eval'=>"ax('paginaUrl','','1','PRIMARY_SHARES','inner_after','&id_persona=".$_GET['id_person']."','sub')",
        'eval'=>"document.querySelector('.nav-link.link-".$_GET['share']."').click();",
        // 'onprint'=>"document.querySelector('.controModal.modal').innerHTML=",
        'more'=>$more,

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

if($_GET['check']=='1')
$title="Marcar como revisado";
if($_GET['check']=='0')
$title="Desmarcar como revisado";

if($_GET['check']=='1')
$button='Marcar';
if($_GET['check']=='0')
$button='Desmarcar';

$viewFile="view_form_shares";



/*
88""Yb 888888 Yb    dP 88 .dP"Y8    db    8888b.   dP"Yb
88__dP 88__    Yb  dP  88 `Ybo."   dPYb    8I  Yb dP   Yb
88"Yb  88""     YbdP   88 o.`Y8b  dP__Yb   8I  dY Yb   dP
88  Yb 888888    YP    88 8bodP' dP""""Yb 8888Y"   YbodP
*/
//if($_GET['mode']=='revision' and $_GET['id']!=''){

    $title="Revisión de aportación ".fecha_formato($document['month'],'4b');

    if($_GET['check']=='1'){

        $alert=[
            'title'=>'Revisión',
            'text'=>'¿Desea marcar la aportación como revisada?',
            'class'=>'alert-danger',
        ];

        $button='MARCAR COMO REVISADO';

    } elseif($_GET['check']=='0'){

        $alert=[
            'title'=>'Revisión',
            'text'=>'¿Desea desmarcar la aportación como revisada?',
            'class'=>'alert-danger',
        ];
    
        $button='DESMARCAR COMO REVISADO';

    }


    $viewFile="view_form_general";

// }

$fields=processFields($fields);


$maxwidth="100%";