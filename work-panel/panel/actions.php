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


if( $_GET['accion']=='changepage' ){
	$_SESSION['page']=$_GET['id'];
	if(enhay($_SERVER['HTTP_REFERER'],'custom')){
		list($uno,$referer,$tres)=between($_SERVER['HTTP_REFERER'],"custom/",".php");
		$third='';
		foreach($objeto_tabla as $oto){
			if($oto['archivo'].".php"==$FILE_DEFAULT){
				if($_SESSION['page']!='' and $oto['page']==1){
					$second=$DIR_CUSTOM.$FILE_DEFAULT;
				}
				if($_SESSION['page']=='' and $oto['page']!=1){
					$second=$DIR_CUSTOM.$FILE_DEFAULT;
				}
			}
			if($oto['archivo']==$referer){
				if($_SESSION['page']!='' and $oto['page']==1){
					$first=$_SERVER['HTTP_REFERER'];
				}
				if($_SESSION['page']=='' and $oto['page']!=1){
					$first=$_SERVER['HTTP_REFERER'];
				}
			}
			if($oto['disabled']!=1 and $oto['menu']!=0 and $third==''){
				if($_SESSION['page']!='' and $oto['page']==1){
					$third=$DIR_CUSTOM.$oto['archivo'].".php";
				}
				if($_SESSION['page']=='' and $oto['page']==0){
					$third=$DIR_CUSTOM.$oto['archivo'].".php";
				}
			}
		}
		redireccionar_a(($first)?$first:(($second)?$second:$third));
	}
}

if( $_GET['accion']=='changeweb' ){
	$_SESSION['web']=$_GET['id'];
	if(enhay($_SERVER['HTTP_REFERER'],'custom')){
		list($uno,$referer,$tres)=between($_SERVER['HTTP_REFERER'],"custom/",".php");
		$third='';
		foreach($objeto_tabla as $oto){
			if($oto['archivo'].".php"==$FILE_DEFAULT){
				if($_SESSION['web']!='' and $oto['web']==1){
					$second=$DIR_CUSTOM.$FILE_DEFAULT;
				}
				if($_SESSION['web']=='' and $oto['web']!=1){
					$second=$DIR_CUSTOM.$FILE_DEFAULT;
				}
			}
			if($oto['archivo']==$referer){
				if($_SESSION['web']!='' and $oto['web']==1){
					$first=$_SERVER['HTTP_REFERER'];
				}
				if($_SESSION['web']=='' and $oto['web']!=1){
					$first=$_SERVER['HTTP_REFERER'];
				}
			}
			if($oto['disabled']!=1 and $oto['menu']!=0 and $third==''){
				if($_SESSION['web']!='' and $oto['web']==1){
					$third=$DIR_CUSTOM.$oto['archivo'].".php";
				}
				if($_SESSION['web']=='' and $oto['web']==0){
					$third=$DIR_CUSTOM.$oto['archivo'].".php";
				}
			}
		}
		redireccionar_a(($first)?$first:(($second)?$second:$third));
	}
}

?>