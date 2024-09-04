<script>
var errores=[];
errores[1]="los campos con * son obligatorios";
errores[2]="no coinciden las contraseñas";
errores[3]="datos de login incorrectos";
errores[4]="formato de email incorrecto";
errores[5]="formato de dni incorrecto";
var Loren_ipsum='<?php echo $LOREN_IPSUM;?>';
var Recargar='ajax';
var mooedit;
var FORMULARIO_ABIERTO;<?php
$datos_tabla['expandir_vertical']='1'; ?>
//alert('<?php echo $tbl?>');
var tbl = "<?php echo $tbl?>";
var MMEE="<?php echo $datos_tabla['me'];?>";
var USU_IMG_DEFAULT="<?php echo $USU_IMG_DEFAULT;?>";
var json;
function ax(accion,id,pag,me='<?php echo $datos_tabla['me'];?>',where='inner',get_id='<?php echo $datos_tabla['get_id']?>',mode='',mw=''){
	/*
	if(document.getElementById('get_request')){
		let hammer =JSON.parse(document.getElementById('get_request').value);
		if(hammer.OB) MMEE=hammer.OB;
		// if(hammer.inner) where=hammer.inner;
		// if(hammer.get_id) get_id=hammer.get_id;
	}	
	*/
console.log(accion);
switch(accion){	
case "paginaUrl":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({
		url:"vista.php?OB="+me+"&pag="+pag+"&ran=1"+get_id+"&inner="+where+"&mode="+mode+"&mw="+mw, 
		method:'get', 
		onSuccess:function(ee) { 
			$(where).innerHTML=ee; 
			document.querySelector('#'+where).scrollIntoView({ behavior: 'smooth', block: 'start' });
			ax('actualizar_total',this.value); 
		} 
	}).send();
break;
case "pagina":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
		$('inner').innerHTML=ee; 
		ax('actualizar_total',this.value); 
		// $0('refresh'); 
		// $0('refresh-cover'); 
	} } ).send();
break;	
case "set_fila_2":
	$('i_'+id).removeClass('modificador_grilla');
	$('i_'+id).addClass('modificador');
break;
case "set_fila_4":
	$('i_'+id).removeClass('modificador');
	$('i_'+id).addClass('modificador_grilla'); 
break;
case "actualizar_total":
	<?php
	if($needs['img']){
	?>charge_multibox();<?php
	?>if($('nfilter'))if($('nfilter').value!='filter='){ 
		window.location.hash='#'+$('nfilter').value; 
		}<?php
	}
	if($needs['mootooltips']){
	?>charge_tooltips();<?php
	}
	?>alljsloads();
	// console.log(adal);
	// console.log(window.adal);
	// console.log(typeof loadmodals);
	if (typeof loadModals === "function") { 
		loadModals();
	}
	<?php
	?>
break;
case "recargar":
	ax($v('linkopagina'),$v('linkovals'),$v('pagina'));
break;
case "recargar_hash":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&"+$v('nfilter')+"&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
	// console.log(ee);
	$(where).innerHTML=ee; 
	if($('resaltar').value!=''){
	$($('resaltar').value).highlight('#FF0', '#FFF');
	var resal = $('resaltar').value;
	$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
	setTimeout("\$('"+resal+"').setStyles({'border':'0px'});",8000);
	$('resaltar').value='';
	}
	ax('actualizar_total',this.value);
	} } ).send();
break;
case "recargar_buscar":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	// $1('refresh');
	// $1('refresh-cover');
	new Request({url:"vista.php?OB="+MMEE+"&buscar=<?php echo addslashes($_GET['buscar']);?>&pag="+$v('pagina')+"&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
	$('inner').innerHTML=ee;
	if($('resaltar').value!=''){
	$($('resaltar').value).highlight('#FF0', '#FFF');
	var resal = $('resaltar').value;
	$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
	setTimeout("\$('"+resal+"').setStyles({'border-top':'1px dashed #999','border-bottom':'1px dashed #fff','border-left':'1px solid #fff','border-right':'1px solid #fff'});",8000);
	$('resaltar').value='';
	}
	ax('actualizar_total',this.value);
	// $0('refresh');
	// $0('refresh-cover');
	} } ).send();
break;
case "recargar_file":
	//alert(9);
	$1('refresh');
	$1('refresh-cover');
	new Request({url:"vista.php?OB="+MMEE+"&i=<?php echo $_GET['i'];?>&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
	$('inner').innerHTML=ee;
	if($('resaltar').value!=''){
	$($('resaltar').value).highlight('#FF0', '#FFF');
	var resal = $('resaltar').value;
	$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
	setTimeout("\$('"+resal+"').setStyles({'border-top':'1px dashed #999','border-bottom':'1px dashed #fff','border-left':'1px solid #fff','border-right':'1px solid #fff'});",8000);
	$('resaltar').value='';
	}
	ax('actualizar_total',this.value);
	$0('refresh');
	$0('refresh-cover');
	} } ).send();
break;
case "recargar_filter":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&filter=<?php echo $_GET['filter'];?>&pag="+$v('pagina')+"&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
	$('inner').innerHTML=ee;
	if($('resaltar').value!=''){
	$($('resaltar').value).highlight('#FF0', '#FFF');
	var resal = $('resaltar').value;
	$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
	setTimeout("\$('"+resal+"').setStyles({'border-top':'1px dashed #999','border-bottom':'1px dashed #fff','border-left':'1px solid #fff','border-right':'1px solid #fff'});",8000);
	$('resaltar').value='';
	}
	ax('actualizar_total',this.value);
	
	} } ).send();
break;
case "recargar_filtro":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&filtro=<?php echo $_GET['filtro'];?>&pag="+$v('pagina')+"&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
	$('inner').innerHTML=ee;
	if($('resaltar').value!=''){
	$($('resaltar').value).highlight('#FF0', '#FFF');
	var resal = $('resaltar').value;
	$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
	setTimeout("\$('"+resal+"').setStyles({'border-top':'1px dashed #999','border-bottom':'1px dashed #fff','border-left':'1px solid #fff','border-right':'1px solid #fff'});",8000);
	$('resaltar').value='';
	}
	ax('actualizar_total',this.value);
	} } ).send();
break;
// case "excel2":
// 	var url="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where+(($('ffilter')?'&filter='+$('ffilter').value:''));
// 	// var url="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1<?php echo $datos_tabla['get_id']?>&conf2=<?php echo urlencode($_GET['conf'])?>"+(($('ffilter')?'&filter='+$('ffilter').value:''));
// 	alert(url);
// 	new Request({url:url,method:'get', onSuccess:function(ee) { alert(ee); } }).send();
// break;
case "excel0":
	var getUrl="vista.php?OB="+MMEE+"&format=excel&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where+(($('ffilter')?'&filter='+$('ffilter').value:''));
	console.log('empieza la descarga');
	fetch(getUrl)
        .then(response => response.blob())
        .then(blob => {
			console.log('termina la descarga');
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            // a.download = "filename.xlsx";
            document.body.appendChild(a); // we need to append the element to the dom -> otherwise it will not work in firefox
            a.click();    
            a.remove();  //afterwards we remove the element again         
        });
break;
case "excel":
	var url="vista.php?OB="+me+"&format=excel&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where+(($('ffilter')?'&filter='+$('ffilter').value:''));
	location.href=url;
