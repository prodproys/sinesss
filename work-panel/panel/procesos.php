<?php //á
?><div style="clear:left;">Procesos</div><?php

// include("lib/webutil.php");
require_once('lib/simple_html_dom.php');
chdir($PATH_CUSTOM."base2/procesos");

$urlpartes=explode("/",getcwd());

if(end($urlpartes)!='procesos'){

echo '<div class="alert alert-warning" style="clear:left;">falta crear la carpeta "procesos"</div>';

} else {

	set_time_limit(0);


	//leer directorio de procesos
	//leer formato de titulo y decripción
	// echo "no hay procesos";
	// echo getcwd();
	
	$dirs=array();
	$dires = dir(".");
	while($fichero=$dires->read()) {

		if(
			!in_array($fichero,array('.','..')) and
			!is_dir($fichero) and
			substr($fichero, -4,4)=='.php'
			)
		{
			$des=between(implode(file($fichero)),"/* !","! */");
			$dirs[$fichero]=array('name'=>$fichero,'desc'=>$des[1]);
		}

	}
	echo '<h3><a href="maquina.php?tab=procesos">Procesos</a></h3>';
	echo '<ul>';

	ksort($dirs);
	
	foreach($dirs as $arcv){

		$success=($_GET['proceso']==$arcv['name'])?'success':'info';
		$successS=($_GET['proceso']==$arcv['name'])?'green':'black';

		echo "<li class='".str_replace('.php','',$arcv['name'])."' style='margin-bottom:3px;'>";

			if($arcv['desc'])
				echo "<div class='alert alert-".$success."' style='font-size:14px;margin-bottom:0;'>".$arcv['desc']."</div>";

			echo "<a class='btn btn-".$success."' style='padding:8px 14px;font-size:17px;background:".$successS.";color:white' 
			href='maquina.php?tab=procesos&proceso=".$arcv['name']."'>".$arcv['name']."</a>";

		echo "</li>";

	}
	echo '</ul>';

	// prin($dirs);


	if($_GET['proceso']!=''){


		echo '<div style="clear:left;">';
		prin('inicio');
		echo '</div>';
		echo '<h1><a href="maquina.php?tab=procesos&proceso='.$_GET['proceso'].'" >'.$_GET['proceso'].'</a></h1>';

		include($_GET['proceso']);

		echo '<div style="clear:left;">';
		prin('fin');
		echo '</div>';


		echo "<br><br><br>";

	} 

}



