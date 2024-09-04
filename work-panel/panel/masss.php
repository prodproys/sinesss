<?php

include("objeto.php");

// prin($EXTRA_FILTRO);

$avai=explode("|",$datos_tabla['mass_actions']);
foreach($tbcampos as $tc=>$camp){
	if(!in_array($camp['campo'],$avai)){
		unset($tbcampos[$tc]);
	}
}

// prin($tbcampos);

?><ul class="formulario">

	<div class="sv" id="load" style="display: none; top: -30px; left: 0px;">cargando...</div>

	<h1 class="titulo_formulario" id="titulo_mass">
<!-- 		<a rel="nofollow" class="boton_right"
			onclick="javascript:ax('save_changes',$v('id_guardar'));return false;">Crear
			<?php echo ucfirst($datos_tabla['nombre_singular']);?>
		</a> -->
		Acciones
	</h1>
	<?php
    include("formulario_campos.php");
    ?>
	<?php

	//echo masss


	?>
	<li class="linea_form linea_form_mensaje" style="color:#FF0000; <?php if($_GET['block']=='form'){ echo "display:none;"; } ?>" ><?php
	?><label>&nbsp;</label>
	<?php
	?><span id="error_creacion"
		style="padding: 5px 0; font-size: 12px;"><?php
		if($numShowValCamps>0){
        ?><span style="color: #222222;">los campos con * son obligatorios</span>
		<?php
		}
		?></span>
	<?php
	?></li>
	<?php

	?>
	<li class="linea_form" id="linea_crear">

		<?php if($_GET['block']!='form'){ ?><label>&nbsp;</label><?php } ?>

		<input type="hidden" id="mode" value="mass" />

		<input type="button" id="in_submit" class="btn btn-primary" value="Guardar cambios" onclick="ax('guardar_cambios','');" />

	</li>
</ul>
<style>
.bloque_content_crear {
	display: block;
}
</style>
<?php
if(isset($_GET['ran']) and $_GET['ran']!=''){
	include("lib/compresionFinal.php");	/*para Content-Encoding*/
}
?>