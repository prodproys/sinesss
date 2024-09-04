<?php //á

$IMPORTAR=($_GET['importph'])?1:0;

$POR_PAGE=($_COOKIE[$_GET['me'].'_porpage'])?$_COOKIE[$_GET['me'].'_porpage']:30;

set_time_limit(0);

if($vars['INTERNO']['ID_PROYECTO']=='0'){
	$MASTER=true;
} else {
	$MASTER=false;
}

switch($_GET['tab']){

case "procesos":

include("procesos.php");

break;

case "documentos":

include("documentos.php");

break;
case "libraries":

include("libraries.php");

break;
default:

if($SERVER['LOCAL']=='1'){

	@$buxx=implode("\n",file("analisis_objetos.txt"));
	$analisis_array=json_decode($buxx,true);

	$analisis_array['VALORES_CAMPO']['rango']=array('now,+2 years','now,+10 years','-10 years,now','1980,-10 years');
	unset($analisis_array['VALORES_CAMPO']['valor']);

	$analisis_array['PROPIEDADES_CAMPO'][]='control';
	$analisis_array['VALORES_CAMPO']['control']=array('0','1');

	$analisis_array['VALORES_OBJETO']['por_linea']=array('1','2','3','4');



	$directorio = dir("lib/fotos_prueba/");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..'){
			$librerias_fotosx[]=$fichero;
		}
	}

	//prin($analisis_array['VALORES_CAMPO']);

	$analisis_array['VALORES_OBJETO']['archivo_pruebas']=$librerias_fotosx;

}
/*
Array
(
    [0] => id
    [1] => fcr
    [2] => fed
    [3] => pos
    [4] => vis
    [5] => inp
    [6] => pas
    [7] => img
    [8] => txt
    [9] => com
    [10] => fch
    [11] => html
    [12] => hid
    [13] => yot
)
*/

?>
<div style="margin-top:0px;">
<?php

$tablas_creadas=array();

if($vars['GENERAL']['esclavo']!='1'){

	$sql = "show tables";
	$result=mysqli_query($link,$sql);
	$total=mysqli_num_rows($result);
	if($total>0){
		while ($row = mysqli_fetch_row($result)){
				$tablas_creadas[] = $row[0];
		}
	}

}

if( $_GET['tabla']!='' and $_GET['accion']=='borrartabla2' ){
	mysqli_query($link,"DROP TABLE `".$_GET['tabla']."`");
	redireccionar();
}

if( $_GET['archivo']!='' and $_GET['accion']=='borrararchivos2' ){

	@unlink($DIR_CUSTOM.$_GET['archivo'].".php");
	@unlink($DIR_CUSTOM.$_GET['archivo']."_vista.php");
	redireccionar();

}

?>
</div>
<?php
if($_GET['accion']=='truncatetable' and $_GET['me']!='' ){
	echo "<div class='loading2' id='div_loading'>TRUNCATING ".$_GET['me']." y borrando fotos...</div>"; flush();
}
if($_GET['accion']=='alllistado' and ( $_GET['files']!='' or $_GET['files2']!='' ) ){
	echo "<div class='loading2' id='div_loading'>subiendo archivos...</div>"; flush();
}
if($_GET['accion']=='updatecode' ){
	echo "<div class='loading2' ". ((!$mostrar_menu)?"style='width:100%;'":""). " id='div_loading'>actualizando código...</div>"; flush();
}
if($_GET['accion']=='bajarconfig' ){
	echo "<div class='loading2' id='div_loading'>bajando archivos de config...</div>"; flush();
}
if($_GET['accion']=='subirconfig' ){
	echo "<div class='loading2' id='div_loading'>subiendo archivos de config...</div>"; flush();
}
if($_GET['accion']=='updatepanel' ){
	echo "<div class='loading2' id='div_loading'>subiendo archivos de custom y carpeta img....</div>"; flush();
}
if($_GET['accion']=='importdb' ){
	echo "<div class='loading2' id='div_loading'>Importando BD remota....</div>"; flush();
}
if($_GET['accion']=='exportdb' ){
	echo "<div class='loading2' id='div_loading'>Exportando BD local....</div>"; flush();
}

if($mostrar_master or 1){

?>
<style>
.bloque_titulo { height:auto; float:left; background-position:bottom left; }
</style>
<div class='div_bloque_cuerpo' <?php echo (!$mostrar_menu)?'style="width:100%;margin-left:0px;"':''?> >
    <div class="bloque_titulo" style=" width:100%; padding-left:0; padding-right:0;" >
    <?php if($_GET['me']!=''){ echo '<span style="margin-left:5px;float:left;">'.$_GET['me'].'</span>'; } else { ?>
	<span style="margin-left:5px;float:left;">
    <?php if($_GET['accion']=='config'){ ?>CONFIG<?php } else { ?>MASTER<?php } ?></span>
    <?php } ?>
    </div>


<?php
if($_GET['accion']!='config'){
?>
<div class="segunda_linea">
ANÁLISIS
<?php echo $server_place?>:
<?php echo ($link)?"<span style='color:green;'>CONECCION MYSQL OK</span>":"<span style='color:red;'>CONECCION MYSQL KO</span>"; ?>
 |
<?php
//	echo "<span id='ftpchek'>checkeando FTP...</span>\n";
	flush();
	if($_GET['check']=='ftp'){
		ftp_set_option($id_con, FTP_TIMEOUT_SEC, 20);
		$conn_id = ftp_connect($ftp_files_host,21,20);
		$login_result = ftp_login($conn_id, $ftp_files_user, $ftp_files_pass); ftp_pasv($conn_id, true);
		ftp_close($conn_id);
		echo ($login_result)?"<span style='color:green;'>CONECCION FTP OK</span>":"<span style='color:red;'>CONECCION FTP KO</span>";
	} else {
		echo "<a href='maquina.php?check=ftp'>checkear conexión FTP y crear directorios de imagenes</a>";
	}
	echo " | <a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?accion=creararchivostablaall'>CREAR TODAS LAS TABLAS</a>";

?>
</div>
<script>
function paint_on(el){
$(el).addClass('painton');
}
function paint_out(el){
$(el).removeClass('painton');
}
</script>
<?php
//INICIO
//if($_GET['me']==''){


		// $archivos2=array();
		// @mkdir("./$DIR_CUSTOM");
		// $directorio = dir("./$DIR_CUSTOM");
		// while($fichero=$directorio->read()) {
		// 	if($fichero!='.' and $fichero!='..'){
		// 	$archivos2[]=$fichero;
		// 	}
		// }
		// $directorio->close();


		$tablas_creadas2=$tablas_creadas;
		foreach($objeto_tabla as $ot){
			$tablas2[]=$ot['tabla'];
			$archivos3[]=$ot['archivo'].".php";
		}

		$archivos5=array_merge($archivos3);

		$archivos6=array();
		foreach($archivos2 as $ar){
			if(!in_array($ar,$archivos5) and $ar!='error_log' and (strpos($ar, "_vista")===false) ){ $archivos6[]=str_replace(".php","",$ar); }
		}

		$tabla3=array();
		foreach($tablas_creadas2 as $ta){
			if(!in_array($ta,$tablas2)){ $tabla3[]=$ta; }
		}
		$row=1;
		//echo "<br>";
		echo "<table class='tbl' cellspacing=0 cellpadding=0 border=0 >";
		echo "<tr>
				<th colspan=2>Sync</th>
				<th>Propiedades</th>
				<th>Objeto</th>
				<th>Label<br>Menú</th>
				<th>Tabla</th>
				<th>Grupo</th>
				<th>alias</th>
				<th>Seccion</th>
				<th>Por<br>pág</th>
				<th>Por<br>lín</th>
				<th>nombre<br>singular</th>
				<th>nombre<br>plural</th>
				<!--<th>kill</th>-->
				<th>IMP</th>
			  </tr>";


$primer_archivo=1;

//$objeto_tabla=reorder_objeto($objeto_tabla);

$rty=0;
$cR=0;
$cG=0;
$cB=0;
$tablas_multiopciones=array();

foreach($objeto_tabla as $ot){

			foreach($ot['campos'] as $xampos){
				if($xampos['multiopciones']!=''){
					$xax=explode("|",$xampos['multiopciones']);
					$tablas_multiopciones[]=$xax[1];
				}
			}
			if($_GET['me']=='' or $_GET['me']==$ot['me']){

			$archivo1=$ot['archivo'].".php";
			$archivo2=$ot['archivo']."_vista.php";

			// $archivos_creados = (file_exists($DIR_CUSTOM.$archivo1))?true:false;

			$tabla_creada	  = (in_array($ot['tabla'],$tablas_creadas))?true:false;
			$ambos_creados = ($tabla_creada)?true:false;

			if($vars['GENERAL']['FILE_DEFAULT']=='maquina.php' and $ambos_creados and $ot['menu']=='1' and $primer_archivo==1){
				$primer_archivo=0;
				$vars['GENERAL']['FILE_DEFAULT']=$ot['archivo'];
				write_php_ini($vars,"config/config.ini");
			}
			$archivolink=($ambos_creados)?'<a href="'.$DIR_CUSTOM.$archivo1.'" class="creado">file</a> ':"";

			$ocultar=($ot['disabled']==1)?"disabled":'';

			$bordegrupo='';
			if($gupO!=$ot['grupo']){
				$rty++;
				$gupO=$ot['grupo'];
				// $Color=color::rgb2hex(array($cR,$cG,$cB));
				$BgColor=oppColour($Color);
				if($rty%2==0){
					$Cc      =$Color;
					$Color   =$BgColor;
					$BgColor =$Cc;
				}

				$bordegrupo='bordegrupo';
				//$cR=$cR+50;
				//$cG=$cG+20;
				$cB=$cB+10;
			}

			$bgpar=($row%2==0)?'bgpar':'';

			echo "<tr class='$ocultar $bordegrupo $bgpar' id='trr_".$ot['me']."' onmouseover=\"paint_on(this.id);\" onmouseout=\"paint_out(this.id);\" >";
			echo "<td style='text-align:left;'>$row</td>";
			echo '<td>';


			$cam='sincromysql';
			/*
			echo '<a
			href="maquina.php?set='. ( ($saved[$ot['me']][$cam]==1)?"0":"1") .'&cam='.$cam.'&mi='.$ot['me'].'"
			class="letra '. (($saved[$ot['me']][$cam]=='1')?"onon":"offoff") .'"
			><img src="img/ico_sync.png"/></a>';
			*/
			echo '</td>';
			echo '<td class="cntrl">';

			/*
			foreach($indicesA as $inicial=>$indice){
			if($indice=='orden'){ continue; }
			echo "<a href='#' id='idid_".$indice."_".$ot['me']."' onclick=\"javascript:modificar_dato_valor('".$ot['me']."','".$indice."','".(($ot[$indice]=='1')?"0":"1")."'); return false;\" rel='nofollow' class='letra ". (($ot[$indice]=='1')?"onon":"offoff") ."' title='".strtoupper($indice)."' >";
			echo str_replace($Replace4Str,$Replace4Ico,$indice);
			echo "</a>";
			}
			*/

			echo '</td>';

			$row++;
			echo '<td class="'. ( (in_array($ot['me'],$BBB))?'small':'big') .'">
			<b>
				<a href="maquina.php?me='.$ot['me'].'"
			>'.$ot['me']."</a> 
				<span>(". ( contar($ot['tabla'],"where 1") ). ')</span></b>
			</td>';
			//echo '<td><b><a href="?me='.$ot['me'].'" style="float:left; margin-right:5px;">'.$ot['tabla'].'</a></b></td>';

			echo '<td
			ondblclick="edit2(\''.$ot['me'].'\',\'menu_label\',this)">';
			echo $ot['menu_label'];
			echo '</td>';

			// echo '<td >' . ( ($archivos_creados)?"<span class='creado'><img src='img/ico_yes.gif'/></span> <a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$ot['me']."&accion=borrararchivos&maquina=1'>del</a>&nbsp;<a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$ot['me']."&accion=recreararchivos&maquina=1'>redo</a>":"<span class='nocreado'><img src='img/ico_no.gif'/></span> <a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$ot['me']."&accion=creararchivos&maquina=1' >crea</a>"). '</td>';

			echo '<td>';
			if($ot['bloqueado']=='1'){
				echo ( $tabla_creada )?'<span class="creado"><img src="img/ico_yes.gif"/></span> bloqueado':'<span class="nocreado"> -- </span> <a href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=creartabla&maquina=1" >crea</a>';
			} else {

				echo ( $tabla_creada )?'<span class="creado"><img src="img/ico_yes.gif"/></span> <a href="javascript:if(confirm(\'¿Está seguro que desea eliminar esta tabla?\')){location.href=\''.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=borrartabla&maquina=1\';}" >del</a>':'<span class="nocreado"><img src="img/ico_no.gif"/></span> <a href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=creartabla&maquina=1" >crea</a>';
				$QQuerys=get_columns_from_objeto($objeto_tabla[$ot['me']]);
				if(sizeof($QQuerys)>0){
					echo ( $tabla_creada )?'&nbsp;<a title="'. (implode("\n",$QQuerys ) ).'" href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=actualizartabla&maquina=1" style="background-color:#F0C;color:#FFF;" >update</a>':'';
				}

			//prin(sizeof(get_uniques_from_tabla($objeto_tabla[$ot['me']]['tabla'])));

			}

			echo '</td>';

			// echo '<td>';

			// if($ot['bloqueado']=='1'){
			// 	echo ( $tabla_creada and $archivos_creados )?'':'<a href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=creararchivostabla&maquina=1" style="color:#000;" >crear archivos y tablas</a>';
			// } else {
			// 	if ( $tabla_creada and $archivos_creados ){
			// 		echo '<a href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=borrararchivostabla&maquina=1" >del</a>';
			// 	}
			// 	if ( !$tabla_creada and !$archivos_creados ){
			// 		echo '<a href="'.$SERVER['BASE'].$SERVER['ARCHIVO'].'?me='.$ot['me'].'&accion=creararchivostabla&maquina=1" >crea</a>';
			// 	}
			// }

			// echo '</td>';

			echo '<td class="grup" style="border:#'.$BgColor.' 1px solid;color:#'.$BgColor.';background-color:#'.$Color.';"
			ondblclick="edit2(\''.$ot['me'].'\',\'grupo\',this)" >';
			echo $ot['grupo'];
			echo '</td>';

			echo '<td class="sinplu"
			ondblclick="edit2(\''.$ot['me'].'\',\'alias_grupo\',this)">';
			echo $ot['alias_grupo'];
			echo '</td>';

			echo '<td class="sinplu"
			ondblclick="edit2(\''.$ot['me'].'\',\'seccion\',this)">';
			echo $ot['seccion'];
			echo '</td>';

			echo '<td
			ondblclick="edit2(\''.$ot['me'].'\',\'por_pagina\',this)">';
			echo $ot['por_pagina'];
			echo '</td>';

			echo '<td
			ondblclick="edit2(\''.$ot['me'].'\',\'por_linea\',this)">';
			echo $ot['por_linea'];
			echo '</td>';

			echo '<td class="sinplu"
			ondblclick="edit2(\''.$ot['me'].'\',\'nombre_singular\',this)">';
			echo $ot['nombre_singular'];
			echo '</td>';

			echo '<td class="sinplu"
			ondblclick="edit2(\''.$ot['me'].'\',\'nombre_plural\',this)">';
			echo $ot['nombre_plural'];
			echo '</td>';

			// echo '<td>';
			// echo '<a href="#" style="color:#111;" onclick="javascript:if(confirm(\'¿Está seguro que desea eliminar este objeto?\')){ eliminar_objeto(\''.$ot['me'].'\',this); } return false;" ><img src="img/ico_bomb.png" /></a>';
			// echo '</td>';
				
			echo '<td>';
			echo '<a href="maquina.php?accion=importdb&tablas='.$ot['tabla'].'" style="color:green;">▼imp</a>';
			echo '</td>';
			echo "</tr>";

			}

		}


		if($_GET['me']==''){

			foreach($tabla3 as $ta){
			  echo "<tr>";
			  echo "<td style='text-align:left;'>$row</td>"; $row++;
			  echo "<td></td>";
			  echo "<td style='text-align:righ;'>";
			  echo (in_array($ta,$tablas_multiopciones))?"<b>TABLA DE RELACIONES</b>":"";
			  echo "</td>";
			  echo (in_array($ta,$tablas_multiopciones))?"<td style='text-align:left;' class='small'><b><a style='color:red;'>".strtoupper($ta)."</a></b></td>":"<td style='text-align:left;'>".$ta." <span style='color:red;'>(".  contar($ta,"where 1") . ")</span></td>";
			  echo "<td></td>";
			  echo "<td><span class='creado'>creado</span> <a href='#' onclick='javascript:eliminar(\"".$ta."\",this,\"borrartabla\");return false;' >borrar</a></td>";
			  echo "<td></td>";
			  echo "</tr>";
			}

			// foreach($archivos6 as $ar){
			//   echo "<tr>";
			//   echo "<td style='text-align:left;'>$row</td>"; $row++;
			//   echo "<td></td>";
			//   echo "<td></td>";

			//   echo "<td style='text-align:left;'>".$ar."</td>";
			//   echo "<td></td>";
			//   echo "<td><span class='creado'>creado</span> <a href='#' onclick='javascript:eliminar(\"".$ar."\",this,\"borrararchivo\");return false;' >borrar</a></td>";
			//   echo "<td></td>";
			//   echo "<td></td>";
			//   echo "</tr>";
			// }

		}

		echo "</table>";


}

}
if($_GET['accion']=='borrarsesion' and $_POST['session']!=''){
	//session_start();
	unset($_SESSION[$_POST['session']]);
	unset($_COOKIES[$_POST['session']]);
	//redireccionar();
}
//INICIO
echo "<div class='div_bloque_cuerpo'>";
if($_GET['accion']=='bajarconfig' ){

	$Panel=parse_ini_file("../../panel/config/config.ini",true);
	//prin($Panel);
	$link_temp=$link;

	$link=mysql_connect ($Panel['LOCAL_MYSQL']['MYSQL_HOST'], $Panel['LOCAL_MYSQL']['MYSQL_USER'], $Panel['LOCAL_MYSQL']['MYSQL_PASS']) or die ('no se puedo conectar a la base de datos debido a: ' . mysql_error()." host:$MYSQL_HOST ,user:$MYSQL_USER ,pass:$MYSQL_PASS ,");
	mysql_select_db ($Panel['LOCAL_MYSQL']['MYSQL_DB'],$link);

	mysqli_query($link,"SET NAMES 'utf8'");

    $secure = select_dato("seguro","proyectos","where id='".$vars['INTERNO']['ID_PROYECTO']."'",0);


	$secure = ($secure==1)?1:0;

	$link=$link_temp;

	/////////////////////////////////

	$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21);

	$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);

	//echo $vars['REMOTE_FTP']['ftp_files_user']." | ".$vars['REMOTE_FTP']['ftp_files_pass']." | ".$vars['REMOTE_FTP']['ftp_files_host']."<br>";

	$directorio = dir("config/");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..'){

			if($fichero=='tablas.php' and $secure==1){

				continue;

			}


			echo "bajando ".$fichero."............";

			echo "{". str_replace("//","/",$vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero) . ")";

			echo (ftp_get($conn_id, "config/".$fichero, str_replace("//","/",$vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero), FTP_BINARY))?1:0;

			if($fichero=='tablas.php' and $secure==0){

				$sizetablas=filesize('config/tablas.php'); echo "($sizetablas bytes)";

				if($sizetablas<100){
					$tablacontent=between(implode(file('config/tablas.php')),"file_get_contents(\"","\"))");
					$f1=fopen('config/tablas.php',"w+");
					fwrite($f1,"<?php\n\n\n".file_get_contents($tablacontent[1])."\n\n\n?>");
					fclose($f1);
				}
			}
			echo "<br>";
		}
	}

	$directorio->close();
	redireccionar();

}

