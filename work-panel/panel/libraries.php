<?php
//prin($vars);
?>
<div>
<h1 style="font-weight:bold; clear:left;">LIBRARIES</h1>

<?php foreach($LIBRARIES as $LIB){ ?>
<div class='cuadro_codigo bloque'>
<h2 style="font-weight:bold; clear:left; color:#003366; font-size:12px; text-transform:uppercase;"><?php echo $LIB['name'];?></h2>
<pre style="padding-left:20px;">
<?php

	$lines=explode("\n",$LIB['value']);
	$PAR=array();
	foreach($lines as $line){	
		if(trim($line)!=''){
			list($uno,$dos,$tres)=between($line,"{","}");
			$uno=trim(str_replace(array(":"),array(""),strtolower($uno)));
			if(trim($dos)!=''){
			$cuatro=explode(",",$dos);
			$nn=(sizeof($cuatro)==1)?"":"\n";
			$tt=(sizeof($cuatro)==1)?"":"\t\t";
			echo "\$var['$uno']=array(".$nn;
			unset($ocho);
			foreach($cuatro as $cinco){
				list($seis,$siete)=explode(":",$cinco);
				$seis=trim($seis);
				$siete=trim($siete);
				$ocho[]=$tt."'$seis'=>'$siete'";
			}
			echo implode(",\n",$ocho);
			echo $nn.");\n";
			}
		}
	}
	 

?>

</pre>
</div>
<?php } ?>

</div>