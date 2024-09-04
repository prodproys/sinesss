<?php //á


parse_str($CLASSPARAMETERS['web-web'],$WV);

$WV = processvarscss_2D($WV);

$AnchoTotal=str_replace("px","",$WV['body_w']);

$AnchoTotalExterior = $AnchoTotal + str_replace("px","",$WV['content_p-d']) + str_replace("px","",$WV['content_p-i']);

$ContenidoBorde=0;

$InterCol=str_replace("px","",$WV['canvas_inter']);
$InterFila=str_replace("px","",$WV['canvas_inter']);

$MargenDer=0;

$CanvasLados=$WV['canvas_p-lados'];

list($dbl_1)=explode("M",$WV['canvas_dbl']);

list($tpl_1,$tpl_3)=explode("M",$WV['canvas_tpl']);

list($cpl_12,$cpl_4)=explode("M",$WV['canvas_cpl']);
list($cpl_1,$cpl_2)=explode(";",$cpl_12);

$AnchoCol[1][1] = $AnchoTotal - array_sum($AnchoCol[1]) - ( 2 + sizeof($AnchoCol[1]) )*$InterCol - $MargenDer - 2*$CanvasLados;


$AnchoCol[2][1]=$dbl_1;
$AnchoCol[2][2] = $AnchoTotal - array_sum($AnchoCol[2]) - ( 2 + sizeof($AnchoCol[2]) )*$InterCol - $MargenDer - 2*$CanvasLados;


$AnchoCol[3][1]=$tpl_1;
$AnchoCol[3][3]=$tpl_3;
//prin( $AnchoTotal - array_sum($AnchoCol[3]) - 2*$CanvasLados );
$AnchoCol[3][2] = $AnchoTotal - array_sum($AnchoCol[3]) - ( 2 + sizeof($AnchoCol[3]) )*$InterCol - $MargenDer - 2*$CanvasLados;


$AnchoCol[4][1]=$cpl_1;
$AnchoCol[4][2]=$cpl_2;
$AnchoCol[4][4]=$cpl_4;
//prin( $AnchoTotal - array_sum($AnchoCol[3]) - 2*$CanvasLados );
$AnchoCol[4][3] = $AnchoTotal - array_sum($AnchoCol[4]) - ( 2 + sizeof($AnchoCol[4]) )*$InterCol - $MargenDer - 2*$CanvasLados;


/************************************************/
/************         BODY         **************/
/************************************************/



//$HEAD['INCLUDES']['style_common'][]='body { background:url("http://meijereventos.com/web/templates/default/img/common_bg.gif") #FFF; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("http://www.domiruth.com/wp-content/themes/domiruth_01/img/back-body-text.gif") repeat scroll 0 0 #E7E7CA; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("../img/particular/body/bg2.jpg") repeat scroll 0 0 #E7E7CA; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:#FFF; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("../img/particular/body/bg3.jpg") repeat-x scroll 0 0 #C7C3C2; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("../img/particular/body/bg4.jpg") repeat scroll 0 0 #C6C5C3; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("http://www.nosoloviajeros.com/wp-content/themes/inove/img/bg.jpg") repeat-x scroll 0 0 #C7C3C2; }';
//$HEAD['INCLUDES']['style_common'][]='body { background:url("http://etiquetanegra.com.pe/wp-content/themes/box-set-10/images/pattern_036.gif") repeat scroll 0 0 #C7C3C2; }';



$HEAD['INCLUDES']['style_common'][]='body { background:'.$WV['body_bg'].'; }';


$HEAD['INCLUDES']['style_common'][]='body { font-family:calibri,helvetica,arial,sans-serif,tahoma,verdana; font-size:12px; '.$WV['body_s'].'}';
//$HEAD['INCLUDES']['style_common'][]='body { font-family:\'Cantarell\',"Trebuchet MS","Times New Roman", Times, serif; font-size:12px; }';

