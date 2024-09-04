<?php

// function microtime_float()
// {
//     list($usec, $sec) = explode(" ", microtime());
//     return ((float)$usec + (float)$sec);
// }
$time_start_excel = microtime_float();


/*
##       #### ########   ######
##        ##  ##     ## ##    ##
##        ##  ##     ## ##
##        ##  ########   ######
##        ##  ##     ##       ##
##        ##  ##     ## ##    ##
######## #### ########   ######
*/
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

$send_document_header=true;

$limit_excel=5000;


/*
########     ###    ########    ###
##     ##   ## ##      ##      ## ##
##     ##  ##   ##     ##     ##   ##
##     ## ##     ##    ##    ##     ##
##     ## #########    ##    #########
##     ## ##     ##    ##    ##     ##
########  ##     ##    ##    ##     ##
*/

if($_GET['middlewarelist']!=''){

	include_once($PATH_CUSTOM."controllers/controller_".$_GET['middlewarelist'].".php");

} else {

	$items=select(
		$tbquery,
		$tbl,
		$join_query.
		"\n where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'].
		"\n order by "
		. ( ($FilTro_o=='')?'':$FilTro_o."," )
		. ( ($datos_tabla['group'])?' '.$datos_tabla['group'].' desc, ':'' )
		. ( ($datos_tabla['order_by']=='')? (  $tbl.".".$datos_tabla['id']." ". (($datos_tabla['orden']=='1')?"desc":"asc") ):$datos_tabla['order_by'] )
		. " limit 0,15000"
		,
		( 0 or ($_GET['debug']=='1') )
	);	

}



// echo sizeof($items); prin($items); exit();
// $send_document_header=false; prin($items); exit();


$OBJ=$objeto_tabla[$_GET['OB']];

$nombre_archivo=strtolower(str_replace(" ","-",$vars['GENERAL']['html_title']."-".$OBJ['titulo']))."-".date("Y-m-d-G-i-s");



$labels=array();
$tblistadoA=array();
foreach($tblistado as $campo){
	if($campo['listable']=='1' and $campo['tipo']!='html' ){
		$labels[]=$campo['label'];
		$tblistadoA[$campo['campo']]=$campo;
		$capos[]=$campo['campo'];
	}	
}

// prin($items);

// exit();

// prin($tblistadoA);

// prinx($items);

// exit();

// if(0){

$items2=array();

foreach($items as $lll=>$linea){

	foreach($tblistadoA as $camP=>$campoo){

		if(in_array($camP,$capos)){

			switch($campoo['tipo']){
				case "com":
					$valoor=$campoo['opciones'][$linea[$camP]];
					//$valoor=($valoor!='')?$valoor:"&nbsp;";
					list($valoor,$nada)=explode("|",$valoor);	
					$items2[$lll][$camP]=$valoor;
				break;
				case "hid":
					list($primO,$tablaO)=explode("|",$campoo['opciones']);
					list($tablaO)=explode(" ",$tablaO);
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
				default:
					$items2[$lll][$camP]=$linea[$camP];
				break;
			}
			if($items2[$lll][$camP]=='') $items2[$lll][$camP]='-';


		}
	}
}

$items=$items2;

// prin($items);

/*
 ######   ######  ##     ##
##    ## ##    ## ##     ##
##       ##       ##     ##
##        ######  ##     ##
##             ##  ##   ##
##    ## ##    ##   ## ##
 ######   ######     ###
*/
$items_total=sizeof($items);
if($items_total>$limit_excel){



	$f = fopen('php://memory', 'w'); 
	
	fputcsv($f, $labels, ",",'"'); 
    
	foreach ($items as $item) { 
        fputcsv($f, $item, ",",'"'); 
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);

	$time_excel =   number_format(microtime_float() - $time_start_excel,'2','.','')."-".$items_total;
	$nombre_archivo=$time_excel."-".$nombre_archivo;

	header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$nombre_archivo.'.csv";');
	fpassthru($f);

	exit();

}
// prin($items);

// exit();