break;
case "gm":
// urll="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1<?php echo $datos_tabla['get_id']?>&conf2=<?php echo urlencode($_GET['conf'])?>"+(($('ffilter')?'&filter='+$('ffilter').value:''));
// console.log(urll);
// location.href=urll;
break;
case "pagina_buscar":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&buscar="+id+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
		$('inner').innerHTML=ee; 
		ax('actualizar_total',this.value); 
	} } ).send();
break;
case "pagina_file":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&i="+id+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
		$('inner').innerHTML=ee; 
		ax('actualizar_total',this.value); 
	} } ).send();
break;
case "pagina_filter":	
	// console.log('id:'+id);return;
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	var url="vista.php?OB="+me+"&filter="+id+"&pag="+pag+"&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where;
	new Request({
		url:url,
		method:'get', 
		onSuccess:function(ee) { 
		$(where).innerHTML=ee; 
		document.querySelector('#'+where).scrollIntoView({ behavior: 'smooth', block: 'start' });
		ax('actualizar_total',this.value); 
	} } ).send();
break;
case "pagina_filtro":
	$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
	new Request({url:"vista.php?OB="+MMEE+"&filtro="+id+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
		$('inner').innerHTML=ee; 
		document.querySelector('#'+where).scrollIntoView({ behavior: 'smooth', block: 'start' });
		ax('actualizar_total',this.value); 
	} } ).send();
break;
case "buscar":
	if( (id.trim()=='')||(id.trim()==pag) ){ return; }
	$('buscar_span').innerHTML='<div class="refreshing" style="position:relative;text-align:left; padding-left:5px;float:left;width:auto;">buscando....</div>';
	new Request({url:"vista.php?OB="+MMEE+"&buscar="+id+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) {
	$('inner').innerHTML=ee;
	ax('actualizar_total',this.value);
	$('buscar_span').innerHTML='<a href="" onclick=\'$("buscar_span").innerHTML="";ax("pagina","",1);return false;\' >volver</a>';
	} } ).send();
