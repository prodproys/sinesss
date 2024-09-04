<?php //á
  
$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

include("lib/compresionInicio.php");

include("lib/global.php");

	$link=mysql_connect ($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
	mysql_select_db ($MYSQL_DB,$link);
	mysql_query("SET NAMES 'utf8'",$link);

if(@$_COOKIE["admin"]!="1" and 0)
{
	?>
	<html>
	<body style="background-color:#fff;">
    <form name="login" method="post" style='position:absolute;top:45%;left:45%;'>
    	<input name="clave" id="clave" type="password" style="font-size:18px; width:200px; color:#000; border:1px solid #333;  " />
    </form>
    <script>
	document.getElementById('clave').focus();
	</script>
    <a href="index.php" style='position:absolute;bottom:0px;right:0px;'>HOME</a>
	<?php 
	exit();
}	

include("lib/mysql3.php");
include("lib/util2.php");
if($vars['GENERAL']['esclavo']!='1'){	
	include("config/tablas.php");
}
include("lib/sesion.php");
include("lib/playmemory.php");


include("head.php");

?>
<body>
<?php
echo $HTML_ALL_INICIO;
echo $HTML_MAIN_INICIO;		
//include("header.php");
echo $HTML_CONTENT_INICIO;
//include("menu.php");
?>
<style>
body{background:#FFFFFF !important;}
#div_allcontent {min-width:600px !important;}
.contenido_principal{box-shadow:0px 0px 0px; !important}
</style>
<div class="div_bloque_cuerpo" style="margin-left:0px">
	<div class="bloque_titulo" style=" width:100%; padding-left:0; padding-right:0;">
	<span style="margin-left:5px;float:left;" class="titulo">Librería de imágenes</span>
	</div>
	<div id='inner_backup' style='padding:10px 0 0 10px;'><?php include("library_vista.php"); ?></div>
</div>
<?php
echo $HTML_CONTENT_FIN;
//include("foot.php"); 
echo $HTML_MAIN_FIN;	
echo $HTML_ALL_FIN;
?>
</body>
</html>
<?php 
include("lib/compresionFinal.php");
?>