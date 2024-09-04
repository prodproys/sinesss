<?php

session_start(); // Iniciar variables de sesión

$VALIDAR_SESION=(@$_COOKIE["admin"]=="1")?"":$VALIDAR_SESION;

$HAVE_MODULO_INDEPENDIENTE=1;



// 	if($_SESSION['usuario_permisos']!='')	
// if(
// 	$_SESSION['usuario_datos_nombre']!='' and 
// 	$_SESSION['usuario_datos_id']!='' and 
// 	)
if(
	trim($VALIDAR_SESION)!=''
	and $Proceso != 'login'
	and $_SESSION['usuario_datos_nombre']==''
	){
	
	// prin('trump');exit();

	$datos_tabla 		 =  procesar_objeto_tabla($objeto_tabla[$VALIDAR_SESION]);
	$sesion_id			 =	$datos_tabla['id'];
	$sesion_vis			 =	($datos_tabla['vis']=='')?"":" and ".$datos_tabla['vis']."='1' ";
	$sesion_password	 =	$datos_tabla['sesion_password'];
	$sesion_login		 =	$datos_tabla['sesion_login'];
	$sesion_permisos	 =	$datos_tabla['sesion_permisos'];
	$tabla_sesion		 =	$datos_tabla['tabla'];
	$sesion_completo	 =	'nombre_completo';
	$sesion_datos_id_sub =  'id_sesion';

	foreach($objeto_tabla as $kkkeyy=>$canp){

		foreach($canp['campos'] as $campos){
			
			if($campos['campo']==$sesion_datos_id_sub and $campos['subform']=='1'){
				//list($ca,$ta)=explode("|",$campos['opciones']);
				//list($id,$resto)=explode(",",$campos['opciones']);
				if(dato('id',$canp['tabla'],"where id_sesion='".$_SESSION['usuario_id']."'",0)!=''){
					$tabla_sesion_datos	= $canp['tabla'];
					$tabla_sesion_datos_objeto_key= $kkkeyy;
				}
			}
		} unset($campos);
		/*
		if($canp['archivo_sub']==$tabla_sesion){
			$tabla_sesion_datos	= $canp['tabla'];
			foreach($canp['campos'] as $campos){
				if(enhay($campos['opciones'],$tabla_sesion)){	$sesion_datos_id_sub=$campos['campo'];	}
			}
		}
		*/
		if($canp['archivo']==$tabla_sesion){
			foreach($canp['campos'] as $campos){
				if($campos['campo']==$sesion_permisos){ list($uno,$tabla_permisos)=explode("|",$campos['opciones']);	}
			} unset($campos);
		}
	} unset($canp); unset($kkkeyy); unset($uno);

	$tabla_sesion_datos_objeto = procesar_objeto_tabla($objeto_tabla[$tabla_sesion_datos_objeto_key]);

	//prin($tabla_sesion_datos);
	if($tabla_permisos){
		foreach($objeto_tabla as $canp){
			if($canp['archivo']==$tabla_permisos){
				foreach($canp['campos'] as $campo=>$c){
					if(in_array($campo,array('nombre','texto','multiusuario','per_webs','per_pages'))){
					$campos_permisos[]=$campo;
					}
				} unset($c);unset($campo);
			}
		}
	} unset($canp);

	$NombreCompleto=dato($sesion_completo,$tabla_sesion,"where $sesion_id='".$_SESSION['usuario_id']."'");

	$_SESSION['usuario_datos_nombre']=($NombreCompleto)?$NombreCompleto:dato($sesion_login,$tabla_sesion,"where $sesion_id='".$_SESSION['usuario_id']."'");
	
	$_SESSION['is_mobile']=isMobileDevice();

	$Permisos=fila(
		$sesion_permisos,
		$tabla_sesion,
		"where $sesion_id='".$_SESSION['usuario_id']."'",
		0,
		[
			'permisos'=>[
				'fila'=>[
					$campos_permisos,
					$tabla_permisos,
					'where id={'.$sesion_permisos.'}',
					0
				]
			]
		]
	);
	
	$TIPO_USUARIO     =$Permisos['permisos']['multiusuario'];
	$PERMISOS_ID      =$Permisos[$sesion_permisos];
	$PERMISOS_USUARIO =$Permisos['permisos']['texto'];
	$PERMISOS_PAGE    =$Permisos['permisos']['per_pages'];
	$PERMISOS_WEBS    =$Permisos['permisos']['per_webs'];

	unset($sesion_permisos);
	unset($campos_permisos);
	unset($tabla_permisos);

	unset($Permisos);
	unset($campos_permisos);

	// prin($PERMISOS_USUARIO);
	$PU=explode(",",$PERMISOS_USUARIO);
	foreach($PU as $pu){
		$pu=trim($pu);
		list($u,$d)=explode("?",$pu);
		if($u=='C'){ $CO=$d; }
		else { $PPUU[]=$pu; }
	} unset($pu); unset($PU); unset($u); unset($d);

	$PERMISOS_USUARIO=implode(",\n",$PPUU);
	unset($PPUU);
	//prin($PERMISOS_USUARIO);

	parse_str($CO,$CO2); unset($CO);
	foreach($CO2 as $CO3=>$CO4){ list($u,$d)=explode("|",$CO3); $vars[$u][$d]=$CO4; } 
	unset($CO4); 
	unset($u); 
	unset($d);
	unset($CO2);
	//prin($CO2);
	$_SESSION['permisos'] = [
		'TIPO_USUARIO'     => $TIPO_USUARIO,   
		'PERMISOS_ID'      => $PERMISOS_ID,   
		'PERMISOS_USUARIO' => $PERMISOS_USUARIO,
		'PERMISOS_PAGE'    => $PERMISOS_PAGE,
		'PERMISOS_WEBS'    => $PERMISOS_WEBS,   
	];

	if($tabla_sesion_datos){

		$_SESSION['tabla_sesion_datos'] = $tabla_sesion_datos;

		if($TIPO_USUARIO!='1'){
			//prin($tabla_sesion_datos_objeto);
			$rp=0;
			foreach($tabla_sesion_datos_objeto['form'] as $canpos){
				if($canpos['opciones']!='' and $canpos['tipo']=='hid' and $rp==0 and $tabla_sesion_datos_objeto['group']==$canpos['campo']){
					$oparent=$canpos;
					$rp++;
				}
			} unset($canpos);

			$usuar=fila($tabla_sesion_datos_objeto['query'],$tabla_sesion_datos,"where $sesion_datos_id_sub='".$_SESSION['usuario_id']."'",0);
			$_SESSION['usuario_datos_id']=$usuar['id'];
			$_SESSION['usuario_datos_nombre']=$usuar['nombre']." ".$usuar['apellidos'];
			if($oparent){

				list($primO,$tablaO)=explode("|",$oparent['opciones']);
				list($idO,$camposO)=explode(",",$primO); 
				$camposOA=array();
				$camposOA=explode(";",$camposO);
				$bufy='';
				foreach($camposOA as $COA){
					$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$usuar[$oparent['campo']]."'",0)." ";
				} unset($COA);unset($camposOA);
				$_SESSION['usuario_datos_nombre_grupo'] = $bufy;
				// este el el id del grupo, osea en CONTEXTO
				$_SESSION['usuario_datos_id_grupo'] = $usuar[$oparent['campo']];

				$_SESSION['usuario_datos_nombre_tipo'] = $bufy;
				// $_SESSION['usuario_datos_id_tipo'] = $bufy;


				// prinx($_SESSION);

				unset($bufy);
				unset($usuar);
				unset($primO);
				unset($tablaO);
				unset($camposO);
				unset($idO);

			}

		} else {
			unset($tabla_sesion_datos);
		}



	} unset($oparent); unset($rp);



	// LOGIN
	if( 
		$tabla_sesion!='' and 
		$sesion_id!='' and 
		$sesion_password!='' and 
		$sesion_login!='' 
	)
	{
	
		// verificar que no sea un usuario logueado
		if(!isset($_SESSION['usuario_id']))
		{    // si es un usuario que retorna al sitio y ha guardado su sesión, recuperar sus variables
			$c_usuario = $_COOKIE['c_usuario'];
			$c_password  = strtolower($_COOKIE['c_password']);

			if($c_usuario != "" and $c_password != ""){

				$_SESSION['usuario_id'] = select_dato(
					$sesion_id,
					$tabla_sesion,
					"where $sesion_login='$c_usuario' and $sesion_password='$c_password' $sesion_vis "
					,0
				);

			}
		}

		$usuario_id_sesion       = $_SESSION['usuario_id'];

		if($usuario_id_sesion=='' and $LoadWithoutSession!=1)
		{
			header("Location: " . ((!(strpos($_SERVER['SCRIPT_NAME'], $DIR_CUSTOM)===false)) ? "login.php" : "login.php" ) );
		}

	} // fin de login

	unset($tabla_sesion);
	unset($sesion_id);
	unset($sesion_password);
	unset($sesion_login);

	unset($nombre_completo);
	unset($id_sesion);

} // de esto



