<?php
echo "//inicio\n";
foreach($tbcampos as $tbcampA){
	switch($tbcampA['tipo']){
		case "fch":
			if($tbcampA['rango']){
				list($uuno,$ddos)=explode(",",$tbcampA['rango']);
				$FromYear = date("Y",strtotime($uuno));
				$ToYear = date("Y",strtotime($ddos));
			} else {
				$FromYear = date("Y")-99;
				$ToYear = date("Y")+1;
			}
			?>
			load_calendar('in_<?php echo $tbcampA['campo']?>','<?=$FromYear?>','<?=$ToYear?>');
			<?php
			/*
			?>
			input_date('in_<?php echo $tbcampA['campo']?>','in_<?php echo $tbcampA['campo']?>_span',<?php echo $FromYear;?>,<?php echo $ToYear;?>,'<?php echo $tbcampA['time'];?>','<?php echo $tbcampA['months'];?>');
			<?php if(trim($tbcampA['default'])!=''){
			if(trim($tbcampA['default'])=="now()"){ $tbcampA['default']=($tbcampA['time']==1 or $tbcampA['time']==2)?date("Y-m-d H:00:00"):date("Y-m-d H:i:s"); }
			if(trim($tbcampA['default'])=="tomorrow()"){ $tbcampA['default']=($tbcampA['time']==1 or $tbcampA['time']==2)?date("Y-m-d H:00:00",strtotime("+1 day")):date("Y-m-d H:i:s",strtotime("+1 day")); }
			?>
			$('in_<?php echo $tbcampA['campo']?>_d').value='<?php echo substr($tbcampA['default'],8,2);?>';
			$('in_<?php echo $tbcampA['campo']?>_m').value='<?php echo substr($tbcampA['default'],5,2);?>';
			$('in_<?php echo $tbcampA['campo']?>_a').value='<?php echo substr($tbcampA['default'],0,4);?>';
			$('in_<?php echo $tbcampA['campo']?>_t').value='<?php echo substr($tbcampA['default'],11,8);?>';
			$('in_<?php echo $tbcampA['campo']?>').value='<?php echo $tbcampA['default']?>';
			<?php }
			*/
		break;
		case "html":
			?>var html_<?php echo $tbcampA['campo']?> = CKEDITOR.replace( '<?php echo $tbcampA['campo']?>' );<?php		
		break;
		case "hid":
			if($tbcampA['directlink']!=''){

				$GGET1=$_GET[str_replace(array("[","]"),array("",""),$tbcampA['default'])];
				// prin($GGET1);
				$GGET2=$_SESSION[str_replace(array("[","]"),array("",""),$tbcampA['default'])
				];
				$GGET=($GGET1!='')?$GGET1:$GGET2;

				if($tbcampA['afterload']!='')
					if(!enhay($tbcampA['afterload'],"("))
						$tbcampA['afterload']=$tbcampA['afterload']."()";


				// echo 'console.log("'.$uno.'");';
				// echo 'console.log("'.$dos.'");';
				// echo 'console.log("'.$tres.'");';
				// echo 'console.log("'.$minchar.'");';
				
				list($uno,$dos,$tres,$minchar)=explode("|",$tbcampA['directlink']);

				if($GGET!=''){

					list($dlid,$dlcampos)=explode(',',$uno);
					$dlnameA=fila(str_replace(";",",",$dlcampos),$dos,"where $dlid=$GGET",0);
					$dlname=implode(" ",$dlnameA);
					// echo 'console.log("'.$dlname.'");';
					echo 'console.log("por siacaso");';
					?>
					$('la_<?php echo $tbcampA['campo']?>').after('<?php echo $dlname;?>');
					<?php
				
				} else {

				?>
				new Meio.Autocomplete.Select('in_<?php echo $tbcampA['campo']?>_dl', "load_json.php?s=<?php echo $uno."|".$dos."|".$tres;?>", {
					minChars:<?php echo ($minchar!='')?$minchar:1; ?>,
					selectOnTab :true,
					maxVisibleItems:12,
					requestOptions: {'method':'get'},
					valueField: $('in_<?php echo $tbcampA['campo']?>'),
					valueFilter: function(data){
						$('in_<?php echo $tbcampA['campo'];?>').value=data.i;
						<?php if($tbcampA['ondlselect']=='1'){ echo "ondlselect(data.i);"; } ?>
						<?php if($tbcampA['load']!=''){
								$LoaDs=explode(";",$tbcampA['load']);
								foreach($LoaDs as $LoaDd){

								if(enhay($LoaDd,"||||")){
								$looop=explode("||||",trim($LoaDd));
								?>load_datos_fecha('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>','','<?php echo $tbcampA['afterload']?>');<?php
								}

								elseif(enhay($LoaDd,"|||")){
								$looop=explode("|||",trim($LoaDd));
								?>load_datos('<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>','','<?php echo $tbcampA['afterload']?>');<?php
								}

								else{
								$looop=explode("||",trim($LoaDd));
								?>load_combo('<?php echo $looop[0]?>','<?php echo procesar_loads($looop[1],$tbcampA['campo'])?>');<?php
								} }

								} ?>
						return data.i;
					},
					syncName: false,
					filter: {
						type: 'contains',
						path: 'v'
					},
				});
				<?php
				}
			} else {

				$GGET1=$_GET[str_replace(array("[","]"),array("",""),$tbcampA['default'])];
				// prin($GGET1);
				$GGET2=$_SESSION[str_replace(array("[","]"),array("",""),$tbcampA['default'])
				];
				$GGET=($GGET1!='')?$GGET1:$GGET2;
				// echo "//tema=$GGET\n";
					list($primO,$tablaO,$whereO)=explode("|",$tbcampA['opciones']);
					list($idO,$camposO)=explode(",",$primO);
					$camposOA=array();
					$camposOA=explode(";",$camposO);
				$oopciones=select(array_merge(array($idO),$camposOA),$tablaO,procesar_dato($whereO),0);
				// echo "va1\n";
				if(!($tbcampA['combo']=='1' or $GGET=='' )){
				// echo "va2\n";
				// print_r($tbcampA);
				if($tbcampA['load']!=''){
				// echo "va3\n";
				$looop=explode("||",$tbcampA['load']);
				/*?>$("in_<?php echo $tb?>_<?php echo $tbcampA['campo']?>").value='';<?php*/
				?>load_combo('<?php echo $looop[0]?>','<?php echo $looop[1]?>','<?php echo $GGET;?>');<?php
				}
				}

			}
		break;
		case "img":?>$("upl_<?php echo $tb?>_<?php echo $tbcampA['campo']?>_0").innerHTML=render_upload('<?php echo $tb?>','<?php echo $tbcampA['campo']?>','','<?php echo $USU_IMG_DEFAULT;?>','<?php echo $tbcampA['image_library'];?>');setTimeout("charge_multibox('.mbb')",1000);<?php
		break;
		case "sto":?>$("upl_<?php echo $tb?>_<?php echo $tbcampA['campo']?>_0").innerHTML=render_upload_sto('<?php echo $tb?>','<?php echo $tbcampA['campo']?>','','<?php echo $USU_IMG_DEFAULT;?>');<?php
		break;
	}
}

echo "//fin\n";