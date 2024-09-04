<?php //á


$bloque_separacion="/******************************************************************************************************************************************************/";

$file_tablas_a=file("config/tablas.php");
foreach($file_tablas_a as $bt){
	if(trim($bt)!=""){
		$file_tablas_a2[]=str_replace(array("\t",$bloque_separacion,"&nbsp;"),array("  ",""," "),$bt);
	}
}
$file_tablas=str_replace(array("<?php","?>"),array("",""),implode("",$file_tablas_a2));
$bloques_tablas=explode(";",$file_tablas);

if(trim($_POST['textobjeto'])==''){

	foreach($bloques_tablas as $i=>$blota){
		if(!(strpos($blota,"objeto_tabla['".$_POST['me']."']")===false)){
			//if(isset($objeto_tabla[$_POST['me']])){
			$bloques_tablas[$i]="";
			//}
		}
	}

} else {

	foreach($bloques_tablas as $i=>$blota){
		if(!(strpos($blota,"objeto_tabla['".$_POST['me']."']")===false)){
			$fftt=explode("\n",$_POST['textobjeto']);
			foreach($fftt as $ft){
				if(trim($ft)!=""){
					$file_tablas_a3[]=$ft;
				} else {
					$file_tablas_a3[]="//";
				}
			}
			$php=str_replace(";","",implode("\n",$file_tablas_a3));
			@eval($php.";");
			if(isset($objeto_tabla[$_POST['me']])){
				$bloques_tablas[$i]=$php;
			}
		}
	}

}

$filetxt="<?php \n".$bloque_separacion."\n\n\n".implode(";\n\n\n".$bloque_separacion."\n\n\n",$bloques_tablas)."\n ?>";

@unlink("config/tablas_copy.php");
//rename("config/tablas.php","config/tablas_copy.php");

$f1=fopen("config/tablas.php","w+");
fwrite($f1,$filetxt);
fclose($f1);

?>