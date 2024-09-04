<script>
var Recargar='ajax';
var mooedit;
var FORMULARIO_ABIERTO;<?php
$datos_tabla['expandir_vertical']='1'; ?>
//alert('<?php echo $tbl?>');
var tbl = "<?php echo $tbl?>";
var MMEE;
var USU_IMG_DEFAULT="<?php echo $USU_IMG_DEFAULT;?>";
var json;
function ax(accion,id,pag,me='<?php echo $datos_tabla['me'];?>',where='inner_after',get_id='<?php echo $datos_tabla['get_id']?>',mode='',mw='',nc=0){
	// if(document.getElementById('get_request')){
	// 	let hammer =JSON.parse(document.getElementById('get_request').value);
	// 	// MMEE=hammer.OB;
	// 	// mw=hammer.mw;
	// }
	console.log(accion);
	switch(accion){	
	case "paginaUrl":
		$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
		new Request({
			url:"vista.php?OB="+me+"&pag="+pag+"&ran=1"+get_id+"&inner="+where+"&mode="+mode+"&mw="+mw+"&nc="+nc, 
			method:'get', 
			onSuccess:function(ee) { 
				// if(pag==1)
				$(where).innerHTML=ee; 
				document.querySelector('#barra_titulo').scrollIntoView({ behavior: 'smooth', block: 'start' });
				ax('actualizar_total',this.value); 

			} 
		}).send();
	break;
	// case "excel2":
	// 	if(document.getElementById('get_request_filters')){
	// 		let hammer =JSON.parse(document.getElementById('get_request').value);
	// 		MMEE=hammer.OB;
	// 		mw=hammer.mw;
	// 	}			
	// 	var url="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where+(($('ffilter')?'&filter='+$('ffilter').value:''));
	// 	// var url="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1<?php echo $datos_tabla['get_id']?>&conf2=<?php echo urlencode($_GET['conf'])?>"+(($('ffilter')?'&filter='+$('ffilter').value:''));
	// 	alert(url);
	// 	new Request({url:url,method:'get', onSuccess:function(ee) { alert(ee); } }).send();
	// break;
	case "excel":
		if(document.getElementById('get_request_filters')){
			let hammer =JSON.parse(document.getElementById('get_request').value);
			MMEE=hammer.OB;
			mw=hammer.mw;
		}		
		var url="vista.php?OB="+MMEE+"&filter="+id+"&format=excel&ran=1"+get_id+"&conf2=<?php echo urlencode($_GET['conf'])?>&inner="+where+(($('ffilter')?'&filter='+$('ffilter').value:''));
		// console.log(url);
		location.href=url;
	break;
	case "pagina_filter":
		if(document.getElementById('get_request_filters')){
			let hammer =JSON.parse(document.getElementById('get_request').value);
			MMEE=hammer.OB;
			mw=hammer.mw;
		}		
		$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
		new Request({url:"vista.php?OB="+MMEE+"&filter="+id+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>&conf2=<?php echo urlencode($_GET['conf'])?>"+get_id+"&inner="+where+"&mode="+mode+"&mw="+mw, 
			method:'get', 
			onSuccess:function(ee) { 
			$(where).innerHTML=ee; 
			document.querySelector('#'+where).scrollIntoView({ behavior: 'smooth', block: 'start' });
			ax('actualizar_total',this.value); 
		} } ).send();
	break;	
	case "pagina":
		$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
		new Request({url:"vista.php?OB="+MMEE+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
			$(where).innerHTML=ee; 
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
		$1('refresh');
		$1('refresh-cover');
		new Request({url:"vista.php?OB="+MMEE+"&"+$v('nfilter')+"&ran=1<?php echo $datos_tabla['get_id']?>",  method:'get', onSuccess:function(ee) {
		// console.log(ee);
		$('inner').innerHTML=ee;
		if($('resaltar').value!=''){
		$($('resaltar').value).highlight('#FF0', '#FFF');
		var resal = $('resaltar').value;
		$($('resaltar').value).setStyles({'border-top':'1px solid #333','border-bottom':'1px solid #333','border-left':'1px solid #333','border-right':'1px solid #333'});
		setTimeout("\$('"+resal+"').setStyles({'border':'0px'});",8000);
		$('resaltar').value='';
		}
		ax('actualizar_total',this.value);
		$0('refresh');
		$0('refresh-cover');
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
		new Request({
			url:"vista.php?OB="+MMEE+"&filter=<?php echo $_GET['filter'];?>&pag="+$v('pagina')+"&ran=1<?php echo $datos_tabla['get_id']?>&mw="+mw,  method:'get', 
			onSuccess:function(ee) {
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
	case "pagina_filtro":
		$(where).innerHTML='<div id="new_refreshing"></div>'+$(where).innerHTML; 
		new Request({url:"vista.php?OB="+MMEE+"&filtro="+id+"&pag="+pag+"&ran=1<?php echo $datos_tabla['get_id']?>", method:'get', onSuccess:function(ee) { 
			$(where).innerHTML=ee; 
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
	}
}

function render_filder(){
    var url='';
    let $dataFields=document.querySelectorAll('.filters#dfilters select[data-field]');
    $dataFields.forEach((ele)=>{
        if($('filtr_'+ele.dataset.field).value!=''){ 
           url+=encodeURIComponent(ele.dataset.table+'[]='+$('filtr_'+ele.dataset.field).value+'&'); 
        }
    });
    $('ffilter').value=url;
    // url=url+'&conf=<?php echo urlencode($_GET['conf'])?>';
    console.log(url);
    // alert(url);
    ax("pagina_filter",url,1,'');
    //location.href="custom/<?php echo $datos_tabla['archivo']; ?>.php?filter="+url;
}
	
</script>