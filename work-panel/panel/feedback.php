<?php

$Motivo=array('0'=>'Error','1'=>'Idea','2'=>'Otro');
	
if($_REQUEST['v_o']=='FEEDBACK'){
	error_reporting(0);
	@session_start(); // Iniciar variables de sesión

	$body="

			Nombre  : ".$array['nombre']."
					Proyecto: ".$array['proyecto']."
							Email   : ".$array['email']."
									Motivo  : ".$Motivo[$array['motivo']]."
											Comentario:
											".$array['comentario']."

													";

	$EMAILS_PROYECTO_A=explode(",","guillermolozan@gmail.com,".$array['email']);
	foreach($EMAILS_PROYECTO_A as $EMAIL_A){
		echo (SendMAIL($EMAIL_A,"Mensaje de Feedback Enviado ".$array['proyecto'],$body,"","guillermolozan@gmail.com","Panel"))?"":"";
	}

	exit();

}

?>

<style>
.formulario label {
	width: 100px;
}

.formulario .form_input {
	width: 400px;
}
</style>


<div class="bloque_titulo" style="clear: left;">


	<a name="titulo">Feedback</a>

</div>
<div class="mensaje_exito" id="bloque_crear_gracias"
	style="display: none;">Gracias por tu mensaje.</div>

<div class="bloque_pregunta" style="height: auto;"
	id="bloque_crear_FEEDBACK">


	<div class="mensaje_info">Desde aquí puedes decirnos qué te parece
		este panel o algo que no entiendas. También puedes reportar un error,
		o proponernos una mejora. Envíanos tu opinión.</div>

	<span id="inner_formulario">

		<div class="formulario" style="position: relative;">

			<div class="saving" id="feedback_load"
				style="display: none; top: -30px; left: 0px;">cargando...</div>


			<h1
				style="margin: 0pt 0pt 30px 20px; display: none; font-size: 25px; font-weight: bold;"
				id="titulo_editar_FEEDBACK">
				<a style="float: right; margin-right: 18px; font-size: 12px;"
					href="#" rel="nofollow"
					onclick="javascript:feedback_ajax('editar_completo_cancelar','');return false;">Cancelar
					Editar</a> Editar Comentario
			</h1>

			<input id="fee_in_proyecto"
				value="<?php echo $vars['REMOTE']['url_publica']; ?>"
				class="form_input" autocomplete="off" maxlength="80" type="hidden">

			<div class="linea_form">
				<label for="fee_in_nombre">Nombre *</label> <input
					id="fee_in_nombre" class="form_input" autocomplete="off"
					maxlength="80" type="text">
			</div>

			<div class="linea_form">
				<label for="fee_in_email">Email *</label> <input id="fee_in_email"
					class="form_input" autocomplete="off" maxlength="80" type="text">
			</div>

			<div class="linea_form">
				<label for="fee_in_motivo">Motivo </label> <select
					id="fee_in_motivo" class="form_input">
					<option selected="selected"></option>
					<option value="0">Error</option>
					<option value="1">Idea</option>
					<option value="2">Otro</option>
				</select>
			</div>

			<div class="linea_form">
				<label for="fee_in_comentario">Mensaje *</label>
				<textarea id="fee_in_comentario" class="form_input"
					autocomplete="off"></textarea>
			</div>


			<div class="linea_form" style="height: 12px; color: rgb(255, 0, 0);">
				<label>&nbsp;</label> <span id="error_creacion"
					style="visibility: hidden; float: left;">&nbsp;&nbsp;</span>
			</div>

			<div class="linea_form">
				<label>&nbsp;</label> <span id="linea_crear"> <input
					id="fee_in_submit" class="btn  btn-primary" value="Crear comentario"
					style="float: left;" onclick="feedback();" type="button">

				</span>

			</div>
			&nbsp;

		</div>

	</span>
</div>
<script>

function feedback(){
	
		$('fee_in_submit').value='creando...';
		$('fee_in_submit').disabled=true;
		
	var datos = {
	
		f				:'remoto_get',
		f_2				:'insert_get',
		debug			:'0',
		url_remoto		:'http://crazyosito.com/panel/ajax_sql.php',	
		
		post_proyecto		:  $v('fee_in_proyecto').replace("http://",""),
		post_motivo			:  $v('fee_in_motivo'),
		post_nombre			:  $v('fee_in_nombre'),
		post_email			:  $v('fee_in_email'),
		post_comentario		:  $v('fee_in_comentario'),
		post_fecha_creacion	:  "now()",
		post_visibilidad 	:  "1",
		v_o				:  'FEEDBACK',
		v_t				:  'feedback'
								
	};

	new Request({url:"ajax_sql.php", method:'get', data:datos, onSuccess:function(ee) { 

						var json=eval("(" + ee + ")");
						if(json.success=='1'){

							$1('bloque_crear_gracias');
							$0('bloque_crear_FEEDBACK');
																		
						} else if(json.success=='0'){
							
							show_error_texto(json.error);
							$('fee_in_submit').value='crear mensaje';
							$('fee_in_submit').disabled=false;						
							

							
						}
						
					  } } ).send();				


}
	
</script>
