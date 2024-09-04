<?php
include("objeto.php");


$galleta='galleta';
$sesionhid='sesionhid3';

if(isset($_GET[$galleta])){

	if($_SESSION[$sesionhid]!='unlocked'){

		echo '<div class="ingreseclave"><form method="post">
		CLAVE: <input name="clavesecreta">
		<input type="submit" value="ENVIAR">
		</form></div>';

	} else {

		redir(str_replace("?".$galleta,"",$SERVER['RUTA']));

	}

	if($_POST['clavesecreta']=='chaluja'){

		$_SESSION[$sesionhid]='unlocked';
		redir(str_replace("?".$galleta,"",$SERVER['RUTA']));
		// prin($SERVER);

	}

}

// if($_SESSION[$sesionhid]=='unlocked'){

// 	prin('unlocked');
// 	prin($_SESSION);

// }



parse_str($_GET['filter'],$oouutt);

// prin($SERVER);
// prin($oouutt);

$filtros123=getStringFilters($oouutt,$objeto_tabla,$this_me);

// prin($filtros123);

if($_GET['ran']!=1){ 

	echo '<div style="display:none;">';
	include_once($objeto_tabla[$this_me]['onload_include']);
	echo '</div>';
	
}

include("setup.php");

if($_GET['ran']==0){ unset($_GET['ran']); }


//prin(sizeof($objeto_tabla[$this_me]['campos']));

// prin($SERVER);
// prin($_SERVER);

// prin($_GET);
// prin($objeto_tabla[$this_me]);

$DeRecha=array(
''=>'linea_derecha_inicio',
'1'=>'linea_derecha_inicio',
'2'=>'linea_derecha_inicio',
);




$joinss=array();

if( in_array($_GET['verdesarrollo'],array('1','0')) ){

	$_SESSION['verdesarrollo']=$_GET['verdesarrollo'];
	redireccionar_a($_SERVER['HTTP_REFERER']);

}





if(1){


	if($_GET['conf2']){
		// var_dump($datos_tabla);
		$_GET['conf']=urldecode($_GET['conf2']);
		$confes=explode("&",$_GET['conf']);
		// prin($confes);
		foreach($confes as $confe){
			list($uno,$dos)=explode("=",$confe);
			if(enhay($uno,"|")){
				
				//var_dump($uno);
				list($tres,$cuatro)=explode("|",$uno);
				$objeto_tabla[$_REQUEST['OB']]['campos'][$tres][$cuatro]=$dos;

			} else {

				$objeto_tabla[$_REQUEST['OB']][$uno]=$dos;

			}
		}

		if(isset($_GET['conf2'])) unset($_GET['conf2']);

		$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_REQUEST['OB']]);

	}