//prin($WV);
//$HEAD['INCLUDES']['style_common'][]='#div_allcontent { width: 100%; }';
$HEAD['INCLUDES']['style_common'][]='#div_allcontent { width: '. ( $AnchoTotalExterior + 2*$ContenidoBorde ).'px; }';
$HEAD['INCLUDES']['style_common'][]='#contenido_principal { margin-top:0; margin-bottom:10px; padding:0; '.$WV['content_s'].' }';
$HEAD['INCLUDES']['style_common'][]='#contenido_margen { margin: 0px; border:'. $ContenidoBorde .'px solid #FFF; border-bottom:0;  float:none; #float:left; padding-left:'.$WV['content_p-i'].';padding-right:'.$WV['content_p-d'].'; }';
$HEAD['INCLUDES']['style_common'][]='.div_body { '.$WV['divbody_s'].' }';



/************************************************/
/**********         HEADER         **************/
/************************************************/

$HEAD['INCLUDES']['style_common'][]='#div_header { width:100%; height:'.$WV['header_h'].'; background:'.$WV['header_bg'].'; clear:left; margin-bottom:'.$WV['header_m-b'].';  }';



$HEAD['INCLUDES']['style_common'][]='.header-logo { background-image:none !important; }';
$HEAD['INCLUDES']['style_common'][]='.iconos { font-weight:bold;font-size:14px; height:19px; color:#762B1B; padding-top:5px;float:left;background-repeat:no-repeat;background-color:transparent;background-position:0px 0px; padding-left:28px; margin:7px 10px 0px 0;}';
$HEAD['INCLUDES']['style_common'][]='.iconos b { color:#DD2A08; }';
$HEAD['INCLUDES']['style_common'][]='.telefono { background-image:url("../img/particular/iconos/mobile_phone.png");}';
$HEAD['INCLUDES']['style_common'][]='.contactenos { background-image:url("../img/particular/iconos/mail.png");}';
$HEAD['INCLUDES']['style_common'][]='.cotizacion { background-image:url("../img/particular/iconos/calculator.png");}';


/************************************************/
/*********          MENU         ****************/
/************************************************/



/************************************************/
/********           BAR          ****************/
/************************************************/

$HEAD['INCLUDES']['style_common'][]='#div_bar { height:'.$WV['bar_h'].'; background:'.$WV['bar_bg'].'; '.$WV['bar_s'].' }';


/*************************************************/
/*********         HEADER_OUT         ************/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_header_out { height:'.$WV['headerout_h'].'; background:'.$WV['headerout_bg'].'; '.$WV['headerout_s'].' }';

/*************************************************/
/*********         HEADER_PRE         ************/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_header_pre { height:'.$WV['headerpre_h'].'; background:'.$WV['headerpre_bg'].'; '.$WV['headerpre_s'].' }';

/*************************************************/
/********         HEADER_AFTER         ***********/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_header_after { height:'.$WV['headerafter_h'].'; background:'.$WV['headerafter_bg'].'; '.$WV['headerafter_s'].' }';

/*************************************************/
/*********         FOOTER_PRE         ************/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_footer_pre { height:'.$WV['footerpre_h'].'; background:'.$WV['footerpre_bg'].'; '.$WV['footerpre_s'].' }';

/*************************************************/
/*********         FOOTER_AFTER         **********/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_footer_after { height:'.$WV['footerafter_h'].'; background:'.$WV['footerafter_bg'].'; '.$WV['footerafter_s'].' }';

/*************************************************/
/*********          FOOTER_OUT          **********/
/*************************************************/
$HEAD['INCLUDES']['style_common'][]='#div_footer_out { height:'.$WV['footerout_h'].'; background:'.$WV['footerout_bg'].'; '.$WV['footerout_s'].' }';


/*************************************************/
/**********         CANVAS         ***************/
/*************************************************/

/*CANVAS*/	$HEAD['INCLUDES']['style_common'][]='	.div_canvas { background:'.$WV['canvas_bg'].';  margin-top:0px; min-height:'.$WV['canvas_min-h'].'; height:auto !important; height:350px; border:'.$WV['canvas_borde'].' solid #999; float:none; border-top:0; padding-bottom:'.$WV['canvas_p-b'].'; 
padding-top:'.$WV['canvas_p-t'].'; padding-left:'.$WV['canvas_p-lados'].'; 
}';

/*************************************************/
/*********         SOMBRAS         ***************/
/*************************************************/

/*sombras*/	$HEAD['INCLUDES']['style_common'][]='	.div_sombra_left, .div_sombra_right { top:100px; display:none; }';


