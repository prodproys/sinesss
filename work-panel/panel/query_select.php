<?php //á
set_time_limit(0);
//error_reporting(E_ALL);
include("lib/compresionInicio.php");
include("lib/includes.php");

$lineas=array();
switch($_GET['r']){
case "select":	
	$items=select($_GET['c'],$_GET['t'],$_GET['w'],0);
	foreach($items as $item){
		foreach($item as $dato){ 
			$data[]=$dato; 
		} 
		$lineas[]=$data; unset($data);
	}
	$json = json_encode(array('s'=>$lineas));
break;
case "fila":	
	$item=select_fila($_GET['c'],$_GET['t'],$_GET['w'],0);
	foreach($item as $dato){ 
		$data[]=$dato; 
	} 
	$json = json_encode(array('f'=>$data));
break;
case "dato":	
	$dato=select_dato($_GET['c'],$_GET['t'],$_GET['w'],0);
	$json = json_encode(array('d'=>$dato));
break;
}
echo $json;
include("lib/compresionFinal.php");
?>