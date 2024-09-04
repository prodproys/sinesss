<?php
/**
**** 
* Archivo: form_people_action_agregar_caee.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario de agremiar agregar aportación caee
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

    'monto_mes'=>[
        'class' =>'validate',
        'label' =>'Monto por Mes',
        'divclass'  =>'col-5',
        'pre'=>'S/.',
    ],    
    'total_meses'=>[
        'label' =>'Total',
        'divclass'  =>'col-2',
        'readonly'  =>'1',
    ], 
    'monto_total'=>[
        'label' =>'Monto Total',
        'divclass'  =>'col-5',
        'readonly'  =>'1',
        'pre'=>'S/.',
    ], 
    'operacion'=>[
        'label' =>'Operación',
        'divclass'  =>'col-4',
        // 'disabled'  =>'1'
    ], 
    'fecha_pago'=>[
        // 'class' =>'validate',
        'label' =>'Fecha de Pago',
        'divclass'  =>'col-5',
        'readonly'  =>'1',
        'value'     => date("Y-m-d"),
        'type'  =>'date',
        // 'value'     => '2020-08-23',
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
    88""Yb 888888 Yb    dP 88 .dP"Y8    db    8888b.   dP"Yb
    88__dP 88__    Yb  dP  88 `Ybo."   dPYb    8I  Yb dP   Yb
    88"Yb  88""     YbdP   88 o.`Y8b  dP__Yb   8I  dY Yb   dP
    88  Yb 888888    YP    88 8bodP' dP""""Yb 8888Y"   YbodP
    */
    if($_GET['mode']=='revision'){
        
        update(
            ['revisado'=>'1'],
            'secondaryshares',
            "where id=".$_GET['id']
        );

        $text_success="Revisado Exitosamente";

    }
    /*
    8888b.  888888 88     888888 888888 888888
     8I  Yb 88__   88     88__     88   88__
     8I  dY 88""   88  .o 88""     88   88""
    8888Y"  888888 88ood8 888888   88   888888
    */
    elseif($_GET['mode']=='delete'){
        
        delete(
            'secondaryshares',
            "where id=".$_GET['id']
        );

        $text_success="Eliminado Exitosamente";

    }
    /*
    88   88 88""Yb 8888b.     db    888888 888888
    88   88 88__dP  8I  Yb   dPYb     88   88__
    Y8   8P 88"""   8I  dY  dP__Yb    88   88""
    `YbodP' 88     8888Y"  dP""""Yb   88   888888
    */
    elseif($_GET['mode']=='edit'){

        update(
            [
                // 'month'=>$share,
                // 'id_persona'=>$_GET['id_person'],
                'type'=>$_POST['type'],
                // 'id_settlement'=>$persona['id_settlement'],
                'amount'=>$_POST['monto_mes'],
                'comment'=>$_POST['comentario'],
                'voucher'=>$_POST['operacion'],
                'fecha_creacion'=>$_POST['fecha_pago']." 00:00:00",
            ],
            'secondaryshares',
            "where id=".$_GET['id']
        );

        $more='<div class="text-right"><button type="button" data-url="modal.php?page=print_operation&id='.$document['operation_id'].'&mode=print" class="btn btn-primary modal-page print_operation" >Ver operación</button></div>';

        $text_success="Edición Exitosa";


    } 
    /*
    88 88b 88 .dP"Y8 888888 88""Yb 888888
    88 88Yb88 `Ybo." 88__   88__dP   88
    88 88 Y88 o.`Y8b 88""   88"Yb    88
    88 88  Y8 8bodP' 888888 88  Yb   88
    */
    else {

        if(sizeof($_POST['shares'])==0){
            echo json_encode([
                'status'=>'danger',
                'text'=>"Debe hacer check en al menos una fecha",
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

        if(sizeof($_POST['shares'])>0){

            $operation=insert([
                'fecha_creacion'=>"now()",
                'submitted_at_label'=>"now()",
                'deposit_at_label'=>$_POST['fecha_pago']." 00:00:00",
                'share_type'=>'SecondaryShareOperation',
                'id_persona'=>$_GET['id_person'],
                'total_amount'=>$_POST['monto_total'],
                'total_shares'=>$_POST['total_meses'],
                'monthly_amount_label'=>$_POST['monto_mes'],
                'id_settlement'=>$persona['id_settlement'],
            ],"operations");
        
        
            foreach($_POST['shares'] as $share){

                $id_share=dato(
                    "id",
                    "secondaryshares",
                    "where id_persona=".$_GET['id_person']." and month='".$share."'",
                    0
                );

                if($id_share){

                    update(
                        [
                            // 'month'=>$share,
                            // 'id_persona'=>$_GET['id_person'],
                            'type'=>$_POST['type'],
                            'id_settlement'=>$persona['id_settlement'],
                            'amount'=>$_POST['monto_mes'],
                            'comment'=>$_POST['comentario'],
                            'voucher'=>$_POST['operacion'],
                            'fecha_creacion'=>$_POST['fecha_pago']." 00:00:00",
                            'new_imported'=>'2',
                            'id_group'=>$persona['id_group'],
                            'operation_id'=>$operation['id'],
                            'registered_by'=>$_SESSION['usuario_datos_nombre'],                        
                        ],
                        'secondaryshares',
                        "where id=".$id_share
                    );

                } else {

                    $insert=insert(
                        [
                            'month'=>$share,
                            'type'=>$_POST['type'],
                            'id_persona'=>$_GET['id_person'],
                            'id_settlement'=>$persona['id_settlement'],
                            'amount'=>$_POST['monto_mes'],
                            'comment'=>$_POST['comentario'],
                            'voucher'=>$_POST['operacion'],
                            'fecha_creacion'=>$_POST['fecha_pago']." 00:00:00",
                            'new_imported'=>'2',
                            'id_group'=>$persona['id_group'],
                            'operation_id'=>$operation['id'],
                            'registered_by'=>$_SESSION['usuario_datos_nombre'],
                        ],
                        'secondaryshares',
                        0
                    );

                    // princonsole($insert);

                }

            }

        }

        $text_success="Creación Exitosa";

        $more='<div class="text-right"><button type="button" data-url="modal.php?page=print_operation&id='.$operation['id'].'&mode=print" class="btn btn-primary modal-page print_operation" >Ver operación</button></div>';


    }

    /*
    888888 88 88b 88    db    88     88     Yb  dP
    88__   88 88Yb88   dPYb   88     88      YbdP
    88""   88 88 Y88  dP__Yb  88  .o 88  .o   8P
    88     88 88  Y8 dP""""Yb 88ood8 88ood8  dP
    */

    // UPDATES LAST SHARE IN PEOPLE
    $last_secondary=dato(
        "max(month)",
        "secondaryshares",
        "where id_persona=".$_GET['id_person']." and type in ('Voucher','Voucher2','Imported')");
          
    update(
        [
            // 'last_secondary'=>end($_POST['shares'])
            'last_secondary'=>$last_secondary
        ],
        "people",
        "where id=".$_GET['id_person']
    );

    // UPDATE EVOLUTION TABLES
    update_evolution($_POST['shares'],[1],[$persona['id_settlement']],[$persona['id_group']]);

    // RETURN THE RESPONSE
    echo json_encode([
        'status'=>'success',
        'text'=>$text_success,
        // 'eval'=>'location.reload();',
        // 'eval'=>"ax('paginaUrl','','1','PRIMARY_SHARES','inner_after','&id_persona=".$_GET['id_person']."','sub')",
        'eval'=>"document.querySelector('.nav-link.link-secondaryshares').click();",
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

// LOAD MONTHS INFO
$monthA=[1=>'Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic'];

$class=[
    'Imported'=>'payed',
    'Voucher'=>'payed',
    'Voucher2'=>'payed',
    'Empty'=>'debt',
    'null'=>'empty',
];

$shares['regulares']=[
    'nombre'=>'Resumen de aportaciones CAEE',
    'calendar'=>select_options(
            [
                "month as id",
                "type",
                "amount",
            ]
            ,"secondaryshares"
            ,"where id_persona=".$_GET['id_person'].' order by month asc'
            ,0
    )
];

foreach($shares as $id_share => $share_item){

    $share=$share_item['calendar'];

    $keys=array_keys($share);

    $min=$keys[0];
    $max=end($keys);

    list($minYear,$minMonth)=explode("-",$min);
    list($maxYear,$maxMonth)=explode("-",$max);

    // prin([$minMonth,$maxMonth]);
    // prin([$minYear,$maxYear]);

    // for($yy=$maxYear+1;$yy>=$minYear;$yy--){
    for($yy=$minYear;$yy<=$maxYear+1;$yy++){
            for($mm=1;$mm<=12;$mm++){

            $date=$yy."-". sprintf("%02d",$mm) ."-01 00:00:00";
            $value=$share[$date]['type'];
            $blocks[$id_share]['calendar'][$yy][$monthA[$mm]]=[
                'state'=>$class[($value!='')?$value:'null'],
                'value'=>$date,
                'date'=>fecha_formato($date,"4"),
                'amount'=>$share[$date]['amount']
            ];

        }
    }
    
    $blocks[$id_share]['nombre']=$share_item['nombre'];

}


$person=$persona['nombre'].' '.$persona['apellidos']." (".$persona['code'].")";

$title="Registro de aportaciones CAEE";

$button='Enviar';

$viewFile="view_form_shares";

/*
888888 8888b.  88 888888
88__    8I  Yb 88   88
88""    8I  dY 88   88
888888 8888Y"  88   88
*/
if($_GET['mode']=='edit' and $_GET['id']!=''){
  

    
    $fields['monto_mes']['value']=$document['monto_mes'];
    $fields['type']['value']=$document['type'];
    $fields['operacion']['value']=$document['operacion'];
    $fields['fecha_pago']['value']=fecha_formato($document['fecha_pago'],'11b');
    $fields['comentario']['value']=$document['comentario'];

    unset(
        $fields['monto_total'],
        $fields['total_meses']
    );

    $title="Editar Aportación CAEE ".fecha_formato($document['month'],'4b');

    $button='GUARDAR';

    $viewFile="view_form_general";

}

/*
8888b.  888888 88     888888 888888 888888
 8I  Yb 88__   88     88__     88   88__
 8I  dY 88""   88  .o 88""     88   88""
8888Y"  888888 88ood8 888888   88   888888
*/
if($_GET['mode']=='delete' and $_GET['id']!=''){

    unset(
        $fields['monto_mes'],
        $fields['operacion'],
        $fields['fecha_pago'],
        $fields['comentario'],
        $fields['monto_total'],
        $fields['type'],
        $fields['total_meses']
    );

    $alert=[
        'title'=>'Eliminar',
        'text'=>'¿Desea eliminar aportación CAEE?',
        'class'=>'alert-danger',
    ];

    $title="Eliminar Aportación CAEE ".fecha_formato($document['month'],'4b');

    $button='ELIMINAR';

    $viewFile="view_form_general";

}

/*
88""Yb 888888 Yb    dP 88 .dP"Y8    db    8888b.   dP"Yb
88__dP 88__    Yb  dP  88 `Ybo."   dPYb    8I  Yb dP   Yb
88"Yb  88""     YbdP   88 o.`Y8b  dP__Yb   8I  dY Yb   dP
88  Yb 888888    YP    88 8bodP' dP""""Yb 8888Y"   YbodP
*/
if($_GET['mode']=='revision' and $_GET['id']!=''){

    unset(
        $fields['monto_mes'],
        $fields['operacion'],
        $fields['fecha_pago'],
        $fields['comentario'],
        $fields['monto_total'],
        $fields['type'],
        $fields['total_meses']
    );

    $alert=[
        'title'=>'Revisión',
        'text'=>'¿Desea marcar la aportación como revisada?',
        'class'=>'alert-danger',
    ];

    $title="Revisión Aportación CAEE ".fecha_formato($document['month'],'4b');

    $button='MARCAR COMO REVISADO';

    $viewFile="view_form_general";

}

$fields=processFields($fields);


$maxwidth="100%";