// prin($datos_tabla);



	if(isset($datos_tabla['por_linea']) and $datos_tabla['por_linea']>3){ 
		$datos_tabla['set_fila_fijo']='1';  
	}
	if($datos_tabla['set_fila_fijo']){	
		$_COOKIE[$tb.'_colap']=$datos_tabla['set_fila_fijo']; 
		$ocultar_opciones_filas=1;	
	}
	$_COOKIE[$tb.'_colap']=(isset($_COOKIE[$tb.'_colap']))?$_COOKIE[$tb.'_colap']:(($datos_tabla['por_linea']>1)?1:(($tblistadosize>6)?4:1));

	$ocultaresquina=($tblistadosize<8)?1:0;




	if(!isset($_GET['ran']) or $_GET['ran']==''){

		//EVAL
		if(isset($datos_tabla['script'])){
			
			eval($datos_tabla['script']);

		}

	

		echo '<input type="hidden" id="resaltar"  />';

	    if($_GET['block']!='form'){

			echo '<div class="div_bloque_cuerpo" '. ( ($datos_tabla['width_listado'])?"style=\"width:".$datos_tabla['width_listado'].";\"":"" ) .' >';
			echo '<div class="refreshing2" id="cargando_form" style="display:none;">cargando</div>';
			//echo "<div>ocho</div>";
			//echo show_parent($_GET,$objeto_tabla,$datos_tabla['me']);

			//////////////////////////////////////////////////////////////////////////////////////////////////////////
			//		formulario inicio 		//////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////

			if($Open){ $datos_tabla['crear']='1'; }
			//prin($SERVER);
			echo '<div class="bloque_titulo">';

			$saved[$datos_tabla['me']]['crearopen']=($saved[$datos_tabla['me']]['crearopen']=='')?0:$saved[$datos_tabla['me']]['crearopen'];


			if($datos_tabla['repos']!=''){

				?><span id="abri_cerrar_repos"><?php
	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#repos" id="abrir_repos" <?php
	            ?>onclick="abrir_repos('1','0');" <?php
	            ?>class="btn btn-small btn-info" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['repos']=='1')?"display:none;":""?>" <?php
	            ?>><i class="itl ico_reportes"></i>reportes</a><?php

	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#repos" id="cerrar_repos" <?php
	            ?>onclick="abrir_repos('0','0');" <?php
	            ?>class="btn btn-small btn-inverse" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['repos']=='1')?"":"display:none;"?>" <?php
	            ?>>cerrar reportes</a> <?php
				?></span><?php

            }


			if($datos_tabla['mass_actions']!=''){

				?><span id="abri_cerrar_mass"><?php
	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#mass" id="abrir_mass" <?php
	            ?>onclick="abrir_mass('1','0');" <?php
	            ?>class="btn btn-small" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['mass']=='1')?"display:none;":""?>" <?php
	            ?>>Acciones</a><?php

	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#mass" id="cerrar_mass" <?php
	            ?>onclick="abrir_mass('0','0');" <?php
	            ?>class="btn btn-small btn-inverse" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['mass']=='1')?"":"display:none;"?>" <?php
	            ?>>cerrar acciones</a> <?php
				?></span><?php

            }


			if($datos_tabla['stat']=='1'){

				?><span id="abri_cerrar_stat"><?php
	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#stat" id="abrir_stat" <?php
	            ?>onclick="abrir_stat('1','0');" <?php
	            ?>class="btn btn-small" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['stat']=='1')?"display:none;":""?>" <?php
	            ?>>gráficos</a><?php

	            ?><a href="custom/<?php echo $SERVER['ARCHIVO'];?>#stat" id="cerrar_stat" <?php
	            ?>onclick="abrir_stat('0','0');" <?php
	            ?>class="btn btn-small btn-inverse" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['stat']=='1')?"":"display:none;"?>" <?php
	            ?>>cerrar gráficos</a> <?php
				?></span><?php

            }


			if(!($datos_tabla['crear']=='0' or $tblistadosize=='0' )){

				if(!isset($_GET['i'])){

					$saved[$datos_tabla['me']]['crearopen']=0;

					//prin($SERVER);
	            ?><span id="abri_cerrar_crear"><?php
	            ?><a href="custom/<?php echo $SERVER['URL'];?>#create" id="abrir_crear" <?php
	            ?>onclick="abrir_crear('1','0');" <?php
	            ?>class="btn btn-small btn-primary" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['crearopen']=='1')?"display:none;":""?>" <?php
	            ?>><i class="itr ico_crea"></i>crear <?php echo $datos_tabla['nombre_singular']?></a><?php

	            ?><a href="custom/<?php echo $SERVER['URL'];?>#list" id="cerrar_crear" <?php
	            ?>onclick="abrir_crear('0','0');" <?php
	            ?>class="btn btn-small btn-inverse" <?php
	            ?>style=" <?php echo ($saved[$datos_tabla['me']]['crearopen']=='1')?"":"display:none;"?>" <?php
	            ?>>cancelar crear</a> <?php
					?></span><?php

				}

			}

			/*
			if($Open and ($datos_tabla['crear_pruebas']!='0' and $EdicionPanel) ){

	            ?><a onclick="ax('insertar_prueba_rapida',''); return false;" <?php
	            ?>class="linkstitu" <?php
	            ?>id="insertar_prueba" <?php
	            ?>style=" background-color:<?php echo $BGCOLOR_DESARROLLO;?>; color:#000; display:none;" <?php
	            ?>>Crear <?php echo $datos_tabla['nombre_singular']?> de prueba</a><?php
	            ?><script>window.addEvent('domready',function(){	$1("insertar_prueba");	});</script><?php

            }
            */

            if(trim($datos_tabla['controles'])!=''){ 
            	echo procesar_controles_html($datos_tabla['controles']); 
            }

			/*

			*/

			if($datos_tabla['exportar_gm']=='1' and 0){

				?><a href="#" onclick="javascript:exportar_gm();return false;" <?php
				?>class="btn btn-small exportar_gm" <?php
				?>title="Descargar Base para Group Mail"><i class="itl ico_gm"></i>
				Exportar Group Mail</a><script>function exportar_gm(){ ax('gm'); var url='exportar_gm.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }</script> <?php

			}

			if($datos_tabla['exportar_go']=='1'){

				?><a href="#" onclick="javascript:exportar_go();return false;" <?php
				?>class="btn btn-small exportar_go" <?php
				?>title="Descargar Base para Gmail"><i class="itl ico_gm"></i>
				Exportar GMail</a><script>function exportar_go(){ ax('gm'); var url='exportar_go.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }</script> <?php

			}			

			if($datos_tabla['exportar_excel']=='1'){

				?><a href="#" id="boton_imprimir" onclick="javascript:$('div_allcontent').addClass('menu_colapsed');window.print();return false;" <?php
				?>class="btn btn-small exportar_excel" <?php
				?>title="Imprimir"><i class="itl ico_Print"></i>Imprimir</a><?php

				?><a href="#" id="boton_excel" onclick="javascript:ax('excel');return false;" <?php
				?>class="btn btn-small" <?php
				?>title="Descargar Excel"><i class="itl ico_Excel"></i>Exportar Excel</a><?php

			}

			if($datos_tabla['importar_csv']=='1'){

				echo '<a href="#" rel="nofollow" onclick="javascrip:procesar_recargar(\'importar_csv.php?conf='.$_GET['conf'].'&me='.$datos_tabla['me']."&".$SERVER['PARAMS'].'\');return false;" class="btn btn-small" title="Importar CSV"><i class="itl ico_Excel"></i>Importar CSV</a>';

			}



			if(sizeof($datos_tabla['exports'])>0){
				foreach($datos_tabla['exports'] as $nonbe=>$axion){

					$Aaxion=explode("/",$axion);
					$axionEnd=end($Aaxion);

					?><a href="#" onclick="javascript:<?php echo $axionEnd;?>();return false;" <?php
					?>class="btn btn-small exports exportar_<?php echo $axionEnd;?>" <?php
					?>title="Descargar <?php echo $nonbe;?>"><i class="itl ico_gm"></i>
					<?php echo strtoupper($nonbe);?></a><script>function <?php echo $axionEnd;?>(){ ax('gm'); var url='exports.php?name=<?php echo $axionEnd;?>&file=<?php echo $axion;?>&&<?php echo $axion;?>.php?me=<?php echo $datos_tabla['me'];?>'+(($('ffilter')?'&filter='+$('ffilter').value:'')); console.log(url); location.href=url; }</script><?php

				}
			}


			?><span class='titulo' name="titulo" ><?php echo $tbtitulo?></span><?php


    ?></div><?php


	} else {


		$_COOKIE[$tb.'_colap']=($_GET['tipo']=='listado')?4:0;


	}

	?><div id="bloque_content_crear" class="bloque_content_crear"><?php
	if( ($Proceso=='login') or ($_GET['block']=='form') or ($datos_tabla['crear_quick']=='1') ){ 
		include("formulario.php");
		?><script>window.addEvent('load',function(){ pre_crear(); });</script><?php
	} ?></div><?php

	?><div id="bloque_content_stat" class="bloque_content_stat"></div><?php
	?><div id="bloque_content_mass" class="bloque_content_mass"></div><?php
	?><div id="bloque_content_repos" class="bloque_content_repos"></div><?php

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//		formulario fin 		//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////





    echo '<div class="inner_listado '.
	     ( ($_GET['i']!='')?' detail':'' )
    .'"  id="inner" style=" width:100%; ';

	if($_GET['block']=='form' and $_GET['tipo']!='listado'){ 
		echo 'width:50%; float:left;'; 
	}

	echo '" >';


		///// ZONA AJAX INICIO  ////

		//////////////////////////////////////////////////////////////////////////////////////////////////////////
		//		listado inicio	//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////

		}





		// prin(urldecode('estado%7Clistable%3D0%26alerta_fecha%7Cqueries%3D0%26fecha_creacion%7Cqueries%3D1%26crear%3D0%26order_by%3Did+desc'));

		// parse_str(urldecode($_GET['conf']),$outt);
		// prin($outt);

		if(1){

		    // prin($_GET);

			$queries=array();
			$queries_end=array();
			$queries_after=array();

			$listable_after=array();
			$listable_end=array();

			$tblistado_after=array();
			$tblistado_end=array();

			foreach($tblistado as $zapati){
				if($zapati['listable']=='1') $tillas[]=$zapati['campo'];
			}

			$first_listable=$tillas[0];
			
			$last_listable=end($tillas);


			if(isset($_GET['format']) and sizeof($objeto_tabla[$this_me]['more'])>0 ){

				foreach($objeto_tabla[$this_me]['campos'] as $campo){

					if($campo['tipo']=='hid' and isset($campo['opciones']) and enhay($campo['opciones'],'||') ){

						list($ouno,$odos)=explode("||",$campo['opciones']);
									
						list($tablaO)=explode(" ",$tablaO);

						list($otres,$ocuat)=explode("|",$ouno);
						$moremore[$ocuat]=explode(';',$odos);

					}

				}

				// prin($moremore);
				foreach($moremore as $ore=>$ero){
					$adicionales=explode(",",$objeto_tabla[$this_me]['more'][$ore]);
					foreach($adicionales as $uurl){
						$diran=parse_url($uurl);
						$ero2=array();
						parse_str($diran['query'], $output);
						foreach($ero as $eero){
							if($eero!=$diran['path']) $ero2[]=$eero."?listable=1&after=".$output['after'];
						}
						$objeto_tabla[$this_me]['more'][$ore]=$objeto_tabla[$this_me]['more'][$ore].",\n".implode(",\n",$ero2);
						// prin($ero2);
						// prin($diran['path']);
						// $eero=array();
						// foreach($ero as $eroo){

						// }
						// if(!in_array($diran['path'],$ero)){
						// 	$eero=
						// }
					}
				}

			}

			// prin($objeto_tabla[$this_me]['more']);

			// exit();

			foreach($objeto_tabla[$this_me]['more'] as $blata=>$querries){

				$querrie=explode(",",$querries);
				//prin($querrie);
				
				foreach($querrie as $querrie1){

					list($querrie1uno,$querrie1dos)=explode('?',trim($querrie1));

					$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['tabla']=$blata;
					$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['legend']='';

					parse_str($querrie1dos,$querrie11);

					foreach($querrie11 as $querrie11uno => $querrie11dos){

						$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno][$querrie11uno]=$querrie11dos;

					}

					if($querrie11['queries']=='1'){

						if(isset($objeto_tabla[$this_me]['campos'][$querrie11['after']])){

							$queries_after[$querrie11['after']][]=array($querrie1uno,$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]);	

						} else {

							$queries_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

						}	

					}

					if($querrie11['listable']=='1'){

						if($querrie11['after']=='start'){ $querrie11['after']=$first_listable; }

						$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['noedit']=1;

						if(isset($objeto_tabla[$this_me]['campos'][$querrie11['after']])){

							$tblistatado_after[$querrie11['after']][]=array($querrie1uno,$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]);	

						} else {

							$tblistatado_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

						}	

						$listable_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

					}


				}

			}


			foreach($tblistado as $df){
								
				$tblistado2[]=$df;
				if(isset($tblistatado_after[$df['campo']])){
					// prin($tblistatado_after[$df['campo']]);
					foreach($tblistatado_after[$df['campo']] as $ffdd){
						$tblistado2[]=$ffdd[1];
					}
				}

			}


			// prin($tblistado2);


			$tblistado=$tblistado2;

			// prin($tblistado);

			$tblistado=array_merge($tblistado,$tblistado_end);

			// prin($tblistado);

			// prin($this_me);

			// prin($objeto_tabla[$this_me]['campos']);

			//prin(sizeof($objeto_tabla[$this_me]['campos']));
			
			foreach($objeto_tabla[$this_me]['campos'] as $ddff=>$df){

				if($df['queries']=='1'){
				
					$queries[$ddff]=$df;
					if(isset($queries_after[$ddff])){

						foreach($queries_after[$ddff] as $ffdd){

							$queries[$ffdd[0]]=$ffdd[1];

						}

					}

				}

			}

			// prin($queries);

			$queries=array_merge($queries,$queries_end);


			parse_str($_GET['filter'],$FiL0);

			foreach($FiL0 as $tre=>$FiL0tbl){
				foreach($FiL0tbl as $Fili){

					list($un,$do)=explode(".",$Fili);
					list($un,$do)=explode("=",$do);
					if(substr_count($Fili, '|')==2){

						$pa_rts=explode("|",$Fili);

						$FiL[$tre][$pa_rts[0]]=$tre.".".$Fili;

					} else {

						$FiL[$tre][$un]=$Fili;

					}
				}
			}
			// prin($FiL);

			$html_filter_fecha_A=array();
			$html_filter_A=array();

			$html_filter_fecha='';
			$html_filter='';

		// prin($objeto_tabla[$this_me]['joins']);

		// prin($objeto_tabla[$this_me]['queries']);

		// prin($queries);

		// prin($FiL);











		$parenthood=[];
		$parenthood2=[];
		$getparent=[];

		foreach($queries as $blatacampo=>$querie){

			$blata=($querie['tabla']!='')?$querie['tabla']:$tbl;

			if($querie['disabled']=='1'){ continue; }

			list($unon,$doos)=explode("|",$querie['opciones']);
								
			list($doos)=explode(" ",$doos);

			//prin($doos."=".$tabla_sesion_datos);
			if($doos!='' and $doos==$tabla_sesion_datos){ continue; }

			if(in_array($querie['tipo'],array('hid','user')) and ($querie['opciones'])){
				

				if($querie['select_multiple']=='1'){

				} elseif($querie['dlquery']=='1'){

				} else {
					
					// prin($querie['campo']);
					// prin($querie['load']);
					if(!empty($querie['load']))
						$parenthood[$querie['campo']]=$querie['load'];
					

				}

			}

		}


		parse_str($_GET['filter'],$FiL00);
		// prin($FiL00);
		foreach($FiL00 as $fgfg){
			foreach($fgfg as $fgfgf){
				list($unofg,$dosfg)=explode('.',$fgfgf);
				list($tresfg,$cuatrofg)=explode('=',$dosfg);
				$getparent[$tresfg]=$dosfg;
			}
		}

		
		foreach($parenthood as $hdd=>$ph){
			list($unofg,$dosfg)=explode('||',$ph);
			if(!empty($getparent[$hdd]))
				$parenthood2[$unofg]=$getparent[$hdd];

		}

		// prin($parenthood2);


		// prin($getparent);






		
		foreach($queries as $blatacampo=>$querie){

			$blata=($querie['tabla']!='')?$querie['tabla']:$tbl;

				if($querie['disabled']=='1'){ continue; }

				list($unon,$doos)=explode("|",$querie['opciones']);
									
				list($doos)=explode(" ",$doos);

				//prin($doos."=".$tabla_sesion_datos);
				if($doos!='' and $doos==$tabla_sesion_datos){ continue; }

				if(in_array($querie['tipo'],array('inp')) ){

					$html_filter='';
					$html_filter.="<span class='filfchspan'>".$querie['label']."</span>";
					$html_filter.="<input type='text' id='filtr_".$querie['campo']."_dl' ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." value='".str_replace($blata.".".$querie['campo']."%3D","",urlencode($FiL[$blata][$querie['campo']]))."' onchange=\"render_filder();\" >";
					$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value='".urlencode($FiL[$blata][$querie['campo']])."' >";
					$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value=\"load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."','".$blata."');\" class='jsloads' >";

					//$html_filter.="<script>load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."');</script>";
					$terfil[$blata][]=$querie['campo'];

					$html_filter_A[$querie['campo']]=$html_filter;

				} elseif(in_array($querie['tipo'],array('hid','user')) and ($querie['opciones'])){
					

					if($querie['select_multiple']=='1'){

						$html_filter='';

						list($uno,$slex)=explode("=",$FiL[$blata][$querie['campo']]);
						$selex=explode(",",$slex);


						list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);
									

						list($tabla0)=explode(" ",$tabla0);

						$whereO=str_replace("where 0","where 1",$whereO);

						list($where01,$where02)=explode("order by",$whereO);

						$where02=($where02)?" order by ".$where02:'';

						//echo "$primO,$tablaO,$whereO";
						list($idO,$camposO)=explode(",",$primO);

						$oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,(($whereO1)?$whereO1:"where 1 ").get_extra_filtro_0($tablaO).$where02);
						$html_filter.="<ul class=qsm>";
						$html_filter.="<input type='hidden' value='".urlencode($FiL[$blata][$querie['campo']])."' id='filtr_".$querie['campo']."'>";
						//$html_filter.="<li ".(($FiL[$blata][$querie['campo']]!='')?"class='qsml inuse'":"qsml")." id='filtr_".$querie['campo']."' onchange=\"render_filder();\">";
						$html_filter.="<li class='qsml ".(($FiL[$blata][$querie['campo']]!='')?"inuse":"")."' >".$querie['label']."</li>";
						//$html_filter.="<label value='' class='empty'>".$querie['label']."</label>";
						$html_filter.="<div class='con'>";
						foreach($oopciones as $pppooo){
						$quer=urlencode($tbl.".".$querie['campo']."=".$pppooo[$idO]);
						$html_filter.="<li class='qsml ".((in_array($pppooo[$idO],$selex))?"smcheck":"")."'>";
						$html_filter.="<input class='filtr_".$querie['campo']."' value=\"".$pppooo[$idO]."\" type='checkbox' id='filtr_".$querie['campo']."__".$pppooo[$idO]."' onchange=\"rf('".$querie['campo']."');\" ".((in_array($pppooo[$idO],$selex))?"checked":"").">";
						$html_filter.="<label for='filtr_".$querie['campo']."__".$pppooo[$idO]."' ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." >".$pppooo['value']."</label>";
						$html_filter.="</li>";
						}
						$html_filter.="</div>";
						$html_filter.="</ul>";

						//$html_filter.="</select>";
						$terfil[$blata][]=$querie['campo'];

						$html_filter_A[$querie['campo']]=$html_filter;

					} elseif($querie['dlquery']=='1'){

						$html_filter='';

						list($primO,$tabla1,$whereO)=explode("|",$querie['opciones']);

						$whereO=str_replace("where 0","where 1",$whereO);

						list($where01,$where02)=explode("order by",$whereO);

						list($tabla0,$join0)=explode("left join",$tabla1);
						if(!empty($join0)){
						
							$join0='left join '.$join0;

						} else {

							list($tabla0,$join0)=explode("right join",$tabla1);

							if(!empty($join0)){

								$join0='right join '.$join0;

							}
							
						}
						// prin($tabla0);
						// prin($join0);

						$where02=($where02)?" order by ".$where02:'';

						list($prim0id,$prim0nombre)=explode(",",$primO);

						// prin($FiL[$blata][$querie['campo']]);

						$html_filter.="<span class='filfchspan'>".$querie['label']."</span>";
						$html_filter.="<input type='text' id='filtr_".$querie['campo']."_dl' ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." value='";

						$fila=fila(array("CONCAT_WS(' ',". str_replace(";",",",$prim0nombre) .") as v"),$tablaO,"where id='".str_replace($blata.".".$querie['campo']."%3D","",urlencode($FiL[$blata][$querie['campo']]))."'",0);

						$html_filter.=$fila['v'];
						$html_filter.="' ";
						// $html_filter.=" onchange=\"render_filder();\" ";
						$html_filter.=" >";-
						// prin($EXTRA_FILTRO);
						$direclink_include=($querie['directlink_include'])?$querie['directlink_include']:'';
						$_SESSION['xt']=$EXTRA_FILTRO;
						$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value='".urlencode($FiL[$blata][$querie['campo']])."' >";
						$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value=\"load_directlink_filtro_com('".$querie['campo']."','".$prim0id."','".$prim0nombre."','".$tabla0."','".$whereO1."','".$blata."','".$join0."','','".$direclink_include."');\" class='jsloads' >";

						//$html_filter.="<script>load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."');</script>";
						$terfil[$blata][]=$querie['campo'];

						$html_filter_A[$querie['campo']]=$html_filter;

					} else {


						// prin($querie['campo']);

						$html_filter='';

						list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);

						if($parenthood2[$querie['campo']]){

							// list($antesrm,$despuesrm)=explode("order",$whereO);



							$whereO=' and '.$parenthood2[$querie['campo']] .' '. $whereO;

							if(!enhay($whereO,"where")){
								$whereO="where visibilidad=1 ".$whereO;
							}

						}

						// prin($whereO);

						$whereO=str_replace("where 0","where 1",$whereO);



			

						list($tablaO)=explode(" ",$tablaO);

						// echo "$primO | $tablaO | $whereO <br>";

						list($where01,$where02)=explode("order by",$whereO);

						// echo "$where01 | $where02 <br> <br>";




						$where02=($where02)?" order by ".$where02:'';

						list($idO,$camposO)=explode(",",$primO);

						$camposO=str_replace(";color", "", $camposO);

						// echo "$where01 <br>";
						$where01 = ($where01!='')?$where01:"where 1 ";

						list($unra,$raun)=explode("where",$where01);
						$where01="where ".$raun." ".$unra;

						$oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,( $where01 ).get_extra_filtro_0($tablaO).$where02,0);

						$html_filter.="<select style='width:".(($querie['width'])?$querie['width']:'100px').";' ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." id='filtr_".$querie['campo']."' onchange=\"render_filder();\">";
						$html_filter.="<option value='' class='empty'>".$querie['label']."</option>";
						foreach($oopciones as $pppooo){
						$quer=urlencode($blata.".".$querie['campo']."=".$pppooo[$idO]);

						$html_filter.="<option ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." value=\"".$quer."\">".$pppooo['value']."</option>";

						}
						$html_filter.="</select>";
						$terfil[$blata][]=$querie['campo'];

						$html_filter_A[$querie['campo']]=$html_filter;						

					}


				} elseif(in_array($querie['tipo'],array('com')) and ($querie['opciones'] or $querie['rango'])){
									

					$html_filter='';

					if($querie['rango']!=''){
						list($uuno,$ddos)=explode(",",$querie['rango']);
						$FromYear = date("Y",strtotime($uuno));
						$ToYear = date("Y",strtotime($ddos));
						for($i=$FromYear;$i<$ToYear;$i++){
							$querie['opciones'][$i]=$i;
								
						}
					}
					$oopciones=$querie['opciones'];
									
					$html_filter.="<select ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." id='filtr_".$querie['campo']."' onchange=\"render_filder();\">";
					$html_filter.="<option value='' class='empty'>".$querie['label']."</option>";
					foreach($oopciones as $ipppooo=>$pppooo){
					$quer=urlencode($blata.".".$querie['campo']."=".$ipppooo);
					list($laex,$lanueva)=explode("|",$pppooo);
					$html_filter.="<option ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." value=\"".$quer."\">".$laex."</option>";
					}
					$html_filter.="</select>";
					$terfil[$blata][]=$querie['campo'];

					$html_filter_A[$querie['campo']]=$html_filter;


				} elseif(in_array($querie['tipo'],array('fch','fcr'))){

					$html_filter_fecha='';

					$first=dato('min('.$querie['campo'].')',$blata,"where ".$querie['campo']."!=0",0);
					$first=(!$first)?date("Y-m-d"):$first;
					//$last =dato($querie['campo'],$tbl,"where 1 order by ".$querie['campo']." desc limit 0,1");
					$last=dato('max('.$querie['campo'].')',$blata,"where ".$querie['campo']."!=0",0);
					$last=(!$last)?date("Y-m-d"):$last;
					//prin($first);
					//prin($last);

					$FromYear = substr($first,0,4);
					$FromMonth = substr($first,5,2);

					$ToYear2 = substr($last,0,4);
					//$ToYear = substr($last,0,4);
					$ToYear = date("Y");

					$ToYear= ($ToYear<$ToYear2)?$ToYear2:$ToYear;


					$fftt=explode("|",$FiL[$blata][$querie['campo']]);
					$fftt=$fftt['1']."|".$fftt['2'];

					//prin($fftt);
					$html_filter_fecha.="<div style='clear:left;'>";

					$html_filter_fecha.="<span class='filfchspan'>FECHA</span>";
					$html_filter_fecha.="<select ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")."  onchange=\"between('".$querie['campo']."',this.value);";
					$html_filter_fecha.="fechaChangeFilter('".$querie['campo']."');";
					$html_filter_fecha.="\">";

					$opciones_fechas=opciones_fechas($querie);

					foreach($opciones_fechas as $of){

					$html_filter_fecha.="<option value='".$of['value']."' ".(($of['value']==$fftt)?'selected':'')." ".(($of['class']!='')?"class='".$of['class']."'":'').">".$of['label']."</option>";

					}

					$html_filter_fecha.="</select>";


					$html_filter_fecha.=input_date_filtro($querie['campo'],$FromYear,$ToYear,
					($FiL[$blata][$querie['campo']])?$FiL[$blata][$querie['campo']]:"fecha_consulta|".substr($first,0,10)."|".substr($last,0,10),
					(($FiL[$blata][$querie['campo']]!='')?"inuse":"")
					);

					$html_filter_fecha.="</div>";

					$terfil[$blata][]=$querie['campo'];

					$html_filter_fecha_A[$querie['campo']]=$html_filter_fecha;


				}

		}
			
			if($_GET['format']!='excel'){

				?>
				<script>
				function rf(filter){
					var j=0;
					var eles = new Array();
					$$('.filtr_'+filter).each(function(ele) {
						if(ele.checked){
							eles[j]=ele.value;
							j++;
						}
					});
					$('filtr_'+filter).value=(j==0)?'':encodeURIComponent(filter+'='+eles.join(','));
					render_filder();
				}
				function render_filder(){
				var url='';
				<?php 
				foreach($terfil as $nameblata => $blata){
					foreach($blata as $tert){
					//echo "if($('filtr_".$tert."').value!=''){ url+=' and '+$('filtr_".$tert."').value; }\n";
					echo "if($('filtr_".$tert."').value!=''){ url+=encodeURIComponent('".$nameblata."[]='+$('filtr_".$tert."').value+'&'); }\n";
					//echo "if($('filtr_".$tert."').value!=''){ url+='".$tert."='+$('filtr_".$tert."').value+'&'; }\n";
				} } ?>
				$('ffilter').value=url;
				url=url+'&conf=<?php echo urlencode($_GET['conf'])?>';
				// console.log(url)
				// alert(url);
				ax("pagina_filter",url,1);
				//location.href="custom/<?php echo $datos_tabla['archivo']; ?>.php?filter="+url;
				}
				</script>
				<?php


			}//NO EXCEL


		}


		if($Open==1 and 0){

		$filtros1=array(); $filtros2=array(); $filtros3=array();
		$filtros1=explode(";",$datos_tabla['filtros']);
		$filtros2=explode(";",$datos_tabla['filtros_extra']);
		$filtros3=array_merge($filtros1,$filtros2);
		$datos_tabla['filtros']=implode(";",$filtros3);
		$datos_tabla['filtros']=($datos_tabla['filtros']==',')?$datos_tabla['filtros']:'';
		}
		if($datos_tabla['filtros']!=''){
			$fils=explode(";",$datos_tabla['filtros']);
            foreach($fils as $fil){
                list($label,$filt,$ordf,$txtx)=explode("|",trim($fil));
				$Filtross[$label]=array($filt,$ordf,$txtx);
            }

			if($Filtross[$datos_tabla['filtro_default']][0]!='' and $_GET['filtro']==''){	$_GET['filtro']=$datos_tabla['filtro_default']; }
			if($Filtross[$datos_tabla['filtro_default']][0]!='' ){ $no_mostrar_todos=1;	}

            $htmlfil = '<div class="blo_filtros">';
			if(!$no_mostrar_todos){
            $htmlfil.= "<a $selesele href='".$DIR_CUSTOM.$datos_tabla['archivo'].".php'>".$datos_tabla['nombre_plural']."</a><b>:</b>";
			}
            foreach($fils as $fil){
                list($label,$filt,$ordf,$txtx)=explode("|",trim($fil));
				$Filtross[$label]=array($filt,$ordf,$txtx);
				$selesele='';
				if($label==$_GET['filtro']){
					$FilTro=$filt;
					$FilTro_l=$label;
					$FilTro_o=$ordf;
					$selesele='class="selected"';
					if($txtx!=''){
					$BarFiltro=$txtx;
					}
				}
				if(!in_array(trim($label),array("","\n","\r","\t"))){
                	$htmlfil.= "<a $selesele href='".$DIR_CUSTOM.$datos_tabla['archivo'].".php?filtro=".$label."'>".$label."</a>";
				}
            }
            $htmlfil.= '</div>';
        }

		//if($BarFiltro!=''){
		//}

		if($BarFiltro!=''){
			echo "<div class='barfiltro'>$BarFiltro</div>";
		}


		/*prin($tblistadosize);	*/

	    if($tblistadosize!='0'){

			if($_GET['i']!=''){

				//$busqueda_query = " ".$_GET['filter']." ";
				$busqueda_query = " and ".$tbl.".id = '".$_GET['i']."' ";
				$linkPagina = "pagina_file";
				$linkRecPagina = "recargar_file";
				$vvvalos = $_GET['i'];
				$_COOKIE[$tb.'_colap']='2';
				$datos_tabla['order_by']='';

			}elseif($_GET['filter']!=''){

				//$busqueda_query = " ".$_GET['filter']." ";			
				$query_filter_parts=query_filter($FiL);
				foreach($query_filter_parts['joins'] as $joi){
					$joinss[$joi]=$joi;
				}
				// $join_query = "\n".implode("\n",);
				$busqueda_query = " and ( ".$query_filter_parts['filter']." ) ";
				$linkPagina = "pagina_filter";
				$linkRecPagina = "recargar_filter";
				$vvvalos = $_GET['filter'];

			}elseif($FilTro!=''){

				$busqueda_query = " and ( ".$FilTro." ) ";
				$linkPagina = "pagina_filtro";
				$linkRecPagina = "recargar_filtro";
				$vvvalos = $FilTro_l;

			} elseif($_GET['buscar']!=''){

				if(is_numeric($_GET['buscar'])){
					
					prin($_GET);
					$numbuscar=contar($tbl,"where ".$tbl.".id = '".$_GET['buscar']."'",1);
					if($numbuscar==1){
						redir("?i=".$_GET['buscar']);
					}
				}

				$busqueda_query = search_query($datos_tabla['fulltext'],$datos_tabla['like'],$datos_tabla['id'],$_GET['buscar']);
				$linkPagina = "pagina_buscar";
				$linkRecPagina = "recargar_buscar";
				$vvvalos = $_GET['buscar'];

			} else {

				$busqueda_query = "";
				$linkPagina = "pagina";
				$linkRecPagina = "recargar";
				$vvvalos = "";

			}

	//		prin($datos_tabla);
			//update_tags($objeto_tabla[$this_me],162);
			/*
			$tbcampos	=	$datos_tabla['form'];
			$tblistado	=	$datos_tabla['list'];
			$tbquery	=   $datos_tabla['query'];
			*/
			
			/*prin($datos_tabla['query']);*/

			if($_GET['i']!='' ){

				// $tblistado	=	$datos_tabla['list'] = $datos_tabla['form'];
				$tblistado	=	$datos_tabla['list']=$MEEE['campos'];


				foreach($tblistado as $tblistado_item){
					
					$tblistado3[$tblistado_item['campo']]=$tblistado_item;

				}
								

				foreach($MEEE['campos'] as $tblistado_item){
				
					$tblistado3[$tblistado_item['campo']]=$tblistado_item;

				}	


				
			
				

				// prin($tblistado3);

				$tblistado=$tblistado3;
				


				//$array=$MEEE;
				/*prin($datos_tabla['list']);*/

				if(is_array($datos_tabla['list']))
				foreach($datos_tabla['list'] as $tyt=>$camp){
			
					if( $camp['disabled']=='1' ){ continue; }

					if( 
						in_array($camp['tipo'],array('fed','pos','vis','cal')) 
						and $camp['listable']!='1'
					){ continue; }

					if( 
						in_array($camp['tipo'],array('hid')) and !isset($camp['opciones']) and $camp['foreig']!=1
					){ continue; }

					
					if( $camp['campo']!=$array['group'] and $camp['autotags']!='1' ){

						/*prin($camp);*/

						$tblistado[$tyt]['listable']='1';
						$datos_tabla['list'][$tyt]['listable']='1';
						$query[]=$camp['campo'];

					}

				}
				
				
				$tbquery= $datos_tabla['query']= implode(",",$query);

			
			}




			$tbquery_items=explode(',',$tbquery);	
			$tbquery=array();
			$join_query_arr=array();
			$join_query_arr2=array();
			foreach($tbquery_items as $tbquery_item)
			{
				$tbquery[]=$tbl.".".$tbquery_item." as ".$tbquery_item;
			}
			foreach($listable_end as $campokey => $tblque)
			{
				$joinss[$tblque['tabla']]=$tblque['tabla'];
				$tbquery[]=$tblque['tabla'].".".$campokey." as ".$campokey;	
				$tbquery0[]=$campokey;
			}
			$join_query='';
			foreach($joinss as $tttiii=> $joi_)
			{
				$onn=explode(".",$datos_tabla['joins'][$joi_]);
				$jqnext[$tttiii]=$onn[0];
				$join_query_arr[$tttiii]="\n left join ".$joi_." on ".$datos_tabla['joins'][$joi_]." ";
			}

			// prin($jqnext);

			foreach($join_query_arr as $tttiii=>$joi_)
			{
				$join_query_arr2[$jqnext[$tttiii]]=$join_query_arr[$jqnext[$tttiii]];
				$join_query_arr2[$tttiii]=$join_query_arr[$tttiii];
			}

			foreach($join_query_arr2 as $joi_)
			{
				$join_query.=$joi_;
			}
			// prin($join_query);
			/*			
			$joins[$FA0]=" left join ".$FA0." on ".$joi[$FA0]." ";
			prin(sizeof($tbcampos));
			prin(sizeof($tblistado));
			prin(sizeof($query));
			*/
			//prin($SERVER);
			//prin($vars['GENERAL']['mostrar_toolbars']);

			$extra_where='';
			if($datos_tabla['extra_where']){

				$extra_where=$datos_tabla['extra_where'];

				if(
					preg_match_all('/{+(.*?)}/', $extra_where, $matches)
					) {
				   foreach($matches[1] as $match){

				    	$extra_where =str_replace('{'.$match.'}', $_GET[$match], $extra_where);
				   }
				}


			}



			if($_GET['format']=='excel'){		

				include('excel.php');
			
			// } elseif($_GET['ran']=='1') {
			} else {


				// $_GET['debug']='1';
				// prin($datos_tabla['where_id']);
				// prin($tbquery);
				
				$pagina_items=paginacion(
										array(
											'separador'    =>''
											,'porpag'      =>($LOCAL and $vars['GENERAL']['mostrar_toolbars'])?20:$datos_tabla['por_pagina']
											,'anterior'    =>'&laquo;'
											,'siguiente'   =>'&raquo;'
											,'enlace'      =>"#"
											,'onclick'     =>"ax(\"". $linkPagina ."\",\"". urlencode($vvvalos) ."\",PAG);return false;"
											/*,'onclick':'go_page'*/
											,'tren_limite' =>'10'
											,'tipo'        =>'bootstrap',
											'noquery'	   => ( $_GET['i']=='' && $_GET['ran']!=1 && $datos_tabla['nocharge']==1),
										),
										$tbquery,
										$tbl,
										$join_query
										. "\n where 1 "
										. "$EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id']
										. "\n $extra_where"
										
										. "\n order by "
										. ( ($FilTro_o=='')?'':$FilTro_o."," )


										. ( ($datos_tabla['group'])?' '.$datos_tabla['group'].' desc, ':'' )
										. ( ($datos_tabla['order_by']=='')? (  $tbl.".".$datos_tabla['id']." ". (($datos_tabla['orden']=='1')?"desc":"asc") ):$datos_tabla['order_by'] )
										,
										(0 or ($_GET['debug']=='1') )
										);

				

				if($_GET['debug']=='1')
					prin(array(
						$EXTRA_FILTRO,
						$busqueda_query,
						$datos_tabla['where_id']
					));


			}




			$lineas          = $pagina_items['filas'];
			$paginas_linea   = $pagina_items['tren'];
			$anterior_linea  = $pagina_items['anterior'];
			$siguiente_linea = $pagina_items['siguiente'];
			
			$total_linea     = $pagina_items['total'];
			$desde_linea     = $pagina_items['desde'];
			$hasta_linea     = $pagina_items['hasta'];
			
			$lineassize      =sizeof($lineas);
			
			if( $_GET['i']=='' && $_GET['ran']!=1 && $datos_tabla['nocharge']==1)
			{
				$lineas=[];
			}

			if(function_exists("onload_include_after_query")){
				onload_include_after_query();
			}

				// prin($oouutt);

				echo '<input type="hidden" id="nfilter" value="".
				"filter='.str_replace("&","%26",http_build_query(
									$oouutt
									)).
				'" style="width:100%;">';

				echo '<input type="hidden" id="linkopagina" style="width:100%;" value="'.$linkPagina.'" >';

				echo '<input type="hidden" id="linkovals" style="width:100%;" value="'.urlencode($vvvalos).'" >';

				echo '<input type="hidden" id="ffilter" style="width:100%;" value="'.urlencode($_GET['filter']).'" >';

				echo '<input type="hidden" id="pagina" style="width:100%;" value="'.(($_GET['pag']=='')?"1":$_GET['pag']).'"  />';
				//echo '<input type="hidden" id="tipolista" value="'.$linkRecPagina.'"  />';
				echo '<input type="hidden" id="edit_hidd" style="width:100%;"  />';

				// echo '<div style="position:relative;height:auto;float:left;width:100%;">';

				echo '<div class="cover" id="refresh-cover" style="display:none;"></div><div class="refreshing" id="refresh" style="display:none;">cargando......</div>';

			if($lineassize!=0 or $_GET['buscar']!='' or $_GET['filter']!=''){

	        // echo '<div style="'.$display_barra.'">';

			$vars['GENERAL']['controles_listados']=($vars['GENERAL']['controles_listados'])?$vars['GENERAL']['controles_listados']:1;

			// echo '<div class="barbar2">';

			if($ocultar_opciones_filas!=1){

	        /* ?><span style=" <?php echo ($ocultar_opciones_filas==1)?'display:none;':''; ?>"><?php */




			   	?><span class="brazzz"><a class="braz z <?php if($_COOKIE[$tb.'_colap']=='2'){?>brasselected<?php }?>" <?php
		        ?>onclick="set_filas('<?php echo $tb?>','<?php echo $tbf?>','2');return false;" <?php
		        ?>title="Vista de Resúmen" <?php
		        echo (in_array($vars['GENERAL']['controles_listados'],array('1','2')))?'':'style="display:none;"';
		        ?>id="set_filas_2"></a><?php

			   	/* ?><a class="braz z <?php if($_COOKIE[$tb.'_colap']=='1'){?>brasselected<?php }?>" <?php
		        ?>onclick="set_filas('<?php echo $tb?>','<?php echo $tbf?>','1');return false;" <?php
		        ?>title="Filas en Bloque" <?php
		        echo (in_array($vars['GENERAL']['controles_listados'],array('1','3')))?'':'style="display:none;"';
		        ?>id="set_filas_1"></a><?php */

			   	/* ?><a class="braz z <?php if($_COOKIE[$tb.'_colap']=='3'){?>brasselected<?php }?>" <?php
		        ?>onclick="set_filas('<?php echo $tb?>','<?php echo $tbf?>','3');return false;" <?php
		        ?>title="Vista de Filas" <?php
		        ?>id="set_filas_3"></a><?php */

		        ?><a class="braz z <?php if($_COOKIE[$tb.'_colap']=='4'){?>brasselected<?php }?>" <?php
		        ?>onclick="set_filas('<?php echo $tb?>','<?php echo $tbf?>','4');return false;" <?php
		        ?>title="Vista de tabla" <?php
		        echo (in_array($vars['GENERAL']['controles_listados'],array('1','3')))?'':'style="display:none;"';
		        ?>id="set_filas_4" style="text-decoration:none;"></a></span><?php

			/* ?></span><?php */
			
			}



			if($lineassize==0){ /*?><div class="nohay">0 <?php echo $datos_tabla['nombre_plural']?> </div><?php*/ } else {


		    ?><span class="mmm"><a id="msino"></a><a id="mnosi"></a></span><script>window.addEvent('domready',function(){ 
		    			
		    			$("msino").addEvent('click',function(){ 
						$('div_allcontent').addClass('menu_colapsed'); 
						Cookie.write('men', 1, {duration: 10});
						new Request({url:"ajax_change_cookie.php?var=men&val=1&ajax=1", method:'get', onSuccess:function(ee) {
						 } } ).send();
					});
						$("mnosi").addEvent('click',function(){ 
						$('div_allcontent').removeClass('menu_colapsed'); 
						Cookie.write('men', 0, {duration: 10});
						new Request({url:"ajax_change_cookie.php?var=men&val=0&ajax=1", method:'get', onSuccess:function(ee) {
						 } } ).send();					
					}); });</script><?php

		    // prin($tblistadosize);



			}

							

			if(sizeof($datos_tabla['fulltext'])>0 or sizeof($datos_tabla['like'])>0){
			?><form action="<?php echo "custom/".$datos_tabla['archivo'].".php";?>" method="get"
			onsubmit="if($v('buscar')=='buscar <?php echo $datos_tabla['nombre_singular'];?>'){ return false; }"
			><?php
				?><div id="linea_buscador"><?php
					?><span class="z ico_search"></span><input type="text" class="<?php echo ($_GET['buscar']!='')?"inuse":"";?>"  <?php
					?>value='<?php echo $_GET['buscar'];?>' autocomplete="off" <?php
					?>placeholder="buscar <?php echo $datos_tabla['nombre_singular'];?>"<?php
					?>id="buscar" name="buscar" /><?php
					/* ?><input type="submit" value="buscar" <?php
					onclick="ax('buscar',$v('buscar'),'buscar <?php echo $datos_tabla['nombre_singular'];?>');"
					?>style="background-color:#000; color:#FFF; padding:0px 2px 0px 0px; font-size:18px; text-transform:uppercase;float:left; border:0; margin-right:10px; font-weight:bold; display:none;" /> <?php */
					?><span id="buscar_span"></span><?php
				?></div><?php
			?></form><?php
			}

			/**
			 * FILTROS
			 */
			$html_filter="<div class='byother'>".implode("\n",$html_filter_A)."</div>";

			echo "<div class='filters' id='dfilters' >".
				 implode("\n",$html_filter_fecha_A).$html_filter.
				 "</div>";

		}

		echo $htmlfil;

		// echo "</div>";




	    // prin($lineassize);

		if($lineassize==0){ ?><div class="nohay">0 <?php echo $datos_tabla['nombre_plural']?> </div><?php } else {

	    echo '<div class="segunda_barra" id="segunda_barra_2">';
	    // prin($tblistadosize);

		if($tblistadosize!='0'){ ?>

		AQUI VA LA PAGINACION
    	<b id="inner_span_tren" class="inner_span_tren" ></b>
	    <b id="inner_span_num" ></b>

	    <? }

	    echo '</div>';

		}

		echo ($_GET['i']!='')?'<div class="title_detail">'.$datos_tabla['nombre_singular']." #".$_GET['i'].'</div class="title_detail">':'';

		echo '<ul class="listado_grilla">';

		//$lineas=array($lineas[0]);

		$numero_de_campo_en_lista=$tblistadosize-4;

		$needs['html']=0;

		// prin($tblistado);

        ?><ul id="ordenable" ><?php


		foreach($tblistado as $tbli){

			if($tbli['tipo']=='html'){ $needs['html']=1; }
			if($tbli['cuantity']=='1'){ $hascuantity=1; $cuantities[]=$tbli['campo']; }

		}

		if($hascuantity==1 and $lineassize>1){

			echo "<table class='tblcalculo'>";
			echo "<tr><td></td><td class=nombre>m�nimo</td><td class=nombre>m�ximo</td><td class=nombre>media</td></tr>";
			foreach($cuantities as $cutt){

				echo "<tr><td class=nombre>$cutt</td>";
				echo "<td class=valor>";
				$valor = dato("min($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
				echo intval($valor*100)/100;
				echo "</td>";
				echo "<td class=valor>";
				$valor = dato("max($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
				echo intval($valor*100)/100;
				echo "</td>";
				echo "<td class=valor>";
				$valor = dato("avg($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
				echo intval($valor*100)/100;
				echo "</td>";
				echo "</tr>";
				//echo "<div>nunca jamas quiere decir tal vez</div>";
				
			}
			echo "</table>";

		}

		$datos_tabla['edicion_completa']=($datos_tabla['edicion_completa']!='')?$datos_tabla['edicion_completa']:( (($needs['html']) or($numero_de_campo_en_lista>$limite_campos_en_lista))?1:0 );

		$edicion_rapida_on = $datos_tabla['edicion_rapida']=($datos_tabla['edicion_rapida']!='')?$datos_tabla['edicion_rapida']:( (($needs['html']) or($numero_de_campo_en_lista>$limite_campos_en_lista))?0:1 );


		$urd=0;

		$groupvalue='';

		//PRE
		if($datos_tabla['mass_actions']!='')
		{
			$tblistado=array_merge(array(array('listable'=>'1','campo'=>'check','tipo'=>'check')), $tblistado);
		}

		foreach($tblistado as $tbli)
		{
			$pdfrom[]="[".$tbli['campo']."]";
		}
        foreach($lineas as $tete=>$linea)
        {
        /*prin($linea);	*/
		$ct=array();
		$ConF=array();
		/*
		parse_str($linea['conf'],$ConF);
		$ct['eliminar']=(isset($ConF['eliminar']))?$ConF['eliminar']:$datos_tabla['eliminar'];
		$ct['procesos']=(isset($ConF['procesos']))?procesproces($ConF['procesos']):$datos_tabla['procesos'];
		*/
		$ct=procesproces($datos_tabla,$linea['conf']);
		// prin($ct);

		//prin($ct);
		//prin();
		//$ct=$datos_tabla;
		$urd++;
		$datos_tabla['edicion_completa']=($_GET['block']=='form' and $_GET['tipo']=='listado')?0:$datos_tabla['edicion_completa'];

			if($datos_tabla['por_linea']!=''){ if($tete%$datos_tabla['por_linea']==0){ echo ($tete!=0)?"</div>":""; echo "<div style='clear:left;'>"; } }
            echo '<li ';
			if($datos_tabla['edicion_rapida']=='1'){
			echo ' ondblclick="if(!$(\'i_'.$linea[$datos_tabla['id']].'\').hasClass(\'editar_rapido\')){ax(\'e\',\''.$linea[$datos_tabla['id']].'\');}"';
			echo ' onkeypress="if( $(\'i_'.$linea[$datos_tabla['id']].'\').hasClass(\'editar_rapido\')){if(event.keyCode==27){ax(\'e_a\',\''.$linea[$datos_tabla['id']].'\');}}" ';
			}
			echo ' alt="'.$linea[$datos_tabla['id']].'" class="bl ';

			switch($_COOKIE[$tb.'_colap']){
				case "1": echo ''; break;
				case "2": echo 'modificador'; break;
				case "3": echo 'modificador_linea'; break;
				case "4": echo 'modificador_grilla'; break;
			}
			echo '" id="i_'.$linea[$datos_tabla['id']].'"  >';
			//prin($linea);
            echo '<a class="ie" href="custom/'.$datos_tabla['archivo'].'.php?i='.$linea[$datos_tabla['id']].'">'
			.fecha_formato($linea['fecha_creacion'],"7b")
			.$linea[$datos_tabla['id']]
			.'</a>';

			echo '<div class="lc '. ( ($urd=='1')?"lc1 ":" " ) . ( ($datos_tabla['vis']!='')?(($linea[$datos_tabla['vis']]=='0')?"oc":""):'' ).'" id="lc_'.$linea[$datos_tabla['id']].'">';


            if( (!isset($_GET['i'])) and ($_GET['justlist']!='1') ){ ?><a  id="av_<?php echo $linea[$datos_tabla['id']]?>" href="custom/<?php echo $datos_tabla['archivo'].".php?i=".$linea[$datos_tabla['id']]; ?>" class="bl1 itr i_ev z" title="ver <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php }



			if($ct['eliminar']=='1'){
			echo '<a  id="ad_'.$linea[$datos_tabla['id']].'" onclick="ax(\'x\',\''.$linea[$datos_tabla['id']].'\');return false;" class="bl1 itr i_x z" title="eliminar '.$datos_tabla['nombre_singular'].'" ></a>';
			}

			if($datos_tabla['vis']!='' and $datos_tabla['visibilidad']!='0' ){

                         ?><a  id="av_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('v','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr i_m z" title="habilitar <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php
                         ?><a  id="ah_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('o','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr i_o z" title="deshabilitar <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php

                    }

					if($datos_tabla['cal']!='' and $datos_tabla['calificacion']!='0' ){

                        ?><a  id="as_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('star','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr ico_star_<?php echo ($linea[$datos_tabla['cal']])?$linea[$datos_tabla['cal']]:'0';?> z" <?php  echo 'rel="'. ( ($linea[$datos_tabla['cal']]==5)?'0':($linea[$datos_tabla['cal']]+1) ).'"'; ?> title="calificar <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php

                     }


					if($datos_tabla['editar']=='1'){

                        if($datos_tabla['edicion_completa']=='1'){

                             ?><a  id="ae_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('ec','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr i_ec z" title="editar <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php


                            if($datos_tabla['duplicar']=='1' and $_GET['block']!='form'){

                                ?><a  id="ae_<?php echo $linea[$datos_tabla['id']]?>" onclick="if(confirm('Desea Crear un nuevo registro de <?php echo $datos_tabla['nombre_singular'];?> con estos datos?')){ ax('ec','<?php echo $linea[$datos_tabla['id']]?>','nuevo'); } return false;" class="bl1 itr i_d z" title="Crear un nuevo <?php echo $datos_tabla['nombre_singular'];?> con estos datos" ></a><?php

                             	}
							}
                        if($datos_tabla['edicion_rapida']=='1'){

                            ?><a  id="ae_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('e','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr i_e z" title="editar <?php echo $datos_tabla['nombre_singular'];?>" ></a><?php }

             			}
						foreach($ct['procesos'] as $iproceso=>$proceso){
							if($ct['procesos'][$iproceso]['disabled']=='1'){ unset($ct['procesos'][$iproceso]); }
						}
						// prin($ct['procesos']);
						if(sizeof($ct['procesos'])>0 and $ct['procesos']!=0){
						//echo '<ul>'; echo '<li class="menudown">';

						echo '<a rel="sm_'.$linea[$datos_tabla['id']].'" id="ab_'.$linea[$datos_tabla['id']].'" onclick="ax(\'b\',\''.$linea[$datos_tabla['id']].'\');return false;" class=" bl1 itr i_b z" ></a>';

							echo '<div id="sm_'.$linea[$datos_tabla['id']].'" class="div_fila_overflow">';
							echo '<ul class="li_cabecera">';

							foreach($ct['procesos'] as $iproceso=>$proceso){

							$href= ( ($proceso['file']!='')?$proceso['file']:'formulario_quick.php' ) 
							.'?proceso='.$iproceso
							.'&L='.$linea[$datos_tabla['id']]
							.'&OT='
							.( ($proceso['ot'])?$proceso['ot']."&parent=".$objeto_tabla[$this_me]['archivo']:$objeto_tabla[$this_me]['archivo']."&parent=")
							.( ($proceso['ran']=='null')?"":"&ran=1" )
							.( ($proceso['accion'])?"&accion=".$proceso['accion']:'')
							.( (sizeof($proceso['cargar'])>0)?'&load='.urlencode(json_encode($proceso['cargar'])):'')

							.( ($proceso['extra'])?"&".str_replace(
								["[id]","[id_grupo]"],
								[$linea[$datos_tabla['id']],$linea['id_grupo']],
								$proceso['extra']):'');

							echo "<li>";
							// prin($proceso);
							echo '<a rel="';
							echo ($proceso['rel'])?$proceso['rel']:'width:1250,height:900';
							echo '" href="';
							
							echo $href;

							echo '"'
							.' class="'. ( (isset($proceso['class']))?$proceso['class']:'mb' )
							.'"'
							.' >';
							//echo '<a onclick="ax(\'ec\',\e'9\'); return false;" href="#" >';
							// echo $href." ";
							echo $proceso['label'];
							echo '</a>';
							echo "</li>";
							}
							echo '</ul>';
							echo '</div>';


						//echo '</li>'; echo '</ul>';
						}

                    ?></div><?php

					 if($datos_tabla['editar']=='1'){
                    ?><div id="lec_<?php echo $linea[$datos_tabla['id']]?>" class="lec <?php echo ($urd=='1')?"first_linea_exl ":" ";?>" style="display:none;"><a  id="aec_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('e_a','<?php echo $linea[$datos_tabla['id']]?>'); return false;" class="bl1 itr ico_Cancelar z" title="cancelar edición" >cancel</a><a  id="aeg_<?php echo $linea[$datos_tabla['id']]?>" onclick="ax('e_g','<?php echo $linea[$datos_tabla['id']]?>'); return false;"   class="bl1 itr ico_Guardar z" title="guardar cambios" >guardar</a></div><?php
                     }


            //echo $_COOKIE[$tb.'_colap'];
            ?><a class="expanlink <?php echo ($urd=='1')?"first_linea_exl ":" ";?>" id="exl_<?php echo $linea[$datos_tabla['id']]?>" style=" <?php
			echo ( ( $_COOKIE[$tb.'_colap']=='2' or $_COOKIE[$tb.'_colap']=='1') )?"display:none;":""; ?>" onclick="ax('set_fila_2','<?php echo $linea[$datos_tabla['id']]?>'); return false;" title="expandir"></a><?php
			?><a class="colaplink <?php echo ($urd=='1')?"first_linea_exl ":" ";?>" id="cll_<?php echo $linea[$datos_tabla['id']]?>" style=" <?php
			echo ( ( $_COOKIE[$tb.'_colap']=='3' or $_COOKIE[$tb.'_colap']=='4') )?"display:none;":""; ?> " onclick="ax('set_fila_3','<?php echo $linea[$datos_tabla['id']]?>'); return false;" title="colapsar"></a><?php


                    echo '<ul id="ldd_'.$linea[$datos_tabla['id']].'" class="ldd ';
					echo ($urd=='1')?"first_linea ":"";


					if($datos_tabla['vis']!=''){ echo ($linea[$datos_tabla['vis']]=='0')?"oc":""; }
					if($datos_tabla['vis']!=''){ echo ($linea[$datos_tabla['vis']]=='0')?"oc":""; }
					echo '" >';

					echo '<div class="truc"></div>';
					// prin($linea);
					$tbid=0;
					$pdto=array();



					foreach($tblistado as $tbli){
						$pdto[]=$linea[$tbli['campo']];
					}

					$fefe=1;
					// var_dump($tblistado);
					
					// prin($tblistado);
					foreach($tblistado as $tbli){

						// prin($tbli);

                        if($tbli['listable']=='1'){
						$tbid++;
							//prin($linea);
							if($urd==1){
								if($tbli['controles']!=''){
									list($tbli['controles'],$controles)=getControles($tbli['controles'],$objeto_tabla);
									//prin($controles);
									$controlEs[$tbli['campo']]=$tbli['controles'];
									$load_foto[$tbli['campo']]=$controles['foto'][0]['obj'];
									if($controles['file']){ 	$load_file[$tbli['campo']]=$controles['file']; }
									if($controles['subs']){ 	$load_subs[$tbli['campo']]=$controles['subs']; }
									if($controles['mensajes']){ $load_mensajes[$tbli['campo']]=$controles['mensajes']; }
								}
							}

							$SuprimirLabel=(
											(
												strtolower($tbli['label'])=='nombre'
												or strtolower($tbli['label'])==strtolower($datos_tabla['nombre_singular'])
												or $tbli['label']=='Título'
												or strtolower($tbli['label'])=='foto'
												or strtolower($tbli['label'])=='fecha'
												or strtolower($tbli['label'])=='vista'
												or strtolower($tbli['label'])=='email'
												or strtolower($tbli['label'])=='estado'
												or strtolower($tbli['label'])=='web'
												or strtolower($tbli['label'])=='categoría'
												or strtolower($tbli['label'])=='tipo'
												or strtolower($tbli['listhtml'])=='1'
												or strtolower($tbli['campo'])==strtolower($datos_tabla['group'])
											)
											and 
												$tbli['listable']=='1'											
											)?1:0;

							$nuevoDad='';
							if(strtolower($tbli['campo'])==strtolower($datos_tabla['group'])){
								$nuevoDad='od';
								if($groupvalue!=$linea[$datos_tabla['group']]){
									$groupvalue=$linea[$datos_tabla['group']];
									$nuevoDad='nd';
								}
							}

							if($fefe==1){
							$Firstmain=(
											strtolower($tbli['label'])=='fecha'
											or enhay(strtolower($tbli['label']),'nombre')
											or strtolower($tbli['label'])==strtolower($datos_tabla['nombre_singular'])
											or $tbli['label']=='Título'
											or strtolower($tbli['label'])=='código'
											or strtolower($tbli['label'])=='código'
											or strtolower($tbli['label'])=='numero'
											or strtolower($tbli['label'])=='número'
											or $tbli['campo']=='fecha_creacion'
											)?1:0;
							if($Firstmain) $fefe=0;
							} else $Firstmain=0;

							$nomodificar=(
											//strtolower($tbli['label'])=='fecha' or
											strtolower($tbli['label'])=='email'
											)?1:0;

							$poner_title=(
											(
											$tbli['tipo']!='com'
											and $SuprimirLabel
											and !$nomodificar
											)
										 or ($tbid==1)
										 or $tbli['tipo']=='pas'
										)?1:0;
//							$tbli['label']=str_replace(array('Categor�a'),array('Cat'),$tbli['label']);

							$tbli['controles']=($tbli['control']=='0')?'':procesar_controles_html($controlEs[$tbli['campo']]);

							$tbli['width']=($tbli['width']=='' or $tbli['width']=='0px')?"":"width:".$tbli['width'].";";

							echo ($tbli['legend']!='' and $_GET['i']!='')?'<li class="bld legend">'.$tbli['legend'].'</li>':'';


                            echo '<li class="bld '.
                             ( ($_GET['i']!='')?$DeRecha[$tbli['derecha']]:'' ).' '.
                             (($Firstmain and !$nomodificar and $tbli['listhtml']!='1')?'lifmf':'').' '.
                             (($tbli['tipo']=='check')?'lchk':'').' '.
                             (($tbli['tipo']=='id')?'lid':'').' '.
                             ((in_array($tbli['tipo'],array('txt','html')))?'ltxt':'').' '.
                             (($tbli['listclass'])?$tbli['listclass']:'').' '.
                             $nuevoDad.'" >';

							if($tbli['tipo']=='inp' and $load_foto[$tbli['campo']]!=''){
																		$obj=$load_foto[$tbli['campo']];
																		$hayfotoexterna=render_foreig_foto($objeto_tabla[$obj],$linea[$datos_tabla['id']]);
																		}

							//CHECK
							if($tbli['tipo']=='check')
							{
								?><b class="nc sp"><?php
								if($urd=='1'){
									?><input type=checkbox onchange="var s=(this.checked)?true:false; s2=(this.checked)?'add':'remove'; $$('.chk').each(function(cc){ $(cc).checked=s; if(s){ $('i_'+$(cc).getAttribute('data-chk')).addClass('selectd'); } else { $('i_'+$(cc).getAttribute('data-chk')).removeClass('selectd'); } });" ><?php
								} else {
									?>&nbsp;<?php
								}
								?></b><div class="bd" style="width:auto;"><input class="chk" data-chk="<?php echo $linea[$datos_tabla['id']]; ?>" type="checkbox"
								onchange="var ee='i_'+this.getAttribute('data-chk'); if(this.checked){ $(ee).addClass('selectd'); } else { $(ee).removeClass('selectd'); }"></div><?php
							}


							//IMG
							if($tbli['tipo']=='img'){
									/*prin($linea);*/
									echo '<b class="nc '.(($SuprimirLabel)?'sp':'').'" '.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').' >'.$tbli['label'].'&nbsp;';
									if($urd=='1' and $EdicionPanel){ ?><a class='edot' onclick='tog("<?php echo $tbli['campo']?>");return false;'>&diams;</a><?php }
									echo '</b>';

                                     echo '<span class="bd" ';
									 echo 'style="'.($tbli['style']=='')?"":str_replace(",",";",$tbli['style']).'"';
									 echo ' id="i_'.$tbli['campo'].'_'.$linea[$datos_tabla['id']].'">';

                                     if($linea[$tbli['campo']]!=''){
								   $cec=0; if(($tbli['enlace']=='lightbox') or !($tbli['enlace']) ){ $cec=1;
                                   ?><a style="float:none;margin:0;text-align:center;" href="<?php echo get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']]);?>" rel="[images],noDesc" class="mb" ><?php } elseif($tbli['enlace']) { $cec=1;
								   echo '<a href="'.str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace']).'" >'; }
                                   ?><img  id="<?php echo $tb?>_file_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php echo dimensionar_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']],$tbli['tamano_listado']);?> /><?php 
                                   if($cec){?></a><?php }
								   } else {
                                   ?><img id="<?php echo $tb?>_file_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php
                                   ?>class='img_default' src="<?php echo $USU_IMG_DEFAULT;?>" /><?php
                                   }
								   echo '</span>';
								   ?><div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" ></div><?php
                                    if($tbli['controles']){
                                    $dts=str_replace(
													$pdfrom,
													$pdto,
													//"[id]",
													//$linea[$datos_tabla['id']],
													procesar_dato($tbli['controles'],$linea[$datos_tabla['id']]));
									if($urd==1){ $sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"'; }
									echo "<div class='cd' ".$sizeE[$tbli['campo']].">";
                                    echo $dts;
									echo "</div>";
                                    }

									}
							//STO
							if($tbli['tipo']=='sto'){

									list($uuno,$extens)=explode(".",$linea[$tbli['campo']]);

									echo '<b class="nc '.(($SuprimirLabel)?'sp':'').'"
									'.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').'
									>'.$tbli['label'].'&nbsp;';
									if($urd=='1' and $EdicionPanel){ ?><a class='edot' onclick='tog("<?php echo $tbli['campo']?>");return false;'>&diams;</a><?php }
									echo '</b>';
									;?><span class="bd" style=' padding-left:10px;' id="i_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" ><?php
                                    if($linea[$tbli['campo']]!=''){
								   $cec=0;
								   if(($tbli['enlace']=='lightbox') or !($tbli['enlace']) and in_array($extens,array('gif','jpg','png','swf')) ){
								   $cec=1;
                                   echo '<a style="float:none;margin:0;text-align:left;" href="'.get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']]).'" rel="[images],noDesc" class="mb" >';
								    } elseif($tbli['enlace']) {
								   $cec=1;
								   echo "<a href=\"";

								   if($tbli['enlace']=='down'){
								   		echo "down.php?name=".urlencode($linea[($tbli['name'])?$tbli['name']:'nombre'])."&file=".urlencode(str_replace($vars['REMOTE']['httpfiles'],'',get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']])))."\" title=\"Descargar ".$linea[($tbli['name'])?$tbli['name']:'nombre'];
								   } else {
								   		echo str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace']);
								   }
								   echo "\">";

								   }

								   if(($tbli['enlace']=='down') and in_array($extens,array('txt','doc','xls','pdf')) ){
									   echo "Descargar <img src='img/ico_".$extens.".png' align=center border=0 >";
								   }else{
									   echo $linea[$tbli['campo']];
								   }

								   if($cec){ echo "</a>"; }

								   } else { ?>---<?php }
								   ?></span><?php

                                   ?><input type='hidden' value='' id="txt_<?php echo $tb?>_<?php echo $tbli['campo']?>_name_<?php echo $linea[$datos_tabla['id']]?>" /><?php

                                   ?><div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" style=' <?php echo ($tbli['style']=='')?"":str_replace(",",";",$tbli['style'])?>'></div><?php
								   if($tbli['controles']){
                                    $dts=str_replace($pdfrom,$pdto,procesar_dato($tbli['controles'],$linea[$datos_tabla['id']]));
									if($urd==1){ $sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"'; }
									echo "<div class='cd' ".$sizeE[$tbli['campo']].">";
                                    echo $dts;
									echo "</div>";
                                    }

								}

							//PAS
							if($tbli['tipo']=='pas'){
                                   ?><b class="nc"><?php echo $tbli['label']?>:</b><?php
                                   ?><span class="bd" style=' <?php echo $tbli['width']; ?>' <?php
                                   ?>id="i_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php
								   if($_COOKIE['admin']=='1') echo "title=\"".addslashes($linea[$tbli['campo']])."\"";
                                   ?>><?php

								   	$passs='';
									for($iu=0;$iu<strlen($linea[$tbli['campo']]);$iu++){
										$passs.="*";
									}
									echo ($_COOKIE['admin']=='1')?$linea[$tbli['campo']]:$passs;

                                   ?></span><input type="hidden" value="<?php echo $linea[$tbli['campo']]?>" id="i_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>_temp" /><div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" style=" <?php echo $tbli['width']; ?>"></div><?php
								 }

								if($tbli['controles']){
									$dts=str_replace($pdfrom,$pdto,procesar_dato($tbli['controles'],$linea[$datos_tabla['id']]));
									if($urd==1){
									$sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"';
									if($load_foto[$tbli['campo']]!=''){
									$sizeF[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;margin-left:52px;"';
									}else{
									$sizeF[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"';
									}

									}
								}

							//OTROS
							if(
							in_array($tbli['tipo'],array('txt','inp','com','yot','fch','fcr','html','bit','id'))
							or
							($tbli['tipo']=='hid' and ($tbli['combo']=='1' or $tbli['listable']=='1') )
							){

									$tbli['tip_foreig']=( ($tbli['tipo']=='hid') and ($tbli['opciones']!=''))?$tbli['tip_foreig']:0;
									

									//echo ($SuprimirLabel)?"":'<b class="nc">'.$tbli['label'].':</b>';
									echo '<b class="nc '.(($tbli['label']=='' or $SuprimirLabel)?'sp':'').'" '.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').' >'.
									str_replace(array('(',')'),array('<span style="display:none;">','</span>'),$tbli['label']).
									'&nbsp;';
									if($urd=='1' and $EdicionPanel){ ?><a class='edot' onclick='tog("<?php echo $tbli['campo']?>");return false;'>&diams;</a><?php }
									echo '</b>';

									// prin([$tbli['label'],$Firstmain]);

                                    if($tbli['extra']!='')
									echo "<span style='float:left;margin:0 3px; font-size:11px; '>".procesar_dato($tbli['extra'],$linea[$datos_tabla['id']])."</span>";
									/* if($tbli['tipo']=='yot'){
										if(trim($linea[$tbli['campo']])!='')
											echo "<a href='http://www.youtube.com/embed/".$linea[$tbli['campo']]."' class='mb' rel='allowfullscreen,width:960,height:720'><img style='float:left;' src='http://i4.ytimg.com/vi/".$linea[$tbli['campo']]."/default.jpg' /></a>";
									} */


									$adiv0='';

									if(
										!($tbli['nolink']==1) and
										( $tbli['enlace'] or $tbli['tip_foreig']=='1' or $Firstmain or ( $tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!='' ) )
										){ 
										$adiv0.='<a class=" '; 
									} else { 
										$adiv0.='<div class=" '; 
									}
									
									if( !( $tbli['tipo']=='hid' and !isset($tbli['opciones']) ) ){

										$adiv0.=' bd '; 
										
									}
									if($tbli['format']=='currency'){ $adiv0.='currency '; } else { $adiv0.=''; }

									if($tbli['tip_foreig']=='1'){ $adiv0.='tipper '; } else { $adiv0.=''; }

									$adiv0.= ($tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!='' )?"mb ico_play ":"";
									$adiv0.= ($SuprimirLabel and !$nomodificar)?"mn ":"";
									$adiv0.= ($Firstmain and !$nomodificar and $tbli['listhtml']!='1' and !($tbli['nolink']==1) )?"fm ":"";
									$adiv0.= ($Firstmain and !$nomodificar and $tbli['listhtml']!='1')?"fmf ":"";
									$adiv0.= '"';

									$adiv0.= ' target="_top"';

									if($tbli['tip_foreig']=='1'){
									list($primO,$tablaO)=explode("|",$tbli['opciones']);
									
									list($tablaO)=explode(" ",$tablaO);

									list($idO,$camposO)=explode(",",$primO);
									list($tablaO,$notablaO)=explode(",",$tablaO);
									$lllink='custom/'.$tablaO.'.php?i='.$linea[$tbli['campo']];
									$adiv0.='rel="{ajax:\'ajax_sql.php?v_t='.$tablaO.'&v_d='.$idO.'%3D'.$linea[$tbli['campo']].'&exc='.$camposO.'&f=get_quick\'}"';
									} elseif($tbli['tipo']=='yot') {
										if( trim($linea[$tbli['campo']])!='' ){
										$lllink="http://www.youtube.com/embed/".$linea[$tbli['campo']];
										$adiv0.='rel="allowfullscreen,width:960,height:720"';
										} else {
										$lllink="";
										$adiv0.='';	
										}
									} else { 
									$adiv0.=''; 
									}
									$adiv0.= "style='".$tbli['width'].";";
									$adiv0.= ($tbli['tipo']=='txt')?'max-height:95px;overflow:hidden;':'';
									$adiv0.= "' ";
									$adiv0.= "id=\"i_".$tbli['campo']."_".$linea[$datos_tabla['id']]."\" ";
									if($tbli['enlace'] or $tbli['tip_foreig']=='1' or $tbli['tipo']=='yot' ){
										if($tbli['tip_foreig']=='1'){
										$adiv0.= "href=\"$lllink\" ";
										} elseif($tbli['tipo']=='yot'){
										$adiv0.= "href=\"$lllink\" title=\"ver video\" ";
										} else {
										$adiv0.= "href=\"".str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace'])."\" ";
										}
									} else {
										if($Firstmain)
										$adiv0.= "href=\"custom/".$datos_tabla['archivo'].".php?i=".$linea[$datos_tabla['id']]."\" ";																				
										/*$adiv0.= "onclick=\"ax('vc','".$linea[$datos_tabla['id']]."');return false;\" href=\"custom/".$datos_tabla['archivo'].".php?i=".$linea[$datos_tabla['id']]."\" ";										*/
									}
									

									$adiv1= '';
									switch($tbli['tipo']){
										
										case "fch":case "fcr":
										$adiv1.= fecha_formato($linea[$tbli['campo']],($tbli['formato'])?$tbli['formato']:'0b');
										if($edicion_rapida_on)
										$adiv1.= "<input type='hidden' value='".substr($linea[$tbli['campo']],0,19)."' id='".$tb."_fchhid_".$tbli['campo']."_".$linea[$datos_tabla['id']]."' >";
										break;
										case "html":
										if($tbli['listhtml']=='1' or $_GET['i']!=''){	$adiv1.= "<div class='htmlenlista'>".stripslashes($linea[$tbli['campo']])."</div>"; } else {
										$adiv1.= substr(strip_tags($linea[$tbli['campo']]),0,3000);
										}
										if($edicion_rapida_on)
										$adiv1.= "<textarea style='".(($tbli['width'])?'width:'.$tbli['width'].';':'')."display:none;' id='".$tb."_htmlhid_".$tbli['campo']."_".$linea[$datos_tabla['id']]."'  >".stripslashes($linea[$tbli['campo']])."</textarea>";
										break;
										case "hid":
										if($edicion_rapida_on)
										$adiv1.= '<input type="hidden" value="'.$linea[$tbli['campo']].'" id="i_'.$tbli['campo'].'_hido_'.$linea[$datos_tabla['id']].'" />';
										list($primO,$tablaO)=explode("|",$tbli['opciones']);
										list($tablaO)=explode(" ",$tablaO);
										list($idO,$camposO)=explode(",",$primO);
										$camposOA=array();
										$camposOA=explode(";",$camposO);
										$color0='';
										$valuores=explode(",",$linea[$tbli['campo']]);
										foreach($valuores as $lov){
											$bufy='';
											$ddattfila= fila($camposOA,$tablaO,"where ".$idO."='".$lov."'",0);
											foreach($ddattfila as $COA=>$ddatt){
											if($COA=='color' and trim($ddatt)!=''){ $color0=$ddatt; $use_color=1; }
											else $bufy.=$ddatt." ";
											}
											$adiv1.= '<div>';
											$adiv1.= ($color0!='')?"<span class='label' style='background:$color0;color:white;' >".$bufy."</span>":$bufy;
											$adiv1.= '</div>';
											$adiv0.= ( $poner_title )?"title=\"".addslashes($bufy)."\"":"";
										}
										break;
										case "bit":
										if($edicion_rapida_on)
										$adiv1.= '<input type="hidden" value="'.$linea[$tbli['campo']].'" id="i_'.$tbli['campo'].'_hido_'.$linea[$datos_tabla['id']].'" />';
										switch($linea[$tbli['campo']]){
											case "1":$adiv1.= "&nbsp;<a title='si' class='ico_yes z ico_list'></a>"; break;
											case "0":$adiv1.= "&nbsp;<a title='no' class='ico_no z ico_list'></a>"; break;
										}
										break;
										
										case "com":
										if($edicion_rapida_on)
										$adiv1.= '<input type="hidden" value="'.$linea[$tbli['campo']].'" id="i_'.$tbli['campo'].'_hido_'.$linea[$datos_tabla['id']].'" />';
										if(is_array($tbli['opciones'])){
										list($opppp,$color)=explode("|",$tbli['opciones'][$linea[$tbli['campo']]]);
										switch(str_replace(
											array('á','é','í','ó','ú'),
											array('a','e','i','o','u'),
											strtolower($opppp))){
										case "comentario":							$adiv1.= "<a title='enviado' class='ico_tack z ico_list'></a>"; break;
										case "soporte":								$adiv1.= "<a title='soporte' class='ico_clip z ico_list'></a>"; break;
										case "enviado":								$adiv1.= "<a title='enviado' class='ico_yes z ico_list'></a>"; break;
										case "recibido":							$adiv1.= "<a title='recibido' class='ico_yes z ico_list'></a>"; break;
										case "si":case "sí":						$adiv1.= "<a title='si' class='ico_yes z ico_list'></a>"; break;
										case "no":									$adiv1.= "<a title='no' class='ico_no z ico_list'></a>"; break;
										case "nuevos soles":case "soles": 			$adiv1.= "S/."; break;
										case "dolares":case "dolares americanos": 	$adiv1.= "\$US"; break;
										default : 									$adiv1.= "<span ". ( ($color!='')?" class='label' style='background:$color;color:white;' ":"" ) . ">".$opppp."</span>";	break;
											}
										} else {
										$adiv0.= ( $poner_title )?"title=\"".addslashes($linea[$tbli['campo']])."\"":"";

										$adiv1.= $linea[$tbli['campo']];

										}
										break;

										default:
										$adiv0.= ( $poner_title )?"title=\"".addslashes($linea[$tbli['campo']])."\"":"";

										if($tbli['inlist']){
											$inlist=explode(';',$tbli['inlist']);
											foreach($inlist as $inlis){
												$adiv1.= $linea[$inlis]." ";												
											}
										} else {
											switch($tbli['format']){
												case "currency":
												$adiv1.= ($linea[$tbli['campo']])?number_format($linea[$tbli['campo']], 2, '.', ','):'';
												break;
												default:
												$adiv1.= $linea[$tbli['campo']];
												break;
											}
										}
										break;

									}

									if(
										!($tbli['nolink']==1) and
										( $tbli['enlace'] or $tbli['tip_foreig']=='1' or $Firstmain or ( $tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!=''  )
									) 
									){ $adiv2= '</a>'; } else { $adiv2= '</div>'; }

									$adiv0.= " >";

									echo $adiv0.$adiv1.$adiv2;
									//echo ($tbli['foreig'])?"�":"";
									if($edicion_rapida_on)
									echo '<div class="pt" id="p_'.$tbli['campo'].'_'.$linea[$datos_tabla['id']].'" style=" '.$tbli['width'].'"></div>';
									if($tbli['controles']){
										/*echo '<textarea>'.$dts.'</textarea>';*/
									echo "<div class='cd' ". ( ($hayfotoexterna)?$sizeE[$tbli['campo']]:$sizeF[$tbli['campo']]).">";
                                    //echo str_replace($pdfrom,$pdto,procesar_dato($dts,$linea[$datos_tabla['id']]));
                                    echo $dts;
									echo "</div>";
									}

									}
                    		 echo '</li>';
							 }
                    	}

					echo '</ul>';


						if($urd==1){
						$load_subs_render=(sizeof($load_subs)>0)?1:0;
						}
						if($urd==1){
						$load_file_render=(sizeof($load_file)>0)?1:0;
						}

						if($load_subs_render){
						render_foreig_subs($load_subs,$linea[$datos_tabla['id']],$urd);
						}
						if($load_file_render){
						render_foreig_file($load_file,$linea,$urd);
						}

				if(isset($_GET['i'])!=''){

					echo '<div class="more_detail itms_cont">';

					include($datos_tabla['detail_include']);

					echo '</div>';

				}
                    
            echo "</li>";


		//////////////////////////////////////////////////////////////////////////////////////////////////////////
		//		listado fin 	//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
		 }

		if($datos_tabla['por_linea']!=''){ echo "</div>"; }

		?></ul><?php

        }
		?><input type="hidden" id="inner_hidden_num" value='<span class="spa2n"><span id="span_num" ><?php echo $total_linea; ?></span> <?php echo ($total_linea==1)?$datos_tabla['nombre_singular']:$datos_tabla['nombre_plural']?></span> <span style="font-weight:normal;"><?php echo ($total_linea==$lineassize)?"":"(desde $desde_linea hasta $hasta_linea)"; ?></span>' /><?php
		?><input type="hidden" id="inner_hidden_num2" value='<span id="span_num2" ><?php echo $total_linea; ?></span> <?php echo ($total_linea==1)?$datos_tabla['nombre_singular']:$datos_tabla['nombre_plural']?> <span style="font-weight:normal;"><?php echo ($total_linea==$lineassize)?"":"(desde $desde_linea hasta $hasta_linea)"; ?></span>' /><?php
		?><textarea id="inner_hidden_tren" style="display:none;"><div class='pagination' style='margin:0;'><ul><?php echo $anterior_linea.$paginas_linea.$siguiente_linea;?></ul></div></textarea><?php
		?><script>

		window.addEvent('domready',function(){
	        ax('actualizar_total',this.value);
		});

        </script><?php


     /**/

	if(strpos($_SERVER['SCRIPT_NAME'], "login.php")===false){

	/*
    ?><div class="segunda_barra"  id="segunda_barra_3" style="clear:left;" ><?php

		 if($tblistadosize!='0'){
            ?><b style="float:left; text-align:left; width:33%;" id="inner_span_num2" ></b><?php
            ?><b id="inner_span_tren2" class="inner_span_tren" ></b><?php
         }

	?></div><?php
	*/

    } else {
    ?><style>
	#div_allcontent { width:630px; margin-top:7%; min-width:0%; }
	ul.ul_menus { width:25%;}
    .div_bloque_cuerpo { float:left; width:60%; margin-left:4%; }
	.formulario .linea_form:hover label { background:none; }
    </style>
    <script>
	window.addEvent('domready',function() {
	$('error_creacion').innerHTML='';
	$('val_in_nombre');
	});
	</script>
    <?php }

	/* ?></div><?php */

    ?><!-- FIN AJAX --><?php

if(!isset($_GET['ran']) or $_GET['ran']==''){

echo "</div>";
include("vista_ax.php");
}

}
//prin(0);
if(isset($_GET['ran']) and $_GET['ran']!=''){
	include("lib/compresionFinal.php");	/*para Content-Encoding*/
}
// prin($_GET);
?>
<script language="javascript">

if(window.location.hash=='#create'){ abrir_crear('1','0'); }

<?php if($_GET['i']!=''){ ?>
window.addEvent('load',()=>{
if($('ab_<?php echo $_GET['i']; ?>'))
$('ab_<?php echo $_GET['i']; ?>').fireEvent('mouseover');
// $('ab_<?php echo $_GET['i']; ?>').removeEvents('mouseover');
});
<?php } ?>

<?php if($datos_tabla['nocharge']=='1' && $_GET['i']==''){ ?>
window.addEvent('load',()=>{
ax("pagina","",1);
});
<?php } ?>

function getQueryVariable(variable) {
    var query = window.location.hash.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

console.log(getQueryVariable('filter'));

// ax('recargar_hash');
// console.log(getQueryVariable('filter'));
// console.log(getQueryVariable('uno'));
// if(window.location.hash=='#filter='){ abrir_crear('1','0'); }
// alert(window.location.hash);
/*
var HM = new HashListener();
//add an event listener to the manager
HM.addEvent('hashChanged',function(new_hash){
    console.log(new_hash);
});
*/
</script>