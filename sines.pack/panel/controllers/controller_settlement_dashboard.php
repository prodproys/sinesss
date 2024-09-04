<?php
/**
**** 
* Archivo: controller_settlement_dashboard.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend de la sección "dashboard" del menú para el usuario de una base
**** 
*/






$page_title="Dashborard";

$id_settlement=$_GET['id_settlement'];

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

$viewFile="view_settlement_dashboard";
