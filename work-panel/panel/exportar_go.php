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



if($_GET['me']=='VENTAS_ITEMS'){


	// prin($SERVER);

	// exit();



	$campos="
	ventas_items.id as id,
	ventas_items.id_item as id_item,
	ventas_items.id_usuario as id_usuario,
	ventas_items.id_cliente as id_cliente,
	ventas_items.id_status as id_status,
	ventas_items.fecha_creacion as fecha_creacion,


	clientes.genero as c_genero,
	clientes.tipo_cliente as c_tipo,
	clientes.nombre as c_nombre,
	clientes.apellidos as c_apellido,
	clientes.email as c_correo,
	clientes.telefono as c_telefono,
	clientes.telefono_oficina as c_telefono_oficina,
	clientes.celular_claro as c_celular_claro,
	clientes.celular_movistar as c_celular_movistar,
	clientes.rpm as c_rpm,
	clientes.rpc as c_rpc,
	clientes.cliente_celular as c_celular,
	clientes.contacto_nombre as contacto_nombre,
	clientes.contacto_apellidos as contacto_apellidos,



	clientes.departamento as c_departamento,
	clientes.provincia as c_provincia,
	clientes.distrito as c_distrito,


	productos_items.articulo as p_articulo,
	productos_items.nombre2 as p_modelo,
	productos_items.link as p_link,
	productos_items.link2 as p_link2,


	usuarios.nombre as a_nombre,
	usuarios.apellidos as a_apellidos,
	usuarios.telefono as a_telefono,
	usuarios.telefono_oficina as a_telefono_oficina,
	usuarios.celular_claro as a_celular_claro,
	usuarios.celular_movistar as a_celular_movistar,
	usuarios.rpm as a_rpm,
	usuarios.rpc as a_rpc,
	usuarios.cargo as a_cargo,

	ventas_status.nombre as s_nombre
	";

	// prin($_GET['filter']);

	// $qqff=query_filter_old($_GET['filter']);

	// prin($qqff);

	if($_GET['filter']!=''){
		$where="where 1 and ( ".query_filter_old($_GET['filter'])." ) ";
	} else {
		$where="where 1 ";
	}
		
	$restriction =" and ventas_items.user in (select id_sesion  from usuarios where id_jefe in (7))  " 
		." and ventas_items.id_status in (4,8,11,12,9) "
		." 	and (ventas_items.invernado is null or ventas_items.invernado =0) "
		// ." and ventas_items.id_status not in (1,17,10,7,6,3,20) "
		." and clientes.email <>'' "
	."";
		
	$query_where=$where
	.$restriction
	."order by id desc "
	."limit 0,10000";

	$items=select($campos,
	"ventas_items",
	"
	 left join clientes on ventas_items.id_cliente=clientes.id 
	 left join productos_items on ventas_items.id_item=productos_items.id 
	 left join usuarios on ventas_items.id_usuario=usuarios.id 
	 left join ventas_status on ventas_items.id_status=ventas_status.id
	".
	$query_where,
	0);


}


