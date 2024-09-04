<?php
/**
**** 
* Archivo: controller_duplicidad.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción: Este archivo tiene las funciones del proceso de verificar duplicidad de personas, este es un proceso de mantenimiento de desarrollo.
**** 
*/








if($_GET['step']=='process' or $_GET['step']=='process2'){

    $input_incorrect = $_GET['incorrect'];
    $input_corret = $_GET['correct'];



    $subs=[
        'primaryshares',
        
        'secondaryshares',
        'payments',
        
        'documents',
        'asigments',
        'operations',
        'records',
        
    ];
    
    $inputs=[];
    $inputs[]=['incorrect'=>$_GET['incorrect'],'correct'=>$_GET['correct']];
    
    /*
       db    88b 88    db    88     88 .dP"Y8 88 .dP"Y8
      dPYb   88Yb88   dPYb   88     88 `Ybo." 88 `Ybo."
     dP__Yb  88 Y88  dP__Yb  88  .o 88 o.`Y8b 88 o.`Y8b
    dP""""Yb 88  Y8 dP""""Yb 88ood8 88 8bodP' 88 8bodP'
    */
    foreach($inputs as $ii=>$dup){
    
        unset($out);
    
        $out[$ii]['correct']['code']=$dup['correct'];
        $out[$ii]['correct']['id']=dato("id","people","where code=".$dup['correct'],0);
    
        if(!$out[$ii]['correct']['id']) continue;
    
        $out[$ii]['incorrect']['code']=$dup['incorrect'];
        $out[$ii]['incorrect']['id']=dato("id","people","where code=".$dup['incorrect'],0);
    
        if(!$out[$ii]['incorrect']['id']) continue;
    
        foreach($subs as $sub){

            $out[$ii]['incorrect']['subs'][$sub] = contar($sub,"where id_persona=".$out[$ii]['incorrect']['id'],0);
            $out[$ii]['correct']['subs'][$sub]   = contar($sub,"where id_persona=".$out[$ii]['correct']['id'],0);

        }
    }

    // $process['step']='analized';

    
    //exit();
    
    /*
    88""Yb 88""Yb  dP"Yb   dP""b8 888888 .dP"Y8  dP"Yb
    88__dP 88__dP dP   Yb dP   `" 88__   `Ybo." dP   Yb
    88"""  88"Yb  Yb   dP Yb      88""   o.`Y8b Yb   dP
    88     88  Yb  YbodP   YboodP 888888 8bodP'  YbodP
    */
    
    if($_GET['step']=='process2'){

        prin($out);
        foreach($out as $ii=>$ou){
        
            if(!$ou['incorrect']['id'] or !$ou['correct']['id']) continue;
        
            $new_id=copyrow("peopleold","people","where id=".$ou['incorrect']['id'],0);
        
            delete("people","where id=".$ou['incorrect']['id']);
        
            update(
                [
                    'id_personalink'=>$ou['incorrect']['id'],
                    'codeold'=>$ou['incorrect']['code'],
                ]
                ,"people"
                ,"where id=".$ou['correct']['id']
            );
            update(
                [
                    'id_personalink'=>$ou['correct']['id'],
                    'codeold'=>$ou['correct']['code'],
                ]
                ,"peopleold"
                ,"where id=".$ou['incorrect']['id']
            );
        
            foreach($subs as $sub){
        
                update(
                    ['id_persona'=>$ou['correct']['id']],
                    $sub,
                    "where id_persona=".$ou['incorrect']['id']
                );
        
            }
        
        }
    
    }

    $viewFile="view_duplicidad";

}


else {

    $viewFile="view_duplicidad";

}