// }

	$j0=0;
	$i0=1;

	// prin($vars); exit();
	// prin($labels);
	// // var_dump($_GET['conf']);
	// prin($items);
	// exit();



	$modulo_excel=($modulo_excel_modified)?$modulo_excel_modified:"Reporte de ".$OBJ['titulo'];
	$num_items=sizeof($items)." ".$OBJ['nombre_plural'];

	$titulo_excel=($titulo_excel_modified)?$titulo_excel_modified:$vars['GENERAL']['html_title']. ( ($vars['GENERAL']['html_titulo'])?" - ".$vars['GENERAL']['html_titulo']:"" );

	$titles[]="";	
	// $titles[]="$modulo_excel ($num_items)";
	$titles[]="$modulo_excel";
	$titles[]="$titulo_excel";
	$titles[]=fecha_formato("now()","8b");
	$titles[]="";
	
	// $titles[]=$nombre_archivo;
	//Reporte '.$OBJ['titulo'].' '.date("d-m-Y").'.xls
	// prin($titles); exit();
	
	foreach($titles as $i=>$tit){
		$i2=$i0+$i;
		$title['items']['A'.$i2]=$tit;
	}
	$title['rango']=getrango($title['items']);

	// prin($title);exit();

	$i0 = $i0 + sizeof($titles);


	foreach($labels as $j=>$label){
		$j2=$j0+$j;
		$heads['items'][num2alpha($j2).$i0]=$label;
		$columnas[]=num2alpha($j2);
	}
	// prin($heads);exit();
	
	$heads['rango']=getrango($heads['items']);

	// $items=array_slice($items,0,1);

	$i0=$i0+1;
	foreach($items as $i=>$filas){
		$j=0;
		foreach($filas as $cell){
			$i2=$i0+$i;
			$j2=$j0+$j;
			$cells['items'][num2alpha($j2).$i2]=( is_array($cell) && $cell['text'])?$cell['text']:$cell;
			$cells['filas'][$i2][]=num2alpha($j2).$i2;
			$j++;
		}
	}
	


	$m=0;
	foreach($cells['filas'] as $fila){
		$m++;
		if($m%2==0){
			$Filas[]=$fila[0].":".end($fila);
		}
	}


	$cells['rango']=getrango($cells['items']);



	$i0=$i0+sizeof($items);

	foreach($foots as $j=>$label){
		$j2=$j0+$j;
		$tfoots['items'][num2alpha($j2).$i0]=$label;
	}	
	$tfoots['rango']=getrango($tfoots['items']);



//prin($cells);

// exit();

require_once 'lib/PHPExcel.php';


/** PHPExcel */

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$Autor=$vars['GENERAL']['html_title']." by prodiserv";


/*
########   #######   ######  ##     ## ##     ## ######## ##    ## ########  #######
##     ## ##     ## ##    ## ##     ## ###   ### ##       ###   ##    ##    ##     ##
##     ## ##     ## ##       ##     ## #### #### ##       ####  ##    ##    ##     ##
##     ## ##     ## ##       ##     ## ## ### ## ######   ## ## ##    ##    ##     ##
##     ## ##     ## ##       ##     ## ##     ## ##       ##  ####    ##    ##     ##
##     ## ##     ## ##    ## ##     ## ##     ## ##       ##   ###    ##    ##     ##
########   #######   ######   #######  ##     ## ######## ##    ##    ##     #######
*/
// Set properties
$objPHPExcel->getProperties()->setCreator($Autor)
->setLastModifiedBy($Autor)
->setTitle("$modulo_excel - $titulo_excel")
// ->setSubject($titulo_excel)
->setDescription($modulo_excel);
// ->setKeywords("Excel: ".$OBJ['titulo']. " Fecha : ".date("d-m-Y"))
// ->setCategory("Excel: ".$OBJ['titulo']);

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
$objPHPExcel->getDefaultStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
// $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(1);


/*
   ###    ##     ## ########  #######     ###    ##     ##  ######  ########    ###    ########  ##       ########
  ## ##   ##     ##    ##    ##     ##   ## ##   ##     ## ##    ##    ##      ## ##   ##     ## ##       ##
 ##   ##  ##     ##    ##    ##     ##  ##   ##  ##     ## ##          ##     ##   ##  ##     ## ##       ##
##     ## ##     ##    ##    ##     ## ##     ## ##     ##  ######     ##    ##     ## ########  ##       ######
######### ##     ##    ##    ##     ## ######### ##     ##       ##    ##    ######### ##     ## ##       ##
##     ## ##     ##    ##    ##     ## ##     ## ##     ## ##    ##    ##    ##     ## ##     ## ##       ##
##     ##  #######     ##     #######  ##     ##  #######   ######     ##    ##     ## ########  ######## ########
*/
foreach($columnas as $letra){
	$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
}

