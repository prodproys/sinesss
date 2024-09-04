<?php

include("objeto.php");
	
// prin($datos_tabla);

?>
<ul class="formulario <?php echo ($_GET['view'])?'view':''; ?>">

	<div class="sv" id="load" style="display: none; top: -30px; left: 0px;">cargando...</div>
	<?php

	if(strpos($_SERVER['SCRIPT_NAME'], "login.php")===false)
	{

		?>
		<h1 style="display: none;" class="titulo_formulario" id="titulo_editar">

			<a class="z i_form_cancel boton_right" onclick="javascript:ax('editar_completo_cancelar','');return false;"></a>

			Editar <?php /* echo ucfirst($datos_tabla['nombre_singular']); */ ?> 
		</h1>

		<h1 class="titulo_formulario" id="titulo_crear">

			<a class="z i_form_cancel boton_right" onclick="javascript:$('cerrar_crear').click();"></a>
			<!-- <a rel="nofollow" class="boton_right" onclick="javascript:ax('insertar',$v('id_guardar'));return false;">Crear
				<?php echo ucfirst($datos_tabla['nombre_singular']);?>
			</a> -->
			Crear <?php /* echo ucfirst($datos_tabla['nombre_singular']); */ ?> 
		</h1>
		<?php

    }

    include("formulario_campos.php");

	?>
	<li class="linea_form linea_form_mensaje" style="<?php if($_GET['block']=='form'){ echo "display:none;"; } ?>" >
		
		<label>&nbsp;</label>
		<span id="error_creacion">
		<?php if($numShowValCamps>0){ ?>
		<span>los campos con <b>*</b> son obligatorios</span>
		<?php } ?>
		</span>
		
	</li>

	<li class="linea_form linea_botones" id="linea_crear">

		<?php if($_GET['block']!='form'){ ?>
			<label>&nbsp;</label>
		<?php } ?>
	
		<input type="hidden" id="mode" value="insert" />
	
		<?php if($Proceso=='login'){ ?>
		
			<input type="button" id="in_submit" class="btn  btn-primary"
			value="Entrar" 
			onclick="ax('login','');" />
		
		<?php } else { ?>

			<input type="button" id="in_submit" class="btn  btn-primary"
			value="Crear <?php echo $datos_tabla['nombre_singular']?>"
			onclick="ax('insertar','');" />

		<?php } ?>

    </li>

	<li class="linea_form linea_botones" id="linea_grabar" style="display: none;">

		<label>&nbsp;</label>
		<input type="hidden" id="id_guardar" />

		<input type="button" id="ed_cancelar" class="btn "
			value="Cancelar" 
			onclick="ax('editar_completo_cancelar','')" />


		<input type="button" id="ed_save" class="btn  btn-primary"
			value="Guardar"
			onclick="ax('guardar_completo',$v('id_guardar'))" />

	</li>

</ul>
<style>
.bloque_content_crear {
	display: block;
}
</style>