<?php 



$Open=(
		$_COOKIE['admin']=='1'
		and $vars['GENERAL']['mostrar_toolbars']=='1'
		and $_GET['block']!='form'
		//and $_SESSION['edicionpanel']=='1'
)?1:0;

foreach($objeto_tabla as $item){
	if(enhay($SERVER['ARCHIVO'],$item['archivo'].".php") and $item['archivo']!=''){
		$this_grupo=$item['grupo'];
		$this_me=$item['me'];
	}
}

if($this_me){

	if($objeto_tabla[$this_me]['page']==1){
		$filtrar_page2=1;	$_SESSION['page']=($_SESSION['page']!='' and in_array($_SESSION['page'],$IdPageS))?$_SESSION['page']:$IdPageS[0];
	}
	if($objeto_tabla[$this_me]['web']==1){
		$filtrar_web2=1;	$_SESSION['web']=($_SESSION['web']!=''  and in_array($_SESSION['page'],$IdWebS))?$_SESSION['web']:$IdWebS[0];
	}

}


foreach($objeto_tabla as $item){

	if(trim($item['app'])!=''){
		$item['app']=str_replace("'","\"",$item['app']);
		$aps=explode("<a",$item['app']);
		foreach($aps as $ap){
			if($ap!=""){
				$parts=between($ap,"href=\"","\"");
				$urla=parse_url($parts["1"]);
				$parames=parseParams($urla["query"]);
				if($SERVER['ARCHIVO']==$urla["path"] and $_GET["ap"]==$parames["ap"]){
					$this_grupo=$item["grupo"];
					$this_app_menu=$ap;
					$APP["file"]=$parames["ap"];
					$APP["nombre"]=strip_tags("<a".$ap);
				}
			}
		}
	}

}

foreach($objeto_tabla as $item){
	if($item["disabled"]!=1){
		$validos[]=$item["archivo"].".php";
	}
}



$script_name=$SERVER["ARCHIVO"];

?>
<div id="cover"
onclick='document.body.classList.toggle("menu_colapsed_mobile");return false;'
 ></div>

<a class="i_mmm mmm_d " 
title="Menú"
onclick='document.body.classList.toggle("menu_colapsed");fetch("ajax_change_cookie.php?var=men&val="+( (document.body.classList.contains("menu_colapsed"))?1:0 )+"&ajax=1");return false;'></a>

<a class="i_mmm mmm_m" 
title="Menú"
onclick='document.body.classList.toggle("menu_colapsed_mobile");return false;'></a>


<a href="./" class="logo_panel" title="<?=$html_titulo?>"><img src="<?php echo $img_logo?>" align="absmiddle" border="0" /></a>
<h1 class="link_header"><a href="./" title="<?=$html_titulo?>"><?=$html_titulo?></a></h1>
<?php

$MEME=($_GET['me'])?$_GET['me']:$this_me;


$ACCESO_PERMITIDO=(($VALIDAR_SESION!='' and $_SESSION['usuario_id']!='') or $_COOKIE['admin']==1)?1:0;


echo $objeto_tabla[$this_me]['onload_script'];