if($_GET['me']=='VENTAS_MENSAJES'){


	// prin($SERVER);

	// exit();

// "
// ventas_mensajes.id as id,
// ventas_mensajes.posicion as posicion,
// ventas_mensajes.visibilidad as visibilidad,
// ventas_mensajes.calificacion as calificacion,
// ventas_mensajes.fecha_creacion as fecha_creacion,
// ventas_mensajes.tipo as tipo,
// ventas_mensajes.texto as texto,
// ventas_mensajes.alerta as alerta,
// ventas_mensajes.alerta_fecha as alerta_fecha,
// ventas_mensajes.cumplido as cumplido,
// ventas_mensajes.id_grupo as id_grupo,
// ventas_items.id_cliente as id_cliente 

// from ventas_mensajes 

//  left join ventas_items on ventas_mensajes.id_grupo=ventas_items.id 
//  where 1  and ventas_mensajes.user in (select id_sesion  from usuarios where id_jefe in (7))   ";

	// $_GET['filter']='ventas_mensajes[]=alerta_fecha%7C2017-11-01%7C2017-11-30&ventas_mensajes[]=ventas_mensajes.estado%3D3,4';
	
	
	parse_str($_GET['filter'], $filterA);

	foreach($filterA['ventas_mensajes'] as $ii=>$filt){

		if(enhay($filt,'.estado')){
			$filterA['ventas_mensajes'][$ii]='ventas_mensajes.estado=1,3';
		}

	}

	// prin($filterA);

	$_GET['filter']=http_build_query($filterA);

	// prin(query_filter_old($_GET['filter']));	exit();

	$campos="
	ventas_mensajes.id as m_id,
	ventas_mensajes.id_grupo as id_grupo,
	ventas_mensajes.fecha_creacion as fecha_creacion,


	ventas_items.id as id,
	ventas_items.id_item as id_item,
	ventas_items.id_usuario as id_usuario,
	ventas_items.id_cliente as id_cliente,
	ventas_items.id_status as id_status,
	ventas_items.fecha_creacion as a_fecha_creacion,


	clientes.genero as c_genero,
	clientes.tipo_cliente as c_tipo,
	clientes.nombre as c_nombre,
	clientes.apellidos as c_apellido,
	clientes.email as c_correo,
	clientes.telefono as c_telefono,
	clientes.telefono_oficina as c_telefono_oficina,
	clientes.celular_claro as c_celular_claro,
	clientes.celular_movistar as c_celular_movistar,
	clientes.rpm as c_rpm,
	clientes.rpc as c_rpc,
	clientes.cliente_celular as c_celular,
	clientes.contacto_nombre as contacto_nombre,
	clientes.contacto_apellidos as contacto_apellidos,



	clientes.departamento as c_departamento,
	clientes.provincia as c_provincia,
	clientes.distrito as c_distrito,


	productos_items.articulo as p_articulo,
	productos_items.nombre2 as p_modelo,
	productos_items.link as p_link,
	productos_items.link2 as p_link2,


	usuarios.nombre as a_nombre,
	usuarios.apellidos as a_apellidos,
	usuarios.telefono as a_telefono,
	usuarios.telefono_oficina as a_telefono_oficina,
	usuarios.celular_claro as a_celular_claro,
	usuarios.celular_movistar as a_celular_movistar,
	usuarios.rpm as a_rpm,
	usuarios.rpc as a_rpc,
	usuarios.cargo as a_cargo,

	ventas_status.nombre as s_nombre
	";

	// prin($_GET['filter']);

	// $qqff=query_filter_old($_GET['filter']);

	// prin($qqff);

	if($_GET['filter']!=''){
		$where="where 1 and ( ".query_filter_old($_GET['filter'])." ) ";
	} else {
		$where="where 1 ";
	}
		
	$restriction =" and ventas_items.user in (select id_sesion  from usuarios where id_jefe in (7))  " 
		." and ventas_items.id_status in (4,8,11,12,9) "
		// ." and ventas_items.id_status not in (1,17,10,7,6,3,20) "
		." and clientes.email <>'' "
	."";
		
	$query_where=$where
	.$restriction
	."order by ventas_mensajes.alerta_fecha desc "
	."limit 0,10000";

	$items=select($campos,
	"ventas_mensajes",
	"
	 left join ventas_items on ventas_mensajes.id_grupo=ventas_items.id 

	 left join clientes on ventas_items.id_cliente=clientes.id 
	 left join productos_items on ventas_items.id_item=productos_items.id 
	 left join usuarios on ventas_items.id_usuario=usuarios.id 
	 left join ventas_status on ventas_items.id_status=ventas_status.id
	".
	$query_where,
	0);


}


$local_server='http://localhost/sistemapanel/crmdiamantes/';
$web_server='http://incapower.pe/';

// exit();

$srsra_array=[
	'o'  =>'Sr.',
	'a'  =>'Sra.',
	'os' =>'Sres.',
];

$departamento_array =get_valores('id','nombre','geo_departamentos');
$provincia_array    =get_valores('id','nombre','geo_provincias');
$distrito_array     =get_valores('id','nombre','geo_distritos');


$emailArrays=[];

