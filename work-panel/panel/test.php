<?php //á
include("lib/includes.php");


$FILES=explode($_SERVER['SCRIPT_NAME'],$_SERVER['PHP_SELF']);
$FILE=(!empty($FILES[1]))?$FILES[1]:$_SERVER['ORIG_PATH_INFO'];
$FILE=str_replace("/","",$FILE);

//ORIG_PATH_INFO
$file2OBJ=array();

foreach($objeto_tabla as $mememe=>$ot){
	// prin("/".$ot['archivo']);
	// prin($FILES[1]);
	$file2OBJ[$ot['archivo']]=$mememe;
	if($ot['archivo']==$FILE) {
		$MEEE=$objeto_tabla[$ot['me']];
		continue;
	}
}

if(isset($MEEE)){

	// prin(sizeof($MEEE));
	$this_me=$MEEE['me'];
	
	$objeto_tabla = pre_procesar_tabla($objeto_tabla,$vars);

	$MEEE = $objeto_tabla[$this_me];

}



//REDIRECCIONES
if(0)
if(!isset($MEEE)){

	$permisos=$PERMISOS_USUARIO;
	if(trim($permisos)=='' or trim($permisos)=='*'){

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



include("lib/compresionInicio.php");

include("head.php"); 


$id_permiso=$_SESSION['PERMISOS_ID'];

?>

<body class="<?php echo ""
." monitor acceso_{$_SESSION['usuario_id']}"
." {$MEEE['titulo']}"
." ".( ($_COOKIE['admin'])?'permiso_master':'' )
." permiso_{$id_permisos}"
." modulo_{$FILE}"
." ".( ($_GET['justlist']==1)?'justlist':'' )
." ".( ($_SESSION['sesionhid3']=='unlocked')?`acceso_{$_SESSION['usuario_id']}_unlocked`:'' )
." ".( (  ($SERVER['ARCHIVO']!='login.php') and $_COOKIE['men'] )?'menu_colapsed':''  )
." ".( ($_GET['i']!='')?' detail ':'' )
." body_".$_COOKIE[$MEEE['prefijo'].'_colap']
."";?>">


	<div id="div_allcontent" class="div_allcontent">

		<div class="main_content">
		<?php

			include("header.php");

			include('header_menu.php');
			
			include("menu.php");

			// include("vista.php");

		?>
			<div>
				<h3>Salsa Calendar</h3>
				<input type="text"
					id="checkin"
					class="salsa-calendar-input"
					autocomplete="off"
					name="arrival"
					value=""
				/>
			</div>

			<div>
				<h3>Select Slim</h3>
				<select id="slim-select">
				<option></option>
				<option>uno</option>
				<option>dos</option>
				<option>tres</option>
				<option>cuatro</option>
				<option>cinco</option>
				<option>seis</option>
				</select>
			</div>			

		</div>
		<?php 
		
			include("foot.php");
		
		?>
	</div>
</body>
</html>
<?php include("lib/compresionFinal.php");