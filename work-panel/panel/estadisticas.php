<style>
.anio {
	position: relative;
	margin-bottom: 4px;
}

.anio .mes {
	position: absolute;
	top: 0px;
	width: 65px;
	text-align: center;
	background-color: #ccc;
}

.anio .selected {
	background-color: #FF3300;
	color: #FFFFFF;
}
</style>
<div class='anio' style="clear: left;">
	<b><a href="tools.php?tab=estadisticas" style="width: 100px;"
		class="mes <?php echo ($_GET['anio']=='' and $_GET['file']=='')?"selected":"" ?>">Estadísticas</a>
	</b>:
</div>

<?php

$Array_Meses1=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","setiembre","octubre","noviembre","diciembre");

$Array_Semanas0=array('Mon'=>"lun",'Tue'=>"mar",'Wed'=>"mie",'Thu'=>"jue",'Fri'=>"vie",'Sat'=>"sab",'Sun'=>"dom");

//prin(date("L",strtotime("2007-01-01")),"#FFFFFF");

//exit();

list($uno,$dos)=explode("/public_html/",getcwd());

$DirAw="$uno/tmp/awstats";

$server=$vars['GENERAL']['dominio_estadisticas'];

$directorio = dir("$DirAw/");
while($fichero=$directorio->read()) {

	if($fichero!='.' and $fichero!='..'  and !is_dir($DirAw."/".$fichero) and (substr($fichero,0,7)=="awstats") and (substr($fichero,-4)==".txt") ){

		$suf=explode(".",$fichero);
		$fech=substr($suf[0],7);
		$mes=substr($fech,0,2);
		$ano=substr($fech,2,4);
		$fech2=($ano.$mes)*1;
		$Ffiles[$ano][$mes]='<a
		style="left:'. ($mes*70) .'px;"
		href="tools.php?tab=estadisticas&file='.$fech.'"
		class=" mes ' . (($fech==$_GET['file'])?"selected":"") .'"
		>'.$Array_Meses1[1*$mes].'</a>';
			
		$FfilesParam[$ano][$mes]=$fech;
			
	}
}
$directorio->close();

ksort($Ffiles);

foreach($Ffiles as $an=>$FFF){
	echo "<div class='anio'>";
	echo "<b><a href='tools.php?tab=estadisticas&anio=$an' class='mes ". (($_GET['anio']==$an)?"selected":"") ."'>$an</a></b> : ";
	ksort($FFF);
	echo implode("",$FFF);
	echo "</div>";
	}


	?>
