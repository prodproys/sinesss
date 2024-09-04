<?php

$_GET=($_SERVER['REQUEST_METHOD']=='POST')?$_POST:$_GET;

include("../../panel/lib/webutil.php");

list($local,$dos)=explode($vars['INTERNO']['CARPETA_PROYECTO'],$SERVER['BASE']);
/*
$Url_panel_lib=$vars['LOCAL']['url_publica']."/web/templates/".THEME_PATH."/css/";
$Path_panel_lib="../templates/".THEME_PATH."/css/lib/";
*/
$Url_panel_lib=$local."/panel/csslib/";

$Path_panel_lib="../../../panel/csslib/";

web_guardar_datos($_GET);


if($_GET['file']=='css' and $_GET['var']=='CLASSSELECTED'){

	include("master.php");

	include("loaders.php");

	$patronParentesis = '/\(([^(]+)\)/';

	foreach($WEBBLOQUES as $key=>$obj){

		$objA=array();
		$objA=explode(",",$obj);

		foreach($objA as $ob){

			$obj2['id_class']=$key."-".$ob;
			$obj2['carpeta']=$ob;
			$obj2['selected']=$CLASSSELECTED[$obj2['id_class']];
			$iidd=$obj2['id_class'];
			$carpeta=$obj2['carpeta'];

			$ccssss[$obj2['id_class']."|".$obj2['carpeta']."/".$CLASSSELECTED[$obj2['id_class']]]=$obj2['carpeta']."/".$CLASSSELECTED[$obj2['id_class']];

		}

	}

	/*
	foreach($OBJECT_CSS as $oc){
		$ccssss[$oc['carpeta']."/".$CLASSSELECTED[$oc['id_class']]]=$oc['carpeta']."/".$CLASSSELECTED[$oc['id_class']];
	}
	*/

	$directorio="../templates/".THEME_PATH."/lib/";
	$directorio_s = dir($directorio);
	while($fichero=$directorio_s->read()) {
		if($fichero!='.' and $fichero!='..'  and !is_dir($archivo) ){
			unlink($directorio."/".$fichero);
		}
	}
	$directorio_s->close();

	foreach($ccssss as $Nam=>$cs){

		list($name,$ex)=explode("|",$Nam);
		$uurrll=$Url_panel_lib.$cs."/css.css?name=".$name."&".str_replace("#","",$CLASSPARAMETERS[$name]);

		//debug
		$uurrll=str_replace(" ","%20",$uurrll);
		echo "-".strtoupper($name)." ".$cs."\n"; 	echo " ".$uurrll."\n\n";

		$bbb=file_get_contents($uurrll);
	//	echo $Url_panel_lib."lib/".$cs."/css.css"."\n\n\n\n\n\n\n\n\n\n\n";
		preg_match_all($patronParentesis, $bbb, $matches);
		foreach($matches[1] as $match){
			if(file_exists($Path_panel_lib."/".$cs."/".$match)){
				copy($Path_panel_lib."/".$cs."/".$match, "../templates/".THEME_PATH."/lib/".str_replace("/","_",$cs)."_".$match);
			}
		}

			$buf[]=str_replace('url(', 'url('.str_replace("/","_",$cs)."_",$bbb);

	}

	$buff_temp='';

	$buff=implode("\n",$buf);

	$buff.="\n\n\n";

	if(sizeof($HEAD['INCLUDES']['style_common'])>0){
	foreach($HEAD['INCLUDES']['style_common'] as $linea){
	$buff.=$linea."\n";
	$buff_temp.=$linea."\n";
	}
	}


//	$buff_base=implode("",file("../templates/".THEME_PATH."/css/css.css"));
	// $buff_base=implode("",file("../../panel/lib/bridge/css.css"));

	//print_r(file("../templates/".THEME_PATH."/css/css_particular.php"));

	// $buff_base_particular=file_get_contents(str_replace("modulos/lib/","",$SERVER['BASE'])."templates/".THEME_PATH."/css/css_particular.php");

	//@$buff_base_particular=implode("",file("../templates/".THEME_PATH."/css/css_particular.php"));

	// if(sizeof($FLOTANTES)>0){
	// foreach($FLOTANTES as $class=>$ccssss){
	// $buff.=".".$class." { ".$ccssss." }\n";
	// $buff_temp.=".".$class." { ".$ccssss." }\n";
	// }
	// }

	// $buff=$buff_base.$buff.$buff_base_particular;
	//$buff=$buff_base_particular;
	//$buff=str_replace("modulos/lib/","",$SERVER['BASE'])."templates/".THEME_PATH."/css/css_particular.php";



	// $f1=fopen("../templates/".THEME_PATH."/lib/css.css","w+");
	// fwrite($f1,$buff);
	// fclose($f1);

	// $f10=fopen("../templates/".THEME_PATH."/lib/css_temp.css","w+");
	// fwrite($f10,$buff_temp);
	// fclose($f10);

	$buff_jss=array();
	foreach($JSC['js'] as $jsss){
		$buff_jss[]=implode("",file("../templates/".THEME_PATH."/".$jsss));
	}

	$buff_jss[]=implode("\n",$JSC['script']);

	$buffjs=implode("",$buff_jss);

	$f2=fopen("../templates/".THEME_PATH."/lib/js.js","w+");
	fwrite($f2,$buffjs);
	fclose($f2);


	$urlcommon="common.php";
	$buff_A=file($urlcommon);
	foreach($buff_A as $y=>$ba){
		//echo $ba;
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
	}

}




?>