break;
case "validar_crear":<?php
	?>var ret=true;<?php
	foreach($tbcampos as $tbcampA){
		
		if($tbcampA['subvalidacion']=='email'){
			?>if(!validateEmail($v('in_<?php echo $tbcampA['campo']?>').trim())){ show_error(4,'<?php echo $tbcampA['label']?>'); ret=false; }; <?php
		}	
		if($tbcampA['subvalidacion']=='dni'){
			?>if(!validateDni($v('in_<?php echo $tbcampA['campo']?>').trim())){ show_error(5,'<?php echo $tbcampA['label']?>'); ret=false; }; <?php
		}

		if(in_array($tbcampA['subtipo'],['dni','email'])){
			?>if(validateEmail($v('upload_in_<?php echo $tbcampA['campo']?>').trim())){  }; <?php
		}
		if($tbcampA['validacion']=='1' or $tbcampA['validacion_crear']=='1'){
		if($tbcampA['constante']=='1'){ continue; }
		if($tbcampA['tipo']=='img'){
			?> if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} elseif($tbcampA['tipo']=='sto'){
			?>if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} elseif($tbcampA['tipo']=='pas'){
			?>	if($v('in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; }
			if($v('in_<?php echo $tbcampA['campo']?>').trim()!=$v('in_<?php echo $tbcampA['campo']?>_2').trim()){ show_error(2,''); ret=false; } <?php
		} elseif($tbcampA['tipo']=='html'){ 
			// ?>console.log( CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() );<?php
			?>if( CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() =='' || CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() =='<p></p>' ){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} elseif($tbcampA['tipo']=='fch'){ 
	// ?> var validacion_fecha=true;
			var valor_fecha=$v('in_<?php echo $tbcampA['campo']?>');
			var ffeec2=eval( valor_fecha.substring(0,4)*10000 + valor_fecha.substring(5,7)*100 + valor_fecha.substring(8,10)*1 );
			var d = new Date();
			var nn=eval(d.getFullYear()*10000 + d.getMonth()*100 + 100 + d.getDate()*1);
				// console.log(ffeec2);
				// console.log(nn);
			// if( ffeec2>20180000)
			if( ffeec2*1 < nn*1 ){
				// console.log('fecha no valida');
				validacion_fecha=false;
	// 			// validacion_text='fecha no válida';					
			}
			if(!validacion_fecha){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; }
		<?php
			/* ?>if($v('in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php */
		} else {
			?>if($v('in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		}
	}
	}
	?>  return ret;
break;
case "validar":<?php
	?>var ret=true;<?php
	foreach($tbcampos as $tbcampA){
		// echo "console.log('{$tbcampA['campo']}');";
		if($tbcampA['subvalidacion']=='email'){
			?>if(!validateEmail($v('in_<?php echo $tbcampA['campo']?>').trim())){ show_error(4,'<?php echo $tbcampA['label']?>'); ret=false; }; <?php
		}	
		if($tbcampA['subvalidacion']=='dni'){
			?>if(!validateDni($v('in_<?php echo $tbcampA['campo']?>').trim())){ show_error(5,'<?php echo $tbcampA['label']?>'); ret=false; }; <?php
		}

		if(in_array($tbcampA['subtipo'],['dni','email'])){
			?>if(validateEmail($v('upload_in_<?php echo $tbcampA['campo']?>').trim())){  }; <?php
		}
		if($tbcampA['validacion']=='1'){
		if($tbcampA['constante']=='1'){ continue; }
		if($tbcampA['tipo']=='img'){
			?> if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} elseif($tbcampA['tipo']=='sto'){
			?>if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} elseif($tbcampA['tipo']=='pas'){
			?>	if($v('in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; }
			if($v('in_<?php echo $tbcampA['campo']?>').trim()!=$v('in_<?php echo $tbcampA['campo']?>_2').trim()){ show_error(2,''); ret=false; } <?php
		} elseif($tbcampA['tipo']=='html'){ 
			// ?>console.log( CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() );<?php
			?>if( CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() =='' || CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData() =='<p></p>' ){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		} else {
			?>if($v('in_<?php echo $tbcampA['campo']?>').trim()==''){ show_error(1,'<?php echo $tbcampA['label']?>'); ret=false; } <?php
		}
	}
	}
	?>  return ret;
break;
case "resetear":
	<?php
		foreach($tbcampos as $tbcampA){

		if($tbcampA['tipo']=='com'){
			if(sizeof($tbcampA['opciones'])=='2' and
			strtolower($tbcampA['opciones']['0'])=='no' and
			str_replace("í","i",strtolower($tbcampA['opciones']['1']))=='si'){
					$tbcampA['tipo']='bit';
			}
		}
		if($tbcampA['indicador']=='1'){	continue; }
		if($tbcampA['constante']=='1'){	continue; ?> $('in_<?php echo $tbcampA['campo']?>').disabled=false; <?php }
		if($tbcampA['noedit']=='1'){ 
			if($tbcampA['directlink']!=''){
			?>$('in_<?php echo $tbcampA['campo']?>_dl').removeProperty('disabled');
			$0('span_<?php echo $tbcampA['campo']?>_dl'); <?php
			} else {
			?>$('in_<?php echo $tbcampA['campo']?>').removeProperty('disabled'); <?php
			}
		}
		switch($tbcampA['tipo']){
		case "img":
			?>reset_img_foto('<?php echo $tb?>','<?php echo $tbcampA['campo']?>');<?php
		break;
		case "sto":
			?>reset_img_sto('<?php echo $tb?>','<?php echo $tbcampA['campo']?>');<?php
		break;
		case "fch":
			?>$('in_<?php echo $tbcampA['campo']?>').value='';<?php
		break;
		case "pas":
			?>$('in_<?php echo $tbcampA['campo']?>').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor'])?>';<?php
			?>$('in_<?php echo $tbcampA['campo']?>_2').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor'])?>';
			<?php
		break;
		case "hid":
		if($tbcampA['opciones']!=''){
			if($tbcampA['multi']=='1'){
			
			}
		/*?>$('in_<?php echo $tbcampA['campo']?>').value='';<?php*/
		}
		break;
		case "html":
		?>$('in_<?php echo $tbcampA['campo']?>').value='';<?php		 		
		/* ?>mooeditable_<?php echo $tbcampA['campo']?>.setContent('');<?php */
		break;
		case "com":
		if($tbcampA['radio']=='1' and is_array($tbcampA['opciones']) ){
		foreach($tbcampA['opciones'] as $ooppcc=>$opcopc){
		?>$('in_<?php echo $tbcampA['campo']?>_<?php echo $ooppcc;?>').checked=false;<?php }
		?>$('in_<?php echo $tbcampA['campo']?>').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor'])?>';<?php
		} else {
		?>$('in_<?php echo $tbcampA['campo']?>').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor'])?>';<?php
		}
		break;
		case "bit":
		?>$('in_<?php echo $tbcampA['campo']?>').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor']);?>';<?php
		?>$('in_<?php echo $tbcampA['campo']?>_check').checked=($('in_<?php echo $tbcampA['campo']?>').value)?true:false;<?php
		break;
		default:
		?>$('in_<?php echo $tbcampA['campo']?>').value='<?php echo ($tbcampA['valor']=='')?'':procesar_dato($tbcampA['valor'])?>';<?php
		break;
		}
		}

		foreach($HHijos as $HHijoYY){
		list($HHijo,$TipoHijo)=explode("|",$HHijoYY);
		?>render_son('<?php echo $HHijo;?>',999999000+$random(1,999),true,'<?php echo $TipoHijo;?>');<?php
		}

		?>$('in_submit').value='Crear <?php echo $datos_tabla['nombre_singular']?>';<?php
		?>$('in_submit').disabled=false;<?php
		?>$('ed_save').value='Guardar <?php echo $datos_tabla['nombre_singular']?>';<?php
		/*?>$('bloque_crear').setStyles({'display':''});<?php */
		?>$('ed_save').disabled=false;<?php
		?>if($('area_hijos')) $1('area_hijos');
	<?php if($_GET['OT']==''){ ?>if($('mode').value!='update'){
	precrear_loaded=0;
	load_crear();
	}<?php } ?>
break;
case "insertar":
	Recargar='ajax';
	ax("insertar_interno");
break;
case "insertar_interno":
hide_error();
if(ax("validar_crear")==true){
if($('bloque_content_crear'))$('bloque_content_crear').setStyles({'opacity':'0.4'});
$('in_submit').value='creando...';
$('in_submit').disabled=true;
var datos = {<?php
foreach($tbcampos as $tbcampA){
	if($tbcampA['constante']!='1'){
		if($tbcampA['tipo']=='sto'){
			?>stoupload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
		} elseif($tbcampA['tipo']=='img'){
			?>upload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
		} elseif($tbcampA['tipo']=='html'){
			echo $tbcampA['campo']?>			:  CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData(),<?php
			/* echo $tbcampA['campo']?>			:  mooeditable_<?php echo $tbcampA['campo']?>.getContent(),<?php */
		} else {
			echo $tbcampA['campo']?>			:  $v('in_<?php echo $tbcampA['campo']?>'),<?php
		}
	}
}
echo $datos_tabla['fcr']?>:  "now()",<?php
if($datos_tabla['vis']!=''){ echo $datos_tabla['vis']?> : "1", <?php }
foreach($HHijos as $HHijo){
	list($HHijo,$TipoHijo)=explode("|",$HHijo);
	?>tempar_<?php echo $HHijo;?>			:  $v('tempar_<?php echo $HHijo;?>'),<?php
}
?>v_o:MMEE
};
new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=insert&debug=0<?php if($_GET['parent']){ echo '&parent='.$_GET['parent']; } ?>
", method:'post', data:datos, onSuccess:function(ee) {
var json=eval("(" + ee + ")");
if(json.success=='1'){
if(Recargar=='ajax'){
ax("resetear");
//alert(0);
<?php if($_GET['parent']){ //echo "alert('".$_GET['accion']."');";
if($_GET['accion']==''){
$oyu=$objeto_tabla[$_GET['parent']];
foreach($oyu['campos'] as $campos){	if(enhay($campos['opciones'],"|".$objeto_tabla[$this_me]['tabla'])){ $campux=$campos['campo']; }	}
?>
parent.document.getElementById('in_<?php echo $campux?>').value = json.id;
parent.document.getElementById('in_<?php echo $campux?>_dl').value = json.nombre;
parent.document.getElementById('in_<?php echo $campux?>_dl').addClass('ma-selected');
parent.initMultiBox.close();
<?php } else { ?>
parent.initMultiBox.close();
parent.ax("recargar");
//alert("<?php echo $linkRecPagina;?>");
<?php
}
} else { ?>
ax("<?php echo $linkRecPagina;?>");
if($('bloque_content_crear'))$('bloque_content_crear').setStyles({'opacity':'1'});
// alert('debe cerrar');
abrir_crear('0','0');
<?php } ?>
} else if(Recargar=='sin_ajax'){
location.reload();
}
} else if(json.success=='0'){
show_error_texto(json.error);
$('in_submit').value='crear <?php echo $datos_tabla['nombre_singular']?>';
$('in_submit').disabled=false;
$('bloque_content_crear').setStyles({'opacity':'1'});
}
} } ).send();
}
break;
<?php if($Proceso=='login'){?>
	case "login":
		hide_error();
		if(ax("validar")==true){
			$('error_creacion').innerHTML ='';
			$('in_submit').value='Entrando...';
			$('in_submit').disabled=true;
			var datos = {<?php
			foreach($tbcampos as $tbcampA){
				echo $tbcampA['campo']?>: $v('in_<?php echo $tbcampA['campo']?>'),<?php
			}
			?>v_o:MMEE<?php
			?>};
			new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=login&debug=0", method:'post', data:datos, onSuccess:function(ee) {
				if(ee!=''){ 
					location.href='index.php'; 
				} else {
					show_error(3,'Error');
					$('in_submit').disabled=false;
					$('in_submit').value='Entrar';
				} 
			} } ).send();
		}
	break;
<?php } ?>
case "x":
	if(confirm('¿Está seguro que desea eliminar este registro?')){
	Element('div', {
	'class' : 'sv',
	'html' : 'eliminando...',
	'id':'sv_'+id
	}).inject($('i_'+id));
	var datos = {
	v_o : MMEE,
	v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "
	};
	new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=delete&debug=0", method:'post', data:datos, onSuccess:function(ee) {
	$('i_'+id).destroy();
	$('span_num').innerHTML=$('span_num').innerHTML -  1;
	// $('span_num2').innerHTML=$('span_num2').innerHTML -  1;
	} } ).send();
	}
break;
case "star":
	var datos = {
	'<?php echo $datos_tabla['cal']?>':$('as_'+id).rel,
	v_o : MMEE,
	v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "
	};
	new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&debug=0", method:'post', data:datos, onSuccess:function(ee) {
	var rele = parseFloat($('as_'+id).rel);
	$('as_'+id).rel=(rele>=10)?0:rele+1;
	<?php for($io=0;$io<=10;$io++){ ?>
	$('as_'+id).removeClass('ico_star_<?php echo $io;?>');
	<?php } ?>
	$('as_'+id).addClass('ico_star_'+rele);
	} } ).send();
