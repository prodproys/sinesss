<?php
/**
**** 
* Archivo: controller_documentos.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción: Este archivo es el controller backend de la sección "documentos" de la pagina de detalle de una persona
**** 
*/




// $lineas = array_slice($lineas,0,1);
$lineas=render_work_data($lineas,$datos_tabla['me']);
foreach($lineas as $ii=>$linea){


    $asigments=select(
        [
            'amount',
            'operation_bank',
            'created_by',
            'transaction_date',
            'fecha_creacion',
        ]
        ,"asigments"
        ,"where id_document=".$linea['id']['value']
        ,0
    );

    foreach($asigments as $jj=>$asigment){

        
        $asigments[$jj]['amount']=number_format($asigments[$jj]['amount'],2);
        $asigments[$jj]['fecha_creacion']=fecha_formato($asigments[$jj]['fecha_creacion'],'0a');
        $asigments[$jj]['transaction_date']=fecha_formato($asigments[$jj]['transaction_date'],'0a');

    }

    $lineas[$ii]['asigments']=$asigments;

}

// prinx($lineas);

