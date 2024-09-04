<?php
/**
**** 
* Archivo: controller_totales.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de las secciones "aportaciones regulares", "aportaciones caee" y "otros pagoss" de la pagina de detalle de una persona
**** 
*/




// prin($_GET);
// prin($filtros123);

parse_str($_GET['filter'],$output);

$id_zone='';
$id_settlement='';
foreach($output[$datos_tabla['tabla']] as $out){
    if(enhay($out,"id_settlement")){
        $id_settlement=str_replace($datos_tabla['tabla'].".id_settlement=","",$out);
    }
}

if($id_settlement!='')
$id_zone=dato("id_zone","settlements","where id=".$id_settlement,0);

// prin($html_filter_A);

// prin($terfil);
// prin($html_filter_fecha_A);

// prin(""
//     . "$EXTRA_FILTRO "
//     . $datos_tabla['where_id']
// 	. "\n $extra_where"
// );
$datos_tabla['get_id'] = '&middlewarelist=totales';
// $datos_tabla['where_id'] = '';
// prin($datos_tabla);
unset($html_filter_A['type']);

$objeto_tabla[$_GET['OB']]['campos']['type']['queries']='0';

// $objeto_tabla_comp['PRIMARY_SHARES']['campos']['id_persona']['label']='Reporte';
$tblistado=$datos_tabla['list']=[
    [
        'label'=>'Red',
        'campo'=>'zone',
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'150px'
    ],
    [
        'label'=>'Base',
        'campo'=>'settlement',
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'150px'
    ],
    [
        'label'=>'Aportantes',
        'campo'=>'aportantes1',
        'tipo'=>'inp',
        'listable'=>'1'
    ],
    [
        'label'=>'Monto descuento directo',
        'campo'=>'monto1',
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'200px'
    ],

    [
        'label'=>'Aportantes',
        'campo'=>'aportantes2',
        'tipo'=>'inp',
        'listable'=>'1'
    ],
    [
        'label'=>'Monto Depositos',
        'campo'=>'monto2',
        'tipo'=>'inp',
        'listable'=>'1',
        'width'=>'200px'
    ],    

];

$oo=0;


$entes=select([
        'id',
        'nombre'
    ],
    'zones',
    'where 1 '
    .( ($id_zone)?'and id='.$id_zone:'' )
    .' order by id asc'
    ,0
);

// exit();
// $entes=array_slice($entes,1);

foreach($entes as $ii=> $ente){

    $entes[$ii]['bases']=select([
            'id',
            'nombre'
        ],
        'settlements',
        'where id_zone='.$ente['id'].' '
        .( ($id_settlement!='')?'and id='.$id_settlement:'' )
        .' order by nombre asc',
         0
    );

}
foreach($entes as $ii=> $ente){
    foreach($ente['bases'] as $iii=> $base){
        if(0)
        $entes[$ii]['bases'][$iii]['shares']=select([
                'count(*) as aportantes',
                'sum(amount) as total'
            ],
            $datos_tabla['tabla'],
            "where id_settlement=".$base['id']." 
            and type='Imported' ",
            0
        );
    }
}

// prin($entes);

$parte1=select(
    [
        'settlements.id as id_settlement',
        'count(*) as aportantes',
        'sum('.$datos_tabla['tabla'].'.amount) as monto',
    ],
    $datos_tabla['tabla'],
    "
    right join settlements on settlements.id=".$datos_tabla['tabla'].".id_settlement
    left join zones on zones.id=settlements.id_zone
    where 1 "
    
    . "$EXTRA_FILTRO $busqueda_query "
    . $datos_tabla['where_id']
    . "\n $extra_where"    
    
    ." and type='Imported' "
    ." group by settlements.id
    order by zones.id asc, aportantes desc
    ",
    0,
    ['index'=>'id_settlement']
);

$parte2=select(
    [
        'settlements.id as id_settlement',
        'count(*) as aportantes',
        'sum('.$datos_tabla['tabla'].'.amount) as monto',
    ],
    $datos_tabla['tabla'],
    "
    right join settlements on settlements.id=".$datos_tabla['tabla'].".id_settlement
    left join zones on zones.id=settlements.id_zone
    where 1 "
    
    . "$EXTRA_FILTRO $busqueda_query "
    . $datos_tabla['where_id']
    . "\n $extra_where"    

    ." and type in ('Voucher','Voucher2')
    group by settlements.id
    order by zones.id asc, aportantes desc
    ",
    0,
    ['index'=>'id_settlement']
);
foreach($entes as $ente){
    foreach($ente['bases'] as $base){

        $filas[]=[
            'zone'=>$ente['nombre'],
            'settlement'=>$base['nombre'],
            'aportantes1'=>($parte1[$base['id']]['aportantes'])?$parte1[$base['id']]['aportantes']:'0',
            'monto1'=>number_format( $parte1[$base['id']]['monto'], 2, '.', ''),
            'aportantes2'=>($parte2[$base['id']]['aportantes'])?$parte2[$base['id']]['aportantes']:'0',
            'monto2'=>number_format( $parte2[$base['id']]['monto'], 2, '.', '')          
        ];
    }
}
// prin($filas);
$items=$pagina_items['filas']=$filas;



$pagina_items['total']=sizeof($items);


$modulo_excel_modified='Reporte de '.$objeto_tabla[$_GET['OB']]['titulo'].' por Bases';