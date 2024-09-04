<?php
/**
**** 
* Archivo: controller_deducciones_caee.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "deducciones caee" del item "reportes" en el módulo de "personas" del menú
**** 
*/



function numero($number,$decimales=2){
    global $_GET;
    if($_GET['format']=='excel')
        return number_format($number,$decimales,'.','');
    else
        return number_format($number,$decimales,'.',',');
}

unset($html_filter_A['type']);


if(1)
if($_GET['filter']==''){

    $_GET['filter']="primaryshares[]=month|2020-01-01|2020-01-01&";
    $monthh='2015-01-01 00:00:00';
    $monthh='2018-01-01 00:00:00';
    $busqueda_query=" and (  primaryshares.month between '$monthh' and '$monthh'  )  
    ";
    // $busqueda_query=" ";

}


$settlements=opciones(["nombre","id",],"settlements");
// prin($settlements);

$settlements_keys=array_keys($settlements);


// $settlements_keys=array_slice($settlements_keys,0,3);


// prin($settlements_keys);

foreach($settlements_keys as $id_settlement){
    
    // prin($settlements[$id_settlement]);

    if(0){

        $aporta['id_settlement']=$id_settlement;

        $aporta['evolucion']=select(
            "id,total,is_caee,month",
            "people_evolution",
            "where 1
            and id_settlement=".$id_settlement." "
            .str_replace("primaryshares","people_evolution",$busqueda_query)
            .""
            ,0
        );

    }

    $aporta['secondaryshares_cn']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "secondaryshares",
        "where 1 ".
        " and type!='Empty' ".
        " and (id_group='cn') ".
        " and id_settlement=".$id_settlement." "
        .str_replace("primaryshares","secondaryshares",$busqueda_query)
        .""
        ,0
    );

    $aporta['secondaryshares_cas']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "secondaryshares",
        "where 1 ".
        " and type!='Empty' ".
        " and (id_group='cas') ".
        " and id_settlement=".$id_settlement." "
        .str_replace("primaryshares","secondaryshares",$busqueda_query)
        .""
        ,0
    );    

    $aporta['secondaryshares']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "secondaryshares",
        "where 1 ".
        " and type!='Empty' ".
        // " and (type='Imported' or type='Voucher' or type='Voucher2') ".
        " and id_settlement=".$id_settlement." "
        .str_replace("primaryshares","secondaryshares",$busqueda_query)
        .""
        ,0
    );




    $aportaciones[$id_settlement]=$aporta;


}



foreach($aportaciones as $id_settlement=>$aporta){

    $line=[];

    $line['id_settlement']=['text'=>$settlements[$id_settlement],'url'=>'custom/settlements.php?i='.$id_settlement];

    $match=$matches[$id_settlement]=( $aporta['secondaryshares']['aportantes']==$aporta['secondaryshares_cn']['aportantes']+$aporta['secondaryshares_cas']['aportantes'] );

    if($match){

        $line['caeecn_aportantes']=['text'=>$aporta['secondaryshares_cn']['aportantes']];
        $line['caeecn_total']=['text'=>numero($aporta['secondaryshares_cn']['total'])];
            
        $line['caeecas_aportantes']=['text'=>$aporta['secondaryshares_cas']['aportantes']];
        $line['caeecas_total']=['text'=>numero($aporta['secondaryshares_cas']['total'])];

    } else {

        $noinfo='sin datos';

        $line['caeecn_aportantes']=['text'=>$noinfo];
        $line['caeecn_total']=['text'=>$noinfo];
            
        $line['caeecas_aportantes']=['text'=>$noinfo];
        $line['caeecas_total']=['text'=>$noinfo];

    }

    $line['caee_aportantes']=['text'=>$aporta['secondaryshares']['aportantes']];

    $line['caee_total']=['text'=>numero($aporta['secondaryshares']['total'])];


    $suma_caeecn_aportantes += $aporta['secondaryshares_cn']['aportantes'];
    $suma_caeecn_total    += $aporta['secondaryshares_cn']['total'];
    
    $suma_caeecas_aportantes += $aporta['secondaryshares_cas']['aportantes'];
    $suma_caeecas_total    += $aporta['secondaryshares_cas']['total'];    

    $suma_caee_aportantes += $aporta['secondaryshares']['aportantes'];
    $suma_caee_total    += $aporta['secondaryshares']['total'];

    // $suma_total_total   += $aporta['total']['total'];
    // $suma_deduccion     += $aporta['total']['total']/2;

    $reports[]=$line;

}



