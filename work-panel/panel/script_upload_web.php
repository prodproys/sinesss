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
$ID = $_GET['ID'];
$userlabel="temp";
//$tb = $_GET['tb'];

?>  
<html>
<?php

$file_size = $_FILES['v_file_'.$_GET['ID']]['size'];
$file_type = $_FILES['v_file_'.$_GET['ID']]['type'];
$file_temp = $_FILES['v_file_'.$_GET['ID']]['tmp_name']; 
$exA=explode(".",$_FILES['v_file_'.$_GET['ID']]['name']);
$extension = strtolower($exA[sizeof($exA)-1]);

if($extension == "jpg" || $extension == "gif" || $extension == "jpeg" || $extension == "png")
{
	$img_valida = false;
	// extensin de la imagen y validacin de su formato
    switch($extension)
    {   
		case "jpeg":
		
    		 $ext = "jpg";
    		 if(@imagecreatefromjpeg($file_temp))
	    		 $img_valida = true;

    	break;
        case "jpg":
		
             $ext = "jpg";
    		 if(@imagecreatefromjpeg($file_temp))
	    		 $img_valida = true;

        break;
        case "gif":

        	$ext = "gif";
    		 if(@imagecreatefromgif($file_temp))
	    		 $img_valida = true;

        break;
        case "png":

        	$ext = "png";
    		 if(@imagecreatefrompng($file_temp))
	    		 $img_valida = true;
				 
        break;		
    }

    if($img_valida == true)
    {
	    if($file_size < 1024*1024*20)// 1Mb
	    {
            // si el temporal se subi correctamente hacer copias a imagesgrupos_temp
	        if (is_uploaded_file($file_temp))
	        {
				$folder_dest=$DIRECTORIO_IMAGENES.$DIR_IMG_UPLOAD;
                //$file_name = session_id().time()."-".$file_size;
				$timee=time();
				list($img_w, $img_h, $tipo, $atr) = getimagesize($file_temp);
				$file_dest_preview = $userlabel."_".$timee."_".$img_w."x".$img_h."_preview.".$ext; // tambie para _600x380				
				$file_dest_orig = $userlabel."_".$timee."_".$img_w."x".$img_h."_orig.".$ext;	
				$file_dest_preview=str_replace(".png",".jpg",$file_dest_preview);
				$file_dest_orig=str_replace(".png",".jpg",$file_dest_orig);
				$r_img_confirm2 = ccl_img_uploadmini($file_temp,$ext,$folder_dest,$file_dest_preview,103,103,true);
				$r_img_confirm3 = ccl_img_uploadmini($file_temp,$ext,$folder_dest,$file_dest_orig,$img_w,$img_h);
//	            mysql_close($conn);
	            ?>
	            <script>
	            parent.upload_terminar("<?php echo $httpfiles.$folder_dest.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.$file_dest_preview ?>",'<?php echo $ID;?>',"<?php echo $httpfiles.$folder_dest.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.$file_dest_orig ?>");
				//parent.document.getElementById('gr_img_peso').value='<?php echo $file_size?>';
	            </script>
	            <?php
	        }
	        else
	        {
	            ?>
	            <script>parent.upload_err('<?php echo _("intente de nuevo.")?>','<?php echo $ID?>');</script>
	            <?php
	        }
	    }
	    else
	    {
	        ?>
	        <script>
	        parent.upload_err('<?php echo _("máximo 1Mb")?>','<?php echo $ID?>');
	        </script>
	        <?php
	    }
    }
    else
    {
	        ?>
	        <script>
	        parent.upload_err('<?php echo _("No es un fichero de imágen válido")?>','<?php echo $ID?>');
	        </script>
	        <?php
    }
}
else
{
	?>
	<script>
	parent.upload_err('<?php echo _("No es un fichero de imágen válido")?>','<?php echo $ID?>');
	</script>
	<?php

}

?>
</body>
</html>
<?php die(); ?>