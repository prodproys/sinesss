<?php //á

set_time_limit(0);
//error_reporting(E_ALL);
	include("lib/global.php");	
	include("lib/conexion.php");
	include("lib/mysql3.php");
	include("lib/util2.php");	
	include("config/tablas.php");
//	include("lib/sesion.php");	
	include("lib/playmemory.php");


if($_POST['valor']=='borrararchivo'){
	@unlink($DIR_CUSTOM.$_POST['me'].".php");
	@unlink($DIR_CUSTOM.$_POST['me']."_vista.php");
	exit();
} elseif($_POST['valor']=='borrartabla'){
	mysqli_query($link,"DROP TABLE `".$_POST['me']."`;");
	// echo "eliminando ".$_POST['me'];
	exit();
}

$comandos=$COMANDOS_OBJETO;


$objeto_tabla=reorder_objeto($objeto_tabla);

$objeto_tabla=fix_objeto($objeto_tabla);
							
/*
$_POST['me']='USUARIOS_ACCESO';
*/
/*
$_POST['json']="
usuarios_publicos(usuarios,usuario):{items:{
sueldo|v:inp
}
},
grupos(categorías,categoría):{campos:{
distrito|v:inp
}},
package(paquetes):{combo:[grupos,sub,items,fot]},
productos_grupos|productos_subgrupos:grupos,
productos_subgrupos|productos_items:sub,
productos_items|productos_fotos:{items:{
distrito|v:inp
}
},
productos_fotos:fot
";

$_POST['json']="
package(paquetes):{combo:[grupos,sub,items,fot]},
productos_grupos|productos_subgrupos:grupos,
productos_subgrupos|productos_items:sub,
productos_items|productos_fotos:items,
productos_fotos:fot
";
$_POST['json']="
pedidos:del
";
$_POST['json']="
objetos:{after:'paginas'}
";
$_POST['indice']='jsonproy';
*/

if($_POST['me']=='' and $_POST['indice']=='jsonproy'){

	$json = json_decode_nice($_POST['json']);
	//prin($json);
	$objeto_tabla=procesarproyecto($objeto_tabla,$json); 
	//prin($json);
} else {

$ME=$_POST['me'];

if($_POST['indice']=='json'){

	$json = json_decode_nice($_POST['json']);
	
	$objeto_tabla_me = $objeto_tabla[$ME];
	
	$prefijo=$objeto_tabla[$ME]['prefijo'];
	
	$objeto_tabla[$ME]=procesarcampos($json,$objeto_tabla_me);  
	
} elseif($_POST['indice']=='campos'){

	//campos
	if(trim($_POST['variable'])==''){
		if($_POST['valor']=='destroy'){
			//borrar un campo			
			unset($objeto_tabla[$ME]['campos'][$_POST['campo']]);//
		} else {
			//editar un campo [aun no se usa]
			$objeto_tabla[$ME]['campos'][$_POST['campo']][$_POST['variable']]=$_POST['valor'];
		}	
	} else {
		if($_POST['valor']=='destroy'){
			//borrar una propiedad de campo				
			unset($objeto_tabla[$ME]['campos'][$_POST['campo']][$_POST['variable']]);//
		} else {
			//editar una propiedad de campo		
			$objeto_tabla[$ME]['campos'][$_POST['campo']][$_POST['variable']]=$_POST['valor'];//
		}
	}
	
} else {
	if($_POST['valor']=='destroyobjeto'){
		//borrar objeto
		unset($objeto_tabla[$ME]);		
	//propiedades
	} elseif($_POST['valor']=='destroy'){
		//borrar una propiedad
		unset($objeto_tabla[$ME][$_POST['indice']]);
	} else {
		//editar una propiedad
		$objeto_tabla[$ME][$_POST['indice']]=$_POST['valor'];
	}
	
}

}