foreach($items as $ii=>$item){

	$filas[$ii]['SEXO']            =($item['c_tipo']=='2')?'os':( ($item['c_genero']=='1')?'o':'a' );
	$filas[$ii]['SRSRA']           =$srsra_array[$filas[$ii]['SEXO']];
	$filas[$ii]['NOMBRE']          =firstLetter($item['c_nombre']);
	if($_GET['me']=='VENTAS_MENSAJES'){
		$filas[$ii]['CONTACTO']=($filas[$ii]['SRSRA']=='Sres.')?(($item['contacto_nombre'] or $item['contacto_apellidos'])?'Att. '.$item['contacto_nombre'].' '.$item['contacto_apellidos']:''):'';
	}
	$filas[$ii]['APELLIDO']        =firstLetter($item['c_apellido']);
	$filas[$ii]['CORREO']          =trim(strtolower($item['c_correo']));


		$emailArrays[$filas[$ii]['CORREO']]=$ii;


	$filas[$ii]['FECHA INGRESO']   =fecha_formato($item['fecha_creacion'],'0a');

	$filas[$ii]['ARTÍCULO']        =$item['p_articulo'];
	$filas[$ii]['MODELO']          =$item['p_modelo'];

		if($provincia_array[$item['c_provincia']]!='') $ciudad=$provincia_array[$item['c_provincia']];
		// elseif($distrito_array[$item['c_distrito']]!='') $ciudad=$distrito_array[$item['c_distrito']];
		elseif($departamento_array[$item['c_departamento']]!='') $ciudad=$departamento_array[$item['c_departamento']];
		else $ciudad='donde usted indique';

	$filas[$ii]['CIUDAD']          =$ciudad;

	if(trim($filas[$ii]['CIUDAD'])=='') $filas[$ii]['CIUDAD']='donde usted indique';

	$filas[$ii]['LINK']            =$item['p_link'];
	$filas[$ii]['LINK2']           =$item['p_link2'];
	// $filas[$ii]['']           		 ='';
	$filas[$ii]['ASESOR']          =firstLetter($item['a_nombre']." ".$item['a_apellidos']);


		if(trim($item['a_telefono'])         !='') $asesor_telefonos[]=$item['a_telefono'];
		if(trim($item['a_telefono_oficina']) !='') $asesor_telefonos[]=$item['a_telefono_oficina'];
		if(trim($item['a_celular_claro'])    !='') $asesor_telefonos[]=$item['a_celular_claro'];
		if(trim($item['a_celular_movistar']) !='') $asesor_telefonos[]=$item['a_celular_movistar'];
		if(trim($item['a_rpm'])              !='') $asesor_telefonos[]=$item['a_rpm'];
		if(trim($item['a_rpc'])              !='') $asesor_telefonos[]=$item['a_rpc'];

	// $filas[$ii]['ASESOR CELULAR'] = implode(" / ",$asesor_telefonos);
	$filas[$ii]['ASESOR CELULAR'] = $item['a_celular_movistar'];

	// $filas[$ii]['CARGO']          ='Asesor Comercial';
	$filas[$ii]['CARGO']          =$item['a_cargo'];

	unset($asesor_telefonos);

		if(trim($item['c_telefono'])         !='') $cliente_telefonos[]=$item['c_telefono'];
		if(trim($item['c_telefono_oficina']) !='') $cliente_telefonos[]=$item['c_telefono_oficina'];
		if(trim($item['c_celular_claro'])    !='') $cliente_telefonos[]=$item['c_celular_claro'];
		if(trim($item['c_celular_movistar']) !='') $cliente_telefonos[]=$item['c_celular_movistar'];
		if(trim($item['c_rpm'])              !='') $cliente_telefonos[]=$item['c_rpm'];
		if(trim($item['c_rpc'])              !='') $cliente_telefonos[]=$item['c_rpc'];
		if(trim($item['c_celular'])          !='') $cliente_telefonos[]=$item['c_celular'];

	$filas[$ii]['CLIENTE TELEFONOS'] = implode(" / ",$cliente_telefonos);

	unset($cliente_telefonos);	

	$filas[$ii]['STATUS']           =$item['s_nombre'];

	$filas[$ii]['CLIENTE LINK']      =(($SERVER['LOCAL'])?$local_server:$web_server).'panel/custom/clientes.php?i='.$item['id_cliente'];

	if($_GET['me']!='VENTAS_MENSAJES'){
		$filas[$ii]['EMPRESA']=($filas[$ii]['SRSRA']=='Sres.')?$filas[$ii]['NOMBRE']:'';
		$filas[$ii]['CONTACTO']=($filas[$ii]['SRSRA']=='Sres.')?(($item['contacto_nombre'] or $item['contacto_apellidos'])?'Att. '.$item['contacto_nombre'].' '.$item['contacto_apellidos']:''):'';
	}

	$filas[$ii]['ATENCION']           =$item['id'];
	$filas[$ii]['MENSAJE']           =$item['m_id'];


}

