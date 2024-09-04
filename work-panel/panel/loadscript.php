<?php //á

@session_start(); // Iniciar variables de sesión
include("lib/compresionInicio.php");
include("lib/global.php");	
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
//	include("lib/stripattributes.php");
include("config/tablas.php");	

	
	if(!$_REQUEST['v_o']){
		foreach($objeto_tabla as $oott1=>$oott){ if($oott['tabla']==$_REQUEST['v_t']){ $_REQUEST['v_o']=$oott1; continue; } }
	}
	
	$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_REQUEST['v_o']]);	
	$tbl		=	$datos_tabla['tabla'];	
	$tbcampos	=	$datos_tabla['form'];
	$id			=	$datos_tabla['id'];
	$occ		=	$datos_tabla['oncreate'];
	$oce		=	$datos_tabla['onedit'];
	//$psc		=	$datos_tabla['postscript'];
	$id2	    =   trim(str_replace(array($id,"=","'","\"","where"),array("","","","",""),$_REQUEST['v_d']));
	

//print_r($_GET);
//$script=$psc;
$OO=$objeto_tabla[$_REQUEST['v_o']];
$SS=$_GET['f'];
$PP=$_GET['proceso'];
$II=$_GET['id'];
$TT=$tbl;
// SS : proceso IUD
// PP : proceso especiales
// TT : tabla
// II : id
// LL : fila
foreach($objeto_tabla[$_REQUEST['v_o']]['campos'] as $Pcamps){
$Pcampos[]=$Pcamps['campo'];
}
$LL=fila($Pcampos,$TT,"where id='$II'");
//echo "<pre>";print_r(array($SS,$PP,$II,$TT,$II,$LL));echo "</pre>";
//$script=str_replace(array("SS","II","TT","LL","PP"),array("\$SS","\$II","\$TT","\$LL","\$PP"),$script);
//echo $script;
include("base2/".$_GET['load']);

