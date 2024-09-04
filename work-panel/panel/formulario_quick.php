<?php
if($_GET['accion']=='custom_load'){

	include('base2/apps/'.$_GET['OT']);	

} else {


include("lib/compresionInicio.php");


include("objeto.php");


include("head.php");


echo '<body class="quick">';

echo $HTML_ALL_INICIO;

echo $HTML_MAIN_INICIO;




include($objeto_tabla[$this_me]['onload_include']);

// echo '9';

echo $objeto_tabla[$this_me]['onload_script'];

if($_GET['accion']=='custom'){

	include('base2/apps/'.$_GET['OT']);

} else {

//include("header.php");
//echo $HTML_CONTENT_INICIO;
?>
	<ul class="formulario">
		<h1 style="display: none;" class="titulo_formulario" id="titulo_editar">
			<a class="boton_right" onclick="javascript:ax('editar_completo_cancelar','');return false;">Cancelar Editar</a>
			<a class="boton_right" onclick="javascript:ax('guardar_completo',$v('id_guardar'));return false;">Guardar <?php echo ucfirst($datos_tabla['nombre_singular']);?></a>
			Editar
			<?php echo ucfirst($datos_tabla['nombre_singular']);?>
		</h1>
		<h1 class="titulo_formulario" id="titulo_crear">
			<a rel="nofollow" class="boton_right"
				onclick="javascript:ax('insertar',$v('id_guardar'));return false;">Crear
				<?php echo ucfirst($datos_tabla['nombre_singular']);?>
			</a>
			<?php echo ($Plabel)?$Plabel:'Crear '.ucfirst($datos_tabla['nombre_singular']); ?></h1>
		<?php

		include("formulario_campos.php");

		list($accion,$next)=explode(",",$_GET['accion']);

		?>
		<li class="linea_form linea_form_mensaje" style="color:#FF0000; <?php if($_GET['block']=='form'){ echo "display:none;"; } ?>" >
			<label>&nbsp;</label>
			<span id="error_creacion" style="visibility:;  padding: 5px 0; font-size: 12px;"><?php
			if($numShowValCamps>0 or 1){
	        ?><span style="color: #222222;">los campos con * son obligatorios</span><?php
			}
			?></span>
		</li>
		<li class="linea_form" id="linea_crear"><?php
		if($_GET['block']!='form'){
	            ?><label>&nbsp;</label><?php
	    }
	    ?><input type="hidden" id="mode" value="insert" />
	    <input type="button" id="in_submit" class="btn  btn-primary" value="<?php echo ($Pbuttom)?$Pbuttom:'Crear '.$datos_tabla['nombre_singular']?>" style="" onclick="ax('insertar','');" />
		</li>
		<li class="linea_form" id="linea_grabar" style="display: none;">
			<label>&nbsp;</label>
			<input type="hidden" id="id_guardar" />
			<input type="button" id="ed_save" class="btn  btn-primary"
			value="<?php echo ($Pbuttom)?$Pbuttom:'Guardar '.$datos_tabla['nombre_singular']?>"
			onclick="ax('guardar_completo',$v('id_guardar'),'<?php echo $next;?>')" />
			<input type="button" id="ed_cancelar" class="form_boton_1"
			value="Cancelar" onclick="ax('editar_completo_cancelar','')" />
		</li>
	</ul>
	<style>
	.bloque_content_crear {
		display: block;
	}
	</style>
	<?php
	$linkRecPagina='';
	include("vista_ax.php");
	//prin($_GET);
	echo '<script>';
	if($accion=='insert'){
	echo "pre_crear();/*$0('linea_crear');$1('linea_grabar');$0('ed_cancelar');*/";
	}elseif($accion=='update'){
	echo "pre_crear();";
	echo "window.addEvent('domready',function(){ ";
	echo "ax('ec3','".$_GET['L']."'); });";
	echo "$0('linea_crear');$1('linea_grabar');$0('ed_cancelar');";
	} else {
	echo "pre_crear();";
	}
	echo '</script>';


}

//echo $HTML_CONTENT_FIN;
echo $HTML_MAIN_FIN;
echo $HTML_ALL_FIN;
echo '</body>';
echo '</html>';
include("lib/compresionFinal.php");



}