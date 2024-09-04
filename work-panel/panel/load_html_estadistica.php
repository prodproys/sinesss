<?php
@session_start(); // Iniciar variables de sesión
include("lib/compresionInicio.php");
include("lib/global.php");	
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
//	include("lib/stripattributes.php");
include("config/tablas.php");	


//prin($_GET);

	list($_GET['ob'],$ordby,$date,$from,$to)=explode("|",$_GET['b']);

	$OBJ=$datos_tabla=procesar_objeto_tabla($objeto_tabla[$_GET['ob']]);

	//parse_str($_GET['filtro'], $get);
	
	//prin($OBJ);
	$first=dato('min('.$date.')',$OBJ['tabla'],"where ".$date."!=0",0);
	$first=(!$first)?date("Y-m-d"):$first;
	$first=substr($first,0,10);
	//$last =dato($querie['campo'],$tbl,"where 1 order by ".$querie['campo']." desc limit 0,1");
	$last=dato('max('.$date.')',$OBJ['tabla'],"where ".$date."!=0",0);
	$last=(!$last)?date("Y-m-d"):$last;	
	$last=substr($last,0,10);
	
	//prin("$first - $last");

	$from=($from)?$from:$first;
	$to=($to)?$to:$last;
	
	$from=fixyfecha($from);
	$to=fixyfecha($to);
	
	
					
	if($date!=''){
	$where="where visibilidad!=0 and date($date) between '$from' and '$to'";	
	} else {
	$where="where visibilidad!=0 ";
	}
	
	if($ordby==''){
	
	//prin("$from,$to");
	//exit();
	$bisi = (substr($to,0,4)%4==0)?1:0;
	//echo "1";
	$rango=Difer2($from,$to);

	$fromY=substr($from,0,4);
	$toY=substr($to,0,4);

	$fromM=substr($from,5,2);
	$toM=substr($to,5,2);
	
	if($rango<=30){
	$op=array('D'); //1o2
	} elseif($rango>30 and $rango<=90){
	$op=array('D','M'); //2,3,4
	} elseif($rango>90 and ( ($rango<=366 and $bisi=1) or ($rango<=365 and $bisi=0) ) ){
	$op=array('M','D'); //2,3,4	
	} elseif($rango>365){
	$op=array('A','M'); //2,3,4	
	}
	
	$tipo=$op['0'];
	//prin($tipo);
	$intervalos=crear_intervalos($tipo,$from,$to);
	
	$VV=array();
	$data = array();
	
	foreach($intervalos as $vv){
	
		$VVV['i']=$vv;
		
		if($tipo=='D'){
			$data[]=$VVV['v']=contar($datos_tabla['tabla'],"where visibilidad!=0 and date($date)='$vv'",0)*1;
		} else {
			$data[]=$VVV['v']=contar($datos_tabla['tabla'],"where visibilidad!=0 and date($date) between '".str_replace("|","' and '",$vv)."'")*1;
		}
		
		if($tipo=='D'){
			if($fromM==$toM){
			$LLL[]=$VVV['n']=substr($vv,8,2);
			} else {
			$LLL[]=$VVV['n']=substr($vv,8,2)." ".substr($Array_Meses[substr($vv,5,2)*1],0,3);
			}		
		}elseif($tipo=='M'){
			if($fromY==$toY){
			$LLL[]=$VVV['n']=substr($Array_Meses[substr($vv,5,2)*1],0,3);
			} else {
			$LLL[]=$VVV['n']=substr($Array_Meses[substr($vv,5,2)*1],0,3)." ".substr($vv,0,4);			
			}
		}elseif($tipo=='A'){
			$LLL[]=$VVV['n']=substr($vv,0,4);
		}
		$VV[]=$VVV; unset($VVV);
	
	}


	$HEIGHT = (1.1)*max($data);
	$HEIGHT = ($HEIGHT==0)?10:$HEIGHT;
	$STEP = ceil($HEIGHT/10);
	
	//prin($VV);




	
	$ht='<table class=reporte>';
	foreach($VV as $item){
	$ht.='<tr>';
	$ht.='<td class=nombre>';
	$ht.=$item['n'];
	$ht.='</td>';
	$ht.='<td class=valor>';
	$ht.=$item['v'];
	$ht.='</td>';
	$ht.='</tr>';	
	}
	$ht.='</table>';
	echo $ht;
	


	
	} else {


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


include("lib/compresionFinal.php");	/*para Content-Encoding*/ 
?>