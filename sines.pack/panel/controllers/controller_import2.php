<?php
/**
**** 
* Archivo: controller_import2.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo tiene las funcions backend de todo el proceso de importacion de aportaciones regulares y caee desde un archivo excel ( version 2, definitiva )
**** 
*/




function fix_head($value){
    if($value=='Número de personal') return 'code';
    elseif($value=='Apellido Nombre') return 'last_first_name';
    elseif($value=='CC-nómina') return 'nomina';
    elseif($value=='Importe') return 'importe';
    else return $value;
}

// $tt=0;
function testRow($data_line){
    
    // global $tt;
    // prin($tt);
    // $tt++;
    // prin($data_line);

    $people_fields= "people.id as id";


    $code=substr(trim($data_line['code']['text']),1);
    list($apellidos,$nombre)=explode(",",trim(str_replace(["'"],["\\'"],$data_line['last_first_name']['text'])));
    
    $profile=fila(
        $people_fields,
        "people",
        "where people.code like '%".$code."%' ".
        "or ( people.apellidos='".$apellidos."' and people.nombre like '".$nombre."%' ) ".
        "or concat( people.apellidos,' ',people.nombre ) = '".$apellidos." ".$nombre."'  ".
        "",
        0
    );
    // prin($profile['id']);
    if(!$profile){
        $profiles=select(
            $people_fields,
            "people",
            "where people.apellidos='".$apellidos."' ".
            "",
            0
        );    
        if(sizeof($profiles)==1){
            $profile=$profiles[0];
        }
    }
    
    if(!$profile){

        return [
            'id'=>'',
            'class'=>'unreconized'
        ];

    } else {

        global $fecha_mes;
        // prin($fecha_mes);

        if($data_line['nomina']['text']=='8403'){
                            
            $hubo_primary=fila(
                "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                "primaryshares",
                "where id_persona=".$profile['id']." and month='".$fecha_mes."' ",
                0
            );
            // prin($hubo_primary);
            
            return [
                'id'=>$profile['id'],
                'class'=>($hubo_primary)?'hubo_primary':'habra_primary'
            ];
        
        } elseif($data_line['nomina']['text']=='8393'){

            $hubo_secondary=fila(
                "id,fecha_creacion,type,amount,registered_by,voucher,concept",
                "secondaryshares",
                "where id_persona=".$profile['id']." and month='".$fecha_mes."' ",
                0
            );

            return [
                'id'=>$profile['id'],
                'class'=>($hubo_secondary)?'hubo_secondary':'habra_secondary'
            ];            

        } else {

            return [
                'id'=>'',
                'class'=>'nada'
            ];

        }

    }
    
    return [
        'id'=>'',
        'class'=>''
    ];

}

$Regimen=[
    '276'=>'cn',
    '728'=>'cn',
    'CAS'=>'cas',
];


for($yy=2014;$yy<=date("Y");$yy++){
    $years[]=$yy;
}
for($mm=1;$mm<=12;$mm++){
    $months[$mm]=ucfirst($Array_Meses[$mm]);
}
$years=array_reverse($years);


/*
888888  dP"Yb  88     8888b.  888888 88""Yb .dP"Y8
88__   dP   Yb 88      8I  Yb 88__   88__dP `Ybo."
88""   Yb   dP 88  .o  8I  dY 88""   88"Yb  o.`Y8b
88      YbodP  88ood8 8888Y"  888888 88  Yb 8bodP'
*/
$uploaded_folder=$PATH_CUSTOM."../files/uploads/";

$processed_folder=$PATH_CUSTOM."../files/sheets/";



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


                $processed_file=$processed_folder."/".$file_name.".".$sheet.".csv";

                $fp = fopen($processed_file, 'w');


                $objPHPExcel->setActiveSheetIndex($id_sheet);

                $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();


                foreach($rowIterator as $iiii=> $row){
                

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
               

                    foreach ($cellIterator as $cell) {

                        $array_linea[] = $cell->getCalculatedValue();

                    }


                    fputcsv($fp, $array_linea);
                    unset($array_linea);


                }


                fclose($fp);

            }

            $url = "pages.php?page=".$_GET['page']."&month=".$_POST['month']."&year=".$_POST['year']."&file=".$file_name."&step=csv";
            @header("Location: $url");
            die();
            

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

            // prinx($to_insert);

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
                if($linea['tabla']=='primaryshares'){

                    $last_month=dato("max(month)","primaryshares","where id_persona=".$linea['people']['id']);
                    // UPDATES
                    update(
                        [
                            'last_primary'=>$last_month
                        ],
                        "people",
                        "where id=".$linea['people']['id']
                    );

                } elseif($linea['tabla']=='secondaryshares'){

                    $last_month=dato("max(month)","secondaryshares","where id_persona=".$linea['people']['id']);
                    // UPDATES
                    update(
                        [
                            'last_secondary'=>$last_month
                        ],
                        "people",
                        "where id=".$linea['people']['id']
                    );

                }
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

    $viewFile="view_import";

}