unset($emailArrays['notiene@notiene.com']);

// prin($emailArrays);

foreach($emailArrays as $ii=>$ee){

	$filas2[]=$filas[$ee];

}

$filas=$filas2;

// prin($filas);
// exit();

/** PHPExcel */

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$Autor="Guillermo Lozán";

// Set properties
$objPHPExcel->getProperties()->setCreator($Autor)
->setLastModifiedBy($Autor)
->setTitle("Reporte Fecha : ".date("d-m-Y"))
->setSubject("Reporte Fecha : ".date("d-m-Y"))
->setDescription("Reporte generado por el Panel de administracion Formato : ".date("d-m-Y"))
->setKeywords("Reporte Fecha : ".date("d-m-Y"))
->setCategory("Reporte");

// $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
// $objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
// $objPHPExcel->getDefaultStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
/*
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(1);
*/
/*
foreach($columnas as $letra){
	$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
}

foreach($title['items'] as $key=>$item){
	$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
}

$objPHPExcel->getActiveSheet()->getStyle($title['rango'])->applyFromArray(
		array(
				'font' => array(
						'bold' => true,
						'size' => 11
				)
		)
);
*/

$l=1;

$col=0;
foreach($filas[0] as $var=>$value){
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++,$l,$var);
	$objPHPExcel->getActiveSheet()->getColumnDimension(num2alpha($col))->setAutoSize(true);
}
$l++;

foreach($filas as $row=>$fila){
	$col=0;
	foreach($fila as $var=>$item){
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++,$l,$item);
		// prin([$col++,$row+1,$item]);
	}
	$l++;
}

// exit();
/*
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
				,
				 'borders' => array(
				 		'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				 		'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				 		'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				 		'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
				 		'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
				 )
		)
);

*/

// foreach($cells['items'] as $key=>$item){
// 	$objPHPExcel->getActiveSheet()->setCellValue($key,$item);
// }

// $objPHPExcel->getActiveSheet()->getStyle($cells['rango'])->applyFromArray(
// 		array('borders' => array(
// 				'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
// 				'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
// 				'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
// 				'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
// 				//'horizontal'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
// 				'vertical'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
// 		),
// 				'fill' 	=> array(
// 						'type'		=> PHPExcel_Style_Fill::FILL_SOLID
// 				),
// 		)
// );

// foreach($Filas as $Fila){
// 	$objPHPExcel->getActiveSheet()->getStyle($Fila)->applyFromArray(
// 			array('fill' 	=> array(
// 					'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
// 					'color'		=> array('rgb' => 'E9F4F8')
// 			)
// 			)
// 	);
// }

$objPHPExcel->getActiveSheet()->setTitle('formato');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// exit();

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="gmail-'.date("d-m-Y-H:i:s").'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit();




/*

header("Content-type: plain/text");
header('Content-Disposition: attachment;filename="exportar_gmail.csv"');
header('Cache-Control: max-age=0');
header ("Pragma: no-cache");
echo implode("
",$items3);

*/
exit();

function firstLetter($string){

	$string=str_replace(
		['Á','É','Í','Ó','Ú'], 
		['á','é','í','ó','ú'], 
		$string);

	return ucwords(strtolower($string));

}

function query_filter_old($filter){

	parse_str($filter, $filterA);
	$AAFF=array();

	foreach($filterA as $key=>$value){

		foreach($value as $FA=>$AF){

			if($AF!='' and trim($FA)!='orderby'){
				$aa=explode("|",$AF);
				if(sizeof($aa)==3){ $AAFF[]= " date(".$key.".".$aa['0'].") between '".$aa['1']."' and '".$aa['2']."' "; }
				else {
				if(enhay($AF,"=")){
				list($aaa,$bbb)=explode("=",$AF);
				$bbbb=explode(",",$bbb);
				$bbbbb=array();
				foreach($bbbb as $b4){ $bbbbb[]="'$b4'"; }
				$AAFF[]=" $aaa in (". implode(",",$bbbbb) .") ";
				} else{
				$AAFF[]=" $AF ";
				}
				}
			}

		}

	}

	//prin($AAFF);
	if(sizeof($AAFF)==0){
	$filter="1";
	}else{
	$filter=implode(" AND ",$AAFF);
	}
	return $filter;

}
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

