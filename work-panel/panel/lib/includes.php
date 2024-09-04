<?php //á

	include_once("lib/global.php");	
	include_once("lib/conexion.php");
	include_once("lib/mysql3.php");
	include_once("lib/util2.php");
	include_once($PATH_CUSTOM."config/tablas.php");
	include_once("lib/sesion.php");

	if(file_exists($PATH_CUSTOM."config/middleware.php")){
		include_once($PATH_CUSTOM."config/middleware.php");
	}

	if($vars['GENERAL']['esclavo']!='1'){

		if($_SESSION['usuario_datos_id_grupo']!=''){

			$designated=$SESSION_GRUPO_ID[$_SESSION['usuario_datos_id_grupo']];

		} else {

			$designated=$SESSION_USUARIO_ID[$_SESSION['usuario_id']];

		}

		if(isset($designated)){
			foreach($designated as $osuno => $osdos){
				// $objeto_tabla[$osuno]=array_replace($objeto_tabla[$osuno],$osdos);
				$objeto_tabla[$osuno]['campos']['id_cliente']['opciones']=$osdos['campos']['id_cliente']['opciones'];
			}
		}


	}

	$TABLAS_CREADAS=get_tablas_creadas();
	

	$mostrar_menu=(!(isset($_GET['accion']) or isset($_GET['tab']) or ($_GET['block']=='form')));

	$mostrar_master=(!in_array($_GET['accion'],array('esquema','alllistado','phpinfo','updatecode','subirconfig','bajarconfig','importdb','exportdb','makedump','importfromdump')));
	
	
	$_GET['filter']=str_replace(array('[today]'),array(date("Y-m-d")),($_GET['filter']));



	// $unodos=get_defined_vars();
	// include_once("lib/playmemory.php");
	// show_variables2(array_diff_key(get_defined_vars(),$unodos),[
	// 	'unodos',
	// 	'datos_tabla',
	// 	'tabla_sesion_datos_objeto',
	// ]);	

	// function show_variables2($debug,$except=[]){

	// 	$debug_keys=array_keys($debug);
	
	// 	foreach($debug_keys as $debug_key){
	// 		if(in_array($debug_key,$except)){
	// 			unset($debug[$debug_key]);
	// 		}
	// 	}
	// 	// echo '<pre>';print_r($debug);echo '</pre>';die();
		
	// }