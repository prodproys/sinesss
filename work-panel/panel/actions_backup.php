<?php //á

$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

include("lib/global.php");

$link=mysql_connect ($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
mysql_select_db ($MYSQL_DB,$link);
mysql_query("SET NAMES 'utf8'",$link);

include("lib/mysql3.php");
include("lib/util2.php");
if($vars['GENERAL']['esclavo']!='1'){
	include("config/tablas.php");
}
include("lib/sesion.php");
include("lib/playmemory.php");

$_GET['accion']=($_GET['accion']=='')?'dump':$_GET['accion'];

switch($_GET['accion']){
	case "dump":
		$delimeter="\n#\n";
		//$delimeter="\n";
		/* Conexion y eso*/
		$link=mysql_connect ($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
		mysql_select_db ($MYSQL_DB,$link);
		mysql_query("SET NAMES 'utf8'",$link);

		$tablas3=array();
		$tablas3=explode(",",$_GET['tablas']);

		/* Se busca las tablas en la base de datos */
		if ( empty($tablas2) ) {
			$consulta = "SHOW TABLES FROM $MYSQL_DB;";
			$respuesta = mysql_query($consulta, $link)
			or die("No se pudo ejecutar la consulta: ".mysql_error());
			while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
				if($_GET['tablas']==''){
					$tablas2[] = $fila[0];
				} else {
					if(in_array($fila[0],$tablas3)){
						$tablas2[] = $fila[0];
					}
				}
			}
		}

		$dump = "";
		foreach ($tablas2 as $tabla) {
			 
			 
			/* Se halla el query que será capaz vaciar la tabla. */
			$dump.= "DROP TABLE IF EXISTS `$tabla`;$delimeter";


			/* Se halla el query que será capaz de recrear la estructura de la tabla. */

			$consulta = "SHOW CREATE TABLE $tabla;";
			$respuesta = mysql_query($consulta, $link)
			or die("No se pudo ejecutar la consulta: ".mysql_error());
			while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
				$dump.= $fila[1].";$delimeter";
			}
			 
			/* Se halla el query que será capaz de insertar los datos. */
			$consulta = "SELECT * FROM $tabla;";
			$respuesta = mysql_query($consulta, $link)
			or die("No se pudo ejecutar la consulta: ".mysql_error());
			while ($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)) {
				$columnas = array_keys($fila);
				foreach ($columnas as $columna) {
					if ( gettype($fila[$columna]) == "NULL" ) {
						$values[] = "NULL";
					} else {
						$values[] = "\"".mysql_real_escape_string($fila[$columna])."\"";
					}
				}
				$dump.= "INSERT INTO `$tabla` VALUES (".implode(", ", $values).");$delimeter";
				unset($values);
			}
			 
		}
		//echo $dump;
		$dump.="#gl#\n";
		if(!file_exists("backup")){
			mkdir("backup");
		}
		if(!file_exists("backup/".date("Y"))){
			mkdir("backup/".date("Y"));
		}
		if(!file_exists("backup/".date("Y")."/".date("m"))){
			mkdir("backup/".date("Y")."/".date("m"));
		}
		$file="backup-".date("Y-m-d_H_i_s").".sql";
		$f1=fopen("backup/".date("Y")."/".date("m")."/".$file,"w+");fwrite($f1,$dump);fclose($f1);
		echo "<html><head></head><body><script>parent.update_backups('".date("Y/m/")."');</script>";
		if(file_exists("backup/".date("Y")."/".date("m")."/".$file)){
			echo "BACKUP CREADO CON ÉXITO";
		}
		else { echo "ERROR AL CREAR BACKUP";
		}
		echo "</body></html>";
		break;
	case "delete":
		$anio=substr($_GET['file'],7,4);
		$mes=substr($_GET['file'],12,2);
		unlink("backup/$anio/$mes/".$_GET['file']);
		if(file_exists("backup/$anio/$mes/".$_GET['file'])){
			echo "0";
		}
		else { echo "1";
		}
		break;
	case "restore":
		$anio=substr($_GET['file'],7,4);
		$mes=substr($_GET['file'],12,2);
		$mysqldump=file_get_contents("backup/$anio/$mes/".$_GET['file']);
		//echo $mysqldump;
		/*
		 $oksql=mysql_query($mysqldump,$link);
		echo ($oksql)?1:0;
		*/
		//$delimeter="\n#\n#\n";
		$delimeter="\n#\n";
		$MYSQL=explode(";$delimeter",$mysqldump);
		if(sizeof($MYSQL)>0){
			foreach($MYSQL as $sqle){
				if(trim($sqle)!=''){
					$oksql=mysql_query($sqle.";",$link);
					/*
					 echo ($oksql)?"<div>$sqle<span style='color:green;'>ok</span></div>":"<div><textarea style='width:94%;height:50px;'>$sqle</textarea><span style='color:red;'>ko</span></div>";
					*/
				}
			}
		}
		echo "1";
		break;
}


?>