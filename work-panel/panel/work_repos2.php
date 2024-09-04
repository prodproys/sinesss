<?php //á
$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

include("lib/includes.php");

include("head.php");

$params=filtrarGET($SERVER['PARAMS'],array('me','paso','error'));

$_GET['paso']=($_GET['paso'])?$_GET['paso']:'first';


?>
<body class="monitor popup">

	<div id="div_allcontent" class="div_allcontent ">
			
		<div id="inner" class="inner_listado"><?php include($PATH_CUSTOM."/base2/apps/".$_GET['app'].".php"); ?></div>

	</div>

</body>
</html>
<?php
