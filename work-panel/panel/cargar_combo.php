<?php //á

set_time_limit(0);
//error_reporting(E_ALL);
include("lib/compresionInicio.php");
include("lib/includes.php");

$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_GET['obj']]);
$tbcampos	=	$datos_tabla['form'];

$campo = $_GET['camp'];
foreach($tbcampos as $camp){
	//echo $camp['campo']."\n";
	if($camp['campo']==$campo){
		$tbcampA = $camp;
		break;
	}
}

$sss=explode("|",$_GET['s']);
$opciones=select($sss['0'],$sss['1'],$sss['2']."=".$_GET['s2']);

?>
<select id="in_<?php echo $tbcampA['campo'];?>" class="form_input"
<?php echo ($tbcampA['style'])?'style="'.str_replace(",",";",$tbcampA['style']).'"':"";?>
<?php if($tbcampA['load']!=''){
$looop=explode("||",$tbcampA['load']); ?>
	onchange="cargar_combo('<?php echo $looop[0]?>','<?php echo $looop[1]?>',this.value);"
	<?php }?>><option selected="selected"></option>
	<?php 
	foreach($opciones as $oooo2){
    ?><option value='<?php echo $oooo2['id']?>'>
		<?php echo fixEncoding($oooo2['nombre'])?>
	</option>
	<?php
    }
    ?>
</select>
<?php

include("lib/compresionFinal.php");
?>