// prin($failes);

if(0){

    foreach($failes as $id_set=>$faili){
        if($faili['pri']){
            $notions['pri'][]=[
                'set'=>$settlements[$id_set],
                'id'=>$id_set,
                'caso'=>$aportaciones[$id_set]
            ];
        }

        if($faili['sec']){
            $notions['sec'][]=[
                'set'=>$settlements[$id_set],
                'id'=>$id_set,
                'caso'=>$aportaciones[$id_set]
            ];
        }    
    }

    prin($notions['pri']);

    prin($notions['sec']);

}

$headers[]=[
    'id_settlement'=>[
        'text'=>'Bases',
        'rowspan'=>'2'
    ],
    'caeecn_aportantes'=>[
        'text'=>'Nombrados/Contratados',
        'colspan'=>'2'
    ],
    'caeecas_aportantes'=>[
        'text'=>'CAS',
        'colspan'=>'2'
    ],
    'caee_aportantes'=>[
        'text'=>'CAEE',
        'colspan'=>'2'
    ],        
    /*   
    'total_aportantes'=>[
        'text'=>'Total General',
        'colspan'=>'2'
    ],    
    'deduccion'=>[
        'text'=>'Monto a Transferir por Base',
        'rowspan'=>'2'
    ],  
    */   
];

$headers[]=[
    'caeercn_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'caeercn_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],  

    'caeecas_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'caeecas_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],  
    'caee_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'caee_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],  

];


$footers[]=[
        
    'id_settlement'=>['text'=>'TOTALES'],

    'caeecn_aportantes'=>['text'=>$suma_caeecn_aportantes],
    'caeecn_total'=>['text'=>numero($suma_caeecn_total)],

    'caeecas_aportantes'=>['text'=>$suma_caeecas_aportantes],
    'caeecas_total'=>['text'=>numero($suma_caeecas_total)],    

    'caee_aportantes'=>['text'=>$suma_caee_aportantes],
    'caee_total'=>['text'=>numero($suma_caee_total)],

];

$labels=[
    'id_settlement'=>[
        'campo'=>'id_settlement',
        'label'=>'Base',
        'listable'=>'1',
    ],
    'caeecn_aportantes'=>[
        'campo'=>'caeecn_aportantes',
        'label'=>'Aportaciones CAEE',
        'listable'=>'1',
    ],
    'caeecn_total'=>[
        'campo'=>'caeecn_total',
        'label'=>'Total',
        'listable'=>'1',
    ], 
    'caeecas_aportantes'=>[
        'campo'=>'caeecas_aportantes',
        'label'=>'Aportaciones CAEE',
        'listable'=>'1',
    ],
    'caeecas_total'=>[
        'campo'=>'caeecas_total',
        'label'=>'Total',
        'listable'=>'1',
    ],      
    'caee_aportantes'=>[
        'campo'=>'caee_aportantes',
        'label'=>'Aportaciones CAEE',
        'listable'=>'1',
    ],
    'caee_total'=>[
        'campo'=>'caee_total',
        'label'=>'Total',
        'listable'=>'1',
    ],    
   
];


$foots=[
    'TOTALES',
    '',
    $footers[0]['caeecn_total']['text'],
    '',
    $footers[0]['caeecas_total']['text'],    
    '',
    $footers[0]['caee_total']['text'],
];


$tabla_class='tabla_standard';

$tblistado=$datos_tabla['list']=$labels;

// $reports[]=$footers[0];

$items=$pagina_items['filas']=$reports;
// prin($items);

$pagina_items['total']=sizeof($items);

$datos_tabla['include_list']="view_table_list.php";

unset($html_filter_A['id_settlement']);

$objeto_tabla['PEOPLE']['titulo']="Deducciones";

$controls=[
    "<a class='btn-print' onclick='window.print();return false;' data-url='' >Imprimir</a>",
    "<a class='btn-excel' onclick=\"ax('excel','','','PEOPLE','&middlewarelist=".$_GET['middlewarelist']."','');return false;\" >Exportar Excel</a>",
];
