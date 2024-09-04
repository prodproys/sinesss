<?php

	

if(isset($_GET['ran']) and $_GET['ran']!=''){

	//include("lib/compresionInicio.php");	/*para Content-Encoding*/
	include("lib/includes.php");


	if(function_exists('middleware_object')){
		$objeto_tabla=middleware_object($objeto_tabla);
	}


	if(isset($_GET['L']) and $_GET['L']!='' and $SERVER['ARCHIVO_REAL']!='formulario_quick.php'){

		$_GET['id']=$_GET['L'];
		unset($_GET['L']);
	
	}	

	$file2OBJ=array();
	$tabla2OBJ=array();
	foreach($objeto_tabla as $mememe=>$ot){
		$file2OBJ[$ot['archivo']]=$mememe;
		$tabla2OBJ[$ot['tabla']]=$mememe;
	}


	if($_GET['OT']){
		$_GET['OB']=$tabla2OBJ[$_GET['OT']];
	}

	$this_me=$_GET['OB'];


	if($_GET['proceso']!='' or 1){

		if($_GET['parent']){
		foreach($objeto_tabla as $oo=>$ot){
		if($ot['tabla']==$_GET['parent']){ $this_pa=$oo; continue; }
		}
		}

		$thiS=($this_pa)?$this_pa:$this_me;
		$vArs=$objeto_tabla[$thiS]['procesos'][$_GET['proceso']];
		$Plabel=$vArs['label'];
		$Pbuttom=$vArs['buttom'];
		$_GET['conf']=$vArs['params'];

		//prin($objeto_tabla['PRODUCTOS_TRASLADOS']['procesos']['2']['disabled']);


		$objeto_tabla=pre_procesar_tabla($objeto_tabla,$vars);


		// prin($objeto_tabla['PRODUCTOS_ENTREGAS']);

		//prin($objeto_tabla['PRODUCTOS_TRASLADOS']['procesos']['2']['disabled']);

	//prin($objeto_tabla[$this_me]['campos']['fecha_recepcion']);
	}


	$MEEE=$objeto_tabla[$_GET['OB']];
	//prin(99);
	//prin(sizeof($objeto_tabla[$this_me]['campos']));
	// prin($objeto_tabla[$this_me]['campos']);

	$Proceso=$_GET['proceso'];

	$Open=($_COOKIE['admin']=='1' and $vars['GENERAL']['mostrar_toolbars']=='1')?1:0;
	
}





/// procesar campos
list($MEEE,$EXTRA_FILTRO) = pre_procesar_objeto_tabla_0($MEEE);


// prin($MEEE);

$datos_tabla = procesar_objeto_tabla($MEEE);
// prin($datos_tabla);

// prin($datos_tabla['user']);

// foreach($datos_tabla['form'] as $ccan){
// 	if($ccan['campo']=='user'){
// 		prin($ccan);;
// 	}
// }


verificar_tabla($datos_tabla['tabla']);



if($Proceso=='login'){

	unset($datos_tabla['list']);

	$sesion_id			=	$datos_tabla['id'];
	$sesion_password	=	$datos_tabla['sesion_password'];
	$sesion_login		=	$datos_tabla['sesion_login'];
	$tabla_sesion		=	$datos_tabla['tabla'];

	foreach($datos_tabla['form'] as $i=>$camp){

		if($camp['sesion_login']=='1'){ $datos_tabla['form'][$i]['validacion']='0'; }
		if($camp['sesion_password']=='1'){ $datos_tabla['form'][$i]['tipo']='paslogin'; $datos_tabla['form'][$i]['validacion']='0';}

		if(!($camp['sesion_login']=='1' or $camp['sesion_password']=='1' )){

			unset($datos_tabla['form'][$i]);

		}
	}

	/// asignar variables
	$tbtitulo	=	"LOGIN";
	$tbl		=	$tabla_sesion;
	$tbf		=	"validacion";
	$tb 		=	"val";
	$tbcampos	=	$datos_tabla['form'];
	$tblistado	=	array();
	$tbquery	=   "";

} else {


	/// asignar variables
	// if(in_array($SERVER['ARCHIVO_REAL'],array('')))
	// 	$tbtitulo	=	procesar_dato($datos_tabla['titulo']);
	// else
	$tbtitulo	=	breadcrumb_from($datos_tabla,NULL,$objeto_tabla);
	
	$tbl		=	$datos_tabla['tabla'];
	$tbf		=	$datos_tabla['archivo'];
	$tb 		=	$datos_tabla['prefijo'];
	$tbcampos	=	$datos_tabla['form'];
	$tblistado	=	$datos_tabla['list'];
	$tbquery	=   $datos_tabla['query'];

}

$tblistadosize=sizeof($tblistado);