break;
case "v":
	var datos = {
	'<?php echo $datos_tabla['vis']?>':'1',
	v_o : MMEE,
	v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "
	};
	new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&debug=0", method:'post', data:datos, onSuccess:function(ee) {
	//$('i_'+id).removeClass('oc');
	$('ldd_'+id).removeClass('oc');
	$('lc_'+id).removeClass('oc');
	} } ).send();
break;
case "o":
	var datos = {
	'<?php echo $datos_tabla['vis']?>':'0',
	v_o : MMEE,
	v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "
	};
	new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&debug=0", method:'post', data:datos, onSuccess:function(ee) {
	//$('i_'+id).addClass('oc');
	$('ldd_'+id).addClass('oc');
	$('lc_'+id).addClass('oc');
	} } ).send();
break;
case "editar_completo_cancelar":
	$1('barra_paginacion');
	// if($('linea_buscador'))	$1('linea_buscador');
	$('error_creacion').innerHTML='<span>los campos con * son obligatorios</span>';
	$0('titulo_editar');
	$1('titulo_crear');
	if($('abri_cerrar_crear'))	$1('abri_cerrar_crear');
	$1('linea_crear');
	$0('linea_grabar');
	abrir_crear(0);
	$1('inner');
	$('id_guardar').value='';
	ax("resetear",'');
	$('mode').value='insert';
break;
case "vc":
	if($('abri_cerrar_crear')) $0('abri_cerrar_crear');
	Element('div', {
	'class' : 'sv',
	'html' : 'cargando...',
	'id':'sv_'+id
	}).inject($('i_'+id));
	if($('titulo_crear')){
	if($('bloque_content_crear'))$('bloque_content_crear').setStyles({'display':''});
	ax("ec2",id);
	} else {
	new Request({'url':'formulario.php?view=1&OB='+MMEE+'&ran=1<?php echo ($datos_tabla['get_id'])?'&'.$datos_tabla['get_id']:'';?>&proceso=<?php echo $Proceso;?>',  method:'get', onSuccess:function(ee) {
	if($('bloque_content_crear'))$('bloque_content_crear').innerHTML=ee;
	pre_crear('ax("ec2","'+id+'","'+pag+'");');
	//ax("ec2",id,pag);
	//setTimeout(,3500);
	} } ).send();
	}
break;
case "ec":
	if($('abri_cerrar_crear')) $0('abri_cerrar_crear');
	Element('div', {
	'class' : 'sv',
	'html' : 'cargando...',
	'id':'sv_'+id
	}).inject($('i_'+id));
	if($('titulo_crear')){
	if($('bloque_content_crear'))$('bloque_content_crear').setStyles({'display':''});
	ax("ec2",id);
	} else {
	// console.log('por aqui');
	new Request({'url':'formulario.php?OB='+MMEE+'&ran=1<?php echo ($datos_tabla['get_id'])?'&'.$datos_tabla['get_id']:'';?>&proceso=<?php echo $Proceso;?>',  method:'get', onSuccess:function(ee) {
	if($('bloque_content_crear'))$('bloque_content_crear').innerHTML=ee;
	pre_crear('ax("ec2","'+id+'","'+pag+'");');
	//ax("ec2",id,pag);
	//setTimeout(,3500);
	} } ).send();
	}
break;
case "ec2":
	window.scrollTo(0,80);
	if(pag=='nuevo'){
	$0('titulo_editar');
	$1('titulo_crear');
	$1('linea_crear');
	$0('linea_grabar');
	$1('inner');
	$('id_guardar').value='';
	ax("resetear",'');
	$('mode').value='insert';
	if($('area_hijos')) $0('area_hijos');
	} else {
	$1('titulo_editar');
	$0('titulo_crear');
	$0('linea_crear');
	$1('linea_grabar');
	$0('inner');
	$('id_guardar').value=id;
	$('mode').value='update';
	$1('load');
	if($('area_hijos')) $1('area_hijos');
	}
	ax("ec3",id,pag);
	$0('barra_paginacion');
	if($('linea_buscador')) $0('linea_buscador');
	if(pag!='nuevo'){<?php

		if($datos_tabla['creacion_hijo']){
		$Hijos=explode(",",$datos_tabla['creacion_hijo']);
		foreach($Hijos as $HijoD){
		list($Hijo,$TipoHijo)=explode("|",$HijoD);
		foreach($objeto_tabla as $obbb){
			if($obbb['archivo']==$Hijo){
				$Pplural=$obbb['nombre_plural'];
				foreach($obbb['campos'] as $canp){
					if($canp['foreig']=='1'){
						$HijoCampo=$canp['campo'];
					}
				}
			}
		}
		$HHijos[]=$HijoD;
		}
		}
	?>}
	new Element('div',{'class':'refreshing','id':'cargando_dato_ec','html':'Cargando datos'}).inject($('bloque_content_crear'),'top');
	charge_multibox();