elseif($_GET['step']=='csv'){

    $fecha_mes=$_GET['year']."-".
    sprintf("%02d",$_GET['month']).
    "-01 00:00:00";

    $_GET['sheet']=($_GET['sheet'])?$_GET['sheet']:0;

    $buttonurl="pages.php?page=".$_GET['page']."&month=".$_GET['month']."&year=".$_GET['year']."&file=".$_GET['file']."&step=import&sheet=".$_GET['sheet'];


    $file=$_GET['file'];
    // prin($uploaded_folder.$_GET['file']);
    $archivo_original=$uploaded_folder.$file;
    if(file_exists($archivo_original)){
        // prin('archivo original existe');
        $ficheros  = scandir($processed_folder);
        $iic=0;
        foreach($ficheros as $fichero){

            if(substr($fichero, 0, strlen($file)) == $file){
            
                $parts=explode(".",$fichero);

                $sheet=$parts[sizeof($parts)-2];

                $csv_files[]=$fichero;
                
                if(in_array($sheet,array_keys($Regimen))){
                    $sheets[]=[
                        'active'=>($_GET['sheet']==$iic)?'active':'',
                        'text'=>$sheet,
                        'url'=>"pages.php?page=".$_GET['page']."&month=".$_GET['month']."&year=".$_GET['year']."&file=".$_GET['file']."&step=csv&sheet=".$iic,
                    ];

                } else {
                    $sheets[]=[
                        'active'=>($_GET['sheet']==$iic)?'active':'',
                        'text'=>"HOJA CON NOMBRE INVÁLIDO, NO ES POSIBLE RECONOCER EL RÉGIMEN",
                        // 'url'=>"pages.php?page=".$_GET['page']."&month=".$_GET['month']."&year=".$_GET['year']."&file=".$_GET['file']."&step=csv&sheet=".$iic,
                    ];
                }
                $iic++;

            }

        }

    }
    // prinx($sheets);

    $csvFields=[
        '0' => 'Número de personal',
        '1' => 'Apellido Nombre',
        '2' => 'Texto división de personal',
        '3' => 'Texto subdiv.pers.',
        '4' => 'Denominación',
        '5' => 'Denom.grupo personal',
        '6' => 'Denom.área personal',
        '7' => 'CC-nómina',
        '8' => 'Texto expl.CC-nómina',
        '9' => 'Cantidad',
        '10' => 'Importe',
        '11' => 'Moneda',
    ];

    $csvFieldsIndexes=array_keys($csvFields);



    $csvFile = file($processed_folder.$csv_files[$_GET['sheet']]);

    // $csvFile=array_slice($csvFile,0,150);


    $items = [];
    foreach ($csvFile as $ii=>$line) {
        // header
        if($ii==0){ 
            $item[]=['text'=>'#'];
            foreach(str_getcsv($line) as $jj=>$cell){
                // if(!in_array($jj,$csvFieldsIndexes)) continue;
                $item[]=[
                    'text'=>$cell
                ];
                $header1[$jj]=$cell;

            }
            $headers[] = $item;
            unset($item);

        }
        // body
        else { 

            $item['num']=['text'=>$ii+1];
            foreach(str_getcsv($line) as $jj=>$cell){
                // if(!in_array($jj,$csvFieldsIndexes)) continue;
                $item[fix_head($header1[$jj])]=['text'=>$cell];
            }

            $test=testRow($item);
            if($test['class']=='habra_primary'){
                $primariesA[$ii]=$test['id'];
            } elseif($test['class']=='habra_secondary'){
                $secondariesA[$ii]=$test['id'];
            }
            $items[] =[
                // 'id_person'=>$test['id'],
                'class'=>$test['class'],
                'items'=>$item
            ];
            unset($item);

        }

    }

    $primaries=json_encode($primariesA);

    $secondaries=json_encode($secondariesA);

    // $items=array_slice($items,0,20);
    // prin($header1);
    // prinx($items);

    $viewFile="view_import_csv";

}

