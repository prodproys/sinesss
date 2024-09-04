<?php
/**
**** 
* Archivo: form_user_change_password.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario para cambiar el password del usuario
**** 
*/





$users_tablas=[
    '1'=>'administradores',
    '2'=>'usuarios_base',
];

$user_tabla=$users_tablas[$_SESSION['permisos']['PERMISOS_ID']];

$user_tabla_fila=fila(
    "id,nombre,email,usuarios_acceso_nombre,usuarios_acceso_password",
    $user_tabla,
    "where id_sesion=".$_SESSION['usuario_id'],
    0
);

$user=fila(
    "id,nombre",
    "usuarios_acceso",
    "where id=".$_SESSION['usuario_id'],
    0);

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(!hay('usuarios_acceso',
    'where password="'.$_POST['old_password'].'"
    and id="'.$_SESSION['usuario_id'].'"
    ')){

        echo json_encode([
            'status'=>'danger',
            'text'=>"Clave Incorrecta",
        ]);
    
        exit();  

    }

    if(
        $_POST['new_password']==''
        or $_POST['new_password_2']==''    
    ){
        
        echo json_encode([
            'status'=>'danger',
            'text'=>"Las nuevas no pueden quedar vacias",
        ]);
    
        exit();         
    }    

    if(
        $_POST['new_password']!=$_POST['new_password_2']   
    ){
        
        echo json_encode([
            'status'=>'danger',
            'text'=>"Las nuevas claves no coinciden",
        ]);
    
        exit();         
    }

    update([
        'password'=>$_POST['new_password']
    ]
    ,"usuarios_acceso"
    ,"where id=".$_SESSION['usuario_id']
    ,0);

    update([
        'usuarios_acceso_password'=>$_POST['new_password']
    ]
    ,$user_tabla
    ,"where id=".$user_tabla_fila['id']
    ,0);    

    echo json_encode([
        'status'=>'success',
        'text'=>"Cambio de Contraseña Exitoso",
        // 'reload'=>1
    ]);

    exit();
    
}    
$fields=[

    'old_password'=>[
        'class' =>'validate',
        'label' =>'Contraseña actual',
        'type'=>'password',
    ],

    'new_password'=>[
        'class' =>'validate',
        'label' =>'Nueva contraseña',
        'type'=>'password',
    ],    
    
    'new_password_2'=>[
        'class' =>'validate',
        'label' =>'Repita nueva contraseña',
        'type'=>'password',
    ], 
    
];

$title="Cambiar mi contraseña";

$button='Cambiar mi contraseña';

$fields=processFields($fields);

$viewFile="view_form_general";
