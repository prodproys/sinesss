<?php
// $_POST=[
// 	'nombre'=> '06775693',
// 	'password'=> 'almita',
// 	'v_o'=> 'USUARIOS_ACCESO',
// ];
// $_REQUEST=array_merge($_GET,$_POST);
@session_start(); // Iniciar variables de sesión

include_once("lib/global.php");	
include_once("lib/conexion.php");
include_once("lib/mysql3.php");
include_once("lib/util2.php");
if($vars['GENERAL']['esclavo']!='1'){	
	include_once($PATH_CUSTOM."config/tablas.php");
}

//var_dump($vars);

//	prin($_GET);

if(!$_REQUEST['v_o']){
	foreach($objeto_tabla as $oott1=>$oott){
		if($oott['tabla']==$_REQUEST['v_t']){
			$_REQUEST['v_o']=$oott1; continue;
		}
	}
}

$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_REQUEST['v_o']]);
$tbl		=	$datos_tabla['tabla'];
$tbcampos	=	$datos_tabla['form'];
$id			=	$datos_tabla['id'];
$occ		=	$datos_tabla['oncreate'];
$oce		=	$datos_tabla['onedit'];
$psc		=	$datos_tabla['postscript'];
$id2	    =   trim(str_replace(array($id,"=","'","\"","where"),array("","","","",""),$_REQUEST['v_d']));
$update_fecha_creacion=true;

