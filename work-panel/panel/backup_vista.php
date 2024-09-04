<?php //á
//set_time_limit(0);

if($_GET['mes']){
	include("lib/global.php");
	include("lib/conexion.php");
	include("lib/mysql3.php");
	include("lib/util2.php");
	include("config/tablas.php");
	include("lib/sesion.php");
	include("lib/playmemory.php");

	require_once( "lib/ini_manager.php" );
}

$_GET['mes']=($_GET['mes'])?$_GET['mes']:date("Y/m/");

$fechas=get_dirs_tree("backup");
foreach($fechas as $fecha){
	if($fecha!='backup/'){
		$fecha=str_replace("backup/","",$fecha);
		$FF[]=$fecha;
	}
}
rsort($FF);
$Array_Meses1=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","setiembre","octubre","noviembre","diciembre");
echo "<div><label>Intervalo de Fecha: </label><select onchange='update_backups(this.value);'>";
//echo "<option></option>";
foreach($FF as $ff){
	list($anio,$mes)=explode("/",$ff);
	if($Array_Meses1[$mes*1]!=''){
		echo "<option value='".$ff."' ".(($_GET['mes']==$ff)?"selected":"").">";
		echo $anio." ".$Array_Meses1[$mes*1];
		echo "</option>";
	}
}
echo "</select></div>";

if(file_exists("backup/".$_GET['mes'])){
	$directorio_s = dir("backup/".$_GET['mes']);
	while($fichero=$directorio_s->read()) {
		if($fichero!='.' and $fichero!='..' ){
			$files[]=$fichero;
		}

	}
	$directorio_s->close();
}
rsort($files);
echo "<input type='hidden' id='backup_mes' value='".$_GET['mes']."'>";
if(sizeof($files)==0){
	echo "<b>No hay archivos de backup en este intervalo de fecha</b>";
} else {
	echo "<table class='backup'>";
	echo "<tr>
			<th style='width:180px;' >FECHA</th>
			<th style='width:280px;' >ARCHIVOS</th>
			<th class='width:200px;' >TAMAÑO(MB)</th>
			<th class='width:200px;' ></th>
			<th></th>
			<th></th>
			</tr>";
	foreach($files as $i=>$file){

		$tim=str_replace(array('backup-','.sql','_'),array('','',':'),$file);
		$uno=substr($tim,0,10);
		$dos=substr($tim,11,8);
		$tim=$uno." ".$dos;
		echo "<tr ".(($i%2==0)?"class='impar'":"")." onmouseover='tr(\"tron\",1,\"tr".$i."\");' onmouseout='tr(\"tron\",0,\"tr".$i."\");' id='tr".$i."'>";
		//echo "<td>".$tim."</td>";
		echo "<td>".fecha_formato($tim,'7d')."</td>";
		echo "<td>".$file."</td>";
		$size=filesize("backup/".$_GET['mes'].$file);
		echo "<td><span title='".$size." bytes'>".number_format($size/(1024*1024),1)."Mb</span></td>";
		echo "<td><a href='#' onclick='action_restaurar(\"".$file."\");return false;'>Restaurar</a></td>";
		echo "<td><a href='#' onclick='action_eliminar(\"".$file."\");return false;'>Eliminar</a></td>";
		//echo "<td><a href='#' onclick='action_enviar(\"".$file."\");return false;'>Enviar</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>