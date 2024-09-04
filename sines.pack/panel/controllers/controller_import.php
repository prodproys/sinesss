<?php
/**
**** 
* Archivo: controller_import.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo tiene las funcions backend de todo el proceso de importacion de aportaciones regulares y caee desde un archivo excel ( version 1 )
**** 
*/




function fix_head($value){
    if($value=='Número de personal') return 'code';
    elseif($value=='Apellido Nombre') return 'last_first_name';
    elseif($value=='CC-nómina') return 'nomina';
    elseif($value=='Importe') return 'importe';
    else return $value;
}
$locations_array=opciones("nombre,id","locations");
$settlements_array=opciones("nombre,id","settlements");
$zones_array=opciones("nombre,id","zones");

for($yy=2014;$yy<=date("Y");$yy++){
    $years[]=$yy;
}
for($mm=1;$mm<=12;$mm++){
    $months[$mm]=ucfirst($Array_Meses[$mm]);
}
$years=array_reverse($years);

if($_GET['step']=='upload'){

    $file_size = $_FILES['file-format']['size'];
    $file_type = $_FILES['file-format']['type'];
    $file_temp = $_FILES['file-format']['tmp_name'];
    $file_name=$_FILES['file-format']['name'];
    $file_par=array_reverse(explode('.',$_FILES['file-format']['name']));
    $file_ext=strtolower($file_par[0]);


    $fecha_mes=$_POST['year']."-".
    sprintf("%02d",$_POST['month']).
    "-01 00:00:00";
    
    $dataimport=[
        'ahora'=>fecha_formato('now()',"8b"),
        'fecha'=>$fecha_mes,
        'month'=>fecha_formato($fecha_mes,"4b"),
        'archivo'=>$file_name,
    ];


    if (is_uploaded_file($file_temp)){

        $upload_folder='uploads';
        $uploaded_folder=$PATH_CUSTOM."../files/".$upload_folder;
        $uploaded_file=$uploaded_folder."/".$file_name;

        if(!file_exists($uploaded_file)){
            // if(!file_exists($uploaded_folder)){
            //     mkdir($uploaded_folder);
            // }
            move_uploaded_file($file_temp,$uploaded_file);
        }
        // exit();
        /*
        ##     ## ##        ######  ##     ##
         ##   ##  ##       ##    ##  ##   ##
          ## ##   ##       ##         ## ##
           ###    ##        ######     ###
          ## ##   ##             ##   ## ##
         ##   ##  ##       ##    ##  ##   ##
        ##     ## ########  ######  ##     ##
        */
        if($file_ext=='xlsx'){

            $file_formato='excel';


            require_once 'lib/PHPExcel.php';

            require_once 'lib/PHPExcel/IOFactory.php';

            // $type = PHPExcel_IOFactory::identify($file_temp);
            $type = "Excel2007";
            
            $objReader = PHPExcel_IOFactory::createReader($type);

            $objReader->setReadDataOnly(true);

            $objPHPExcel = $objReader->load($uploaded_file);	

            $sheets=$objPHPExcel->getSheetNames();
            

            $Regimen=[
                '276'=>'cn',
                '728'=>'cn',
                'CAS'=>'cas',
            ];

           
            // prinx($sheets);
            
            // $sheets=[
            //     '0'=>'276',
            //     '1'=>'728',
            //     '2'=>'CAS',
            // ];
            
            /*
            if(0)
            $sheets=[
                // $sheets[0],
                // $sheets[1],
                $sheets[2],
            ];
            */

            $rowIndexplus=0;

            $array_data = array();
            $array_data2 = array();
            $array_heads = array();
            $array_heads2 = array();

            foreach($sheets as $id_sheet=>$sheet){


                $objPHPExcel->setActiveSheetIndex($id_sheet);

                $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();


                

            
                $numm=0;
                foreach($rowIterator as $iiii=> $row){
                
                    $numm++;
                    // if($iiii>3) continue;

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                    if(1 == $row->getRowIndex ()) {


                        foreach ($cellIterator as $cell) {

                            $headd=fix_head($cell->getCalculatedValue());
                            $array_heads[$cell->getColumn()] = $headd;
                            $array_heads2[] = "<<".$headd.">>";

                        }
                        
                        // prin($array_heads);
                        continue;

                    }//skip first row
                    
                    $rowIndex = $row->getRowIndex ();
                    // $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
                    
                    $array_linea['sheet']=$sheet;
                    $array_linea['fila'] = $iiii;

                    foreach ($cellIterator as $cell) {

                        $array_linea[$array_heads[$cell->getColumn()]] = $cell->getCalculatedValue();

                    }

                    // if($array_linea['CC-nómina']=='8403') continue;

                    
                    // if($array_linea['Cantidad']=='0') continue;


                    $array_data[$rowIndexplus]=$array_linea;
                    
                    unset($array_linea);

                    $rowIndexplus++;


                }


            }

            $array_data=array_slice($array_data,0,4);

            prinx($array_data);

            // $array_data=array_slice($array_data,0,100);
            
            // prinx($array_data);
            

            $dataimport['formato']=$file_formato;
            $dataimport['total']=$numm;

            $people_fields= "
            people.id as id,
            people.code as code,
            people.apellidos as apellidos,
            people.nombre as nombre,
            people.s_activity_1 as s_activity_1,
            people.s_activity_2 as s_activity_2,
            people.speciality as speciality,
            people.id_location as ente,
            locations.id_settlement as base,
            locations.id_zone as red
            ";

            // prin($dataimport);
            
            // prinx($array_data);

            $repeated_vals=[];

            foreach($array_data as $iii=>$data_line){
                
                // if($iii>10) continue;
                if(1)
                foreach($data_line as $var=>$val){
                    if(in_array($var,[
                        'nomina',
                        // 'PROGRAMA',
                        // 'SUB-PROGRAMA',
                        // 'ACTIVIDAD',
                        // 'S-ACTIVID.1',
                        // 'S-ACTIVID.2',
                        // 'S-ACTIVID.3',
                        // 'CONCEPTO',
                    ]))
                    $repeated_vals[$var][$val]=$val;
                }

                $code=substr(trim($data_line['code']),1);
                list($apellidos,$nombre)=explode(",",trim(str_replace(["'"],["\\'"],$data_line['last_first_name'])));
                
                $profile=fila(
                    $people_fields,
                    "people",
                    "
                    left join locations on locations.id=people.id_location ".
                    "where people.code like '%".$code."%' ".
                    "or ( people.apellidos='".$apellidos."' and people.nombre like '".$nombre."%' ) ".
                    "or concat( people.apellidos,' ',people.nombre ) = '".$apellidos." ".$nombre."'  ".
                    "",
                    0,
                    [
                        /*
                        'replace'=>[
                            'ente'=>$locations_array,
                            'base'=>$settlements_array,
                            'red'=>$zones_array,
                        ]
                        */
                    ]
                );
                
                if(!$profile){
                    $profiles=select(
                        $people_fields,
                        "people",
                        "
                        left join locations on locations.id=people.id_location ".
                        "where people.apellidos='".$apellidos."' ".
                        "",
                        0,
                        [
                            /*
                            'replace'=>[
                                'ente'=>$locations_array,
                                'base'=>$settlements_array,
                                'red'=>$zones_array,
                            ]
                            */
                        ]
                    );    
                    if(sizeof($profiles)==1){
                        $profile=$profiles[0];
                    }
                }

                if($profile){
                    $profile['link']="<a target='_black' href='custom/people.php?i=".$profile['id']."'>".$profile['id']."</a>"; 
                }
                

            

                if(($array_data[$iii]['people']=$profile)){


                    if($array_data[$iii]['nomina']=='8403'){
                        
                        $hubopago=$array_data[$iii]['primaryshares']=fila(
                            "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                            "primaryshares",
                            "where id_persona=".$array_data[$iii]['people']['id']." and month='".$fecha_mes."' ",
                            0
                        );
                        $array_data[$iii]['tabla']='primaryshares';
                    
                    } elseif($array_data[$iii]['nomina']=='8393'){

                        $hubopago=$array_data[$iii]['secondaryshares']=fila(
                            "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                            "secondaryshares",
                            "where id_persona=".$array_data[$iii]['people']['id']." and month='".$fecha_mes."' ",
                            0
                        );
                        $array_data[$iii]['tabla']='secondaryshares';
                    
                    
                    } 
                    /*
                    else{

                        $hubopago=$array_data[$iii]['secondaryshares']=fila(
                            "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                            "payments",
                            "where id_persona=".$array_data[$iii]['people']['id']." and month='".$fecha_mes."' ",
                            0
                        );
                        $array_data[$iii]['tabla']='payments';
                    
                    } 
                    */

                    // prin($array_data[$iii]);

                    /*
                    $array_data[$iii]['secondaryshares']=fila(
                        "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                        "secondaryshares",
                        "where id_persona=".$array_data[$iii]['people']['id']." and month='".$fecha_mes."' ",
                        0
                    ); 
                    $array_data[$iii]['payments']=fila(
                        "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                        "payments",
                        "where id_persona=".$array_data[$iii]['people']['id']." and month='".$fecha_mes."' ",
                        0
                    );  
                    */

                    if(!$hubopago){

                        // prin($array_data[$iii]);
                        $to_insert[]=$array_data[$iii];
    
                    }

                } else {

                    $unknown[$iii]=$data_line;

                }

  

            }
            

            $dataimport['unknown']=sizeof($unknown);

            $dataimport['totales']['total_inserted']=0;
            $dataimport['primaryshares']['total_inserted']=0;
            $dataimport['secondaryshares']['total_inserted']=0;
            
            // $to_insert=array_slice($to_insert,0,100);


            // prinx($to_insert);


            foreach($to_insert as $ii=> $linea){
                // if(0)
                // if($linea['tabla']=='') prin($linea);

                $inserts[$linea['tabla']][$ii]=$linea;



                $inserts[$linea['tabla']][$ii]['inserted']=$to_insert[$ii]['inserted']=insert(
                    [
                        'fecha_creacion'=>'now()',
                        'month'=>$dataimport['fecha'],
                        'type'=>'Imported',
                        'registered_by'=>'Archivo '.$dataimport['archivo'],
                        'id_persona'=>$linea['people']['id'],
                        'amount'=>$linea['importe'],
                        'concept'=>$linea['Texto expl.CC-nómina'],
                        'new_imported'=>'1',
                        'id_settlement'=>$linea['people']['base'],
                        'id_group'=>$Regimen[$linea['sheet']],
                    ],
                    $linea['tabla']
                    ,0
                );

                // UPDATES
                update(
                    [
                        'last_primary'=>$dataimport['fecha']
                    ],
                    "people",
                    "where id=".$linea['people']['id']
                );

                $dataimport['totales']['total_inserted']++;
                $dataimport[$linea['tabla']]['total_inserted']++;


            }
            // prin($dataimport);
            // prin($inserts['primaryshares'],'primaryshares');
            // prin($inserts['secondaryshares'],'secondaryshares');
            // prin($unknown,'no reconcidos');
            // prin($array_data);

            // prin($unknown,'no reconocidos');

        } 
        /*
        ######## ##     ## ########
           ##     ##   ##     ##
           ##      ## ##      ##
           ##       ###       ##
           ##      ## ##      ##
           ##     ##   ##     ##
           ##    ##     ##    ##
        */
        elseif($file_ext=='txt'){

            $file_formato='text';

            $dataimport['formato']=$file_formato;

            $archivo = file_get_contents($file_temp);

            $repeated_vals=[];
            
            // $paginas=explode("ESSALUD                                                      PAGINA",$archivo);
            $paginas=explode("\nESSALU",$archivo);
            
            // $paginas=array_slice($paginas,0,5);
            
            $dataimport['total_paginas']=sizeof($paginas);
            
            foreach($paginas as $ii=>$pagina){
            
                if($ii==0) continue;
            
                $partes=explode("********************************************************************************",$pagina);
            
        
                if(1){
                    $lineas=explode("\n",$partes[0]);
                    foreach($lineas as $yy=> $linea){
                        if(trim($linea)!=""){
                            $var=trim(substr($linea,0,13));
                            $val=trim(substr($linea,15));
                            if(!in_array($var,["","AN"]) and $val!=""  ){
                                
                                if($var=="D"){
            
                                    $props['pagina']=trim(substr($linea,63));
                                
                                } elseif($var=="GC. GESTION D"){
            
                                    $props['fecha']=trim(substr($linea,69));
            
                                } else {
            
                                    $props[$var]=$val;
                                
                                }
                                if(in_array($var,[
                                    'CONCEPTO',
                                ]))
                                $repeated_vals[$var][$val]=$val;
                                
                            }
                        }   
                    }    

                }
                if(1){
                    $lineas=explode("\n",$partes[2]);
                    foreach($lineas as $yy=> $linea){
                        if(trim($linea)!=""){
                            $cod=trim(substr($linea,0,17));
                            $nombre=trim(substr($linea,17,55));
                            $monto=trim(substr($linea,55));
                            if(trim($cod)!="" and trim($nombre)!=""){
                                $share[]=[
                                    'linea'=>$yy,
                                    'cod'=>$cod,
                                    'nombre'=>$nombre,
                                    'monto'=>$monto,
                                    'props'=>$props,
                                ];
                            }
                        }   
                    }   

                    $people_fields="
                    people.id as id,
                    people.apellidos as apellidos,
                    people.nombre as nombre,
                    people.s_activity_1 as s_activity_1,
                    people.s_activity_2 as s_activity_2,
                    people.speciality as speciality,
                    people.id_location as id_location,
                    locations.id_settlement as id_settlement,
                    locations.id_zone as id_zone
                    ";
                    if(1)
                    foreach($share as $ii=>$shar){

                        $people_fila=fila(
                            $people_fields,
                            "people",
                            "
                            left join locations on locations.id=people.id_location
                            where people.code=".$shar['cod']." ".
                            "or people.codeold=".$shar['cod']." ".
                            "",
                            0,
                            [
                                /*
                                'replace'=>[
                                    'id_location'=>$locations_array,
                                    'id_settlement'=>$settlements_array,
                                    'id_zone'=>$zones_array,
                                ]
                                */
                            ]
                        );
                  

                        if($people_fila){

                            $share[$ii]['people']=$people_fila;
                            
                            if($props['CONCEPTO']=='214 SNE ESSALUD'){
                                $hubopago=$share[$ii]['primaryshares']=fila(
                                    "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                                    "primaryshares",
                                    "where id_persona=".$share[$ii]['people']['id']." and month='".$fecha_mes."' ",
                                    0
                                ); 
                                $share[$ii]['tabla']='primaryshares';
                            } elseif($props['CONCEPTO']=='188 CUOT. SINESS EXTRA'){
                                $hubopago=$share[$ii]['secondaryshares']=fila(
                                    "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                                    "secondaryshares",
                                    "where id_persona=".$share[$ii]['people']['id']." and month='".$fecha_mes."' ",
                                    0
                                ); 
                                $share[$ii]['tabla']='secondaryshares';
                            }
                            /*
                            $share[$ii]['payments']=fila(
                                "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                                "payments",
                                "where id_persona=".$share[$ii]['people']['id']." and month='".$fecha_mes."' ",
                                0
                            );
                            */  
                        } else {
                            // prin('no reconocido');
                            $unknown[]=$share[$ii];
                            
                        }


                        if(!$hubopago){

                            $to_insert[]=$share[$ii];

                        }

                        $paginasR[]=$share[$ii];
     

                    }



                    unset($share);                    
                    // prin($share);
                    

                    // prin($props);
                    unset($props);
                    unset($cod);
                    unset($nombre);
                    unset($monto);
                }
    


                // prin($share);
            
            }

            $dataimport['unknown']=sizeof($unknown);
            
            $dataimport['total']=sizeof($paginasR);

            $dataimport['totales']['total_inserted']=0;
            $dataimport['primaryshares']['total_inserted']=0;
            $dataimport['secondaryshares']['total_inserted']=0;

            foreach($to_insert as $ii=> $linea){
  
                $inserts[$linea['tabla']][$ii]=$linea;

                $inserts[$linea['tabla']][$ii]['inserted']=$to_insert[$ii]['inserted']=insert(
                    [
                        'fecha_creacion'=>'now()',
                        'month'=>$dataimport['fecha'],
                        'type'=>'Imported',
                        'registered_by'=>'Archivo '.$dataimport['archivo'],
                        'id_persona'=>$linea['people']['id'],
                        'amount'=>$linea['monto'],
                        'concept'=>$linea['props']['CONCEPTO'],
                        'new_imported'=>'1',
                        'id_settlement'=>$linea['people']['id_settlement']
                    ],
                    $linea['tabla']
                );
                
                // UPDATES
                update(
                    [
                        'last_primary'=>$dataimport['fecha']
                    ],
                    "people",
                    "where id=".$linea['people']['id']
                );

                $dataimport['totales']['total_inserted']++;
                $dataimport[$linea['tabla']]['total_inserted']++;

            }            
 

            // prin($dataimport);
            // prin($paginasR);
            // prin($unknown);
        }

        // prin($repeated_vals);
        update_evolution([$fecha_mes],[0,1],['cas','cn']);

    }

}

$viewFile="view_import";