break;
case "ec3":
	var datos = {
		v_o 	: MMEE,
		v_d 	: "where <?php echo $datos_tabla['id']?>='"+id+"' ",
		id		: id,
		f		: 'get_fila',
		debug	: '0'
	};
	new Request({url:"ajax_sql.php", method:'get', data:datos, onSuccess:function(ee) {
		var json=eval("(" + ee + ")");
		<?php

		if($_GET['load']){
		$LoAd=($_GET['accion']=='update')?$_GET['load']:$_GET['load'];
		if(($_GET['accion']=='update')){ ?>var load=eval('(<?php echo $LoAd;?>)'); <?php
		} else { 
		echo 'var load=eval("(' .str_replace("\"","'",$LoAd). ')");';
		}
		?>Object.each(load, function(value, key){ eval("json."+key+"='"+value+"'"); });<?php
		}

		$tbcampos2=($objeto_tabla[$datos_tabla['me']]['campos'][$datos_tabla['id']]['listable']=='1')?array_merge(array($objeto_tabla[$datos_tabla['me']]['campos'][$datos_tabla['id']]),$tbcampos):$tbcampos;

		foreach($tbcampos2 as $tbcampA){ if($tbcampA['indicador']=='1') continue;

			if($tbcampA['constante']=='1'){
				?>$('in_<?php echo $tbcampA['campo']?>_span').innerHTML=json.<?php echo $tbcampA['campo']?>;
				<?php
			}else{

			if($tbcampA['tipo']=='com'){
				if(sizeof($tbcampA['opciones'])=='2' and
				strtolower($tbcampA['opciones']['0'])=='no' and
				str_replace("í","i",strtolower($tbcampA['opciones']['1']))=='si'){
						$tbcampA['tipo']='bit';
				}
			}
			if($tbcampA['tipo']=='id'){
				?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;
				<?php
			} elseif($tbcampA['tipo']=='img'){
				?>$("upl_<?php echo $tb?>_<?php echo $tbcampA['campo']?>_0").innerHTML=render_upload('<?php echo $tb?>','<?php echo $tbcampA['campo']?>','',json.<?php echo $tbcampA['campo']?>_get_archivo);setTimeout("charge_multibox('.mbb')",1000);
				<?php
			} elseif($tbcampA['tipo']=='sto'){
				?>$("upl_<?php echo $tb?>_<?php echo $tbcampA['campo']?>_0").innerHTML=render_upload_sto('<?php echo $tb?>','<?php echo $tbcampA['campo']?>','',json.<?php echo $tbcampA['campo']?>_get_archivo);
				<?php
			} elseif($tbcampA['tipo']=='fch'){
				?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;
				<?php
				// calendar
				?>update_calendar('in_<?php echo $tbcampA['campo']?>');
				<?php
			} elseif($tbcampA['tipo']=='hid'){
				/*?>if($('<?php echo $tbcampA['campo']?>_load_combo')){<?php
				?>$('<?php echo $tbcampA['campo']?>_load_combo').setProperty('title',json.<?php echo $tbcampA['campo']?>);<?php
				?>}<?php */
				list($tbcampA['campo'],$html)=explode("|",$tbcampA['campo']);
				?>
				$('in_<?php echo $tbcampA['campo']?>').rel=json.<?php echo $tbcampA['campo']?>;
				var dhay=0; 
				$$('#in_<?php echo $tbcampA['campo']?> option').each(function(ele){if($(ele).value==json.<?php echo $tbcampA['campo']?>){ dhay=1; } });
				if(dhay==0){
					<?php
					list($ouno,$odos,$otre)=explode("|",$tbcampA['opciones']);
					list($ouno1,$ouno2)=explode(",",$ouno);
					?>
					if(json.<?php echo $tbcampA['campo']?>!=null){ 
						new Request({
							url:'load_combo.php?s='+encodeURIComponent('<?php echo $ouno1.",concat(".str_replace(";",",",$ouno2).")"."|".$odos."|where id=";?>'+json.<?php echo $tbcampA['campo']?>)+'&s2=&camp=<?php echo $tbcampA['campo']?>',  
							method:'get', 
							onSuccess:function(ee) {
								var json0=JSON.decode(ee,true); 
								if(json0.length>0){
									new Element('option',{'value':json.<?php echo $tbcampA['campo']?>,'html':json0[0][1],'selected':'selected'}).inject($('in_<?php echo $tbcampA['campo']?>'), 'bottom'); 
								}
							} 
						}).send();
					}
				}<?php
				?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;
				<?php
				if($tbcampA['obj']){
				?>$('in_<?php echo $tbcampA['campo']?>_obj').innerHTML=render_obj(json.<?php echo $tbcampA['campo']?>);
				<?php
				}
				if($tbcampA['directlink']){
				?>$('in_<?php echo $tbcampA['campo']?>_dl').value=json.<?php echo $tbcampA['campo']?>_dl;
				<?php
				}
				if($tbcampA['multi']=='1'){
					?>render_multi('<?php echo $tbcampA['campo']?>',json.<?php echo $tbcampA['campo']?>);
					<?php
				}				
			} elseif($tbcampA['tipo']=='pas'){
				?>$('in_<?php echo $tbcampA['campo']?>_2').value=json.<?php echo $tbcampA['campo']?>;
				<?php
				?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;
				<?php
			} elseif($tbcampA['tipo']=='bit'){
			?>$('in_<?php echo $tbcampA['campo']?>_check').checked=(json.<?php echo $tbcampA['campo']?>=='1')?true:false;<?php
			?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;<?php
			} elseif($tbcampA['tipo']=='html'){
				/* ?>if(json.<?php echo $tbcampA['campo']?>)$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;<?php */
				?>setTimeout(function(){ CKEDITOR.instances.in_<?php echo $tbcampA['campo']?>.setData(json.<?php echo $tbcampA['campo']?>); },1000);<?php
				/*?>alert("tamano "+json.<?php echo $tbcampA['campo']?>.length);CKEDITOR.instances.in_<?php echo $tbcampA['campo']?>.insertHtml(json.<?php echo $tbcampA['campo']?>);<?php */

				/* ?>if(json.<?php echo $tbcampA['campo']?>)mooeditable_<?php echo $tbcampA['campo']?>.setContent(json.<?php echo $tbcampA['campo']?>);<?php */
			} elseif($tbcampA['tipo']=='com'){

			if($tbcampA['radio']=='1' and is_array($tbcampA['opciones'])){
			foreach($tbcampA['opciones'] as $ooppcc=>$opcopc_a){
			list($opcopc,$color)=explode("|",$opcopc_a);
			?>$('in_<?php echo $tbcampA['campo']?>_<?php echo $ooppcc;?>').checked=false;<?php
			}
			?>if($('in_<?php echo $tbcampA['campo']?>_'+json.<?php echo $tbcampA['campo']?>)){<?php
			?>$('in_<?php echo $tbcampA['campo']?>_'+json.<?php echo $tbcampA['campo']?>).checked=true;<?php
			?>}<?php
			?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;<?php
			} else {
			?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;<?php
			}
			if(sizeof($tbcampA['eventos'])>0){ ?>var even_<?php echo $tbcampA['campo']?>=new Array();<?php foreach($tbcampA['eventos'] as $eve=>$even){
			?>even_<?php echo $tbcampA['campo']?>['<?php echo $eve?>']='<?php echo str_replace("\n","",$even)?>';<?php
			} ?>eval(even_<?php echo $tbcampA['campo']?>[json.<?php echo $tbcampA['campo']?>]);<?php
			}

			} else {
				?>$('in_<?php echo $tbcampA['campo']?>').value=json.<?php echo $tbcampA['campo']?>;
				<?php
				if($tbcampA['constante']=='1'){
				?>$('in_<?php echo $tbcampA['campo']?>').setProperties({'readonly':'true','ondblclick':"javascript:this.removeProperty('readonly')"});<?php
				}
			}
			if($tbcampA['load']!=''){
			$LoaDs=explode(";",$tbcampA['load']);
			foreach($LoaDs as $LoaDd){
			$looop=explode("||",$LoaDd);
			/* ?>cargar_combo2('<?php echo $looop[0]?>','<?php echo $looop[1]?>',json.<?php echo $tbcampA['campo']?>,'<?php echo $tb?>');<?php */
			//list($looop[1],$rt)=explode(";",$looop[1]);
			?>load_combo('<?php echo $looop[0]?>','<?php echo procesar_loads2($looop[1],$tbcampA['campo'])?>');/*vegas*/<?php
			}
			}
			if($tbcampA['noedit']=='1'){
			if($tbcampA['directlink']!=''){
			?>$('in_<?php echo $tbcampA['campo']?>_dl').setProperties({'disabled':'true'});
			$0('span_<?php echo $tbcampA['campo']?>_dl');<?php
			} else {
			?>$('in_<?php echo $tbcampA['campo']?>').setProperties({'disabled':'true'});<?php
			}
			}
			}
		}

		?>if($('load')){
		$0('load');
		$('sv_'+id).destroy();
		$('cargando_dato_ec').destroy();
		}
	}}).send();

break;
<?php
$avai=explode("|",$datos_tabla['mass_actions']);
$tbcampos_temp=$tbcampos;
foreach($tbcampos as $tc=>$camp){
	if(!in_array($camp['campo'],$avai)){
		unset($tbcampos[$tc]);
	}
}
//echo "/*";print_r($tbcampos);echo "*/";
?>
case "guardar_cambios":
	Recargar='ajax';
	ax("guardar_cambios_interno",id,pag);
