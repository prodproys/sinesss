<!DOCTYPE HTML>
<html lang="es">
<head>
<title><?=(($MEEE['titulo'])?$MEEE['titulo']." - ":'').$html_title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<?php
/* ?><meta name="title" content="<?php echo $meta_title?>"/><?php */
/* ?><meta name="description" content="<?php echo $meta_descripcion?>"/><?php */
/* ?><meta name="keywords" content="<?php echo $meta_keyword?>"/><?php */

if($_GET['rt']!=''){
	parse_str($_SERVER['QUERY_STRING'],$get);
	unset($get['rt']);
	//header("Location: ".$SERVER['BASE'].$SERVER['ARCHIVO']."?redirigido=1&".http_build_query($get));
	echo '<meta http-equiv="refresh" content="0;url='. ( $SERVER['BASE'].$SERVER['ARCHIVO'].'?'.http_build_query($get) ) .'" />';
}

if(!(strpos($_SERVER['SCRIPT_NAME'], $DIR_CUSTOM)===false)){
	$sn=explode($DIR_CUSTOM,$_SERVER['SCRIPT_NAME']);
	$sn2="http://".$_SERVER['SERVER_NAME'].$sn[0];
	$sn3='<base href="'.$sn2.'" />';
} else {
	$sn=explode("/panel",$_SERVER['SCRIPT_NAME']);
	$sn2="http://".$_SERVER['SERVER_NAME'].$sn[0]."/panel/";
	$sn3='<base href="'.$sn2.'" />';
}


echo $sn3;

$rrr='315';

$Touch = json_decode(file('../touch.json')[0],true)['v'];

// prin($MEEE);

$needs=necesita_libs($MEEE);


//FAVICON
if($Local){ ?>
<link rel="shortcut icon" href="<?php echo $sn2?>img/local.ico?r=<?php echo $Touch;?>" />
<?php } else{ ?>
<link rel="shortcut icon" href="<?php echo $sn2?>img/remote.ico?r=<?php echo $Touch;?>" />
<?php }


//MAIN LIBs
/*?><link href="<?php echo $sn2?>css/css.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css"/><?php
 ?><script type="text/javascript" src="<?php echo $sn2?>js/mootools-core-1.3.2-full-compat.js"></script><?php
?><script type="text/javascript" src="<?php echo $sn2?>js/mootools-more-1.3.2.1.js"></script><?php
?><script type="text/javascript" src="<?php echo $sn2?>js/js.js?r=<?php echo $Touch;?>"></script><?php
*/
?>

<link href="<?php echo $sn2?>css/bootstrap.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo $sn2?>css/bootstrap-responsive.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->

<!-- <link href="<?php echo $sn2?>css/material.min.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<!-- <link href="<?php echo $sn2?>css/flat-ui.min.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->

<!-- <link href="<?php echo $sn2?>css/docs.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->

<link href="<?php echo $sn2?>css/css.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" />

<?php
?>

<link href="<?php echo $sn2?>config/main.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" />

<link href="<?php echo $sn2?>css/css_print.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" media="print" />

<?php