$TIPO_USUARIO     = $_SESSION['permisos']['TIPO_USUARIO'];
$PERMISOS_USUARIO = $_SESSION['permisos']['PERMISOS_USUARIO'];
$PERMISOS_PAGE    = $_SESSION['permisos']['PERMISOS_PAGE'];
$PERMISOS_WEBS    = $_SESSION['permisos']['PERMISOS_WEBS'];
$IS_MOBILE = $_SESSION['is_mobile'];
// $IS_MOBILE = 1;

$tabla_sesion_datos    = $_SESSION['tabla_sesion_datos'];
unset($sesion_vis);

//unset($_SESSION['page']);
if($objeto_tabla[$vars_global['PAGES']] and $vars_global['MULTIPAGES']=='1'){
	$filtroPAGES=($PERMISOS_PAGE)?" and id in ($PERMISOS_PAGE)":"";
	$ItemsPAGES=select("id,nombre",$objeto_tabla[$vars_global['PAGES']]['tabla'],"where visibilidad=1 $filtroPAGES ",0);
	foreach($ItemsPAGES as $iis){ $IdPageS[]=$iis['id']; } unset($iis);
	if(sizeof($ItemsPAGES)>0){ $filtrar_page=1; }
}
//unset($_SESSION['web']);
if($objeto_tabla[$vars_global['WEBS']] and $vars_global['MULTIWEBS']=='1'){
	$filtroWEBS=($PERMISOS_WEB)?" and id in ($PERMISOS_WEB)":"";
	$ItemsWEBS=select("id,nombre",$objeto_tabla[$vars_global['WEBS']]['tabla'],"where visibilidad=1 $filtroWEBS ",0);
	foreach($ItemsWEBS as $iis){ $IdWebS[]=$iis['id']; } unset($iis);
	if(sizeof($ItemsWEBS)>0){ $filtrar_web=1; }
}




//prin($_SESSION);