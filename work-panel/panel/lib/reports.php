<?php 

//library
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

function render_table($row,$class=''){
	$ht='';
	$ht.='<table class="reporte table table-striped table-condensed table-bordered table-hover '.$class.'">';
	foreach($row as $rl=>$rline)
	{
		$fil=''; $trAtrr='';
		foreach($rline as $rc=>$cell)
		{
			if(!is_array($cell))
				$fil.="<td>$cell</td>";
			else
			{
				$fil.='<td '.$cell[1].'>'.$cell[0].'</td>';
				if(isset($cell[2])) $trAtrr=$cell[2];
			}
		}
		$ht.="<tr ".$trAtrr.">$fil</tr>";
	}
	$ht.='</table>';
	return $ht;
}

function render_excel($rows,$titulo='Reporte'){

	$rows=(is_array($rows))?$rows:array($rows);

	require_once 'lib/PHPExcel.php';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	$Autor="Prodiserv";

	// Set properties
	$objPHPExcel->getProperties()->setCreator($Autor)
	->setLastModifiedBy($Autor)
	->setTitle($titulo. " Fecha : ".date("d-m-Y"))
	->setSubject($titulo. " Fecha : ".date("d-m-Y"))
	->setDescription("Archivo generado por el Panel de administracion ".$titulo. " Fecha : ".date("d-m-Y"))
	->setKeywords($titulo. " Fecha : ".date("d-m-Y"))
	->setCategory($titulo);

	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(9);



	global $from;
	global $to;

	$col_inicial0=1; 
	$row_inicial0=1;

	$row_last=0;


	foreach($rows as $row){

		$cols=array();

		$row=( is_array($row) and sizeof($row)==2 and (is_array($row[0])) )?$row[0]:$row;

		//DETERMINAR COLUMNA MAXIMA
		foreach($row as $rl=>$rline)
			foreach($rline as $rc=>$cell)
				$cols[]=$rc;

		$maxcol=max($cols);
		// echo $maxfil;exit();

		$col_inicial=$col_inicial0;

		$row_inicial=$row_inicial0+$row_last;

		$row_last=$row_last+sizeof($row)+2;

		foreach($row as $rl=>$rline)
		{
			$fil=''; $trAtrr=''; $extra=0;
			for($i=0;$i+$extra<=$maxcol;$i++)
			{

				$cell=$rline[$i];

				$col= $col_inicial + $i + $extra;
				$fil= $row_inicial + $rl + 1 ;

				if(!is_array($cell))
				{
					
					$celll=$cell;

				} else {
					
					$celll=$cell[0];

					if(enhay($cell[1],'colspan')){  
						$parts=explode("colspan=",$cell[1]." "); $parts=explode(" ",$parts[1]); $colspan=$parts[0]; $extra=$extra+$colspan -1; 
						$cells['merges'][]=num2alpha($col).$fil.":".num2alpha( $col_inicial + $i + $extra ).$fil; 
					}
					if(enhay($cell[2],'success')){  $success[]=num2alpha($col).$fil.":".num2alpha($maxcol+$col_inicial).$fil; }
					if(enhay($cell[2],'info')){ 	$info[]=num2alpha($col).$fil.":".num2alpha($maxcol+$col_inicial).$fil; }
					if(enhay($cell[2],'warning')){  $warning[]=num2alpha($col).$fil.":".num2alpha($maxcol+$col_inicial).$fil; }
				}

				$cells['items'][num2alpha($col).$fil]=strip_tags(str_replace("<br>","\\n",$celll));
				$cells['filas'][$fil][]=num2alpha($col).$fil;
			}

			//$ht.="<tr ".$trAtrr.">$fil</tr>";
		}

		// prin($cells);exit();


		// $objPHPExcel->getDefaultStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);


		//INSERT VALUES IN CELLS

		foreach($cells['items'] as $key=>$item){
			$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
		}


		//PRIMERA COLUMNA MAS ANCHA
		for($i=0;$i<=$maxcol;$i++)
		{
			$letra=num2alpha($i+$col_inicial);
			if($i==0)
				$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setWidth(20);
			else	
				$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setWidth(15);

		}	 


		// prin($cells['merges']); exit();
		
		//MERGES CENTRADOS
		foreach($cells['merges'] as $merge){
			$objPHPExcel->getActiveSheet()->mergeCells($merge);
			$objPHPExcel->getActiveSheet()->getStyle($merge)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}

		// // prin($cells['items']); exit();
		
		//MARCO
		$objPHPExcel->getActiveSheet()->getStyle(getrango($cells['items']))->applyFromArray(
				array('borders' => array(
						'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
				),
						// 'fill' 	=> array(
						// 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID
						// ),
				)
		);


		//CEBRA
		$m=0;
		foreach($cells['filas'] as $fila){
			$m++;
			if($m%2==0){
				$Filas[]=$fila[0].":".end($fila);
			}
		}
		foreach($Filas as $Fila){

			$objPHPExcel->getActiveSheet()->getStyle($Fila)->applyFromArray(
					array(
							'fill' 	=> array(
								// 'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => '00F9F9F9')
							)
					)
			);
		}

		//FORMATEANDO FILAS
		foreach($warning as $Line)
		$objPHPExcel->getActiveSheet()->getStyle($Line)->applyFromArray(
				array(
						'borders' => array(
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						),					
						'font' => array(
								'bold' => true,
								'color' => array('argb' => '000000000')
						),
						'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => '00FCF8E3')
						)
				)
		);
		foreach($info as $Line)
		$objPHPExcel->getActiveSheet()->getStyle($Line)->applyFromArray(
				array(
						'borders' => array(
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						),					
						'font' => array(
								'bold' => true,
								'color' => array('argb' => '000000000')
						),
						'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => '00D9EDF7')
						)
				)
		);

		foreach($success as $Line)
		$objPHPExcel->getActiveSheet()->getStyle($Line)->applyFromArray(
				array(
						'borders' => array(
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
						),				
						'font' => array(
								'bold' => true,
								'color' => array('argb' => '000000000')
						),
						'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => '00D0E9C6')
						)
				)
		);

	}
		
	//GENERAR HOJA
	$objPHPExcel->getActiveSheet()->setTitle('Reporte');

	//GENERAR ARCHIVO

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Reporte '.date("d-m-Y").'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit();

}

//END LIBRARY