if($_GET['accion']=='subirconfig' ){

if($vars['INTERNO']['ID_PROYECTO']=="0"){

	$secure=0;

} else {

	$Panel=parse_ini_file("../../panel/config/config.ini",true);
	//prin($Panel);
	$link_temp=$link;

	$link=mysql_connect ($Panel['LOCAL_MYSQL']['MYSQL_HOST'], $Panel['LOCAL_MYSQL']['MYSQL_USER'], $Panel['LOCAL_MYSQL']['MYSQL_PASS']) or die ('no se puedo conectar a la base de datos debido a: ' . mysql_error()." host:$MYSQL_HOST ,user:$MYSQL_USER ,pass:$MYSQL_PASS ,");
	mysql_select_db ($Panel['LOCAL_MYSQL']['MYSQL_DB'],$link);

	mysqli_query($link,"SET NAMES 'utf8'");

    $secure = select_dato("seguro","proyectos","where id='".$vars['INTERNO']['ID_PROYECTO']."'",0);

//	prin($secure);

	$secure = ($secure==1)?1:0;

	$link=$link_temp;

}
	//prin($secure);

	@$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21,20);
	@$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);

	@ftp_mkdir($conn_id,$vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config");

	$directorio = dir("config/");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..' and $fichero!='tablas.php'){
			echo "subiendo ".$fichero."............"; flush();
			echo (ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero, "config/".$fichero, FTP_BINARY))?1:0;
			cambiar_permisos($vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero);

			echo "<br>";
		}
	}

	$directorio->close();

	if($secure==1){

	$f1=fopen("temporal_tablas.php","w+");
	fwrite($f1,"<?php eval(file_get_contents(\"http://crazyosito.com/firmas/".$vars['INTERNO']['CARPETA_PROYECTO']."/tablas\")); ?>");
	fclose($f1);

	echo "subiendo tablas.php............"; flush();
	echo (ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/tablas.php", "temporal_tablas.php", FTP_BINARY))?1:0;
//	cambiar_permisos($vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/tablas.php");
	echo "<br>";
	unlink("temporal_tablas.php");

	$taba=file("config/tablas.php");
	unset($taba[0]);
	unset($taba[sizeof($taba)-1]);

	$f1=fopen("temporal_tablas.php","w+");
	fwrite($f1,str_replace(array("<?php","?>"),array("",""),implode("",$taba)));
	fclose($f1);

		@$conn_id = ftp_connect($Panel['REMOTE_FTP']['ftp_files_host'],21,20);
		@$login_result = ftp_login($conn_id, $Panel['REMOTE_FTP']['ftp_files_user'], $Panel['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);
		@ftp_mkdir($conn_id,$Panel['REMOTE_FTP']['ftp_files_root']."/firmas/".$vars['INTERNO']['CARPETA_PROYECTO']);

		$fichero="tablas.php";
		echo "<br>subiendo ".$fichero." crazyosito............"; flush();
		echo (ftp_put($conn_id, $Panel['REMOTE_FTP']['ftp_files_root']."/firmas/".$vars['INTERNO']['CARPETA_PROYECTO']."/tablas", "temporal_tablas.php", FTP_BINARY))?1:0;
		echo "<br>";

	unlink("temporal_tablas.php");

	} else {

		$fichero="tablas.php";
		echo "<br>subiendo ".$fichero."............"; flush();
		echo (ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero, "config/".$fichero, FTP_BINARY))?1:0;
		cambiar_permisos($vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/config/".$fichero);
		echo "<br>";

	}

	redireccionar();

}
if($_GET['accion']=='importfromdump' ){
echo "<h2 style='color:#FFF;background-color:#003399;'>IMPORT FROM DUMP</h2>";

if($_POST['dump']!='' ){

	$MYSQL=explode(";
",$_POST['dump']);

	if(sizeof($MYSQL)>0){
		foreach($MYSQL as $sqle){
			if(trim($sqle)!='' and trim($sqle)!='#'){
				$oksql=mysqli_query($link,$sqle.";");
				echo ($oksql)?"<div>$sqle<span style='color:green;'>ok</span></div>":"<div><textarea style='width:94%;height:50px;'>$sqle</textarea><span style='color:red;'>ko</span></div>";
			}
		}
	}

} else {

$urlmysqldump="http://".$_SERVER['HTTP_HOST'].str_replace("maquina.php","mysqldump.php",$_SERVER['SCRIPT_NAME']).( (trim($_GET['tablas'])!='')?"?tablas=".$_GET['tablas']:'' );
echo "<form action='maquina.php?accion=importfromdump' method='post' >";
echo "<textarea style='width:100%;height:200px;' name='dump'>";
echo $_POST['dump'];
echo "</textarea>";
echo "<input type='submit' value='importar'>";
echo "</form>";

}

}

if($_GET['accion']=='makedump' ){

echo "<h2 style='color:#FFF;background-color:#003399;'>MAKE DUMP</h2>";

$urlmysqldump="http://".$_SERVER['HTTP_HOST'].str_replace("maquina.php","mysqldump.php",$_SERVER['SCRIPT_NAME']).( (trim($_GET['tablas'])!='')?"?tablas=".$_GET['tablas']:'' );
echo $urlmysqldump."<br>";
echo "<textarea style='width:100%;height:200px;'>";
echo file_get_contents($urlmysqldump);
echo "</textarea>";

}

if($_GET['accion']=='exportdb' ){

echo "<h2 style='color:#FFF;background-color:#003399;'>EXPORT DB</h2>";

$urlmysqldump="http://".$_SERVER['HTTP_HOST'].str_replace("maquina.php","mysqldump.php",$_SERVER['SCRIPT_NAME']).( (trim($_GET['tablas'])!='')?"?tablas=".$_GET['tablas']:'' );
echo $urlmysqldump."<br>";
$mysql=file_get_contents($urlmysqldump);
$f1=fopen("export.sql","w+");
fwrite($f1,$mysql);
fclose($f1);

$panel=$vars['GENERAL']['DIRECTORIO_PANEL'];

@$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21,20);
echo ($conn_id)?"host conectado":"host no conectado";
echo " : <i>".$vars['REMOTE_FTP']['ftp_files_host']."</i>";
echo "<br>";
@$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);
echo ($login_result)?"login exitoso":"login fallido";
echo " : <i>".$vars['REMOTE_FTP']['ftp_files_user'].",".$vars['REMOTE_FTP']['ftp_files_pass']."</i>";
echo "<br>";
echo (ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root'].$vars['GENERAL']['DIRECTORIO_PANEL']."/"."export.sql", "export.sql", FTP_BINARY))?"archivo subío exitosamente":"error al subir";
echo "<br>";

$urlmysqldumpprocess=$vars['REMOTE']['url_publica']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/processmysql.php";
$urlmysqldumpprocess=str_replace("http://","[http]",$urlmysqldumpprocess);
$urlmysqldumpprocess=str_replace("//","/",$urlmysqldumpprocess);
$urlmysqldumpprocess=str_replace("[http]","http://",$urlmysqldumpprocess);
echo $urlmysqldumpprocess."<br>";
$process=file_get_contents($urlmysqldumpprocess);
echo $process;
?>
<script>
if($('div_loading')){ $0('div_loading'); }
</script>
<?php

}

if($_GET['accion']=='importdb' ){

//echo $vars['INTERNO']['ID_PROYECTO']."|";

	if($vars['INTERNO']['ID_PROYECTO']!=''){
		$urlmysqldump="http://". ( (trim($_GET['domain'])!='')?$_GET['domain']."/".$vars['GENERAL']['DIRECTORIO_PANEL']:str_replace("http://","",$vars['REMOTE']['httpfiles'])."/".$vars['GENERAL']['DIRECTORIO_PANEL'] ) ."/mysqldump.php". ( (trim($_GET['tablas'])!='')?"?tablas=".$_GET['tablas']:'' );

		//prin($urlmysqldump);
		$mysqldump=file_get_contents($urlmysqldump);

		echo "<h2 style='color:#FFF;background-color:#003300;'>IMPORT DB</h2>";

		echo "<b>".$urlmysqldump."</b><br>";
		$delimeter="\n#\n#\n";
		$MYSQL=explode(";$delimeter",$mysqldump);
		if(sizeof($MYSQL)>0){
			foreach($MYSQL as $sqle){
				if(trim($sqle)!=''){
					$oksql=mysqli_query($link,$sqle.";");
					echo ($oksql)?"<div>$sqle<span style='color:green;'>ok</span></div>":"<div><textarea style='width:94%;height:50px;'>$sqle</textarea><span style='color:red;'>ko</span></div>";
				}
			}
		}
	}
	?>
    <script>
	if($('div_loading')){ $0('div_loading'); }
	</script>
    <?php

}
if($_GET['accion']=='creardbremota' ){
include("cpanel_mysql.class.php");


$db = new cpanel_db($vars['REMOTE_FTP']['ftp_files_host'],$vars['REMOTE_FTP']['ftp_files_user'],$vars['REMOTE_FTP']['ftp_files_pass']);
//create db
list($uno,$MYdb)=explode("_",$vars['REMOTE_MYSQL']['MYSQL_DB']);
if($db->createDb($MYdb)){
    echo "Db $MYdb Created";
} else {
    echo "Db $MYdb not created";
}
echo "<br>";

list($uno,$MYuser)=explode("_",$vars['REMOTE_MYSQL']['MYSQL_USER']);
//create user
if($db->createUser($MYuser,$vars['REMOTE_MYSQL']['MYSQL_PASS'])){
    echo "User $MYuser Created";
} else {
    echo "User $MYuser not created";
}
echo "<br>";

//grant access
if($db->grantPriv($MYdb,$MYuser)){
    echo 'Priv granted';
} else {
    echo 'Priv not granted';
}

echo "<br>";
//redireccionar_load_referer();
}

if($_GET['accion']=='updatecode' ){

	if($vars['INTERNO']['ID_PROYECTO']!=''){

		if($vars['INTERNO']['ID_PROYECTO']=='0'){

			$urll = $SERVER['BASE']."base/actualizar_panel.php?id=".$_GET['proy'];

		} else {

			$urll = str_replace($vars['INTERNO']['CARPETA_PROYECTO']."/","",$SERVER['BASE'])."base/actualizar_panel.php?id=".$vars['INTERNO']['ID_PROYECTO'];

		}

		echo file_get_contents($urll);
		
		if(!$_GET['reload']=='no'){

			redireccionar_load_referer();

		}
	}
}

if($_GET['accion']=='updatepanel' ){

	set_time_limit(0);
	$panel=$vars['GENERAL']['DIRECTORIO_PANEL'];
	@$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21,20);
	@$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);
	chdir("../");

	$dires=array("$panel/custom/","$panel/img/");
	foreach($dires as $dire){
	$dir_remo=$vars['REMOTE_FTP']['ftp_files_root'].$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire);
	echo "crear directorio ".$dir_remo."........"; flush();
	echo (ftp_mkdir($conn_id,$vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire)))?"ok":"ko";
	cambiar_permisos($vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire));

	echo "<br>";
	}
	//exit();

	$dires=array("$panel/custom/","$panel/img/");
				  //$dires=array("$panel/","$panel/lib/",,"$panel/img/mb_Components/","$panel/css/","panel/css/images/","panel/css/Other/","$panel/js/","$panel/removerbom/");
	foreach($dires as $dire){

	$dir_remo=$vars['REMOTE_FTP']['ftp_files_root'].$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire);
	echo "crear directorio ".$dir_remo."........"; flush();
	echo (ftp_mkdir($conn_id,$vars['REMOTE_FTP']['ftp_files_root']."/".$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire)))?'ok':'ko';
	echo "<br>";


	$directorio = dir("$dire/");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..'  and !is_dir($dire.$fichero) ){
			echo "subiendo ".$dire.$fichero."............"; flush();
			echo (ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root'].$vars['GENERAL']['DIRECTORIO_PANEL']."/".str_replace("$panel/","",$dire).$fichero, $dire.$fichero, FTP_BINARY))?1:0;
			echo "<br>";
		}
	}
	$directorio->close();
	}
	chdir("$panel");

	//redireccionar_load_referer();
	?>
    <script>
	if($('div_loading')){ $0('div_loading'); }
	</script>
    <?php


}

echo "</div>";
//FIN
?>

<?php

if($_GET['me']==''){
?>
<style>
.codigo_sql {
background-color:#333333;
clear:left;
color:#FFFFFF;
font-size:11px;
height:113px;
width:99%;
}
</style>
<?php
if($_POST['consulta']!=''){
$consultasA=explode(";",$_POST['consulta']);
foreach($consultasA as $sqle){
echo "<div style='margin-bottom:15px;'>".nl2br(str_replace(";;",";",$sqle.";"))."<br>". ( (mysqli_query($link,$sqle.";"))?"<b style='color:green;'>OK</b>":"<b style='color:red;'>KO</b>" )."</div>";
}

if($_GET['accion']!='config'){
?>
<div style='margin:10px 0 1px; font-size:10px;'>Mysql</div>
<form action="maquina.php" method="post">
<div class="codigo_areas" id="codigo_area_matriz" >
	<textarea id="codigo_sql" class="codigo_sql" style="height:20px;" onclick="this.setStyles({'height':'80px'});this.focus();" name="consulta"></textarea>
</div>
<input value="enviar query" onclick="enviar_query();" type="submit"  />
</form>
<?php
}
}
}
if($_GET['me']!=''){

	$all=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

	echo "<div style='margin-bottom:10px;'>
	<a style='margin-left:10px;font-size:10px;' href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=truncatetable'>truncate tabla y borrar archivos de fotos</a>
	</div>";

	$concon=contar($all['tabla'],"where 1",0);

	$blocs=ceil($concon/$POR_PAGE);

	//$items=select($all['id'].",".$all['fcr'].",".$all['fed'].",".$imagen,$all['tabla'],"where 1",0);
	//prin($items);
	echo "<div>por página";
	echo "<input type='text' value='$POR_PAGE' id='porpage' size='4'>";
	echo "<input type='submit' value='actualizar paginación' onclick='cambiar_paginacion();'>";
	echo "</div>";
	echo "<script>
	function cambiar_paginacion(){
	new Request({url:\"ajax_change_cookie.php?var=".$_GET['me']."_porpage&val=\"+\$('porpage').value+\"&ajax=1\", method:'get', onSuccess:function() {
		location.href='maquina.php?me=".$_GET['me']."';
	 } } ).send();
		}
	</script>
	";
	echo "<table class='paginac'>";
	echo "<tr><td>show fotos </td>";
	for($i=1;$i<=$blocs;$i++){
	echo "<td><a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=showimagenes&bloc=".$i."'>".$i."</a></td>";
	}
	echo "</td></tr>";
	echo "<tr><td>show fotos<br> verificando<br> dimensiones </td>";
	for($i=1;$i<=$blocs;$i++){
	echo "<td><a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=showimagenes&verificar=1&bloc=".$i."1'>".$i."</a></td>";
	}
	echo "</tr>";
	echo "<tr><td>resample fotos </td>";
	for($i=1;$i<=$blocs;$i++){
	echo "<td><a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=resample&bloc=".$i."'>".$i."</a></td>";
	}
	echo "</tr>";

	$hay_fuente=(isset($objeto_tabla[$_GET['me']]['campos']['source']))?1:0;
	if($hay_fuente){
	echo "<tr><td>importar fotos<br> desde fuente </td>";
	for($i=1;$i<=$blocs;$i++){
	$falta=0;
	$ccc=select("file",$all['tabla'],"where 1 limit ".( ($i-1)*$POR_PAGE ).",$POR_PAGE");
	$ccct=sizeof($ccc);
	foreach($ccc as $cc){  if($cc['file']==''){ $falta++; } }
	$full=($falta==0)?1:0;
	echo "<td><a style='color:".(($full)?'green':'red').";' ".(($full)?'':"title='faltan $falta'")." href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=resample&importph=1&bloc=".$i."'>".$i."</a></td>";
	}
	echo "</tr>";
	}
	echo "</table>";

	echo "<div><a href='".$SERVER['BASE'].$SERVER['ARCHIVO']."?me=".$_GET['me']."&accion=update_tags'>Update Tags</a></div>";


	$tavla=$objeto_tabla[$_GET['me']]['tabla'];
	foreach($objeto_tabla[$_GET['me']]['campos'] as $campx){
		if(
			$campx['queries']=='1' and 
			in_array($campx['tipo'],array('hid','com'))
			){
		$xqueries[]=$campx['campo'];
		}
	}
	echo "<h2>INDEXES</h2>";
	foreach($xqueries as $xquer){
		echo 'ALTER TABLE `'.$tavla.'` ADD INDEX `'.$xquer.'` (`'.$xquer.'`);<br>';
	}
	echo '<br>';

}

