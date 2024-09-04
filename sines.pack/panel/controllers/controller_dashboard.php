<?php
/**
**** 
* Archivo: controller_dashboard.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "dashboard" del menú
**** 
*/






if($_SESSION['usuario_datos_id_grupo']!='' ){

    $id_settlement=$_SESSION['usuario_datos_id_grupo'];

    $page_title="Dashborard";

    $total_personas=contar(
        "people",
        "
        left join locations on people.id_location=locations.id
        left join settlements on locations.id_settlement=settlements.id
        where settlements.id=".$id_settlement,0
    );
    
    $total_agremiados=contar(
        "people",
        "
        left join locations on people.id_location=locations.id
        left join settlements on locations.id_settlement=settlements.id
        where people.is_member=1 and settlements.id=".$id_settlement,0
    );

    $aceptan_caee=contar(
        "people",
        "
        left join locations on people.id_location=locations.id
        left join settlements on locations.id_settlement=settlements.id
        where people.is_caee and settlements.id=".$id_settlement,0
    );

    $id_settlement=$_SESSION['usuario_datos_id_grupo'];
    $viewFile="view_dashboard";
    // $viewFile="view_dashboard";

} else {

    $page_title="Dashborard";

    $total_agremiados=contar("people","where is_member=1");
    $aceptan_caee=contar("people","where is_caee=1");
    $bases_activas=contar("settlements","where is_closed=0");

    $viewFile="view_dashboard";

}
