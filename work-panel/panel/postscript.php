<?php //á
// print_r($_REQUEST);

$script=$psc;
$SS=$_GET['f'];
$PP=$_GET['proceso'];
$II=$iii;
$AA=explode(",",$II);
$TT=$tbl;
// SS : proceso IUD
// PP : proceso especiales
// TT : tabla
// II : id
// III: ids
// LL : fila
foreach($objeto_tabla[$_REQUEST['v_o']]['campos'] as $Pcamps){
$Pcampos[]=$Pcamps['campo'];
}
$CC=$Pcampos;
$LL=fila($CC,$TT,"where id='$II'");

// print_r(array($SS,$II,$TT,$LL,$CC,$III));
// exit();

$script=str_replace(array("CC","SS","II","TT","LL","PP","AA"),array("\$CC","\$SS","\$II","\$TT","\$LL","\$PP","\$AA"),$script);
// echo "\n\n\n\n\n\n\n".$script."\n\n\n\n\n\n\n";
eval($script);
