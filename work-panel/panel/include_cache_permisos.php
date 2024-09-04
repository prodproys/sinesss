<?php

if(!file_exists('cache')){ mkdir('cache', 0700); }

if($id_permisos==''){

    include $file_include.".php";

} else {

    $file_cache="cache/".$file_include."_".$id_permisos.".php";
    
    if(!file_exists($file_cache)){
      
        ob_start();

        include $file_include.".php";

        $fp = fopen($file_cache, 'w');
        fwrite($fp, ob_get_contents());
        fclose($fp);
        ob_end_flush();

    }

    include $file_cache;

    unset($file_cache);

}


