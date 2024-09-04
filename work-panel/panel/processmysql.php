<?php 
set_time_limit(0);	
include("lib/global.php");

/* Conexion y eso*/ 
	$link=mysql_connect ($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
	mysql_select_db ($MYSQL_DB,$link);	
	mysql_query("SET NAMES 'utf8'",$link);

	$mysql=implode("",file("export.sql"));
				
	$MYSQL=explode(";\n",$mysql);
	if(sizeof($MYSQL)>0){
		foreach($MYSQL as $sqle){
			if(trim($sqle)!='' and trim($sqle)!='#'){
				$oksql=mysql_query($sqle.";",$link);
				echo ($oksql)?"<div>$sqle<span style='color:green;'>ok</span></div>":"<div><textarea style='width:94%;height:50px;'>$sqle</textarea><span style='color:red;'>ko</span></div>";
			}
		}
	}
	
?>	