if($JAVASCRIPT_FRAMEWORK=="jquery")
{ //JQUERY
?>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

<script src="../js/plugins.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/main.js"></script> -->

<style type="text/css">
@font-face {
	font-family: 'caviar_dreamsregular';
	src: url('css/fonts/caviardreams/caviardreams-webfont.eot');
	src: url('css/fonts/caviardreams/caviardreams-webfont.eot') format('embedded-opentype'),
	url('css/fonts/caviardreams/caviardreams-webfont.woff') format('woff'),
	url('css/fonts/caviardreams/caviardreams-webfont.ttf') format('truetype'),
	url('css/fonts/caviardreams/caviardreams-webfont.svg#caviar_dreamsregular') format('svg');
    font-weight: normal;
    font-style: normal;
}
</style>
<!--<link rel="stylesheet" href="css/docs.css">-->
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<script data-main="js/" src="js/require.min.js"></script>
<?php

if(isset($EXTRA_JSS) and sizeof($EXTRA_JSS)>0)
foreach($EXTRA_JSS as $archivo){
echo '<script type="text/javascript" src="'.$archivo.'"></script>';
}

if(isset($EXTRA_CSSS) and sizeof($EXTRA_CSSS)>0)
foreach($EXTRA_CSSS as $archivo){
echo '<link type="text/css" rel="stylesheet" href="'.$archivo.'" >';
}

?>
<?php
} //JQUERY END
else 
{ //MOOTOOLS

?>
	<script type="text/javascript"
		src="<?php echo $sn2?>js/mootools-core-1.4.2-full-compat-yc.js"></script>
	<?php
	?>
	<script type="text/javascript"
		src="<?php echo $sn2?>js/mootools-more-1.4.0.1.js"></script>
	<?php
	?>
	<script type="text/javascript"
		src="<?php echo $sn2?>js/js.js?r=<?php echo $Touch;?>"></script>
	<?php


	//swfobject.js
	if(1){
	?>
	<script type="text/javascript" src="<?php echo $sn2?>js/swfobject.js"></script>
	<?php
	}

	//Meio.Autocomplete.js
	if(1){
	?>
	<script type="text/javascript"
		src="<?php echo $sn2?>js/Meio.Autocomplete.js"></script>
	<?php
	/*?><script type="text/javascript" src="<?php echo $sn2?>js/HashListener.js"></script><?php*/
	/*?><script type="text/javascript" src="<?php echo $sn2?>js/HistoryManager.js"></script><?php*/
	/* ?><link type="text/css" rel="stylesheet" href="<?php echo $sn2?>css/multiBox.css" /><?php */
	}
	//LIGHTSHOW
	$needs['img']=1;
	if($needs['img']){
	?>
	<script type="text/javascript"
		src="<?php echo $sn2?>js/_class.noobSlide.packed.js"></script>
	<?php
	?>
	<script type="text/javascript" src="<?php echo $sn2?>js/overlay.js"></script>
	<?php
	?>
	<script type="text/javascript" src="<?php echo $sn2?>js/multiBox.js"></script>
	<?php
	?>
	<link type="text/css" rel="stylesheet"
		href="<?php echo $sn2?>css/multiBox.css" />
	<?php
	}

	// prin($needs);
	//EDIT HTML
	//if(1){
	if($needs['html'] or $SERVER['ARCHIVO_REAL']=='pop.php'){

	?><script type="text/javascript" src="<?php echo $sn2?>js/ckeditor/ckeditor.js?r=<?php echo $Touch;?>"></script><?php	

	/*
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/MooEditable.css"><?php
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/MooEditable.Extras.css"><?php
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/MooEditable.SilkTheme.css"><?php
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/MooEditable.Table.css"><?php
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/MooEditable.Forecolor.css"><?php
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.UI.ButtonOverlay.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.UI.MenuList.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.Extras.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.Table.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.CleanPaste.js"></script><?php	
	?><script type="text/javascript" src="<?php echo $sn2?>js/MooEditable.Forecolor.js"></script	<?php	
	*/

	}

	/*
	 $needs['milkbox']=1;
	if($needs['milkbox']){
	?><script type="text/javascript" src="<?php echo $sn2?>js/milkbox-yc.js"></script><?php
	?><link rel="stylesheet" type="text/css" href="<?php echo $sn2?>css/milkbox/milkbox.css"><?php
	}
	*/
	$needs['mootooltips']=1;
	if($needs['mootooltips']){
	?>
	<link rel="stylesheet" type="text/css"
		href="<?php echo $sn2?>css/MooTooltips.css">
	<?php
	?>
	<script type="text/javascript" src="<?php echo $sn2?>js/MooTooltips.js"></script>
	<style>
	.ToolTips .message {
		margin-bottom: 0px;
		margin-top: -14px;
		min-height: 20px;
	}
	</style>

<script type="text/javascript" src="<?php echo $sn2?>js/flext.js"></script>

<script type="text/javascript" src="<?php echo $sn2?>js/jquery/require.js" data-main="js/jquery/main.js?r=1"></script>	
	<?php

}//END MOOTOOLS


$LINK_COLOR_OPP=oppColour($LINK_COLOR);
$BG_IMAGE=str_replace("img/bgs/","http://crazyosito.com/bgs/",$BG_IMAGE);
?>
<style>
/*body {
	background: fixed;
	background-image: url('<?php echo $BG_IMAGE;?>');
}*/
<?php if($SERVER['ARCHIVO']!='login.php'){ ?>
.contenido_principal {
	border: 0 !important;
}
<?php } ?>
</style>
<?php
}
?>

</head>