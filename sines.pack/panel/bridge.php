<?php
// echo '<pre>'; print_r($_SERVER); echo '</pre>';

$gparts=explode('/',$_SERVER['SCRIPT_NAME']);
$gparts=array_reverse($gparts);
$FILE_PATH='work_'.$gparts[0];

if(
	$_SERVER['SERVER_NAME']=='localhost' 
	or substr($_SERVER['SERVER_NAME'],0,9)=='192.168.0' 
	){


	$DIR_PATH=$gparts[2];

	$PATH_WORK_PANEL="../../work-panel/panel/";
	$PATH_CUSTOM="../../$DIR_PATH/panel/";
	$PATH_WORK_PANEL_li_tabla_classes=$PATH_WORK_PANEL;

	$IS_LOCAL=1;

} else {

	$DIR_PATH=$gparts[2];

	$PATH_WORK_PANEL="../work-panel/panel/";
	$PATH_CUSTOM="../../panel/";
	$PATH_WORK_PANEL_li_tabla_classes="../".$PATH_WORK_PANEL;

	$IS_LOCAL=0;

}

$_REQUEST=array_merge($_GET,$_POST);


// exit();