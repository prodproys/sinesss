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
	//prin($VV);exit();
	
	
	/*$t = new tooltip( 'Hello<br>val = #val#' );
$t->set_shadow( false );
$t->set_stroke( 5 );
$t->set_colour( "#6E604F" );
$t->set_background_colour( "#BDB396" );
$t->set_title_style( "{font-size: 14px; color: #CC2A43;}" );
$t->set_body_style( "{font-size: 10px; font-weight: bold; color: #000000;}" );*/

	$HEIGHT = (1.1)*max($data);
	$HEIGHT = ($HEIGHT==0)?10:$HEIGHT;
	$STEP = ceil($HEIGHT/10);
	
	//prin($VV);

	//exit();
	
	/*
	$query_where=$where
				 . ( ($ordby!='')? "group by ".$ordby: ' order by total desc' )." ";
				 
	$items=select("$ordby as nombre, count(*) as total",
					$datos_tabla['tabla'],
					$query_where,1);
	*/
	
	include 'php-ofc-library/open-flash-chart.php';

	//srand((double)microtime()*1000000);
	//$data = array();

	// add random height bars:
	/*
	foreach($VV as $V1){
	  $data[] = $V1['v']*1;
	}  
	*/
	// make the last bar a different colour:
	/*
	$bar = new bar_value(5);
	$bar->set_colour( '#900000' );
	$bar->set_tooltip( 'Hello<br>#val#' );
	$data[] = $bar;
	*/
	
	$title = new title('');
	
	if(0){
	$bar = new bar_3d();
	$bar->colour = '#A8151C';
	}
	$bar = new bar_filled( '#3B5998', '#000000' );	
	$bar->set_tooltip( '#val# '.$OBJ['nombre_plural'] );

	$bar->set_on_show(new bar_on_show('grow-up','0','0.1'));
	$bar->set_values( $data );

	
	$y_axis = new y_axis();
	$y_axis->set_range( 0, $HEIGHT, $STEP);

	$x_axis = new x_axis();
	$x_axis->set_3d( 5 );
	$x_axis->colour = '#cccccc';
	
	$x_labels = new x_axis_labels();
	$x_labels->set_vertical();
	if(sizeof($LLL)>50){
	$x_labels->set_steps( 2 );
	}
	$x_labels->set_size( 14 );
	$x_labels->set_labels($LLL);
// nice big font

	//$x->set_labels( $x_labels );
	$x_axis->set_labels($x_labels);
	//$x_axis->set_labels_from_array($LLL);

	$chart = new open_flash_chart();
	//$chart = new bar_cylinder_outline();
	$chart->set_title( $title );
	$chart->add_element( $bar );
	$chart->set_x_axis( $x_axis );	
	$chart->set_y_axis( $y_axis );
	$chart->set_bg_colour('#FFFFFF');
	/*
	echo '{ "elements": [ { "type": "bar_3d", "values": [ 3, 9, 4, 4, 3, 8, 6, 8, 8, { "top": 5, "colour": "#900000", "tip": "Hello
#val#" } ], "colour": "#D54C78" } ], "title": { "text": "Tue Feb 28 2012" }, "x_axis": { "3d": 5, "colour": "#909090", "labels": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ] } }';
	*/
	echo $chart->toPrettyString();

	
	} else {


	$query_where=$where
				 . ( ($ordby!='')? "group by ".$ordby: ' order by total desc' )." ";
				 
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

		//prin($items);


	include 'php-ofc-library/open-flash-chart.php';

	$title = new title( '' );
	$title->set_style('color: #f0f0f0; font-size: 20px');
	foreach($items as $item){
	$total=$item['total']*1;
	if($total/$Total>0.005){
	$d[]=new pie_value($total,trim($item['nombre']));
	}
	}

	$pie = new pie();
	$pie->alpha(0.5)
		//->add_animation( new pie_fade() )
		//->add_animation( new pie_bounce(5) )
		//->start_angle( 0 )
		->tooltip( '#label#<br>#percent#<br>#val# de #total#' )
	//    ->colours(array("#d01f3c","#356aa0","#C79810"))
		->colours(array("#4573A7","#AA4644","#89A54E","#71588F","#4298AF","#DB843D","#93A9D0","#D09392","#BACD96","#A99BBE"))
		->radius(180);	

	$pie->set_values( $d );

	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $pie );
	$chart->set_bg_colour('#FFFFFF');

	echo $chart->toPrettyString();

}


include("lib/compresionFinal.php");	/*para Content-Encoding*/ 
?>