<?php //á


include("conexion.php");
include("mysql3.php");

delete($_POST['v_t'],str_replace("\\'","'",$_POST['v_d']),$_GET['debug']);


?>