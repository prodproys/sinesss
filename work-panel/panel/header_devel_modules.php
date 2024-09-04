<?php

foreach($objeto_tabla as $ooott){

    if($ooott['grupo']=='sistema'){

        $items[]='<a href="custom/'.$ooott['archivo'].'.php" class="links_menu" >'.$ooott['menu_label'].'</a>';
        
    }
}

$ret = ['items'=>$items];

unset($items);

return $ret;