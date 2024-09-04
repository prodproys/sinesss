<?php //á

$archivo="base2/".$_GET['correlativo'].".txt";
// if(!file_exists($archivo)) die("el archivo ".$_GET['correlativo'].".txt no existe");

$antes=implode("",file($archivo));

echo $_GET['correlativo'].".txt";
echo "<br>antes era ".$antes;
echo "<br>ahora es ".$_GET['numero'];

$f1=fopen($archivo,"w+");
fwrite($f1,$_GET['numero']);
fclose($f1);



