<?php //á

include("lib/includes.php");

// prin($_GET);
/*

http://localhost/sistemapanel/sines/panel/custom/people.php?locations.id_settlement=1#filter=''

http://localhost/sistemapanel/sines/panel/custom/people.php?id_location=1#filter=''

*/

$FILES=explode($_SERVER['SCRIPT_NAME'],$_SERVER['PHP_SELF']);
$FILE=(!empty($FILES[1]))?$FILES[1]:$_SERVER['ORIG_PATH_INFO'];
$FILE=str_replace("/","",$FILE);

//ORIG_PATH_INFO
$file2OBJ=array();


foreach($objeto_tabla as $mememe=>$ot){
	// prin("/".$ot['archivo']);
	// prin($FILES[1]);
	$file2OBJ[$ot['archivo']]=$mememe;
	if($ot['archivo']==$FILE and $ot['archivo']!='') {
		$MEEE=$objeto_tabla[$ot['me']];
		continue;
	}
}

if(function_exists('middleware_onload')){
	middleware_onload();
}

if(function_exists('middleware_object')){
	$objeto_tabla=middleware_object($objeto_tabla);
}



if(isset($MEEE)){

	// prin(sizeof($MEEE));
	$this_me=$MEEE['me'];
	
	$objeto_tabla = pre_procesar_tabla($objeto_tabla,$vars);

	$MEEE = $objeto_tabla[$this_me];

}

//REDIRECCIONES
if(!isset($MEEE)){

	$permisos=$PERMISOS_USUARIO;
	if(
		trim($permisos)=='' 
		or trim($permisos)=='*'
		or !enhay($FILE_DEFAULT,'custom')
	){

		header("Location: ". $DIR_CUSTOM.$FILE_DEFAULT);

	} else {

		//prin($permisos);
		$permisos=str_replace("\n","",$permisos);
		$permisos=explode(",",$permisos);
		foreach($permisos as $permiso){
			list($objeto,$params)=explode("?",$permiso);
			$Permitidos[]=$objeto;
		}

		$sepuede=0;
		foreach($Permitidos as $uno=>$dos){
			if($objeto_tabla[$dos]['archivo'].".php"==$FILE_DEFAULT){
				$sepuede=1; continue;
			}
		}
		$FILE_DEFAULT=($sepuede)?$FILE_DEFAULT:$objeto_tabla[$Permitidos[0]]['archivo'].".php";

		header("Location: ". $DIR_CUSTOM.$FILE_DEFAULT);

	}

}

include("objeto.php");


// include("lib/compresionInicio.php");


include("head.php"); 

// $modificador_colap=($_COOKIE[$MEEE['prefijo']])?$_COOKIE[$MEEE['prefijo'].'_colap']:'modificador_grilla';

$id_permiso=$_SESSION['permisos']['PERMISOS_ID'];


// textarea($objeto_tabla['PEOPLE']['campos']['nombre']['controles']);exit();

?>
<body class="<?php echo ""
." ".( ( $_COOKIE['dark'] )?'dark':''  )

.( ($_GET['i']!='') ? " " : ' mode_main ' )

," menu_colapsed_mobile "
." monitor acceso_{$_SESSION['usuario_id']}"
." {$MEEE['titulo']}"
." ".( ($_COOKIE['admin'])?'permiso_master':'' )
." permiso_{$id_permiso}"
." modulo_{$FILE}"
." ".( ($_GET['justlist']==1)?'justlist':'' )
." ".( ($_SESSION['sesionhid3']=='unlocked')?`acceso_{$_SESSION['usuario_id']}_unlocked`:'' )
." ".( (  ($SERVER['ARCHIVO']!='login.php') and $_COOKIE['men'] )?'menu_colapsed':''  )



."";?>">

	<div id="div_allcontent" class="div_allcontent">

		<div class="main_content">
		<?php

			include('header_menu.php');

			include("header.php");			
			if(function_exists('middleware_header')){
				middleware_header();
			}

			echo "<div class='menu_content'>";
			if(function_exists('middleware_menu_header')){
				middleware_menu_header();
			}

			include("menu.php");
			echo "</div>";
			// prin($_COOKIE['dark'],'dark');

			include("vista.php");

		?>
		</div>
		
	</div>
	<?php include("foot.php");?>
</body>
</html>