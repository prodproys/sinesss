<?php

//include("lib/includes.php");
include("lib/global.php");
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
include("config/tablas.php");
include("lib/sesion.php");
include("lib/playmemory.php");

require_once( "lib/ini_manager.php" );

require_once 'lib/PHPExcel.php';

//echo realpath("./");

//prin($_GET);exit();

$obj['obj']=$_GET['me'];
$OBJ=$datos_tabla=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

// prin($datos_tabla['list']);
$datos_tabla['list']=array(
		array(
				'campo' => 'id_cliente',
				'label' => 'Cliente',
				'listable' => '1',
				'foreig' => '1',
				'default' => 'id_cliente',
				'tipo' => 'hid',
				'opciones' => 'id,id|clientes||id;nombre;apellidos;genero;email;tipo_cliente'
		)
);


// exit();

foreach($datos_tabla['list'] as $lis){
	if(
			(in_array($lis['tipo'],array('inp','hid','fch','fcr','com')) and
					//(in_array($lis['tipo'],array('inp','hid','fch','fcr')) and
					//($lis['campo']!=$datos_tabla['foreig']) and
					//($lis['listable']=='1') and
					(!enhay($lis['label'],'descripci',1)) and
					(!enhay($lis['label'],'source',1)) and
					(!enhay($lis['label'],'url',1)) and
					//($lis['campo']!='id_grupo') and
					//($lis['campo']!='id_subgrupo') and
					1
			)
	)
	{
		$campS[]=$lis['campo'];
		if($lis['opciones']!=''){
			$liss=explode("|",$lis['opciones']); if($liss['3']!=''){
				$lisss=explode(";",$liss['3']); $lisss2=explode(",",$liss['0']);
				foreach($lisss as $sssil){
					$campS[]="(SELECT $sssil FROM ".$liss['1']." WHERE ".$liss['1'].".".$lisss2['0']."=".$lis['campo'].") AS $sssil
					";
					$objeto_tabla[$obj['obj']]['campos'][$sssil]=array('campo'=>$sssil,'label'=>$sssil,'tipo'=>'inp',);
				}
			}
		}
	}
}


$campS2=$campS;

//$campS2=array_merge(array($datos_tabla['id']),$campS2,array($campTitu));
if(!in_array($datos_tabla['fcr'],$campS2)){
	$campS2=array_merge(array($datos_tabla['fcr']),$campS2);
}

	

foreach($campS2 as $ccc=>$cccc){

	//$campos[]=$lis['campo'];
	$labels[]=strtoupper($objeto_tabla[$_GET['me']]['campos'][$cccc]['label']);

}

// prin($labels);
// exit();	
//$where="where ".$datos_tabla['foreig']."='".$id."' ";//anterior where
//$parte=between($obj['ltext'],"where","}");
	
prin($_GET['filter']);	

$qqff=query_filter($_GET['filter']);

prin($qqff);

if($_GET['filter']!=''){
	$where="where 1 and ( ".query_filter($_GET['filter'])." ) ";
} else {
	$where="where 1 ";
}
	
$query_where=$where
."order by ". ( ($datos_tabla['order_by']=='')? (  $datos_tabla['id']." ". (($datos_tabla['orden']=='1')?"desc":"asc") ):$datos_tabla['order_by'] )." "
		."limit 0,10000";
$items=select($campS2,
		$datos_tabla['tabla'],
		$query_where,1);
	
//prin($campS2);
	
//exit();
//prin($items);
//prin($campS);
	
$items2=$items;

foreach($items as $lll=>$linea){

	foreach($campS as $camP){

		switch($objeto_tabla[$obj['obj']]['campos'][$camP]['tipo']){
			case "com":
				$valoor=$objeto_tabla[$obj['obj']]['campos'][$camP]['opciones'][$linea[$camP]];
				//$valoor=($valoor!='')?$valoor:"&nbsp;";

				$items2[$lll][$camP]=$valoor;
				break;
			case "hid":
				list($primO,$tablaO)=explode("|",$objeto_tabla[$obj['obj']]['campos'][$camP]['opciones']);
				list($idO,$camposO)=explode(",",$primO);
				$camposOA=array();
				$camposOA=explode(";",$camposO);
				$bufy='';
				foreach($camposOA as $COA){
					$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$linea[$camP]."'")." ";
				}
				$items2[$lll][$camP]=$bufy;
				break;
			case "fcr":	case "fch":
				$fech=str_replace('-','/',fecha_formato($linea[$camP],'11'));
				$items2[$lll][$camP]=$fech;
				break;
		}
	}
}
$items=$items2;

//prin($items);;

foreach($items as $item){
	
	$TITULO=($item['tipo_cliente']=='2')?'Sres.':(($item['genero']=='1')?'Sr.':'Sra.');

	if(trim($item['email'])!='' and trim($item['id'])!=''){
		$items3[$item['id']]=trim($item['nombre']).",".trim($item['apellidos']).",".trim($TITULO).",".trim($item['email']);
	}

}


header("Content-type: plain/text");
header('Content-Disposition: attachment;filename="exportar_group_mail.txt"');
header('Cache-Control: max-age=0');
header ("Pragma: no-cache");
echo implode("
",$items3);
exit();

function num2alpha($n)
{
	for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
		$r = chr($n%26 + 0x41) . $r;
	return $r;
}
function getrango($n){
	$i=0;
	foreach($n as $b=>$c){
		if($i==0){
			$uno=$b;
		}
		if($i==sizeof($n)-1){
			$dos=$b;
		}
		$i++;
	}
	return $uno.":".$dos;
}

