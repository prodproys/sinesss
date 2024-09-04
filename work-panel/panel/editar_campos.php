<div class="cuadro_codigo" style="clear: left;">
	<?php
		
	$Quicks=array(
			'validacion'=>'V',
			'listable'=>'L',
			'unique'=>'U',
			'like'=>'K',
			'tags'=>'T',
			'constante'=>'C',
			'disabled'=>'D',
				
			'web_form'=>'W',
			'tip_foreig'=>'F',
			'queries'=>'Q',
			'noedit'=>'NE',
			'crearforeig'=>'CF',
			'nogrilla'=>'NG',
			'dlquery'=>'DLQ',

			'frozen'=>'FR',
			'resaltar'=>'HL',
			'select_multiple'=>'SM',
				
			'image_library'=>'IL',
			'no_save'=>'NS',
	);

	$Adicionales=array('width','style','derecha','listhtml','multicombo','rango','listclass','live','default','formato');

	if($SERVER['ARCHIVO']=='maquina.php'){
		echo "<div class='dredredre' id='dredre' ". ( (trim($_GET['open'])!='')?"style='display:none;'":"") ." >";
		echo "<strong>EDITOR TEXTUAL DE CAMPOS</strong>
				<a style='float:right;text-transform:uppercase;' href='custom/".$objeto_tabla[$_GET['me']]['archivo'].".php'>ir a ".$objeto_tabla[$_GET['me']]['nombre_plural']."</a><br>";
		echo '<style>.dredredre div textarea { height:300px;}</style>';
		echo $EDITOR_TEXTUAL_CAMPOS;
		if($_GET['save']=='campo'){
			echo "<script> window.addEvent('domready',function(){ $('jjjson').focus(); }); </script>";
		}
		echo "</div>";
	}

	echo "<div class='edicion_indices_sub' id='edicion_indices_sub'>";
	echo "<strong>CAMPOS<br></strong>";
	echo "<ul id='lili_campos'>";
	foreach($objeto_tabla[$_GET['me']]['campos'] as $indice=>$valor){
		if(1){

			$cannn=( in_array($valor['tipo'],array('id','fcr','fed','pos','vis','cal')) and $valor['listable']!='1' )?'sissis':'';

			echo "<li class='list $cannn' id='ablo_campo_".$valor['campo']."'
					". ( ($_GET['open']==$valor['campo'])?"style='width:99%;'":"" ). " >";
			if((!in_array($valor['tipo'],array('id','fcr','fed','pos','vis','cal'))) or ($valor['listable']=='1')){

				foreach($Quicks as $qq=>$ss){

					echo "<a id='cam_".$valor['campo']."_".$qq."' title='".$qq."' class='listder ". ( ($valor[$qq]=='1')?"selex":"" ) ."'
							href='#' onclick=\"javascript:modificar_campo_quick('".$valor['campo']."','$qq'); return false;\" rel='nofollow' >";
					echo $ss;
					echo "</a>";
						
				}

			}

			echo "<a href='#' onclick=\"tog('".$valor['campo']."');return false;\" >".substr($valor['campo'],0,13)."</a> ";
			echo "<span class='handle'>".$valor['tipo']."</span>";

			echo "<div class='linea ablo_campos' id='blo_campo_".$valor['campo']."' ". ( ($_GET['open']==$valor['campo'])?"":"style='display:none;'" ). " >";
			echo "<a class='equis' href='#' onclick=\"tog('".$valor['campo']."');return false;\" >x</a>";
			echo "<div class='linea2'>";

			foreach($Quicks as $ttpo=>$Qui){
				if(!isset($valor[$ttpo])){
					$valor[$ttpo]=0;
				};
			}
			foreach($Adicionales as $ttpo){
				if(!isset($valor[$ttpo])){
					$valor[$ttpo]='';
				};
			}

			foreach($valor as $indi=>$val){
				$indiL=str_replace(array('width','style'),array('lista-w','form-style'),$indi);
				echo "<div ". ((in_array($indi,array_keys($Quicks)) or ($indiL=='campo'))?'style="display:none;"':'') .">";
				echo "<label>".$indiL."</label>";
				if(is_array($val)){
					echo "<div style='float:left;clear:none;width:auto;'>";
					foreach($val as $va=>$av){
						echo "&nbsp;&nbsp;".$va."&nbsp;&nbsp;&rArr;&nbsp;&nbsp;<i>".$av."</i><br>";
					}
					echo "</div>";
				} else {
					echo (strlen($val)>70)?"<textarea style='height:90px;' id='val_".$valor['campo']."_".$indi."'>".$val."</textarea>": ( ( ($indi!='derecha') and (trim($val)=='1' or trim($val)=='0') )?trim($val)." <input id='val_".$valor['campo']."_".$indi."' type='hidden' value='".((trim($val)=='1')?"0":"1")."' />":"<input id='val_".$valor['campo']."_".$indi."' type='text' value='".$val."' onkeypress='if(event.keyCode==13){ modificar_campo(\"".$valor['campo']."\",\"".$indi."\"); }' />" );
				}

				if(!is_array($val)){
					if(!( ($indi!='derecha') and ( trim($val)=='1' or trim($val)=='0' ) )){
						echo "<a onclick=\"javascript:modificar_campo('".$valor['campo']."','".$indi."'); return false;\" ";
						echo (strlen($val)>70)?'':"style='display:none;'";
						echo ">Save</a>";
					} else {
						echo "<a onclick=\"javascript:modificar_campo('".$valor['campo']."','".$indi."'); return false;\" >". ((trim($val)=='1')?"0":"1") ."</a>";
					}
					if(!in_array($indi,array('campo','label','tipo'))){
						echo "&nbsp;<a onclick=\"javascript:eliminar_campo('".$valor['campo']."','".$indi."'); return false;\" >x</a>";
					}
				}
				echo "</div>";

			}
			echo "</div>";

			if(!in_array($valor['tipo'],array('id','fcr','fed','pos','vis','cal'))){

				echo "<div class='linea3'>";

				$campos_11=array();
				foreach($valor as $indice=>$valo){
					$campos_11[]=$indice;
				}
				$campos_22=$analisis_array['PROPIEDADES_CAMPO'];
				$campos_33=array_diff($campos_22,$campos_11);
				unset($campos_11);

				foreach(array_values($campos_33) as $campo){

					$campoL=str_replace(array('width','style'),array('lista-w','form-style'),$campo);

					$bbuu ="<div>";
					$bbuu.="<label for='val_".$valor['campo']."_".$campo."'>".$campoL."</label>";


					if(sizeof($analisis_array['VALORES_CAMPO'][$campo])<=20 and $campo!='controles'){
						$bbuu.="<select style='width:80px;' id='val_".$valor['campo']."_".$campo."' />";
						$sino=implode("",$analisis_array['VALORES_CAMPO'][$campo]);
						if($sino=='1' or $sino=='0'){
							$bbuu.="<option value='0'>0</option><option value='1'>1</option>";
						}
						else{
							foreach($analisis_array['VALORES_CAMPO'][$campo] as $opcio){
								$bbuu.="<option value='".$opcio."'>".$opcio."</option>";
							}
						}
						$bbuu.="</select>";

					} else {
						$bbuu.="<input id='val_".$valor['campo']."_".$campo."' type='text' value='' id='val_".$valor['campo']."_".$campo."' />";
					}

					$bbuu.="&nbsp;<a href='#' onclick=\"javascript:modificar_campo('".$valor['campo']."','".$campo."'); return false;\" rel='nofollow' >Save</a>";
					$bbuu.="</div>";
					if(in_array($campo,array('listable','validacion','unique','like','fulltext','control','derecha','radio','constante','combo','controles','enlace','extra','style','width'))){
						$bbbb1u[]=$bbuu;
					} elseif(in_array($campo,array('sesion_login','sesion_password'))){
						$bbbb3u[]=$bbuu;
					} elseif(in_array($campo,array('valor'))){
						$bbbb4u[]=$bbuu;
					} else {
						$bbbb2u[]=$bbuu;
					}
				}

				echo implode($bbbb1u)."<br><br>".implode($bbbb2u)."<br><br>".implode($bbbb3u);
				unset($bbbb1u);unset($bbbb2u);
				unset($bbbb4u);unset($bbbb3u);

				echo "<div><br>";
				echo "<a style='color:black; text-decoration:underline;' href='#' onclick=\"javascript:eliminar_columna('".$valor['campo']."'); return false;\" rel='nofollow' >eliminar campo</a>";
				echo "</div>";
				echo "</div>";


			}

			echo "<div style='clear:both;'></div>";

			echo "</div>";
			echo "</li>";

		}

	}
	echo "<div style='clear:both;'></div>";

	echo "</ul>";

	echo "</div>";
	?>
	<div style="clear: both;"></div>
