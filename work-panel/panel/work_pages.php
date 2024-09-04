<?php //á

include("lib/includes.php");


include_once($PATH_CUSTOM."controllers/controller_".$_GET['page'].".php");



	
$objeto_tabla = pre_procesar_tabla($objeto_tabla,$vars);

$MEEE = $objeto_tabla[$this_me];




include("head.php"); 



if (!$_COOKIE[$MEEE['prefijo'].'_colap'])
	$_COOKIE[$MEEE['prefijo'].'_colap']='modificador_grilla';



$id_permiso=$_SESSION['permisos']['PERMISOS_ID'];


// textarea($objeto_tabla['PEOPLE']['campos']['nombre']['controles']);exit();

?>
<body class="<?php echo ""
." ".( ( $_COOKIE['dark'] )?'dark':''  )

," menu_colapsed_mobile "
." monitor acceso_{$_SESSION['usuario_id']}"
." {$MEEE['titulo']}"
." ".( ($_COOKIE['admin'])?'permiso_master':'' )
." permiso_{$id_permiso}"
." modulo_{$FILE}"
." ".( ($_GET['justlist']==1)?'justlist':'' )
." ".( ($_SESSION['sesionhid3']=='unlocked')?`acceso_{$_SESSION['usuario_id']}_unlocked`:'' )
." ".( (  ($SERVER['ARCHIVO']!='login.php') and $_COOKIE['men'] )?'menu_colapsed':''  )

." special_pages page_".$_GET['page']

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

			include("vista/vista_ax_page.php");

			if(enhay($_GET['page'],'md')){
				// echo "<link rel='stylesheet' href='https://raw.githubusercontent.com/markdowncss/splendor/master/css/splendor.css' >";
				echo '<div class="markdown div_bloque_cuerpo"><div class="container">';
					// include_once($PATH_CUSTOM."views/dist/".$viewFile.".php");
					include_once($PATH_CUSTOM."views/dist/view_".$_GET['page'].".php");
				echo '</div></div>';
			}
			else 
			{

				include_once($PATH_CUSTOM."views/dist/".$viewFile.".php");
				// include_once($PATH_CUSTOM."views/dist/view_".$_GET['page'].".php");
			}

		?>
		</div>
		
	</div>
	<?php include("foot.php");?>
</body>
</html>