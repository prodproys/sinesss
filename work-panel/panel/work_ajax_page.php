<?php //á

include("lib/includes.php");

include_once($PATH_CUSTOM.$_GET['page'].".php");

include($PATH_CUSTOM."views/dist/".$viewFile.".php");

exit();