elseif($_GET['step']=='import'){


    $fecha_mes=$_GET['year']."-".
    sprintf("%02d",$_GET['month']).
    "-01 00:00:00";

    $file=$_GET['file'];
    // prin($uploaded_folder.$_GET['file']);
    $archivo_original=$uploaded_folder.$file;
    if(file_exists($archivo_original)){
        // prin('archivo original existe');
        $ficheros  = scandir($processed_folder);
        $iic=0;
        foreach($ficheros as $fichero){

            if(substr($fichero, 0, strlen($file)) == $file){

                $parts=explode(".",$fichero);

                $sheets[]=$parts[sizeof($parts)-2];

                $csv_files[]=$fichero;
                
                // $regimen[]=$fichero;

            }

        }

    }

    $csvFile = file($processed_folder.$csv_files[$_GET['sheet']]);
    
    $disheet = $sheets[$_GET['sheet']];


    // $csvFile=array_slice($csvFile,0,20);

    $primaries_a=json_decode($_POST['primary'],true);
    
    $secondaries_a=json_decode($_POST['secondary'],true);

    $primaries_a=($_POST['primary']=='null')?[]:$primaries_a;
    $secondaries_a=($_POST['secondary']=='null')?[]:$secondaries_a;

    // prin($primaries_a,'primaries_a');
    // prin($secondaries_a.'secondaries_a');
    // prin($secondaries_a);
    $peoples_ids=array_unique(array_merge($primaries_a,$secondaries_a));
    
    // prinx(array_merge($primaries_a,$secondaries_a),'merge');

    foreach($peoples_ids as $person_id){
        $people[$person_id]=fila(
            [
                'people.id_group as id_group',
                'locations.id_settlement as id_settlement'
            ],
            "people
            left join locations on locations.id=people.id_location
            ",
            "where people.id=".$person_id,
            0
        );
    }
    // prinx($people);
    // prin($peoples_ids,'peoples_ids');


    $primaries_ids=array_keys($primaries_a);
    
    $secondaries_ids=array_keys($secondaries_a);

    // prin($primaries_ids);
    // prinx($secondaries_ids);


    $items = [];
    $habra_secondary = [];
    $habra_primary = [];
    foreach ($csvFile as $ii=>$line) {
        // header
        if($ii==0){ 
            // $item[]=['text'=>'#'];
            foreach(str_getcsv($line) as $jj=>$cell){
                // if(!in_array($jj,$csvFieldsIndexes)) continue;
                // $item[]=[
                //     'text'=>$cell
                // ];
                $header1[$jj]=$cell;

            }
            // $headers[] = $item;
            // unset($item);

        }
        // body
        else { 

            $item['num']=$ii+1;
            foreach(str_getcsv($line) as $jj=>$cell){
                // if(!in_array($jj,$csvFieldsIndexes)) continue;
                $head=fix_head($header1[$jj]);
                $item[$head]=$cell;
            }
            if(in_array($ii,$primaries_ids)){
                $habra_primary[$ii]=$item;
            } elseif(in_array($ii,$secondaries_ids)){
                $habra_secondary[$ii]=$item;
            }
            unset($item);

        }

    }

    // prin($disheet);
    // prinx($Regimen[$disheet]);

    // prin($_POST);
    // prin($people);
    // prin($habra_primary);

    foreach($habra_primary as $ii=>$item){

        if(1)
        insert(
            [
                'fecha_creacion'=>'now()',
                'type'=>'Imported',
                'new_imported'=>'1',
                'month'=>$fecha_mes,
                'registered_by'=>'Archivo '.$file,
                'amount'=>$item['importe'],
                'concept'=>$item['Texto expl.CC-nómina'],
    
                'id_persona'=>$primaries_a[$ii],
                'id_settlement'=>$people[$primaries_a[$ii]]['id_settlement'],
                'id_group'=>$Regimen[$disheet],
            ],
            'primaryshares'
            ,0
        );

        // UPDATES
        $last_month=dato("max(month)","primaryshares","where id_persona=".$primaries_a[$ii]." and type in ('Voucher','Voucher2','Imported')");
        update(
            [
                'last_primary'=>$last_month
            ],
            "people",
            "where id=".$primaries_a[$ii]
        );        

    }

    foreach($habra_secondary as $ii=>$item){

        if(1)
        insert(
            [
                'fecha_creacion'=>'now()',
                'type'=>'Imported',
                'new_imported'=>'1',
                'month'=>$fecha_mes,
                'registered_by'=>'Archivo '.$file,
                'amount'=>$item['importe'],
                'concept'=>$item['Texto expl.CC-nómina'],
    
                'id_persona'=>$secondaries_a[$ii],
                'id_settlement'=>$people[$secondaries_a[$ii]]['id_settlement'],
                'id_group'=>$Regimen[$disheet],
            ],
            'secondaryshares'
            ,0
        );

        // UPDATES
        $last_month=dato("max(month)","secondaryshares","where id_persona=".$secondaries_a[$ii]." and type in ('Voucher','Voucher2','Imported')");
        update(
            [
                'last_secondary'=>$last_month
            ],
            "people",
            "where id=".$primaries_a[$ii]
        );           

    }    

    update_evolution([$fecha_mes],[0,1],[$Regimen[$disheet]]);


    // prin($habra_primary,'habra_primary');

    // prinx($habra_secondary,'habra_secondary');

    
    $url = "pages.php?page=".$_GET['page']."&month=".$_GET['month']."&year=".$_GET['year']."&file=".$file."&step=csv&sheet=".$_GET['sheet'];
    @header("Location: $url");
    
    die();    


}

else {

    $viewFile="view_import";

}
