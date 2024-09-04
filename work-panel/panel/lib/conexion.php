<?php //á
// @$link=mysql_connect ($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS) or die ('error de conexion:'.mysql_error());
// mysql_select_db ($MYSQL_DB,$link);
// mysql_query("SET NAMES 'utf8'",$link);
// date_default_timezone_set('America/Lima');
// mysql_query("SET `time_zone` = '".date('P')."'");

$link = mysqli_connect($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASS,$MYSQL_DB);
mysqli_set_charset($link,"utf8");
date_default_timezone_set('America/Lima');
mysqli_query($link,"SET `time_zone` = '".date('P')."'");

// mysql_query("SET `time_zone` = '".date('P')."'");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