/*
##     ## ########    ###    ########  ######## ########
##     ## ##         ## ##   ##     ## ##       ##     ##
##     ## ##        ##   ##  ##     ## ##       ##     ##
######### ######   ##     ## ##     ## ######   ########
##     ## ##       ######### ##     ## ##       ##   ##
##     ## ##       ##     ## ##     ## ##       ##    ##
##     ## ######## ##     ## ########  ######## ##     ##
*/
if(1){
	foreach($title['items'] as $key=>$item){

		$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
		$objPHPExcel->getActiveSheet()->mergeCells($key.":".str_Replace("A","H",$key));

	}

	$objPHPExcel->getActiveSheet()->getStyle($title['rango'])->applyFromArray(
			array(
					'font' => array(
							'bold' => false,
							'size' => 11
					)
			)
	);
}

/*
######## ##     ## ########    ###    ########
   ##    ##     ## ##         ## ##   ##     ##
   ##    ##     ## ##        ##   ##  ##     ##
   ##    ######### ######   ##     ## ##     ##
   ##    ##     ## ##       ######### ##     ##
   ##    ##     ## ##       ##     ## ##     ##
   ##    ##     ## ######## ##     ## ########
*/
if(1){
	foreach($heads['items'] as $key=>$item){
		$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
	}
	$objPHPExcel->getActiveSheet()->getStyle($heads['rango'])->applyFromArray(
			array(
					'font' => array(
							'bold' => true,
							'color' => array('argb' => 'FFFFFFFF')
					),
					'fill' 	=> array(
							'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
							'color'		=> array('argb' => '33333333')
					)
					
					//'borders' => array(
					// 		'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
					//)
			)
	);
}
/*
########    ###    ########  ##       ########
   ##      ## ##   ##     ## ##       ##
   ##     ##   ##  ##     ## ##       ##
   ##    ##     ## ########  ##       ######
   ##    ######### ##     ## ##       ##
   ##    ##     ## ##     ## ##       ##
   ##    ##     ## ########  ######## ########
*/
if(1){
	foreach($cells['items'] as $key=>$item){
		$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
	}
	$objPHPExcel->getActiveSheet()->getStyle($cells['rango'])->applyFromArray(
			array('borders' => array(
					// 'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
			),
					'fill' 	=> array(
							'type'		=> PHPExcel_Style_Fill::FILL_SOLID
					),
			)
	);
	foreach($Filas as $Fila){
		$objPHPExcel->getActiveSheet()->getStyle($Fila)->applyFromArray(
				array('fill' 	=> array(
						'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
						'color'		=> array('rgb' => 'E9F4F8')
				)
				)
		);
	}
}

/*
######## ########  #######   #######  ########
   ##    ##       ##     ## ##     ##    ##
   ##    ##       ##     ## ##     ##    ##
   ##    ######   ##     ## ##     ##    ##
   ##    ##       ##     ## ##     ##    ##
   ##    ##       ##     ## ##     ##    ##
   ##    ##        #######   #######     ##
*/
if(1 and sizeof($tfoots['items'])>0 ){
	foreach($tfoots['items'] as $key=>$item){
		$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
	}
	$objPHPExcel->getActiveSheet()->getStyle($tfoots['rango'])->applyFromArray(
			array(
					'font' => array(
							'bold' => true,
							'color' => array('argb' => 'FFFFFFFF')
					),
					'fill' 	=> array(
							'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
							'color'		=> array('argb' => '99999999')
					)
					
					//'borders' => array(
					// 		'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
					// 		'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
					//)
			)
	);
}



/*
 ######  ##     ## ######## ######## ########
##    ## ##     ## ##       ##          ##
##       ##     ## ##       ##          ##
 ######  ######### ######   ######      ##
      ## ##     ## ##       ##          ##
##    ## ##     ## ##       ##          ##
 ######  ##     ## ######## ########    ##
*/
$objPHPExcel->getActiveSheet()->setTitle(substr($modulo_excel,0,30));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



$time_excel =   number_format(microtime_float() - $time_start_excel,'2','.','')."-".$items_total;
$nombre_archivo=$time_excel."-".$nombre_archivo;


if($send_document_header){

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nombre_archivo.'.xls"');
	header('Cache-Control: max-age=0');


	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

}



exit();



