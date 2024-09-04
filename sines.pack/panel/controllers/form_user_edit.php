<?php
/**
**** 
* Archivo: form_user_edit.php
* Author: Sinesss
* Tipo: Controlador
* Lenguaje: PHP
* Descripción:  Este archivo es el controller backend del formulario para editar los datos del usuario
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
    0
);

// prin($_SESSION);
// prin($user);
// prin($user_tabla_fila);
if($_SERVER['REQUEST_METHOD']=='POST'){


    if(trim($_POST['nombre'])==''){
        
        echo json_encode(['status'=>'danger','text'=>"Id no puede estar vacio"]);
        exit();         
    }    

    if(trim($_POST['email'])==''){
        
        echo json_encode(['status'=>'danger','text'=>"email no puede estar vacio"]);
        exit();         
    }  

    if(trim($_POST['nombre_completo'])==''){
        
        echo json_encode(['status'=>'danger','text'=>"Nombre no puede estar vacio"]);
        exit();         
    }      

    update([
        'nombre'=>$_POST['nombre'],
        'nombre_completo'=>$_POST['nombre_completo'],
        'email'=>$_POST['email']
    ]
    ,"usuarios_acceso"
    ,"where id=".$_SESSION['usuario_id']
    ,0);

    update([
        'usuarios_acceso_nombre'=>$_POST['nombre'],
        'nombre'=>$_POST['nombre_completo'],
        'email'=>$_POST['email']
    ]
    ,$user_tabla
    ,"where id=".$user_tabla_fila['id']
    ,0);    

    $_SESSION['nombre_completo']=$_POST['nombre_completo'];
    $_SESSION['usuario_datos_nombre']=$_POST['nombre_completo'];

    echo json_encode([
        'status'=>'success',
        'text'=>"Cambio de datos exitoso",
        'eval'=>'location.reload();'
    ]);

    exit();
    
} 

$fields=[

    'nombre'=>[
        'class' =>'validate',
        'label' =>'ID',
        'value' => $user_tabla_fila['usuarios_acceso_nombre'],
    ],

    'email'=>[
        'class' =>'validate',
        'label' =>'Correo',
        'type'  =>'Email',
        'value' => $user_tabla_fila['email'],
    ],
    
    'nombre_completo'=>[
        'class' =>'validate',
        'label' =>'Nombres',
        'value' => $user_tabla_fila['nombre'],
    ],
    
];



$title="Editar mi perfil";

$button='Actualizar mi perfil';

$fields=processFields($fields);

$viewFile="view_form_general";
