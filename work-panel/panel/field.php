<?php //á
$Local=($_SERVER['SERVER_NAME']=="localhost" or $_SERVER['SERVER_NAME']=="127.0.0.1")?1:0;

include("lib/includes.php");

include("lib/compresionInicio.php");

include("head.php");

$params=filtrarGET($SERVER['PARAMS'],array('me','paso','error'));

// $_GET['paso']=($_GET['paso'])?$_GET['paso']:'first';

$ddd=explode(",",$_GET['get']);

?>
<body class="monitor popup">

	<div id="div_allcontent" class="div_allcontent ">

		<div id="inner" class="inner_listado">
			
		<?php echo dato($ddd['1'],$ddd['0'],'where id='.$ddd['2'],0); ?>

		</div>

	</div>

</body>
</html>
<?php
include("lib/compresionFinal.php");