<?php

set_time_limit(0);
//error_reporting(E_ALL);
	include("lib/global.php");	
	include("lib/conexion.php");
	include("lib/mysql3.php");
	include("lib/util2.php");	 
	include("config/tablas.php");
//	include("lib/sesion.php");	
	include("lib/playmemory.php");
/*
$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_GET['obj']]);
$tbcampos	=	$datos_tabla['form'];
$campo = $_GET['camp'];
foreach($tbcampos as $camp){ 
	//echo $camp['campo']."\n";
	if($camp['campo']==$_GET['objcam']){ 
		$userlabel = $camp['prefijo']; 
		break; 
	}
}
*/



$campo = $_GET['camp'];

$Can = explode("_",$campo);
$CanEnd = end($Can);
$CanE = str_replace("_".$CanEnd,"",$campo);

$userlabel = $objeto_tabla[$_GET['obj']]['campos'][$CanE]['prefijo'];

//$userlabel="temp";

$tb = $_GET['tb'];

?> 
<html><body>
<script>//alert('campo:<?php echo $campo;?>;last:<?php echo $CanEnd;?>;');</script>
<?php

//print_r($_GET);
//print_r($_FILES);

$file_size = $_FILES['v_file_'.$_GET['camp']]['size'];
$file_type = $_FILES['v_file_'.$_GET['camp']]['type'];
$file_temp = $_FILES['v_file_'.$_GET['camp']]['tmp_name']; 
$exA=explode(".",$_FILES['v_file_'.$_GET['camp']]['name']);

$extension = strtolower($exA[sizeof($exA)-1]);

if(in_array($extension,array('jpg','gif','jpeg','png','swf','flv','doc','docx','xls','xlsx','pdf','htm','html','txt','flv','sql')))
{

    if(1)
    {
	    if($file_size < 1024*1024*50)// 50Mb
	    {
            // si el temporal se subi correctamente hacer copias a imagesgrupos_temp
	        if (is_uploaded_file($file_temp))
	        {
				$folder_dest=$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD;
                //$file_name = session_id().time()."-".$file_size;
				$timee=time();
//				list($img_w, $img_h, $tipo, $atr) = getimagesize($file_temp);
//				$file_dest_preview = $userlabel."_".$timee."_".$img_w."x".$img_h."_preview.".$ext; // tambie para _600x380				
				$file_dest_orig = $userlabel."_".$timee.".".$extension;	
//				$file_dest_preview=str_replace(".png",".jpg",$file_dest_preview);
//				$file_dest_orig=str_replace(".png",".jpg",$file_dest_orig);
//				$r_img_confirm2 = ccl_img_uploadmini($file_temp,$ext,$folder_dest,$file_dest_preview,103,103,true);
//				$r_img_confirm3 = ccl_img_uploadmini($file_temp,$ext,$folder_dest,$file_dest_orig,$img_w,$img_h);
				$url_mini = ccl_upload_ftp($file_temp, $folder_dest, $file_dest_orig);
				
//	            mysql_close($conn);
	            ?>
	            <script>
	            parent.upload_terminar_sto("<?php echo $httpfiles.$folder_dest.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.$file_dest_orig ?>",'<?php echo $tb?>','<?php echo $campo?>',"<?php echo $file_dest_orig ?>");
				//parent.document.getElementById('gr_img_peso').value='<?php echo $file_size?>';
	            </script>
	            <?php
	        }
	        else
	        {
	            ?>
	            <script>parent.upload_err_sto('<?php echo _("intente de nuevo.")?>','<?php echo $tb?>','<?php echo $campo?>');</script>
	            <?php
	        }
	    }
	    else
	    {
	        ?>
	        <script>
	        parent.upload_err_sto('<?php echo _("máximo 2Mb")?>','<?php echo $tb?>','<?php echo $campo?>');
	        </script>
	        <?php
	    }
    }
    else
    {
	        ?>
	        <script>
	        parent.upload_err_sto('<?php echo _("No es un archivo válido")?>','<?php echo $tb?>','<?php echo $campo?>');
	        </script>
	        <?php
    }
}
else
{
	?>
	<script>
	parent.upload_err_sto('<?php echo _("No es un archivo válido")?>','<?php echo $tb?>','<?php echo $campo?>');
	</script>
	<?php

}

?>
</body>
</html>
<?php die(); ?>