if($_GET['accion']=='update_tags'){

	//update_chains($objeto_tabla[$_REQUEST['me']],48); exit();

	$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_REQUEST['me']]);
	$tbl		=	$datos_tabla['tabla'];
	$tbcampos	=	$datos_tabla['form'];
	$id			=	$datos_tabla['id'];

	//prin(3);
	$items= select(
        $id
        ,$tbl
        ,"where 1"
        ,0
        );
	foreach($items as $item){
		update_tags($objeto_tabla[$_REQUEST['me']],$item[$id]);
	}
	redireccionar_load_referer();

}

?>

<?php if($_GET['accion']=='config'){ ?>
<?php
include("config/tablas.php");
$objeto_tabla_0=$objeto_tabla;
$mostrar_menu=1;
$objeto_tabla2=$objeto_tabla;
foreach($objeto_tabla as $to=>$oott){
	if($oott['grupo']!='sistema'){
		unset($objeto_tabla2[$to]);
	}
}
$objeto_tabla=$objeto_tabla2;
include("menu.php");
$objeto_tabla=$objeto_tabla_0;
?>
<?php
/*
$status = "";
if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo
    $tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
	echo file_exists($_FILES['archivo']['tmp_name'])?"existe ".$_FILES['archivo']['tmp_name']:"no existe ".$_FILES['archivo']['tmp_name'];
	echo "<br>";
	echo "<i>".filesize($_FILES['archivo']['tmp_name'])."</i><br>";
    if ($archivo != "") {
        // guardamos el archivo a la carpeta files
        //if (copy($_FILES['archivo']['tmp_name'],$archivo)) {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'],$archivo)) {
            $status = "Archivo subido: <b>".$archivo."</b>";
        } else {
            $status = "Error al subir el archivo ".$_FILES['archivo']['tmp_name']."->".$archivo;
        }
    } else {
        $status = "Error al subir archivo 2";
    }
	echo "<b>".$status."</b><br>";
	@unlink($archivo);
}

?>
<a href="maquina.php?config=edit">Verificar upload</a><br />
<form action="maquina.php?config=edit&uploading=1" method="post" enctype="multipart/form-data" id="form_prueba_upload">
  <input name="archivo" type="file" size="35" />
  <input name="enviar" type="submit" value="Upload File" />
  <input name="action" type="hidden" value="upload" />
</form>
<?php
*/





$EXCEPCIONES['GENERAL']=array('meta_keyword','ESTILO_2','MODO_LOCAL_ARCHIVOS_REMOTOS
','meta_descripcion','c_interfaceLang','BG_COLOR_2','DIRECTORIO_IMAGENES','DIR_IMG_TEMP','DIR_IMG_UPLOAD','DIR_CUSTOM','DIRECTORIO_PANEL');
//$EXCEPCIONES['INTERNO']=array('ID_PROYECTO','CARPETA_PROYECTO');
$EXCEPCIONES['INTERNO']=array('CARPETA_PROYECTO');
$EXCEPCIONES['LOCAL_FTP']=array('ftp_files_user','ftp_files_pass','ftp_files_root','ftp_files_host');


$vars=parse_ini_file($PATH_CUSTOM."config/config.ini",true);
echo "<div style='padding-left:10px;'>config.ini $get_num_vars</div>";
echo "<table class='config_table'>";
echo "<tr><th colspan=2 style='background:none;color:#000;'>Editar archivo config.ini</td><td align=right style='border:0;'><a href='?config=edit'>refresh</a></td></tr>";
echo "<tr><td colspan='3' height=10></td></tr>";

$GENERAL=$vars['GENERAL'];
unset($vars['GENERAL']);
$vars=array_merge(array("GENERAL"=>$GENERAL),$vars);

foreach($vars as $seccion=>$variables){


echo "<tr><th colspan='3' ";
switch($seccion){
	case "LOCAL":case "LOCAL_FTP":case "LOCAL_MYSQL": echo "style='background-color:#003300;'"; break;
	case "REMOTE":case "REMOTE_FTP":case "REMOTE_MYSQL": echo "style='background-color:#003399;'"; break;
}
echo ">$seccion</th></tr>";

foreach($variables as $name=>$value){
if(in_array($name,array(
						"BG_COLOR_1",
						"BG_COLOR_2",
						"BG_COLOR_4",
						"LINK_COLOR",
						"menu_padding_lados",
						"meta_descripcion",
						"meta_keyword",
						"meta_keyword",
						"c_interfaceLang",
						'ESTADISTICAS',
						'dominio_estadisticas',
						'meta_title',
						'PERMISO_ESPECIALES',
						'titulo_font_size',
						'titulo_letter_spacing',
						'MODO_LOCAL_ARCHIVOS_REMOTOS',
						))){
continue;
}
//if(sizeof($EXCEPCIONES[$seccion])){
if(in_array($name,$EXCEPCIONES[$seccion])){
$excepcion="style='display:none;'";
$excepcion1="";
$excepcion2="style='color:#ccc;'";
} else {
$excepcion="";
$excepcion1="  onclick=\"javascript:edit_ini('".$seccion."_".$name."');\"   ";
$excepcion2="";
}
//}

echo "<tr><td class='name' $excepcion2 >";
if(in_array($name,array("BG_COLOR_1","BG_COLOR_2","BG_COLOR_3","BG_COLOR_4","LINK_COLOR"))){
echo "<span style='float:right;font-size:26px;background-color:#".$value.";color:#".$value.";width:10px;height:10px;border:1px solid #000000;'></span>";
}
echo $name;
echo "</td>
<td class='value'>
<li $excepcion1 $excepcion2 id='span_".$seccion."_".$name."'>$value</li>";
switch($name){
// case "FILE_DEFAULT":
// echo "<select id='input_".$seccion."_".$name."' style='width:100%;display:none;' >";
// foreach($objeto_tabla as $ot){
// if( $ot['menu']=='1' or ($ot['archivo_hijo']=='' and $ot['menu_label']!='') ){
// $archivo1=$ot['archivo'].".php";
// echo "<option ".( ($archivo1==$value)?"selected":"")." value='".$archivo1."'>".$archivo1." - ".$ot['menu_label']."</option>";
// }
// }
// echo "</select>";
// break;
case "BG_IMAGE":
	if($Local){
	echo "<select id='input_".$seccion."_".$name."' style='width:100%;display:none;'
		onchange='setbg(this.value);'
		onkeyup='setbg(this.value);'
		>";
		$CLI=($vars['INTERNO']['ID_PROYECTO']=="0")?'':'../../panel/';
		$directorio_s = dir($CLI."img/bgs/");

		while($fichero=$directorio_s->read()) {
			if($fichero!='.' and $fichero!='..'  and !is_dir($CLI."img/bgs/".$fichero) ){
				$ooppp[$fichero]= "<option ".( ("img/bgs/".$fichero==$value)?"selected":"")." value='"."img/bgs/".$fichero."'>img/bgs/".$fichero."</option>";
			}
		}
		$directorio_s->close();
	ksort($ooppp);
	echo implode("",$ooppp);
	echo "</select>";
}
break;
case "fotos_de_prueba":
echo "<select id='input_".$seccion."_".$name."' style='width:100%;display:none;' >";
$directorio = dir("lib/fotos_prueba/");
while($fichero=$directorio->read()) {
	if($fichero!='.' and $fichero!='..'){
		$librerias_fotos[]=$fichero;
	}
}
foreach($librerias_fotos as $archivo1){
echo "<option ".( ($archivo1==$value)?"selected":"")." value='".$archivo1."'>".$archivo1."</option>";
}
echo "</select>";
break;
//case "BG_COLOR_3": echo "<input id='input_".$seccion."_".$name."' value='$value' type='text' style='width:100%;display:none;'/>"; break;
default:
echo "<input id='input_".$seccion."_".$name."' value='$value' type='text' style='width:100%;display:none;'/>";
break;
}
echo "</td>
<td>
<a $excepcion id='editar_".$seccion."_".$name."' onclick=\"javascript:edit_ini('".$seccion."_".$name."'); return false;\" rel='nofollow' href='#'>editar</a>
<a style='display:none;' id='guardar_".$seccion."_".$name."' onclick=\"javascript:guardar_ini('".$seccion."','".$name."'); return false;\" rel='nofollow'  href='#'>guardar</a>
<a style='display:none;' id='cancelar_".$seccion."_".$name."' onclick=\"javascript:cancel_ini('".$seccion."_".$name."'); return false;\" rel='nofollow' href='#'>cancelar</a>
</td>
</tr>";
//}
}
}
echo "</table>";
?>
<script>
var editing='';
function edit_ini(sena){
if($('span_'+editing)){
cancel_ini(editing);
}
$0('span_'+sena);
$('input_'+sena).value=$('span_'+sena).innerHTML;
$1('input_'+sena);
$0('editar_'+sena);
$1('cancelar_'+sena);
$1('guardar_'+sena);
editing=sena;
}
function cancel_ini(sena){
$1('span_'+sena);
$0('input_'+sena);
$1('editar_'+sena);
$0('cancelar_'+sena);
$0('guardar_'+sena);
}
function setbg(bg){
$(document.body).setStyles({'background-image':'url(http://crazyosito.com/'+bg.replace('img/','')+')'});
}
function guardar_ini(se,na){
var sena=se+"_"+na;
$('span_'+sena).innerHTML=$('input_'+sena).value;
$0('cancelar_'+sena);
$0('guardar_'+sena);

	datos = {
				seccion : se,
				name	: na,
				value	: $v('input_'+sena)
			};
	new Request({url:"lib/edit_ini.php", method:'post', data:datos, onSuccess: function(eee){

	cancel_ini(sena);

	} } ).send();

}
</script>

<?php } elseif($_GET['accion']=='phpinfo'){

if(function_exists("apache_get_modules")){
echo "<style> .lista_modulos { list-style:decimal; } </style>";
echo "<div style='clear:left;'>";
echo "<h1>MÃ³dulos de Apache</h1><ul style='padding-left:30px;'>";
$modulos=apache_get_modules();
foreach($modulos as $modulo){
echo "<li class='lista_modulos'>";
switch($modulo){
case "mod_rewrite": echo "<span style='color:red;'>".$modulo."</span>"; break;
case "mod_expires": echo "<span style='color:blue;'>".$modulo."</span>"; break;
default:
echo $modulo;
break;
}
echo "</li>";
}
echo "</ul>";

echo "</div>";
}

//phpinfo();
phpinfo();

foreach($_SERVER as $AAAA=>$BBBB){

echo "<div><b style='width:200px; float:left;'>$AAAA</b>: $BBBB</div>";

}

} else { ?>


<?php if($_GET['me']!=''){ ?>

<?php

if( $_GET['me']!='' and $_GET['accion']=='resample' ){

	$ftp_files_host=$vars['REMOTE_FTP']['ftp_files_host'];
	$ftp_files_user=$vars['REMOTE_FTP']['ftp_files_user'];
	$ftp_files_pass=$vars['REMOTE_FTP']['ftp_files_pass'];
	$ftp_files_root=$vars['REMOTE_FTP']['ftp_files_root'];

	$datos_tabla=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

	$imagen=$datos_tabla['imagenes'][0];

	/*
	$hay_fuente=(isset($objeto_tabla[$_GET['me']]['campos']['source']))?1:0;
	$items=select((($hay_fuente)?'source,':'').$datos_tabla['id'].",".$datos_tabla['fcr'].",".$datos_tabla['fed'].",".$imagen,$datos_tabla['tabla'],"where id='".$_GET['id']."'",0);
	*/
	$hay_fuente=(isset($objeto_tabla[$_GET['me']]['campos']['source']))?1:0;

	$items=select((($hay_fuente)?'source,':'').$datos_tabla['id'].",".$datos_tabla['fcr'].",".$datos_tabla['fed'].",".$imagen,$datos_tabla['tabla'],"where 1 limit ".( ($_GET['bloc']-1)*$POR_PAGE ).",$POR_PAGE",0);

	$NUM=0;

	foreach($items as $tt=>$item){

		if(1){

			foreach($datos_tabla['imagenes'] as $imagen){

				$tamas=explode(",",$datos_tabla[$imagen]['tamanos']);

				$num_tamas=sizeof($tamas);

				$borrar_despues=1;


					$Original=get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],'');
					$oo=fileExists($Original);
					if(!$oo){
						$nt=$num_tamas-1;
						$Original=get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],$nt);
						$uu=fileExists($Original);
						if(!$uu){
							if($hay_fuente){
								$Original=$item['source'];
								$ii=fileExists($Original);
								if(!$ii){ continue; }
								else { $borrar_despues=0; }
							}
						} else { continue; }
					} else {
					if($IMPORTAR){ $NUM++; echo "<div style='border-bottom:1px solid #ccc;'>$NUM saltamos porque ya existe</div>"; continue; }
					}


				for($i=1;$i<=$num_tamas+1;$i++){
				$Ima[$i]=str_replace("//","/",$ftp_files_root.str_replace("$httpfiles","",get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],$i)));
				}
				$NUM++;
				$OKO=grabar_imagen("upload_".$imagen,$Original,$datos_tabla['tabla'],$_GET['me'],str_replace("\\","",$item[$datos_tabla['id']]));
				echo "<div style='border-bottom:1px solid #ccc;'>".$NUM." resampling ".get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],''). " ".(($OKO)?'<span style="color:green;">OK</span>':'<span style="color:red;">KO</span>')."</div>";
				$Imas[]=$Ima;

				if($borrar_despues)
				eliminar_imagenes_from_array($Imas);

				unset($Ima);
				unset($Imas);

			}

		}

	}


}

if( $_GET['me']!='' and $_GET['accion']=='showimagenes' ){


	$all=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

	$hay_fuente=(isset($objeto_tabla[$_GET['me']]['campos']['source']))?1:0;
//	$hay_fuente=0;

	foreach($all['imagenes'] as $imagen){

		$items=select((($hay_fuente)?'source,':'').$all['id'].",".$all['fcr'].",".$all['fed'].",".$imagen,$all['tabla'],"where 1 limit ".( ($_GET['bloc']-1)*$POR_PAGE ).",$POR_PAGE",0);

		$tamas=explode(",",$all[$imagen]['tamanos']);

		$num_tamas=sizeof($tamas);

		foreach($items as $r=>$item){

			//$Original=str_replace('_1.','.',get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],'1'));

			if($hay_fuente) $Ima['source']=$item['source'];

			$Ima['original']=str_replace('_1.','.',get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],'1'));

			for($i=1;$i<=$num_tamas;$i++){
			$Ima[$i]=get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],$i);
			}
			//prin($Original);
			//echo "update $Original<br>";
			//prin($imagen.",".$Original.",".$all['tabla'].",".$_GET['me'].",".str_replace("\\","",$item[$all['id']])."<br>");

			//prin($Ima);
			$Imas[$item[$all['id']]]=array('imagenes'=>$Ima,'file'=>$item[$imagen]);

			unset($Ima);


		}


		$NNN=0;
		if($hay_fuente) $campos_extras[]='fuente';
		$campos_extras[]='original';
		$tamas=array_merge($campos_extras,$tamas);

		echo "<div class='importartodo'><a onclick='importartodo();' style='float:right;'>importar todo</a></div>
		";


		echo "<table width='100%' class='photos'>";
		echo "<tr>";
		echo "<td class='phead' >&nbsp;</td>";
		foreach($tamas as $tami){
		echo "<td class='phead' valign=middle><b>$tami</b></td>";
		}
		echo "<td class='phead'></td>";
		echo "<td class='phead'></td>";
		echo "</tr>";



		foreach($Imas as $r=>$Imas2){
		echo "<tr id='ima_".$r."' >";
		$NNN++;
		echo "<td valign=middle><b>$NNN</b> - $r</td>";
//		if($hay_fuente) echo "<td style='border:1px solid #000;font-size:10px;font-weight:bold;' valign=middle align=center>".$Imas2['source']."</td>";
		foreach($Imas2['imagenes'] as $ro=>$II){

		if($_GET['verificar']=='1'){
			list($ancho, $alto, $tipo, $atributos) = getimagesize($II);
			if($ro==0){	$anchoOriginal=$ancho;	$altoOriginal =$alto; $chek="#FFF"; $bordeco="#000"; }
			else {
				$bordeco="#FFF";
				list($an,$al)=explode("x",$tamas[$ro]);
				if(
				//	($anchoOriginal>$an and $altoOriginal>$al) and
					($an==$ancho or $al==$alto)
				){ $chek="style='background-color:#C2F1BF;'"; } else { $chek="style='background-color:#C6795D;'"; }
			}
		}
		echo "<td $chek; valign='middle'>";
		if($_GET['verificar']=='1'){
			if($chek!="#FFF"){
				echo "<div><b>".$ancho."x".$alto."</b> en ".$an."x".$al."</div>";
			} else {
				echo "<div>".$ancho."x".$alto."</div>";
			}
		}
		if($ro=='source'){
		echo $II;
		}else{
		echo "<img src='".$II."'>";
		}
		echo "</td>";
		}
		echo "<td valign=middle><a href='#' onclick=\"fiximage('$r'); return false;\"
		".(($Imas2['file']=='')?" class='forimport' rel='$r' ":'')."
		>".(($Imas2['file']=='')?'import':'fix')."</a></td>";

		echo "<td valign=middle><a href='#' onclick=\"delimage('$r'); return false;\"
		>x</a></td>";

		echo "</tr>";
		}


	    echo "</table>";

	}

}