switch($_GET['f']){
	case "get_quick":

		$obj=$_REQUEST['v_o'];
		$excepciones=array();
		$excepciones=explode(";",$_REQUEST['exc']);
		//prin($datos_tabla['form']);
		foreach($datos_tabla['form'] as $lis){
			if(
					(in_array($lis['tipo'],array('inp','hid','fch','fcr','com')) and
							//(in_array($lis['tipo'],array('inp','hid','fch','fcr')) and
							(!in_array($lis['campo'],$excepciones)) and
							//($lis['listable']=='1') and
							(!enhay($lis['label'],'descripci',1)) and
							(!enhay($lis['label'],'source',1)) and
							(!enhay($lis['label'],'url',1)) and
							//($lis['campo']!='id_grupo') and
							//($lis['campo']!='id_subgrupo') and
							1
					)
			)
			{
				$campS[]=$lis['campo'];
				$labels[$lis['campo']]=str_replace(array('Teléfono'),array('tel'),$objeto_tabla[$obj]['campos'][$lis['campo']]['label']);
			}
		}
		//prin($campS);
		$campS2=$campS;
		//$campS2=array_merge(array($datos_tabla['id']),$campS2,array($campTitu));
		if(!in_array($datos_tabla['fcr'],$campS2)){
			$campS2=array_merge(array($datos_tabla['fcr']),$campS2);
		}

		$query_where="where ".$_REQUEST['v_d'];
		$items=select($campS2,
				$datos_tabla['tabla'],
				$query_where,0);

		$items2=$items;
		foreach($items as $lll=>$linea){

			foreach($campS as $camP){
				switch($objeto_tabla[$obj]['campos'][$camP]['tipo']){
					case "com":
						$valoor=$objeto_tabla[$obj]['campos'][$camP]['opciones'][$linea[$camP]];
						$items2[$lll][$camP]=$valoor;
						break;
					case "hid":
						list($primO,$tablaO)=explode("|",$objeto_tabla[$obj]['campos'][$camP]['opciones']);
						list($idO,$camposO)=explode(",",$primO);
						$camposOA=array();
						$camposOA=explode(";",$camposO);
						$bufy='';
						foreach($camposOA as $COA){
							$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$linea[$camP]."'")." ";
						}
						$items2[$lll][$camP]=$bufy;
						break;
					case "fcr":	case "fch":
						$fech=fecha_formato($linea[$camP],($objeto_tabla[$obj]['campos'][$camP]['formato'])?$objeto_tabla[$obj]['campos'][$camP]['formato']:'0b');
						$items2[$lll][$camP]=$fech;
						break;
				}
			}
		}

		foreach($labels as $cam=>$label){
			if(
					trim($objeto_tabla[$obj]['campos'][$cam]['label'])!='' and
					(trim($items2[0][$cam])!='' or $objeto_tabla[$obj]['campos'][$cam]['resaltar']=='1')
			){
				$Labels[]=array('label'=>$label,'value'=>$items2[0][$cam],'extraclass'=>(($objeto_tabla[$obj]['campos'][$cam]['resaltar']=='1')?'resaltar':''));
				//$Labels[]=array('label'=>$label,'value'=>$objeto_tabla[$obj]['campos'][$cam]['show_always']);
			}
		}
		$bloques=array_chunk($Labels,3);
		$html ='';
		$html.='<table class=tbltt><tr>';
		foreach($bloques as $bloque){
			$html.='<td valign=top><table>';
			foreach($bloque as $label){
				$html.='<tr><td class="labl " valign=top>'.$label['label'].'</td><td class=value>'.$label['value'].'</td></tr>';
			}
			$html.='</td></table>';
		}
		$html.='</tr></table>';
		echo $html;

		break;
	case "get_fila":

		//prin($objeto_tabla[$_REQUEST['v_o']]['campos']);

		foreach($objeto_tabla[$_REQUEST['v_o']]['campos'] as $tbcampA){
			if($tbcampA['tipo']=='img'){
				$get_imagenes[$tbcampA['campo'].'_get_archivo']=array('get_archivo'=>array(
						'carpeta'=>$tbcampA['carpeta']
						,'fecha'=>'{'.$datos_tabla['fcr'].'}'
						,'file'=>'{'.$tbcampA['campo'].'}'
						,'tamano'=>$tbcampA['tamano_listado']
				)
				);
			}
			$ttbb[]=$tbcampA['campo'];
		}
		//prin($ttbb);
		$item= select_fila(
				implode(",",$ttbb)
				,$tbl
				,str_replace("\'","'",$_REQUEST['v_d'])
				,$_GET['debug']
				,$get_imagenes
		);
		$item2=array();
		foreach($item as $cam=>$ite){
			if($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['constante']=='1' or 1){
				switch($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['tipo']){
					case "fch":	case "fcr":
						//$item2[$cam]=fecha_formato($ite,($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['formato'])?$objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['formato']:'0b');
						$item2[$cam]=$ite;
						break;
					case "html":
						$item2[$cam]=stripslashes($ite);
						break;
					case "hid":
						if($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['multi']=='1'){
							
							list($uno_pa,$campo_2,$dos_pa)=explode("|",$objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['opciones']);
							$campo_1=$objeto_tabla[$_REQUEST['v_o']]['tabla'];
							$rel_tabla="{$campo_1}_{$campo_2}";
							list($uno_rn,$vvi1,$dos_rn)=between($_REQUEST['v_d'],"='","'");

							$subtiems=implode(',',get_array('id_'.$campo_2,$rel_tabla,"where id_{$campo_1}='{$vvi1}'",0));
							
							$item2[$cam]=$subtiems;

						} elseif($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['constante']=='1'){
							
							list($primO,$tablaO)=explode("|",$objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['opciones']);
							list($idO,$camposO)=explode(",",$primO);
							$camposOA=array();
							$camposOA=explode(";",$camposO);
							$bufy='';
							foreach($camposOA as $COA){
								$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$ite."'")." ";
							}
							$item2[$cam]=$bufy;
						} else {
							
							$item2[$cam]=$ite;
							if($objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['directlink']!=''){
								$s1=explode("|",$objeto_tabla[$_REQUEST['v_o']]['campos'][$cam]['directlink']);
								$s2=explode(",",$s1['0']);
								$IdD=$s2['0'];
								$s3=explode(";",$s2['1']);
								$Fila=fila(array("CONCAT_WS(' ',".implode(",",$s3).") as v"),$s1['1'],"where $IdD='".$ite."'",0);
								$item2[$cam."_dl"]=$Fila['v'];
							}
						}
						break;
					default:
						$item2[$cam]=$ite;
						break;
				}
			} else {
				$item2[$cam]=$ite;
			}
		}


		$item=$item2;
		//prin($item);

		$json=json_encode($item);

		echo (substr($SERVER['browser'],0,2)=='IE')?str_replace("null","\"\"",$json):$json;

		break;
	case "remoto_get":

		$cc=array();
		$url_remoto=$_GET['url_remoto'];
		$_GET['f']=$_GET['f_2'];
		unset($_GET['f_2']);
		unset($_GET['url_remoto']);
		foreach($_GET as $aa=>$bb){
			$cc[]="$aa=".nl2br($bb);
		}

		//		echo $url_remoto."?".implode("&",$cc);
		echo file_get_contents($url_remoto."?".implode("&",$cc));

		break;
	case "insert_get":

		foreach($_GET as $c=>$v){
			if(substr($c,0,5)=='post_'){
				switch($tipo_){
					case "yot": $array[substr($c,5)]=get_youtube_code($v); break;
					default: 	$array[substr($c,5)]=$v; break;
				}
			}
		}



		$ret=insert($array,$tbl,$_GET['debug']);

		if(!(strpos($ret['error'],"Duplicate")===false)){

			$rr=explode("for key",str_replace("Duplicate entry","",$ret['error']));
			$ret['error']="ya existe ".trim($rr[0]);

		}

		echo json_encode($ret);

		switch($_REQUEST['v_o']){
			case "FEEDBACK":
				include("feedback.php");
				break;
		}

		break;
	case "insert":

		$imagenes=array();
		$ficheros=array();
		foreach($_POST as $c=>$v){
			if($c!='v_t' and $c!='v_o'){
				if(substr($c,0,7)=='tempar_'){
					if(trim($v)!=''){
						list($tabla,$campo,$valor)=explode("|",$v);
						$parents[]=array('t'=>$tabla,'c'=>$campo,'v'=>$valor);
					}
				} elseif(substr($c,0,10)=='stoupload_'){
					if(trim($v)!=''){
						$ficheros[]=array($c,$v,$tbl,$_POST['v_o']);
					}
				} elseif(substr($c,0,7)=='upload_'){
					if(trim($v)!=''){
						$imagenes[]=array($c,$v,$tbl,$_POST['v_o']);
					}
				} elseif($objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['multi']=='1'){
				
					list($uno_pa,$campo_2,$dos_pa)=explode("|",$objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['opciones']);
					$campo_1=$objeto_tabla[$_REQUEST['v_o']]['tabla'];
					$rel_tabla="{$campo_1}_{$campo_2}";
					
					$vvs=explode(',',$v);

					foreach($vvs as $vvi2){

						$relaciones[]=[
							'tabla'=>$rel_tabla,
							'c1'=>'id_'.$campo_1,
							'c2'=>'id_'.$campo_2,
							'v2'=>$vvi2,
						];

					}
						
				} else {
					unset($tipo_);
					foreach($tbcampos as $cam){
						if( $cam['campo']==$c ){
							$tipo_=$cam['tipo']; continue;
						}
					}
					switch($tipo_){
						case "yot": $array[$c]=get_youtube_code($v); break;
						default:
							$vv=removeemptytags($v);
							$array[$c]=($vv=='')?'NULL':$vv;
							break;
					}
				}
			}
		}
		$ret=insert($array,$tbl,$_GET['debug']);
		if($ret['success']){
			if($_GET['parent']){
				$oyu=$objeto_tabla[$_GET['parent']];
				foreach($oyu['campos'] as $campos){
					if(enhay($campos['opciones'],"|".$tbl) or enhay($campos['directlink'],"|".$tbl)){
						$campux=$campos['campo'];

						list($primO,$tablaO)=explode("|",($campos['directlink'])?$campos['directlink']:$campos['opciones']);
						list($idO,$camposO)=explode(",",$primO);
						$camposOA=array();
						$camposOA=explode(";",$camposO);
						$bufy='';
						foreach($camposOA as $COA){
							$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$ret['id']."'")." ";
						}
						$ret['nombre']=$bufy;


					}
				}
			}
			$id=$ret['id'];
			foreach($imagenes as $i=>$imas){
				//			echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id;
				grabar_imagen($imas[0],$imas[1],$imas[2],$imas[3],$id);
			}
			foreach($ficheros as $i=>$imas){
				//				echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id;
				grabar_fichero($imas[0],$imas[1],$imas[2],$imas[3],$id);
			}
			foreach($parents as $i=>$pare){
				//			echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id;
				update(array($pare['c']=>$id),$pare['t'],"where ".$pare['c']."='".$pare['v']."'");
			}
			foreach($relaciones as $rela){
				insert([
					$rela['c1']=>$id,
					$rela['c2']=>$rela['v2'],
				],$rela['tabla'],0);
			}			
		}

		if(!(strpos($ret['error'],"Duplicate")===false)){

			$rr=explode("for key",str_replace("Duplicate entry","",$ret['error']));
			$ret['error']="ya existe ".trim($rr[0]);

		}
		$url=$SERVER['BASE'].$occ."?id=".$ret['id']."&v_o=".$_REQUEST['v_o']."&".http_build_query($_SESSION);
		if($occ!=''){
			if(file_exists($occ)){
				$ret['oncreate']="1"; $ret['create']=file_get_contents($url); $ret['url']=$url;
			}
		}
		$id2=stripslashes($id);

		if($psc!=''){
			$iii=$ret['id'];
			include("postscript.php");
		}

		update_tags($objeto_tabla[$_REQUEST['v_o']],$id);

		update_chains($objeto_tabla[$_REQUEST['v_o']],$id);

		update_syncs($objeto_tabla[$_REQUEST['v_o']],$id);

		echo json_encode($ret);

		break;
	case "delete":

		eliminar_imagenes($datos_tabla,$_REQUEST['v_d']);

		if($psc!=''){
			$iii=trim(str_replace("'","",str_replace("where id=","",$_REQUEST['v_d'])));
			include("postscript.php");
		}

		$ret=delete($tbl,str_replace("\\'","'",$_REQUEST['v_d']),$_GET['debug']);

		foreach($objeto_tabla[$_REQUEST['v_o']]['campos'] as $vm){
			
			if($vm['multi']=='1'){
			
				list($uno_pa,$campo_2,$dos_pa)=explode("|",$vm['opciones']);
				$campo_1=$objeto_tabla[$_REQUEST['v_o']]['tabla'];
				list($uno_rn,$vvi1,$dos_rn)=between($_REQUEST['v_d'],"='","'");
				$rel_tabla="{$campo_1}_{$campo_2}";
				delete($rel_tabla,"where id_{$campo_1}='{$vvi1}'");
			
			}
		}

		echo json_encode($ret);

		break;
	case "updatemass":

		$imagenes=array();
		$ficheros=array();
		foreach($_POST as $c=>$v){
			if($objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['no_save']=='1'){
				continue;
			}
			if(substr($c,0,10)=='stoupload_'){
				if(trim($v)!=''){
					$ficheros[]=array($c,$v,$tbl,$_POST['v_o']);
				}
			} elseif(substr($c,0,7)=='upload_'){
				if(trim($v)!=''){
					$imagenes[]=array($c,$v,$tbl,$_POST['v_o']);
				}
			} else {
				if($c!='v_t' and $c!='v_d' and $c!='v_o'){
					$vv=removeemptytags($v);
					$array[$c]=($vv=='')?'NULL':$vv;
				}
			}
		}
		//echo "<pre>"; print_r($imagenes); echo "</pre>";
		//$_GET['debug']=1;
		$ret=update($array,$tbl,str_replace("\\'","'",$_REQUEST['v_d']),$_GET['debug']);
		/*
		foreach($imagenes as $i=>$imas){
			//echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id2;
			eliminar_imagenes($datos_tabla,$_REQUEST['v_d']);
			if($imas[1]=='eliminar'){
				update(array(str_replace("upload_","",$imas[0])=>'NULL'),$tbl,str_replace("\\'","'",$_REQUEST['v_d']),0);
			} else {
				grabar_imagen($imas[0],$imas[1],$imas[2],$imas[3],str_replace("\\","",$id2));
				//prin($imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".str_replace("\\","",$id2));
			}
		}
		foreach($ficheros as $i=>$imas){
			//echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id2;
			//eliminar_ficheros($datos_tabla,$_REQUEST['v_d']);
			if($imas[1]=='eliminar'){
				update(array(str_replace("stoupload_","",$imas[0])=>'NULL'),$tbl,str_replace("\\'","'",$_REQUEST['v_d']),0);
			} else {
				grabar_fichero($imas[0],$imas[1],$imas[2],$imas[3],str_replace("\\","",$id2));
				//prin($imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".str_replace("\\","",$id2));
			}
		}

		if(!(strpos($ret['error'],"Duplicate")===false)){

			$rr=explode("for key",str_replace("Duplicate entry","",$ret['error']));
			$ret['error']="ya existe ".trim($rr[0]);

		}
		*/
		$url=$SERVER['BASE'].$oce."?".trim(str_replace(array("where ","'"," in ","(",")"),array("","","=","",""),$_REQUEST['v_d']))."&v_o=".$_REQUEST['v_o']."&".http_build_query($_SESSION);
		if($oce!=''){
			if(file_exists($oce)){
				$ret['onedit']="1"; $ret['edit']=file_get_contents($url); $ret['url']=$url;
			}
		}
		$id2=stripslashes($id2);

		if($psc!='')
		{
			$iii=trim(str_replace(array("id","where ","'"," in ","(",")"),array("","","=","",""),$_REQUEST['v_d']));
			include("postscript.php");
		}

		//update_tags($objeto_tabla[$_REQUEST['v_o']],$id2);

		//update_chains($objeto_tabla[$_REQUEST['v_o']],$id2);

		//update_syncs($objeto_tabla[$_REQUEST['v_o']],$id2);

		$ret['update']='1';
		echo json_encode($ret);

		break;
	case "update":

		$predirtren=dato("fecha_creacion",$tbl,str_replace("\\'","'",$_REQUEST['v_d']));
		$dirtren=substr($predirtren,0,4).substr($predirtren,5,2).substr($predirtren,8,2);

		$update_fecha_creacion=false;

		$imagenes=array();
		$ficheros=array();
		foreach($_POST as $c=>$v){

			if($objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['no_save']=='1'){
				continue;
			}
			if(substr($c,0,10)=='stoupload_'){
				if(trim($v)!=''){
					$ficheros[]=array($c,$v,$tbl,$_POST['v_o']);
				}
			} elseif(substr($c,0,7)=='upload_'){
				if(trim($v)!=''){
					$imagenes[]=array($c,$v,$tbl,$_POST['v_o']);
				}
			} elseif($objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['multi']=='1'){
				
				list($uno_pa,$campo_2,$dos_pa)=explode("|",$objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['opciones']);
				$campo_1=$objeto_tabla[$_REQUEST['v_o']]['tabla'];
				$rel_tabla="{$campo_1}_{$campo_2}";
				list($uno_rn,$vvi1,$dos_rn)=between($_REQUEST['v_d'],"='","'");
				
				delete($rel_tabla,"where id_{$campo_1}='{$vvi1}'",0);

				$vvs=explode(',',$v);
				foreach($vvs as $vvi2){
					insert([
						'id_'.$campo_1=>$vvi1,
						'id_'.$campo_2=>$vvi2,
					],$rel_tabla,0);
				}

			} else {
				if($c!='v_t' and $c!='v_d' and $c!='v_o'){
					$vv=removeemptytags($v);

					if($objeto_tabla[$_REQUEST['v_o']]['campos'][$c]['format']=='currency'){
						$array[$c]=($vv=='')?'NULL':str_replace(",", "", $vv);
					} else {
						$array[$c]=($vv=='')?'NULL':$vv;						
					}

				}
			}
		}

		$ret=update($array,$tbl,str_replace("\\'","'",$_REQUEST['v_d']),$_GET['debug']);

		//! IMAGENES
		foreach($imagenes as $i=>$imas){
			//echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id2;
			
			// eliminar_imagenes($datos_tabla,$_REQUEST['v_d']);
			if($imas[1]=='eliminar'){
				update(array(str_replace("upload_","",$imas[0])=>'NULL'),$tbl,str_replace("\\'","'",$_REQUEST['v_d']),0);
			} else {
				grabar_imagen($imas[0],$imas[1],$imas[2],$imas[3],str_replace("\\","",$id2));
				//prin($imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".str_replace("\\","",$id2));
			}
		}

		//! FICHEROS
		foreach($ficheros as $i=>$imas){
			//echo $imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".$id2;
			//eliminar_ficheros($datos_tabla,$_REQUEST['v_d']);
			if($imas[1]=='eliminar'){
				update(array(str_replace("stoupload_","",$imas[0])=>'NULL'),$tbl,str_replace("\\'","'",$_REQUEST['v_d']),0);
			} else {
				grabar_fichero($imas[0],$imas[1],$imas[2],$imas[3],str_replace("\\","",$id2));
				//prin($imas[0].",".$imas[1].",".$imas[2].",".$imas[3].",".str_replace("\\","",$id2));
			}
		}

		if(!(strpos($ret['error'],"Duplicate")===false)){

			$rr=explode("for key",str_replace("Duplicate entry","",$ret['error']));
			$ret['error']="ya existe ".trim($rr[0]);

		}

		$url=$SERVER['BASE'].$oce."?".trim(str_replace(array("where ","'"),array("",""),$_REQUEST['v_d']))."&v_o=".$_REQUEST['v_o']."&".http_build_query($_SESSION);
		if($oce!=''){
			if(file_exists($oce)){
				$ret['onedit']="1"; $ret['edit']=file_get_contents($url); $ret['url']=$url;
			}
		}
		$id2=stripslashes($id2);

		if($psc!=''){
			$iii=trim(str_replace("'","",str_replace("where id=","",$_REQUEST['v_d'])));
			include("postscript.php");
		}

		update_tags($objeto_tabla[$_REQUEST['v_o']],$id2);

		update_chains($objeto_tabla[$_REQUEST['v_o']],$id2);

		update_syncs($objeto_tabla[$_REQUEST['v_o']],$id2);

		$ret['update']='1';
		echo json_encode($ret);

		break;
	case "login":

		$id					=	$datos_tabla['id'];
		$sesion_password	=	$datos_tabla['sesion_password'];
		$sesion_login		=	$datos_tabla['sesion_login'];
		$sesion_vis			=	($datos_tabla['vis']=='')?"":" and ".$datos_tabla['vis']."='1' ";

		$_POST[$sesion_login]	=	str_replace(array("'","=","\""),array(""),$_POST[$sesion_login]);
		$_POST[$sesion_password]=	str_replace(array("'","=","\""),array(""),$_POST[$sesion_password]);

		$return = select_dato(
				$id,
				$tbl,
				"where $sesion_login='".$_POST[$sesion_login]."' and $sesion_password='".$_POST[$sesion_password]."' $sesion_vis "
				,0
		);

		//echo $return;


		if($return != false){

			$_SESSION['usuario_id']=$return;
			if($_GET['forge']=='1'){
				setcookie("admin", "", time()+24*3600);
			}
			$_SESSION['usuario_datos_id']='';
			$_SESSION['usuario_datos_nombre']='';
			$_SESSION['usuario_datos_nombre_grupo']='';

			$_SESSION['page']='';
			$_SESSION['web']='';

			if($vars['GENERAL']['COOKIE_LOGIN']){
			setcookie("c_usuario", $_POST[$sesion_login], time() + (14*24*60*60), "/");
			setcookie("c_password", $_POST[$sesion_password], time() + (14*24*60*60), "/");
			}
			echo $return;

		}


		break;
	case "resample":

		foreach($datos_tabla['imagenes'] as $imagen){

			$tamas=explode(",",$datos_tabla[$imagen]['tamanos']);

			$num_tamas=sizeof($tamas);
			$item=select_fila($datos_tabla['id'].",".$datos_tabla['fcr'].",".$datos_tabla['fed'].",".$imagen,$datos_tabla['tabla'],"where ".$datos_tabla['id']."='".$_GET['id']."'",0);

			$Original=str_replace('//','/',str_replace('_1.','.',get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],'1')));

			$Ima['original']=str_replace("//","/",$ftp_files_root.str_replace("$httpfiles","",str_replace('_1.','.',get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],1))));

			for($i=1;$i<=$num_tamas+1;$i++){
				$Ima[$i]=str_replace("//","/",$ftp_files_root.str_replace("$httpfiles","",get_imagen($datos_tabla[$imagen]['carpeta'],$item[$datos_tabla['fcr']],$item[$imagen],$i)));
			}

			grabar_imagen("upload_".$imagen,$Original,$datos_tabla['tabla'],$_GET['v_o'],str_replace("\\","",$item[$datos_tabla['id']]));
			$Imas[]=$Ima;
			eliminar_imagenes_from_array($Imas);
			unset($Ima);
			unset($Imas);

		}
		break;
}

// include("lib/compresionFinal.php");
?>