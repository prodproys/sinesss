<?php //á

include("lib/includes.php");

$id_permiso=$_SESSION['PERMISOS_ID'];

include($PATH_CUSTOM."controllers/".$_GET['page'].".php");

include($PATH_CUSTOM."views/dist/".$viewFile.".php");
// include($PATH_CUSTOM."views/dist/view_".$_GET['page'].".php");
