<?php

foreach($objeto_tabla as $ot){
    if($ot['archivo_sub']!='' and $ot['archivo_sub']==strtolower($vars['GENERAL']['VALIDAR_SESION'])){
        //echo $ot['me']." - ".$ot['archivo_sub']." - ".strtolower($vars['GENERAL']['VALIDAR_SESION'])."<br>";
        $tables_usuarios[]=$ot;
    }
}

$usuars=select('id,nombre,password,id_permisos','usuarios_acceso',"where visibilidad='1' order by id_permisos desc, nombre asc",0,array(
        'permiso'	=>array('dato'=>array('nombre','usuarios_permisos','where id="{id_permisos}"')),
));

/*echo  '<li><a href="maquina.php?redirhome=1" class="links_menu" style="font-weight:bold;color:red;text-transform:uppercase;" >MASTER</a></li>';*/
foreach($usuars as $usu){
    if($usu['nombre']!=''){

        foreach($tables_usuarios as $tu){
            $FiLau=select("usuarios_acceso_nombre as nombre,usuarios_acceso_password as password",$tu['tabla'],"where id_sesion='".$usu['id']."'",0); if(sizeof($FiLau)>0){
                $FiLa=$FiLau['0']; unset($FiLau); continue;
            }
        }
        $item='';
        $item.='<a href="#" onclick="javascript:changelogin(\''.$usu['nombre'].'\',\''.$usu['password'].'\');return false;" class="links_menu" >';
        $item.="<span style=' color:#000;'>".$usu['permiso']."</span> - ";
        $item.=$usu['nombre'];
        $item.=' - <span style="color:#000;font-weight:normal;">'.$usu['password'].'</span>';
        if(sizeof($FiLa)){
            if($usu['nombre']==$FiLa['nombre'] and $usu['password']==$FiLa['password']){
                $item.=' <span style="color:green;font-weight:bold;">SI</span>';
            } else {
                $item.=' <span style="color:red;font-weight:bold;">NO</span>';
            }
        } else {
            $item.=' <span style="color:red;font-weight:normal;">orfan</span>';
        }

        //$item.=' - <span style="color:green;font-weight:normal;">'.$FiLa['nombre'].'</span>';
        //$item.=' - <span style="color:#000;font-weight:normal;">'.$FiLa['password'].'</span>';

        $item.='</a>';
        unset($FiLa);

    }

    $items[]=$item;
    
    unset($item);

}

$ret = ['items'=>$items];

unset($items);

return $ret;