$all=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

?>
<script>

function delimage(i){

	var children = $('ima_'+i).getChildren();
	children.each(function(el){
		el.setStyles({'background-color':'#FB5269'});
	});
	datos = { v_d  : "where id='"+i+"'",	v_o	: '<?php echo $_GET['me']?>' };
	new Request({url:"ajax_sql.php?f=delete&debug=0", method:'post', data:datos, onSuccess: function(json){

		$('ima_'+i).destroy();

	} } ).send();

}

function fiximage(i){
	var children = $('ima_'+i).getChildren();
	children.each(function(el){
		el.setStyles({'background-color':'#6AFB52'});
	});
	datos = { id  : i,	me	: '<?php echo $_GET['me']?>' <?php echo ($_GET['verificar']=='1')?",verificar:'1'":""; ?> };
	new Request({url:"fiximage.php", method:'get', data:datos, onSuccess: function(eee){
		var prev = $('ima_'+i).getPrevious();
		$('ima_'+i).destroy();
		var tr = new Element('tr', {
			id:'ima_'+i
		});
		tr.inject(prev,'after');
		$('ima_'+i).innerHTML=eee;
	} } ).send();

}

function importartodo(){
	var a=0;
	var i=0;
	$$('.forimport').each(function(ee) {
		if(a==0){
		i=ee.getProperty('rel');
		a++;
		}
	});
	if(i!=0){

	var children = $('ima_'+i).getChildren();
	children.each(function(el){
		el.setStyles({'background-color':'#6AFB52'});
	});
	datos = { id  : i,	me	: '<?php echo $_GET['me']?>' <?php echo ($_GET['verificar']=='1')?",verificar:'1'":""; ?> };
	new Request({url:"fiximage.php", method:'get', data:datos, onSuccess: function(eee){
		var prev = $('ima_'+i).getPrevious();
		$('ima_'+i).destroy();
		var tr = new Element('tr', {
			id:'ima_'+i
		});
		tr.inject(prev,'after');
		$('ima_'+i).innerHTML=eee;

		importartodo();

	} } ).send();

	}


}

</script>
<?php

foreach($objeto_tabla[$_GET['me']]['campos'] as $ca){


	if(
	($ca['campo']!=$all['pos'])and
	($ca['campo']!=$all['vis'])and
	($ca['campo']!=$all['id'])and
	($ca['campo']!=$all['fed'])and
	($ca['campo']!=$all['fcr'])
	){
		if($ca['constante']!='1'){
			$gon[]=$ca;
			//echo $ca['campo']."<br>";
		}
	}


	if(($ca['campo']!=$all['pos'])and($ca['campo']!=$all['vis'])and($ca['campo']!=$all['id'])){
		if( ($ca['campo']==$all['fed']) or ($ca['campo']==$all['fcr']) ){
			$li6A[]="'".$ca['campo']."'=>\"now()\"";
		}else{
			$li6A[]="'".$ca['campo']."'=>\"\$".strtoupper($ca['campo'])."\"";
		}
	}

	if(($ca['campo']!=$all['fcr'])and($ca['campo']!=$all['pos'])and($ca['campo']!=$all['vis'])and($ca['campo']!=$all['id'])){
		if(($ca['campo']==$all['fed'])){
			$li6B[]="'".$ca['campo']."'=>\"now()\"";
		}else{
			$li6B[]="'".$ca['campo']."'=>\"\$".strtoupper($ca['campo'])."\"";
		}	}

}

//prin($gon);

foreach($all['form'] as $ca){

	if(($ca['campo']!=$all['fed'])and($ca['campo']!=$all['pos'])and($ca['campo']!=$all['vis'])){
	$li6[]=$ca['campo'];
	}
	if(($ca['campo']!=$all['fed'])and($ca['campo']!=$all['id'])and($ca['campo']!=$all['pos'])and($ca['campo']!=$all['vis'])){
	$li7[]=$ca['campo'];
	}

}

$li6=array_merge(array($all['id']),$li6,array($all['fcr']));

?>
<style>
.codigo_ejemplo { clear:left; width:99%; height:113px; color:#FFFFFF; background-color:#333; font-size:11px; }

.codigos_copiar a {
background-color:#062539;
color:#FFFFFF;
float:left;
font-weight:bold;
margin:0 2px 3px 0;
padding:3px;
font-size:10px;
}
.codigos_copiar a.selected { color:#FFED00; }
</style>
<script>
function recalcular(txt){
var arrtxt= new Array();
var txtv=txt.value;
arrtxt=txtv.split("\n");
var txtheight=arrtxt.length;
txt.setStyles({'height':txtheight*15});
}
function show_code(tab){
$$('.codigo_tabs').removeClass('selected');
$$('.codigo_areas').setStyles({'display':'none'});
if(tab){
$('codigo_tab_'+tab).addClass('selected');
$('codigo_area_'+tab).setStyles({'display':''});
recalcular($('codigo_text_'+tab));
}
}

window.addEvent((window.ie)?'load':'domready',function(){
//recalcular($('codigo_text_matriz'));
});
</script>
<div class="cuadro_codigo bloque codigos_copiar" style="float:none; clear:none;" >
<?php
$imagenes2=array();
$imagenes=$all['imagenes'];
if(sizeof($imagenes)>0){
	foreach($imagenes as $imagen){
		$imagenes2[$imagen]=$all[$imagen];
	}
}
//echo "|".$all['archivo_hijo']."|";
foreach($objeto_tabla as $ooo => $ttt){
if($ttt['archivo']==$all['archivo_hijo']){

$all2=procesar_objeto_tabla($objeto_tabla[$ttt['me']]);

foreach($all2['form'] as $ca){
	if(($ca['campo']!=$all2['fed'])and($ca['campo']!=$all2['pos'])and($ca['campo']!=$all2['vis'])){
	$li62[]=$ca['campo'];
	}
	if(($ca['campo']!=$all2['fed'])and($ca['campo']!=$all2['id'])and($ca['campo']!=$all2['pos'])and($ca['campo']!=$all2['vis'])){
	$li72[]=$ca['campo'];
	}
}

$li62=array_merge(array($all2['id']),$li62,array($all2['fcr']));

}
}
//print_rr($all2);
?>
	<div style="position:relative; height:auto; padding:2px 60px 10px 3px; float:left;">

    <a href="#" class="codigo_tabs selected" id="codigo_tab_matriz" rel="nofollow" onclick="javascript:show_code('matriz'); return false;">MATRIZ</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_matriz_paginada" rel="nofollow" onclick="javascript:show_code('matriz_paginada'); return false;">MATRIZ PAGINADA</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_fila" rel="nofollow" onclick="javascript:show_code('fila');  return false;" >FILA</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_dato" rel="nofollow" onclick="javascript:show_code('dato');  return false;" >DATO</a>

    <a href="#" class="codigo_tabs" id="codigo_tab_sub_select" rel="nofollow" onclick="javascript:show_code('sub_select');  return false;" >SUB_SELECT</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_sub_select_fila" rel="nofollow" onclick="javascript:show_code('sub_select_fila');  return false;" >SUB_SELECT_FILA</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_sub_select_dato" rel="nofollow" onclick="javascript:show_code('sub_select_dato');  return false;" >SUB_SELECT_DATO</a>

    <a href="#" class="codigo_tabs" id="codigo_tab_items" rel="nofollow" onclick="javascript:show_code('items'); return false;" >ITEMS</a>

    <a href="#" class="codigo_tabs" id="codigo_tab_fecha_formato" rel="nofollow" onclick="javascript:show_code('fecha_formato'); return false;" >FECHA_FORMATO</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_limit_string" rel="nofollow" onclick="javascript:show_code('limit_string'); return false;" >LIMIT_STRING</a>

    <a href="#" class="codigo_tabs" id="codigo_tab_contar" rel="nofollow" onclick="javascript:show_code('contar');  return false;" >CONTAR</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_insert" rel="nofollow" onclick="javascript:show_code('insert');  return false;" >INSERT</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_update" rel="nofollow" onclick="javascript:show_code('update'); return false;" >UPDATE</a>
    <a href="#" class="codigo_tabs" id="codigo_tab_delete" rel="nofollow" onclick="javascript:show_code('delete'); return false;" >DELETE</a>

    <a href="#" class="codigo_tabs" id="codigo_tab_formulario_publico" rel="nofollow" onclick="javascript:show_code('formulario_publico'); return false;" >FORMULARIO PUBLICO</a>
    <a href="#" style=" position:absolute; right:4px; top:2px;" rel="nofollow" onclick="javascript:show_code(); return false;" >CERRAR</a>

    <div style="clear:both; height:1px; font-size:1px;">&nbsp;</div>

	</div>
    <div class="codigo_areas" id="codigo_area_matriz" >
	<textarea id="codigo_text_matriz" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();recalcular($('codigo_text_matriz'));" readonly="true" style="height:50px;">$items= select(
        "<?php echo implode($li6,",")?>"
        ,"<?php echo $all['tabla']?>"
        ,"where 1 and  <?php echo ($all['vis']!='')?$all['vis']."='1'":""?> order by <?php echo $all['id']?> asc limit 0,100"
        ,0
        <?php if($all['archivo_hijo']!='' or sizeof($imagenes2)>0 ){ ?>,array(
        	<?php if($all['archivo_hijo']!=''){ ?>'sub_select'=>array('sub_select'=>array(
                			    'campos'=>"<?php echo implode($li62,",")?>"
                                	    ,'tabla' =>"<?php echo $all2['tabla']?>"
                                	    ,'donde' =>"where <?php echo $all2['foreig']?>='{<?php echo $all2['id']?>}' and <?php echo ($all2['vis']!='')?$all2['vis']."='1'":""?> order by <?php echo $all2['id']?> asc limit 0,100"
                                       	    ,'debug' =>0
                                            )
                                        )<?php $coma0=","; }
				$ttff=1;
				foreach($imagenes2 as $campo=>$imageD){
				$sufijo=($ttff==1)?"":"_".$ttff;
				$ttff++;
				$tot_tam=sizeof(explode(",",$imageD['tamanos']));
				$numArr=range(1,$tot_tam);
				$numStr=implode(",",$numArr);
               ?>

                <?php echo $coma0;?>'carpeta<?php echo $sufijo;?>'=>'<?php echo $imageD['carpeta'];?>'
                ,'tamano<?php echo $sufijo;?>'=>'[<?php echo $numStr;?>]'
                ,'dimensionado<?php echo $sufijo;?>'=>'[<?php echo $imageD['tamanos'];?>]'
                ,'centrado<?php echo $sufijo;?>'=>'[0|1]'
                ,'get_atributos<?php echo $sufijo;?>'=>array('get_atributos'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            ,'dimensionado'=>'{dimensionado<?php echo $sufijo;?>}'
                                            ,'centrado'=>'{centrado<?php echo $sufijo;?>}'
                                            )
                                        )
                ,'get_archivo<?php echo $sufijo;?>'=>array('get_archivo'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            )
                                        )
        <?php } ?>

              )
        <?php } ?>);</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_matriz_paginada" style="display:none;" >
	<textarea id="codigo_text_matriz_paginada" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();recalcular($('codigo_text_matriz'));" readonly="true" style="height:50px;">$matriz = paginacionnumerada(
        array(
            'separador'=>""
            ,'porpag'=>"10"
            ,'anterior'=>"&laquo;anterior"
            ,'siguiente'=>"siguiente&raquo;"
            ,'enlace'=>"?pag="
            ,'procesar_url'=>[0|1]
            //,'onclick'=>"?pag="
        )
        ,"<?php echo implode($li6,",")?>"
        ,"<?php echo $all['tabla']?>"
        ,"where 1 and  <?php echo ($all['vis']!='')?$all['vis']."='1'":""?> order by <?php echo $all['id']?> asc"
        ,0
        <?php if($all['archivo_hijo']!='' or sizeof($imagenes2)>0 ){ ?>,array(
        	<?php if($all['archivo_hijo']!=''){ ?>'sub_select'=>array('sub_select'=>array(
                			    'campos'=>"<?php echo implode($li62,",")?>"
                                	    ,'tabla' =>"<?php echo $all2['tabla']?>"
                                	    ,'donde' =>"where <?php echo $all2['foreig']?>='{<?php echo $all2['id']?>}' and <?php echo ($all2['vis']!='')?$all2['vis']."='1'":""?> order by <?php echo $all2['id']?> asc limit 0,100"
                                       	    ,'debug' =>0
                                            )
                                        )<?php $coma0=","; }
				$ttff=1;
				foreach($imagenes2 as $campo=>$imageD){
				$sufijo=($ttff==1)?"":"_".$ttff;
				$ttff++;
				$tot_tam=sizeof(explode(",",$imageD['tamanos']));
				$numArr=range(1,$tot_tam);
				$numStr=implode(",",$numArr);
               ?>

                <?php echo $coma0;?>'carpeta<?php echo $sufijo;?>'=>'<?php echo $imageD['carpeta'];?>'
                ,'tamano<?php echo $sufijo;?>'=>'[<?php echo $numStr;?>]'
                ,'dimensionado<?php echo $sufijo;?>'=>'[<?php echo $imageD['tamanos'];?>]'
                ,'centrado<?php echo $sufijo;?>'=>'[0|1]'
                ,'get_atributos<?php echo $sufijo;?>'=>array('get_atributos'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            ,'dimensionado'=>'{dimensionado<?php echo $sufijo;?>}'
                                            ,'centrado'=>'{centrado<?php echo $sufijo;?>}'
                                            )
                                        )
                ,'get_archivo<?php echo $sufijo;?>'=>array('get_archivo'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            )
                                        )
        <?php } ?>

              )
        <?php } ?>);

$items = $matriz['filas'];
//$total = $matriz['total'];
//$anterior = $matriz['anterior'];
//$siguiente = $matriz['siguiente'];
//$desde = $matriz['desde'];
//$hasta = $matriz['hasta'];
//$tren = $matriz['tren'];
</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_fila" style="display:none;" >
    <textarea id="codigo_text_fila" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true" >$item= select_fila(
        "<?php echo implode($li6,",")?>"
        ,"<?php echo $all['tabla']?>"
        ,"where <?php echo $all['id']?>='$ID' and  <?php echo ($all['vis']!='')?$all['vis']."='1'":""?> order by <?php echo $all['id']?> asc limit 0,100"
        ,0
        <?php if($all['archivo_hijo']!='' or sizeof($imagenes2)>0 ){ ?>,array(
        	<?php if($all['archivo_hijo']!=''){ ?>'sub_select'=>array('sub_select'=>array(
                			    'campos'=>"<?php echo implode($li62,",")?>"
                                	    ,'tabla' =>"<?php echo $all2['tabla']?>"
                                	    ,'donde' =>"where <?php echo $all2['foreig']?>='{<?php echo $all2['id']?>}' and <?php echo ($all2['vis']!='')?$all2['vis']."='1'":""?> order by <?php echo $all2['id']?> asc limit 0,100"
                                       	    ,'debug' =>0
                                            )
                                        )<?php $coma0=","; }
				$ttff=1;
				foreach($imagenes2 as $campo=>$imageD){
				$sufijo=($ttff==1)?"":"_".$ttff;
				$ttff++;
				$tot_tam=sizeof(explode(",",$imageD['tamanos']));
				$numArr=range(1,$tot_tam);
				$numStr=implode(",",$numArr);
               ?>

                <?php echo $coma0;?>'carpeta<?php echo $sufijo;?>'=>'<?php echo $imageD['carpeta'];?>'
                ,'tamano<?php echo $sufijo;?>'=>'[<?php echo $numStr;?>]'
                ,'dimensionado<?php echo $sufijo;?>'=>'[<?php echo $imageD['tamanos'];?>]'
                ,'centrado<?php echo $sufijo;?>'=>'[0|1]'
                ,'get_atributos<?php echo $sufijo;?>'=>array('get_atributos'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            ,'dimensionado'=>'{dimensionado<?php echo $sufijo;?>}'
                                            ,'centrado'=>'{centrado<?php echo $sufijo;?>}'
                                            )
                                        )
                ,'get_archivo<?php echo $sufijo;?>'=>array('get_archivo'=>array(
                                            'carpeta'=>'{carpeta<?php echo $sufijo;?>}'
                                            ,'fecha'=>'{<?php echo $all['fcr'];?>}'
                                            ,'file'=>'{<?php echo $campo;?>}'
                                            ,'tamano'=>'{tamano<?php echo $sufijo;?>}'
                                            )
                                        )
        <?php } ?>

              )
        <?php } ?>);</textarea>
    </div>
    <div class="codigo_areas" id="codigo_area_dato" style="display:none;" >
    <textarea id="codigo_text_dato" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true" > $dato = select_dato(
        "[<?php echo implode($li7,",")?>]"
        ,"<?php echo $all['tabla']?>"
        ,"where <?php echo $all['id']?>='$ID'"
        ,0
        );</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_sub_select" style="display:none;">
    <textarea id="codigo_text_sub_select" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >'sub_select'=>array('sub_select'=>array(
                                    'campo'=>"<?php echo implode($li62,",")?>"
                                    ,'tabla'=>"<?php echo $all['tabla']?>"
                                    ,'donde'=>"where <?php echo $all['id']?>='{$ID}'"
                                    ,'debug'=>0
    						)
    					)</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_sub_select_fila" style="display:none;">
    <textarea id="codigo_text_sub_select_fila" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >'sub_select_fila'=>array('sub_select_fila'=>array(
                                'campo'=>"<?php echo implode($li62,",")?>"
                                ,'tabla'=>"<?php echo $all['tabla']?>"
                                ,'donde'=>"where <?php echo $all['id']?>='{$ID}'"
                                ,'campo'=>0
    						)
    					)</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_sub_select_dato" style="display:none;">
    <textarea id="codigo_text_sub_select_dato" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >'sub_select_dato'=>array('sub_select_dato'=>array(
                                'campo'=>"[<?php echo implode($li7,",")?>]"
                                ,'tabla'=>"<?php echo $all['tabla']?>"
                                ,'donde'=>"where <?php echo $all['id']?>='{$ID}'"
                                ,'debug'=>0
    						)
    					)</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_items" style="display:none;">
    <textarea id="codigo_text_items" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true" >foreach($items as $item){

    <?php
    foreach($li6 as $lii){
    ?>	<?php echo "//echo \$item['".$lii."']\n";
    }
    ?>
    }</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_limit_string" style="display:none;">
    <textarea id="codigo_text_limit_string" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >'limit_string'=>array('limit_string'=>array(
    						'string'=>'{string}'
    						,'limit'=>'$LIMIT'
    						)
    					)</textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_fecha_formato" style="display:none;" >
    <textarea id="codigo_text_fecha_formato" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >'fecha_formato'=>array('fecha_formato'=>array(
    						'fecha'=>'{fecha}'
                            			,'formato'=>'[1,2,3,4,5,6]'
                            			)
                       			)