if((trim($_POST['indice'])!='')  or ($_POST['valor']=='destroyobjeto')){

	$objeto_tabla=reorder_objeto($objeto_tabla);
	
	$f1=fopen("config/tablas.php","w+");
	fwrite($f1,"<?php //á\n\n".render_array($objeto_tabla)."\n\n?>");
	fclose($f1); 

}


	function json_decode_nice($json){

	global $comandos;

	$json = preg_replace("/(\s)(del|grupos|sub|items|fot)$/",":$2",$json);
	$json = preg_replace("/(\s)(del|grupos|sub|items|fot)(,?)\n/",":$2,\n",$json);	
	$json = preg_replace("/(\s)(ren|group|after)(\s)([0-9a-zA-Z\_\-]{2,10})$/",":$2:$4",$json);
	$json = preg_replace("/(\s)(ren|group|after)(\s)([0-9a-zA-Z\_\-]{2,10})(,?)\n/",":$2:$4,\n",$json);
	//prin($json);
	if(enhay($json,"(")){
	   $jp=between($json,"(",")");
	   $json=$jp[0]."(".str_replace(",","#",$jp[1]).")".$jp[2];
	}

	   $json2=array();
	   $jsonB=array();
	
       $json=trim($json);
	   
	   $jsonA=explode("\n",$json);
	   foreach($jsonA as $jnx){
	   		$holas=explode(":",$jnx);
	   	    if(!strpos($jnx,",")===false){
		   		$jnx2=array();
				$holases=explode(",",$holas[0]);
				$resto=substr($jnx,strlen($holas[0]));
				foreach($holases as $holax){
					$jnx2[]=$holax.$resto;
				}
				$jnx=implode(",\n",$jnx2);
				unset($jnx2);
			}
			$jnx=preg_replace("/,$/","",$jnx);
			$jsonB[]=$jnx;
	   }
	   $jsonA=$jsonB;
	   $jsonB=array();
	   foreach($jsonA as $jnx){	   
	   	    
	   	   if(!strpos($jnx,":group:")===false){
				$jnx=str_replace(array("\"","'"),array("",""),$jnx);
				list($uno,$dos)=explode(":group:",$jnx);
				$jnx='"'.$uno.'":{group:"'.$dos.'"}';
		   } elseif(!strpos($jnx,":after:")===false){
				$jnx=str_replace(array("\"","'"),array("",""),$jnx);
				list($uno,$dos)=explode(":after:",$jnx);
				$jnx='"'.$uno.'":{after:"'.$dos.'"}';
		   } elseif(!strpos($jnx,":ren:")===false){
				$jnx=str_replace(array("\"","'"),array("",""),$jnx);		   
				list($uno,$dos)=explode(":ren:",$jnx);
				$jnx='"$uno":{ren:"$dos"}';
		   } /*elseif(!strpos($jnx,":ren:")===false){
				$jnx=str_replace(array("\"","'"),array("",""),$jnx);		   
				list($uno,$dos)=explode(":fech:",$jnx);
				$jnx='"$uno":{fech:"$dos"}';
		   }*/ 

			$jsonB[]=$jnx;
				   		   		   
	   }

	   
	   $json=implode("\n",$jsonB);
	   $json=str_replace("'","\"",$json);
	   $jsonl=explode("\n",$json);
	   foreach($jsonl as $jn){	   
		   if(!strpos($jn,"[")===false){
			   $tap=between($jn,"[","]");
			   $tapp2=explode(",",str_replace("\"","",$tap[1]));
			   foreach($tapp2 as $tapp3){
				   $tapp4[]="\"".$tapp3."\"";
			   }
			   unset($tapp2);
			   $tap[1]="[". ( implode(",",$tapp4) )."]";
			   unset($tapp4);
			   $json2[]=$tap[0].$tap[1].$tap[2];
			   
		   } else {
		   		$json2[]=$jn;
		   }
	   }
	   
	   $json=implode("\n",$json2);
   	   

	   foreach($comandos as $com){
	   		$json=str_replace(":$com",":\"$com\"",$json);
	   }
	   
	   $json="{".str_replace(
							array(
								"\"opc\":"
							),
							array(
								"\"opc\":"
							),
							$json
						)."}";

		$json = str_replace(array("\n","\r"),"",$json);
		$json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$json);

	   $json=str_replace(",,","",$json);	   

	   $json=preg_replace('/,\s*([\]}])/m', '$1', $json);

	   $return=json_decode($json,true);
	   
	   if(sizeof($return)=='0'){ echo "error de sintaxis\n\n".$json; }
	   
	   return $return;
		
	}
	
	
	
	function preprocess($nombre){
	
   		$campo=str_replace(" ","_",$nombre);
   		$campo=strtolower(str_replace(
										array("á","é","í","ó","ú","_de_","_para_","_a_","_por_"),
										array("a","e","i","o","u","_","_","_","_"),
										$campo
									));
		return $campo;								
	}

	function procesarproyecto($objeto_tabla,$json){		

	   global $prefijo;
				
	   $withForm=750;
	   $FormLeft=110;
	   $FormRight=$withForm-$FormLeft;
	   
	   foreach($json as $objeto=>$data){
			//die($objeto);
			list($nombre,$hijo)=explode("|",$objeto);
			
			$nombres=between($nombre,"(",")");
	   			
	        $obj=preprocess($nombres[0]);

	        $objhijo=preprocess($hijo);
		   
		    $tipo = (is_array($data))?key($data):$data;
						
			list($plural,$singular)=(!empty($nombres[1]))?explode("#",$nombres[1]):$nombres[0];
			
			$plural=($plural!='')?$plural:end(explode(";",$obj));
			
			if($singular==''){
				if(substr($plural,-1)=='s'){ $singular=substr($plural,0,-1); }
				else{ $singular=$plural; }
			}
			
			$parts=explode("_",$obj);
			$prefijo=substr($parts[0],0,3).substr($parts[1],0,3);
			
			$titulo=$plural;
			
			$MEME=strtoupper($obj);
					
			$pre['me']	  			=$MEME;
			$pre['titulo']			=ucfirst($titulo);			
			$pre['nombre_singular'] =$singular;
			$pre['nombre_plural'] 	=$plural;
			$pre['tabla'] 			=$obj;
			$pre['archivo']			=$obj;
			if($objhijo){$pre['archivo_hijo']=$objhijo;}
			$pre['prefijo']			=$prefijo;
			$pre['eliminar']		='1';
			$pre['editar']			='1';
			$pre['edicion_rapida']	='1';
			$pre['edicion_completa']='1';
			$pre['crear']			='1';
			$pre['visibilidad']		='1';		
			$pre['calificacion']	='1';		
			$pre['visibilidad']		='1';
			$pre['buscar']			='1';
			$pre['bloqueado']		='0';
			$pre['menu']			='1';
			$pre['menu_label']		=ucfirst($plural);
			$pre['por_pagina']		='50';
			$pre['orden']			='0';
			$pre['crear_label'] 	=$FormLeft.'px';
			$pre['crear_txt']		=$FormRight.'px';
			$pre['altura_listado']	='auto';
			
			$pre['campos']=array('id'			 =>array('campo'=>'id','tipo'=>'id'),
								 'fecha_creacion'=>array('campo'=>'fecha_creacion','tipo'=>'fcr'),
								 'fecha_edicion' =>array('campo'=>'fecha_edicion','tipo'=>'fed'),
								 'posicion'		 =>array('campo'=>'posicion','tipo'=>'pos'),
								 'visibilidad'	 =>array('campo'=>'visibilidad','tipo'=>'vis'),
								 'calificacion'	 =>array('campo'=>'calificacion','tipo'=>'cal'));
			
			/*
			$pre['campos']=array('id_grupo'		 =>array(
													'campo'=>'id_grupo',
													'label'=>'Grupo',
													'tipo'=>'hid',
													'listable'=>'0',
													'validacion'=>'1',
													'default'=>'[id]',
													'foreig'=>'1',
													'opciones'=>'id,nombre|emails_grupos',
													'foreigkey'=>'PRODUCTOS_GRUPOS'													
													)
												);
												
			$pre['campos']=array('id_grupo'		 =>array(
													'campo'=>'id_grupo',
													'tipo'=>'hid',
													'listable'=>'0',
													'validacion'=>'1',
													'default'=>'[id]',
													'foreig'=>'1',
													'foreigkey'=>'PRODUCTOS_GRUPOS'
													),
												);												
												
			*/
                 		// relacion con la tabla grupos

							
			switch($tipo){
				//tipos de objetos
				case "grupos": case "sub":
				$pre2=procesarcampos(array('nombre|lvu'=>"inp"));
				$prex['tipo']=$tipo;
				break;				
				case "items":
				$pre2=procesarcampos(array('nombre|lvu'=>"inp"));
				$prex['tipo']=$tipo;
				break;
				case "fot":
				$pre2=procesarcampos(array(
										'file|lv'=>"fot",
										'descripcion'=>"long"
										));
				$prex['tipo']=$tipo;
				break;	
				case "vid":
				$pre2=procesarcampos(array(
										'file|lv'=>"vid",
										'descripcion'=>"long"
										));
				$prex['tipo']=$tipo;
				break;						
				case "campos":
				$pre2=array('campos'=>array());
				$prex['tipo']=$tipo;
				break;
			
				//controles
				case "del":
					$prex['tipo']='del';					
				break;	
				case "ren":
					$prex['tipo'] ='ren';
					$prex['camp'] =strtoupper(preprocess($data['ren']));
					$prex['camp2']=ucfirst($data['ren']);
				break;
				case "after":
					$prex['tipo']='after';
					$prex['camp']=strtoupper($data['after']);
				break;	
				case "group":
					$prex['tipo']='group';
					$prex['group']=$data['group'];
				break;					
						
			}
			
			$pre3=array('campos'=>array());
			
			if(is_array($data[$tipo])){ $pre3=procesarcampos($data[$tipo]); }				 			

			$pre['campos']=array_merge($pre['campos'],$pre2['campos'],$pre3['campos']);
					
			
			if(!isset($prex['tipo'])){ continue; }
			/*
			if($set['v']){ $pre['validacion']='1'; }
			if($set['u']){ $pre['unique']='1'; }
			if($set['l']){ $pre['listable']='1'; }
			unset($set);
			*/

			if(isset($objeto_tabla[$MEME])){

				if($prex['tipo']=='after'){		
					$temp=$objeto_tabla[$MEME];
					$tempobjeto=array();
					foreach($objeto_tabla as $camcam=>$datadata){
						if($camcam!=$MEME){
							$tempobjeto[$camcam]=$datadata;
						}
						if($camcam==$prex['camp']){
							$tempobjeto[$MEME]=$temp;
						}
					}
					$objeto_tabla=$tempobjeto;
					unset($tempobjeto);
				}elseif($prex['tipo']=='group'){		
					$objeto_tabla[$MEME]['grupo']=$prex['group'];			
				}elseif($prex['tipo']=='ren'){	
					
					continue;	
					$temp=$objeto_tabla[$MEME];
					$temp['campo']=$prex['camp'];
					$temp['label']=$prex['camp2'];
					$tempobjeto=array();
					foreach($objeto_tabla as $camcam=>$datadata){
						$tempobjeto[$camcam]=$datadata;
						if($camcam==$MEME){
							$tempobjeto[$prex['camp']]=$temp;
						}
					}
					$objeto_tabla=$tempobjeto;
					unset($objeto_tabla[$MEME]);
					unset($tempobjeto);				
				}elseif($prex['tipo']=='del'){		
					unset($objeto_tabla[$MEME]);
				} else {
					foreach($pre as $pri=>$pro){
						$objeto_tabla[$MEME][$pri]=$pro;		
					}
				}	
			} else {
				if(!in_array($prex['tipo'],array('del','after','ren','group'))){


					$objeto_tabla[$MEME]=$pre;
			
				}
			}
			//$prep[$campo]=$pre;
			unset($pre);	
			unset($pre2);	
			unset($pre3);		   
			unset($prex);		   
	   }
	   
	   return $objeto_tabla;
	
	}
	
	function getsets($campo){
	
		$campo=" ".$campo;
		$set=array();	
		$set['v']=(!strpos($campo,"v")===false)?1:0;
		$set['u']=(!strpos($campo,"u")===false)?1:0;
		$set['l']=(!strpos($campo,"l")===false)?1:0;	
		return $set;	
		
	}
	
	function procesarcampos($json,$objeto_tabla_me=array()){
		
	   global $prefijo;
		
	   foreach($json as $nombre=>$data){
			
			$campo=preprocess($nombre);
			
			list($campo,$campo1)=explode("|",$campo);
			
			$campox=between($campo,"(",")");
			
			$campo=$campox[0];
			
			$set=getsets($campo1);
					
			$tipo = (is_array($data))?key($data):$data;
			
			$nombres=explode("|",$nombre);

			$nombrex=between($nombres[0],"(",")");
			
			$label=($nombrex[1])?$nombrex[1]:$nombres[0];
			
			$pre['campo']=$campo;
			$pre['label']=ucfirst($label);		
			$labellow=strtolower($label);
			switch($tipo){
				//tipos de campos
				case "inp":case "short":case "long":
					$pre['tipo']='inp';
					if($tipo=="short" or $tipo=="long"){
						$pre['width']=($tipo=="short")?"50px":(($tipo=="long")?"300px":"150px");
						$pre['style']=($tipo=="short")?"width:50px;":(($tipo=="long")?"width:300px;":"width:150px;");		
					} else {
						if(!strpos($labellow,"email")===false){ $ww=200; $pre['listable']='1';
						} elseif(!strpos($labellow,"celular")===false){ $ww=100; $pre['listable']='1';
						} elseif(!strpos($labellow,"telefono")===false){ $ww=100; $pre['listable']='1';
						} elseif(!strpos($labellow,"edad")===false){ $ww=40; $pre['listable']='1';
						} elseif(!strpos($labellow,"nombre")===false){ $ww=200; $pre['listable']='1';
						} elseif(!strpos($labellow,"país")===false){ $ww=200; $pre['listable']='1';
						} elseif(!strpos($labellow,"ciudad")===false){ $ww=200;
						} elseif(!strpos($labellow,"destino")===false){ $ww=200;
						} elseif(!strpos($labellow,"lugar")===false){ $ww=200;
						} elseif(!strpos($labellow,"web")===false){ $ww=200;
						} elseif(!strpos($labellow,"url")===false){ $ww=200;
						} else { $ww=200; }
						$pre['width']=$ww."px";
						$pre['style']="width:".$ww."px;";							
					}
				break;
				case "int":case "int5":
					$pre['tipo']='inp';
					$pre['variable']='float';	
					$pre['size']=($tipo=="int5")?"5":"10";
					$pre['width']=($tipo=="int5")?"50px":"100px";
					$pre['style']=($tipo=="int5")?"width:50px;":"width:100px;";			
				break;		
				case "bit": case "bit1":
					$pre['tipo']='com';
					$pre['radio']='1';
					$pre['opciones']=array('1'=>'si','0'=>'no');
					$pre['default']=($tipo=="bit1")?"1":"0";
					$pre['width']="50px";
					$pre['style']="width:50px;";						
				break;
				case "fech":case "fechc":
					$pre['tipo']='fch';
					$pre['width']='100px';
					$pre['style']='width:100px;';
					$pre['formato']='7';
					$pre['default']="now()";
					if($tipo=='fechc'){
					$pre['constante']='1';
					}
					$pre['rango']=(is_array($data)&&$data['fech'])?$data['fech']:"-1 years,now";
					// 'now,+2 years' // 'now,+10 years' // '-10 years,now' // '1980,-10 years'
				break;				
				case "opc":				
					if(isset($data['opc']['padre'])){
						$pre['tipo']='hid';
						$pre['combo']='1';
						$pre['foreig']='1';
						$pre['opciones']="id,nombre|".$data['opc']['padre'];		
						$pre['default']='[id]';
						$pre['campo']='id_grupo';
					}elseif(isset($data['opc']['tabla'])){
						$pre['tipo']='hid';
						$pre['combo']='1';
						$pre['opciones']="id,nombre|".$data['opc']['tabla'];		
					}else{
						$pre['tipo']='com';
						$opc2=array();
						foreach($data['opc'] as $kk=>$vv){
						$vvv=str_replace("*","",$vv);
						$opc2[$kk]=$vvv;
						if(substr($vv,-1)=='*'){ $deff=$kk; }
						}
						$pre['opciones']=$opc2;
						if(isset($deff)){ $pre['default']=$deff; }
						unset($deff);
						unset($opc2);
					}
					$pre['style']='width:200px;';				
				break;
				case "txt":
					$pre['tipo']='txt';
					$pre['width']='350px';
					$pre['style']='width:500px;';					
				break;	
				case "fot":		
					$pre['tipo']='img';
					$pre['prefijo']=$prefijo;
					$pre['carpeta']=$prefijo.'_imas';
					$pre['tamanos']='150x120,80x80,420x420';
					$pre['tamano_listado']='1';
					$pre['width']='150px';
					$pre['style']='width:150px,height:auto,';
				break;	
				case "vid":		
					$pre['tipo']='yot';
					$pre['width']='300px';
					$pre['style']='width:300px,height:auto,';					
				break;								
				//controles
				case "del":
					$pre['tipo']='del';					
				break;	
				case "ren":
					$pre['tipo'] ='ren';
					$pre['camp'] =preprocess($data['ren']);
					$pre['camp2']=ucfirst($data['ren']);
				break;	
				case "after":
					$pre['tipo']='after';
					$pre['camp']=$data['after'];
				break;					
			}
			
			
			if(!isset($pre['tipo'])){ continue; }
			
			if($set['v']){ $pre['validacion']='1'; }
			if($set['u']){ $pre['unique']='1'; }
			if($set['l']){ $pre['listable']='1'; }
			
			unset($set);
			if(isset($objeto_tabla_me['campos'][$campo])){
				
				if($pre['tipo']=='after'){		
					$temp=$objeto_tabla_me['campos'][$campo];
					$tempobjeto=array();
					foreach($objeto_tabla_me['campos'] as $camcam=>$datadata){
						if($camcam!=$campo){
							$tempobjeto[$camcam]=$datadata;
						}
						if($camcam==$pre['camp']){
							$tempobjeto[$campo]=$temp;
						}
					}
					$objeto_tabla_me['campos']=$tempobjeto;
					unset($tempobjeto);
				}elseif($pre['tipo']=='ren'){		
					$temp=$objeto_tabla_me['campos'][$campo];
					$temp['campo']=$pre['camp'];
					$temp['label']=$pre['camp2'];
					$tempobjeto=array();
					foreach($objeto_tabla_me['campos'] as $camcam=>$datadata){
						$tempobjeto[$camcam]=$datadata;
						if($camcam==$campo){
							$tempobjeto[$pre['camp']]=$temp;
						}
					}
					$objeto_tabla_me['campos']=$tempobjeto;
					unset($objeto_tabla_me['campos'][$campo]);
					unset($tempobjeto);				
				}elseif($pre['tipo']=='del'){		
					unset($objeto_tabla_me['campos'][$campo]);
				} else {
					foreach($pre as $pri=>$pro){
						$objeto_tabla_me['campos'][$campo][$pri]=$pro;		
					}
				}	
			} else {
				if(!in_array($pre['tipo'],array('del','after','ren'))){
					
					$objeto_tabla_me['campos'][$campo]=$pre;
					
				}
			}
			//$prep[$campo]=$pre;
			unset($pre);
			
			
	    }	
	
		return $objeto_tabla_me;
		
	}

?>