break;
case "guardar_cambios_interno":
	//if($('cll_'+id)) $('cll_'+id).setStyles({'visibility':'visible'});
	//hide_error();
	//if(ax("validar")==true){
	if(1){
	//$('ed_save').value='guardando...';
	//$('ed_save').disabled=true;
	var iiiddd=new Array(); var e=0; $$('.chk').each(function(cc) { if($(cc).checked){ iiiddd[e++]=$(cc).get('data-chk'); } }); id=iiiddd.join(',');
	var datos = {<?php
	foreach($tbcampos as $tbcampA){ if($tbcampA['indicador']=='1' or $tbcampA['constante']=='1') continue;
		if($tbcampA['tipo']=='sto'){
			?>stoupload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
		 } elseif($tbcampA['tipo']=='img'){
			?>upload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
		 } elseif($tbcampA['tipo']=='html'){
			echo $tbcampA['campo']?>:CKEDITOR.instances.in_<?php echo $tbcampA['campo']?>.getData(),<?php
			/* echo $tbcampA['campo']?>:mooeditable_<?php echo $tbcampA['campo']?>.getContent(),<?php */
		 } else {
			echo $tbcampA['campo']?>:$v('in_<?php echo $tbcampA['campo']?>'),<?php
		}
	}
	if($datos_tabla['vis']!=''){ echo $datos_tabla['vis']?> : "1", <?php }
	?>v_o : MMEE,<?php
	echo $datos_tabla['fed']?>			:  "now()",<?php
	if($_GET['L']==''){ ?>v_d : "where <?php echo $datos_tabla['id']?> in ("+id+") "<?php }
	else{ ?>v_d : "where <?php echo $datos_tabla['id']?> in (<?php echo $_GET['L'];?>) "<?php }
	?>};
	new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=updatemass&debug=0", method:'post', data:datos, onSuccess:function(ee) {
	var pagg=new Array();
	if(pag){
	pagg=pag.split('=');
	if(pagg[0]=='load'){
	//location.href='loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>';
	parent.pop_up('loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>');
	/*window.open('loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>','pdf', 'width=600,height=800');*/
	beforemulti();
	initMultiBox = new multiBox({});
	} else {
	eval(pag);
	}
	}
	//alert(ee);
	var json=eval("(" + ee + ")");
	//alert(5);
	if(json.success=='1'){
	if(Recargar=='ajax'){
	<?php if($_GET['L']==''){ ?>
	//ax("editar_completo_cancelar");
	//$('resaltar').value='i_'+id;
	//alert('<?php echo $linkRecPagina;?>');
	//alert(9);
	abrir_mass('0','0');
	ax("<?php echo $linkRecPagina;?>");
	//alert(8);
	//location.href='<?php echo $SERVER['BASE'].$SERVER['URL'];?>#i_'+id;
	<?php } ?>
	} else if(Recargar=='sin_ajax'){
	location.reload();
	}
	} /*else if(json.success=='0'){
	//show_error_texto(json.error);
	//$('in_submit').value='crear <?php echo $datos_tabla['nombre_singular']?>';
	//$('in_submit').disabled=false;
	}*/
	} } ).send();
	}
break;
<?php
$tbcampos=$tbcampos_temp;
?>
case "guardar_completo":
	Recargar='ajax';
	ax("guardar_completo_interno",id,pag);
