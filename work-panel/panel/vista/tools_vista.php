<?php //á

switch($_GET['tab']){

case "estadisticas":

include("estadisticas.php");

break;

case "feedback":

include("feedback.php");

break;

default:

break;
}
?>