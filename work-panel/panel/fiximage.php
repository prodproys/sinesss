<?php


set_time_limit(0);
$time_start = microtime(true);

//error_reporting(E_ALL);
include("lib/global.php");
include("lib/conexion.php");
include("lib/mysql3.php");
include("lib/util2.php");
include("config/tablas.php");
//	include("lib/sesion.php");
include("lib/playmemory.php");

////////////////////////////////////////////////////////////////////////////////////////

$ftp_files_host=$vars['REMOTE_FTP']['ftp_files_host'];
$ftp_files_user=$vars['REMOTE_FTP']['ftp_files_user'];
$ftp_files_pass=$vars['REMOTE_FTP']['ftp_files_pass'];
$ftp_files_root=$vars['REMOTE_FTP']['ftp_files_root'];

$datos_tabla=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

$imagen=$datos_tabla['imagenes'][0];

$hay_fuente=(isset($objeto_tabla[$_GET['me']]['campos']['source']))?1:0;

$items=select((($hay_fuente)?'source,':'').$datos_tabla['id'].",".$datos_tabla['fcr'].",".$datos_tabla['fed'].",".$imagen,$datos_tabla['tabla'],"where id='".$_GET['id']."'",0);

	
foreach($items as $tt=>$item){

	if(1){

		foreach($datos_tabla['imagenes'] as $imagen){
				
			$tamas=explode(",",$datos_tabla[$imagen]['tamanos']);

			$num_tamas=sizeof($tamas);

			$borrar_despues=1;

			$Original=get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],'');
			$oo=fileExists($Original);
			if(!$oo or $item[$imagen]==''){
					
				$nt=$num_tamas-1;
				$Original=get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],$nt);
				$uu=fileExists($Original);
				if(!$uu or $item[$imagen]==''){
					if($hay_fuente){
						$Original=$item['source'];
						$ii=fileExists($Original);
						if(!$ii){
							exit();
						}
						else { $borrar_despues=0;
						}
					}
				} else { exit();
				}
			}

			for($i=1;$i<=$num_tamas+1;$i++){
				$Ima[$i]=str_replace("//","/",$ftp_files_root.str_replace("$httpfiles","",get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],$i)));
			}

			//echo "<div style='background-color:grey;color:white;'>resampling ".str_replace('_1.','.',get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],'1'))."</div>";

			$Ret = grabar_imagen("upload_".$imagen,$Original,$datos_tabla['tabla'],$_GET['me'],str_replace("\\","",$item[$datos_tabla['id']]));
			$Imas[]=$Ima;

			if($borrar_despues)
				eliminar_imagenes_from_array($Imas);

			unset($Ima);
			unset($Imas);

		}

	}

}



///////////////////////////////////////////////////////////////////////////////////////////


$all=procesar_objeto_tabla($objeto_tabla[$_GET['me']]);

foreach($all['imagenes'] as $imagen){

	$items=select($all['id'].",".$all['fcr'].",".$all['fed'].",".$imagen,$all['tabla'],"where id='".$_GET['id']."'",0);

	$tamas=explode(",",$all[$imagen]['tamanos']);
		
	$num_tamas=sizeof($tamas);
		
	foreach($items as $r=>$item){

		if($hay_fuente) $Ima['source']=$item['source'];
		//$Original=str_replace('_1.','.',get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],'1'));
		$Ima['original']=str_replace('_1.','.',get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],'1'));

		for($i=1;$i<=$num_tamas;$i++){
			$Ima[$i]=get_imagen($all[$imagen]['carpeta'],$item[$all['fcr']],$item[$imagen],$i);
		}
		//prin($Original);
		//echo "update $Original<br>";
		//prin($imagen.",".$Original.",".$all['tabla'].",".$_GET['me'].",".str_replace("\\","",$item[$all['id']])."<br>");

		//prin($Ima);
		$Imas[$item[$all['id']]]=array('imagenes'=>$Ima,'file'=>select_dato($imagen,$all['tabla'],"where id='".$_GET['id']."'",0));
		unset($Ima);
			
			
	}
	$tamas=array_merge(array("original"),$tamas);

	foreach($Imas as $r=>$Imas2){
		echo "<td valign=middle >$r</td>";
		foreach($Imas2['imagenes'] as $ro=>$II){

			if($_GET['verificar']=='1'){
				list($ancho, $alto, $tipo, $atributos) = getimagesize($II);
				if($ro==0){
					$anchoOriginal=$ancho;	$altoOriginal =$alto; $chek="#FFF"; $bordeco="#000";
				}
				else {
					$bordeco="#FFF";
					list($an,$al)=explode("x",$tamas[$ro]);
					if(
							//	($anchoOriginal>$an and $altoOriginal>$al) and
							($an==$ancho or $al==$alto)
					){
						$chek='#C2F1BF';
					} else { $chek='#C6795D';
					}
				}
			}
			echo "<td style='background-color:$chek;' valign=middle >";
			if($_GET['verificar']=='1'){
				if($chek!="#FFF"){
					echo "<div><b>".$ancho."x".$alto."</b> en ".$an."x".$al."</div>";
				} else {
					echo "<div>".$ancho."x".$alto."</div>";
				}
			}
			if($ro=='source'){
				echo $II;
			}else{
				echo "<img src='".$II."'>";
			}
			echo "</td>";
		}

		$time_end = microtime(true);
		$time = $time_end - $time_start;

		echo "<td valign=middle><div style='font-weight:normal;'>". (($Ret)?number_format($time,2).'s':'ko') ."</div><a href='#' onclick=\"fiximage('$r'); return false;\"
		".(($Imas2['file']=='')?" class='forimport' rel='$r' ":'')."
				>".(($Imas2['file']=='')?'import':'fix')."</a></td>";

		echo "<td valign=middle><a href='#' onclick=\"delimage('$r'); return false;\"
		>x</a></td>";

	}

}





?>