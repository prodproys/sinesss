<?php //á
$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

include("lib/compresionInicio.php");
include("lib/global.php");
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
include("config/tablas.php");
include("lib/sesion.php");
include("lib/playmemory.php");

include("head.php");

$params=filtrarGET($SERVER['PARAMS'],array('me','paso','error'));

?>
<style>
body {
	background: none;
}

#div_allcontent {
	min-width: 0;
}

.importar_csv {
	padding: 5px 10px;
	min-height: 410px;
	height: 410px;
	height: auto !important;
}

.importar_csv h1 {
	font-size: 24px;
	color: #333;
	margin: 10px 0;
}

.importar_csv h2 {
	font-size: 20px;
	color: #000;
	margin: 5px 0;
}

.importar_csv form {
	padding: 0px 10px;
	clear: left;
}

.importar_csv form input {
	clear: left;
	float: left;
	margin: 3px 0;
	float: left;
	width: auto;
	padding: 3px 10px;
	text-transform: uppercase;
}

.importar_csv .tbl_import_frame {
	overflow-x: auto;
	height: 200px;
	float: left;
	width: auto;
	padding: 0 20px 0 0;
	clear: left;
	margin-top: 10px;
}

.importar_csv .tbl_import {
	margin-left: 20px;
}

.importar_csv .tbl_import th,.importar_csv .tbl_import td {
	border: 1px solid #999;
	padding: 1px 10px 1px 2px;
}

.importar_csv .tbl_import th {
	font-weight: bold;
	font-size: 14px;
	color: #000;
}

.importar_csv .tbl_import td {
	font-weight: normal;
	font-size: 13px;
	color: #666;
}

.importar_csv .tbl_import td.label {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	font-style: italic;
	text-transform: uppercase;
}

.importar_csv p {
	clear: left;
	padding: 2px 10px 0 20px;
	margin: 0;
}

.incompatible {
	color: #000;
	padding: 5px;
	background-color: #FEC0CA;
	float: left;
	clear: left;
	margin-left: 10px;
}
</style>
<body>
	<?php
	echo $HTML_ALL_INICIO;
	echo $HTML_MAIN_INICIO;
	include("header.php");
	echo $HTML_CONTENT_INICIO;
	include("menu.php");
	include("app_vista.php");
echo $HTML_CONTENT_FIN;
include("foot.php"); 
echo $HTML_MAIN_FIN;	
echo $HTML_ALL_FIN;
?>
</body>
</html>
<?php 
include("lib/compresionFinal.php");
?>