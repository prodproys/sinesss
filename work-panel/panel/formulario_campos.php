<?php


/*
prin($SERVER);
prin($_SESSION);
prin($_COOKIE);
prin($_SERVER);
*/

// if($_GET['view']==1){
// 	foreach($tbcampos as $uu=>&$tbcampA){
// 		$tbcampA['frozen']=1;
// 	}
// }


echo '<div id="group_general" class="groups">';

	foreach($tbcampos as $uu=>$tbcampA){

		if($tbcampA['load']!=''){
			$uno=explode("|",$tbcampA['load']); $Loads[]=$uno[0];
		}

	}

	// prin($Loads);


	$INPS=array();

	// prin($tbcampos);

	$tbcampos2=($objeto_tabla[$datos_tabla['me']]['campos'][$datos_tabla['id']]['listable']=='1')?array_merge(array($objeto_tabla[$datos_tabla['me']]['campos'][$datos_tabla['id']]),$tbcampos):$tbcampos;

	foreach($tbcampos2 as $tbcampA){

		if($tbcampA['tipo']=='inp'){
			$INPS[]=$tbcampA['campo'];
		}

		$Derecha=($FORMSCLASS[$tbcampA['derecha']])?$FORMSCLASS[$tbcampA['derecha']]:'';

		if($_GET['block']=='form' and $_GET['tipo']!='listado'){
			$Derecha="linea_derecha_50";
		}

		if($tbcampA['indicador']=='1'){
			$Derecha="oculto";
		}


		if($tbcampA['legend']!='' and $tbcampA['indicador']!='1'){ 
			?>
			</div>
			<div class='groups'
			id='group_<?php echo str_replace(" ","_",strtolower($tbcampA['legend']));?>'>

			<li 
				class="linea_form legend" 
				id="leg_<?php echo $tbcampA['campo'];?>">
					<?php echo $tbcampA['legend'];?>
			</li>
			<?php 
		}

		$mostrarli=1;
		if($tbcampA['tipo']=='hid'){

			// prin($tbcampA);
			// prin($_GET);

			$GGET1=$_GET[str_replace(array("[","]"),array("",""),$tbcampA['default'])];
			$GGET2=$_SESSION[str_replace(array("[","]"),array("",""),$tbcampA['default'])];
			// $GGET=($GGET1!='')?$GGET1:$GGET2;
			$GGET=( ($tbcampA['default']) and (!enhay($tbcampA['default'],"[")) ) ? $tbcampA['default']: (($GGET1!='')?$GGET1:$GGET2);		
			list($primO,$tablaO,$whereO)=explode("|",$tbcampA['opciones']);
			if(in_array($tbcampA['campo'],$Loads)){
			// echo 'loads de '.$tbcampA['campo']."<br>";
			// prin($Loads);
			// $whereO='where 0';
			
			}

			list($idO,$camposO)=explode(",",$primO);
			$camposOA=array();
			$camposOA=explode(";",$camposO);

			// prin(get_extra_filtro_0($tablaO));

			// prin((($whereO)?$whereO:"where 1 ").get_extra_filtro_0($tablaO));
			// prin(procesar_dato(($whereO)?$whereO:"where 1 ").get_extra_filtro_0($tablaO));

			$whereop=procesar_dato((($whereO)?$whereO:"where 1 ").get_extra_filtro_0($tablaO));
			$betop=between($whereop,"order","and");
			if(trim($betop[1])!='' and trim($betop[2])!='' ){
				if(trim($betop[0])==''){ $betop[0]="where 1 ";}
				$whereop=$betop[0].' and '.$betop[2].' order '.$betop[1];
			}
			// prin($whereop);
			// prin($tbcampA['campo']);
			// if(enhay($whereop," and ")){
			// 	$whereop=str_replace("where 0","where 1", $whereop);
			// }


			$oopciones=select(array_merge(array($idO),$camposOA),$tablaO,$whereop,0);


			if( 
				!isset($tbcampA['opciones']) 
				and !isset($tbcampA['combo']) 
				and !isset($tbcampA['foreig']) 
			){ $mostrarli=0; }

			/*
			if(!($tbcampA['combo']=='1' or $GGET!='')){
									$mostrarli=0;
			}
			*/

		}

		if($tbcampA['tipo']=='com'){

			if(sizeof($tbcampA['opciones'])=='2' and
				strtolower($tbcampA['opciones']['0'])=='no' and
				str_replace("í","i",strtolower($tbcampA['opciones']['1']))=='si'){
					$tbcampA['tipo']='bit';
			}

			if($tbcampA['rango']!=''){
				list($uuno,$ddos)=explode(",",$tbcampA['rango']);
				$FromYear = date("Y",strtotime($uuno));
				$ToYear = date("Y",strtotime($ddos));
				for($i=$FromYear;$i<$ToYear;$i++){
					$tbcampA['opciones'][$i]=$i;
				}
			}
			
			if($tbcampA['default']=='now()'){
				$tbcampA['default']=date("Y");
			}

		}

		if($mostrarli){ ?>

			<li 
				style="<?php echo $tbcampA['listyle']?>" 
				id="id_in_<?php echo $tbcampA['campo']?>" 
				class="linea_form form-group 
				<?php echo $Derecha; ?>
				<?php echo 'input_'.$tbcampA['tipo'];?>"
			>
			
				<label 
				for="in_<?php
				echo $tbcampA['campo']; 
				echo ($tbcampA['tipo']=='bit')?'_check':'';
				?>"
				id="la_<?php echo $tbcampA['campo']?>" 
				class="<?php 
				echo ($tbcampA['validacion']=='1')?'vali ':'';
				echo ($tbcampA['validacion_crear']=='1')?'vali ':'';
				?>" ><?php
				echo $tbcampA['label'];
				//prin($tbcampA);
				?></label>

				<?php 
				
		}


		if($datos_tabla['crear_quick']=='1'){
			if(sizeof($INPS)>0){
				$LASTINP=$INPS[sizeof($INPS)-1];
				$FIRSTINP=$INPS[0];
			}
		}

		if($tbcampA['label_before']){
			echo '<i>'.$tbcampA['label_before'].'</i>';
		}

		if($tbcampA['constante']){

			$value=$tbcampA['default'];
			echo "<div class='in_span'>";
				switch($tbcampA['tipo']){

					case "hid":
						// prin($tbcampA['opciones']);
						list($primO,$tablaO)=explode("|",$tbcampA['opciones']);
						list($idO,$camposO)=explode(",",$primO);
						$camposOA=array();
						$camposOA=explode(";",$camposO);
						$bufy='';
						foreach($camposOA as $COA){
						if($COA=='color') continue;	
						$bufy.= select_dato($COA,$tablaO,"where ".$idO."='".$value."'")." ";
						}
						echo '<span id="in_'.$tbcampA['campo'].'_span">';
						echo (trim($bufy)!='')?$bufy:'&nbsp;';
						echo '</span>';
					break;
					case "fcr":	case "fch":
						$fech=fecha_formato($value,($tbcampA['formato'])?$tbcampA['formato']:'0b');
						echo '<span id="in_'.$tbcampA['campo'].'_span" class="in_span">';
						echo ($fech!='')?$fech:"&nbsp;";
						echo '</span>';
						break;
					case "txt":
						echo ($value!='')?nl2br($value):"&nbsp;";
						break;
					default:
						echo '<span id="in_'.$tbcampA['campo'].'_span" >';
						echo ($value!='')?$value:"&nbsp;";
						echo '</span>';
					break;
				}
			echo "</div>";

		} else {

			switch($tbcampA['tipo']){

				case "id":
					?><input disabled type="text"
						id="in_<?php echo $tbcampA['campo']?>" class="form_input"
						style="width: 50px;" />
					<?php
				break;
				case "img":	case "sto":

					?><div class="upl"><?php 
						if( $tbcampA['help']) echo '<div class="greyy">'.$tbcampA['help'].'</div>';
					?><div id="upl_<?php echo $tb?>_<?php echo $tbcampA['campo']?>_0"></div></div><?php

				break;
				case "inp":

						$maxlength=($tbcampA['size']!='')?$tbcampA['size']:'80';
						$stylewidth=($tbcampA['size']!='')?'width:'. ( ( ($tbcampA['size']>100)?100*7:$tbcampA['size']*7 ) ).'px; ':'';
						?><input 
						autocomplete="nope" <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?> 
						type="text" 
						id="in_<?php echo $tbcampA['campo']?>" 
						name="<?php echo $tbcampA['campo']?>" 
						class="form_input form-control form-control-sm" 
						maxlength="<?php echo $maxlength;?>" 
						<?php echo ($tbcampA['onchange'])?'onchange=\''.$tbcampA['onchange'].'\' ':' '; ?>
						style=" <?php
						echo $stylewidth;
						echo ($tbcampA['style'])?$tbcampA['style']:'';
						echo ($tbcampA['unique'])?'border:1px solid #666666;':'';
						?>" <?php
						?>value="<?php echo $tbcampA['default']?>" onkeypress="<?php
						if($LASTINP==$tbcampA['campo']){ ?>if(event.keyCode==13){ ax('insertar',''); }<?php }
						if($tbcampA['live']){  echo procesar_lives($tbcampA['live']); }
						?>" onkeyup="<?php if($tbcampA['live']){  echo procesar_lives($tbcampA['live']); } ?>" /><?php
						if($FIRSTINP==$tbcampA['campo']){ ?><script>$('in_<?php echo $tbcampA['campo']?>').focus();</script><?php }
						/*
						if($tbcampA['multiopciones']!=''){
							list($name,$tablerel,$primO,$tablaO,$whereO)=explode("|",$tbcampA['multiopciones']);
							list($idO,$camposO)=explode(",",$primO);
							$multi=select(array($idO,$camposO),$tablaO,$whereO,0);
							echo "<label>$name</label><div class='multicombo'>";
							foreach($multi as $mul){
							echo "<div class='fil'>";
							echo "<input type='checkbox' id='$tablaO_".$mul[$idO]."' />";
							echo "<label for='$tablaO_".$mul[$idO]."'>".$mul[$camposO]."</label>";
							echo "</div>";
							}
							echo "</div>";
						}
						*/
				break;
				case "pas":

						$maxlength=($tbcampA['size']!='')?$tbcampA['size']:'80';
						$stylewidth=($tbcampA['size']!='')?'width:'. ( ( ($tbcampA['size']>100)?100*7:$tbcampA['size']*7 ) ).'px; ':'';

						?><div class="floatinput">
						
						<input 
						type="password" 
						id="in_<?php echo $tbcampA['campo']?>" 
						name="<?php echo $tbcampA['campo']?>" 
						class="form_input form_control" 
						autocomplete="nope"
						maxlength="<?php echo $maxlength;?>" 
						style=" <?php
						echo $stylewidth;
						echo ($tbcampA['style'])?$tbcampA['style']:'';
						?> "/>
						<br />
						
						<input 
						type="password" 
						id="in_<?php echo $tbcampA['campo']?>_2" 
						class="form_input form_input" 
						autocomplete="nope" 
						maxlength="<?php echo $maxlength;?>" 
						style=" <?php
						echo $stylewidth;
						echo ($tbcampA['style'])?$tbcampA['style']:'';
						?> " />
						</div><?php

				break;
				case "paslogin":

						?><input 
						type="password" 
						id="in_<?php echo $tbcampA['campo']?>" 
						class="form_input form-control form-control-sm" 
						autocomplete="nope"
						onkeyup=" if(event.keyCode=='13'){ ax('login',''); } " 
						/><?php

				break;
				case "fch":
													
						?><span id="in_<?php echo $tbcampA['campo']?>_span">
							<input type="text" 
								id="in_<?php echo $tbcampA['campo']?>" 
								name="<?php echo $tbcampA['campo']?>"
								class="form_input form-control form-control-sm" 
								autocomplete="off" 
								data-enabletime="true"
								<?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?> 
								maxlength="<?php echo $maxlength;?>" 
								style=" <?php
									echo $stylewidth;
									echo ($tbcampA['style'])?$tbcampA['style']:'';
									echo ($tbcampA['unique'])?'border:1px solid #666666;':'';
									?>" 
								<?php /* value="<?php echo $tbcampA['default']?>" */ ?>
								value="" 
							/>
						</span><?php

				break;
				case "html": case "txt": case "yot":

						$bootones='';


						if($tbcampA['tipo']=='html'){

							if(sizeof($tbcampA['botones'])>0){ 
							
								if(!is_array($tbcampA['botones'])){
									list($primO,$tablaO,$whereO)=explode("|",$tbcampA['botones']);
									list($nombreO,$textoO)=explode(",",$primO);
									$oopciones=select(array($nombreO,$textoO),$tablaO,procesar_dato($whereO),0);
									//$ryr=0;
									$tbcampA['botones']=array();
									foreach($oopciones as $oOo){
										//$ryr++;
										//if(in_array($ryr,array(2,9))){
										$tbcampA['botones'][$oOo[$nombreO]]=$oOo[$textoO];
										//}
									}
								}
								$ri=0;


								$bootones.='<li class="insert">INSERTAR</li>';
								foreach($tbcampA['botones'] as $name=>$html){ 
								$ri++;	
								$bootones.='<li><a class="btn btn-small" onclick="CKEDITOR.instances.in_'.$tbcampA['campo'].'.insertHtml(document.getElementById(\'booton_'.$tbcampA['campo'].'_'.$ri.'\').value);">'.str_replace(" "," \n",$name).'</a></li>';
								$bootones.='<textarea id="booton_'.$tbcampA['campo'].'_'.$ri.'">'.mooeditable_replace($html,$tbcampA['variables']).'</textarea>';


								}

								if(sizeof($oopciones)==0){ 

								$bootones.='<li>no hay texto <br>para insertar</li>';

								}

								$bootones='<ul class="bootones">'.$bootones.'</ul>';


							}

						}                    		

						?><div class='floatinput <?php
						echo ($tbcampA['tipo']=='html')?" ":"";
						?>'><?php 

						if( $tbcampA['help']) echo '<div class="greyy">'.$tbcampA['help'].'</div>';
						echo ($bootones!='')?$bootones:''; ?>
						<div>
						<textarea class="ckeditor form_input form-control form-control-sm "
						 <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?> 
						 id="in_<?php echo $tbcampA['campo']?>" 
						 class="form_input" 
						 name="<?php echo $tbcampA['campo']?>" <?php
						?>style=" <?php
						echo ($tbcampA['tipo']=='html')?'background-color:#FFF; height:400px; ':"";
						echo ($tbcampA['tipo']=='yot')?'width:300px;height:100px; ':"";
						echo ($tbcampA['style']!='')?str_replace(",","; ",$tbcampA['style']).' ':'';
						?>" autocomplete="nope" rows="6"><?php
						echo ($tbcampA['tipo']=='html')?(($tbcampA['default']=='')?'<p></p>':$tbcampA['default']):$tbcampA['default'];?></textarea><?php
						?></div></div><?php

				break;
				case "multicom":

						?><div class="form_input" style="float:none;display:inline-block; border:0; background:none;"><?php
						foreach($opciones_select as $opcccion=>$opcion_select_a){ list($opcion_select,$color)=explode("|",$opcion_select_a);
						?><div><?php
						?><strong><?php echo $opcion_select;?></strong><?php
						?><input type="checkbox" autocomplete="nope" <?php
						?>id="in_<?php echo $tbcampA['campo']?>_<?php echo $opcccion;?>" <?php
						?>name="<?php echo $tbcampA['campo']?>" <?php
						?>value="<?php echo $opcccion;?>" <?php
						?>title="<?php echo $opcccion; ?>" <?php
						echo ($tbcampA['default']=="$opcccion")?"checked ":" ";
						?>onchange="if(this.checked){ $('in_<?php echo $tbcampA['campo']?>').value=this.value; } "  /><?php
						?></div><?php
						}
						?></div><?php

				break;
				case "bit":

					?><div class="form_input" style="float:none;display:inline-block; ; border:0; background:none;width:auto;"><?php
					?><input id="in_<?php echo $tbcampA['campo']?>" type="hidden" name="<?php echo $tbcampA['campo']?>" <?php
					?>value="<?php echo ($tbcampA['default']=="1")?'1':(($tbcampA['default']=="0")?'0':'');?>" /><?php
					?><input <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?>  type="checkbox" <?php
					?>id="in_<?php echo $tbcampA['campo']?>_check" <?php
					echo ($tbcampA['default']=="1")?"checked ":"";
					?>onchange="$('in_<?php echo $tbcampA['campo']?>').value=(this.checked)?1:0;"  /><?php
					?></div><?php

				break;
				case "com":

					if( $tbcampA['help']) echo '<div class="greyy">'.$tbcampA['help'].'</div>';

					if($tbcampA['radio']=='1' and is_array($tbcampA['opciones'])){


						$opciones_select=array();
						$iti=(is_array($tbcampA['opciones']))?1:0;
						$opciones_select=(is_array($tbcampA['opciones']))?$tbcampA['opciones']:explode(",",$tbcampA['opciones']);

						?><div class="form_input " style="float:none;display:inline-block; ; border:0; background:none;"><?php
						?><input id="in_<?php echo $tbcampA['campo']?>" type="hidden" name="<?php echo $tbcampA['campo']?>"  /><?php
						foreach($opciones_select as $opcccion=>$opcion_select){
						?><strong><?php echo $opcion_select;?></strong><?php
						?><input <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?>  type="radio" <?php
						?>id="in_<?php echo $tbcampA['campo']?>_<?php echo $opcccion;?>" <?php
						?>name="in_<?php echo $tbcampA['campo']?>" <?php
						?>value="<?php echo $opcccion;?>" <?php
						?>title="<?php echo $opcccion; ?>" <?php
						echo ($tbcampA['default']=="$opcccion")?"checked ":" ";
						?>onchange="if(this.checked){ $('in_<?php echo $tbcampA['campo']?>').value=this.value; } "  /><?php
						}
						?></div><?php

					} else {

						?><select 
						autocomplete="nope" <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?> <?php echo ($tbcampA['style']!='')?' style=" '. $tbcampA['style'].' " ':'';?> 
						id="in_<?php echo $tbcampA['campo']?>" 
						class="form_input form-control form-control-sm" 
						name="<?php echo $tbcampA['campo']?>" 
						<?php 
						if(sizeof($tbcampA['eventos'])>0){ ?>
						onchange='<?php
						foreach($tbcampA['eventos'] as $val=>$eve){?>if(this.value=="<?php echo $val;?>"){ <?php echo str_replace("\n","",$eve);?> }<?php }
						?>'<?php 
						}
						?>><?php
							$Htm ='';
							$Htm.='<option selected="selected"></option>';
							$opciones_select=array();
							$iti=(is_array($tbcampA['opciones']))?1:0;
							$opciones_select=(is_array($tbcampA['opciones']))?$tbcampA['opciones']:explode(",",$tbcampA['opciones']);
							foreach($opciones_select as $opcccion=>$opcion_select_a){ list($opcion_select,$color)=explode("|",$opcion_select_a);
							$vvvval=($iti)?$opcccion:$opcion_select;
							$Htm.='<option '.( ($color)?"style='color:".$color.";'":"" ).' value="'.$vvvval.'" ';
							$Htm.=($vvvval==$tbcampA['default'])?"selected":"";
							$Htm.=' >';
							$Htm.= $opcion_select;
							$Htm.= '</option>';
							}
							echo $Htm;
						?></select><?php

					}
				break;
				case "hid":

					if( $tbcampA['help']) echo '<div class="greyy">'.$tbcampA['help'].'</div>';

					if(	($tbcampA['combo']=='1' or $GGET=='') and $tbcampA['opciones']!=''){

						if($tbcampA['directlink']!=''){

							list($ee,$bb,$cc)=explode("|",$tbcampA['directlink']);

							if($tbcampA['crearforeig']){
							?><span id="span_<?php echo $tbcampA['campo']?>_dl"><a href="formulario_quick.php?OT=<?php echo $bb;?>&ran=1&proceso=&parent=<?php echo $this_me;?>" style="float:right !important;margin:0 !important;" class="mb z crearforeig" rel="<?php echo get_dims_crearforeig($bb);?>" <?php
							/*onclick='javascript:crearforeig("<?php echo $bb;?>");return false;' */
							?> ></a></span><?php
							}

							?>
							<input type="text" <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?><?php echo ($tbcampA['style']!='')?' style=" '. $tbcampA['style'].' " ':'';?> id="in_<?php echo $tbcampA['campo']?>_dl" class="form_input" <?php if($tbcampA['onchange']){ echo "onchange=\"".str_replace("\"","'",$tbcampA['onchange'])."\""; } ?> <?php /* ?> onchange="if($('in_<?php echo $tbcampA['campo']?>').value==''){ $('in_<?php echo $tbcampA['campo']?>_dl').value=''; } " <?php */ ?>>
							<input type="hidden" readonly="true" style="width:30px;border:0;background:none;" id="in_<?php echo $tbcampA['campo']?>" name="<?php echo $tbcampA['campo']?>">
							<?php

						} else {

							list($ee,$bb,$cc)=explode("|",$tbcampA['opciones']);

							if($tbcampA['afterload']!='')
								if(!enhay($tbcampA['afterload'],"("))
									$tbcampA['afterload']=$tbcampA['afterload']."()";								

							if($tbcampA['crearforeig']){
							?><a href="formulario_quick.php?OT=<?php echo $bb;?>&ran=1&proceso=&parent=<?php echo $this_me;?>" style="float:right !important;margin:0 !important;" class="mb z crearforeig" rel="<?php echo get_dims_crearforeig($bb);?>" <?php
							/*onclick='javascript:crearforeig("<?php echo $bb;?>");return false;' */
							?> ></a><?php
							}

							$tbcampA['opciones']=($cc)?$tbcampA['opciones']:$ee."|".$bb."|where 1 or id";

							if($tbcampA['multi']=='1'){

									echo '<div class="multisele">';
									foreach($oopciones as $oooo2){
									?><div>
									<input type="checkbox" value="<?php echo $oooo2[$idO]?>" class="multisele_<?php echo $tbcampA['campo'];?>" id="<?php echo $tbcampA['campo']."_".$oooo2[$idO];?>" onchange="multi('<?php echo $tbcampA['campo'];?>')">
									<label for="<?php echo $tbcampA['campo']."_".$oooo2[$idO];?>"><?php
									foreach($camposOA as $COA){	
										echo $oooo2[$COA]." ";	
									}
									?>
									</label></div><?php
									}
									echo '</div>';
									echo '<input type="hidden" id="in_'.$tbcampA['campo'].'" name="'.$tbcampA['campo'].'"  >';

							} else {

								//prin($tbcampA);
								?><select <?php echo ($tbcampA['frozen']=='1')?'disabled':""; ?> 
								id="in_<?php echo $tbcampA['campo']?>" 
								class="form_input form-control form-control-sm" 
								name="<?php echo $tbcampA['campo']?>" 
								<?php echo ($tbcampA['style']=='')?'':" style='".str_replace(",",";",$tbcampA['style'])."' ";
								if( $tbcampA['load']!='' or $tbcampA['onchange']!=''){ 
								?>onchange="<?php

								if($tbcampA['load']!=''){

								$LoaDs=explode(";",$tbcampA['load']);

								foreach($LoaDs as $LoaDd){

								if(enhay(trim($LoaDd),"|checks|")){
								$looop=explode("|checks|",trim($LoaDd));
								?>load_checks('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>','<?php echo $tbcampA['afterload']?>');<?php
								}	

								elseif(enhay($LoaDd,"|html|")){
								$looop=explode("|html|",trim($LoaDd));
								?>load_htmls('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>','<?php echo $tbcampA['afterload']?>');<?php
								}	

								elseif(enhay($LoaDd,"||||")){
								$looop=explode("||||",trim($LoaDd));
								?>load_datos_fecha('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>');<?php
								}

								elseif(enhay($LoaDd,"|||")){
								$looop=explode("|||",trim($LoaDd));
								?>load_datos('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>','','<?php echo $tbcampA['afterload']?>');<?php
								}							

								else{
								$looop=explode("||",trim($LoaDd));
								?>load_combo('<?php echo $looop[0]?>','<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>');<?php
								} } 

								}
								
								if($tbcampA['onchange']!=''){ echo str_replace("\"","'",$tbcampA['onchange'])."(this.value)"; }

								?>"<?php
								}
								?> ><option selected="selected"></option><?php
									foreach($oopciones as $oooo2){
									?><option <?php echo ($GGET==$oooo2[$idO] or $tbcampA['default']==$oooo2[$idO])?"selected":"";?> value="<?php echo $oooo2[$idO]?>" ><?php
									foreach($camposOA as $COA){	
										if($COA=='color') continue;
										echo $oooo2[$COA]." ";	
									}
									?></option><?php
									}
								?></select><?php

							}

						}



					} else {

						?><span style='float:none;display:inline-block; ;<?php echo ($tbcampA['style']=='')?'':" ".str_replace(",",";",$tbcampA['style'])?>'><?php
							foreach($oopciones as $oooo2){ 
								if($GGET==$oooo2['id']){
									foreach($camposOA as $COA){ 
										if($COA=='color') continue;
										echo $oooo2[$COA]." ";	
									}
									//echo $oooo2['nombre'];
								} 
							}
						?></span><?php
						?><input type="hidden" id="in_<?php echo $tbcampA['campo']?>" class="form_input" name="<?php echo $tbcampA['campo']?>" <?php
						?>value="<?php echo $GGET;?>" /><?php
						if($tbcampA['load']!=''){
						$looop=explode("||",$tbcampA['load']);
						}

						if($tbcampA['obj']){
							echo '<span id="in_'.$tbcampA['campo'].'_obj" class="obj"></span>';
						}

					}

					if( $tbcampA['helpafter']) echo '<div class="greyyafter"><div class="text">'.
						$tbcampA['helpafter']['text'].'</div><div class="html">'.$tbcampA['helpafter']['html'].
					'</div></div>';

				break;

			}

			if($tbcampA['label_after']){
				echo '<i>'.$tbcampA['label_after'].'</i>';
			}

		}

		echo ($tbcampA['button_app'])?'<a rel="width:1100,height:720" id="in_'.$tbcampA['campo'].'_button" class="mb z crearforeig" style="float:right !important;margin:0 !important;" href="'.$tbcampA['button_app'].'"></a>':"";
		
		if($mostrarli){
		
			?></li><?php

		}

	}

echo '</div>';

$numShowValCamps=0;

foreach($tbcampos2 as $ty){

	if($ty['validacion=']=='1'){

		$numShowValCamps++;
	}

}
