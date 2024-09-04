<!DOCTYPE html>
<html lang="es">
<head>
<title><?php 
echo ( ($page_title)?$page_title." - ":mb_convert_case(str_replace("/"," : ",strip_tags($tbtitulo)),MB_CASE_TITLE, "UTF-8"). " - "  ) ;
echo $html_title;
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php

$theme_color=($vars['GENERAL']['theme_color'])?$vars['GENERAL']['theme_color']:"#000000";

?>
<meta name="theme-color" content="<?php echo $theme_color;?>" >
<meta name="msapplication-navbutton-color" content="<?php echo $theme_color;?>" >
<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $theme_color;?>" >
<meta name="apple-mobile-web-app-capable" content="yes" >
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" >
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

// $con_port=($_SERVER['SERVER_PORT'])?':'.$_SERVER['SERVER_PORT']:'';
// if(!(strpos($_SERVER['SCRIPT_NAME'], $DIR_CUSTOM)===false)){
// 	$sn=explode($DIR_CUSTOM,$_SERVER['SCRIPT_NAME']);
// 	$sn2="//".$_SERVER['SERVER_NAME'].$sn[0];
// } else {
// 	$sn=explode("/panel",$_SERVER['SCRIPT_NAME']);
// 	// $sn2="http://".$_SERVER['SERVER_NAME'].$con_port.$sn[0]."/panel/";
// 	$sn2="//".$_SERVER['SERVER_NAME'].$con_port."/sistemapanel/".$DIR_PATH."/panel/";
// }
$sn2=$SERVER['BASE'];
echo '<base href="'.$sn2.'" />';


$sn4="../../work-panel/public/";

// prin($PATH_CUSTOM.'../touch.json');
$Touch = json_decode(file($sn4.'../touch.json')[0],true)['v'];

// prin($Touch);
// prin($MEEE);

$needs=necesita_libs($MEEE);

//FAVICON
$favicon=($vars['GENERAL']['img_icono'])?$vars['GENERAL']['img_icono']:(($Local)?$sn4."img/local20.png":$sn4."img/remote1.ico"); ?>

<link rel="shortcut icon" href="<?php echo $favicon.'?r='.$Touch; ?>" />
<link rel="icon" sizes="192x192" href="" />
<?php

//MAIN LIBs
/*?><link href="<?php echo $sn2?>css/css.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css"/><?php
?><script type="text/javascript" src="<?php echo $sn2?>js/mootools-core-1.3.2-full-compat.js"></script><?php
?><script type="text/javascript" src="<?php echo $sn2?>js/mootools-more-1.3.2.1.js"></script><?php
?><script type="text/javascript" src="<?php echo $sn2?>js/js.js?r=<?php echo $Touch;?>"></script><?php
*/
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- <link href="<?php echo $sn4?>css/vendor/bootstrap.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<!-- <link href="<?php echo $sn2?>css/bootstrap-responsive.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<!-- <link href="<?php echo $sn4?>/../../../sines/panel_trash/css/material.min.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<!-- <link href="<?php echo $sn4?>/../../../sines/panel_trash/css/flat-ui.min.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<!-- <link href="<?php echo $sn2?>css/docs.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->

<link href="<?php echo $sn4?>css/css.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $sn2?>/public/css/custom.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" />

<?php
?>
<!-- <link href="<?php echo $sn2?>config/main.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo $sn4?>css/vendor/css_print.css?r=<?php echo $Touch;?>" rel="stylesheet" type="text/css" media="print" />
<?php



if($JAVASCRIPT_FRAMEWORK=="jquery")
{ //JQUERY
	?>

	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

	<script src="../js/plugins.js"></script>
	<script src="../js/vendor/bootstrap.min.js"></script>
	<script src="../js/main.js"></script> -->

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
			src="<?php echo $sn4?>js/vendor/mootools-core-1.4.2-full-compat-yc.js"></script>
		<?php
		?>
		<script type="text/javascript"
			src="<?php echo $sn4?>js/vendor/mootools-more-1.4.0.1.js"></script>
		<?php
		?>
		<script type="text/javascript"
			src="<?php echo $sn4?>js/vendor/js.js?r=<?php echo $Touch;?>"></script>
		<?php


		//swfobject.js
		if(1){
		?>
		<script type="text/javascript" src="<?php echo $sn4?>js/vendor/swfobject.js"></script>
		<?php
		}

		//Meio.Autocomplete.js
		if(1){
		?>
		<script type="text/javascript"
			src="<?php echo $sn4?>js/vendor/Meio.Autocomplete.js"></script>
		<?php
		/*?><script type="text/javascript" src="<?php echo $sn4?>js/vendor/HashListener.js"></script><?php*/
		/*?><script type="text/javascript" src="<?php echo $sn4?>js/vendor/HistoryManager.js"></script><?php*/
		/* ?><link type="text/css" rel="stylesheet" href="<?php echo $sn4?>css/multiBox.css" /><?php */
		}
		//LIGHTSHOW
		$needs['img']=1;
		if($needs['img']){
		?>
		<script type="text/javascript"
			src="<?php echo $sn4?>js/vendor/_class.noobSlide.packed.js"></script>
		<?php
		?>
		<script type="text/javascript" src="<?php echo $sn4?>js/vendor/overlay.js"></script>
		<?php
		?>
		<script type="text/javascript" src="<?php echo $sn4?>js/vendor/multiBox.js"></script>
		<?php
		?>
		<link type="text/css" rel="stylesheet"
			href="<?php echo $sn4?>css/vendor/multiBox.css" />
		<?php
		}

		// prin($needs);
		//EDIT HTML
		//if(1){
		if($needs['html'] or $SERVER['ARCHIVO_REAL']=='pop.php'){

		?><script type="text/javascript" src="<?php echo $sn4?>js/vendor/ckeditor/ckeditor.js?r=<?php echo $Touch;?>"></script><?php	

		/*
		?><link rel="stylesheet" type="text/css" href="<?php echo $sn4?>css/MooEditable.css"><?php
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
			href="<?php echo $sn4?>css/vendor/MooTooltips.css">
		<?php
		?>
		<script type="text/javascript" src="<?php echo $sn4?>js/vendor/MooTooltips.js"></script>
		<style>
		.ToolTips .message {
			margin-bottom: 0px;
			margin-top: -14px;
			min-height: 20px;
		}
		</style>

	<script type="text/javascript" src="<?php echo $sn4?>js/vendor/flext.js"></script>

		<?php

}//END MOOTOOLS



$LINK_COLOR_OPP=oppColour($LINK_COLOR);
$BG_IMAGE=str_replace("img/bgs/","http://crazyosito.com/bgs/",$BG_IMAGE);
?>

<script type="text/javascript" src="<?php echo $sn4?>js/bundle.js?r=<?php echo $Touch;?>"></script>	
<script>
	var theme= '<?php echo ($_COOKIE['dark'])?'dark':'light'; ?>';
</script>
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
<?php
