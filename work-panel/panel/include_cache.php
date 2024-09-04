<?php

    $useCache=true;

    $updateCache=false;

    if(!$useCache){

        return require $file_include.".php";

    } else {

        $dir_cache='cache';

        if(!file_exists($dir_cache)) 
            mkdir($dir_cache, 0700);

        $file_cache=$dir_cache."/".$file_include.".php";

        if(!file_exists($file_cache) or $updateCache){
            
            $data_will_cache = require $file_include.".php";

            $fp = fopen($file_cache, 'w');
            fwrite($fp,json_encode($data_will_cache));
            fclose($fp);
            
        }
        
        return json_decode(file_get_contents($file_cache), true);
        

        unset($file_cache);
        unset($dir_cache);
        unset($fp);

    }




