<?php //�

/**********************************************/
///////////////   LOADERS   ////////////////////
/**********************************************/

$HEAD['INCLUDE']['version']=$INCLUDE['version'];

$HEAD['INCLUDE']['anaytics_code']=$COMMON['datos_root']['anaytics_code'];

$HEAD['INCLUDES']['js'][]='js/mootools-core-1.3.2-full-compat-yc.js';
$HEAD['INCLUDES']['js'][]='js/mootools-more-1.3.2.1.js';
$HEAD['INCLUDES']['js'][]='js/js.js';


if($_SESSION['edicionweb']=='1' and $SERVER['LOCAL']=='1'){
	$HEAD['INCLUDES']['js'][]='js/mootools-core-1.3.2-full-compat-yc.js';
	$HEAD['INCLUDES']['js'][]='js/mootools-more-1.3.2.1.js';
	$HEAD['INCLUDES']['js'][]='js/js.js';
}

if($SERVER['browser']=='IE6'){
	$HEAD['INCLUDES']['js'][]='js/unitpngfix.js';
}

$HEAD['INCLUDES']['ico'][]='img/favicon.ico';


$JSC['script'][]="var clear='".$SERVER['BASE'].THEME_PATH."img/clear.gif'";

//web_render_general_config();

//JAVASCRIPT
$HEAD['INCLUDES']['script'][]="var BASE='".$SERVER['BASE']."'";


$HEAD['INCLUDES']['script'][]="var MONEDA='".$COMMON['datos_root']['simbolo_moneda']."'";
$HEAD['INCLUDES']['script'][]="var LINK_BUSQUEDA='".procesar_url('index.php?modulo=pagin-items&tab=productos&buscar=')."'";
$HEAD['INCLUDES']['script'][]="var CARRITO_PAGINA='".procesar_url('index.php?modulo=app&tab=carrito')."'";
$HEAD['INCLUDES']['script'][]="var CARRITO_ENVIAR='".procesar_url('index.php?modulo=formularios&tab=pedido')."'";		


//$HEAD['INCLUDES']['external_css'][]="http://fonts.googleapis.com/css?family=Cantarell";



if(isset($FORMULARIO) or $Load['formulario']==1){	
	$HEAD['INCLUDES']['js'][]='js/lang/es.js';
	$HEAD['INCLUDES']['js'][]='js/formcheck.js';
	$HEAD['INCLUDES']['css'][]='css/theme/grey/formcheck.css'; //[blue,classic,green,grey,red,white]
}

if(isset($REMOOZZ) or $Load['remoozz']==1){
	$HEAD['INCLUDES']['js'][]='js/ReMooz.js';
	$HEAD['INCLUDES']['css'][]='css/ReMooz.css';
	$HEAD['INCLUDES']['css_ie6'][]='css/ReMoozIE6.css';
	$HEAD['INCLUDES']['js'][]='js/_class.noobSlide.packed.js';
}		
	
if(isset($SLIDESHOW) or isset($Load['slideshow'])){
	$HEAD['INCLUDES']['js'][]='js/slideshow.js';
	$HEAD['INCLUDES']['css'][]='css/slideshow/slideshow.css';
	if(isset($KENBURNS)){
	$HEAD['INCLUDES']['js'][]='js/slideshow.kenburns.js';
	}
	if(isset($LIGHTBOX)){
	$HEAD['INCLUDES']['js'][]='js/lightbox.js';
	$HEAD['INCLUDES']['css'][]='css/slideshow/lightbox.css';
	}		
}

if(isset($SEXYLIGHTBOX) or $Load['sexylightbox']==1){	
	$HEAD['INCLUDES']['js'][]='js/sexylightbox/sexylightbox.v2.3.mootools.min.js';
	$HEAD['INCLUDES']['css'][]='css/sexylightbox/sexylightbox.css';
}

if(isset($MOOTIPS) or $Load['mootips']==1){	
	$HEAD['INCLUDES']['js'][]='js/MooTooltips.js';
	$HEAD['INCLUDES']['css'][]='css/MooTooltips.css';
}

if($Load['imagezoom']==1){	
	$HEAD['INCLUDES']['js'][]='js/imagezoom.js';
	$HEAD['INCLUDES']['css'][]='css/imagezoom/imagezoom.css';
}

if(0){
//	$HEAD['INCLUDES']['js'][]='js/moodalbox.js';
//	$HEAD['INCLUDES']['js'][]='css/moodalbox.css';	
	$HEAD['INCLUDES']['js'][]='js/Moobox.js';
	$HEAD['INCLUDES']['css'][]='css/Moobox.css';	
}


/**
 * MAIN CSS
 */
$HEAD['INCLUDES']['css_after'][]='css/main.css';

