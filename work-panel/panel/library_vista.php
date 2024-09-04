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

$files0=get_dirs_tree("../imagenes_dir");

foreach($files0 as $file0){
if(substr_count($file0,"/")==6){
$directorio_s = dir($file0);
while($fichero=$directorio_s->read()) {
	if($fichero!='.' and $fichero!='..' ){
		if(enhay($fichero,"_1.")){
		$size=filesize($file0.str_replace("_1.",".",$fichero));
		$files[]=array('src'=>$file0.$fichero,'name'=>$fichero,'path'=>$file0,'size'=>$size,'sizetxt'=>number_format($size/(1024),3)."Kb");
		}
	}
	
}	
$directorio_s->close();	

}
}
$tb		= $_GET['tb'];
$campo	= $_GET['campo'];
echo "
<style>
.info { font-size:13px;color:#AE0808; }
.library { width:100%;height:470px;overflow:auto;float:left; }
.library li { float:left; width:49%; height:60px; overflow:hidden; border:1px solid #FFF; cursor:pointer; }
.library li:hover {background-color:#FFF9C8;}
.library li img { height:60px; float:left; width:auto; clear:left; max-width:130px;}
.library li div { margin:1px 0px 0px 136px;float:none; overflow:hidden;height:auto;white-space: normal; word-wrap: break-word; }
.library li div.size { font-weight:bold; font-size:14px;color:#AE0808; }
.library li div.path { font-weight:normal; font-size:10px;color:#666; }
.library li div.name { font-weight:bold; }
</style>
";
echo "<div class='info'>".(sizeof($files)." imágenes")."</div>";
echo "<ul class='library'>";
foreach($files as $file){ 
echo "<li title='Cargar Imágen' onclick=\"load_image('".str_replace("_1.",".",$file['src'])."');\">
<img src='".$file['src']."'>
<div class='name'>".$file['name']."</div>
<div class='path'>".$file['path']."</div>
<div class='size'>".$file['sizetxt']."</div>
</li>"; 
}
echo "</ul>";
echo "
<script>
function load_image(url){
parent.upload_terminar(url,'".$tb."','".$campo."',true);
parent.initMultiBox.close();
}
</script>
";
//prin($files);
/*
rsort($FF);

$Array_Meses1=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","setiembre","octubre","noviembre","diciembre");

if(file_exists("../imagenes_dir/")){
$directorio_s = dir("../imagenes_dir/");
while($fichero=$directorio_s->read()) {
	if($fichero!='.' and $fichero!='..' ){
		$files[]=$fichero;
	}
	
}	
$directorio_s->close();	
}

rsort($files);
*/
/*
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
*/
?>