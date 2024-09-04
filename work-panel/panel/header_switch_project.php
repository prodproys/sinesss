<?php

if($vars['INTERNO']['ID_PROYECTO']!="0"){
    
    prin("no funciona la conexion a panel");
    // mysqli_select_db("panel",$link);
    // mysqli_query("SET NAMES 'utf8'",$link);
    $other_link = mysqli_connect($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASS,"panel");
    if (!$other_link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        exit;
    }
    // // mysqli_set_charset($other_link,"utf8");
    
    $item2 = select(
            "carpeta,logo,fecha_creacion,dominio,nombre,calificacion",
            "proyectos",
            "where para_subir='1' and visibilidad='1' order by id asc limit 0,100"
            ,1,[],$a,$other_link
    );
    foreach($item2 as $ite2){
        if($ite2['calificacion']==0) continue;
        switch($ite2['calificacion']){
            case "1": $color= "#FAFA9D"; break;
            case "2": $color= "#E8C3C3"; break;
            case "3": $color= "#B3EFB3"; break;
        }
        $items[]= "<a 
        style='background:{$color};'
        href='".str_replace($vars['INTERNO']['CARPETA_PROYECTO'],
                    $ite2["carpeta"],
                    $vars["LOCAL"]["url_publica"])."/panel'>"
                                        // .$vars["LOCAL"]["url_publica"]
                                        .strtoupper($ite2['nombre'])
                                        ."</a>";
    }

}

$ret = ['items'=>$items];

unset($items);

return $ret;