<style>
.img_chart {
	position: absolute;
	top: 40px;
	right: 10px;
}
</style>
<div class='cuadro_codigo bloque'
	style='position: relative; height: auto !important; height: 800px; min-height: 800px;'>
	<?php //<pre> ?>
	<?php

	require("lib/class.awfile.php");

	if($_GET['anio']=='' and $_GET['file']==''){

		ksort($FfilesParam);

		foreach($FfilesParam as $anio=>$Fff){

			ksort($Fff);

			$Rang[$anio]=array_fill(1,12,0);

			foreach($Fff as $File){

				$ano=substr($File,2,4);
					
				$mes=substr($File,0,2);
					
				$file=$DirAw."/awstats".$File.".".$server.".txt";
				//echo prin("|".$file."|");
				$aw = new awfile($file);
				if ($aw->Error()) die($aw->GetError());
					
				$Rang[$anio][$mes*1]=$aw->GetVisits();

			}

			$Anios[]="<div style='float:left;width:" . ( intval(100/sizeof($FfilesParam)) ) . "%;text-align:center;'>".$anio."</div>";


		}
			
		//prin($Rang,"#FFFFFF");

		echo "Visitas por mes:<br />";

		echo "<table cellspacing=0 cellpadding=0 border=0>";
		$pp=0;
		foreach ($Rang as $a=>$m){
			foreach ($m as $d=>$p){
				echo "<tr style=' border-bottom:1px dashed #000;'>
				<td style='padding:1px 5px 1px 0;'><b>$a ".$Array_Meses1[$d*1]."</b></td>
		<td>".$p." visitas</td>
		</tr>";
				$pp=$pp+$p;
				$y_data[]=$p;
				$x_data[]=substr($Array_Meses1[$d],0,1);
			}
		}
		echo "<tr><td>TOTAL</td><td><b>$pp</b></tr>";
		echo "</table><br><br>";

		echo "<div class='img_chart'>";
		echo "<img src='http://chart.apis.google.com/chart".chart_data($y_data,$x_data,"$server - Visitas: Totales","66CC99",700,400)."'><br />";
		echo "<div>". ( implode("",$Anios) ) ."</div>";
		echo "</div>";


	}

	if($_GET['anio']!=''){

		ksort($FfilesParam[$_GET['anio']]);

		$Rang=array_fill(1,12,0);

		foreach($FfilesParam[$_GET['anio']] as $File){

			$ano=substr($File,2,4);

			$mes=substr($File,0,2);

			$file=$DirAw."/awstats".$File.".".$server.".txt";

			$aw = new awfile($file);
			if ($aw->Error()) die($aw->GetError());

			$Rang[$mes*1]=$aw->GetVisits();

		}
			
		//prin($Rang,"#FFFFFF");

		echo "Visitas por mes:<br />";

		echo "<table cellspacing=0 cellpadding=0 border=0>";
		$pp=0;
		foreach ($Rang as $d=>$p){
			echo "<tr style=' border-bottom:1px dashed #000;'>
			<td style='padding:1px 5px 1px 0;'><b>".$Array_Meses1[$d*1]."</b></td>
			<td>".$p." visitas</td>
			</tr>";
			$pp=$pp+$p;
			$y_data[]=$p;
			$x_data[]=substr($Array_Meses1[$d],0,3);

		}
		echo "<tr><td>TOTAL</td><td><b>$pp</b></tr>";
		echo "</table><br><br>";

		echo "<div class='img_chart'>";
		echo "<img src='http://chart.apis.google.com/chart".chart_data($y_data,$x_data,"$server - Visitas: ".$_GET['anio'],"66CC99",700,400)."'><br />";
		echo "</div>";


	}

	if($_GET['file']!=''){

		$getfile=$_GET['file'];

		$ano=substr($getfile,2,4);

		$mes=substr($getfile,0,2);

		$diasmes=array(1=>"31",2=>(date("L",strtotime("$ano-01-01")))?"29":"28",3=>"31",4=>"30",5=>"31",6=>"30",7=>"31",8=>"31",9=>"30",10=>"31",11=>"30",12=>"31");

		$dias_en_mes=$diasmes[1*$mes];

		$file=$DirAw."/awstats".$_GET['file'].".".$server.".txt";

		$aw = new awfile($file);
		if ($aw->Error()) die($aw->GetError());

		echo "<br />";

		echo "<b>".$Array_Meses1[$mes*1]." $ano"."</b><br /><br />";

		echo "Visitas totales : ".$aw->GetVisits()."<br />";

		echo "Visitas Únicas : ".$aw->GetUniqueVisits()."<br /><br />";

		echo "Visitas por día:<br />";

		$Rang=array_fill(1,$dias_en_mes,0);

		foreach ($aw->GetDays() as $day=>$pages){
			$Rang[1*substr($day,6,2)]=$pages;
		}
		echo "<table cellspacing=0 cellpadding=0 border=0>";
		$pp=0;
		foreach ($Rang as $d=>$p){
			echo "<tr style=' border-bottom:1px dashed #000;'>
				<td style='padding:1px 5px 1px 0;'><b>". ($Array_Semanas0[date("D",strtotime($ano."-".$mes."-".$d))]) ." ".$d." ".substr($Array_Meses1[$mes*1],0,3)."</b></td>
				<td>".$p." visitas</td>
				</tr>";
			$pp=$pp+$p;
			$y_data[]=$p;
			$x_data[]=$d;

		}
		echo "<tr><td>TOTAL</td><td><b>$pp</b></tr>";
		echo "</table><br><br>";

		echo "<div class='img_chart'>";
		echo "<img src='http://chart.apis.google.com/chart".chart_data($y_data,$x_data,"$server - Visitas: ".$Array_Meses1[$mes*1]." $ano","DE091A",700,400)."'><br />";
		echo "</div>";

		echo "<b>Referers Distintos:</b><br />";
		foreach ($aw->GetReferers() as $referer=>$hits){
			echo "<div><em>".$referer.": ".$hits." hits.</em></div>";
		}
		echo "<br />";

		echo "<b>Visitas / Rangos de visita:</b><br />";
		foreach ($aw->GetRanges() as $range=>$visits){
			echo "<div><em>".$range.": ".$visits." visits.</em></div>";
		}
		echo "<br />";


		/*
		 echo "The site first visit in the month: ".$aw->GetFirstVisit()."<br /><br />";
		*/

		/*echo "Pages viewed / hours:<br />";
		 foreach ($aw->GetHours() as $hour=>$pages)
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<em>".str_pad($hour, 2, "0", STR_PAD_LEFT).": ".$pages." pages viewed.</em><br />";
		*/
		/*
		 $betterDay = $aw->GetBetterDay();
		echo "The day with more visitors(".$betterDay[1].") was the ".$betterDay[0].".<br /><br />";
		*/

		/*
		 echo "hits / os:<br />";
		foreach ($aw->GetOs() as $os=>$hits)
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<em>".$os.": ".$hits." hits.</em><br />";
		echo "<br />";
		*/
		/*
		 echo "hits / browser:<br />";
		foreach ($aw->GetBrowser() as $browser=>$hits)
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<em>".$browser.": ".$hits." hits.</em><br />";
		echo "<br />";
		*/




	}

	function chart_data($y_data,$x_data,$titulo,$color,$width,$height) {

	$WIDTH=intval($width/(sizeof($x_data)*1.03))-10;
	// Port of JavaScript from http://code.google.com/apis/chart/
	// http://james.cridland.net/code

	// First, find the maximum value from the values given

	$maxValue = max($y_data);

	// A list of encoding characters to help later, as per Google's example
	$simpleEncoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	$chartData = "s:";
	for ($i = 0; $i < count($y_data); $i++) {
    $currentValue = $y_data[$i];

    if ($currentValue > -1) {
    $chartData.=substr($simpleEncoding,61*($currentValue/$maxValue),1);
    }
    else {
      $chartData.='_';
      }
  }

  $step=intval($maxValue/20);
  $step=($step==0)?1:$step;

  $yy=range(1,$maxValue,$step);
  if($yy[sizeof($yy)-1]!=$maxValue){
$yy[]=$maxValue;
}
$y2=$maxValue+2;
// Return the chart data - and let the Y axis to show the maximum value

$url = "?chtt=".urlencode($titulo);
$url.= "&chts=003366";
$url.= "&cht=bvg";
$url.= "&chs=".$width."x".$height;
$url.= "&chco=".$color;
$url.= "&chxt=x,y";
$url.= "&chd=".$chartData;
$url.= "&chxl=0:|".implode("|",$x_data)."|1:|0|".implode("|",$yy);
$url.= "&chbh=$WIDTH,0,10";
$url.= "&chg=0,10,5,5";
if(sizeof($x_data)<=31){
//$url.= "&chm=N,000000,0,-1,9";
$url.= "&chf=c,lg,90,eeeeee,0.5,ffffff,0|bg,s,EFEFEF";
} else {
$xxx=sizeof($x_data)/12;
$xx2=intval(100/$xxx)/100;
$url.= "&chf=c,ls,0,CCCfff,$xx2,ffffff,$xx2";
}


return $url;

}

?>
	<?php //</pre>?>
</div>
