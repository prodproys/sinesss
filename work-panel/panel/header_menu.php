<div class='menus'>
<?php

if(function_exists('middleware_header_menu')){
    middleware_header_menu();
}

if(0)
prin([
    'Local'=>$Local,
    'Admin'=>$_COOKIE["admin"],
    'VALIDAR_SESION'=>$VALIDAR_SESION,
    'usuario_id'=>$_SESSION['usuario_id'],
]);

/*
########  #######   #######  ##       ########     ###    ########
   ##    ##     ## ##     ## ##       ##     ##   ## ##   ##     ##
   ##    ##     ## ##     ## ##       ##     ##  ##   ##  ##     ##
   ##    ##     ## ##     ## ##       ########  ##     ## ########
   ##    ##     ## ##     ## ##       ##     ## ######### ##   ##
   ##    ##     ## ##     ## ##       ##     ## ##     ## ##    ##
   ##     #######   #######  ######## ########  ##     ## ##     ##
*/
if($_COOKIE["admin"]=="1"){

    echo "<li class='menudown'>";

        echo "<a>DEVELOPER</a>";

        $file_include='header_toolbar_'.(($Local)?'local':'remote');

        $menuItems=require('include_cache.php');
        
        render_view($menuItems,'menu_float.php');

    echo "</li>";

}


/*
##      ## ######## ########
##  ##  ## ##       ##     ##
##  ##  ## ##       ##     ##
##  ##  ## ######   ########
##  ##  ## ##       ##     ##
##  ##  ## ##       ##     ##
 ###  ###  ######## ########
*/

$url_publica0=explode("panel",str_replace('sistemapanel','frame',getcwd()));
if(file_exists($url_publica0[0])) {

    $url_publica=str_replace('sistemapanel','frame',$url_publica);
    echo "<a href='".str_replace("127.0.0.1","localhost",$url_publica)."' target='_top' >WEB</a>";

}

/*
##     ##    ###     ######  ######## ######## ########
###   ###   ## ##   ##    ##    ##    ##       ##     ##
#### ####  ##   ##  ##          ##    ##       ##     ##
## ### ## ##     ##  ######     ##    ######   ########
##     ## #########       ##    ##    ##       ##   ##
##     ## ##     ## ##    ##    ##    ##       ##    ##
##     ## ##     ##  ######     ##    ######## ##     ##
*/
if($VALIDAR_SESION=='' or $Local=='1'){

    if( $VALIDAR_SESION=='' /*or $_SESSION['usuario_id']!=''*/ ){

        // TABLAS DEVEL
        echo "<li class='menudown'>";

            echo "<a href='usuarios_acceso.php'>CORE</a>";

            $file_include='header_devel_modules';

            $menuItems=require('include_cache.php');
 
            render_view($menuItems,'menu_float.php');
               
        echo  "</li>";

    }
    
    // ! header_switch_project : no se puede abrir una segunda conexión de base de datos AUN
    if(0){
        echo "<li class='menudown'>";

            echo "<a ". (($script_name=="maquina.php")?"class='selected'":"") .
                " href='http://{$_SERVER['SERVER_NAME']}/sistemapanel/panel' 
                >{$vars['GENERAL']['factory']}</a>";

            $file_include='header_switch_project';
            
            $menuItems=require('include_cache.php');

            render_view($menuItems,'menu_float.php');

        echo  "</li>";
    }

} 





// unset($menus_d);



/*
##     ##    ###     ######  ######## ######## ########
###   ###   ## ##   ##    ##    ##    ##       ##     ##
#### ####  ##   ##  ##          ##    ##       ##     ##
## ### ## ##     ##  ######     ##    ######   ########
##     ## #########       ##    ##    ##       ##   ##
##     ## ##     ## ##    ##    ##    ##       ##    ##
##     ## ##     ##  ######     ##    ######## ##     ##
*/
// if($_COOKIE["admin"]=="1")
if( 
    // $VALIDAR_SESION!='' 
    // and $_SESSION['usuario_id']!='' 
    // and 
    ($Local==1) or
    ($_COOKIE["admin"]=="1")

    ){

    // prin($_SESSION);
    //	$tabla_usuarios
    //	$tabla_usuarios_id_sub
    if($SERVER['ARCHIVO_REAL']!="login.php"){

        echo "<li class='menudown' >";
            //$mmmM.= "</a>";
            echo "<a href='maquina.php?redirhome=1'
            class=' master ". (($script_name=="maquina.php")?"selected":"") ." '
            >MASTER</a>";
            // CUANDO NO ERES MASTER
            if( ( $Local==1 ) ){
                
                $file_include='header_switch_user';

                $menuItems=require('include_cache.php');

                render_view($menuItems,'menu_float.php');

            }

        echo "</li>";
        
    }


    // JEFE
    echo  ($_SESSION['usuario_datos_nombre_grupo'])?"<li class='m_grupo'><span>". $_SESSION['usuario_datos_nombre_grupo'] ."</span></li>":'';


}

/*
##     ##  ######  ##     ##    ###    ########  ####  #######
##     ## ##    ## ##     ##   ## ##   ##     ##  ##  ##     ##
##     ## ##       ##     ##  ##   ##  ##     ##  ##  ##     ##
##     ##  ######  ##     ## ##     ## ########   ##  ##     ##
##     ##       ## ##     ## ######### ##   ##    ##  ##     ##
##     ## ##    ## ##     ## ##     ## ##    ##   ##  ##     ##
 #######   ######   #######  ##     ## ##     ## ####  #######
*/

$menu_user[]=[
    'name'=>'modo oscuro',
    'onclick'=>'document.body.classList.add("dark");'.
        'fetch("ajax_change_cookie.php?var=dark&val=1");'.
        'theme="dark";'.
        'return false;',
    'class'=>'link_dark_mode',
];
$menu_user[]=[
    'name'=>'modo claro',
    'onclick'=>'document.body.classList.remove("dark");'.
        'fetch("ajax_change_cookie.php?var=dark&val=0");'.
        'theme="light";'.
        'return false;',
    'class'=>'link_light_mode',
];
$menu_user[]=[
    'name'=>'Cambiar Clave',
    'aclass'=>'modal-link',
    'class'=>'form_user_change_password',
    'dataurl'=>"modal.php?page=form_user_change_password"
];
$menu_user[]=[
    'name'=>'Editar mi Perfil',
    'aclass'=>'modal-link',
    'class'=>'form_user_edit',
    'dataurl'=>"modal.php?page=form_user_edit" 
];

if($_COOKIE["admin"]=="1"){

    $menu_user[]=[
        'name'=>'cerrar sesión de admin',
        'url'=>'maquina.php?accion=borrarcookie',
        'class'=>'link_logout',
    ];

}

if( $VALIDAR_SESION!='' and $_SESSION['usuario_id']!='' ){

    $menu_user[]=[
        'name'=>'cerrar sesión',
        'url'=>'salir.php',        
        'class'=>'link_logout',
    ];

}



$menu_user_better=[];
if( $VALIDAR_SESION!='' and $_SESSION['usuario_id']!='' ){
    
    $menu_user_better=[
        'name'=>$_SESSION['usuario_datos_nombre'],
        'aclass'=>'menu_user',
    ]; 

} 

render_view([
    'items'=>[
        array_merge([
            'class'=>'menudown',
            'aclass'=>'menu_icono',
            'items'=>$menu_user,
        ],
            $menu_user_better
        )
    ]
],'links_float.php'); 
?>


</div>