/*************************************************/
/**********         FOOTER         ***************/
/*************************************************/

/*$HEAD['INCLUDES']['style_common'][]='#div_footer { }';*/




/************************************************/
/***********         ICONOS         *************/
/************************************************/

/* 
$HEAD['INCLUDES']['style_common'][]='.ico_phone { background-image:url("../img/particular/iconos/mobile_phone.png");}';
$HEAD['INCLUDES']['style_common'][]='.ico_email { background-image:url("../img/particular/iconos/mail.png");}';
$HEAD['INCLUDES']['style_common'][]='.ico_mobi { background-image:url("../img/particular/iconos/mobile.gif");}';
$HEAD['INCLUDES']['style_common'][]='.ico_calc { background-image:url("../img/particular/iconos/calculator.png");}';
$HEAD['INCLUDES']['style_common'][]='.ico_cart { background-image:url("../img/particular/iconos/calculator.png");}';
 */
 

/************************************************/
/***********         LINKS         **************/
/************************************************/

$HEAD['INCLUDES']['style_common'][]='a { color:#BB7E06; text-decoration:none; } a:hover { color:#000; text-decoration:underline; }';
$HEAD['INCLUDES']['style_common'][]='a.fuerte { color:#FF0000; font-size:14px; font-weight:bold; } ';
$HEAD['INCLUDES']['style_common'][]='a.debil { color:#FF0000; font-size:11px; font-weight:normal; } ';
$HEAD['INCLUDES']['style_common'][]='a.main { color:#FF0000;} ';


/**********************************************/
/***************      FLOTANTES    ************/
/**********************************************/

foreach($BLOQUES_FLOTANTES as $class=>$bf){
	$HEAD['INCLUDES']['style_common'][]='.'.$class.' { '. web_render_flotantes($bf) .' }';
}

/*************************************************/
/********         COLUMNAS         ***************/
/*************************************************/

//1 POR FILA///////////////////////////////////
/*left*/ 	$HEAD['INCLUDES']['style_common'][]='	.div_col_1d1 { width:'.$AnchoCol[1][1].'px; margin-right:0px; background:none; 
padding:0px 0px 0px '.$InterCol.'px; }';

//2 POR FILA//////////////////////////////////
/*left*/ 	$HEAD['INCLUDES']['style_common'][]='	.div_col_1d2 { width:'.$AnchoCol[2][1].'px; margin-right:0px; background:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';
/*main*/	$HEAD['INCLUDES']['style_common'][]='	.div_col_2d2{ width:'.$AnchoCol[2][2].'px; background-color:none;
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px;}';

//3 POR FILA//////////////////////////////////
/*left*/ 	$HEAD['INCLUDES']['style_common'][]='	.div_col_1d3 { width:'.$AnchoCol[3][1].'px; margin-right:0px; background:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';
/*right*/	$HEAD['INCLUDES']['style_common'][]='	.div_col_3d3 { width:'.$AnchoCol[3][3].'px; background-color:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';
/*main*/	$HEAD['INCLUDES']['style_common'][]='	.div_col_2d3 { width:'.$AnchoCol[3][2].'px; background-color:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px;}';


//4 POR FILA//////////////////////////////////
/*left*/ 	$HEAD['INCLUDES']['style_common'][]='	.div_col_1d4 { width:'.$AnchoCol[4][1].'px; margin-right:0px; background:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';
/*left2*/ 	$HEAD['INCLUDES']['style_common'][]='	.div_col_2d4 { width:'.$AnchoCol[4][2].'px; margin-right:0px; background:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';

/*right*/	$HEAD['INCLUDES']['style_common'][]='	.div_col_4d4 { width:'.$AnchoCol[4][4].'px; margin-right:0px; background:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px; }';

/*main*/	$HEAD['INCLUDES']['style_common'][]='	.div_col_3d4 { width:'.$AnchoCol[4][3].'px; background-color:none; 
padding-top:0px; padding-right: 0px; padding-bottom:0px; padding-left:'.$InterCol.'px;}';

//
$HEAD['INCLUDES']['style_common'][]='.margen_izquierda { padding-left:'.$InterCol.'px; } ';

