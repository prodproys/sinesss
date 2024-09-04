<?php
if($_GET['ajax']!='0'){
	@session_start(); // Iniciar variables de sesión
	include("lib/global.php");
	include("lib/conexion.php");
	include("lib/mysql3.php");
	include("lib/util2.php");
	//	include("lib/stripattributes.php");
	include("config/tablas.php");
	include("lib/reports.php");
}
	//echo getcwd();


	list($file,$type)=explode('_ol',$_GET['file']);

	if($type=='d'){

		$_GET['file']=$file;
		

		foreach($_GET as $get=>$val){
			if(in_array($get,array('file','seccion','format'))){
				$gett[$get]=$val;
			} else {
				$gett['f']=$get."|".$val;
			}
		}

		// prin($_GET);
		$gett['fecha_creacion']=$_GET['fecha_creacion'];

		$_GET=$gett;

	}


	//echo getcwd()."<br>";

	include($PATH_CUSTOM."base2/reportes/".$_GET['file'].".php");

	function exclude_from_array($output,$items=[])
	{
		foreach($items as $item){
			unset($output[$item]);
		}
		return urldecode(http_build_query($output));
	}
	//echo 3;
	/*
	if(0){


	if($date!=''){
		$where="where visibilidad!=0 and date($date) between '$from' and '$to'";
	} else {
		$where="where visibilidad!=0 ";
	}

	$query_where=$where. "group by ".$ordby.' order by total desc' ;

	$items=select("$ordby as nombre, count(*) as total",
					$datos_tabla['tabla'],
					$query_where,0);

	$Total=contar($datos_tabla['tabla'],
					$where,0);
	//prin($items);

	foreach($items as $lll=>$linea){

			switch($objeto_tabla[$_GET['ob']]['campos'][$ordby]['tipo']){
			case "com":
				$valoor=$objeto_tabla[$_GET['ob']]['campos'][$ordby]['opciones'][$linea['nombre']];
				$items[$lll]['nombre']=$valoor;
			break;
			case "hid":
				list($primO,$tablaO)=explode("|",$objeto_tabla[$_GET['ob']]['campos'][$ordby]['opciones']);
				list($idO,$camposO)=explode(",",$primO);
				$camposOA=array();
				$camposOA=explode(";",$camposO);
				$bufy='';
				foreach($camposOA as $COA){
				$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$linea['nombre']."'")." ";
				}
				$items[$lll]['nombre']=$bufy;
			break;

			}

	}

	$ht='<table class=reporte>';
	foreach($items as $item){
	$ht.='<tr>';
	$ht.='<td class=nombre>';
	$ht.=$item['nombre'];
	$ht.='</td>';
	$ht.='<td class=valor>';
	$ht.=$item['total'];
	$ht.='</td>';
	$ht.='<td class=porcentaje>';
	$ht.=intval(($item['total']/$Total)*10000)/100;
	$ht.='%';
	$ht.='</td>';
	$ht.='</tr>';
	}
	$ht.='</table>';
	echo $ht;

}
*/


