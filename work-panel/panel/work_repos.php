<?php
$LoadWithoutSession='1';
include("objeto.php");
$DIR=($_GET['dir']!='')?$_GET['dir']."/":'';
?>
<form name='labelforms'>
<ul class="formulario fst ">

	<div class="sv" id="load" style="display: none; top: -30px; left: 0px;">cargando...</div>
	<h1 class="titulo_formulario" id="titulo_repos">Reportes</h1>
	<?php

	$reportes=explode("&",$datos_tabla['repos']);

	foreach($objeto_tabla[$_GET['OB']]['campos'] as $can){
		if($can['queries']=='1'){
			$qus[]=$can;
		}
	}


	// prin($reportes);

	// prin($qus);

	//$html_filter='<input type="hidden" id="obfs" value="'.$_GET['OB'].'" >';
	//$html_filter.='<input type="hidden" id="filtr_fs_orderby" value="" >';

	$rpt=0;
	$defaultfilter='';
	foreach($reportes as $rt=>$reporte)
	{
		// prin($reporte);
		$rrrr 	= explode("=",$reporte);
		$rrrr0	= explode("|",$rrrr['1']);
		$rrrr1	= explode(",",$rrrr0['1']);

		$html_filter.= '<li>
		<input style="display:none;" name="report_file" class="option_report_file rad" type="radio" id="rp_'.$rt.'" value="'.$rrrr['0'].'"  '.
		'onchange="if(this.checked){ render_filderRP({FECHA},this); } " data-campos=\''.$rrrr0['1'].'\' '. ( ($rpt==0 and sizeof($reportes)==1)?'checked':'').' >
		<label for="rp_'.$rt.'" class="alink">'.$rrrr0['0'].'</label>
		</li>';
		
		if($rpt==0) $defaultfilter='rp_'.$rt;

		$rpt++;

	}
	// prin($);
	// prin($reportes);

	foreach($qus as $blatacampo=>$querie){

		$blata=($querie['tabla']!='')?$querie['tabla']:$tbl;

		//if(in_array($querie['tipo'],array('fch','fcr'))){

		if(in_array($querie['campo'],$rrrr1))
		
		if(in_array($querie['tipo'],array('fcr','fch'))){

			$Fechaaa[]=$querie['campo'];

			$first=dato('min('.$querie['campo'].')',$tbl,"where ".$querie['campo']."!=0",0);
			$first=(!$first)?date("Y-m-d"):$first;
			//$last =dato($querie['campo'],$tbl,"where 1 order by ".$querie['campo']." desc limit 0,1");
			$last=dato('max('.$querie['campo'].')',$tbl,"where ".$querie['campo']."!=0",0);
			$last=(!$last)?date("Y-m-d"):$last;
			


			$FromYear = substr($first,0,4);
			$FromMonth = substr($first,5,2);

			//$ToYear = substr($last,0,4);
			$ToYear = date("Y");

			// prin($FiL[$querie['campo']]);


			$uno=explode("between",$FiL[$querie['campo']]);
			$dos=explode("and",$uno[1]);
			$ff=str_replace("'","",trim($dos['0']));
			$tt=str_replace("'","",trim($dos['1']));
			$fftt=$ff."|".$tt;

			// $fftt=substr($first,0,10)."|".substr($last,0,10);
			// prin($fftt);

			$html_filter_fecha="<div id='repo_fil_".$querie['campo']."' class='repo_fils' style='display:inline-block;'>";

			$html_filter_fecha.="<select rel='".$querie['campo']."' class='stfilters ".(($FiL[$querie['campo']]!='')?"inuse":"")."' onchange=\"betweenST('".$querie['campo']."',this.value);fechaChangeFilterST('".$querie['campo']."');\">";

			$opciones_fechas=opciones_fechas($querie);

			foreach($opciones_fechas as $of){

				$html_filter_fecha.="<option value='".$of['value']."' ".(($of['value']==$fftt)?'selected':'')." ".(($of['class']!='')?"class='".$of['class']."'":'').">".$of['label']."</option>";

			}

			/*
			if(0){

				$html_filter_fecha.="<option value='' class='empty'>".$querie['label']."</option>";
				//DATE(myDate) = DATE(NOW())"Y-m-d H:i:s"
				$fron=date("Y-m-d");
				$ton=date("Y-m-d");
				$quer2=$fron."|".$ton;
				$html_filter_fecha.="<option ".(($quer2==$fftt)?'selected':'')." value=\"".$quer2."\">Hoy</option>";

				$fron=date("Y-m-d",strtotime("-".(date("N")-1)." days"));
				$ton=date("Y-m-d",strtotime("+".( 7 - date("N"))." days"));
				$quer2=$fron."|".$ton;
				$html_filter_fecha.="<option ".(($quer2==$fftt)?'selected':'')." value=\"".$quer2."\">Esta Semana</option>";

				$yy=date("Y");$mm=date("m");
				for($i=0;$i<12+date("m");$i++){
					if($mm==0){
						$yy=$yy-1; $mm=12;
					}
					$ym[]="$yy-".sprintf("%02d",$mm);
					$mm=$mm-1;
				}

				foreach($ym as $my=>$mmy){
					$tt=date("t",date($mmy."-01"));
					$fron=date($mmy."-01");
					$ton =date($mmy."-$tt");
					$quer2=$fron."|".$ton;
					list($yeamy,$monmy)=explode("-",$mmy);
					$mos=$Array_Meses[$monmy*1]; $nmons=strlen($mos);
					$mmyy=ucfirst($mos).str_repeat("&nbsp;",9-$nmons);
					$mmyy.=" ".$yeamy;
					$html_filter_fecha.="<option ".(($quer2==$fftt)?'selected':'')." value=\"".$quer2."\">".$mmyy.(($mmy==date("Y-m"))?" Este Mes":"")."</option>";
				}

				for($ii=$ToYear;$ii>=$FromYear;$ii--){
					$fron=date($ii."-01-01");
					$ton =date($ii."-12-31");
					$quer2=$fron."|".$ton;
					$html_filter_fecha.="<option class='filyer' ".(($quer2==$fftt)?'selected':'')." value=\"".$quer2."\">".$ii.(($ii==date("Y"))?" Este Año":"")."</option>";
				}

			}
			*/

			$html_filter_fecha.="</select>";

			$FiL['fs_'.$querie['campo']]=substr($first,0,10)."|".substr($last,0,10);
			// prin("$FromYear,$ToYear");
			$html_filter_fecha.=input_date_filtroST('fs_'.$querie['campo'],$FromYear,$ToYear,($FiL[$querie['campo']])?$FiL[$querie['campo']]:"date(fecha_consulta) between '".substr($first,0,10)."' and '".substr($last,0,10)."'");

			$html_filter_fecha.="</div>";

			$terfilSTFECHA=$querie['campo'];


		} elseif(in_array($querie['tipo'],array('hid','user')) and ($querie['opciones'])){


			/*
			if($querie['select_multiple']=='1'){

				$html_filter='';

				list($uno,$slex)=explode("=",$FiL[$blata][$querie['campo']]);
				$selex=explode(",",$slex);


				list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);
				$whereO=str_replace("where 0","where 1",$whereO);
				//echo "$primO,$tablaO,$whereO";
				list($idO,$camposO)=explode(",",$primO);

				$oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,(($whereO)?$whereO:"where 1 ").get_extra_filtro_0($tablaO));
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

				list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);
				$whereO=str_replace("where 0","where 1",$whereO);
				list($prim0id,$prim0nombre)=explode(",",$primO);

				// prin($FiL[$blata][$querie['campo']]);

				$html_filter.="<span class='filfchspan'>".$querie['label']."</span>";
				$html_filter.="<input type='text' id='filtr_".$querie['campo']."_dl' ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." value='";

				$fila=fila(array("CONCAT_WS(' ',". str_replace(";",",",$prim0nombre) .") as v"),$tablaO,"where id='".str_replace($blata.".".$querie['campo']."%3D","",urlencode($FiL[$blata][$querie['campo']]))."'",0);

				$html_filter.=$fila['v'];
				$html_filter.="' onchange=\"render_filder();\" >";-

				$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value='".urlencode($FiL[$blata][$querie['campo']])."' >";
				$html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value=\"load_directlink_filtro_com('".$querie['campo']."','".$prim0id."','".$prim0nombre."','".$tablaO."','".$whereO."','".$blata."');\" class='jsloads' >";

				//$html_filter.="<script>load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."');</script>";
				$terfil[$blata][]=$querie['campo'];

				$html_filter_A[$querie['campo']]=$html_filter;

			} else { */




					list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);
					$whereO=str_replace("where 0","where 1",$whereO);
					//echo "$primO,$tablaO,$whereO";
					list($idO,$camposO)=explode(",",$primO);

					$camposO=str_replace(";color", "", $camposO);
					$oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,(($whereO)?$whereO:"where 1 ").get_extra_filtro_0($tablaO));

						$html_filtro='';
						$html_filtro.='<span id="repo_fil_'.$querie['campo'].'" class="repo_fils">';
						$html_filtro.="<label style='width:auto;padding-right:10px;'>".$querie['label']."</label>";

						$html_filtro.="<select rel='".$querie['campo']."' style='width:".(($querie['width'])?$querie['width']:'100px').";' class='stfilters ".( ($FiL[$blata][$querie['campo']]!='')?"inuse":"" )."' id='filtr_fs_".$querie['campo']."' onchange=\"render_filderST();\">";
						$html_filtro.="<option value='' class='empty'>".$querie['label']."</option>";
						foreach($oopciones as $pppooo){
							// $quer=urlencode($blata.".".$querie['campo']."=".$pppooo[$idO]);
							$quer=$pppooo[$idO];
							$html_filtro.="<option ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." value=\"".$quer."\">".$pppooo['value']."</option>";
						}
						$html_filtro.="</select>";
						$html_filtro.='</span>';

					$terfil[$blata][]=$querie['campo'];
					
					// prin($html_filtro);

					$html_filter_A[$querie['campo']]=$html_filtro;	



			// }

		}



	}

	// prin($html_filter_fecha_A);

	?>
	<div class='filters' style='width: 100%;'>
		<div style='padding: 1px 0 0 20px;'>
			<?php echo $html_filter_fecha.implode("\n",$html_filter_A); ?>
		</div>
	</div>


	<ul class='nav nav-tabs' style='<?php if(sizeof($reportes)==1){ echo "display:none;"; } ?>'>
		<?php
		echo str_replace("{FECHA}","'".$terfilSTFECHA."'",$html_filter);
		//echo $html_filter;
		?>
	</ul>

	<div id="html_reporte"><?php
		/*
		$rrrr=explode("=",$reportes['0']);
		$_GET['f']=$Fechaaa['0']."||";
		$_GET['file']=$rrrr['0'];
		$_GET['ajax']=0;
		//echo getcwd();
		include("load_html_reportes.php");
		*/
	?></div>

</ul>
</form>
<input type='hidden' id="evalScripts_repo" value="<?php if($defaultfilter!=''){ ?> $('<?php echo $defaultfilter; ?>').checked=true; render_filderRP('',$('<?php echo $defaultfilter; ?>'));<?php } ?>" >
<style>
.bloque_content_stat {
	display: block;
}
</style>
<?php
if(isset($_GET['ran']) and $_GET['ran']!=''){
	include("lib/compresionFinal.php");	/*para Content-Encoding*/
}

