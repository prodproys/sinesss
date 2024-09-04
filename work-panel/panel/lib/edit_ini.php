<?php //á





error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);



require_once( "util2.php" );



$vars=parse_ini_file("../config/config.ini",true); 

$size=0; foreach($vars as $aa){ foreach($aa as $bb){ $size++; } }



$config=implode("",file("../config/config.ini"));

//echo "<pre>"; print_r($vars); echo "</pre>";



$vars[$_POST['seccion']][$_POST['name']]=$_POST['value'];



write_php_ini($vars,"../config/config.ini");



$vars=parse_ini_file("../config/config.ini",true); 

$size2=0; foreach($vars as $aa){ foreach($aa as $bb){ $size2++; } }



//echo " $size2 < $size ";



if($size2<$size){



	$f1=fopen("../config/config.ini","w+");

	fwrite($f1,$config);

	fclose($f1); 



}



?>