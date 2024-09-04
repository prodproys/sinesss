<?php
/**
**** 
* Archivo: controller_deducciones.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción: Este archivo es el controller backend de la sección "deducciones regulares" del item "reportes" en el módulo de "personas" del menú
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
// $settlements=opciones(["nombre","id",],"settlements","where id in (24)"); //rebagliati
// $settlements=opciones(["nombre","id",],"settlements","where id in (2)"); //sabogal


// prin($settlements);

$settlements_keys=array_keys($settlements);

// $settlements_keys=[12];
// $settlements_keys=array_slice($settlements_keys,0,3);


// prin($settlements_keys);

foreach($settlements_keys as $id_settlement){
    
    // prin($settlements[$id_settlement]);

    if(0){

        $aporta['id_settlement']=$id_settlement;

        $aporta['evolucion']=select(
            "id,total,is_caee,month",
            "people_evolution_group",
            "where 1
            and id_settlement=".$id_settlement." "
            .str_replace("primaryshares","people_evolution",$busqueda_query)
            .""
            ,0
        );

    }

    $aporta['primaryshares_cn']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "primaryshares",
        "where 1 "
        ." and type!='Empty' "
        ." and (id_group='cn') "
        ." and id_settlement=".$id_settlement." "
        .$busqueda_query 
        .""
        ,0
    );

    $aporta['primaryshares_cas']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "primaryshares",
        "where 1 "
        ." and type!='Empty' "
        ." and (id_group='cas') "
        ." and id_settlement=".$id_settlement." "
        .$busqueda_query 
        .""
        ,0
    );    
    
    $aporta['primaryshares']=fila(
        [
            "sum(amount) as total",
            "count(amount) as aportantes"
        ],
        "primaryshares",
        "where 1 "
        ." and type!='Empty' "
        // ." and (id_group='cn' or id_group='cas') "   
        // " and (type='Imported' or type='Voucher' or type='Voucher2') ".
        ." and id_settlement=".$id_settlement." "
        .$busqueda_query 
        .""
        ,0
    );


    // prin($aporta);



    // $aporta['total']['total']=$aporta['primaryshares']['total'];

    // $aporta['total']['aportantes']=$aporta['primaryshares']['aportantes'];



    // $failes[$id_settlement]=$fail;

    $aportaciones[$id_settlement]=$aporta;


}

// prinx($aportaciones);

foreach($aportaciones as $id_settlement=>$aporta){

    $line=[];

    $line['id_settlement']=['text'=>$settlements[$id_settlement],'url'=>'custom/settlements.php?i='.$id_settlement];

    $match=$matches[$id_settlement]=( $aporta['primaryshares']['aportantes']==$aporta['primaryshares_cn']['aportantes']+$aporta['primaryshares_cas']['aportantes'] );

    if($match){

        $line['regularcn_aportantes']=['text'=>$aporta['primaryshares_cn']['aportantes']];
        $line['regularcn_total']=['text'=>numero($aporta['primaryshares_cn']['total'])];
            
        $line['regularcas_aportantes']=['text'=>$aporta['primaryshares_cas']['aportantes']];
        $line['regularcas_total']=['text'=>numero($aporta['primaryshares_cas']['total'])];

    } else {

        $noinfo='sin datos';

        $line['regularcn_aportantes']=['text'=>$noinfo];
        $line['regularcn_total']=['text'=>$noinfo];
            
        $line['regularcas_aportantes']=['text'=>$noinfo];
        $line['regularcas_total']=['text'=>$noinfo];

    }

    $line['regular_aportantes']=['text'=>$aporta['primaryshares']['aportantes']];

    $line['regular_total']=['text'=>numero($aporta['primaryshares']['total'])];

    // ];



    $line['deduccion']['text']=numero($aporta['primaryshares']['total']/2,3);

    $suma_regularcn_aportantes += $aporta['primaryshares_cn']['aportantes'];
    $suma_regularcn_total += $aporta['primaryshares_cn']['total'];

    $suma_regularcas_aportantes += $aporta['primaryshares_cas']['aportantes'];
    $suma_regularcas_total += $aporta['primaryshares_cas']['total'];    

    $suma_regular_aportantes += $aporta['primaryshares']['aportantes'];
    $suma_regular_total += $aporta['primaryshares']['total'];
    // $suma_caee_total    += $aporta['secondaryshares']['total'];
    $suma_total_total   += $aporta['primaryshares']['total'];
    $suma_deduccion     += $aporta['primaryshares']['total']/2;

    $reports[]=$line;

}

// $match0=1; foreach($matches as $match){ $match0=$match0*$match; } prin($match0);
// prin($matches);
if(0)
foreach($matches as $id_settlement=>$match){
    
    if(!$match){
        $pays=select(
            'id,amount,id_group,type,id_persona,month',
            "primaryshares",
            "where 1 "
            ." and id_settlement=".$id_settlement." "
            .$busqueda_query 
            .""
            ,0
        );
        foreach($pays as $idp=>$pay){
            if($pays[$idp]['id_group']=='')
                $pays[$idp]['id_group']='null';
        }
        prin($pays);
    }
}

// prin($failes);



$headers[]=[
    'id_settlement'=>[
        'text'=>'Bases',
        'rowspan'=>'2'
    ],
    'regularcn_aportantes'=>[
        'text'=>'Nombrados/Contratados',
        'colspan'=>'2'
    ],
    'regularcas_aportantes'=>[
        'text'=>'CAS',
        'colspan'=>'2'
    ],    
    'regular_aportantes'=>[
        'text'=>'Total General',
        'colspan'=>'2'
    ],
    /*
    'caee_aportantes'=>[
        'text'=>'CAEE',
        'colspan'=>'2'
    ],   
    'total_aportantes'=>[
        'text'=>'Total General',
        'colspan'=>'2'
    ],
    */    
    'deduccion'=>[
        'text'=>'Monto a Transferir por Base',
        'rowspan'=>'2'
    ],     
];

