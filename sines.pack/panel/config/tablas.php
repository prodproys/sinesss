<?php //á



$objeto_chain['ubi']=[
	'GEO_DEPARTAMENTOS',
	'GEO_PROVINCIA',
	'GEO_DISTRITOS'
];

// echo getcwd();
// CLASSES
// $urlpat=$PATH_WORK_PANEL_li_tabla_classes.'lib/tabla_classes.php';
// echo "$urlpat<br>";
// exit();
// prin($PATH_WORK_PANEL_li_tabla_classes);
include_once $PATH_WORK_PANEL_li_tabla_classes.'lib/tabla_classes.php';



// SYSTEM
$objeto_tabla=array_merge($objeto_tabla,require 'comps/system.php');

// UBI
// $objeto_tabla=array_merge($objeto_tabla,require 'comps/ubi.php');



/*
 ######   #######  ##    ## ######## ####  ######
##    ## ##     ## ###   ## ##        ##  ##    ##
##       ##     ## ####  ## ##        ##  ##
##       ##     ## ## ## ## ######    ##  ##   ####
##       ##     ## ##  #### ##        ##  ##    ##
##    ## ##     ## ##   ### ##        ##  ##    ##
 ######   #######  ##    ## ##       ####  ######
*/

/*
 ___  ________   ________  ___  ___  _______   ________
|\  \|\   ____\ |\   ____\|\  \|\  \|\  ___ \ |\   ____\
\ \  \ \  \___|_\ \  \___|\ \  \\\  \ \   __/|\ \  \___|_
 \ \  \ \_____  \\ \_____  \ \  \\\  \ \  \_|/_\ \_____  \
  \ \  \|____|\  \\|____|\  \ \  \\\  \ \  \_|\ \|____|\  \
   \ \__\____\_\  \ ____\_\  \ \_______\ \_______\____\_\  \
    \|__|\_________\\_________\|_______|\|_______|\_________\
        \|_________\|_________|                  \|_________|


*/
$objeto_tabla=array_merge($objeto_tabla,require 'comps/issues.php');


/*
 ___  ___  ________  _______   ________  ________
|\  \|\  \|\   ____\|\  ___ \ |\   __  \|\   ____\
\ \  \\\  \ \  \___|\ \   __/|\ \  \|\  \ \  \___|_
 \ \  \\\  \ \_____  \ \  \_|/_\ \   _  _\ \_____  \
  \ \  \\\  \|____|\  \ \  \_|\ \ \  \\  \\|____|\  \
   \ \_______\____\_\  \ \_______\ \__\\ _\ ____\_\  \
    \|_______|\_________\|_______|\|__|\|__|\_________\
             \|_________|                  \|_________|


*/
$objeto_tabla=array_merge($objeto_tabla,require 'comps/users.php');



/*
########  ########   #######   ######   ########     ###    ##     ##
##     ## ##     ## ##     ## ##    ##  ##     ##   ## ##   ###   ###
##     ## ##     ## ##     ## ##        ##     ##  ##   ##  #### ####
########  ########  ##     ## ##   #### ########  ##     ## ## ### ##
##        ##   ##   ##     ## ##    ##  ##   ##   ######### ##     ##
##        ##    ##  ##     ## ##    ##  ##    ##  ##     ## ##     ##
##        ##     ##  #######   ######   ##     ## ##     ## ##     ##
*/

// $objeto_tabla=array_merge($objeto_tabla,require 'comps/program.php');

// foreigkey
// prin($objeto_tabla['EQUIPOS_CATEGORIAS']['campos']);exit();



$objeto_tabla=tablas_build($objeto_tabla);


// prin($objeto_tabla['ACTIVIDADES']['campos']);exit();