</div>

<script>

var tor='';
function tog(iidd){

setqc('props',0);	

if($('quickcontrols'))$('quickcontrols').addClass('quickcontrolsHover');	

if($('blo_campo_'+iidd).getStyle('display')=='none'){
	/*
	$$('.list').each(function(element) {
		element.setStyles({'width':'1px'});
	});	
	*/
	$$('.ablo_campos').each(function(element) {
		element.setStyles({'display':'none'});
	});
	$$('#lili_campos .list').each(function(element) {
		element.setStyles({'background':'none'});
	});	
	
	<?php if($this_me==''){?>
	$('ablo_campo_'+iidd).setStyles({'width':'99%'});
	<?php }else{?>
	$('ablo_campo_'+iidd).setStyles({'background':'#FFFFCC'});
	<?php }?>
	$('blo_campo_'+iidd).setStyles({'display':'block'});
	
	if($('dredre'))	$('dredre').setStyles({'display':'none'});
	
}else{

	//$('ablo_campo_'+iidd).setStyles({'width':'121px'});
	$('blo_campo_'+iidd).setStyles({'display':'none'});
	
	if($('dredre'))	$('dredre').setStyles({'display':'block'});	
}

}
function borrar_objeto(me){
	
	datos = { 
				textobjeto  : "",
				me			: me
			};	
	new Request({url:"<?php echo ($SERVER['ARCHIVO']=='maquina.php')?"":"../";?>grabar_objeto.php", method:'post', data:datos, onSuccess: function(eee){

		location.href='?';
	
	} } ).send();
}

