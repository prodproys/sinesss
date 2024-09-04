<?php //á
$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

//include("lib/compresionInicio.php");
include("lib/global.php");
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
include("config/tablas.php");
include("lib/sesion.php");
include("lib/playmemory.php");


$obj['obj']=$_GET['me'];
$OBJ=$datos_tabla=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

$CamposPermitidos=explode(",",$_GET['campos']);

$_GET['w']=($_GET['w'])?$_GET['w']:"where visibilidad=1";

foreach($datos_tabla['list'] as $lis){
	if(
			in_array($lis['tipo'],array('inp'))
			and
			(
					($_GET['campos'] and in_array($lis['campo'],$CamposPermitidos))
					or
					(!$_GET['campos'])
			)
	)
	{
		$campS[]=$lis['campo'];
	}
}

$items=select($campS,
		$datos_tabla['tabla'],
		$_GET['w'],0);
	
foreach($items as $item){
	$line=implode(",",$item);
	if(trim($line)!=''){
		$lineas[]=implode(",",$item);
	}
}

$_GET['ext']=($_GET['ext'])?$_GET['ext']:'csv';
switch($_GET['ext']){
	case 'txt':	header("Content-type: plain/text"); break;
	case 'csv':	header("Content-type: application application/csv"); break;
}
header('Content-Disposition: attachment;filename="'.trim(strtolower(strip_tags($OBJ['titulo']))).'.'.$_GET['ext'].'"');
header('Cache-Control: max-age=0');
header ("Pragma: no-cache");
echo implode("
		",$lineas);
exit();
//include("lib/compresionFin.php");
?>