//[1] = MiÃ©rcoles, 23 de Setiembre
//[2] = MiÃ©rcoles, 23 de Setiembre de 2009
//[3] = MiÃ©rcoles, 23 de Set
//[4] = Setiembre 2009
//[5] = 23-09-2009
//[6] = 23-09-09

</textarea>
    </div>


    <div class="codigo_areas" id="codigo_area_contar" style="display:none;" >
    <textarea id="codigo_text_contar" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >

$numero=contar("<?php echo $all['tabla']?>","where 1 and  <?php echo ($all['vis']!='')?$all['vis']."='1'":""?>");

    </textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_insert" style="display:none;">
    <textarea id="codigo_text_insert" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >$insertado=insert(<?php echo "array(";
	$coh="";
	foreach($li6A as $ff){
	?>

			<?php echo $coh.$ff; $coh=",";
	}
	?>

			<?php echo ")"; ?>

            	,"<?php echo $all['tabla']?>"
            	,0);
    </textarea>
    </div>


    <div class="codigo_areas" id="codigo_area_update" style="display:none;">
    <textarea id="codigo_text_update" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >update(<?php echo "array(";
	$coh="";
	foreach($li6B as $ff){
	?>

		<?php echo $coh.$ff; $coh=",";
	}
	?>

	    <?php echo ")"; ?>

    	  ,"<?php echo $all['tabla']?>"
    	  ,"where <?php echo $all['id']?>='$ID'"
    	  ,0);
    </textarea>
    </div>

    <div class="codigo_areas" id="codigo_area_delete" style="display:none;">
    <textarea id="codigo_text_delete" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >

delete("<?php echo $all['tabla']?>","where <?php echo $all['id']?>='$ID'",0);

    </textarea>
    </div>
	<?php //prin($gon);?>
    <div class="codigo_areas" id="codigo_area_formulario_publico" style="display:none;">
    <textarea id="codigo_text_formulario_publico" class="codigo_ejemplo" onclick="javascript:this.focus();this.select();" readonly="true"
    >/*CAMPOS-BEGIN*/
,'tabla'=>'<?php echo $all['tabla'];?>'
,'campos'=>array(
<?php

$EQUIVALENCIAS['inp']='input_text';
$EQUIVALENCIAS['txt']='textarea';
$EQUIVALENCIAS['fch']='input_fecha';
$EQUIVALENCIAS['com']='input_radio';

foreach($gon as $go){
$cAA="'".$go['campo']."'=>array(
\t\t'label'=>'".$go['label']."'\n";
$cAA.="\t\t,'campo'=>array('".$go['campo']."')\n";
$cAA.="\t\t,'tipo'=>'".$EQUIVALENCIAS[$go['tipo']]."'\n";
if($go['legend']!=''){$cAA.="\t\t,'before'=>'".$go['legend']."'\n";}
$valval=array();
if(!(strpos($go['label'],"email")==false) or !(strpos($go['campo'],"email")==false)){
$valval[]="'email'";
}
if(!(strpos($go['label'],"fono")==false) or !(strpos($go['campo'],"fono")==false)or!(strpos($go['label'],"celular")==false) or !(strpos($go['campo'],"celular")==false)or!(strpos($go['label'],"movil")==false) or !(strpos($go['campo'],"movil")==false)){
$valval[]="'phone'";
}
if($go['validacion']=='1'){
$valval[]="'required'";
}
if(sizeof($valval)>0){
$cAA.="\t\t,'validacion'=>\"validate[". implode(",",$valval) ."]\"
";
}
unset($valval);
if(sizeof($go['opciones'])>0){
foreach($go['opciones'] as $gag=>$gog){
$gog2[]="'$gag'=>'$gog'";
}
$cAA.="\t\t,'opciones'=>array(". implode(",",$gog2) .")
";
unset($gog2);
}
$cAA.="\t)";
$CaM[]=$cAA;
}
echo "\t".implode("\n\t,",$CaM)."\n"; ?>
)
/*CAMPOS-END*/
</textarea>
    </div>

</div>

<?php // include("editar_propiedades.php");?>

<?php // include("editar_campos.php");?>

<style>
#lili_campos { position:inherit;}
#lili_campos li { list-style: none; }
</style>
<script>
/*
var mya = new Sortables($('lili_campos'), {
	clone:true
	handles: $$('.handle')
});
*/
</script>
<?php

}

?>
</div>


<div class='content_maquina'>
<?php



	?>
    <script>
	var contador=0;
	function selec(sel){

		contador=0
		$$('.coss').each(function(element) {
			element.checked=false;
		});
		$$('.cossli').each(function(element) {
			element.setStyles({'background-color':'#FFFFFF'});
		});

		//alert('.co'+sel);
		$$('.co'+sel).each(function(element) {
			contador++;
			element.checked=true;
		});
		$$('.li'+sel).each(function(element) {
			element.setStyles({'background-color':'#FCE8B0'});
		});
		$('xelecionados').innerHTML=(contador==0)?"":contador+" archivos seleccionados";


	}

	function seleccionar_allproy(dis){
		if(dis.checked){
			$$('.cli').each(function(el){ el.checked=true; });
		} else {
			$$('.cli').each(function(el){ el.checked=false; });
		}
	}

	function seleccionar_all(dis){
		if(dis.checked){
		selec('_todos');
		} else {
		selec('_ul_0');
		}
	}

	function actualizar_seleccionados(accion){

	var clien = new Array();
	var idcli=0;
	$$('.cli').each(function(element) {
		if(element.checked){ clien[idcli]=element.value; idcli++; }
	});

	//alert('?accion='+accion+'&proy='+clien.join(",")+'&files='+files.join(",")+'&rand='+Math.random());
	location.href='<?php echo $SERVER['BASE'].$SERVER['ARCHIVO'];?>?accion='+accion+'&proy='+clien.join(",")+'&rand='+Math.random();

	}

	function paint_all(co){
	$('li_'+co).setStyles({'background-color':($('co_'+co).checked==true)?'#FCE8B0':'#FFFFFF'});
	if($('co_'+co).checked==true){ contador=contador+1; } else { contador=contador-1; }
	$('xelecionados').innerHTML=(contador==0)?"":contador+" archivos seleccionados";

	}

	function subir_seleccionados(accion){

	var files = new Array();
	var idfile=0;
	var clien = new Array();
	var idcli=0;
	$$('.cli').each(function(element) {
		if(element.checked){ clien[idcli]=element.value; idcli++; }
	});
	$$('.coss').each(function(element) {
		if(element.checked){ files[idfile]=element.value; idfile++; }
	});
	//alert('?accion='+accion+'&proy='+clien.join(",")+'&files='+files.join(",")+'&rand='+Math.random());
	location.href='<?php echo $SERVER['BASE'].$SERVER['ARCHIVO_REAL'];?>?accion='+accion+'&proy='+clien.join(",")+'&files='+files.join(",")+'&rand='+Math.random();

	}

	function paint_all(co){
	$('li_'+co).setStyles({'background-color':($('co_'+co).checked==true)?'#FCE8B0':'#FFFFFF'});
	if($('co_'+co).checked==true){ contador=contador+1; } else { contador=contador-1; }
	$('xelecionados').innerHTML=(contador==0)?"":contador+" archivos seleccionados";

	}

	function paint_cli(co){
	$('clili_'+co).setStyles({'background-color':($('cli_'+co).checked==true)?'#FCE8B0':'#FFFFFF'});
	}
	</script>

<?php