function eliminar_columna(campo){

	
	datos = { 
				me			: '<?php echo $_GET['me']?>',
				'indice'	: 'campos',
				'campo'		: campo,
				valor		: 'destroy'
			};		
	
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!='')
			alert(eee);
		else	
			location.href='?rann=<?php echo rand();?>&save=campos&me=<?php echo $_GET['me']?>#edicion_indices_sub';
	
	} } ).send();
}


function modificar_campo_quick(campo,indice){
datos = { 
me			: '<?php echo $_GET['me']?>',
'indice'	: 'campos',
'campo'		: campo,
variable	: indice,
valor		: $('val_'+campo+'_'+indice).value
};		
new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){

$('cam_'+campo+'_'+indice).removeClass('selex');	
if($('val_'+campo+'_'+indice).value==1){ $('cam_'+campo+'_'+indice).addClass('selex'); }
$('val_'+campo+'_'+indice).value=($('val_'+campo+'_'+indice).value==1)?'0':'1';

if(eee.trim()!=''){
	alert(eee);
}else{	
	racargar_partes();
//	location.href='?rann=<?php echo rand();?>&save=campos&me=<?php echo $_GET['me']?>#edicion_indices_sub';
}
} } ).send();
}

function racargar_partes(){
if($('abrir_crear').getStyle('display')=='none'){
load_crear();
precrear_loaded=0;
setTimeout("pre_crear()",500);	
}
ax("pagina","",1);	
}


function modificar_campo(campo,indice){
	datos = { 
		me			: '<?php echo $_GET['me']?>',
		'indice'	: 'campos',
		'campo'		: campo,
		variable	: indice,
		valor		: $('val_'+campo+'_'+indice).value
	};		
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!=''){
			alert(eee);
		} else {	
			racargar_partes();
			//location.href='?rann=<?php echo rand();?>&me=<?php echo $_GET['me']?>&open='+campo+'#ablo_campo_'+campo;
		}
	} } ).send();
}

function togglerqc(){
	if($('quickcontrols').hasClass('quickcontrolsHover')){
		$('quickcontrols').removeClass('quickcontrolsHover');
		$('quickcontrols').removeClass('props');	
		$$('.ablo_campos').each(function(element) {
			element.setStyles({'display':'none'});
		});		
	} else {
		$('quickcontrols').addClass('quickcontrolsHover');	
	}	
}



function eliminar_campo(campo,indice){
	datos = {
		me			: '<?php echo $_GET['me']?>',
		'indice'	: 'campos',
		'campo'		: campo,
		variable	: indice,
		valor		: 'destroy'
	};
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!='')
			alert(eee);
		else	
			location.href='?rann=<?php echo rand();?>&me=<?php echo $_GET['me']?>&open='+campo+'#ablo_campo_'+campo;
	
	} } ).send();
}
</script>