break;
case "guardar_completo_interno":
if($('cll_'+id)) $('cll_'+id).setStyles({'visibility':'visible'});
hide_error();
if(ax("validar")==true){
$('ed_save').value='guardando...';
$('ed_save').disabled=true;
var datos = {<?php
foreach($tbcampos as $tbcampA){ if($tbcampA['indicador']=='1' or $tbcampA['constante']=='1' or $tbcampA['noedit']=='1') continue;
	if($tbcampA['tipo']=='sto'){
		?>stoupload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
	 } elseif($tbcampA['tipo']=='img'){
		?>upload_<?php echo $tbcampA['campo']?>	:  $v('upload_in_<?php echo $tbcampA['campo']?>'),<?php
	 } elseif($tbcampA['tipo']=='html'){
	 	echo $tbcampA['campo']?>:CKEDITOR.instances.in_<?=$tbcampA['campo']?>.getData(), <?php
		/* echo $tbcampA['campo']?>:mooeditable_<?php echo $tbcampA['campo']?>.getContent(),<?php */
	 } else {
		echo $tbcampA['campo']?>:$v('in_<?php echo $tbcampA['campo']?>'),<?php
	}
}
if($datos_tabla['vis']!=''){ echo $datos_tabla['vis']?> : "1", <?php }
?>v_o : MMEE,<?php
echo $datos_tabla['fed']?>			:  "now()",<?php
if($_GET['L']==''){ ?>v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "<?php }
else{ ?>v_d : "where <?php echo $datos_tabla['id']?>='<?php echo $_GET['L'];?>' "<?php }
?>};
new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?'proceso='.$_GET['proceso'].'&':'' ?>f=update&debug=0", method:'post', data:datos, onSuccess:function(ee) {
var pagg=new Array();
if(pag){
pagg=pag.split('=');
if(pagg[0]=='load'){
//location.href='loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>';
parent.pop_up('loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>');
/*window.open('loadscript.php?load='+pagg[1]+'&v_o='+MMEE+'&<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&id=<?php echo $_GET['L'];?>','pdf', 'width=600,height=800');*/
beforemulti();
initMultiBox = new multiBox({});
} else {
eval(pag);
}
}
var json=eval("(" + ee + ")");
if(json.success=='1'){
if(Recargar=='ajax'){
<?php if($_GET['L']==''){ ?>
ax("editar_completo_cancelar");
$('resaltar').value='i_'+id;
// alert('<?php echo $linkRecPagina;?>');
ax("<?php echo $linkRecPagina;?>");
// return false;

// alert("<?php echo $SERVER['RUTA'];?>");
// location.href='<?php echo $SERVER['RUTA'];?>#i_'+id;
<?php } else { ?>parent.ax("recargar");parent.initMultiBox.close(); <?php }?>
} else if(Recargar=='sin_ajax'){
location.reload();
}
} else if(json.success=='0'){
show_error_texto(json.error);
$('in_submit').value='crear <?php echo $datos_tabla['nombre_singular']?>';
$('in_submit').disabled=false;
}
} } ).send();
}
break;
case "e":
$('cll_'+id).setStyles({'visibility':'hidden'});
//$('i_'+id).removeClass('modificador_grilla');
$('i_'+id).addClass('editar_rapido');
if($('edit_hidd').value.trim()!=id && $('edit_hidd').value.trim()!=''){	ax('e_a',$('edit_hidd').value); }
$('edit_hidd').value=id;
$0('lc_'+id);
$1('lec_'+id);<?php
foreach($tblistado as $tbli){ 

	if(
		$tbli['indicador']=='1' or 
		$tbli['noedit']=='1' or 
		isset($tbli['directlink']) or
		$datos_tabla['edicion_rapida']=='0'
		)  continue;

	if($tbli['listable']=='1' and $tbli['constante']!='1'){

	   if($tbli['tipo']=='sto'){
		?>$0('i_<?php echo $tbli['campo']?>_'+id);<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML=render_upload_sto('<?php echo $tb?>','<?php echo $tbli['campo']?>',id,$('txt_<?php echo $tb?>_<?php echo $tbli['campo']?>_name_'+id).value);<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
	    }

	   if($tbli['tipo']=='img'){

		?>$0('i_<?php echo $tbli['campo']?>_'+id);<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML=render_upload('<?php echo $tb?>','<?php echo $tbli['campo']?>',id,$('<?php echo $tb?>_file_<?php echo $tbli['campo']?>_'+id).src);setTimeout("charge_multibox('.mbb')",1000);<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
	   }

	   if(in_array($tbli['tipo'],array('pas'))){

		?>var val=$('i_<?php echo $tbli['campo']?>_'+id+'_temp').value.trim();
		$('p_<?php echo $tbli['campo']?>_'+id).innerHTML="<input type='password' id='<?php echo $tb?>_text_<?php echo $tbli['campo']?>_"+id+"' value='"+val+"'/><br /><input type='password' style='margin-top:2px;' id='<?php echo $tb?>_text_<?php echo $tbli['campo']?>_"+id+"_2' value='"+val+"'/>";<?php

		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php
	   }


	   if(in_array($tbli['tipo'],array('com'))){

		?>var val=$('i_<?php echo $tbli['campo']?>_hido_'+id).value;<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML='<select  id="<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'" class="form_input" style="float:left;width:'+$('i_<?php echo $tbli['campo']?>_'+id).getStyle('width')+';" ><option></option><?php
		$opciones_select=array();
		$iti=(is_array($tbli['opciones']))?1:0;
		$opciones_select=(is_array($tbli['opciones']))?$tbli['opciones']:explode(",",$tbli['opciones']);
		foreach($opciones_select as $opcccion=>$opcion_select_a){
		list($opcion_select,$color)=explode("|",$opcion_select_a);
		?><option value="<?php echo ($iti)?$opcccion:$opcion_select;?>" '+ ( ("<?php echo ($iti)?$opcccion:$opcion_select;?>"==val)?'selected':'' ) +' ><?php echo str_replace("'","",$opcion_select)?></option><?php
		}
		?></select>';<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php

		}

	   if(in_array($tbli['tipo'],array('hid')) and $tbli['opciones']!=''){
		?>var val=$('i_<?php echo $tbli['campo']?>_hido_'+id).value;<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML='<select  id="<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'" class="form_input" style="float:left;width:'+$('i_<?php echo $tbli['campo']?>_'+id).getStyle('width')+';" ><option></option><?php
		list($primO,$tablaO,$whereO)=explode("|",$tbli['opciones']);
		list($idO,$camposO)=explode(",",$primO);
		$camposOA=array();
		$camposOA=explode(";",$camposO);
		$oopciones=select(array_merge(array($idO),$camposOA),$tablaO,procesar_dato($whereO));

		foreach($oopciones as $oooo2){
		?><option value="<?php echo $oooo2[$idO];?>" '+ ( ("<?php echo $oooo2[$idO];?>"==val)?'selected':'' ) +' ><?php
		//echo $oooo2[$camposOA[0]]
		foreach($camposOA as $COA){ echo str_replace("'","",trim($oooo2[$COA]))." ";	}
		?></option><?php
		}

		?></select>';<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php
	    }

	    if(in_array($tbli['tipo'],array('inp','yot'))){

		?>var val=$('i_<?php echo $tbli['campo']?>_'+id).innerHTML.trim().replace(/"/g,"&quot;");<?php

		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML="<input style='float:left;width:"+$('i_<?php echo $tbli['campo']?>_'+id).getStyle('width')+";' type='text' onkeypress='if(event.keyCode==13){ ax(\"e_g\",\""+id+"\"); } if(event.keyCode==27){ ax(\"e_a\",\""+id+"\"); }' id='<?php echo $tb?>_text_<?php echo $tbli['campo']?>_"+id+"' value=\""+val+"\"/>";<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php
		}

		if(in_array($tbli['tipo'],array('fch'))){
		if($tbli['rango']){
		list($uuno,$ddos)=explode(",",$tbli['rango']);
		$FromYear = date("Y",strtotime($uuno));
		$ToYear = date("Y",strtotime($ddos));
		} else {
		$FromYear = date("Y")-99;
		$ToYear = date("Y")+1;
		}

		?>var val=$('i_<?php echo $tbli['campo']?>_'+id).innerHTML.trim();<?php
		?>input_date('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id,'p_<?php echo $tbli['campo']?>_'+id,<?php echo $FromYear;?>,<?php echo $ToYear;?>,'<?php echo $tbli['time']?>','<?php echo $tbli['months']?>');<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_d').setStyles({'clear':'none'});<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_m').setStyles({'clear':'none'});<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_a').setStyles({'clear':'none'});<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_t').setStyles({'clear':'none'});<?php
		?>var fecha=$('<?php echo $tb?>_fchhid_<?php echo $tbli['campo']?>_'+id).value;<?php
		?>var fechaa=new Array();var fechab=new Array();<?php
		?>fechaa = fecha.split("-");if(fechaa[2]){fechab = fechaa[2].split(" ");<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_d').value=fechab[0];<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_m').value=fechaa[1];<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_a').value=fechaa[0];<?php
		?>$('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id+'_t').value=fechab[1];}<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php
		?>fechaChange("<?php echo $tb?>_text_<?php echo $tbli['campo']?>_"+id);<?php
		}


		if(in_array($tbli['tipo'],array('txt'))){
		?>var val=$('i_<?php echo $tbli['campo']?>_'+id).innerHTML.trim();<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML="<textarea style='height:80px;width:100%;' id='<?php echo $tb?>_text_<?php echo $tbli['campo']?>_"+id+"' >"+val+"</textarea>";<?php
		?>$('p_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'block'});<?php
		?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':'none'});<?php
		}


	}
} ?>
break;
case "e_a":
	$('cll_'+id).setStyles({'visibility':'visible'});
	$('i_'+id).removeClass('editar_rapido');
	// if($('set_filas_4').getStyle('color')=='#000000'){	$('i_'+id).addClass('modificador_grilla'); 	}
	$('edit_hidd').value='';
	$1('lc_'+id);
	$0('lec_'+id);
	<?php foreach($tblistado as $tbli){ if($tbli['indicador']=='1' or $tbli['noedit']=='1') continue;
		if($tbli['listable']=='1' and $tbli['constante']!='1'){

				if($tbli['tipo']=='img'){

					?>$1('i_<?php echo $tbli['campo']?>_'+id);<?php
					?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML='';<?php
					?>$0('p_<?php echo $tbli['campo']?>_'+id);<?php

					}

					if($tbli['tipo']=='sto'){

					?>$1('i_<?php echo $tbli['campo']?>_'+id);<?php
					?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML='';<?php
					?>$0('p_<?php echo $tbli['campo']?>_'+id);<?php

					}

					if($tbli['tipo']=='pas'){

					?>$1('i_<?php echo $tbli['campo']?>_'+id);<?php
					?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML='';<?php
					?>$0('p_<?php echo $tbli['campo']?>_'+id);<?php
					?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':''});<?php


					}

					if(
					in_array($tbli['tipo'],array('txt','inp','com','yot','fch'))
					or
					(in_array($tbli['tipo'],array('hid')) and $tbli['opciones']!='')
					){

					?>$('p_<?php echo $tbli['campo']?>_'+id).innerHTML="";<?php
					?>$0('p_<?php echo $tbli['campo']?>_'+id);<?php
					?>$('i_<?php echo $tbli['campo']?>_'+id).setStyles({'display':''});<?php

					}



		}
	}

	?>
break;
case "validar_editar":
var ret=true;
/*
<?php foreach($tblistado as $tbcampA){ if($tbcampA['indicador']=='1' or $tbcampA['noedit']=='1') continue;
		if($tbcampA['listable']=='1' and $tbcampA['constante']!='1'){
			if($tbcampA['validacion']=='1'){

			if($tbcampA['tipo']=='sto'){
				?>//if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()=='' && ret){ show_error(1); ret=false; }<?php
			} elseif($tbcampA['tipo']=='img'){
				?>//if($v('upload_in_<?php echo $tbcampA['campo']?>').trim()=='' && ret){ show_error(1); ret=false; }<?php
			} elseif($tbcampA['tipo']=='pas'){
				?>if($v('<?php echo $tb?>_text_<?php echo $tbcampA['campo']?>_'+id).trim()=='' && ret){ show_error_alert(1); ret=false; }
				if($v('<?php echo $tb?>_text_<?php echo $tbcampA['campo']?>_'+id).trim()!=$v('<?php echo $tb?>_text_<?php echo $tbcampA['campo']?>_'+id+"_2").trim() && ret){ show_error_alert(2); ret=false; }	<?php
			 } elseif($tbcampA['tipo']=='hid'){
				//echo "";
			} else {
				?>if($v('<?php echo $tb?>_text_<?php echo $tbcampA['campo']?>_'+id).trim()=='' && ret){ show_error_alert(1); ret=false; }<?php
			}

		}
	}
} ?>
*/
return ret;
break;
case "e_g":
if(ax("validar_editar",id)==true){
Element('div', {
'class' : 'sv',
'html' : 'guardando...',
'id':'sv_'+id
}).inject($('i_'+id));
var datos = {
<?php foreach($tblistado as $tbli){ if($tbli['indicador']=='1' or $tbli['noedit']=='1') continue;
	if($tbli['listable']=='1' and $tbli['constante']!='1'){
		if(in_array($tbli['tipo'],array('img'))){
			?>upload_<?php echo $tbli['campo']?>	:  $v('upload_in_<?php echo $tbli['campo']?>_'+id),<?php
		} elseif(in_array($tbli['tipo'],array('sto'))){
			?>stoupload_<?php echo $tbli['campo']?>	:  $v('upload_in_<?php echo $tbli['campo']?>_'+id),<?php
		} elseif(
			in_array($tbli['tipo'],array('txt','inp','com','yot','fch','pas','html'))
			or
		    (in_array($tbli['tipo'],array('hid')) and $tbli['opciones']!='')
			){
			?>'<?php echo $tbli['campo']?>'			:  $v('<?php echo $tb?>_text_<?php echo $tbli['campo']?>_'+id),<?php
		}

	}
}
echo $datos_tabla['fed']?>:"now()",
v_o : MMEE,
v_d : "where <?php echo $datos_tabla['id']?>='"+id+"' "
};
new Request({url:"ajax_sql.php?<?php echo (isset($_GET['proceso']))?"proceso=".$_GET['proceso']."&":""?>f=update&debug=0", method:'post', data:datos, onSuccess:function(ee) {
var json=eval("(" + ee + ")");
if(json.success=='1'){
ax('e_a',id);
$('sv_'+id).destroy();
$('resaltar').value='i_'+id; 
// console.log("<?php echo $linkRecPagina;?>");
ax("<?php echo $linkRecPagina;?>");
<?php if($needs['img']){ ?>charge_multibox();<?php } ?>
} else if(json.success=='0'){
show_error_alert_text(json.error);
//$0('sv_'+id);
ax('e_a',id);
}
} } ).send();
}
break;
}
}


