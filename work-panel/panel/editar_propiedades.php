<?php //á
?>
<div class="cuadro_codigo bloque" id="blo_objetos"
	style="clear: left; position: relative; clear: none; float: left;">
	<?php

	$otmeObligatorios=array('descripcion','width_listado','grupo','seccion','alias_grupo','set_fila_fijo','order_by','group','crear_label','por_linea','titulo');

	$otmeObligatorios2=array();
	foreach($otmeObligatorios as $ttoo){
		$otmeObligatorios2[$ttoo]='';
	}

	echo "<div class='edicion_indices' style='float:left;height:auto;'>";
	if($SERVER['ARCHIVO']=='maquina.php'){
		echo "<strong>EDITAR</strong><br><br>";
	}
	$otmeprimeros=array();
	$otme=$objeto_tabla[$_GET['me']];
	foreach($objeto_tabla[$_GET['me']] as $ww=>$rr){
		if(strlen($rr)>40){
			unset($otme[$ww]); $otmeprimeros[$ww]=$rr;
		}
		if(in_array($ww,$otmeObligatorios)){
			unset($otmeObligatorios2[$ww]);
		}
	}
	$otme=array_merge($otmeprimeros,$otme,$otmeObligatorios2);
	unset($otmeObligatorios);
	unset($otmeObligatorios2);

	//prin($analisis_array['VALORES_OBJETO']);
	foreach($otme as $indice=>$valor){
		if(!in_array($indice,array_merge($indicesA,array('me','tabla','archivo','procesos','campos')))){
			$valor=str_replace($DIR_CUSTOM,"'.\$DIR_CUSTOM.'",$valor);
			echo "<div ". ((strlen($valor)>20)?"class='texto'":"") .">";
			$titulo8="title='".addslashes(implode(" \n- ",$analisis_array['VALORES_OBJETO'][$indice]))."'";
			echo "<label ".$titulo8." for='val_".$indice."'>"
			.str_replace(
					array('nombre_singular','nombre_plural','expandir_vertical'),
					array('singular','plural','expan ver'),$indice)
					."</label>";


			echo (strlen($valor)>50 or in_array($indice,array('descripcion')))?"<textarea id='val_".$indice."' >".$valor."</textarea>": ( ( 0 and (trim($valor)=='1' or trim($valor)=='0') )?trim($valor)." <input id='val_".$indice."' type='hidden' value='".((trim($valor)=='1')?"0":"1")."' id='val_".$indice."' />":"<input id='val_".$indice."' type='text' value='".$valor."' id='val_".$indice."'  onkeypress='if(event.keyCode==13){ modificar_dato(\"".$indice."\"); }' ". (in_array(trim($valor),array('0','1','2','3','4','5','6','7','8','9'))?"style='width:13px;'":'') ." />" );

			if(!( 0 and (trim($valor)=='1' or trim($valor)=='0') )){
				if(strlen($valor)>50){
					echo "<a href='#' onclick=\"javascript:modificar_dato('".$indice."'); return false;\" rel='nofollow' >Save</a>";
				}
			} else {
				echo "<a href='#' onclick=\"javascript:modificar_dato('".$indice."'); return false;\" rel='nofollow' >". ((trim($valor)=='1')?"0":"1") ."</a>";;
			}
			if(!in_array($indice,array('grupo','titulo','nombre_singular','nombre_plural','archivo','prefijo','tabla','menu','menu_label','me'))){
				echo "&nbsp;<a href='#' onclick=\"javascript:eliminar_dato('".$indice."'); return false;\" rel='nofollow' >x</a>";
			}
			echo "</div>";
		}
	}
	echo "</div>";

	$campos_1=array();
	foreach($objeto_tabla[$_GET['me']] as $indice=>$valor){
		if($indice!='campos'){
			$campos_1[]=$indice;
		}
	}
	$campos_2=$analisis_array['PROPIEDADES_OBJETO'];
	$campos_3=array_diff($campos_2,$campos_1);
	unset($campos_1);


	if($SERVER['ARCHIVO']=='maquina.php'){

		echo "<div class='edicion_indices dredredredre' style='float:right;width:43%;height:auto;'>";
		echo "<strong>EDITOR TEXTUAL DE CAMPOS</strong>
			<a style='float:right;text-transform:uppercase;' href='custom/".$objeto_tabla[$_GET['me']]['archivo'].".php'>ir a ".$objeto_tabla[$_GET['me']]['nombre_plural']."</a><br>";
		echo '<style>.dredredredre div textarea { height:300px;}</style>';
		echo $EDITOR_TEXTUAL_PROPIEDADES;
		if($_GET['save']=='propiedades'){
			echo "<script> window.addEvent('domready',function(){ $('jjjsonprop').focus(); }); </script>";
		}

		echo "<strong>AGREGAR</strong><br><br>";
		foreach(array_values($campos_3) as $propiedad){
			if($propiedad!=''){
				echo "<div>";
				echo "<label for='val_".$propiedad."'>".$propiedad."</label>";
				if(sizeof($analisis_array['VALORES_OBJETO'][$propiedad])<=10 and $propiedad!='controles'){
					echo "<select style='width:80px;' id='val_".$propiedad."' />";
					$sino=implode("",$analisis_array['VALORES_OBJETO'][$propiedad]);
					if($sino=='1' or $sino=='0'){
						echo "<option value='0'>0</option><option value='1'>1</option>";
					}
					else {
						foreach($analisis_array['VALORES_OBJETO'][$propiedad] as $opcio){
							echo "<option value='".$opcio."'>".$opcio."</option>";
						}
					}
					echo "</select>";
				} else {
					echo "<input style='width:80px;' id='val_".$propiedad."' type='text' value=''  />";
				}
				echo "&nbsp;<a href='#' onclick=\"javascript:modificar_dato('".$propiedad."'); return false;\" rel='nofollow' >Save</a>";
				echo "</div>";
			}
		}
		echo "</div>";

	}
	?>
	<div style="clear: both;"></div>
</div>
<script>
function modificar_dato(indice){

	
	datos = { 
				me			: '<?php echo $_GET['me']?>',
				indice		: indice,
				valor		: $v('val_'+indice)
			};		
	
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!=''){
			alert(eee);
		} else {	
			racargar_partes();
			//location.href='?rann=<?php echo rand();?>&me=<?php echo $_GET['me']?>&save=campos#blo_objetos';
		}
	} } ).send();
}
function grabar_objeto(){
	
	datos = { 
				textobjeto  : $v('textobjeto'),
				me			: '<?php echo $_GET['me']?>'
			};	
	new Request({url:"grabar_objeto.php", method:'post', data:datos, onSuccess: function(eee){

		location.href='?me=<?php echo $_GET['me']?>';
	
	} } ).send();
}


function set_dato(me,indice,valor){

	datos = { 
				me			: me,
				indice		: indice,
				valor		: valor
			};		
	
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!='')
			alert(eee);
		else {	
			/*location.href='?';*/
			}
	
	} } ).send();
}


function eliminar_dato(indice){

	
	datos = { 
				me			: '<?php echo $_GET['me']?>',
				indice		: indice,
				valor		: 'destroy'
			};		
	
	new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
		if(eee.trim()!='')
			alert(eee);
		else	
			location.href='?rann=<?php echo rand();?>&me=<?php echo $_GET['me']?>#blo_objetos';
	
	} } ).send();
}


</script>
