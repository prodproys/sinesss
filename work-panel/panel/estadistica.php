<?php
$LoadWithoutSession='1';
include("objeto.php");
//prin($_GET);
$DIR=($_GET['dir']!='')?$_GET['dir']."/":'';
?>
<ul class="formulario fst">
	<?php

	?>
	<div class="sv" id="load" style="display: none; top: -30px; left: 0px;">cargando...</div>
	<?php
	?>
	<h1 class="titulo_formulario" id="titulo_stat">
		<?php
		?>
		Gráficos
	</h1>
	<?php 

	foreach($objeto_tabla[$_GET['OB']]['campos'] as $can){
		if($can['queries']=='1'){
			$qus[]=$can;
		}
	}

	$html_filter='<input type="hidden" id="obfs" value="'.$_GET['OB'].'" >';
	$html_filter.='<input type="hidden" id="filtr_fs_orderby" value="" >';
	$html_filter.= '<li>
			<input name="fst" class="rad" checked type="radio" id="fs_alll" value=""  onchange="if(this.checked){ $(\'filtr_fs_orderby\').value=this.value; render_filderST({FECHA}); } " >
			<label for="fs_alll" class="alink">General</label>
			</li>';
	foreach($qus as $querie){
		if($querie['tipo']=='hid' and ($querie['opciones'])){
			$html_filter.= '<li>
			<input name="fst" class="rad" type="radio" id="fs_'.$querie['campo'].'" value="'.$querie['campo'].'" onchange="if(this.checked){ $(\'filtr_fs_orderby\').value=this.value; render_filderST({FECHA}); }"  >
					<label for="fs_'.$querie['campo'].'" class="alink"><b>por</b> '.$querie['label'].'</label>
				</li>';
		} elseif($querie['tipo']=='com'){
			$html_filter.= '<li>
					<input name="fst" class="rad" type="radio" id="fs_'.$querie['campo'].'" value="'.$querie['campo'].'" onchange="if(this.checked){ $(\'filtr_fs_orderby\').value=this.value; render_filderST({FECHA}); } "  >
					<label for="fs_'.$querie['campo'].'" class="alink"><b>por</b> '.$querie['label'].'</label>
						</li>';
		} elseif(in_array($querie['tipo'],array('fch','fcr'))){

			$first=dato('min('.$querie['campo'].')',$tbl,"where ".$querie['campo']."!=0",0);
			$first=(!$first)?date("Y-m-d"):$first;
			//$last =dato($querie['campo'],$tbl,"where 1 order by ".$querie['campo']." desc limit 0,1");
			$last=dato('max('.$querie['campo'].')',$tbl,"where ".$querie['campo']."!=0",0);
			$last=(!$last)?date("Y-m-d"):$last;
			//prin($first);

			$FromYear = substr($first,0,4);
			$FromMonth = substr($first,5,2);
				
			//$ToYear = substr($last,0,4);
			$ToYear = date("Y");
				
			//prin($FiL[$querie['campo']]);
				
			$uno=explode("between",$FiL[$querie['campo']]);
			$dos=explode("and",$uno[1]);
			$ff=str_replace("'","",trim($dos['0']));
			$tt=str_replace("'","",trim($dos['1']));
			$fftt=$ff."|".$tt;

			$html_filter_fecha="<div style='clear:left;'>";
				
			$html_filter_fecha.="<select ".(($FiL[$querie['campo']]!='')?"class='inuse'":"")."  onchange=\"betweenST('".$querie['campo']."',this.value);fechaChangeFilterST('".$querie['campo']."');\">";
				
			$opciones_fechas=opciones_fechas($querie);

			foreach($opciones_fechas as $of){
				$html_filter_fecha.="<option value='".$of['value']."' ".(($of['value']==$fftt)?'selected':'')." ".(($of['class']!='')?"class='".$of['class']."'":'').">".$of['label']."</option>";
			}
				
				
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
				
			$html_filter_fecha.="</select>";
				
				
			$html_filter_fecha.=input_date_filtroST('fs_'.$querie['campo'],$FromYear,$ToYear,($FiL[$querie['campo']])?$FiL[$querie['campo']]:"date(fecha_consulta) between '".substr($first,0,10)."' and '".substr($last,0,10)."'");
				
			$html_filter_fecha.="</div>";
			$terfilSTFECHA=$querie['campo'];
				
		}
	}

	?>
	<div class='filters' style='width: 100%;'>
		<div style='padding: 1px 0 0 20px;'>
			<?php echo $html_filter_fecha; ?>
		</div>
	</div>
	<div style='width: 174px; float: left; margin-top: 10px;'>
		<?php echo str_replace("{FECHA}","'".$terfilSTFECHA."'",$html_filter); ?>
	</div>
	<div style='margin-left: 174px; min-height: 380px;'>
		<object width="550" height="380" type="application/x-shockwave-flash"
			data="<?php echo $DIR;?>js/open-flash-chart.swf" id="my_chart"
			style="visibility: visible;">
			<param name="flashvars"
				value="data-file=<?php echo $DIR;?>load_estadistica.php?b=<?php echo $_GET['OB'];?>||<?php echo $terfilSTFECHA;?>||">
		</object>
		<span id="load_html_estadistica"></span>

	</div>

	<?php /*
	<script type="text/javascript">
	swfobject.embedSWF("js/open-flash-chart.swf", "my_chart","550", "200", "9.0.0", "expressInstall.swf",{"data-file":"load_estadistica.php"} );
	</script>
*/?>

	<?php

	?></ul>
<style>
.bloque_content_stat {
	display: block;
}
</style>
<?php
if(isset($_GET['ran']) and $_GET['ran']!=''){
	include("lib/compresionFinal.php");	/*para Content-Encoding*/ 
} 
?>