<?php
/*
foreach($tbcampos as $tbcampA){
	switch($tbcampA['tipo']){
		case "html": ?>var mooeditable_<?php echo $tbcampA['campo']?>;<?php	break;
	}
} */ ?>

precrear_loaded=0;
function pre_crear(next){
	// alert('genial12');
// alert(next);
if(precrear_loaded){ 
	if(next){ eval(next); } return;
}
<?php

	include("formulario_camposjs.php");

	/*
    if($datos_tabla['creacion_hijo']){
    $Hijos=explode(",",$datos_tabla['creacion_hijo']);
    foreach($Hijos as $HijoD){
    list($Hijo,$TipoHijo)=explode("|",$HijoD);
    foreach($objeto_tabla as $obbb){
        if($obbb['archivo']==$Hijo){
            $Pplural=$obbb['nombre_plural'];
            foreach($obbb['campos'] as $canp){
                if($canp['foreig']=='1'){
                    $HijoCampo=$canp['campo'];
                }
            }
        }
    }
    $HijoValor=999999000 + rand(1,999);
    $HHijos[]=$HijoD;
    ?>render_son('<?php echo $Hijo;?>',999999000+$random(1,999),false,'<?php echo $TipoHijo;?>');<?php
    } }
    */
?>
precrear_loaded=1;
// console.log('next:'+next);
if(next){ eval(next); }

}

function load_mass(){
$1('cargando_form');
new Request({url:'masss.php?OB='+MMEE+'&ran=1&proceso=<?php echo $Proceso;?>&<?php echo $SERVER['PARAMS'];?>',  method:'get', onSuccess:function(ee) {
$('bloque_content_mass').setStyles({'display':''});
$('bloque_content_mass').innerHTML=ee;
charge_multibox('#bloque_content_mass .mb');
//pre_crear();
$0('cargando_form');
} } ).send();
}

function load_crear(){
// alert('1');
$1('cargando_form');
// alert('2');
new Request({url:'formulario.php?OB='+MMEE+'&ran=1&proceso=<?php echo $Proceso;?>&<?php echo $SERVER['PARAMS'];?>',  method:'get', onSuccess:function(ee) {
// alert('3');	
$('bloque_content_crear').setStyles({'display':''});
$('bloque_content_crear').innerHTML=ee;
charge_multibox('#bloque_content_crear .mb');
// alert('8');
pre_crear();
// alert('9');
$0('cargando_form');
} } ).send();
}

function load_stat(){
//$1('cargando_form');
new Request({url:'estadistica.php?OB='+MMEE+'&ran=1&proceso=<?php echo $Proceso;?>&<?php echo $SERVER['PARAMS'];?>',  method:'get', onSuccess:function(ee) {
$('bloque_content_stat').setStyles({'display':''});
$('bloque_content_stat').innerHTML=ee;
//pre_crear();
//$0('cargando_form');
} } ).send();
}

function load_repos(mi=MMEE){
//$1('cargando_form');
new Request({url:'repos.php?OB='+MMEE+'&ran=1&proceso=<?php echo $Proceso;?>&<?php echo $SERVER['PARAMS'];?>',  method:'get', onSuccess:function(ee) {
$('bloque_content_repos').setStyles({'display':''});
$('bloque_content_repos').innerHTML=ee;
eval($('evalScripts_repo').value);
//pre_crear();
//$0('cargando_form');
} } ).send();
}


function render_son(hijo,idparent,relo,TipoHijo){
var reloa='';
<?php if(substr($SERVER['browser'],0,2)=='IE'){ ?>
reloa = (relo)?"&rt="+$random(1,999):"";
<?php } ?>
$('tempar_'+hijo).value=$('tempar_'+hijo+'_pre').value+"|"+idparent;
$('tempar_'+hijo+'_iframe').innerHTML="<iframe frameborder='0' src='custom/"+hijo+".php?block=form"+reloa+"&tipo="+TipoHijo+"&id="+idparent+"' ></iframe>";
}

function ponerafter(el,html){
	$(el).after(html);
}

window.addEvent('domready',function(){
<?php $loads=json_decode($_GET['load']);
foreach($loads as $name=>$value){ ?>
$('in_<?php echo $name;?>').value='<?php echo $value;?>';
<?php } ?>
});

</script>