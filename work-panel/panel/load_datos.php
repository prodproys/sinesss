<?php //á
set_time_limit(0);
//error_reporting(E_ALL);
include("lib/compresionInicio.php");
include("lib/includes.php");

//print_r($_GET);

$sss=explode("|",$_GET['s']);

$lineas=array();
$where=str_replace("==","=",$sss['2']);
$where=str_replace("where","",$where);
$claus=explode("and",$where);
foreach($claus as $clau){
if(enhay($clau,"=")){
list($aa,$bb)=explode("=",$clau);
if(trim($bb)!=''){ $Clau[]=$clau; }
} else {
$Clau[]=$clau;
}
}
$Claus=implode(" and ",$Clau);
$where="where ".((trim($Claus)!='')?$Claus:"1");
$items=fila($sss['0'],$sss['1'],$where,0);
//prin($items);
/*
foreach($items as $item){
foreach($item as $dato){ $data[]=$dato; } 
$lineas[$data['0']]=$data; unset($data);
}
foreach($lineas as $linea){
$lineas0[]=$linea;
}
$lineas=$lineas0;
$lineas=(sizeof($lineas)==0)?array():$lineas;
*/
echo json_encode($items);



/*
$lineas=select(
			"productos_items.id as id,productos_items.nombre as nombre",
			"productos_items,productos_items_items",
			"where productos_items_items.id_item=productos_items.id",
			1);
prin($lineas);
*/
	
include("lib/compresionFinal.php");
?>