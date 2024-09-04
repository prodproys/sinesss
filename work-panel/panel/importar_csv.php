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


$foreig=array();
$obj=$objeto_tabla[$_GET['me']];
foreach($obj['campos'] as $campo){
	if(in_array($campo['tipo'],array('inp','txt'))){
		$autorizados[$campo['label']]=$campo['campo'];
	}
	if($campo['tipo']=='hid'){
		$foreig[$campo['campo']]=$_GET[$campo['campo']];
	}
}
$howto ='
		<p><br /><br />Archivo CSV debe tener la primera fila con los nombres de los encabezados</p>
		<p>los encabezados que se aceptan son:</p>
		<p>';
$howto.="<table class='tbl_import'>";
$howto.="<thead>";
$howto.="<tr>";
foreach($autorizados as $campo){
	$howto.="<th>".$campo."</th>";
}
$howto.="</tr>";
$howto.="</thead>";
$howto.="</tbody>";

for($e=0;$e<5;$e++){
	$howto.="<tr>";
	foreach($autorizados as $label=>$campo){
		$howto.="<td class='label'>".$label."</td>";
	}
	$howto.="</tr>";
}

$howto.="</tbody>";
$howto.="</table>";

$howto.="</p>";

if($_GET['paso']=='insert'){
	$campos=explode(",",$_POST['campos']);
	$lineas=explode("\n",$_POST['values']);
	foreach($lineas as $linea){
		$datos=str_getcsv($linea);
		foreach($campos as $i=>$campo){
			$insert[$campo]=$datos[$i];
		}
		$insert=array_merge(array(
				'fecha_creacion'=>'now()',
				'fecha_edicion'=>'now()',
				'visibilidad'=>'1'
		),$foreig,$insert);
		insert($insert,$obj['tabla'],0);
		unset($insert);
	}

	//if($mysqlreturn==0){
	redir('importar_csv.php?me='.$_GET['me'].'&paso=fin'.$params);
	//} else { redir('importar_csv.php?me='.$_GET['me'].'&paso=fin&error=fin'); }

}

if($_GET['paso']=='upload'){

	$file_size = $_FILES['csv']['size'];
	$file_type = $_FILES['csv']['type'];
	$file_temp = $_FILES['csv']['tmp_name'];
	if (is_uploaded_file($file_temp)){
		$lineasi=utf8_encode(implode("\n",file($file_temp)));
		$lineas=explode("\n",$lineasi);
		$headers=str_getcsv($lineas[0]);
		foreach($headers as $b=>$c){
			if(in_array(trim($c),$autorizados)){
				$headers2[]=trim($c); $indices[]=$b; $mysql_campos[]=trim($c);
			}
		}
		$headers=$headers2;
		unset($headers2);
		unset($lineas[0]);

		foreach($lineas as $campos){
			$campos=str_getcsv($campos);
			$trim='';
			foreach($indices as $i){
				$trim.=trim($campos[$i]);
				$Linea[]=$campos[$i];
				$mysql_value[]="\"".addslashes(trim($campos[$i]))."\"";
			}
			if(trim($trim)!=''){
				$mysql_values[]=implode(",",$mysql_value);
				$Lineas[]=$Linea;
			}
			unset($Linea);
			unset($mysql_value);
		}

		$insertar=0;
		foreach($headers as $header){
			if(in_array($header,$autorizados)){
				$insertar=1;
			}
		}
		if($insertar==0){
			redir('importar_csv.php?me='.$_GET['me'].'&error=incompatible'.$params);
		}

	}
}

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
	//include("header.php");
	//echo $HTML_CONTENT_INICIO;
	//include("menu.php");
if($_GET['paso']=='fin'){ ?>
	<div class="importar_csv">
		<h1>
			Proceso de Registro masivo de
			<?php echo strtoupper($obj['nombre_plural']);?>
		</h1>
		<?php if($_GET['error']=='fin'){ ?>
		<h2>Error al insertar los registros. Vuelva a intentarlo</h2>
		<?php } else { ?>
		<h2>Fin de proceso : Registros insertados exitosamente</h2>
		<?php } ?>
	</div>
	<?php } elseif($_GET['paso']=='upload'){
		?>
	<div class="importar_csv">
		<h1>
			Proceso de Registro masivo de
			<?php echo strtoupper($obj['nombre_plural']);?>
		</h1>
		<h2>PASO 2 : Insertar en Base de datos</h2>

		<form method="post"
			action="importar_csv.php?me=<?php echo $_GET['me'];?>&paso=insert<?php echo $params;?>">
			<legend>
				Se van a insertar
				<?php echo sizeof($Lineas); ?>
				nuevos '
				<?php echo $obj['nombre_plural'];?>
				'
			</legend>
			<input type='hidden' value='<?php echo implode(',',$mysql_campos);?>'
				name="campos" />
			<textarea name="values" style='display: none;'>
				<?php echo implode("\n",$mysql_values);?>
			</textarea>
			<input type="submit" value="SIGUIENTE" />
		</form>
		<?php
		echo "<div class='tbl_import_frame'>";
		echo "<table class='tbl_import'>";
		echo "<thead>";
		echo "<tr>";
		foreach($headers as $header){
if(in_array($header,$autorizados)){
echo "<th>".$header."</th>";
}
}
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach($Lineas as $linea){
echo "</tr>";
foreach($linea as $c){
echo "<td>".$c."</td>";
}
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</div>";

?>
		<p>
			<br /> <br /> <a
				href='importar_csv.php?me=<?php echo $_GET['me'];?><?php echo $params;?>'>voler
				al paso 1</a>
		</p>
	</div>

	<?php

	} else {

?>
	<div class="importar_csv">
		<h1>
			Proceso de Registro masivo de
			<?php echo strtoupper($obj['nombre_plural']);?>
		</h1>
		<h2>PASO 1 : Subir archivo CSV</h2>

		<?php if($_GET['error']=='incompatible'){ ?>
		<div class="incompatible">
			<b>ERROR DE FORMATO</b> <br />nigun encabezados es compatible con
			esta tabla. <br />Por favor revisar
		</div>

		<?php } ?>

		<form enctype="multipart/form-data" method="post"
			action="importar_csv.php?me=<?php echo $_GET['me'];?>&paso=upload<?php echo $params;?>">
			<legend>Archivo CSV (delimitado por comas)</legend>
			<input type='file' name="csv" /> <input type="submit"
				value="Subir Archivo" />
		</form>
		<?php echo $howto; ?>
	</div>
	<?php

}
//echo $HTML_CONTENT_FIN;
//include("foot.php"); 
echo $HTML_MAIN_FIN;	
echo $HTML_ALL_FIN;
?>
</body>
</html>
<?php 
include("lib/compresionFinal.php");
?>