$headers[]=[
    'regularcn_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'regularcn_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],  

    'regularcas_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'regularcas_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],      

    'regular_aportantes'=>[
        'text'=>'Agremiadas',
        'listable'=>'1',
    ],
    'regular_total'=>[
        'text'=>'Total Aportaciones',
        'listable'=>'1',
    ],   

];


$footers[]=[
        
    'id_settlement'=>['text'=>'TOTALES'],

    'regularcn_aportantes'=>['text'=>$suma_regularcn_aportantes],
    'regularcn_total'=>['text'=>numero($suma_regularcn_total)],

    'regularcas_aportantes'=>['text'=>$suma_regularcas_aportantes],
    'regularcas_total'=>['text'=>numero($suma_regularcas_total)],    

    'regular_aportantes'=>['text'=>$suma_regular_aportantes],
    'regular_total'=>['text'=>numero($suma_regular_total)],
    /*
    'caee_aportantes'=>'',
    'caee_total'=>['text'=>number_format($suma_caee_total,2,'.','')],
    
    'total_aportantes'=>'',
    'total_total'=>['text'=>number_format($suma_total_total,2,'.','')],
    */
    'deduccion'=>['text'=>numero($suma_deduccion)],

];

$labels=[
    'id_settlement'=>[
        'campo'=>'id_settlement',
        'label'=>'Base',
        'listable'=>'1',
    ],
    'regularcn_aportantes'=>[
        'campo'=>'regularcn_aportantes',
        'label'=>'Nombrados/Contrados',
        'listable'=>'1',
    ],
    'regularcas_aportantes'=>[
        'campo'=>'regularcas_aportantes',
        'label'=>'CAS',
        'listable'=>'1',
    ],    
    'regular_aportantes'=>[
        'campo'=>'regular_aportantes',
        'label'=>'Total Regulares',
        'listable'=>'1',
    ],
    'regular_total'=>[
        'campo'=>'regular_total',
        'label'=>'Total',
        'listable'=>'1',
    ],   

    'deduccion'=>[
        'campo'=>'deduccion',
        'label'=>'Monto a Transferir',
        'listable'=>'1',
    ],     
];


$foots=[
    'TOTALES',
    '',
    $footers[0]['regularcn_total']['text'],
    '',
    $footers[0]['regularcas_total']['text'],    
    '',
    $footers[0]['regular_total']['text'],
    '',
    $footers[0]['caee_total']['text'],
    '',
    $footers[0]['total_total']['text'],
    $footers[0]['deduccion']['text'],            
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