if($_GET['accion']=='esquema'){
	include("lib/webutil.php");
	if(!function_exists('procesar_keywords')){ function procesar_keywords($string){ return web_procesar_keywords($string);	}	}
	if(!function_exists('procesar_description')){ function procesar_description($string){ }	}
	if(!class_exists('autokeyword')){ class autokeyword{ function get_keywords(){ } }	}
	chdir("../web/modulos");
	include("driver.php");
	@include("driver_render.php");
	include("css.php");

	echo "<h2 style='color:yellow;background-color:#222;'>ESQUEMA DE WEB</h2>";

	$Esquema=$Estructura;

?>
<style>
h4 { font-weight:bold; font-size:13px; margin-top:4px; }
.tabla2 { float:left; font-size:10px; }
.tabla2 td { padding:0 1px; vertical-align:top; }

.tabla2 td.esquema { width:600px; padding-bottom:20px; padding-top:0px; }
.tabla2 td.esquema div { text-align:center; padding:3px 0; margin-bottom:3px; }
.tabla2 td.esquema .filtro {
background: #4B0D0D;
color: #FFF;
font-size: 16px;
font-weight: bold;
margin-bottom: 0;
margin-top: 5px;
padding: 1px 0 1px 5px;
text-align: left;
max-width:600px;
word-wrap:break-word;
}
.tabla2 td.esquema .div_fila {  background:#ccc; float:left; width:100%; word-wrap:break-word; }
.tabla2 td.esquema .div_fila .div_columna { background:#ddd; float:left; margin-left:1%;margin-right:1%; }
.tabla2 td.esquema .div_fila .div_columna .div_fila { background:#eee; float:left; width:100%; }
.tabla2 td.esquema span.maiin { color:#000;font-size:12px;text-shadow:1px 0px 1px #C5D718; }


.tabla1 { float:left; font-size:10px; margin-bottom:20px;  }
.tabla1 td { padding:0 1px !important; border-bottom:1px solid #999; }
.tabla1 td span.yes,
.tabla1 td span.no { float:left; width:12px; height:9px; margin-left:16px; }
.tabla1 td span.yes { background:url(img/ico_yes.gif) 0px 0px no-repeat #FFF; }
.tabla1 td span.no  { background:url(img/ico_no.gif) 2px 0px no-repeat #FFF; }


</style>
<?php
	function PPE2($a){
		parse_str($a,$c);
		if($c['modulo']=='items'){
			if(!isset($c['tab']) or enhay($c['tab'],"{") ){ $c['tab']="<span style='color:red;'>[TAB]</span>"; }
			if(!isset($c['acc']) or enhay($c['acc'],"{") ){ $c['acc']="<span style='color:blue;'>{list,file}</span>"; }
			$file="<span class='maiin'>".$c['modulo']."/".$c['tab']."_".$c['acc'].".php</span>";
		} else {
			if(!isset($c['tab']) or enhay($c['tab'],"{") ){ $c['tab']="<span style='color:red;'>[TAB]</span>"; }
			$file="<span class='maiin'>".$c['modulo']."/".$c['tab'].".php"."</span>";
		}
		return $file;
	}
	$Filtros=array_keys($EstructuraCero);
	$ii=1;
	if($_GET['id']=='' and ( $_GET['show']=='' or $_GET['show']=='1' )){
	echo '<div style="float:left;">';
	echo '<div>';
	echo '<a href="maquina.php?accion=esquema&show=1">Análisis de web</a>';
	if($_GET['show']!=''){ echo ' | <a href="maquina.php?accion=esquema">Esquema General</a>'; }
	echo '</div>';
	echo "<table class='tabla2'>";
	foreach($EstructuraCero as $Filtro=>$objeto){
		//parse_str($Filtro,$fil);
		echo "<tr>";
		echo "<td>".($ii++)."</td>";
		echo "<td class='esquema'>";
		echo "<div class='filtro'>".$Filtro."</div>";

		ob_start();
		print_esquema($objeto);
		$geet = ob_get_contents();
		ob_end_clean();
		parse_str($Filtro,$F);
		echo str_replace("MAIN",PPE2($Filtro),$geet);

		echo "</td>";
		/*
		echo "<td>";
		prin($objeto);
		echo "</td>";
		*/
		echo "</tr>";
	}
	echo '</table>';
	echo "</div>";
	}

	if($_GET['in']!='' and $_GET['out']!='' and $_GET['create']=='1'){

		//prin(getcwd());
		//prin(file_exists($_GET['in'])?1:0);
		//prin(file_exists($_GET['out'])?1:0);
		copy($_GET['in'],$_GET['out']);
		copy("../templates/default/".$_GET['in'],"../templates/default/".$_GET['out']);
		/*
		$f1=fopen("../../panel/config/tablas.php","w+");
		fwrite($f1,"<?php //Ã¡\n\n".render_array($objeto_tabla)."\n\n?>");
		fclose($f1);
		*/
		redireccionar_a($_SERVER['HTTP_REFERER']);


		//$ultimo_bloque=array_diff($objeto_panel_campos,array_diff($objeto_panel_campos, $objeto_web_campos));
		//prin($ultimo_bloque);
		//prin(array_merge(array_diff($objeto_panel_campos,array_diff($objeto_panel_campos, $objeto_web_campos)),array_diff($objeto_panel_campos, $objeto_web_campos)));
	}

	if($_GET['id']!='' and $_GET['var']!='' and $_GET['panel']!='' and $_GET['fix']=='1'){

		$objeto_panel=$objeto_tabla[$_GET['panel']];
		//$objeto_panel_campos=array_keys($objeto_panel['campos']);
		foreach($objeto_panel['campos'] as $po=>$ppoo){
			if(!in_array($po,array('id','fecha_creacion','fecha_edicion','posicion','visibilidad','page','web','cal','user','fecha'))){
				$objeto_panel_campos[]=$po;
			} else {
				$campos_base[]=$ppoo;
			}
		}
		$objeto_web=get_form($_GET['id'],$_GET['var']);
		$objeto_web_campos=array_keys($objeto_web['campos']);
		//prin($objeto_panel_campos);
		//prin($objeto_web_campos);
		foreach($objeto_web_campos as $obg){
			if(isset($objeto_panel['campos'][$obg])){
			$oott[$obg]=$objeto_panel['campos'][$obg];
			//$oott[$obg]='old_enabled';
			} else {
			//prin("nuevo $obg");
			$oott[$obg]=web2panel($objeto_web['campos'][$obg]);
			$oott[$obg]['web_form']='1';
			//$oott[$obg]='new';
			}
		}
		$ultimo_bloque=array_diff($objeto_panel_campos, $objeto_web_campos);
		foreach($ultimo_bloque as $obg){
			$oott[$obg]=$objeto_panel['campos'][$obg];
			$oott[$obg]['web_form']='0';
			//$oott[$obg]='old_disabled';
		}
		if(!isset($objeto_tabla[$_GET['panel']])){
			//prin($objeto_web);

			$pre=array();

			$parts=explode("_",strtolower($_GET['panel']));
			$prefijo=substr($parts[0],0,3).substr($parts[1],0,3);

			$pre['me']	  			=$_GET['panel'];
			$pre['titulo']			=ucfirst($objeto_web['titulo']);
			$pre['nombre_singular'] =strtolower($objeto_web['titulo']);
			$pre['nombre_plural'] 	=strtolower($objeto_web['titulo']);
			$pre['tabla'] 			=$objeto_web['tabla'];
			$pre['archivo']			=$objeto_web['tabla'];
			$pre['prefijo']			=$prefijo;
			$pre['eliminar']		='1';
			$pre['editar']			='1';
			$pre['edicion_rapida']	='1';
			$pre['edicion_completa']='1';
			$pre['crear']			='1';
			$pre['visibilidad']		='1';
			$pre['calificacion']	='1';
			$pre['visibilidad']		='1';
			$pre['buscar']			='0';
			$pre['bloqueado']		='0';
			$pre['menu']			='1';
			$pre['menu_label']		=ucfirst($objeto_web['titulo']);
			$pre['por_pagina']		='50';
			$pre['orden']			='0';
			$pre['crear_label'] 	='110px';
			$pre['crear_txt']		='550px';
			$pre['altura_listado']	='auto';
			$pre['grupo']			='formularios';

			$pre['campos']=array('id'			 =>array('campo'=>'id','tipo'=>'id'),
								 'fecha_creacion'=>array('campo'=>'fecha_creacion','tipo'=>'fcr'),
								 'fecha_edicion' =>array('campo'=>'fecha_edicion','tipo'=>'fed'),
								 'posicion'		 =>array('campo'=>'posicion','tipo'=>'pos'),
								 'visibilidad'	 =>array('campo'=>'visibilidad','tipo'=>'vis'),
								 'calificacion'	 =>array('campo'=>'calificacion','tipo'=>'cal'));

			$objeto_tabla[$_GET['panel']]=$pre;
			//prin("nuevo objeto");
		} else {
			$objeto_tabla[$_GET['panel']]['campos']=$campos_base;
			//prin("objeto existente");
		}
		$objeto_tabla[$_GET['panel']]['campos']=array_merge($objeto_tabla[$_GET['panel']]['campos'],$oott);

		$objeto_tabla=reorder_objeto($objeto_tabla);

		$objeto_tabla=fix_objeto($objeto_tabla);

		//prin($oott);

		//prin(getcwd());

		$f1=fopen("../../panel/config/tablas.php","w+");
		fwrite($f1,"<?php //Ã¡\n\n".render_array($objeto_tabla)."\n\n?>");
		fclose($f1);

		redireccionar_a($_SERVER['HTTP_REFERER']);

		//$ultimo_bloque=array_diff($objeto_panel_campos,array_diff($objeto_panel_campos, $objeto_web_campos));
		//prin($ultimo_bloque);
		//prin(array_merge(array_diff($objeto_panel_campos,array_diff($objeto_panel_campos, $objeto_web_campos)),array_diff($objeto_panel_campos, $objeto_web_campos)));
	}

	if($_GET['show']=='' or $_GET['show']=='2'){
	echo '<div style="float:left;padding-left:15px;">';
	echo '<div>';
	echo '<a href="maquina.php?accion=esquema&show=2">AnÃ¡lisis de archivos</a>';
	if($_GET['show']!=''){ echo ' | <a href="maquina.php?accion=esquema">Esquema General</a>'; }
	echo '</div>';
	//echo '<div><a href="maquina.php?accion=esquema">volver a ESQUEMA GENERAL</a></div>';
	echo "<table class='tabla1'>";
	echo "<tr>
	<td></td>
	<td>archivo</td>
	<td>parametros</td>
	<td>modulo/</td>
	<td>template/</td>
	<td>tipo</td>
	<td>csss</td>
	<td>var</td>
	<td>paneles</td>
	</tr>";
	$ii=1;
	foreach($MASTERBLOCK as $VVV=>$bb){
		$uno="common/".$VVV.".php";
		if($bb){
		$VVVV="<span style='font-weight:bold;'><span style='color:navy;'>".str_replace("/","</span>/",$uno)."</span>";
		} else {
		$VVVV="<span style='color:#aaa;'>".$uno."</span>";
		}
		if($bb){
		echo "<tr>";
		echo "<td>".($ii++)."</td>";
		echo "<td>".$VVVV."</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td>". ((file_exists("../templates/default/".$uno))?'<span class="yes"></span>':'<span class="no"></span>') ."</td>";
		echo "<td><b>". str_replace(
									array('listados','bloques','arboles','menus','formularios','fichas','footers',','),
									array('List','Bloc','Arbl','Menu','Form','File','Foot',', '),
									$WEBBLOQUES[$VVV]) ."</b></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
		}
	}
	//echo "</table>";
	global $Vectore;
	function ArrayToListIter2($arrar){
		global $Vectore;
		if(is_array($arrar)){
			foreach($arrar as $arra){
				if(is_array($arra)){
					ArrayToListIter2($arra);
				} else {
					$Vectore[]=$arra;
				}
			}
		}
	}

	ArrayToListIter2($Esquema);

	foreach($Vectore as $V){ $VV[$V]=$V; }
	$VV=array_values($VV);
	asort($VV);
	//$ii=1;
	//echo "<table class='tabla1'>";
	foreach($VV as $VVV){
		list($uno,$dos)=explode("?",$VVV);
		if($_GET['id']==$VVV or $_GET['id']==''){
		$tres=explode("/",$uno);
		list($cuatro,$cinco)=explode(".",end($tres));
		$VVVV="<span style='color:blue;'>".str_replace("/","</span>/",$uno);
		echo "<tr>";
		echo "<td>".($ii++)."</td>";
		echo "<td><a href='maquina.php?accion=esquema&id=".$uno."'>".$VVVV."</a></td>";
		echo "<td>".$dos."</td>";
		echo "<td>". ((file_exists($uno))?'<span class="yes"></span>':'<span class="no"></span>') ."</td>";
		echo "<td>". ((file_exists("../templates/default/".$uno))?'<span class="yes"></span>':'<span class="no"></span>') ."</td>";
		echo "<td>";
		list($dir_,$file_)=explode("/",$VVV);
		list($name_,$ext_)=explode(".",$file_);
		$parts=explode("_",$name_);
		$part_ini=$parts[0];
		$part_fin=end($parts);
		$part_tipo=''; $semilla='';
		if($part_ini=='arbol'){			$part_tipo='arbol'; 	$semilla='bloques/semilla_arbol.php'; }
		elseif($part_ini=='banner'){	$part_tipo='banner';	$semilla='bloques/semilla_banner.php'; }
		elseif($part_ini=='print'){		$part_tipo='print';		$semilla='bloques/semilla_print.php'; }
		elseif($part_ini=='form'){		$part_tipo='form';		$semilla='bloques/semilla_form.php'; }
		elseif($part_fin=='list'){		$part_tipo='list';		$semilla='items/semilla_list.php'; }
		elseif($part_fin=='file'){		$part_tipo='file';		$semilla='items/semilla_file.php'; }
		elseif($part_fin=='menu'){		$part_tipo='menu';		$semilla='common/semilla_menu.php';}
		echo $part_tipo;
		echo (!file_exists($uno))?' <a href="maquina.php?accion=esquema&create=1&show=2&in='.urlencode($semilla).'&out='.urlencode($uno).'">crear</a>':'';
		echo "</td>";
		echo "<td><b>". str_replace(
									array('listados','bloques','arboles','menus','formularios','fichas','footers',','),
									array('List','Bloc','Arbl','Menu','Form','File','Foot',', '),
									$WEBBLOQUES[$cuatro]) ."</b></td>";
		list($onu,$sod)=getinfo($Filtros,$uno);
		echo "<td>"; echo $onu; echo "</td>";
		echo "<td>"; echo $sod; echo "</td>";
		echo "</tr>";
		}
	}
	echo "</table>";
	echo "</div>";
	}
	//return $VV;


	chdir("../../panel");
}


if($_GET['accion']=='alllistado' ){

	$cambio_de_version=0;
	$cambio_de_version2=0;

	$directo=getcwd();

	if($MASTER==false){
		chdir("../");
	}

	$panelA=explode("\\",getcwd());
	$carpeta = $panelA[sizeof($panelA)-1];


	chdir("../");

	$directoriS=array();
	function get_dirs_recur($directorio){


	global $directoriS;

	$Directorios=array();
	$Directorios['nombre']=$directorio."/";
	$directoriS[]=$directorio."/";
	$directorio_s = dir($directorio."/");
	while($fichero=$directorio_s->read()) {

		if($fichero!='.' and $fichero!='..' and is_dir("$directorio/".$fichero) ){
			$Directorios['items'][]=get_dirs_recur("$directorio/".$fichero);
		}
	}

	return $Directorios;

	}
	//echo "$carpeta<br>";
	//exit();

	if($MASTER==false){
	get_dirs_recur($carpeta);
	$directoriS_1=$directoriS;
	unset($directoriS);
	} else {
	$directoriS_1=array();
	}
	get_dirs_recur("panel");
	$directoriS_2=$directoriS;

	//$directoriS[]=$carpeta."/";
	$directoriS_1S=array();
	$directoriS_2S=array();
	foreach($directoriS_1 as $dires){
		if(
		(
		$dires==$carpeta."/panel/base2/" or
		$dires==$carpeta."/panel/base2/reportes/" or
		$dires==$carpeta."/panel/base2/apps/" or
		$dires==$carpeta."/panel/base2/procesos/" or
		//substr($dires,0,strlen($carpeta)+13)==$carpeta."/panel/base2/" or
		substr($dires,0,strlen($carpeta)+5)==$carpeta."/web/" or
		substr($dires,0,strlen($carpeta)+4)==$carpeta."/js/" or
		substr($dires,0,strlen($carpeta)+5)==$carpeta."/css/" or
		substr($dires,0,strlen($carpeta)+5)==$carpeta."/img/" or
		$dires==$carpeta."/"
		)
		//and
		//(substr($dires,0,12)!="panel/base2")

		and
		(strpos($dires,"/stylus/")===false)
		// and
		// (strpos($dires,"visitor.txt")===false)
		and
		(strpos($dires,"/captcha/")===false)
		and
		(strpos($dires,"trash")===false)
		and
		(strpos($dires,".settings")===false)
		and
		(strpos($dires,".project")===false)
		and
		(strpos($dires,".buildpath")===false)
		and
		(strpos($dires,".git")===false)
		and
		(strpos($dires,".DS_Store")===false)		

		){
			$directoriS_1S[]=$dires;
		}
	}

	$directoriS_1=$directoriS_1S; unset($directoriS_1S);

	if($vars['GENERAL']['esclavo']=='1'){

		foreach($directoriS_1 as $dires){
			if(
			(strpos($dires,"base2")===false)
			){
				$directoriS_1S[]=$dires;
			}
		}
		$directoriS_1=$directoriS_1S; unset($directoriS_1S);
	}

	foreach($directoriS_2 as $dires){
		if(
		(
		substr($dires,0,6)=="panel/"
		)
		and
		(substr($dires,0,12)!="panel/csslib")
		and
		(substr($dires,0,9)!="panel/zip")
		and
		(substr($dires,0,12)!="panel/lib/sm")
		and
		(substr($dires,0,12)!="panel/packed")
		and
		(substr($dires,0,19)!="panel/documentacion")
		and
		(substr($dires,0,14)!="panel/disenios")
		and
		(substr($dires,0,13)!="panel/img/bgs")
		and
		(strpos($dires,"trash")===false)
		// and
		// (strpos($dires,".settings")===false)
		and
		(strpos($dires,"/stylus/")===false)
		// and
		// (strpos($dires,".map")===false)		
		// and
		// (strpos($dires,"visitor.txt")===false)				
		and
		(substr($dires,0,13)!='panel/startup')
		and
		($dires!='panel/base/')
		and
		($dires!='panel/base2/')
		and
		($dires!='panel/base2/apps/')
		and
		($dires!='panel/base2/reportes/')	
		and
		($dires!='panel/base2/procesos/')						
		and
		($dires!='panel/custom/')
		and
		($dires!='panel/zip/')
		and
		($dires!='panel/config/')
		and
		(strpos($dires,".git")===false)
		){
			$directoriS_2S[]=$dires;
		}
	}
	$directoriS_2=$directoriS_2S; unset($directoriS_2S);
	//prin($directoriS_2);

if($vars['GENERAL']['esclavo']=='1'){

	foreach($directoriS_2 as $dires){
		if(
		(substr($dires,0,18)!="panel/lib/PHPExcel")
		and
		(substr($dires,0,9)!="panel/img")
		and
		(substr($dires,0,16)!="panel/css/images")
		and
		(substr($dires,0,17)!="panel/css/milkbox")
		and
		(substr($dires,0,15)!="panel/css/Other")
		and
		(substr($dires,0,14)!="panel/css/Silk")
		){
			$directoriS_2S[]=$dires;
		}
	}
	$directoriS_2=$directoriS_2S; unset($directoriS_2S);

}

	$directoriSS=array_merge($directoriS_1,$directoriS_2);


	//prin($directoriS_1S);
	//prin($directoriS_2S);


	//return $directoriSS;
	//prin($directoriSS);
	//if($MASTER==false and $_GET['proy']==''){



	//}

	$ProysyKu=array();

		if($MASTER==true){

			$ProysyKu=explode(",",$_COOKIE['proy']);

			if($_GET['proy']!=''){

				$Proysy=explode(",",$_GET['proy']);

				//prin($Proysy);
				foreach($Proysy as $Proy){
				$proyitem= select_fila(
						"id,logo,nombre,descripcion,dominio,ftp_user,ftp_pass,ftp_root,carpeta,FORMATO,seguro,para_subir,fecha_creacion"
						,"proyectos"
						,"where id='$Proy' and  visibilidad='1' order by id asc limit 0,100"
						,0
						);
				$proyectoC['REMOTE_FTP']['ftp_files_host']=$proyitem['dominio'];
				$proyectoC['REMOTE_FTP']['ftp_files_user']=$proyitem['ftp_user'];
				$proyectoC['REMOTE_FTP']['ftp_files_pass']=$proyitem['ftp_pass'];
				$proyectoC['REMOTE_FTP']['ftp_files_root']=$proyitem['ftp_root'];

				$proyectoB[$Proy]=$proyectoC;

			}


		} else {

			$proyectoC['REMOTE_FTP']['ftp_files_host']=$vars['REMOTE_FTP']['ftp_files_host'];
			$proyectoC['REMOTE_FTP']['ftp_files_user']=$vars['REMOTE_FTP']['ftp_files_user'];
			$proyectoC['REMOTE_FTP']['ftp_files_pass']=$vars['REMOTE_FTP']['ftp_files_pass'];
			$proyectoC['REMOTE_FTP']['ftp_files_root']=$vars['REMOTE_FTP']['ftp_files_root'];


			$proyectoB[0]=$proyectoC;

		}

	} else {

			$proyectoC['REMOTE_FTP']['ftp_files_host']=$vars['REMOTE_FTP']['ftp_files_host'];
			$proyectoC['REMOTE_FTP']['ftp_files_user']=$vars['REMOTE_FTP']['ftp_files_user'];
			$proyectoC['REMOTE_FTP']['ftp_files_pass']=$vars['REMOTE_FTP']['ftp_files_pass'];
			$proyectoC['REMOTE_FTP']['ftp_files_root']=$vars['REMOTE_FTP']['ftp_files_root'];


			$proyectoB[0]=$proyectoC;

	}

	//prin($proyectoB);
	//exit();

	$SUBIRFTP=true;

	$PARA_SUBIR=array();




foreach($proyectoB as $ppppp=>$proyectoC){

	$ppppp_p=0;

	$co=0;
	$co2=0;

	if($_GET['files']!='' or $_GET['files2']!=''){

		@set_time_limit(0);

		//foreach($proyectoB as $ppppp=>$proyectoC){
		if($SUBIRFTP){

			$conn_id[$ppppp] = ftp_connect($proyectoC['REMOTE_FTP']['ftp_files_host'],21,20);
			$login_result[$ppppp] = ftp_login($conn_id[$ppppp], $proyectoC['REMOTE_FTP']['ftp_files_user'], $proyectoC['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id[$ppppp], true);

			echo "<div>subiendo ".$proyectoC['REMOTE_FTP']['ftp_files_host']. " ". ( ($login_result[$ppppp])?'conectado':'no conectado' )."</div>";

		}
		//}
	}

	$dires=$directoriSS;
	if(sizeof($sub_dire_imagenes)>0){
		$dires=array_merge($dires,$sub_dire_imagenes);
	}

	$array_archivos2=explode(",",$_GET['files2']);


	if($_GET['files2']!=''){

		foreach($dires as $dire){

			$dir_remo=$proyectoC['REMOTE_FTP']['ftp_files_root'].str_replace("$carpeta/","",$dire);
			$directorio = dir("$dire/");
			while($fichero=$directorio->read()) {

				if( !in_array($fichero,array(
				"yuicompressor-2.4.2.jar"
				,"desktop.ini"
				,"."
				,".."
				,"config.ini"
				,"tablas.php"
				,"tablas_BASE.php"
				,"tablas_CPV.php"
				,"tablas_CSPV.php"
				,"tablas_INMOBILIARIO.php"
				,"tablas_CONTENIDO.php"
				,"memory.txt"
				,"tablas_copy.php"
				,".gitignore"
				,"README.md"
				,".DS_Store"
				,".project"
				,"css.css.map"
				,"visitor.txt"
				,".buildpath"
				)) and !is_dir($dire.$fichero) ){
					$co2++;
					if(in_array($dire.$fichero,$array_archivos2)){
						$array_arcchivos[]=$co2;
					}
				}
			}
		}

	} else {

		$array_arcchivos=explode(",",$_GET['files']);

	}

//	prin($ARCHIVOSSS);

	foreach($dires as $dire){

	$dir_remo=$proyectoC['REMOTE_FTP']['ftp_files_root'].str_replace("$carpeta/","",$dire);

//	echo $dir_remo."<br>";

	if($_GET['files']!='' or $_GET['files2']!=''){
		//foreach($proyectoB as $ppppp=>$proyectoC){

		if($SUBIRFTP){

		@ftp_mkdir($conn_id[$ppppp], $dir_remo);

		}
		//}
	}


//	echo $dir_remo."<br>";
	$directorio = dir("$dire/");

	while($fichero=$directorio->read()) {

		if( !in_array($fichero,array(
		"yuicompressor-2.4.2.jar"
		,"desktop.ini"
		,"."
		,".."
		,"config.ini"
		,"tablas.php"
		,"tablas_BASE.php"
		,"tablas_CPV.php"
		,"tablas_CSPV.php"
		,"tablas_INMOBILIARIO.php"
		,"tablas_CONTENIDO.php"
		,"memory.txt"
		,"tablas_copy.php"
		,"Thumbs.db"
		,".gitignore"
		,".DS_Store"		
		,"visitor.txt"		
		,"css.css.map"
		// ,".styl"		
		,"README.md"
		,".project"
		,".buildpath"
		)) and !is_dir($dire.$fichero) ){

			//if($ppppp_p==0){
			$co++;
			//}
			$archivo_cheked="";




			if(in_array($co,$array_arcchivos)){

				if($fichero=='.htaccess' and !$vars['GENERAL']['htaccess_restringido'] ){

					$htaccess_buffer=implode("",file($dire.$fichero));

					$carp0=str_replace("http://","",$proyectoC['REMOTE']['url_publica']);
					$carps=explode("/",$carp0);
					$CARPETA_REMOTA=str_replace($carps[0],"",$carp0)."/";

					$htaccess_buffer_2=str_replace("RewriteBase /sistemapanel/$carpeta/","RewriteBase ".str_replace("//","/",str_replace("/www","",$CARPETA_REMOTA)."/"),$htaccess_buffer);
					$htaccess_buffer_2=str_replace("ErrorDocument 404 /sistemapanel/$carpeta/","ErrorDocument 404 ".str_replace("//","/",str_replace("/www","",$CARPETA_REMOTA)."/"),$htaccess_buffer_2);

					$f1=fopen($dire.$fichero,"w+");
					fwrite($f1,$htaccess_buffer_2);
					fclose($f1);

				}


				//foreach($proyectoB as $ppppp=>$proyectoC){

				if($ppppp==0){
				$archivo_remoto= str_replace("//","/",$proyectoC['REMOTE_FTP']['ftp_files_root']."/".str_replace("$carpeta/","",$dire).$fichero);
				} else {
				$archivo_remoto= str_replace("//","/",$proyectoC['REMOTE_FTP']['ftp_files_root']."/".$dire.$fichero);
				}

				if($SUBIRFTP){
					$archivo_subido = ((ftp_put($conn_id[$ppppp],$archivo_remoto, $dire.$fichero, FTP_BINARY))?" <span style='color:green;' title='".$dire.$fichero."->".$archivo_remoto."'>subío exitosamente</span>":" <span style='color:red;'>no pudo subir</span>");
				} else {
					$PARA_SUBIR[]=array('remoto'=>$archivo_remoto,'local'=>$dire.$fichero);
					$archivo_subido = "<span style='color:blue;'>comprimiendo</span>";
				}
				//}

				$archivo_cheked="checked";


				if($fichero=='.htaccess' and !$vars['GENERAL']['htaccess_restringido']){

					$f1=fopen($dire.$fichero,"w+");
					fwrite($f1,$htaccess_buffer);
					fclose($f1);

				}

				if( enhay($dire,"web/templates") and ( $fichero=='js.js' or $fichero=='css.css' or $fichero=='favicon.ico' ) and $cambio_de_version==0 ){

//					prin(getcwd());
					$urlcommon=$carpeta."/web/modulos/common.php";
					$urlcommon_remoto=str_replace("//","/",$proyectoC['REMOTE_FTP']['ftp_files_root']."/web/modulos/common.php");
					$buff_A=file($urlcommon);
					foreach($buff_A as $y=>$ba){
						if(!strpos($ba,"INCLUDE['version']=")===false){
							$cambio_de_version=1;
							eval($ba);
							list($aa,$bb)=explode("?v=",$ba);
							$bb=$bb+1;
							$buff_A[$y]=str_replace($INCLUDE['version'],"?v=".$bb,$ba);
						}
					}
					if($cambio_de_version==1){
						$buffa=implode("",$buff_A);
						$f1=fopen($urlcommon,"w+");
						fwrite($f1,$buffa);
						fclose($f1);

							if($SUBIRFTP){
								echo (ftp_put($conn_id[$ppppp], $urlcommon_remoto, $urlcommon, FTP_BINARY))?"actualización de versión<br>":"<br>";
							} else {
								$PARA_SUBIR[]=array('remoto'=>$urlcommon_remoto,'local'=>$urlcommon);
							}

					}

				}


				if( enhay($dire,"panel") and ( $fichero=='js.js' or $fichero=='css.css' or $fichero=='remote.ico' ) and $cambio_de_version2==0 ){

					//prin(getcwd());
					$urlcommon="panel/head.php";
					$urlcommon_remoto=str_replace("//","/",$proyectoC['REMOTE_FTP']['ftp_files_root']."/panel/head.php");
					$buff_A=file($urlcommon);
					foreach($buff_A as $y=>$ba){
						if(enhay($ba,"\$rrr='")){
							$cambio_de_version2=1;
							eval($ba);
							$rr=$rrr+1;
							$buff_A[$y]="\$rrr='".$rr."';\n";
						}
					}

					if($cambio_de_version2==1){
						$buffa=implode("",$buff_A);
						$f1=fopen($urlcommon,"w+");
						fwrite($f1,$buffa);
						fclose($f1);

							if($SUBIRFTP){
								echo (ftp_put($conn_id[$ppppp], $urlcommon_remoto, $urlcommon, FTP_BINARY))?"actualización de versión<br>":"<br>";
							} else {
								$PARA_SUBIR[]=array('remoto'=>$urlcommon_remoto,'local'=>$urlcommon);
							}

					}


				}




			}

			$timpo=filemtime($dire.$fichero);
			$tiempos[$co]=$timpo;

			if(!(strpos($fichero,".doc")===false)){
				$lili="li_docs li_panel";
				$coco="co_docs co_panel";
			} elseif(!(strpos($dire,"panel/base2")===false)){
				$lili="li_panel li_panelbase2";
				$coco="co_panel co_panelbase2";
			} elseif(!(strpos($dire,"panel/img")===false)){
				$lili="li_panel li_panelimg";
				$coco="co_panel co_panelimg";
			} elseif(!(strpos($dire,"PHPExcel")===false) or $fichero=='PHPExcel.php'){
				$lili="li_excel li_panel";
				$coco="co_excel co_panel";
			} elseif(!(strpos($dire,"panel")===false) and (substr($fichero,-4)=='.php' or substr($fichero,-4)=='.css')){
				$lili="li_panel li_panelphp li_solopanel";
				$coco="co_panel co_panelphp co_solopanel";
			} elseif(!(strpos($dire,"panel")===false)){
				$lili="li_panel li_solopanel";
				$coco="co_panel co_solopanel";
			} elseif(!(strpos($dire,"/web/templates/default/lib/")===false) or in_array($fichero,array("css.php"))){
				$lili="li_weblib li_webtemplates li_web";
				$coco="co_weblib co_webtemplates co_web";
			} elseif(!(strpos($dire,"/web/templates/")===false)){
				$lili="li_webtemplates li_web";
				$coco="co_webtemplates co_web";
			} elseif(!(strpos($dire,"/web/modulos/")===false) or in_array($fichero,array("css.php"))){
				$lili="li_webmodulos li_web";
				$coco="co_webmodulos co_web";
			} elseif(!(strpos($dire,"/web/")===false)){
				$lili="li_web";
				$coco="co_web";
			} elseif(in_array($fichero,array('.htaccess','index.php','ajax.php','robots.txt','googlehostedservice.html'))){
				$lili="li_root li_web";
				$coco="co_root co_web";
			} else {
				$lili="";
				$coco="";
			}


			$dire33=explode("sistemapanel/",$dire);
			$dire2=$dire33['1'];
			// prin($dire);
			 
			// $carpeta3=explode("sistemapanel",$carpeta);
			// $carpeta2=$carpeta3['1'];
			// $carpeta=$carpeta2;
			 

			$labelll=( str_replace(
									array(
										'panel/',
										$carpeta.'/web/'
										),
									array(
										'<span style="color:red;">panel/</span>',
										'<span style="color:blue;">'.$carpeta.'/web/</span>'
										),
									$dire) 
						).$fichero;

			// $labelll=$dire2;

			$str = "<li id='li_".$co."' class='cossli li_todos $lili '>";
			$str.= "<label for='co_".$co."'>";
			$str.= "<b>
			".$labelll;
			$str.= "</b> ";
//			$str.= $carpeta.'/web/'.$fichero;
//			$str.= $co;
			$str.= "<i>".calcular_tiempo($timpo)."</i>".$archivo_subido;
			$str.= "</label>";
			$str.= "<input type='checkbox' id='co_".$co."' onclick='paint_all(".$co.");' $archivo_cheked
 class='coss co_todos $coco ' value='".$co."' >";
			$str.= "</li>";

			if($ppppp_p==0){
			$TTiempos[$co]=$str;
			}

			$archivo_subido='';

		}
	}



	$directorio->close();


	}
	$ppppp_p++;
//	echo "cerrando";
	if($SUBIRFTP){
	ftp_close($conn_id[$ppppp]);
	}
	else
	{

	if($_GET['files']!='' or $_GET['files2']!=''){

	 function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
		   }
		 }
		 reset($objects);
		 rmdir($dir);
	   }
	 }

 	rrmdir("panel/zip/www");

	$basee="panel/zip";
	foreach($PARA_SUBIR as $pb){
		$remo=$pb['remoto'];
		$remo=str_replace("//","/","/".$remo);
		$remoA=explode("/",$remo);
		$lon=sizeof($remoA)-1;
		$pat=$basee;
		for($i=0;$i<$lon;$i++){
			$pat.=$remoA[$i]."/";
			//echo "$pat<br>";
			if($pat!=$basee.'/'){
				mkdir($pat);
			}
		}
		copy($pb['local'],$basee.$pb['remoto']);
	}

	$ddir=getcwd();
	copy("tar.exe","panel/zip/tar.exe");
	chdir("panel/zip/");
	exec("tar -cvf ../packed/packed.tar www/");
	unlink("tar.exe");
	chdir($ddir);

 	rrmdir("panel/zip/www");


	@set_time_limit(0);

	$conn_id[$ppppp] = ftp_connect($proyectoC['REMOTE_FTP']['ftp_files_host'],21,20);
	$login_result[$ppppp] = ftp_login($conn_id[$ppppp], $proyectoC['REMOTE_FTP']['ftp_files_user'], $proyectoC['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id[$ppppp], true);

	echo "<div>subiendo ".$proyectoC['REMOTE_FTP']['ftp_files_host']. " ". ( ($login_result[$ppppp])?'conectado':'no conectado' )."</div>";

	//echo (file_exists("panel/packed/packed.tar"))?"tar existe":"tar no existe";

	$archivo_subido = (ftp_put($conn_id[$ppppp],"/packed.tar", "panel/packed/packed.tar", FTP_BINARY))?" <span style='color:green;' >subío
	</span>":" <span style='color:red;'>no pudo subir</span>";

	ftp_close($conn_id[$ppppp]);

	echo "packed.tar ".$archivo_subido;

	unlink("panel/packed/packed.tar");


	}



	}


	//echo "<div>".$conn_id[$ppppp]."</div>";
	}//fin de bucle

	chdir($directo);

	arsort($tiempos);

//	print_rr($tiempos);
	if($MASTER){

	echo "<h3 style='clear:left;'>Listado de proyecto</h3>";

	$Proyeectos= select(
        "id,logo,nombre,descripcion,dominio,ftp_user,ftp_pass,ftp_root,carpeta,seguro,fecha_creacion,para_subir"
        ,"proyectos"
        ,"where 1 and para_subir='1' order by id asc limit 0,100"
        ,0
        ,array(

                'carpeta'=>'proy_imas'
                ,'tamano'=>'1'
                ,'dimensionado'=>'100x100'
                ,'centrado'=>'1'
                ,'get_atributos'=>array('get_atributos'=>array(
                                            'carpeta'=>'{carpeta}'
                                            ,'fecha'=>'{fecha_creacion}'
                                            ,'file'=>'{logo}'
                                            ,'tamano'=>'{tamano}'
                                            ,'dimensionado'=>'{dimensionado}'
                                            ,'centrado'=>'{centrado}'
                                            )
                                        )
                ,'get_archivo'=>array('get_archivo'=>array(
                                            'carpeta'=>'{carpeta}'
                                            ,'fecha'=>'{fecha_creacion}'
                                            ,'file'=>'{logo}'
                                            ,'tamano'=>'{tamano}'
                                            )
                                        )
              )
        );



	echo "<ul class='listado'>";

		echo "<div><input type='checkbox' id='costodos' onclick='seleccionar_allproy(this)' style='position:absolute;top:-16px;right:1px;' /></div>";

		echo "<div><a href='#' onclick='javascript:actualizar_seleccionados(\"updatecode\"); return false;' rel='nofollow' id='link_actualizar' style='color:#000;background-color:#DDDC1B;' >Actualizar seleccionados</a></div>";



		foreach($Proyeectos as $Proyeec){

		echo "<li id='clili_".$Proyeec['id']."' class='clili ". ( (!(strpos($dire,"panel")===false))?"li_panel":"li_web" ) ."'>
		<label for='cli_".$Proyeec['id']."'>
		<b>".$Proyeec['nombre']."</b>
		</label> ";

		echo "<input type='checkbox' id='cli_".$Proyeec['id']."' onclick='paint_cli(".$Proyeec['id'].");' ". (
		 (in_array($Proyeec['id'],$Proysy) or in_array($Proyeec['id'],$ProysyKu)   )?'checked':''
		 ) ." class='cli' value='".$Proyeec['id']."' >";

		echo "</li>";
		}

	echo "</ul>";

	}
    echo "<style>
	.listado a { margin-left:5px;font-weight:bold;letter-spacing:-1px; }
	</style>";
	 ?>
	 <?php
	echo "<h4 style='clear:left;'>Listado de archivos del proyecto <span style='color:red;'id='xelecionados'></span></h4>";

	echo "<ul class='listado'>";
	echo "<div>";
	echo "<a href='#' onclick=\"selec('_todos');return false;\" rel='nofollow' style='margin-left:0px;color:green;' >Todos</a>";
	echo "<a href='".$SERVER['BASE'].$SERVER['ARCHIVO_REAL']."?accion=alllistado&rann=".( rand() )."'>recargar</a>";
	echo "<a href='#' onclick=\"selec('_ul_0');return false;\" rel='nofollow'>ninguno</a>";
	echo "<a href='#' onclick=\"selec('_ul_2');return false;\" rel='nofollow'>2</a>";
	echo "<a href='#' onclick=\"selec('_ul_5');return false;\" rel='nofollow'>5</a>";
	echo "<a href='#' onclick=\"selec('_ul_10');return false;\" rel='nofollow'>10</a>";
	echo "<a href='#' onclick=\"selec('_ul_20');return false;\" rel='nofollow'>20</a>";
	echo "<a href='#' onclick=\"selec('_ul_30');return false;\" rel='nofollow'>30</a><br>";
	echo "<a style='color:blue;' href='#' onclick=\"selec('_root');return false;\" rel='nofollow'`title='carpeta raiz /' >root</a>";
	echo "<a style='color:blue;' href='#' onclick=\"selec('_web');return false;\" rel='nofollow' title='carpeta web/' >WEB</a>";
	echo "<a style='color:blue;' href='#' onclick=\"selec('_webmodulos');return false;\" rel='nofollow' title='carpeta web/modulos/' >web modulos</a>";
	echo "<a style='color:blue;' href='#' onclick=\"selec('_webtemplates');return false;\" rel='nofollow' title='carpeta web/templates/'>web templates</a>";
	echo "<a style='color:blue;' href='#' onclick=\"selec('_weblib');return false;\" rel='nofollow' title='carpeta web/templates/default/lib/' >web csslib</a>";
	echo "<a href='#' onclick=\"selec('_panel');return false;\" rel='nofollow' title='carpeta panel/'>todo panel</a>";
	echo "<a href='#' onclick=\"selec('_excel');return false;\" rel='nofollow' title='carpeta panel/PHPExcel/'>excel</a>";
	echo "<a href='#' onclick=\"selec('_panelimg');return false;\" rel='nofollow' title='carpeta panel/img'>panel imgs</a>";
	echo "<a href='#' onclick=\"selec('_docs');return false;\" rel='nofollow' title='Todos los archivos con extensión .doc'>docs</a>";

	echo "<a href='#' onclick=\"selec('_solopanel');return false;\" rel='nofollow'title='carpeta panel/ todos los archivos'>SÓLO PANEL</a>";
	echo "<a href='#' onclick=\"selec('_panelphp');return false;\" rel='nofollow' title='carpeta panel/ sólo .php y .css'>panel php</a>";

	echo "<a href='#' onclick=\"selec('_panelbase2');return false;\" rel='nofollow' title='carpeta panel/base2/'>BASE 2</a>";
	echo "<input type='checkbox' id='costodos' onclick='seleccionar_all(this)' >";

	echo "<a href='#' onclick='javascript:subir_seleccionados(\"alllistado\"); return false;' rel='nofollow' id='link_subir' style='color:#FCE8B0;font-size:13px;' >Subir Archivos Seleccionados</a>";

	echo "</div>";
	$acb=0;
	//print_rr($tiempos);
	foreach($tiempos as $aaa=>$bbb){

	echo $TTiempos[$aaa];
	if(date("U")-$bbb<3600*24 and $_GET['files']=='' and $_GET['files2']==''){
	echo "<script>
			\$('li_".$aaa."').setStyles({'background-color':'#FCE8B0'});
			\$('co_".$aaa."').checked=true;";
	echo "</script>\n";
	}

	if( $acb<2 ){ echo "<script> \$('co_".$aaa."').addClass('co_ul_2'); \$('li_".$aaa."').addClass('li_ul_2'); </script>\n"; }
	if( $acb<5 ){ echo "<script> \$('co_".$aaa."').addClass('co_ul_5'); \$('li_".$aaa."').addClass('li_ul_5'); </script>\n"; }
	if( $acb<10 ){ echo "<script> \$('co_".$aaa."').addClass('co_ul_10'); \$('li_".$aaa."').addClass('li_ul_10'); </script>\n"; }
	if( $acb<20 ){ echo "<script> \$('co_".$aaa."').addClass('co_ul_20'); \$('li_".$aaa."').addClass('li_ul_20'); </script>\n"; }
	if( $acb<30 ){ echo "<script> \$('co_".$aaa."').addClass('co_ul_30'); \$('li_".$aaa."').addClass('li_ul_30'); </script>\n"; }


	$acb++;

	}
	echo "</ul>";


	?>
    <script>
	if($('div_loading')){ $0('div_loading'); }
	</script>
    <?php
}




















if($_GET['accion']=='enviar_email_password' ){

	$body="

	Datos de ".$vars['REMOTE_FTP']['ftp_files_host']."

	FTP
	---
	HOST : ".$vars['REMOTE_FTP']['ftp_files_host']."
	USUARIO : ".$vars['REMOTE_FTP']['ftp_files_user']."
	PASSWORD : ".$vars['REMOTE_FTP']['ftp_files_pass']."

";
	if($_GET['panel']=='1'){
	$body.="PANEL
	-----
	http://".$vars['REMOTE_FTP']['ftp_files_host']."/panel
	Usuario : ". (  select_dato('nombre',"usuarios_acceso","where 1 ",0) )."
	Password : ". (  select_dato('password',"usuarios_acceso","where 1 ",0) )."


	";

	}
	if($_GET['gmail']=='1'){
	$body.="GMAIL
	-----
	URL de administración: https://www.google.com/a/".$vars['REMOTE_FTP']['ftp_files_host']."
	Nombre de usuario : administrador
	ContraseÃ±a : ".$vars['REMOTE_FTP']['ftp_files_pass']."

	URLs de acceso a cuentas de correo:
	http://mail.google.com/a/".$vars['REMOTE_FTP']['ftp_files_host']." Ã³
	http://".$vars['REMOTE_FTP']['ftp_files_host']."/email



	";
	}

	$EMAILS_PROYECTO=$vars['GENERAL']['emails_administrador'];
	$EMAILS_PROYECTO_A=explode(",",$EMAILS_PROYECTO);
	foreach($EMAILS_PROYECTO_A as $EMAIL_A){
	echo (SendMAIL($EMAIL_A,"Datos de ".$vars['REMOTE_FTP']['ftp_files_host'],$body,"","notificaciones@crazyosito.com","Panel"))?"<h1>envio exitoso G</h1>":"<h1>envio fallido G</h1>";
	}

	redireccionar_load_referer();

}

if($_GET['accion']=='crear_archivo_verificacion' ){


function crear_gif_en_marco($file_temp,$ancho_ideal,$alto_ideal)
{
	// Crer imagen dinamica dependiendo del tipo es la funcion q usaremos.
	list($file,$ext)=explode(".",$file_temp);

	switch($ext)
	{   case "jpg":
	        $img = imagecreatefromjpeg($file_temp);
	    break;
	    case "gif":
	        $img = imagecreatefromgif($file_temp);
	    break;
	    case "png":
	        $img = imagecreatefrompng($file_temp);
	    break;
	}
	// dimensiones reales
    $ancho_real = imagesx($img);
    $alto_real  = imagesy($img);
	// hacer una escala
    if($ancho_real < $ancho_ideal && $alto_real < $alto_ideal) // imagen pequeÃ±a, no pasa nada
    {
		$escala_x = $ancho_real;
    	$escala_y = $alto_real;
    }
    elseif( $ancho_real >= $ancho_ideal || $alto_real >= $alto_ideal )
    {
		$escala_x = $ancho_real;
    	$escala_y = $alto_real;
        if( $escala_x > $ancho_ideal)                          // si es muy ancha, escalar de acuerdo al ancho
        {
			$escala_x = $ancho_ideal;
			$escala_y = $alto_real*($escala_x/$ancho_real);
        }
        if( $escala_y > $alto_ideal)
        {
			$escala_y = $alto_ideal;                          // si es muy alta, escalar de acuerdo al alto
	    	$escala_x = $ancho_real*($escala_y/$alto_real);
        }
    }
	// crear papel de imÃ¡gen, ImageCreateTrueColor para no perder colores
	$miniatura = ImageCreateTrueColor($ancho_ideal,$alto_ideal);

	$white = imagecolorallocate($miniatura, 250, 250, 250);

	imagefilledrectangle($miniatura, 0, 0, $ancho_ideal,$alto_ideal, $white);
	// imprimir la imagen redimensionada
    imagecopyresampled($miniatura,$img
									,( ($ancho_ideal>$escala_x)?round(($ancho_ideal-$escala_x)/2):0 )
									,( ($alto_ideal>$escala_y)?round(($alto_ideal-$escala_y)/2):0 )
									,0,0
									,$escala_x,$escala_y
									,$ancho_real,$alto_real);
    // guardar la imagen como $file_dest
	imagegif($miniatura,$file."_email.gif",100);

}

crear_gif_en_marco($vars['GENERAL']['img_logo'],143,59);



	$arch="googlehostedservice.html";
	$f1=fopen($arch,"w+");
	fwrite($f1,"googleb286641876ac8feb");
	fclose($f1);

	$arch00="google82a9913b19fdf5eb.html";
	$f1=fopen($arch00,"w+");
	fwrite($f1,"google-site-verification: google82a9913b19fdf5eb.html");
	fclose($f1);

	$arch3="googlef8678768a81fd11c.html";
	$f1=fopen($arch3,"w+");
	fwrite($f1,"google-site-verification: googlef8678768a81fd11c.html");
	fclose($f1);

	$arch2="temp.html";
	$f1=fopen($arch2,"w+");
	fwrite($f1,"<html><body onload=\"location.href='http://mail.google.com/a/".str_replace("www.","",$vars['REMOTE_FTP']['ftp_files_host'])."';\"></body></html>");
	fclose($f1);

	@$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21);
	@$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);

	ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$arch, $arch, FTP_BINARY);
	ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$arch00, $arch00, FTP_BINARY);
	ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/".$arch3, $arch3, FTP_BINARY);
	ftp_mkdir($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/email");
	ftp_put($conn_id, $vars['REMOTE_FTP']['ftp_files_root']."/email/index.php", $arch2, FTP_BINARY);

	unlink($arch);
	unlink($arch2);

	$directorio->close();


	redireccionar_load_referer();


}

if($_GET['accion']=='borrarcustom' ){
	$directorio = dir("./$DIR_CUSTOM");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..'){
		@unlink($DIR_CUSTOM.$fichero);
		}
	}
	$directorio->close();
	redireccionar();
}
if($_GET['accion']=='recrearcustom' ){
	foreach($objeto_tabla as $ot){

		$f1=fopen($DIR_CUSTOM.$ot['archivo'].".php","w+");

$html="<?php
chdir(\"../\");
include(\"lib/compresionInicio.php\");
include(\"lib/includes.php\");
include(\"head.php\");
echo '<body class=\"modulo_".$ot['archivo']."\">';
echo \$HTML_ALL_INICIO;
echo \$HTML_MAIN_INICIO;
include(\"header.php\");
echo \$HTML_CONTENT_INICIO;
include(\"menu.php\");
\$MEEE=\$objeto_tabla[\"".$ot['me']."\"];
include(\"vista.php\");
echo \$HTML_CONTENT_FIN;
include(\"foot.php\");
echo \$HTML_MAIN_FIN;
echo \$HTML_ALL_FIN;
echo '</body>';
echo '</html>';
include(\"lib/compresionFinal.php\");
?>";

		fwrite($f1,utf8_encode($html));
		fclose($f1);
//		echo $DIR_CUSTOM.$ot['archivo'].".php<br>";
		@unlink($DIR_CUSTOM.$ot['archivo']."_vista.php");

	}
	redireccionar();

}

if($_GET['accion']=='borrarmemory' ){
	unlink("config/memory.txt");
	redireccionar();
}


if( ($_GET['check']=='ftp' ) and (
		!file_exists($ftp_files_host.$DIRECTORIO_IMAGENES) and
		!file_exists($ftp_files_host.$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP) and
		!file_exists($ftp_files_host.$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD)
		)
	){
//if( ($_GET['check']!='ftp' ) ){

	if(0){
	//if($Local==1){
		@mkdir("../".$DIRECTORIO_IMAGENES);
		@mkdir("../".$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP);
		@mkdir("../".$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD);
		redireccionar();
	} else {

		// abrir conexion ftp y loguearse
		$conn_id = ftp_connect($ftp_files_host,21,20);
		//echo (($conn_id)?1:0 )."<br>";
		$login_result = ftp_login($conn_id, $ftp_files_user, $ftp_files_pass);ftp_pasv($conn_id, true);
		//echo (($login_result)?1:0 )."<br>";
		ftp_mkdir($conn_id, $ftp_files_root.$DIRECTORIO_IMAGENES);
		echo "<br>creando dir ".$ftp_files_root.$DIRECTORIO_IMAGENES."<br>";
		cambiar_permisos($ftp_files_root.$DIRECTORIO_IMAGENES);

		ftp_mkdir($conn_id, $ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP);
		echo "<br>creando dir ".$ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP."<br>";
		cambiar_permisos($ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP);

		ftp_mkdir($conn_id, $ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD);
		echo "<br>creando dir ".$ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD."<br>";
		cambiar_permisos($ftp_files_root.$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD);

		ftp_close($conn_id);


		if($login_result)
			redireccionar();
		else
			redir("maquina.php?check=ftp");


	}

}

if($_GET['me']==''){


if( $_GET['accion']=='creararchivostablaall' ){


foreach($objeto_tabla as $ME=>$ot){

	$sqli= script_create_table($objeto_tabla[$ME]);
	mysqli_query($link,$sqli);

/*
	$f1=fopen($DIR_CUSTOM.$objeto_tabla[$ME]['archivo'].".php","w+");
	$html="<?php
chdir(\"../\");
include(\"lib/compresionInicio.php\");
include(\"lib/includes.php\");
include(\"head.php\");
echo '<body class=\"modulo_".$ot['archivo']."\">';
echo \$HTML_ALL_INICIO;
echo \$HTML_MAIN_INICIO;
include(\"header.php\");
echo \$HTML_CONTENT_INICIO;
include(\"menu.php\");
\$MEEE=\$objeto_tabla[\"".$ME."\"];
include(\"vista.php\");
echo \$HTML_CONTENT_FIN;
include(\"foot.php\");
echo \$HTML_MAIN_FIN;
echo \$HTML_ALL_FIN;
echo '</body>';
echo '</html>';
include(\"lib/compresionFinal.php\");
?>";
	fwrite($f1,utf8_encode($html));
	fclose($f1);

	@unlink($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo']."_vista.php");

	*/

	}

	redireccionar();

}


} else {

?>

<div class='cuadro_codigo bloque'>
<?php
//prin($objeto_tabla[$_GET['me']],"#FFFFFF");
$sql= script_create_table($objeto_tabla[$_GET['me']]);
$sql2=$sql;

$li4=array();

foreach($all['form'] as $ca){
	if(!in_array(array(
						$all['id']
						,$all['fcr']
						,$all['fed']
						,$all['pos']
						,$all['vis']
					  )
				,$ca['campo']))
	{
		$li4[]=$ca['campo'];
	}
}

foreach($li4 as $li3){
$sql2=str_replace("`".$li3."`","<span style='color:red;'>`".$li3."`</span>",$sql2);
}
echo nl2br($sql2);
?>
</div>
<?php

//INICIO DE ACCIONES

echo "<div style='clear:left;'></div>";


if( $_GET['me']!='' and ( $_GET['accion']=='actualizartabla') ){

	$sqles=get_columns_from_objeto($objeto_tabla[$_GET['me']]);

	// prin($sqles);exit();

	if(sizeof($sqles)>0){
		foreach($sqles as $sqle){
			mysqli_query($link,$sqle);
		}
	}

	redireccionar();
	//exit();

}




if( $_GET['me']!='' and $_GET['accion']=='truncatetable' ){

	function ftp_rmAll($conn_id,$dst_dir){
		$ar_files = ftp_nlist($conn_id, $dst_dir);
		//var_dump($ar_files);
		if (is_array($ar_files)){ // makes sure there are files
			for ($i=0;$i<sizeof($ar_files);$i++){ // for each file
				$st_file = $ar_files[$i];
				if($st_file == '.' || $st_file == '..') continue;
				if (ftp_size($conn_id, $dst_dir.'/'.$st_file) == -1){ // check if it is a directory
					ftp_rmAll($conn_id,  $dst_dir.'/'.$st_file); // if so, use recursion
				} else {
					ftp_delete($conn_id,  $dst_dir.'/'.$st_file); // if not, delete the file
				}
			}
		}
		$flag = ftp_rmdir($conn_id, $dst_dir); // delete empty directories
		return $flag;
	}

	//if($objeto_tabla[$_GET['me']]['bloqueado']!='1'){
		mysqli_query($link,"TRUNCATE TABLE `".$objeto_tabla[$_GET['me']]['tabla']."`");
	//}

	//redireccionar();



	$DIRECTORIO_IMAGENES=$vars['GENERAL']['DIRECTORIO_IMAGENES'];

	if($vars['GENERAL']['MODO_LOCAL_ARCHIVOS_REMOTOS']){

		$conn_id = ftp_connect($vars['REMOTE_FTP']['ftp_files_host'],21);

		$login_result = ftp_login($conn_id, $vars['REMOTE_FTP']['ftp_files_user'], $vars['REMOTE_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);

		$ruut=$vars['REMOTE_FTP']['ftp_files_root'];

	} else {

		$conn_id = ftp_connect($vars['LOCAL_FTP']['ftp_files_host'],21);

		$login_result = ftp_login($conn_id, $vars['LOCAL_FTP']['ftp_files_user'], $vars['LOCAL_FTP']['ftp_files_pass']);ftp_pasv($conn_id, true);

		$ruut=$vars['REMOTE_FTP']['ftp_files_root'];

	}


	$carpetas=array();
	//prin($objeto_tabla[$_GET['me']]['campos']);
	foreach($objeto_tabla[$_GET['me']]['campos'] as $campoo){
	if($campoo['tipo']=='img'){
	$carpetas[]=$campoo['carpeta'];
	}
	}

	echo "TRUNCATE ".str_replace("//","/",$ruut.$DIRECTORIO_IMAGENES."/".$carpeta);
	//prin($carpetas);
	foreach($carpetas as $carpeta){
	//prin($ruut.$DIRECTORIO_IMAGENES."/".$carpeta);
	prin(ftp_rmAll($conn_id,str_replace("//","/",$ruut.$DIRECTORIO_IMAGENES."/".$carpeta)));

	}

	redir("maquina.php?me=".$_GET['me']);

}


if( $_GET['me']!='' and ( $_GET['accion']=='creartabla' or $_GET['accion']=='creararchivostabla') ){
	$sqls=explode(";",$sql);
	foreach($sqls as $sql){
		mysqli_query($link,$sql);
	}
	if( $_GET['accion']=='creararchivostabla' ){
		$_GET['accion']='creararchivos';
	} else {
		redireccionar();
	}
}
if( $_GET['me']!='' and ( $_GET['accion']=='borrartabla' or $_GET['accion']=='borrararchivostabla') ){
	if($objeto_tabla[$_GET['me']]['bloqueado']!='1'){
		// echo 'borrando.....';
		mysqli_query($link,"DROP TABLE `".$objeto_tabla[$_GET['me']]['tabla']."`");
	}
	if( $_GET['accion']=='borrararchivostabla' ){
		$_GET['accion']='borrararchivos';
	} else {
		redireccionar();
	}
}
if( $_GET['me']!='' and $_GET['accion']=='borrararchivos' ){

	@unlink($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo'].".php");
	@unlink($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo']."_vista.php");
	redireccionar();

}
if( $_GET['me']!='' and $_GET['accion']=='recreararchivos' ){

	@unlink($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo'].".php");
	@unlink($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo']."_vista.php");
	$_GET['accion']='creararchivos';

}
if( $_GET['me']!='' and $_GET['accion']=='creararchivos' ){

	$f1=fopen($DIR_CUSTOM.$objeto_tabla[$_GET['me']]['archivo'].".php","w+");
	$html="<?php
chdir(\"../\");
include(\"lib/compresionInicio.php\");
include(\"lib/includes.php\");
include(\"head.php\");
echo '<body class=\"modulo_".$objeto_tabla[$_GET['me']]['archivo']."\">';
echo \$HTML_ALL_INICIO;
echo \$HTML_MAIN_INICIO;
include(\"header.php\");
echo \$HTML_CONTENT_INICIO;
include(\"menu.php\");
\$MEEE=\$objeto_tabla[\"".$_GET['me']."\"];
include(\"vista.php\");
echo \$HTML_CONTENT_FIN;
include(\"foot.php\");
echo \$HTML_MAIN_FIN;
echo \$HTML_ALL_FIN;
echo '</body>';
echo '</html>';
include(\"lib/compresionFinal.php\");
?>";
	fwrite($f1,utf8_encode($html));
	fclose($f1);

redireccionar();

}

//FIN DE ACCIONES

?>
</div>

<div style="padding:4px 0px;">


<div class="cuadro_codigo bloque" style="clear:left; position:relative;">
<?php
//$bloque_separacion="/******************************************************************************************************************************************************/";

/*
$file_tablas_a=file("config/tablas.php");
foreach($file_tablas_a as $bt){
if(trim($bt)!=""){
$file_tablas_a2[]=rtrim(str_replace(array("\t","&nbsp;"),array("  "," "),$bt))."\n";
}
}
$file_tablas=str_replace(array("<?php","?>",$bloque_separacion),array("","",""),implode("",$file_tablas_a2));
$bloques_tablas=explode(";",$file_tablas);
foreach($bloques_tablas as $blota){
	if(!(strpos($blota,"objeto_tabla['".$_GET['me']."']")===false)){


		echo "<a href='#' onclick='javascript:grabar_objeto(); return false;' rel='nofollow' style='float:right; position:absolute; right:0px; top:0px; background-color:yellow;font-weight:bold;padding:3px;' >guardar objeto</a>";
		echo "<textarea style='width:932px; height:auto; background-color:#333333; color:white;' id='textobjeto' >"; echo(trim($blota).";"); echo "</textarea>";
	}
}
*/
}
}
?>
<?php



break;

}

echo '<div style="float:left;clear:left;">';
prin($_SESSION);
prin($_COOKIE);
echo "<form method='post' action='maquina.php?accion=borrarsesion' style='margin-top:20px; border:1px solid red; padding:5px;'>borrar \$_SESSION y \$_COOKIES<input type='text' name='session'><input type='button' value='borrar'></form>";
echo '</div>';

?>

<div>&nbsp;</div>
</div>