<?php

function web_render_logo($COMMON,$props=""){
global $SERVER;
$html ='<a href="'.$COMMON['url_home'].'" id="header_logo" >';
$html.='<img src="'. ( ($SERVER['browser']=='IE6')?str_replace(".png",".jpg",$COMMON['path_logo']):$COMMON['path_logo'] ).'"
alt="'.$COMMON['datos_root']['titulo_web'].'" '.( str_replace("'","\"",$props) ).'
title="'.$COMMON['datos_root']['titulo_web'].'" '.( str_replace("'","\"",$props) ).'
 />';
$html.='</a>';
echo $html;

}

function web_logo($COMMON,$props=""){
global $SERVER;
$html='<img src="'. ( ($SERVER['browser']=='IE6')?str_replace(".png",".jpg",$COMMON['path_logo']):$COMMON['path_logo'] ).'"
alt="'.$COMMON['datos_root']['titulo_web'].'" '.( str_replace("'","\"",$props) ).'
title="'.$COMMON['datos_root']['titulo_web'].'" '.( str_replace("'","\"",$props) ).'
  />';
echo $html;

}

function web_render_header($HEAD,$SERVER){

//global $SERVER,
$INCLUDES=$HEAD['INCLUDES'];
$INCLUDES=quitar_repetidos($INCLUDES);

$INCLUDE=$HEAD['INCLUDE'];

$html ='';
$html.='<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="es_ES" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="es_ES" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="es_ES" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es_ES" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
';
if($HEAD['meta_descripcion']){ $html.='<meta name="description" content="'.$HEAD['meta_descripcion'].'" />
'; }
if($HEAD['meta_keywords']){ $html.='<meta name="keywords" content="'.$HEAD['meta_keywords'].'" />
'; }
$html.='<meta name="robots" content="index,follow"/>
<meta name="googlebot" content="index, follow" />
<title>'.$HEAD['titulo'].'</title>
<base href="'.$SERVER['BASE'].'" />
<link rel="canonical" href="'. $SERVER['URL'] .'" />
';

/**
 * FACEBOOK
 */
foreach($HEAD['facebook'] as $var=>$val){
$html.='<meta property="'.$var.'" content="'.$val.'"/>
';}

/**
 * OTHER METAS
 */
foreach($INCLUDES['meta'] as $var=>$val){
$html.='<meta http-equiv="'.$var.'" content="'.$val.'"/>
';}

/**
 * FAVICON
 */
foreach($INCLUDES['ico'] as $file){
$html.='<link rel="shortcut icon" href="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].'" type="image/x-icon" />
';}

/**
 * WEB FONTS AND EXTERNAL CSS
 */
foreach($INCLUDES['external_css'] as $file){
$html.='<link type="text/css" rel="stylesheet" href="'.$file.'" />
';}
$cssmain='';
$csss='';
$cssnum=0;
foreach($INCLUDES['css'] as $id=>$file){
if($id=='base'){ $cssmain.='<link type="text/css" rel="stylesheet" href="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].'" />
'; } else {
$sufig= "_". ( $cssnum++ );
$csss.='<link type="text/css" rel="stylesheet" href="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].$sufig.'" />
';
}
}
foreach($INCLUDES['cssabs'] as $id=>$file){
$sufig= "_". ( $cssnum++ );
$csss.='<link type="text/css" id="'.$id.'" rel="stylesheet" href="'.$file.str_replace("?","&",$INCLUDE['version']).$sufig.'" />
';
}
$html.=$cssmain.$csss;
//CSS_IE6
foreach($INCLUDES['css_ie6'] as $file){
$html.='<!--[if lte IE 6]>
<link type="text/css" rel="stylesheet" href="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].'" />
<![endif]-->
';}
//CSS_AFTER
foreach($INCLUDES['css_after'] as $file){
$html.='<link type="text/css" rel="stylesheet" href="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].'" />
';}
//JS
foreach($INCLUDES['js'] as $file){
$html.='<script type="text/javascript" src="'.$SERVER['BASE'].THEME_PATH.$file.$INCLUDE['version'].'"></script>
';}
//STYLE
if(sizeof($INCLUDES['style'])>0){
$html.="<style type='text/css'>\n";
foreach($INCLUDES['style'] as $linea){
$html.=$linea."\n";}
$html.="</style>\n";}
//SCRIPT
if(sizeof($INCLUDES['script'])>0){
$html.="<script type='text/javascript'>\n";
foreach($INCLUDES['script'] as $linea){
$html.=$linea."\n";}
$html.="</script>\n";}
//SCRIPT_DEFER
if(sizeof($INCLUDES['script_defer'])>0){
$html.="<script type='text/javascript' defer='defer'>\n";
foreach($INCLUDES['script_defer'] as $linea){
$html.=$linea."\n";
}
$html.="</script>\n";
}
if($INCLUDE['anaytics_code'] and !$SERVER['LOCAL']){
$html.="<script type=\"text/javascript\">
var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
</script>
<script type=\"text/javascript\">
try {
var pageTracker = _gat._getTracker(\"".$INCLUDE['anaytics_code']."\");
pageTracker._trackPageview();
} catch(err) {}</script>
";
}
if( !empty($INCLUDE['extra'])  and !$SERVER['LOCAL'] ){
$html.=$INCLUDE['extra'];
}
$html.='</head>';
// var_dump($INCLUDE);
echo $html;
}

function web_re_procesar_menu($menu,$url){
	foreach($menu as $mm=>$men){
			if(!(strpos($men['url'],$url)===false)){
				$menu[$mm]['class']='selected';
			}
	}
	return $menu;
}

function web_procesar_menu($menu,$direccion="izquierda",$debug=false){

	if($debug) prin($menu);
	global $_GET;
	$men2=array(); $menu1=array(); $menu2=array();

	foreach($menu as $uu=>$men){
		$men['lado']=isset($men['lado'])?$men['lado']:$direccion;
		if($men['lado']=='izquierda'){
		$menu1[]=$men;
		} else {
		$menu2[]=$men;
		}
	}
	if(sizeof($menu1)>0){
		$menu1[sizeof($menu1)-1]['ultimo']='ultimo';
	}
	if(sizeof($menu2)>0){
		$menu2[sizeof($menu2)-1]['ultimo']='ultimo';
		$menu2=array_reverse($menu2);
	}
	$menu=array_merge($menu1,$menu2);
	foreach($menu as $uu=>$men){
		$men3=$men;
		if($men['class']==''){
			$men3['class']=($men['default']=='1')?'selected':'';
		} elseif(enhay($men['url'],'http:')){
			$men3['class']='';
		} elseif($men['class']=='selected'){
			$men3['url']=procesar_url($men['url']);
		} else {
			if($men['url']!=''){
				$men3['url']=str_replace('indexhtml','index.html',procesar_url($men['url']));
				$url=parse_url($men['url']);
				parse_str($url['query'],$vvv);
				unset($vvv['friendly']);
				//unset($vvv['acc']);
				$sel=1;
				foreach($vvv as $var=>$val){
					if($_GET[$var]!=$val){
						$sel=0;
					}
				}
				$men3['class']=($men['selected']==1 or $sel==1)?'selected':'';
			} else {
				$men3['class']=($men['default']=='1')?'selected':'';
			}
		}
		$men2[$uu]=$men3;
	}
	if($debug) prin($men2);

	return $men2;

}

function web_render_menu($MENU,$obj=NULL,$tag='h3',$extra=NULL){

	$labelA=array();

	$obj['ul']=(isset($obj['ul']))?$obj['ul']:"ul";
	$obj['id']=(isset($obj['id']))?$obj['id']:'';
	$obj['rel']=(isset($obj['rel']))?$obj['rel']:'';

	if($obj['ul']=='ul'){ $UL="ul"; $LI="li"; $SPC=""; }
	elseif($obj['ul']=='div'){ $UL="div"; $LI="span"; $SPC="&nbsp;\n"; }

	$html ="";
	$html.="<div class='area_menu' ".( ($obj['id']!="")?"id='".$obj['id']."' ":'')." ".( ($obj['rel']!="")?"id='".$obj['rel']."' ":'')." >";

	// if($obj['lados_externos']==1){
	// 	$html.="<div class='div_menu_izq'></div>\n";
	// 	$html.="<div class='div_menu_der'></div>\n";
	// }
    $html.="<$UL class='ul' >";
	$e=0;
	foreach($MENU as $i=>$men){

		$out=($men['target']=='_blank')?" target='_blank' ":'';

		$men['label']=($men['label'])?$men['label']:$men['nombre'];

		$iii=($men['id'])?$men['id']:$i+1;

		$class="li ".$men['ultimo']." ".$men['class']." ".$men['classadicional'];
		$html.= $SPC."<$LI "
			 .( ($obj['id']!="")?"id='".$obj['id']."_".$iii."'":'')." "
			 .( ($obj['rel']!="")?"rel='".$obj['rel']."_".$iii."'":'')." "
			 .( ($men['lado']=="derecha")?"style='float:right'":'')." "
			 .((trim($class)=='')?"":"class='".trim($class)."'")
			 ." >";

		$tag=($obj['id']=='menu_main')?'h2':$tag;
		$labelA=explode("|",$men['label']);
		$manylabels=(sizeof($labelA)>1);
		foreach($labelA as $ii=>$label){
			$line=($manylabels)?"class='line_".$ii."'":"";
			if( $men['disabled']=='1' ){
				$html.= "<$tag><a title='".$label."' $out $line  href='#' onclick=\"javacript:return false;\">";
				$html.=$label;
				$html.="</a></$tag>";
			} elseif( $men['onclick']!='' ){
				$ShowTab=($obj['id']!='')?"ShowTab('".$obj['id']."','".$iii."');":"";
				$html.= "<$tag><a title='".$label."' $out $line href='#' rel='nofollow' onclick=\"javacript:".$ShowTab.str_replace("\"","'",$men['onclick']).";return false;\">";
				$html.=$label;
				$html.="</a></$tag>";
			} else {
				$html.= "<$tag><a title='".$label."' $out $line ".( ($men['url'] or $men['url']=='')?"href='".$men['url']."'":"" ).">";
				$html.=$label;
				$html.="</a></$tag>";
			}
		}
		$html.=($obj['id']=='menu_main')?'</h2>':'';

		// prin($men['menu']);
		if(sizeof($men['menu'])>0){
			$obj_sub=$obj;
			$obj_sub['return']=1;
			$obj_sub['id']=$obj['id'].'_'.$iii;
			$html.=web_render_menu($men['menu'],$obj_sub,'h3');
		}

		$html.= "</$LI>";



		if($e==sizeof($MENU)-1){
			if($obj['lados_flotantes']==1){
				$html.=($men['lado']=="derecha")?"<div class='div_menu_float_izq' style='float:right;'></div>\n":"<div class='div_menu_float_der'></div>\n";
			}
		}

		$e++;
	}
	

    $html.="</$UL>";
    $html.="</div>";
    if($obj['return']) return $html;
	echo $html;
}


function web_render_links($MENU){
	$html="";
	foreach($MENU as $i=>$men){
		if($men['url']){
			$html.="<a href='".$men['url']."' title='".$men['label']."'  class='".$men['class'].( ($i==sizeof($MENU)-1)?" ultimo ":"" )."' >".$men['label']."</a>";
		}
    }
	echo $html;
}


function web_render_general_config(){
global $HEAD;
//$HEAD['INCLUDES']['style'][]='#div_allcontent { width:1036px; }';
//$HEAD['INCLUDES']['style'][]='html, body {background:#E5E5E5 url('.THEME_PATH.'img/common_bg.jpg) repeat-x 0 0;}';
}

function web_render_esquinas($numFrom=1,$numTo=2,$label=""){
$html="";
// $esquina[1]='<div class="arriba_izquierda'.$label.'"></div>';
// $esquina[2]='<div class="arriba_derecha'.$label.'"></div>';
// $esquina[3]='<div class="abajo_izquierda'.$label.'"></div>';
// $esquina[4]='<div class="abajo_derecha'.$label.'"></div>';

// for($i=$numFrom;$i<=$numTo;$i++){
// $html.=$esquina[$i];
// }
echo $html;
}

function web_render_item_borde($class=NULL,$numFrom=1,$numTo=4){
$html="";
// $esquina[1]='<div class="'.$class.' bors bor-1"><b>&bull;</b></div>';
// $esquina[2]='<div class="'.$class.' bors bor-2"><b>&bull;</b></div>';
// $esquina[3]='<div class="'.$class.' bors bor-3"><b>&bull;</b></div>';
// $esquina[4]='<div class="'.$class.' bors bor-4"><b>&bull;</b></div>';

// for($i=$numFrom;$i<=$numTo;$i++){
// $html.=$esquina[$i];
// }
echo $html;


}

/*
function web_render_barras($barras="",$class="",$label=""){
$html="";
$esquina['top']='<span class="barra_arriba'.$label.'"></span>';
$esquina['bottom']='<span class="barra_abajo'.$label.'"></span>';

if($barras=='top'){$html.=$esquina['top'];}
elseif($barras=='bottom'){$html.=$esquina['bottom'];}
elseif($barras=='both'){$html.=$esquina['top'].$esquina['bottom'];}

if($class!=''){echo"<span class='$class'>";}
echo $html;
if($class!=''){echo"</span>";}
}
*/

function web_follow_url($get){
global $_GET;
$pat=array();
foreach($_GET as $var=>$val){
if(in_array($var,$get)){
$pat[]="&".$var."=".$val;
}
}
return implode($pat);
}


function pre_proceso_form($FORM){
	$FORM2=$FORM;
    foreach($FORM['campos'] as $Campo=>$field){
	$field['before']=($field['before'])?$field['before']:$field['seccion'];
	$field['campo'][0]=($field['campo'][0])?$field['campo'][0]:$Campo;
	$field['tipo']=($field['tipo'])?$field['tipo']:'input_text';
	$FORM2['campos'][$Campo]=$field;
	}
	return $FORM2;
}

function web_render_form($FORM){
	global $HEAD,$SERVER;
	if($FORM['legend']!=''){ echo "<div class='legend camps'>".$FORM['legend']."</div>"; }
    foreach($FORM['campos'] as $Campo=>$field){

	//$field['before']=($field['before'])?$field['before']:$field['seccion'];
	//$field['campos'][0]=($field['campos'][0])?$field['campos'][0]:array($Campo);
	//$field['tipo']=($field['tipo'])?$field['tipo']:'input_text';
	$xtra=($field['next']=='1')?" next":"";

    if($field['tipo']!='input_hidden' and $field['tipo']!='textarea_hidden'){ ?>
		<?php if($field['before']!=''){ echo "<div class='camps before' >"; /*echo "<label class='name'>&nbsp;</label>";*/ echo "<span>".$field['before']."</strong></span></div>"; } ?>
		<?php if($field['iniciodiv']!=''){ echo "<div class='sub_forms' id='".$field['iniciodiv']."'>";} ?>
		<?php if($field['before_inner']!=''){ echo "<div class='camps before' ><label class='name'>&nbsp;</label><span>".$field['before_inner']."</strong></span></div>"; } ?>
        <?php echo '<div class="camps'.$xtra.'" id="p_'.$FORM['nombre'].'_'.$field['campo'][0].'">'; ?>
        <?php if($field['label']!=''){ ?>
        <label class="name" for="<?php echo $FORM['nombre']."_".$field['campo'][0];?>"><?php echo $field['label'];?>
        <b><?php echo (!(strpos($field['validacion'],"required")===false))?"*":""; ?></b>
        </label>
        <?php } ?>
    <?php } ?>
    <?php switch($field['tipo']){
    case "captcha": ?>
    <label class="name" >Verificación</label>
    	<?php 
    		@mkdir('../../../captcha');	
			$cpch=create_captcha(
				array(
				'img_path'		=> '../../../captcha/',
				'img_url'		=> $SERVER['BASE'].'/captcha/',
				// 'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
				// 'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
				// 'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
				// 'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
				'show_grid'		=> false,
				'expiration'	=> '3600',
				)
			);
			$_SESSION['captchaword']=$cpch['word'];
			echo $cpch['image'];
    	?><br>
    	<input style="margin-left:105px; width:145px;" type="text" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" value="" />

	<?php
    break;	
	case "constante":
	break;
    case "input_hidden": case "hidden":
	foreach($field['campo'] as $ii=>$camp){ ?>
    <input type="hidden" name="<?php echo $camp;?>" id="<?php echo $FORM['nombre']."_".$camp;?>" value="<?php echo $field['value'][$ii];?>" />
    <?php } break;
    case "input_multi_simple": case "multi_simple": ?>
    <input type="hidden" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" value="<?php echo $field['value'][0];?>" />
    <div class='div_columna'>
    <?php foreach($field['opciones'] as $opcccion=>$opcion_select){ ?>
    <div class='div_fila'>
    <input type="checkbox"
    id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_".$opcccion?>"
    name="temp_<?php echo $FORM['nombre']."_".$field['campo'][0];?>"
    value="<?php echo $opcion_select;?>"
    class="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" onclick="var i=0;var vl=new Array();$$('.<?php echo $FORM['nombre']."_".$field['campo'][0];?>').each(function(el){if($(el).checked){vl[i++]=$(el).value; } }); $('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').value=vl.join(', '); "  />
    <label class="multi_opcion" for="<?php echo $FORM['nombre']."_".$field['campo'][0]."_".$opcccion?>"><?php echo $opcion_select;?></label>
    </div>
    <?php } ?>
    </div>
	<?php
	break;
    case "input_radio": case "radio": ?>
    <input type="hidden" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" value="<?php echo $field['value'][0];?>" />
    <?php foreach($field['opciones'] as $opcccion=>$opcion_select){ ?>
    <input type="radio"
    id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_".$opcccion?>"
    <?php echo ($opcccion==$field['value'][0])?'checked="checked"':'';?>
    name="temp_<?php echo $FORM['nombre']."_".$field['campo'][0];?>"
    value="<?php echo $opcccion;?>"
    class="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" onclick="$$('.opcion_<?php echo $FORM['nombre']."_".$field['campo'][0];?>').removeClass('selected');if(this.checked){ $('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').value=this.value; $('<?php echo $FORM['nombre']."_".$field['campo'][0];?>_'+this.value+'_for').addClass('selected'); } "  />
    <label class="opcion opcion_<?php echo $FORM['nombre']."_".$field['campo'][0];?>" for="<?php echo $FORM['nombre']."_".$field['campo'][0]."_".$opcccion?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_".$opcccion?>_for"><?php echo $opcion_select;?></label>
    <?php } ?>
    <?php break;
	case "input_fecha": case "fecha":
	if($field['rango_anio']){
		list($uuno,$ddos)=explode(",",$field['rango_anio']);
		$FromYear = date("Y",strtotime($uuno));
		$ToYear = date("Y",strtotime($ddos));
	} else {
		$FromYear = date("Y")-90;
		$ToYear = date("Y")+1;
	}
	if($field['rango_mes']){
		list($uuno,$ddos)=explode(",",$field['rango_mes']);
		$FromMonth = date("n",strtotime($uuno));
		$ToMonth = date("n",strtotime($ddos));
	} else {
		$FromMonth = 1;
		$ToMonth = 12;
	}
	$meses=array('1'=>'enero','febrero','marzo','abril','mayo','junio','julio','agosto','setiembre','octubre','noviembre','diciembre');	?>
    <span class="control" style="position:relative;">
        <input type="text" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" style="position:absolute; right:0px; visibility:hidden;" class="<?php echo $FORM['validate'];?>" />
        <select class="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_d";?>">
        <option value="">día</option>
        <?php for($i=1;$i<=31;$i++){ ?><option value="<?php printf("%02d",$i);?>"><?php echo $i;?></option><?php } ?></select>
        <select class="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_m";?>">
        <option value="">mes</option>
        <?php for($i=$FromMonth;$i<=$ToMonth;$i++){ ?><option value="<?php printf("%02d",$i);?>"><?php echo ucfirst($meses[$i]);?></option><?php } ?></select>
        <select class="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0]."_a";?>">
        <option value="">año</option>
        <?php for($i=$ToYear;$i>=$FromYear;$i--){ ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?>
        </select>
        <script>

		$$('.<?php echo $FORM['nombre']."_".$field['campo'][0];?>').addEvent('change',function(){
        if($('<?php echo $FORM['nombre']."_".$field['campo'][0]."_a";?>').value!=''&&$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_m";?>').value!=''&&$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_d";?>').value!=''){$('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').value=$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_a";?>').value+'-'+$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_m";?>').value+'-'+$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_d";?>').value+' 00:00:00';}});
		<?php if($field['value'][0]!=''){
		//$field['value'][0] = fecha_formato(strtotime($field['value'][0]),'5b');
		?>
		$('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').value='<?php echo $field['value'][0];?>';
		$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_a";?>').value='<?php echo substr($field['value'][0],0,4);?>';
		$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_m";?>').value='<?php echo substr($field['value'][0],5,2);?>';
		$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_d";?>').value='<?php echo substr($field['value'][0],8,2);?>';
		<?php } else {
		if($ToYear==$FromYear){
		?>
		$('<?php echo $FORM['nombre']."_".$field['campo'][0]."_a";?>').value='<?php echo $FromYear;?>';
		<?php
		}
		} ?>
        </script>
    </span>
    <?php break;
    case "input_foto": case "foto":
	foreach($field['campo'] as $ii=>$camp){ ?>
    <input type="hidden" style="width:100px;"  name="<?php echo $camp;?>" id="<?php echo $FORM['nombre']."_".$camp;?>" class="foto_control caja <?php echo $field['validacion'];?>" value="<?php echo $field['value'][$ii];?>"  />
    <?php
	}
	?>
    <div id="content_<?php echo $FORM['nombre']."_".$field['campo'][0];?>_all" class="control" style="float:left; width:705px; "></div>
    <script type="text/javascript">
	window.addEvent('domready', function(){
	$$('.foto_control').each(function(el, index){
		if(el.value.trim()!=''){
				web_render_control_foto({
									'render'		:'content_<?php echo $FORM['nombre']."_".$field['campo'][0];?>_all',
									'class_input'	:'foto_control'
									});
		}
	});
	web_render_control_foto({
						'render'		:'content_<?php echo $FORM['nombre']."_".$field['campo'][0];?>_all',
						'class_input'	:'foto_control'
						});

	});
	</script>
    <?php break;
    case "input_text": ?>
    <input type="text" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" value="<?php echo $field['value'][0];?>" <?php if($field['check_unique']!=''){ echo "onchange=\"check_unique(this,".$field['check_unique'].");\""; }?>
    <?php echo ($field['onchange'])?'onchange="'.$field['onchange'].'"':'';?>
    <?php echo ($field['style'])?'style="'.$field['style'].'"':'';?>/>
    <?php if($field['check_unique']!=''){ ?><small id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>_men" style="color:red;"></small><?php } ?>
    <?php break;
    case "input_combo":case "combo": ?>
    <select name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" value="<?php echo $field['value'][0];?>"
    <?php echo ($field['onchange'])?'onchange="'.$field['onchange'].'"':'';?>
	<?php echo ($field['style'])?'style="'.$field['style'].'"':'';?>
     />
    <option value=""></option>
    <?php foreach($field['opciones'] as $i=>$x){ ?><option <?php echo ($i==$field['value'][0])?"selected='selected'":""; ?> value="<?php echo $i;?>"><?php echo $x;?></option><?php } ?>
    </select>
    <?php break;
    case "input_combo_rango": case "combo_rango": ?>
    <select name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" value="<?php echo $field['value'][0];?>" />
    <option value=""></option>
    <?php
	if($field['from']<$field['to']){
	for($i=$field['from'];$i<=$field['to'];$i++){ ?><option <?php echo ($i==$field['value'][0])?"selected='selected'":""; ?> value="<?php echo $i;?>"><?php echo $i;?></option><?php }
	} else {
	for($i=$field['from'];$i>=$field['to'];$i--){ ?><option <?php echo ($i==$field['value'][0])?"selected='selected'":""; ?> value="<?php echo $i;?>"><?php echo $i;?></option><?php }
	}
	?>
    </select>
    <?php break;
	case "input_precio": case "precio": ?>
	<span>
    <select id="<?php echo $FORM['nombre'];?>_<?php echo $field['campo'][0];?>" name="<?php echo $field['campo'][0];?>">
        <option value="1">Nuevo Sol</option>
        <option value="2">Dólar Estadounidense</option>
    </select>
    </span>
    <span>
    <input type="text" class="caja validate['required','number']" id="<?php echo $FORM['nombre'];?>_<?php echo $field['campo'][1];?>" name="<?php echo $field['campo'][1];?>"/>
    </span>
    <script>
	<?php foreach($field['campo'] as $ii=>$camp){
	if($field['value'][$ii]!=''){
	?>	$('<?php echo $FORM['nombre']."_".$camp;?>').value='<?php echo $field['value'][$ii];?>'; <?php }
	}
	?>
	</script>
    <?php break;
    case "input_password": case "password":?>
    <input type="password" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" value="<?php echo $field['value'][0];?>" />
    <?php break;
    case "input_check": case "check": ?>
    <input type="checkbox" name="<?php echo $field['campo'][0];?>" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="<?php echo $field['validacion'];?>" value="<?php echo $field['value'][0];?>" />
    <?php break;
    case "textarea": case "input_textarea": ?>
    <textarea name="<?php echo $field['campo'][0];?>" cols="30" rows="7" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>"
    <?php echo ($field['style'])?'style="'.$field['style'].'"':'';?>
    ><?php echo $field['value'][0];?></textarea>
    <?php break;
    case "textarea_hidden": case "input_textarea_hidden": ?>
    <textarea name="<?php echo $field['campo'][0];?>" style="display:none;" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>" ><?php echo $field['value'][0];?></textarea>
    <?php break;
    case "input_html": case "html":
	?>
    <textarea title="html" name="<?php echo $field['campo'][0];?>" cols="30" rows="7" id="<?php echo $FORM['nombre']."_".$field['campo'][0];?>" class="caja <?php echo $field['validacion'];?>"
    <?php echo ($field['style'])?'style="'.$field['style'].'"':'';?> ><?php echo $field['value'][0];?></textarea>
    <script>
	var MOOEDITABLE;
	window.addEvent('domready', function(){
		$('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').setStyles({'height':'200px'});
		MOOEDITABLE = $('<?php echo $FORM['nombre']."_".$field['campo'][0];?>').mooEditable({
			actions: 'bold italic underline | formatBlock justifyleft justifyright justifycenter justifyfull | insertunorderedlist insertorderedlist indent outdent | undo redo | toggleview',
			//externalCSS: 'css/Editable.css',
			baseCSS: 'html{ height: 100%; cursor: text; } body{ font-family: arial; font-size:12px; }'
		});
	});
    </script>
    <?php break;
	default:?>
    <span id="<?php echo $field['control'];?>_inner" class="control"></span>
    <script>
	var <?php echo $field['control'];?>=$('<?php echo $field['control'];?>');
	$('<?php echo $field['control'];?>').erase();
	<?php echo $field['control'];?>.inject($('<?php echo $field['control'];?>_inner'));
	<?php foreach($field['campo'] as $ii=>$camp){
	if($field['value'][$ii]!=''){
	?>	$('<?php echo $FORM['nombre']."_".$camp;?>').value='<?php echo $field['value'][$ii];?>'; <?php }
	}
	?>
	//$('<?php echo $field['control'];?>').style.display='block';
	</script>
	<?php break;
    }
	if($field['after']!=''){ echo "<small>".$field['after']."</small>"; }
    if($field['tipo']!='input_hidden' and $field['tipo']!='textarea_hidden'){ echo "</div>"; }
    if($field['findiv']=='1'){ echo "</div>";}

    ?>

    <?php
    }
	if($FORM['condiciones']!=''){
		echo "<div class='camps pie small'>
		<div class='condiciones' >".$FORM['condiciones']."</div></div>";
	}
	?>
    <div class="camps submit" id="p_<?php echo $FORM['nombre'].'_submit';?>">
    <label class='name'>&nbsp;</label>
    <input id="<?php echo $FORM['nombre'];?>_submit"  <?php echo $FORM['submit'];?> />
	<?php  if($FORM['submiting']!=''){ ?><img id="<?php echo $FORM['nombre'];?>_submiting" <?php echo $FORM['submiting'];?> style="display:none;" /><?php } ?>
    <?php  echo $FORM['after_submit']; ?>
    <!--<input type="reset" value="Cancelar"  />-->
    </div>
    <?php
		if($FORM['pie']!=''){ $pies=array(); $pies=explode("<br>",$FORM['pie']);
			foreach($pies as $tt=>$pie){
				echo "<div class='camps pie small' id='p_".$FORM['nombre']."_pie". ( ($tt=='0')?'':$tt ) ."'><label class='name'>&nbsp;</label>
				<span class='small'>".$pie."</span></div>";
			}
		}



}

/*
			$FORM['complete']="
			var json=JSON.decode(ee,true);
			new Element('div', {
				'class': 'mensaje mensaje_'+json.t,
				'html': json.m,
				'id': 'mensaje_'+json.n
			}).inject($(json.n+'_form_body'), 'before');
			$0(json.n+'_form_body');
			setTimeout('$(\'mensaje_'+json.n+'\').destroy();$1(\''+json.n+'_form_body\');',5000);
			";
*/

function web_render_form_javascript($FORM){
?>
            <script type="text/javascript">
                window.addEvent('domready', function(){
                    $$('.autoinput').each(function(ee){
                        ee.title=ee.value;
                        ee.addEvent('blur',function(event){ if(ee.value=='') ee.value=ee.title; });
                        ee.addEvent('focus',function(event){ if(ee.value==ee.title) ee.value=''; });
                    });
                    $('formulario_<?php echo $FORM['nombre'];?>').addEvent('submit', function(event){
                        $$('#formulario_<?php echo $FORM['nombre'];?> .autoinput').each(function(ee) {
                            if(ee.title==ee.value){ ee.value=''; }
                        });
                    });
					$('formulario_<?php echo $FORM['nombre'];?>').addEvent('submit', function(event){
						$$('#formulario_<?php echo $FORM['nombre'];?> textarea').each(function(el){
						if (el.title =='html'){	el.value=MOOEDITABLE.getContent(); }
						});
                    });
					var submit_temp_<?php echo $FORM['nombre'];?>;
                    new FormCheck('formulario_<?php echo $FORM['nombre'];?>',{
                        onSubmit:function() {
						}
                        ,submitByAjax:true
                        ,onAjaxRequest:function() {
                            $('<?php echo $FORM['nombre'];?>_submit').value="Enviando...";
							submit_temp_<?php echo $FORM['nombre'];?>=$('<?php echo $FORM['nombre'];?>_submit').value;
                            $('<?php echo $FORM['nombre'];?>_submit').disabled=true;
							<?php if($FORM['submiting']!=''){ ?>
                            $0('<?php echo $FORM['nombre'];?>_submit');
                            $1('<?php echo $FORM['nombre'];?>_submiting');
							<?php } ?>
                        }
                        ,onAjaxSuccess:function(ee) {
                            $('formulario_<?php echo $FORM['nombre'];?>').reset();
                            $('<?php echo $FORM['nombre'];?>_submit').value=submit_temp_<?php echo $FORM['nombre'];?>;
                            $('<?php echo $FORM['nombre'];?>_submit').disabled=false;
							<?php if($FORM['submiting']!=''){ ?>
                            $1('<?php echo $FORM['nombre'];?>_submit');
                            $0('<?php echo $FORM['nombre'];?>_submiting');
							<?php } ?>
							<?php echo $FORM['complete']; ?>

                        }
						,display : {
							closeTipsButton : 1
						}

                    });
                });
            </script>
 <?php
}

function web_load_lib_mooeditable(){
	global $HEAD;
	$HEAD['INCLUDES']['css'][]='css/MooEditable.css';
//	$HEAD['INCLUDES']['css'][]='MooEditable.Flash.css"';
	$HEAD['INCLUDES']['css'][]='css/MooEditable.Extras.css';
	$HEAD['INCLUDES']['js'][]='js/MooEditable.js';
//	$HEAD['INCLUDES']['js'][]='js/MooEditable.Flash.js';
	$HEAD['INCLUDES']['js'][]='js/MooEditable.UI.ButtonOverlay.js';
	$HEAD['INCLUDES']['js'][]='js/MooEditable.UI.MenuList.js';
	$HEAD['INCLUDES']['js'][]='js/MooEditable.Extras.js';

}


function web_render_control_graficos($FORM,$IMAS,$NAMES=NULL){

	$names['foto']	=($NAMES['0'])?$NAMES['0']:'id_foto';
//	prin($names);
	?>
    <select
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['departamento'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    name="<?php echo $names['departamento'];?>" onchange="get_provincias(this.id,this.value);"
    >
    <option value="">Departamento</option>
    <?php foreach($GEO['departamentos'] as $departamento){ ?>
    <option <?php echo $departamento['selected'];?> value="<?php echo $departamento['id'];?>"><?php echo ucfirst($departamento['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['provincias'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['provincia'];?>" onchange="get_distritos(this.id,this.value);"
    >
    <option value="">Provincia</option>
    <?php foreach($GEO['provincias'] as $provincia){ ?>
    <option <?php echo $provincia['selected'];?> value="<?php echo $provincia['id'];?>"><?php echo ucfirst($provincia['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['distritos'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['distrito'];?>"
    >
    <option value="">Distrito</option>
    <?php foreach($GEO['distritos'] as $distrito){ ?>
    <option <?php echo $distrito['selected'];?> value="<?php echo $distrito['id'];?>"><?php echo ucfirst($distrito['nombre']);?></option>
    <?php } ?>
    </select>
<?php
}


function web_render_control_pais_lugar($FORM,$GEO,$NAMES=NULL,$LASTFUNCTION=NULL){

	$names['departamento']	=($NAMES['0'])?$NAMES['0']:'id_pais';
	$names['distrito']		=($NAMES['2'])?$NAMES['2']:'id_distrito';
//	prin($names);
	?>
    <select
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['departamento'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    name="<?php echo $names['departamento'];?>" onchange="get_provincias(this.id,this.value);"
    style="width:99px;"
    >
    <option value="">Departamento</option>
    <?php foreach($GEO['departamentos'] as $departamento){ ?>
    <option <?php echo $departamento['selected'];?> value="<?php echo $departamento['id'];?>"><?php echo ucfirst($departamento['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['provincias'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['provincia'];?>" onchange="get_distritos(this.id,this.value);"
    style="width:74px;"
    >
    <option value="">Provincia</option>
    <?php foreach($GEO['provincias'] as $provincia){ ?>
    <option <?php echo $provincia['selected'];?> value="<?php echo $provincia['id'];?>"><?php echo ucfirst($provincia['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['distritos'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['distrito'];?>" <?php if($LASTFUNCTION!=NULL){ ?> onchange="<?php echo $LASTFUNCTION;?>" <?php } ?>
    style="width:100px;"
    >
    <option value="">Distrito</option>
    <?php foreach($GEO['distritos'] as $distrito){ ?>
    <option <?php echo $distrito['selected'];?> value="<?php echo $distrito['id'];?>"><?php echo ucfirst($distrito['nombre']);?></option>
    <?php } ?>
    </select>
<?php
}


function web_render_control_dimensiones($FORM,$GEO,$NAMES=NULL,$LASTFUNCTION=NULL){

	$names['ancho']		=($NAMES['0'])?$NAMES['0']:'dim_ancho';
	$names['largo']		=($NAMES['1'])?$NAMES['1']:'dim_largo';
	$names['altura']	=($NAMES['2'])?$NAMES['2']:'dim_altura';
//	prin($names);
	?>
    Ancho
    <input
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['ancho'];?>"
    name="<?php echo $names['ancho'];?>"
    style="width:25px;"
    >

    Largo
    <input
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['largo'];?>"
    name="<?php echo $names['largo'];?>"
    style="width:25px;"
    />

	Altura
    <input
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['altura'];?>"
    name="<?php echo $names['altura'];?>"
    style="width:25px;"
    />

<?php
}


function web_render_control_localizacion($FORM,$GEO,$NAMES=NULL,$LASTFUNCTION=NULL){

	$names['departamento']	=($NAMES['0'])?$NAMES['0']:'id_departamento';
	$names['provincia']		=($NAMES['1'])?$NAMES['1']:'id_provincia';
	$names['distrito']		=($NAMES['2'])?$NAMES['2']:'id_distrito';
	foreach($FORM['campos'] as $id_campo=>$campos){
		foreach($campos['campo'] as $campo){
			if($names['departamento']==$campo){
			$parent=$id_campo; continue;
			}
		}
	}
	?>
    <select
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['departamento'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    name="<?php echo $names['departamento'];?>" onchange="get_provincias(this.id,this.value);"
	class="<?php echo $FORM['campos'][$parent]['validacion'];?>"
    style="width:99px;"
    >
    <option value="">Departamento</option>
    <?php foreach($GEO['departamentos'] as $departamento){ ?>
    <option <?php echo $departamento['selected'];?> value="<?php echo $departamento['id'];?>"><?php echo ucfirst($departamento['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['provincias'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['provincia'];?>"
    rel="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['provincia'];?>" onchange="get_distritos(this.id,this.value);"
	class="<?php echo $FORM['campos'][$parent]['validacion'];?>"
    style="width:74px;"
    >
    <option value="">Provincia</option>
    <?php foreach($GEO['provincias'] as $provincia){ ?>
    <option <?php echo $provincia['selected'];?> value="<?php echo $provincia['id'];?>"><?php echo ucfirst($provincia['nombre']);?></option>
    <?php } ?>
    </select>

    <select <?php echo (sizeof($GEO['distritos'])==0)?"disabled='disabled'":"";?>
    id="<?php echo $FORM['nombre'];?>_<?php echo $names['distrito'];?>"
    name="<?php echo $names['distrito'];?>" <?php if($LASTFUNCTION!=NULL){ ?> onchange="<?php echo $LASTFUNCTION;?>" <?php } ?>
    style="width:100px;"
	class="<?php echo $FORM['campos'][$parent]['validacion'];?>"
    >
    <option value="">Distrito</option>
    <?php foreach($GEO['distritos'] as $distrito){ ?>
    <option <?php echo $distrito['selected'];?> value="<?php echo $distrito['id'];?>"><?php echo ucfirst($distrito['nombre']);?></option>
    <?php } ?>
    </select>
<?php
}


function web_render_control_marca($FORM,$ITEMS){
?>
            <select  id="<?php echo $FORM['nombre'];?>_marca" name="marca" onchange="get_modelos('<?php echo $FORM['nombre'];?>',this.value);" >
            <option value="">Elige Marca</option>
            <?php foreach($ITEMS['marcas'] as $item){ ?>
            <option <?php echo $item['selected'];?> value="<?php echo $item['id'];?>"><?php echo ucfirst($item['nombre']);?></option>
            <?php } ?>
            </select>

            <select <?php echo (sizeof($ITEMS['modelos'])==0)?"disabled='disabled'":"";?> id="<?php echo $FORM['nombre'];?>_modelo" name="modelo" >
            <option value="">Elige Modelo</option>
            <?php foreach($ITEMS['modelos'] as $item){ ?>
            <option <?php echo $item['selected'];?> value="<?php echo $item['id'];?>"><?php echo ucfirst($item['nombre']);?></option>
            <?php } ?>
            </select>
<?php
}

function web_render_control_categoria($FORM,$ITEMS){
?>
            <select  id="<?php echo $FORM['nombre'];?>_id_grupo" name="id_grupo" onchange="get_subcategorias('<?php echo $FORM['nombre'];?>',this.value);" class="validate['required']">
            <option value="">Elige Categoría</option>
            <?php foreach($ITEMS['categorias'] as $item){ ?>
            <option <?php echo $item['selected'];?> value="<?php echo $item['id'];?>"><?php echo ucfirst($item['nombre']);?></option>
            <?php } ?>
            </select>

            <select <?php echo (sizeof($ITEMS['subcategorias'])==0)?"disabled='disabled'":"";?> id="<?php echo $FORM['nombre'];?>_id_subgrupo" name="id_subgrupo"  class="validate['required']">
            <option value="">Elige Sub-categoría</option>
            <?php foreach($ITEMS['subcategorias'] as $item){ ?>
            <option <?php echo $item['selected'];?> value="<?php echo $item['id'];?>"><?php echo ucfirst($item['nombre']);?></option>
            <?php } ?>
            </select>
<?php
}



function web_eliminar_imagenes($vistas,$tamanos){

		global $httpfiles, $DIRECTORIO_IMAGENES;

		global $ftp_files_host, $ftp_files_user, $ftp_files_pass, $ftp_files_root;

		$tamanos=$datos_tabla[$foto]['tamanos'];

		$items2=array();

		$num_tams=sizeof(explode(",",$tamanos));

		foreach($vistas as $vista){

			$item['get_archivo']=str_replace("//","/",$ftp_files_root.str_replace("$httpfiles","",$vista));

			for($i=1;$i<=$num_tams;$i++){
				$item['num_tamanos'][]="_".$i.".";
			}
			$item['num_tamanos'][]=".";

			$items2[]=$item;

		}//FOREACH


		if(sizeof($items2)>0){

			$conn_id = ftp_connect($ftp_files_host);
			$login_result = ftp_login($conn_id, $ftp_files_user, $ftp_files_pass);	ftp_pasv($conn_id, true);

			foreach($items2 as $item){

				ftp_delete($conn_id,str_replace("_1.",".",$item['get_archivo']));

				foreach($item['num_tamanos'] as $tam){

					ftp_delete($conn_id,str_replace("_1.",$tam,$item['get_archivo']));

				}

			}

			ftp_close($conn_id);

		}

}

function web_grabar_imagen($r_img,$opciones){

	if(trim($r_img)==''){

		return false;

	}

	$Ret['img']=$r_img;

	$PREFIJO=$opciones['prefijo'];
	$CARPETA=$opciones['carpeta'];
	$TAMANOS=$opciones['tamanos'];
//
	//echo "$c \n| $r_img \n| $tabla \n| $objeto \n| $id";
	// obtener la extensin del nombre de archivo enviado
	global $httpfiles, $DIR_IMG_TEMP, $DIRECTORIO_IMAGENES;

	$root_dir=getcwd();

	chdir("../../panel/");

//	echo "|$httpfiles | $DIR_IMG_TEMP | $DIRECTORIO_IMAGENES";

	$images_temp="../".$DIRECTORIO_IMAGENES.$DIR_IMG_TEMP."/";

	$images_temp=str_replace("//","/",$images_temp);

//	echo "<pre>"; print_r($datos_tabla); echo "</pre>";

	$prefijo	= $PREFIJO;
	$Carpeta	= $DIRECTORIO_IMAGENES."/".$CARPETA;

	$Tamanos	= $TAMANOS;

	$r_img	=	str_replace("_preview.","_orig.",$r_img);

	$img_ext = substr($r_img,strpos($r_img,".")+1);

	// obtener el nombre del archivo antiguo
	$file_name 	= substr($r_img,strrpos($r_img, "/")+1);
	$file_dir	= str_replace($httpfiles,"",$r_img);
	$file_dir 	= str_replace($file_name,"",$file_dir);
	$file_temp = $images_temp.$file_name;
	// bajar la imagen a directorio local temporal images_temp/
//	echo "$r_img - $file_name - ";
	//echo "$r_img,$file_name,/$images_temp";
	//exit();
	ccl_download($r_img,$file_name,"/".$images_temp);
	//exit();

//	ccl_download($r_img, $file_temp);

	// sacar extension
	if(@imagecreatefromjpeg($file_temp))    $ext = "jpg";
	elseif(@imagecreatefromgif($file_temp)) $ext = "gif";
	elseif(@imagecreatefrompng($file_temp)) $ext = "png";

	$Ret['ext']=$ext;


	list($img_w, $img_h, $tipo, $atr) = getimagesize($file_temp);

	// subir por ftp a nuevo sitio
	$folder_dest = $Carpeta; // no agregar / al final  //CARGAR
	$timestamp=time();

	$file_dest = $prefijo."_".$timestamp."_".$img_w."x".$img_h.".".$ext;

	$TamanosArray=array();
	$TamanosArray=explode(",",$Tamanos);
	foreach($TamanosArray as $i=>$Tam){
	list($xxxx,$yyyy)=explode("x",$Tam);
	$i2=$i+1;
	$confirm['up_'.$i2] = ccl_img_uploadmini($images_temp.$file_name,$ext,$folder_dest,str_replace(".","_". ($i2) .".",$file_dest),$xxxx,$yyyy,true);
	}
	// mandar una copia del fichero original
	//$confirm['ori'] = ccl_upload_ftp($images_temp.$file_name, $folder_dest, $file_dest);

	@unlink($file_temp);

	ccl_delete_ftp($file_dir, $file_name);

	ccl_delete_ftp($file_dir, str_replace("_orig.","_preview.",$file_name));

	$imagen_save = $file_dest;
//	echo $imagen_save;
//	return $imagen_save;
	$Ret['file']=$imagen_save;

	$Ret['confirm']=$confirm;

	chdir(root_dir);

	return $Ret;

}

function web_render_swf($archivo,$target,$id,$wxh){

global $HEAD;
list($ww,$hh)=explode("x",$wxh);
$HEAD['INCLUDES']['script_defer'][]="swfobject.embedSWF(\"".$archivo."\", \"".$target."\", \"".$ww."\", \"".$hh."\", \"9.0.0\", \"expressInstall.swf\",
{},
{
wmode:'transparent',
quality:'high',
name:'".$id."',
id:'".$id."',
align:'middle',
allowScriptAccess:'sameDomain',
allowFullScreen:'false'
},
{
wmode:'transparent',
quality:'high',
name:'".$id."',
id:'".$id."',
align:'middle',
allowScriptAccess:'sameDomain',
allowFullScreen:'false'
});";

}

function web_render_swf_html($target){

echo "<div id='".$target."'><div id='".$target."_swf'></div></div>";

}

function web_render_swf_script($archivo,$target,$wxh){

global $HEAD;

$HEAD['INCLUDES']['js'][]='js/swfobject.js';

$id = $target."_swf";
list($ww,$hh)=explode("x",$wxh);
$HEAD['INCLUDES']['script'][]="swfobject.embedSWF(\"".$archivo."\", \"".$target."_swf\", \"".$ww."\", \"".$hh."\", \"9.0.0\", \"expressInstall.swf\",
{},
{
wmode:'transparent',
quality:'high',
name:'".$id."',
id:'".$id."',
align:'middle',
allowScriptAccess:'sameDomain',
allowFullScreen:'false'
},
{
wmode:'transparent',
quality:'high',
name:'".$id."',
id:'".$id."',
align:'middle',
allowScriptAccess:'sameDomain',
allowFullScreen:'false'
});";

}


function web_render_slider_javascript($NOOB){
$uuu=array();
$num_items_bloque=sizeof($NOOB['items_bloques']);
for($t=1;$t<=$num_items_bloque;$t++){
$uuu[]=$t;
}
if($num_items_bloque>1){
?>
<script type="text/javascript">
	window.addEvent('domready',function(){
		//SAMPLE 2 (transition: Bounce.easeOut)
		var NS_<?php echo $NOOB['label'];?> = new noobSlide({
			box: $('contenedor_slider_<?php echo $NOOB['label'];?>_movil')
			,items: [<?php echo implode(",",$uuu); ?>]
			,interval: <?php echo ($NOOB['interval'])?$NOOB['interval']:'7000';?>
			,autoPlay: <?php echo $NOOB['autoplay'];?>
			,size:<?php echo ($NOOB['mode']=='vertical')?$NOOB['height']:$NOOB['width'];?>
			,mode:'<?php echo $NOOB['mode'];?>'
			<?php if($NOOB['buttons']==1){ ?>
			,addButtons: {
				previous: $('contenedor_slider_<?php echo $NOOB['label'];?>_prev'),
				next: $('contenedor_slider_<?php echo $NOOB['label'];?>_next')
			}
			<?php } ?>
			<?php if($NOOB['handles']=='1'){ ?>
			,handles: $$('#cs<?php echo $NOOB['label'];?>h a')
			,onWalk: function(currentItem,currentHandle){
				this.handles.removeClass('selected');
				currentHandle.addClass('selected');
			}
			<?php } ?>
			});

	});
</script>
<?php
}
}

function web_render_slider_pie($NOOB,$debug=0){

	global $lang;
	$NOOB['prev']=(isset($NOOB['prev']))?$NOOB['prev']:"&laquo;".$lang['anterior'];
	$NOOB['next']=(isset($NOOB['next']))?$NOOB['next']:$lang['siguiente']."&raquo;";
	$NOOB['title_prev']=(isset($NOOB['title_prev']))?$NOOB['title_prev']:$lang['anterior'];
	$NOOB['title_next']=(isset($NOOB['title_next']))?$NOOB['title_next']:$lang['siguiente'];
	if($debug){ prin($NOOB['prev']); prin($NOOB['next']); }
	if($NOOB['buttons']==1 and $NOOB['num_bloques']>1 ){
	?><div id="contenedor_slider_<?php echo $NOOB['label'];?>_buttons">
            <a id="contenedor_slider_<?php echo $NOOB['label'];?>_prev" class="but_prev" title="<?php echo $NOOB['title_prev'];?>"><?php echo $NOOB['prev'];?></a>
            <a id="contenedor_slider_<?php echo $NOOB['label'];?>_next" class="but_next" title="<?php echo $NOOB['title_next'];?>"><?php echo $NOOB['next'];?></a>
    </div><?php
	}
	if($NOOB['handles']==1 and $NOOB['num_bloques']>1 ){
	?><div class="bloque_pie but_handles" id="cs<?php echo $NOOB['label'];?>h">
    <?php for($cc=1;$cc<=$NOOB['num_bloques'];$cc++){ ?>
            <a class="but_handle<?php echo ($cc==1)?" selected":""?>"><?php echo $cc;?></a>
	<?php } ?>
    </div><?php
	}

}

function web_render_Slider_PreProceso2($NOOB,$items){
	global $HEAD;
	//alias
	$NOOB['titulo']=($NOOB['titulo'])?$NOOB['titulo']:$NOOB['nombre'];

	list($col,$fil)=explode("x",$NOOB['itemsporpagina']);

	if($NOOB['wh']){ list($NOOB['width'],$NOOB['height'])=explode("x",$NOOB['wh']); }

	$itemsporpginatotal=$col*$fil;
	$NOOB['width_bloque']=intval($NOOB['width']/$col);
	$NOOB['height_bloque']=intval($NOOB['height']/$fil);

	$NOOB['width_bloque']=$NOOB['width_bloque']-2*$NOOB['inter_col'];

	$BLOQUES=array_chunk($items['items'],$itemsporpginatotal);

	$NOOB['num_items']=sizeof($items['items']);
	$NOOB['num_bloques']=sizeof($BLOQUES);
	unset($NOOB['items']);

	$HEAD['INCLUDES']['style'][]="
	#contenedor_slider_".$NOOB['label']."_fijo,#contenedor_slider_".$NOOB['label']."_movil div.slid {width: ".$NOOB['width']."px; height:".$NOOB['height']."px;}";
	$HEAD['INCLUDES']['style'][]="
	#contenedor_slider_".$NOOB['label']."_movil div.slid li { width:".$NOOB['width_bloque']."px; height:".$NOOB['height_bloque']."px; margin-left:".$NOOB['inter_col']."px !important;margin-right:".$NOOB['inter_col']."px !important; }";



$uuu=array();
$num_items_bloque=$NOOB['num_bloques'];
for($t=1;$t<=$num_items_bloque;$t++){
$uuu[]=$t;
}

if($num_items_bloque>1){

$js ="";
$js.="window.addEvent('domready',function(){
		//SAMPLE 2 (transition: Bounce.easeOut)
		if(\$('contenedor_slider_".$NOOB['label']."_movil')){
		var NS_".$NOOB['label']." = new noobSlide({
			box: \$('contenedor_slider_".$NOOB['label']."_movil')
			,items: [". (implode(",",$uuu)) ."]
			,interval: ". (($NOOB['interval'])?$NOOB['interval']:'7000') ."
			,autoPlay: ".$NOOB['autoplay']."
			,size:". (($NOOB['mode']=='vertical')?$NOOB['height']:$NOOB['width']) ."
			,mode:'".$NOOB['mode']."'
			";
			if($NOOB['buttons']==1){
			$js.=",addButtons: {
				previous: \$('contenedor_slider_".$NOOB['label']."_prev'),
				next: \$('contenedor_slider_".$NOOB['label']."_next')
			}
			";
			}

			if($NOOB['handles']=='1'){
			$js.=",handles: \$\$('#cs". $NOOB['label']."h a')
				,onWalk: function(currentItem,currentHandle){
				this.handles.removeClass('selected');
				currentHandle.addClass('selected');
			}
			";
			}

			$js.="});
		}
	});	";

$HEAD['INCLUDES']['script'][]=$js;
}

$items['settings']=$NOOB;

$items['items_bloques']=$BLOQUES;

unset($items['items']);

return $items;

}

function web_render_slider_preproceso($NOOB){

	global $HEAD;
	//alias
	$NOOB['titulo']=($NOOB['titulo'])?$NOOB['titulo']:$NOOB['nombre'];
	//

	//$HEAD['INCLUDES']['js'][]='js/mootools-1.2.3.1-more.js';
	//$HEAD['INCLUDES']['js'][]='js/_class.noobSlide.packed.js';

	list($col,$fil)=explode("x",$NOOB['itemsporpagina']);

	if($NOOB['wh']){ list($NOOB['width'],$NOOB['height'])=explode("x",$NOOB['wh']); }

	$itemsporpginatotal=$col*$fil;
	$NOOB['width_bloque']=intval($NOOB['width']/$col);
	$NOOB['height_bloque']=intval($NOOB['height']/$fil);

	$NOOB['width_bloque']=$NOOB['width_bloque']-2*$NOOB['inter_col'];

	$NOOB['items_bloques']=array_chunk($NOOB['items'],$itemsporpginatotal);
	$NOOB['num_items']=sizeof($NOOB['items']);
	$NOOB['num_bloques']=sizeof($NOOB['items_bloques']);
	unset($NOOB['items']);
	$HEAD['INCLUDES']['style'][]="
	#contenedor_slider_".$NOOB['label']."_fijo,#contenedor_slider_".$NOOB['label']."_movil div.slid {width: ".$NOOB['width']."px; height:".$NOOB['height']."px;}";
	$HEAD['INCLUDES']['style'][]="
	#contenedor_slider_".$NOOB['label']."_movil div.slid li { width:".$NOOB['width_bloque']."px; height:".$NOOB['height_bloque']."px; margin-left:".$NOOB['inter_col']."px !important;margin-right:".$NOOB['inter_col']."px !important; }";


	return $NOOB;

}

function web_render_slideshow_preproceso($SLISHOW){
	global $HEAD; global $KENBURNS; global $LIGHTBOX;
 	list($SLISHOW['width'],$SLISHOW['height'])=explode('x',$SLISHOW['zoom']);
 	list($SLISHOW['thumb_width'],$SLISHOW['thumb_height'])=explode('x',$SLISHOW['thumb']);
	switch($SLISHOW['efecto']){
	case "1":
		$SLISHOW['class']="Slideshow";
		$HEAD['INCLUDES']['style'][]=".slideshow-images-visible { margin-left: 0; }.slideshow-images-prev { margin-left: 400px; }.slideshow-images-next { 	margin-left: -400px; }";
		$SLISHOW['transition']="'back:in:out'";
	break;
	case "2":
		$SLISHOW['class']="Slideshow";
		$SLISHOW['transition']="false";
	break;
	case "3":
		$KENBURNS=1;
		$SLISHOW['class']="Slideshow.KenBurns";
		$SLISHOW['transition']="false";

	break;
	case "4":

		if($SLISHOW['thumb_direccion']=='vertical'){
			$HEAD['INCLUDES']['style'][]="
			.slideshow-images { float:left; }
			.slideshow-thumbnails { position:relative; float:left; height: ".$SLISHOW['height']."px; left: 0; top: 0; width: ".$SLISHOW['thumb_width']."px; }
			.slideshow-thumbnails ul { width:".$SLISHOW['thumb_width']."px; }";
		} elseif($SLISHOW['thumb_direccion']=='horizontal'){
			$HEAD['INCLUDES']['style'][]="
			.slideshow-thumbnails { position:relative; bottom:0px; height: ".$SLISHOW['thumb_height']."px;  width: ".$SLISHOW['width']."px; }
			.slideshow-thumbnails ul { width: ".$SLISHOW['width']."px;  }
			";
		}

		$SLISHOW['class']="Slideshow";
		$SLISHOW['transition']="false";
		$SLISHOW['thumbnails']="true";
	break;
	}
		$SLISHOW['captions']=($SLISHOW['captions'])?$SLISHOW['captions']:"true";
		$SLISHOW['hrefs']=($SLISHOW['hrefs'])?$SLISHOW['hrefs']:"true";
		$SLISHOW['linked']=($SLISHOW['linked'])?$SLISHOW['linked']:"false";

		if($SLISHOW['linked']=='true'){	$LIGHTBOX=1; }
//	$HEAD['INCLUDES']['js'][]='js/slideshow.js';
//	$HEAD['INCLUDES']['css'][]='css/slideshow/slideshow.css';


	$HEAD['INCLUDES']['style'][]=".slideshow { width:100%;height:auto; }";
	return $SLISHOW;

}

function web_render_slideshow_proceso($SLIDE){

			?>
            <div id="div_<?php echo $SLIDE['label'];?>_slideshow">
                <a id="div_<?php echo $SLIDE['label'];?>_slideshow_content" class="slideshow" rel="lightbox">
                	<img src="<?php echo $SLIDE['listado']['0']['foto_zoom'];?>" />
                </a>
            </div>

            <?php if(!empty($SLIDE)){ ?>

            <script type="text/javascript">
            //<![CDATA[
              window.addEvent('domready', function(){

                var data = {
                <?php foreach($SLIDE['listado'] as $ii=>$item_pic){ ?>
				  '<?php echo $item_pic['foto_zoom'];?>': {
				  caption: '<?php echo $item_pic['caption'];?>'
				  ,href: '<?php echo $item_pic['href'];?>'
				  ,thumbnail: '<?php echo $item_pic['foto_thumb'];?>'
				  }
                  <?php echo ($ii==sizeof($SLIDE['listado'])-1)?"":","; ?>
                <?php } ?>
                };
                var myShow = new <?php echo $SLIDE['class'];?>('div_<?php echo $SLIDE['label'];?>_slideshow', data, {
                                                        controller: <?php echo $SLIDE['controller'];?> ,
                                                        width: <?php echo $SLIDE['width'];?> ,
                                                        height: <?php echo $SLIDE['height'];?>,
                                                        hu: '',
                                                        thumbnails: <?php echo $SLIDE['thumbnails'];?>,
                                                        duration: <?php echo $SLIDE['duration'];?>,
                                                        delay: <?php echo $SLIDE['delay'];?>,
                                                        overlap: <?php echo $SLIDE['overlap'];?>,
                                                        resize: <?php echo $SLIDE['resize'];?>,
                                                        transition: <?php echo $SLIDE['transition'];?>,
                                                        paused: <?php echo $SLIDE['paused'];?>,
                                                        captions: <?php echo $SLIDE['captions'];?>,
                                                        hrefs: <?php echo $SLIDE['hrefs'];?>,
                                                        linked: <?php echo $SLIDE['linked'];?>,
                                                        //replace: [/_4\./, '_1\.'],
                                                        loader: {'animate': ['<?php echo THEME_PATH;?>/css/slideshow/loader-#.png', 12]}
                                                        });

				<?php if($SLIDE['lightbox']=='true'){ ?>
				//alert(0);
				var box = new Lightbox({
				  'onClose': function(){ this.pause(false); }.bind(myShow),
				  'onOpen': function(){ this.pause(true); }.bind(myShow)
				});
				<?php } /*else { ?>alert(1);<?php }*/ ?>


              });

            //]]>
            </script>
            <?php }

}




function web_render_footer($obj){
$html='';
if(sizeof($obj['info'])>0){
$html.="<div class='footer_info info'>";
foreach($obj['info'] as $in=>$fo){
	 $html.="<div ". ( (is_numeric($in))?'':" class='div_absoluto footer_".$in." ".$in."' " ). ">".$fo."</div>"
	 ;}
$html.="</div>"; }
if($obj['by']!=''){ $html.="<strong class='div_absoluto footer_by' title='Diseño y Desarrollo'>".$obj['by']."</strong>"; }
echo $html;
}


function re_procesar_menu($menu,$url){

	foreach($menu as $mm=>$men){
		foreach($men as $nn=>$ite){
			if($ite['url']==$url){
				$menu[$mm][$nn]['class']='selected';
			}
		}
	}
	return $menu;

}



function get_this_include(){

	//return current(explode(".",end(explode("\\",end(get_included_files())))));
}


function web_selector($SES,$id_class){
	echo "";
	//echo $id_class." ".$SES[$id_class]." ";
}

function web_render_edit_toolbar($SELS){

	global $_SESSION; global $SERVER;
	if($_SESSION['edicionweb']=='1' and $SERVER['LOCAL']=='1'){
	global $CLASSSELECTED;
	global $WEBBLOQUES;
	global $MASTERBLOCK2;
	global $MASTERBLOCK;
	global $MASTERCOFIG;
	global $PARAMETROS_EMAIL_MASTER;
	global $FLOTANTES;
	global $BLOQUES_FLOTANTES;
	global $CLASSPARAMETERS;
	global $HEAD;
	global $vars;
	global $Estructura;
	global $Vectore;


	//if($MASTERCOFIG['edicion_bloques']){
	if(1){

	function ArrayToListIter3($arrar){
		global $Vectore;
		if(is_array($arrar)){
			foreach($arrar as $arra){
				if(is_array($arra)){
					ArrayToListIter3($arra);
				} else {
					$Vectore[]=$arra;
				}
			}
		}
	}
	ArrayToListIter3($Esquema);
	$VBV=array();
	//prin($Estructura);
	foreach($Estructura as $Esquema){
		ArrayToListIter3($Esquema);
	}
	foreach($Vectore as $Vec){
		//list($dir,$filephp)=explode("/",$Vec);
		//list($file,$php)=explode(".",$filephp);
		list($file,$php)=explode("?",$Vec);
		$file=trim($file);
		$VBV[$file]=$file;
	}
	$VBV=array_values($VBV);

	function getstylesoffile($archivo){

		$styles=array();
		$File= explode("\n",file_get_contents("../../modulos/".$archivo));
		foreach($File as $Fil){
			if(enhay($Fil,"\$object['styles']")){ eval($Fil); }
		}
		$styles=explode(",",$object['styles']);
		list($dir,$filephp)=explode("/",$archivo);
		list($file,$php)=explode(".",$filephp);
		if(!in_array($file,$styles)){
			$styles[]=$file;
		}
		foreach($styles as $style){
			if(trim($style)!=''){ $styles2[]=$style; }
		}
		$styles=$styles2;
		//prin($styles2);
		return $styles;

	}

	foreach($VBV as $VB){
		$styles=getstylesoffile($VB);
		foreach($styles as $style){
			$BV[]=$style;
		}
	}
	$VBV=$BV;

	}

	$OPACITY='0.99';

	?>
    <style>
	.div_body { margin-bottom:25px !important;}
	<?php if($SERVER['browser']=='Firefox'){ ?>
	.tool { border-bottom:17px solid #999 !important; }
	.div_body { margin-bottom:42px !important;}
	<?php } ?>

	.ayudaselect {
		/*background: url("panel/img/Arrow3.png") no-repeat scroll right 1px #000;*/
		background:#000;
		color: #FFF;
		cursor: pointer;
		display: none;
		font-variant: small-caps;
		height: 14px;
		padding-left: 1px;
		padding-right: 1px;
		position: absolute;
		right: 0;
		top: -10px;
		width: auto;
		z-index: 200;
	}
	.cuadro { overflow:visible; }
	.div_fila { overflow:visible; }

	.markarselected {
		outline:2px dashed #666;
		/*box-shadow:0 0 15px #ddd inset;*/
		/*box-shadow:0 0 20px navy;*/
		position:relative;
		overflow:visible;
	}
	.ovarr { position:absolute; display:none; bottom:18px; left:3px; z-index:4; width:500px; }
	.ovarr input { float:left; border:1px solid #333; font-size:9px; width:50px;  }
	.varr_sel .ovarr,
	.varr:hover .ovarr { display:block; }
	.markarselected .ayudaselect { display:block; }
    .varr { float:left;margin:0px 1px 0px 0px;height:14px;color:#FFF; position:relative; }
	.varro { position:relative; display:block; float:left; }
	textarea.PARAMS  { bottom:17px; left:-5px; }
	.varro .textarealabel  { top:-175px; }
	.varro .textarealabel { width:auto; height:auto; position:absolute; left:0px; display:none;text-transform:uppercase; padding:4px; padding-right:30px; z-index:5;  font-family:verdana;  background-color:#333333; font-size:8px;  }
	.varro .textarealabel strong { color:yellow; display:block; font-weight:normal;}
	.varro .textarealabel b { color:#F09F9F; display:block; font-weight:normal; }
	textarea.PARAMS  { width:580px; height:120px; position:absolute; display:none; z-index:4; padding:3px; box-shadow:0 0 20px #FFF; font-size:10px; font-family:trebuchet MS; background-color:#323232; color:#FFF; white-space: pre; padding-bottom:22px; border:0; margin-bottom:-3px;
	box-shadow:0 0 50px #6F6F6F inset;
	}

	.varr_sel textarea ,.varr:hover textarea  { display:block; }
	.varr_sel textarea { z-index:1; }
	.varr:hover textarea  { z-index:2; }
	.varr_sel .controls { z-index:1; }
	.varr:hover .controls  { z-index:2; }
	.controls { position:absolute; top:0px; left:375px; width:200px; text-align:right; color:black; background-color:#EE9F51; display:none; padding:0 0px 0 4px; font-weight:bold;  }
	.varr_sel .controls,
	.varr:hover .controls { display:block; }
	.controls a { visibility:hidden; color:white; background-color:#CF0F1C; float:right; padding:0 5px; margin-left:2px; }
	.varr_sel .controls a { visibility:visible; }

	.varro sup { vertical-align:top;margin-left:3px; }
	.varr .elemen { letter-spacing:-1px; cursor:default; color:#000; text-decoration:none; float:left;}

	.varr select { font-weight:normal;font-size:10px;width:auto;margin:0 1px 0 1px;padding:0; border:1px solid #000; float:left; background:#FEBFA5;}
	.tool { width:100%; position:fixed; padding:0;color:#000; opacity:<?php echo $OPACITY;?>; z-index:1; text-align:left; bottom:0px; right:0px; padding:0;  background-color:#EDF0FA; border-top:1px solid #999; height:auto !important; height:34px; min-height:34px; font-family:Calibri, Verdana, Geneva, sans-serif;

	 }
	.varr label, .varr .elemen { letter-spacing:-1px;width:auto;text-align:right; text-transform:uppercase; font-size:10px; background-color:#B9B9B9; }

	.varr .elemen2 { background-color:#343434; color:#FFF; }
	#tool .common { color:#F60; }
	#tool .usual { color:#06C; }
	#tool .itemss { color:#3F0; }

	.varr_sel .elemen,
	.varr .elemen:hover,
	.bvarr_sel .elemen { background-color: #FBF5AE !important;;
    color: #000000 !important;
    outline: 0px solid #FBF5AE;
    position: relative;
    z-index: 1001;}

	.bloque_1 { position:relative; height:auto; padding-right:550px; clear:left;}
	.bloque_1 .varr label { color:navy; font-weight:bold; }
	.bloque_tools { position:relative; height:auto; width:100%; background-color:#006600;   }
	.bloque_tools_flow { width:180px; bottom:105%; position:absolute; background:#777; padding:3px; left:3px; max-height:300px; overflow:auto; border:1px solid #333; }
	.bloque_2 .varr label { color:#770367; }
	.bloque_3 .varr label { color:#1C00FC; }
	.bloque_4 .varr label { color:#F8031B; }
	.bloque_5 .varr label {
   	background-color: #000000;
    color: #FFFFFF;
    margin-left: 5px;
    padding-left: 3px;
    padding-right: 4px;
	}
	.bloque_5 .varr a {
	background: none repeat scroll 0 0 #000000;
	color: #C22B2B;
	font-size: 10px;
	font-weight: bold;
	margin-left: -4px;
	margin-right: 3px;
	padding: 0 2px 0 0;
	}
	.class_tip_1 { color: #000;	width: auto; z-index: 13000; border:1px solid #000; }
	.class_tip_1 .tip {	 padding:0; }
	.class_tip_1 .tip .tip-title { font-weight: bold; font-size: 10px; margin: 0; color: #FFF; padding: 3px 8px; background: #000; text-align:left; text-transform:uppercase; }
	.class_tip_1 .tip .tip-text { padding:8px 8px 8px; font-size: 10px; background-color:#CCC; color:#000; text-align:left;  }
	.class_tip_1 .tip .tip-text b { font-weight:bold; color:#FF0000;}
	#procesando { background-color:#06C; color:#FFF; padding:5px 40px; position:absolute; top:-15px; right:0px; z-index:10; border:2px solid #036; font-weight:bold; }
	.warning { width:100%; float:left; height:auto; }
	.warning b { float:left; padding:0 4px; background:yellow; font-size:16px; color:red;  }
	</style>
    <div id="tool" class="tool" onmouseover="this.setStyles({'opacity':'1'});" onmouseout="this.setStyles({'opacity':'<?php echo $OPACITY;?>'});">
    <span id="demas">

	<?php

	if($PARAMETROS_EMAIL_MASTER['disabled'] or $PARAMETROS_EMAIL_MASTER['debug'] or $PARAMETROS_EMAIL_MASTER['email_prueba'])
	{ echo "<div class='warning'><b>formularios inactivos</b></div>"; }

	if($PARAMETROS_EMAIL_MASTER['debug']){

	?>
    <div class="bloque_5 bloque_tools" >
    <?php
//	echo getcwd();

	@mkdir("../../../debug");
	$directorio = dir("../../../debug");
	while($fichero=$directorio->read()) {
		if($fichero!='.' and $fichero!='..'){
			$files[]=$fichero;
		}
	}

	foreach($files as $file){
		?>
			<li class="varr">
				<a href="#" rel="nofollow" onclick="javascript:tool_abrir('debug/<?php echo $file;?>');return false;" style="color:#FFF;"><?php echo $file;?></a>
			</li>
		<?php
		}
	?>
    </div>
    <?php }
	?>

    <?php
	if($MASTERCOFIG['edicion_bloques']){
	?>
    <div class="bloque_5 bloque_tools bloque_tools_flow" style="">
    <?php
	foreach($WEBBLOQUES as $VAR=>$VAL){

		$clax='';
		if( substr($VAR,0,6)=='header' or
			substr($VAR,0,6)=='footer' or
			substr($VAR,0,4)=='menu' or
			$VAR=='bar' or
			$VAR=='status'
			){ $clax='common'; }
		if(substr($VAR,-5)=='_file' or substr($VAR,-5)=='_list'){ $clax='itemss'; }
		if(in_array($VAR,array('pages','home','contacto','boletin','recomendar','carrito','login','registrar'))){ $clax='usual'; }

		if($VAR!='web'){ ?>
			<li class="varr">
				<label class="<?php echo $clax;?>"><?php echo $VAR;?></label>
                <?php if(in_array(trim($VAR),$VBV)){ ?>
				<!--<a href="#" rel="nofollow" onclick="javascript:guardar_borrar('<?php echo $VAR;?>');return false;" title="borrar">x</a>-->
                <?php } else { ?>
				<a href="#" rel="nofollow" onclick="javascript:guardar_borrar('<?php echo $VAR;?>');return false;" title="borrar">x</a>
                <?php } ?>
			</li>
		<?php }
		}
	?>
    </div>
    <?php } ?>
    <div class="bloque_4 bloque_tools" style="clear:both;">
    <?php
	foreach($PARAMETROS_EMAIL_MASTER as $VAR=>$VAL){ ?>
        <li class="varr">
            <label><?php echo $VAR;?></label>
            <input type="checkbox" <?php echo ($VAL==1)?"checked":""; ?> onclick="guardar('formularios/formularios','PARAMETROS_EMAIL_MASTER','<?php echo $VAR;?>',this)" />
        </li>
    <?php } ?>
    </div>
    <div class="bloque_3 bloque_tools">
    <?php
	foreach($MASTERCOFIG as $VAR=>$VAL){ ?>
        <li class="varr">
            <label><?php echo $VAR;?></label>
            <input type="checkbox" <?php echo ($VAL==1)?"checked":""; ?> onclick="guardar('master','MASTERCOFIG','<?php echo $VAR;?>',this)" />
        </li>
    <?php } ?>
    <?php if($MASTERCOFIG['editar_friendly_url']){ ?>
    <li class="varr" ><a href="#" rel="nofollow" onclick="reset_htaccess(); return false;" style="color:inherit;">reset htaccess</a></li>
    <?php } ?>
    </div>
    <div class="bloque_2 bloque_tools">
    <?php
	foreach($MASTERBLOCK as $VAR=>$VAL){ ?>
        <li class="varr">
            <label><?php echo $VAR;?></label>
            <input type="checkbox" <?php echo ($VAL==1)?"checked":""; ?> onclick="guardar('driver','MASTERBLOCK','<?php echo $VAR;?>',this)" />
        </li>
    <?php } ?>
    </div>
    </span>
    <div class="bloque_1">
    <div id='procesando' style="display:none;">procesando</div>
	<a href="#" style="position:absolute; right:1px; top:0px; display:; color:#FFF; background:#000; outline:1px solid #000;" id="hidetool" onclick="hidetool(); return false;" rel="nofollow" title="Cerrar" >x</a>
	<a href="#" style="color:#FFF; display:none; background:#000;" id="showtool" onclick="showtool(); return false; outline:1px solid #000;" rel="nofollow" title="Abrir" >+</a>
    <span id="selects">
	<a href="panel" style="position:absolute; right:8px; top:0px; padding-left:1px; padding-right:1px; color:#000; background-color:#fff; outline:1px solid #000;" rel="nofollow" title="Panel" >p</a>
	<a href="#" style="position:absolute; background-color:green; right:20px; top:0px; color:#FFF;padding:0 2px; outline:1px solid #000;" onclick="subircss(); return false;" title="Subir css" rel="nofollow" >c</a>
	<?php  if($MASTERCOFIG['editar_css']){ ?>
    <a href="#" style="position:absolute; background-color:#993300; right:60px; top:0px; color:#FFFFFF; outline:1px solid #000;" onclick="saveparams(); return false;" title="Save" rel="nofollow" >param</a>
    <a href="#" style="position:absolute; background-color:#FF0000; right:33px; top:0px; color:#FFFFFF; outline:1px solid #000;" onclick="saveclass(); return false;" title="Save" rel="nofollow" >class</a>
    <?php }  ?>
    <a href="#" style="position:absolute; background-color:yellow; right:95px; top:0px; color:#000;padding:0 2px; outline:1px solid #000;" onclick="updateupdate(); return false;" title="Save" rel="nofollow" >a</a>


    <!--
    <a href="#" style="position:absolute; background-color:red; right:105px; top:0px; color:#FFF;padding:0 2px;" onclick="updateupdate(); return false;" title="Save" rel="nofollow" >ci</a>-->

<span style="position:absolute; background-color:blue; right:0px; top:-17px; color:#FFFFFF;" title="$_GET" rel="<?php foreach($_GET as $GG=>$EE){ echo "<b>".$GG."</b> : ".$EE."<br>"; } ?>" class="thisisatooltip">_get</span>

<span style="position:absolute; background-color:blue; right:25px; top:-17px; color:#FFFFFF;" title="$_SERVER" rel="<?php foreach($_SERVER as $GG=>$EE){ echo "<b>".$GG."</b> : ".$EE."<br>"; } ?>" class="thisisatooltip">_ser</span>

<span style="position:absolute; background-color:blue; right:50px; top:-17px; color:#FFFFFF;" title="$SERVER" rel="<?php foreach($SERVER as $GG=>$EE){ echo "<b>".$GG."</b> : ".$EE."<br>"; } ?>" class="thisisatooltip">ser</span>

<span style="position:absolute; background-color:blue; right:69px; top:-17px; color:#FFFFFF;" title="$_SESSION" rel="<?php foreach($_SESSION as $GG=>$EE){ echo "<b>".$GG."</b> : ".$EE."<br>"; } ?>" class="thisisatooltip">_ses</span>

<span style="position:absolute; background-color:black; right:0px; top:-32px; color:#FFF;" ><?php echo $HEAD['INCLUDE']['version'];?></span>

	</span>

	</div>

    </div>

	<script type="application/javascript">

	function tool_abrir(urll){
		window.open(<?php echo ($SERVER['browser']=='IE7')?"'../'+":"";?>urll,'proceso','width=750,height=450,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=270,left=240');

	}

	function getid(ee){ return document.getElementById(ee); }
	function $11(a){ getid(a).style.display=''; }
	function $00(a){ getid(a).style.display='none'; }

	function guardar(file,vr,key,id){
		$11('procesando');
		var myRequest = new Request({method: 'post',url: 'web/modulos/lib/saveclass.php',onSuccess:function(e){
		location.href='<?php echo $_SERVER['REQUEST_URI']?>';
		}});
		myRequest.send('file='+file+'&var='+vr+'&'+key+'='+( (id.checked)?'1':'0' ) );
	}

	function guardar_borrar(key){
		$11('procesando');
		var myRequest = new Request({method: 'post',url: 'web/modulos/lib/saveclass.php',onSuccess:function(e){
		location.href='<?php echo $_SERVER['REQUEST_URI']?>';
		}});
		myRequest.send('borrar=WEBBLOQUES&key='+key );
	}

	function hidetool(){
		getid('tool').style.width='8px';
		getid('hidetool').style.display='none';
		getid('showtool').style.display='';
		getid('selects').style.display='none';
		getid('demas').style.display='none';
/*		$('tool').setStyles({'width':'8px'});
		$('hidetool').setStyles({'display':'none'});
		$('showtool').setStyles({'display':''});
		$('selects').setStyles({'display':'none'});
		$('demas').setStyles({'display':'none'});
*/
	}

	function showtool(){
		getid('tool').style.width='100%';
		getid('hidetool').style.display='';
		getid('showtool').style.display='none';
		getid('selects').style.display='';
		getid('demas').style.display='';
/*		$('tool').setStyles({'width':'100%'});
		$('hidetool').setStyles({'display':''});
		$('showtool').setStyles({'display':'none'});
		$('selects').setStyles({'display':''});
		$('demas').setStyles({'display':''});
*/
	}
	function reset_htaccess(){
		$11('procesando');
		var myRequest = new Request({method: 'post',url: 'web/modulos/lib/saveclass.php'});
		myRequest.send('reset=htaccess');
	}
	function saveclass(){
		$11('procesando');
		new Request({
				url: 'web/modulos/lib/saveclass.php',
				onSuccess:function(ee){
					location.href='<?php echo $_SERVER['REQUEST_URI']?>';
					//new Asset.css('<?php echo $SERVER['BASE'].THEME_PATH;?>lib/css.css?r='+$random(0, 1000), { } );
				}
			}).send({
			method: 'post',
			data: { 'file':'css','var':'CLASSSELECTED',<?php echo implode(",",$ttt); ?> }
		});

	}

	function saveparams(){
		$11('procesando');
		new Request({
				url: 'web/modulos/lib/saveclass.php',
				onSuccess:function(ee){
					location.href='<?php echo $_SERVER['REQUEST_URI']?>';
				}
			}).send({
			method: 'post',
			data: { 'file':'css','var':'CLASSPARAMETERS',<?php echo implode(",",$tttp); ?> }
		});

	}

	function updateupdate(){
		$11('procesando');
		var myRequest = new Request({method:'get',url:'panel/maquina.php',onSuccess:function(ee){location.href='<?php echo $_SERVER['REQUEST_URI']?>';}});
		myRequest.send('accion=updatecode&reload=no');
	}

	function subircss(){
		$11('procesando');
		var myRequest = new Request({method:'get',url:'panel/maquina.php',onSuccess:function(ee){location.href='<?php echo $_SERVER['REQUEST_URI']?>';}});
		myRequest.send('accion=alllistado&files2=<?php echo $vars['INTERNO']['CARPETA_PROYECTO'];?>/web/templates/default/lib/css.css,<?php echo $vars['INTERNO']['CARPETA_PROYECTO'];?>/web/modulos/common.php');
	}

	function overselected(id_class){
		//$('PARAMS_'+id_class).addClass('PARAMS_sel');
		//$('ovarr_'+id_class).addClass('ovarr_sel');
		$$('.id_'+id_class).addClass('markarselected');
	}


	function clicktextarea(a,b){
		if($(a).style.display=='none'){
		$(a).setStyles({'display':'block'}); $(b).setStyles({'display':'block'});
		}else{
		$(a).setStyles({'display':'none'}); $(b).setStyles({'display':'none'});
		}
	}


	function outselected(tog){
		//$('PARAMS_'+tog).removeClass('PARAMS_sel');
		//$('ovarr_'+tog).removeClass('ovarr_sel');
		$$('.id_'+tog).removeClass('markarselected');
	}
	var ran = $random(0, 1000);
	function putclass(path,tren,dis,id_class,params){
		if($('css_'+id_class)){ $('css_'+id_class).destroy(); }
		new Asset.css(path+'/'+dis+'/css.css?'+params+'&r='+ran, { id:'css_'+id_class } );
		var ddis = new Array();
		$$('.'+id_class).each(function(element) {
			var trena = new Array();
			trena = tren.split("|");
			for(var i=0; i<trena.length;i++){
				$(element).removeClass(trena[i]);
			}
			ddis = dis.split("|");
			$(element).addClass(ddis[0]);
		})
	}

	window.addEvent('domready',function(){
		//$('div_body').setStyles({'margin-bottom':'50px'});
		<?php

		echo implode("",$tttt);

		?>
	});

	</script>
    <?php
	}

}



function web_selector_control($SELECTED,$THIS,$tipos,$debug=0){
	// $tiposA=array();
	// $tiposA=explode(",",$tipos);
	echo "id_".$THIS." ";
	// foreach($tiposA as $tipo){
	// 	echo $THIS."-".$tipo." ".$SELECTED[$THIS."-".$tipo]." ";
	// }
	// global $_SESSION; global $SERVER;
	// if($_SESSION['edicionweb']=='1' and $SERVER['LOCAL']=='1'){
	// 	global $MASTERCOFIG;
	// 	if($MASTERCOFIG['edicion_bloques']){
	// 		web_guardar_datos(array('file'=>'../../modulos/css','var'=>'WEBBLOQUES',$THIS=>$tipos),$debug);
	// 	}
	// }
}

function incluget($archivo,$p=NULL){

	global $_SESSION;
	global $SERVER;
	global $PARAMS;
	if($p==NULL){
		$out=parse_url($archivo);
		$archivo=$out['path'];
		parse_str($out['query'],$p);
	}
	$PARAMS = $p;
	$ar=array();
	$ar=explode("/",$archivo);
	list($THIS,$ex)=explode(".",end($ar));
	$THIS=($p['this']=='')?$THIS:$p['this'];
	if($ar['0']=='items'){
	$ah=explode("_",$THIS);
	$sah=sizeof($ah);
	$ah[$sah-1];
	$conec=str_replace("_".$ah[$sah-1],"",$THIS);
	$PARAMS['conector']=($p['conector']!='')?$p['conector']:$conec;
	}
	else { $PARAMS['conector']=($p['conector']!='')?$p['conector']:$THIS; }
	$PARAMS['classStyle']=($p['classStyle']=='')?$THIS:$p['classStyle'];
	if($p['width']!=''){ $PARAMS['width']=$p['width']; }
	$PARAMS['this']=$THIS;

	return $archivo;

}

function web_reload($url){

	@header("Location: $url");

}


function web_render_data_insert($ITEM,$OBJ,$style=1){

	switch($style){
		case "1":
			$opentag="<ul class='data'>";
			$closetag="</ul>";
		break;
		case "2":
			$opentag="<table class='data' cellspacing=0 cellpadding=0 border=0>";
			$closetag="</table>";
		break;
	}
	echo $opentag;
	$ITEM=explode(",",$ITEM);
	foreach($ITEM as $est2){
		unset($tag);unset($class); unset($label); unset($campo);
		list($est,$tag,$class)=explode(":",$est2);
		$pipe=(!(strpos($est,"|")===false))?"1":"0";
		list($campo,$label)=explode("|",$est);
		switch($est){
			default:
			$label=($label)?$label:(($pipe)?"":$campo);
			$tag=($tag)?$tag:"div";
			$class=($class)?$class:$campo;
			switch($style){
				case "1":
					echo "<li class='line line_".$class."'>
					<b class='var'>".$label."</b>
					<$tag class=\"valor\" >				<input type='text' id='cam_".$est2."' name='".$est2."' />	</$tag>
					</li>";
				break;
				case "2":
					echo "<tr class='line line_".$class."'>
					<td class='var' valign=top>".$label."</td>
					<td class=\"valor\" valign=top >	<input type='text' id='cam_".$est2."' name='".$est2."' />	</td>
					</tr>";
				break;
			}
			break;
		}
	}
	switch($style){
		case "1":
			echo "<li class='line line_".$class."'>
			<b class='var'>&nbsp;</b>
			<$tag class=\"valor\" >						<input type='button' value='crear pedido' id='cam_save' onclick=\"javascript:send_insert('".$OBJ."');return false;\" />	</$tag>
			</li>";
		break;
		case "2":
			echo "<tr class='line line_".$class."'>
			<td class='var' valign=top>&nbsp;</td>
			<td class=\"valor\" valign=top >			<input type='button' value='crear pedido' id='cam_save' onclick=\"javascript:send_insert('".$OBJ."');return false;\" />	</td>
			</tr>";
		break;
	}
	echo $closetag;
	echo "<script>
			function send_insert(obj){

				var datos = {
				estado			:  \"2\",
				nombre			:  $('cam_nombre').value,
				telefono		:  $('cam_telefono').value,
				celular			:  $('cam_celular').value,
				nextel			:  $('cam_nextel').value,
				email			:  $('cam_email').value,
				cache			:  \"{}\",
				fecha_creacion	:  \"now()\",
				visibilidad 	:  \"1\",
				v_o				:  obj
				};

				new Request({url:\"../ajax_sql.php?f=insert&debug=0\", method:'post', data:datos, onSuccess:function(ee) {

					var json=eval(\"(\" + ee + \")\");
					if(json.success=='1'){

						location.href='enviar_cotizacion.php?id='+json.id;

					} else if(json.success=='0'){

						alert('error');

					}

				  } } ).send();

			}

	</script>";


}


function web_render_data($item,$ITEM,$style=1){

	switch($style){
		case "1":
			$opentag="<ul class='data'>";
			$closetag="</ul>";
		break;
		case "2":
			$opentag="<table class='data' cellspacing=0 cellpadding=0 border=0>";
			$closetag="</table>";
		break;
	}
	echo $opentag;
	$ITEM=explode(",",$ITEM);
	foreach($ITEM as $est2){
		unset($tag);unset($class); unset($label); unset($campo);
		list($est,$tag,$class)=explode(":",$est2);
		$pipe=(!(strpos($est,"|")===false))?"1":"0";
		list($campo,$label)=explode("|",$est);
		switch($est){
			default:
			$label=($label)?$label:(($pipe)?"":$campo);
			$tag=($tag)?$tag:"div";
			$class=($class)?$class:$campo;
			switch($style){
				case "1":
					echo "<li class='line line_".$class."'>
					<b class='var'>".$label."</b>
					<$tag class=\"valor\" >".$item[$campo]."</$tag>
					</li>";
				break;
				case "2":
					echo "<tr class='line line_".$class."'>
					<td class='var' valign=top>".$label."</td>
					<td class=\"valor\" valign=top>".$item[$campo]."</td>
					</tr>";
				break;
			}
			break;
		}
	}
	echo $closetag;

}


function web_item($item,$ITEM,$debug=0){

	$ITEM=($ITEM!='')?$ITEM:(($item['esquema']!='')?$item['esquema']:'nombre');
	//echo $ITEM;
	$html='';
	if($debug) prin($ITEM);
	if($debug) prin($item);
	$ITEM=explode(",",$ITEM);
	foreach($ITEM as $est2){
		//nombre:
		unset($tag);unset($class); list($est,$tag,$class)=explode(":",$est2);
		list($est,$str)=explode("?",$est);
		if($str){
			parse_str($str,$Param);
			$class=$Param['class'];
			if(!$tag){
				$tag  =$Param['tag'];
			}
		}
		$item['url']=($item['url'])?$item['url']:$item['link'];

		$extraclass=($Param['absoluto']==1)?" div_absoluto":'';

		$thisDomain=1;
		if(enhay($item['url'],'http://')){
		if(enhay($item['url'],str_replace('http://','','cgtp.org.pe'))){	$thisDomain=1;	} else {	$thisDomain=0;	}
		}

		$Target=($thisDomain)?"":" target='_blank' ";

		switch($est){

			case "foto":
			if($item['foto']){
			$item['foto']['archivo']=($item['foto']['archivo'])?$item['foto']['archivo']:$item['foto']['get_archivo'];
			$item['foto']['atributos']=($item['foto']['atributos'])?$item['foto']['atributos']:$item['foto']['get_atributos'];
			$item['foto']['descripcion']=($item['foto']['descripcion'])?$item['foto']['descripcion']:$item['foto']['foto_descripcion'];
			$item['foto']['url']=($item['foto']['url'])?$item['foto']['url']:(($item['url'])?$item['url']:'');
			if(enhay($item['foto']['atributos'],"spacer.gif")){ continue; }
			$tag=($tag)?$tag:(($item['foto']['url'])?"a":"div");
			$class=($class)?$class:"foto";
			$legend=(is_array($item['foto']) and $item['foto']['descripcion']!='')?$item['foto']['descripcion']:'';
			$titulo=($legend!='')?$item['foto']['descripcion']:$item['titulo'];
			if($tag!='a'){
				$html.= "<div class=\"$extraclass $class\" >";
				$html.=  "<$tag ";
			} else {
				$html.=  "<$tag class=\"$extraclass $class\" ";
			}
			if($item['foto']['url']){
			$html.=  "href=\"".$item['foto']['url']."\" $Target ";
			$html.=  ($item['foto']['descripcion'])?" title=\"".$titulo."\" ":"";
			$html.=  ($item['foto']['rel'])?" rel=\"".$item['foto']['rel']."\" ":"";
			}
			$html.=  " >";
			$html.=  "<img ";
			$html.=  ($item['atributos']!='')?$item['atributos']:$item['foto']['atributos'];
			$html.=  ($item['foto']['descripcion'])?" title=\"".$titulo."\" alt=\"".$titulo."\" ":"";
			$html.=  " />";
			//if($legend!='') echo "<strong class='legend'>".$titulo."</strong>";
			$html.=  "</$tag>";
			if($tag!='a'){
				$html.=  "</div>";
			}
			}
			if($item['foto']['extra']){
				$html.=$item['foto']['extra'];
			}
			break;
			case "video":
			if($item['video']){
			//$tag=($tag)?$tag:"a";
			$class=($class)?$class:"video";
			$width=360; $height=intval(($width*3)/4);
			$html.=  '<div style="float:left;width:auto;height:auto;margin-right:10px;"><object width="'.$width.'" height="'.$height.'" align="middle" type="application/x-shockwave-flash" wmode="transparent" quality="high" allowscriptaccess="sameDomain" allowfullscreen="false" data="http://www.youtube.com/v/'.$item['video'].'&amp;amp;hl=es&amp;amp;fs=1&amp;amp;rel=0&amp;amp;color1=0x3a3a3a&amp;amp;color2=0x999999" style="visibility: visible;"><param name="wmode" value="transparent"><param name="quality" value="high"><param name="align" value="middle"><param name="allowScriptAccess" value="sameDomain"><param name="allowFullScreen" value="false"></object></div>';
			}
			break;

			case "nombre":case "titulo":

			$item['nombre']=($item['nombre'])?$item['nombre']:$item['titulo'];

			//prin($item);
			$tag=($tag)?$tag:"h2";
			$class=($class)?$class:$est;
			if($tag=='a' and ($item['url'] or $item['onclick'])){

			if($item['url']){ $html.= "<a class=\"$extraclass $class\" href=\"".$item['url']."\" $Target title=\"".$item['nombre']."\">"; }
			elseif($item['onclick']){ $html.= "<a class=\"$extraclass $class\" href=\"#\" onclick=\"".$item['onclick'].";return false;\" rel=\"nofollow\" title='".$item['nombre']."'>"; }
			$html.=($Param['limit'])?limit_string($item['nombre'],$Param['limit']):$item['nombre'];
			$html.="</a>";
			} else {
			$html.= "<$tag class=\"$class $extraclass\" >";
			if($item['url']){ $html.= "<a class=\"$extraclass $class\" href=\"".$item['url']."\" $Target title='".$item['nombre']."'>"; }
			elseif($item['onclick']){ $html.= "<a class=\"$extraclass $class\" href=\"#\" onclick='".$item['onclick'].";return false;' rel=\"nofollow\" title='".$item[$est]."'>"; }

			if($item['src']!=''){
			$html.='<img src="'. ( ($item['src-sel'] and $item['selected']=='selected')?$item['src-sel']:$item['src'] ).'" alt="'.$MENU_ITEM['label'].'" />';
			$html.=($Param['limit'])?limit_string($item['nombre'],$Param['limit']):$item['nombre'];
			} else {
			$html.=($Param['limit'])?limit_string($item['nombre'],$Param['limit']):$item['nombre'];
			}

			if($item['url'] or $item['onclick']){ $html.= "</a>"; }
			$html.= "</$tag>";
			}
			break;

			default:

			if($Param['orphant']=='1'){
				$html.=$item[$est];
			} else {

				$tag=($tag)?$tag:"div";
				$class=($class)?$class:$est;
				if($tag=='a' and $item['url']){ 				
				if($item['url']){ $html.= "<a class=\"$extraclass $class\" $Target href=\"".$item['url']."\" title='".$item[$est]."'>"; }


				if($MENU_ITEM['src']!=''){
				$html.='<img src="'. ( ($MENU_ITEM['src-sel'] and $MENU_ITEM['selected']=='selected')?$MENU_ITEM['src-sel']:$MENU_ITEM['src'] ).'" alt="'.$MENU_ITEM['label'].'" />';
				} else {
				$html.=$item[$est];
				// $html.=($Param['limit'])?limit_string($item['nombre'],$Param['limit']):$item['nombre'];
				}

				if($item['url']){ $html.= "</a>"; }
				} else {
				$html.=  ($item[$est]!=NULL)?"<$tag class=\"$extraclass $class\" >".( ($Param['limit'])?limit_string($item[$est],$Param['limit']):$item[$est] )."</$tag>":"";
				}
			}
			break;

		}
	}
	return $html;
}

function web_render_item($item,$ITEM,$debug=0){
	$ITEM=($ITEM!='')?$ITEM:(($item['esquema']!='')?$item['esquema']:'nombre');
	echo web_item($item,$ITEM,$debug);
}

function web_render_comming($vars,$session){
	global $_GET, $Local, $COMMON;
	if(!$Local and $vars['GENERAL']['DESARROLLO'] and !$session['verdesarrollo'] ){
		if($_GET['modulo']=='comming'){
		if(1){
//		if($vars['GENERAL']['COMMING']){
		$html ="<html>";
		$html.="<head>";
		$html.='<link rel="shortcut icon" href="web/templates/default/img/favicon.ico" type="image/x-icon" />';
		$html.="<style>";
//		$html.=".logo{ background: url(panel/img/nube.png); width:320px; height:171px;}.logo img { margin:47px auto 0px; }";
//		$html.=".logo{ background: url(panel/img/nube2.png); width:388px; height:153px;}.logo img { margin:47px auto 0px; }";
		$html.=".titulo{ font-size:30px; font-weight:bold; font-family:calibri; color:#FFF; text-shadow:1px 1px 25px #000000; text-transform:uppercase; }";
		$html.=".logo{ background: url(panel/img/paper.png); width:172px; height:155px;}.logo img { margin:43px auto 0px; width:161px; }";
		$html.="body{ background: url(panel/img/commingbg.png) #333; }";
		$html.=$vars['GENERAL']['construccion_style'];
		$html.='</style><title>Página en Construcción - '.$COMMON['datos_root']['titulo_web'].'</title></head>';
		$html.="<table width=100% height=100%><tr><td align=center valign=middle>";
		$html.='<div class=titulo>Página en Construcción<br>'.$COMMON['datos_root']['titulo_web'].'</div>';
		$html.='<div class=logo><img src="panel/'.$vars['GENERAL']['img_logo'].'"></div>';
		//$html.='<div><img src="panel/img/comming.jpg" width=100 ></div>';
		$html.="</td></tr></table></html>";
		} else {
		$html ='';
		}
		die($html);
		} else {
			global $SERVER; redireccionar_a($SERVER['BASE'].'comming');
		}
	} else {
		if($_GET['modulo']=='comming'){
			global $SERVER; redireccionar_a($SERVER['BASE']);
		}
	}

}

function web_render_fichero($item){
	global $COMMON;
	global $SERVER;
	$link=$item['link'];
	$filE=$item['get_archivo'];
	$Titulo=str_replace(array("[","]"),"",$item['titulo']);
	$titulo=($COMMON['datos_root'][$Titulo])?$COMMON['datos_root'][$Titulo]:$item['titulo'];
	$fa=explode(".",$filE);
	$ext = $fa[sizeof($fa)-1];
	switch($ext){
		case 'gif':case 'jpg':case 'jpeg':case 'png':
			list($ww,$hh)=explode("x",$item['dimensiones']);
			$linc=($link=='/')?$SERVER['BASE']:( (substr($link,0,1)=='/')?$SERVER['BASE'].$link:"http://".str_replace("http://","",$link) );
			echo ($link!='')?"<a href='$linc'>":'';
			echo '<img src="'.$filE.'" ';
			echo ($ww!='')?' width="'.$ww.'" height="'.$hh.'" ':'';
			echo ($titulo!='')?' title="'.$titulo.'" alt="'.$titulo.'" ':'';
			echo ' />';
			echo ($link!='')?"</a>":'';
		break;
		case 'swf':
			list($ww,$hh)=explode("x",$item['dimensiones']);
			echo '<object width="'.$ww.'" height="'.$hh.'">
<param name="movie" value="'.$filE.'">
<param name="wmode" value="transparent">
<param name="quality" value="high">
<embed src="'.$filE.'" width="'.$ww.'" height="'.$hh.'"  wmode="transparent" quality="high">
</embed>
</object>';
        break;
	}

}

function web_render_colap_2($id,$titulo,$contenido){
	?>
    <div class="colapsable close" id="<?php echo $id;?>">
        <div class="barra" onclick="openclose('<?php echo $id;?>');return false;" ><?php echo $titulo;?>
        <div class="boton boton_open" title="abrir" ></div>
        <div class="boton boton_close" title="cerrar" ></div>
        </div>
        <div class="contenido"><?php echo $contenido;?></div>
    </div>
	<?php
}

function web_render_colap($id,$titulo,$contenido,$open=false){
	// echo ;
	?>
    <div class="colapsable <?php echo ($open)?'open':'close'; ?>" id="<?php echo $id;?>">
        <div class="barra" >
			<?php echo $titulo;?>
            <div class="boton boton_open" title="abrir" ></div>
            <div class="boton boton_close" title="cerrar" ></div>
        </div>
        <div class="contenido" ><?php echo $contenido;?></div>
    </div>
    <script type="text/javascript">
    window.addEvent('domready',function() {
      	block<?php echo $id;?>=$('<?php echo $id;?>');
        var children<?php echo $id;?> = block<?php echo $id;?>.getChildren();
        barra<?php echo $id;?>=children<?php echo $id;?>[0];
        contenido<?php echo $id;?>=children<?php echo $id;?>[1];
        var state<?php echo $id;?> = false;
        <?php if(!$open){ ?>
        contenido<?php echo $id;?>.slide('out');
        <?php } ?>
        barra<?php echo $id;?>.addEvent('click',function(e) {
          contenido<?php echo $id;?>.slide((block<?php echo $id;?>.hasClass('close')) ? 'in' : 'out');
          if(block<?php echo $id;?>.hasClass('close')){
            block<?php echo $id;?>.addClass('open');
            block<?php echo $id;?>.removeClass('close');
          } else {
            block<?php echo $id;?>.addClass('close');
            block<?php echo $id;?>.removeClass('open');
          }
        });
    });
    </script>
	<?php 
}

function web_render_menu_footer($menus){

	$mmenu=array();
	foreach($menus as $menu){
		if($menu['disabled']!='1'){
			$mmenu[]="<h2><a href='".procesar_url($menu['url'])."' title='".$menu['label']."'>".$menu['label']."</a></h2>";
		}
	}
	echo implode(" - ",$mmenu);

}

function web_procesar_keywords($string){

	global $STOPWORDS;
	//global $TAGS;
	$string=str_replace(array("\n","\t","\r"),array(" "," "," "),strip_tags($string));
	$keyword = new autokeyword(array('content'=>$string,'stopwords'=>$STOPWORDS), "utf-8");
	$keys = $keyword->get_keywords();
	/*
	$keys=array_merge($TAGS,$keys);*/
	$keys2=array_chunk($keys,10);
	$kw=implode(",",$keys2[0]);
	//prin($keywords,"#0000FF");
	return $kw;

}

function web_procesar_description($string){

	$string=str_replace("...","",limit_string($string,150));
	//prin($string,"#FFFF00");
	return $string;

}

function web_render_facebook_like($fb){
	global $SERVER;
	$url=urlencode($fb['url']);
	echo '<div class="facebook_like">';
	echo '<iframe class="facebook_like" src="';
	if(!$SERVER['LOCAL']){ echo 'http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout=standard&amp;show_faces=false&amp;width='.$fb['w'].'&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height='.$fb['h'];}
	echo '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$fb['w'].'px; height:'.$fb['h'].'px;" allowTransparency="true"></iframe>';
	echo '</div>';
}


function web_render_buscador($BUSCAR){
$html='';
$html.='<form action="index.php" onsubmit="if(this.buscar.value==\'\') return false;">
	<input class="box" type="text" name="buscar" value="'.$BUSCAR.'" />
	<input class="button" value="buscar" type="submit" />
</form>';
echo $html;
}

function title_friendly($title){
	$title=mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
	$uno=array('A ','Con ','En ','De ','Del ','Al ','Ii');
	$dos=array('a ','con ','en ','de ','del ','al ','II');
	$title=str_replace($uno,$dos,$title);
	return $title;
}
function title_web($title,$name_web){
	global $SERVER;
	$html=($SERVER['URL']=='')?$name_web:$title." | ".$name_web;
	return $html;
}

function web_render_tree($MENU,$esquema,$debug=0){

	$html ='';
	$html.="<ul class='arbol_items'>";
		foreach($MENU as $MENU_ITEM){
			$esquema=($MENU_ITEM['esquema'])?$MENU_ITEM['esquema']:$esquema;
			//alias
			$MENU_ITEM['class']=($MENU_ITEM['class'])?$MENU_ITEM['class']:$MENU_ITEM['selected'];
			$MENU_ITEM['src']=($MENU_ITEM['src'])?$MENU_ITEM['src']:$MENU_ITEM['foto'];
			$MENU_ITEM['src-sel']=($MENU_ITEM['src-sel'])?$MENU_ITEM['src-sel']:$MENU_ITEM['foto-sel'];
			$MENU_ITEM['nombre']=($MENU_ITEM['nombre'])?$MENU_ITEM['nombre']:$MENU_ITEM['label'];
			//
			$html.='<li class="listado_item '.$MENU_ITEM['nivel'].' '.$MENU_ITEM['class'].'">';
			$aAtrib='title="'.$MENU_ITEM['label'].'" ';

			$esquema=($esquema!='')?(($esquema=='h3')?'nombre:h3':$esquema):(($MENU_ITEM['esquema']!='')?$MENU_ITEM['esquema']:'nombre');

			$html.=web_item($MENU_ITEM,$esquema,$debug);
//			prin($MENU_ITEM);
			$html.='</li>';
		}
	$html.="</ul>";
	echo $html;

}


function web_render_tree_special($MENU,$esquema,$debug=0){
	$ran=rand(0,10000);
	$MENUU=array();
	foreach($MENU as $ii=>$MENU_ITEM){
		if($MENU_ITEM['nivel']=='menu_nivel_1'){
			if($MENU_ITEM['nombre']=='/'){
				$force_nivel_1=true;
				continue;
			} else
				$force_nivel_1=false;
		}
		$MENU_ITEM['nivel']=($force_nivel_1)?'menu_nivel_1':$MENU_ITEM['nivel'];	

		$MENUU[]=$MENU_ITEM;
	}
	$MENU=$MENUU;
	$opened=FALSE;
	$rr='';
	foreach($MENU as $ii=>$MENU_ITEM){
		
		$MENU[$ii]['class']=($MENU[$ii]['class'])?$MENU[$ii]['class']:$MENU[$ii]['selected'];

		if($MENU_ITEM['nivel']=='menu_nivel_2'){
			if( ( $MENU[$ii-1]['nivel']=='menu_nivel_1') and !$opened ){
				$MENU[$ii-1]['control']=" onclick=\"\$01('menu_grupo_".$ii.$ran."');\" ";							
				$MENU[$ii]['open']='<div id="menu_grupo_'.$ii.$ran.'" class="menu_group" style="display:none;" >';	
				// $MENU[$ii]['open']='display:none;';	
				$opened=TRUE;
				$rr=$ii;					
			}
			if( ($MENU[$ii+1]['nivel']=='menu_nivel_1' or $ii==sizeof($MENU)-1 ) and $opened ){
				$MENU[$ii]['close']='</div>';	
				// $MENU[$ii]['close']='';	
				$opened=FALSE;						
			}
		}
		// if($MENU_ITEM['nivel']!='menu_nivel_1')		
		// 	$MENU[$ii]['parent']=$rr;

		if($MENU[$ii]['class']=='selected')
			$MENU[$rr]['open']=str_replace("display:none","display:",$MENU[$rr]['open']);

	}	

	// prin($MENU);
			
	$html ='';
	$html.="<ul class='arbol_items'>";
		foreach($MENU as $MENU_ITEM){
			$esquema=($MENU_ITEM['esquema'])?$MENU_ITEM['esquema']:$esquema;
			//alias
			$MENU_ITEM['src']=($MENU_ITEM['src'])?$MENU_ITEM['src']:$MENU_ITEM['foto'];
			$MENU_ITEM['src-sel']=($MENU_ITEM['src-sel'])?$MENU_ITEM['src-sel']:$MENU_ITEM['foto-sel'];
			$MENU_ITEM['nombre']=($MENU_ITEM['nombre'])?$MENU_ITEM['nombre']:$MENU_ITEM['label'];
			//
			$html.=($MENU_ITEM['open'])?$MENU_ITEM['open']:'';
			$html.='<li class="listado_item '.$MENU_ITEM['nivel'].' '.$MENU_ITEM['class'].' " '.$MENU_ITEM['control'].'>';
			$aAtrib='title="'.$MENU_ITEM['label'].'" ';

			$esquema=($esquema!='')?(($esquema=='h3')?'nombre:h3':$esquema):(($MENU_ITEM['esquema']!='')?$MENU_ITEM['esquema']:'nombre');
			$html.=web_item($MENU_ITEM,$esquema,$debug);
//			prin($MENU_ITEM);
			$html.='</li>';
			$html.=($MENU_ITEM['close'])?$MENU_ITEM['close']:'';
		}
	$html.="</ul>";
	echo $html;
	// echo "<textarea style='width:100%;height:500px;z-index100;'>$html</textarea>";
}


function web_render_items($items,$esquema,$debug=0){

	$html ='';
	$html.="<ul class='listado_items'>";
		foreach($items as $item){

			$html.='<li class="listado_item">';

			$esquema=($esquema!='')?$esquema:(($item['esquema']!='')?$item['esquema']:'nombre');

			$html.=web_item($item,$esquema,$debug);

			$html.='</li>';
		}
	$html.="</ul>";
	echo $html;

}

function web_verificar_sesion($opc){
	global $COMMON;
	global $SERVER;
	global $_SESSION;
	$login=$_SESSION['login'];
	$url_login=(!is_null($opc['url_login']))?$opc['url_login']:$COMMON['url_login'];
	if($login['status']!='1'){
		if(!is_null($opc['on_false'])){
			$_SESSION['redir_after_login']=$opc['on_false'];
			redireccionar_a($url_login);
		}
	} else {
		if(!is_null($opc['on_true'])){
			//prin($opc['on_true']);
			//redireccionar_a($SERVER['BASE'].$opc['on_true']);
			redireccionar_a($opc['on_true']);
		}
	}
}

function web_selected($menu,$GET){
	global $SERVER;
	unset($GET['ht']);
	$Menu=array();
	foreach($menu as $tt=>$linea){
		$Menu[$tt]=$linea;
		if($linea['url']!=''){
		if(procesar_url("index.php?".http_build_query($GET))==$linea['url']){
			$Menu[$tt]['selected']='selected';
		}
		}
	}
	return $Menu;
}

function web_render_page($esto,$filtro=NULL,$opciones=NULL){

	$result=fila(
		"id,pagina,titulo,texto,foto,foto_descripcion,fecha_creacion"
		,"paginas"
		,"where pagina='".$esto."' and  visibilidad='1' $filtro "
		,0
		,array(
				'carpeta'=>'pag_imas'
				,'tamano'=>'2'
				,'dimensionado'=>($opciones['foto_dimension'])?$opciones['foto_dimension']:'380x250'
				//,'centrado'=>'1'
				,'get_atributos'=>array('get_atributos'=>array(
											'carpeta'=>'{carpeta}'
											,'fecha'=>'{fecha_creacion}'
											,'file'=>'{foto}'
											,'tamano'=>'{tamano}'
											,'dimensionado'=>'{dimensionado}'
											//,'centrado'=>'{centrado}'
											)
										)
			  )
		);
	return $result;

}

function css_render_general($ID,$DIR,$opciones){
	return css_render_esquinas($ID,$DIR,$opciones);
}

function css_render_esquinas($ID,$DIR,$opciones){
	//echo $ID."\n";
	//echo $DIR."\n";
	global $PARTICULAR;
	$derLong=0;
	$derBlock=0;
	$derArrow=0;
	$derHandle=0;
	$but_top=($opciones['buts'][0])?$opciones['buts'][0]:0;
	$but_lados=($opciones['buts'][1])?$opciones['buts'][1]:0;

	$handle_top=($opciones['handle'][0])?$opciones['handle'][0]:0;
	$handle_lados=($opciones['handle'][1])?$opciones['handle'][1]:0;

	$lineas=array();
	$tipos=array('png','jpg','gif');
	$files=array(
		'barra_arriba'=>array('barra_arriba'),
		'barra_abajo'=>array('barra_abajo'),
		// 'block'=>array('arriba_izquierda','arriba_derecha','abajo_izquierda','abajo_derecha'),
		'arrow_left'=>array('but_prev'),
		'arrow_right'=>array('but_next'),
		'but_handle'=>array('but_handle','but_handle_selected'),
		'bg'=>array('bg'),
		'bg_izq'=>array('bg_izq'),
		'bg_der'=>array('bg_der'),
	);
	//echo getcwd(); echo "\n";
	foreach($files as $type=>$files2){
		//prin($files);
		foreach($files2 as $file){
			$file_exists=0;
			$file0="";
			foreach($tipos as $tipo){
				$file01=$PARTICULAR."/$DIR/".$file.".".$tipo;
				//echo "$file01 \n";
				if(file_exists($file01)){ $file_exists=1; $file0=$file01; continue; }
			}
			if($file_exists){
				$size=getimagesize($file0);
				switch($type){
	case "barra_arriba": $derLong=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:repeat-x; height:".$size[1]."px; background-position:left top; }"; break;
	case "barra_abajo": $derLong=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:repeat-x; overflow: visible; height:".$size[1]."px; background-position:left bottom;}"; break;
	case "block":$derBlock=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; display:block !important; }"; break;

	case "arrow_left":$derArrow=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; top:".$but_top."px; left:".$but_lados."px; }"; break;
	case "arrow_right":$derArrow=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; top:".$but_top."px; right:".$but_lados."px; }"; break;

	case "but_handle": $derHandle=1;
	$lineas[]=".$ID .but_handles .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px;}";
	$lineas[]=".$ID .but_handles .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px;}";
	break;
	case "bg_izq":
	$lineas[]=".$ID { background-image: url(\"".$file0."\"); background-repeat:repeat-y; background-position:left top;}";
	break;
	case "bg_der":
	$lineas[]=".$ID .div_inner { background-image: url(\"".$file0."\"); background-repeat:repeat-y; background-position:right top;}";
	break;
	case "bg":
	if($size[0]==1){
	$lineas[]=".$ID { background-image: url(\"".$file0."\"); background-repeat:repeat-x;}";
	}elseif($size[1]==1){
	$lineas[]=".$ID { background-image: url(\"".$file0."\"); background-repeat:repeat-y;}";
	}else{
	$lineas[]=".$ID { background-image: url(\"".$file0."\"); background-repeat:no-repeat;}";
	}
	break;

				}
			}
		}
	}
	$css="";
	//if($derLong){ $css.=".$ID .esquina { display:block !important; }\n"; }
	if($derArrow){ $css.=".$ID .but_prev,.$ID .but_next { position:absolute; background-repeat:no-repeat; padding:0; }\n"; }
	//if($derHandle){ $css.=".$ID .but_handles { top:".$handle_top."px; padding-left:".$handle_lados."px; padding-right:".$handle_lados."px; position:absolute;}\n"; }
	if(is_array($files['but_handle'])){ $css.=".$ID .but_handles { top:".$handle_top."px; padding-left:".$handle_lados."px; padding-right:".$handle_lados."px; position:absolute;}\n"; }

	foreach($lineas as $lin2){ $css.=$lin2."\n"; }
	echo $css;
}

function web_render_combo($combo){
	$html='';
	$html.='<select';
	$html.=($combo['onchange'])?' onchange="'.$combo['onchange'].'"':'';
	$html.=($combo['name'])?' name="'.$combo['name'].'"':'';
	$html.=($combo['class'])?' class="'.$combo['class'].'"':'';
	$html.=($combo['style'])?' style="'.$combo['style'].'"':'';
	$html.='>';
	$html.='<option></option>';
	foreach($combo['items'] as $item){
	$html.='<option value="'.$item['value'].'" '.$item['selected'].'>'.$item['opcion'].'</option>';
	}
	$html.='</select>';
	echo $html;
}

function css_render_menu($ID,$DIR,$opciones){
	global $PARTICULAR;
	$derLong=0;
	$derBlock=0;
	$derArrow=0;
	/*
	$but_top=($opciones['buts'][0])?$opciones['buts'][0]:0;
	$but_lados=($opciones['buts'][1])?$opciones['buts'][1]:0;
	*/
	$lineas=array();
	$tipos=array('png','jpg','gif');
	$files=array(
		'long'=>array('div_menu','item_bg','item_selected_bg'),
		'block'=>array('div_menu_izq','div_menu_der','item_izq','item_der','item_selected_izq','item_selected_der'),
		//'arrow_left'=>array('but_prev'),
		//'arrow_right'=>array('but_next'),
	);
	$class=array(
				'div_menu'=>'.CLOSS .area_menu',

				'item_bg'=>'.CLOSS .area_menu ul li',
				'item_selected_bg'=>'.CLOSS .area_menu ul li.selected, .CLOSS .area_menu ul li:hover, .CLOSS .area_menu ul li.hover',

				// 'item_izq'=>'.CLOSS .area_menu ul li .menu_izq',
				// 'item_der'=>'.CLOSS .area_menu ul li .menu_der',
				// 'item_selected_izq'=>'.CLOSS .area_menu ul li.selected .menu_izq, .CLOSS .area_menu ul li:hover .menu_izq, .CLOSS .area_menu ul li.hover .menu_izq',
				// 'item_selected_der'=>'.CLOSS .area_menu ul li.selected .menu_der, .CLOSS .area_menu ul li:hover .menu_der, .CLOSS .area_menu ul li.hover .menu_der',

				// 'div_menu_izq'=>'.CLOSS .area_menu ul div.div_menu_float_izq',
				// 'div_menu_der'=>'.CLOSS .area_menu ul div.div_menu_float_izq',
				);

	foreach($files as $type=>$files2){
		foreach($files2 as $file){
			$file_exists=0;
			$file0="";
			foreach($tipos as $tipo){
				$file01=$PARTICULAR."/$DIR/".$file.".".$tipo;
				if(file_exists($file01)){ $file_exists=1; $file0=$file01; continue; }
			}
			if($file_exists){
				$size=getimagesize($file0);
				switch($type){
	case "long": $derLong=1; $lineas[]=str_replace("CLOSS",$ID,$class[$file])." { background-image: url(\"".$file0."\") !important; background-repeat:repeat-x; height:".$size[1]."px; }"; break;
	case "block":$derBlock=1; $lineas[]=str_replace("CLOSS",$ID,$class[$file])." { background-image: url(\"".$file0."\") !important; background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; display:block !important; }"; break;
	/*
	case "arrow_left":$derArrow=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; top:".$but_top."px; left:".$but_lados."px; }"; break;
	case "arrow_right":$derArrow=1; $lineas[]=".$ID .$file { background-image: url(\"".$file0."\"); background-repeat:no-repeat; height:".$size[1]."px;width:".$size[0]."px; top:".$but_top."px; right:".$but_lados."px; }"; break;
	*/
				}
			}
		}
	}
	$css="";
	//if($derLong){ $css.=".$ID .esquina { display:block !important; }\n"; }
	if($derArrow){ $css.=".$ID .but_prev,.$ID .but_next { position:absolute; background-repeat:no-repeat; padding:0; }\n"; }
	foreach($lineas as $lin2){ $css.=$lin2."\n"; }
	echo $css;
}

function get_data_tree($get,$grupos){

foreach($grupos as $a=>$b){
	$igrupo[$b]=$a;
}

if(!empty($get['fil']) and !empty($get['val'])) {

	switch($grupos[$get['fil']]){
		case "grupos":

if(in_array('subfiltros',$grupos))$tri['subfiltros']='';
if(in_array('filtros',$grupos))$tri['filtros']='';
if(in_array('subgrupos',$grupos))$tri['subgrupos']='';
if(in_array('grupos',$grupos))$tri['grupos']=fila("id,nombre","productos_grupos","where id='".$get['val']."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['grupos'].'&val={id}&friendly={nombre}')),));

		break;
		case "subgrupos":

if(in_array('subfiltros',$grupos))$tri['subfiltros']='';
if(in_array('filtros',$grupos))$tri['filtros']='';
if(in_array('subgrupos',$grupos))$tri['subgrupos']=fila("id,nombre","productos_subgrupos","where id='".$get['val']."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subgrupos'].'&val={id}&friendly={nombre}')),));
if(in_array('grupos',$grupos))$tri['grupos']=fila("id,nombre","productos_grupos","where id='".dato("id_grupo","productos_subgrupos","where id='".$tri['subgrupos']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['grupos'].'&val={id}&friendly={nombre}')),));

		break;
		case "filtros":

if(in_array('subfiltros',$grupos))$tri['subfiltros']='';
if(in_array('filtros',$grupos))$tri['filtros']=fila("id,nombre","productos_filtros","where id='".$get['val']."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['filtros'].'&val={id}&friendly={nombre}')),));
if(in_array('subgrupos',$grupos))$tri['subgrupos']=fila("id,nombre","productos_subgrupos","where id='".dato("id_subgrupo","productos_filtros","where id='".$tri['filtros']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subgrupos'].'&val={id}&friendly={nombre}')),));
if(in_array('grupos',$grupos))$tri['grupos']=fila("id,nombre","productos_grupos","where id='".dato("id_grupo","productos_subgrupos","where id='".$tri['subgrupos']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['grupos'].'&val={id}&friendly={nombre}')),));

		break;
		case "subfiltros":

if(in_array('subfiltros',$grupos))$tri['subfiltros']=fila("id,nombre","productos_subfiltros","where id='".$get['val']."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subfiltros'].'&val={id}&friendly={nombre}')),));
if(in_array('filtros',$grupos))$tri['filtros']=fila("id,nombre","productos_filtros","where id='".dato("id_filtro","productos_subfiltros","where id='".$tri['subfiltros']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['filtros'].'&val={id}&friendly={nombre}')),));
if(in_array('subgrupos',$grupos))$tri['subgrupos']=fila("id,nombre","productos_subgrupos","where id='".dato("id_subgrupo","productos_filtros","where id='".$tri['filtros']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subgrupos'].'&val={id}&friendly={nombre}')),));
if(in_array('grupos',$grupos))$tri['grupos']=fila("id,nombre","productos_grupos","where id='".dato("id_grupo","productos_subgrupos","where id='".$tri['subgrupos']['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['grupos'].'&val={id}&friendly={nombre}')),));

		break;
	}

}elseif($get['id']!=''){

	if(in_array('subfiltros',$grupos))$tri['subfiltros']=fila("id,nombre","productos_subfiltros","where id='".dato("id_subfiltro","productos_items","where id='".$_GET['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subfiltros'].'&val={id}&friendly={nombre}')),));
	if(in_array('filtros',$grupos))$tri['filtros']=fila("id,nombre","productos_filtros","where id='".dato("id_filtro","productos_items","where id='".$_GET['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['filtros'].'&val={id}&friendly={nombre}')),));
	if(in_array('subgrupos',$grupos))$tri['subgrupos']=fila("id,nombre","productos_subgrupos","where id='".dato("id_subgrupo","productos_items","where id='".$_GET['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['subgrupos'].'&val={id}&friendly={nombre}')),));
	if(in_array('grupos',$grupos))$tri['grupos']=fila("id,nombre","productos_grupos","where id='".dato("id_grupo","productos_items","where id='".$_GET['id']."'")."'",0,array('url'=>array('url'=>array('index.php?modulo=items&tab=productos&acc=list&fil='.$igrupo['grupos'].'&val={id}&friendly={nombre}')),));

}else{

	if(in_array('subfiltros',$grupos))$tri['subfiltros']='';
	if(in_array('filtros',$grupos))$tri['filtros']='';
	if(in_array('subgrupos',$grupos))$tri['subgrupos']='';
	if(in_array('grupos',$grupos))$tri['grupos']='';

}

	foreach($grupos as $name=>$gru){
		if($tri[$gru]!=''){
			$trenn[]="<a class='item' id='tren_".$name."' href='".$tri[$gru]['url']."'>".$tri[$gru]['nombre']."</a>";
		}
	}

	$tren="<div class='tren'>".implode("<span class='intertren'>&gt;</span>",$trenn)."</div>";
	return array($tri,$tren);

}



function get_arbol($niveles,$nivel=0,$id=NULL,$debug=0){
	global $Items;
	//$nivel=($nivel)?$nivel:0;

	//[0] tabla
	//[1] nivel
	//[2] url friendly variable
	//[3]
	//[4] campo de where

	$params=$niveles[$nivel];
//	prin($params);
	$items= select(
		"id,nombre",
		$params[0],
		"where ".(($params[4])?str_replace("[id]",$id,$params[4]):'1')." and  visibilidad='1' order by calificacion desc limit 0,100"
		,$debug,
		array(
			'nivel'=>$params[1],
			'url'=>array('url'=>($params[5])?array('index.php?'.$params[5]):array('index.php?modulo=items&tab=productos&acc=list&fil='.$params[2].'&val={id}&friendly={nombre}')),
			//'selected'=>array('match'=>array($tri[$params[3]]['id'],'{id}','selected',''))
		)
	);
	$nextnivel=$nivel+1;
	foreach($items as $item){
		$Items[]=$item;
		if($niveles[$nextnivel]){
			get_arbol($niveles,$nextnivel,$item['id'],$debug);
		}
	}
}

function get_arboles($niveles,$nivel=0,$id=NULL,$debug){
	global $Items;
	$Items=array();
	get_arbol($niveles,$nivel,$id,$debug);
	return $Items;
}

function pre_procesar_tree($menu,$urls){
	$urls=(is_array($urls))?$urls:array($urls);
	//prin($urls);
	foreach($menu as $i=>$men){
		//prin($men['url']);
		if(in_array($men['url'],$urls)){ $menu[$i]['class']='selected'; }
	}
	return $menu;
}

function Titulo_Filtro($titulo,$value){
	$MesesA=array('1'=>'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre');
	list($year,$month)=explode("-",$value);
	return $titulo.$MesesA[$month]." de ".$year;
}


function procesar_url($url,$debug=0){

	global $URLS; global $MASTERCOFIG;
	//	prin($URLS);

	if(substr($url,-5)=='.html'){
		return $url;
	}

	if($MASTERCOFIG['friendly_url']=='0'){

		return $url;

	}

	if(isset($URLS[$url])){

		$url=$URLS[$url];

	} else {

		$file="index.php?";
		$url2=str_replace($file,"",$url);

		parse_str($url2,$gets);
		$url='';

		/*	ANTIGUO*/
		if( $gets['modulo']=='home' ){
			if( $gets['tab']=='productos' ){
				if( isset($gets['buscar']) ){
					$url.='buscar/'.url_encode_seo($gets['buscar']);
				} elseif( $gets['id_grupo']!='' ){
					$url.='productos/'.url_encode_seo($gets['id_grupo']);
				} else {
					$url.='';
				}
				$slash=($url=='')?'':'/';
				$url.=( ($gets['pag'])?$slash.$gets['pag']:"" );
			}

		} elseif($gets['modulo']=='item'){
			if( $gets['tab']=='productos' ){
				$url="producto/".$gets['id'];
			}
		}

		/*ESPECIALES*/
		if($gets['modulo']=='formularios' and $gets['tab']=='login' and $gets['redir']!=''){
			$url.="index.php?modulo=formularios&tab=login&redir=".urlencode($gets['redir']);
		}
		/**/
		elseif( $gets['modulo']=='items' ){
			$url.=$gets['tab'];
			//			$url.=( ($gets['grupo'])?"/".$gets['grupo']."/". ( ($gets['friendly'])?url_friendly($gets['friendly']):"index.html" ):"" );
			if( $gets['acc']=='file' ){
				$url.=( ($gets['id'])?"/".$gets['id']."/". ( ($gets['friendly'])?url_friendly($gets['friendly']):"index.html" ):"" );

				$url.=( ($gets['pag'])?"/pag-".$gets['pag']:"" );
			} elseif( $gets['acc']=='list' ){
				$url.=( ($gets['gru'])?"-".$gets['gru']."/". ( ($gets['friendly'])?url_friendly($gets['friendly']):"categoria" ):"" );

				$url.=( ($gets['fil'])?"/".$gets['fil'].(($gets['val'])?"/".$gets['val']."/".( ($gets['friendly'])?url_friendly($gets['friendly']):"index.html" ):''):'');

				$url.=( ($gets['buscar'])?"/buscar=".$gets['buscar']:"" );

				$url.=( ($gets['pag'])?"/pag-".$gets['pag']:"" );
			}
		}
		elseif( $gets['modulo']=='app' and $gets['tab']=='pages' ){
			$url.=$gets['page'];
			//$url.=( ($gets['pag'])?"/pag-".$gets['pag']:"" );
		}
		elseif( $gets['modulo']=='app' ){
			$url.=$gets['tab'];
			//$url.=( ($gets['pag'])?"/pag-".$gets['pag']:"" );
		}
		elseif( $gets['modulo']=='formularios'){
			$url.=$gets['tab'];
		}

		if($debug==1){
			prin($gets); prin($url);
		}

	}
	$url=str_replace('&amp;','&',$url);

	return $url;

}
