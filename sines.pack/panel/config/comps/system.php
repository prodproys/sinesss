<?php

unset($objeto_tabla_comp);

$objeto_tabla_comp['VARIABLES']=array(
    'titulo'		=> 'Variables',
    'nombre_singular'=> 'variable',
    'nombre_plural'	=> 'variables',
    'tabla'			=> 'variables',
    'archivo'		=> 'variables',
    'prefijo'		=> 'var',
    'eliminar'		=> '0',
    'ocultar'		=> '0',
    'crear'			=> '0',
    'editar'		=> '1',
    'buscar'		=> '0',
    'bloqueado'		=> '0',
    'crear_label'	=> '100px',
    'crear_txt'		=> '400px',
    'menu'			=> '1',
    'menu_label'	=> 'Variables',
    'me'			=> 'VARIABLES',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'variable'		=>array(
                    'campo'			=> 'variable',
                    'label'			=> 'Variable',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'constante'		=> '1',
                    'width'			=> '300px'
            ),
            'valor'			=>array(
                    'campo'			=> 'valor',
                    'label'			=> 'Valor',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'width'			=> '300px'
            ),
            'web'			=>array(
                    'campo'			=> 'web',
                    'tipo'			=> 'web'
            )
    ),
    'grupo'			=> 'contenidos',
    'web'			=> '1',
    'disabled'		=> '1'
);

$objeto_tabla_comp['USUARIOS_ACCESO']=array(
    'grupo'			=> 'sistema',
    'alias_grupo'	=> 'core',
    'titulo'		=> 'Administración de Acceso de Usuarios',
    'nombre_singular'=> 'usuario',
    'nombre_plural'	=> 'usuarios',
    'tabla'			=> 'usuarios_acceso',
    'archivo'		=> 'usuarios_acceso',
    'prefijo'		=> 'usu',
    'eliminar'		=> '1',
    'editar'		=> '1',
    'edicion_completa'=> '1',
    'buscar'		=> '1',
    'menu'			=> '0',
    'menu_label'	=> 'usuarios',
    'me'			=> 'USUARIOS_ACCESO',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'calificacion'	=>array(
                    'campo'			=> 'calificacion',
                    'tipo'			=> 'cal'
            ),
            'nombre'		=>array(
                    'campo'			=> 'nombre',
                    'label'			=> 'Nombre',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'sesion_login'	=> '1',
                    'like'			=> '1'
            ),
            'password'		=>array(
                    'campo'			=> 'password',
                    'label'			=> 'Password',
                    'tipo'			=> 'pas',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'sesion_password'=> '1',
                    'width'			=> '200px'
            ),
            'nombre_completo'=>array(
                    'campo'			=> 'nombre_completo',
                    'label'			=> 'Nombre Completo',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'sesion_complete'=> '1',
                    'width'			=> '200px',
                    'like'			=> '1'
            ),
            /*
            'email'			=>array(
                'campo'			=> 'email',
                'label'			=> 'Email',
                'subvalidacion'		=> 'email',
                'tipo'			=> 'inp',
                'listable'		=> '1',
                // 'validacion'	=> '1',
                'width'			=> '150px',
                'style'			=> 'width:150px;',
                'derecha'		=> '1',
                'default'		=> '',
                'like'			=> '1',
                'unique'		=> '0'
            ),
            */           
            'id_permisos'	=>array(
                    'campo'			=> 'id_permisos',
                    'label'			=> 'Permisos',
                    'width'			=> '120px',
                    'tipo'			=> 'hid',
                    'listable'		=> '1',
                    'opciones'		=> 'id,nombre|usuarios_permisos',
                    'sesion_permisos'=> '1',
                    'tip_foreig'	=> '1',
                    'queries'		=> '1'
            ),

    ),
    'importar_csv'	=> '0',
    'disabled'		=> '0'
);

$objeto_tabla_comp['USUARIOS_PERMISOS']=array(
    'grupo'			=> 'sistema',
    'titulo'		=> 'Permisos de Usuarios',
    'nombre_singular'=> 'permiso',
    'nombre_plural'	=> 'permisos',
    'tabla'			=> 'usuarios_permisos',
    'archivo'		=> 'usuarios_permisos',
    'prefijo'		=> 'usuper',
    'eliminar'		=> '0',
    'editar'		=> '1',
    'buscar'		=> '0',
    'menu'			=> '0',
    'menu_label'	=> 'Permisos',
    'me'			=> 'USUARIOS_PERMISOS',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'calificacion'	=>array(
                    'campo'			=> 'calificacion',
                    'tipo'			=> 'cal'
            ),
            'nombre'		=>array(
                    'campo'			=> 'nombre',
                    'label'			=> 'Nombre',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'unique'		=> '1',
                    'width'			=> '200PX'
            ),
            'texto'			=>array(
                    'campo'			=> 'texto',
                    'label'			=> 'Propiedades',
                    'tipo'			=> 'txt',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '700px',
                    'style'			=> 'width:500px;height:300px;'
            ),
            'multiusuario'	=>array(
                    'campo'			=> 'multiusuario',
                    'label'			=> 'Multiusuario',
                    'width'			=> '100px',
                    'listable'		=> '1',
                    'tipo'			=> 'com',
                    'opciones'		=>array(
                            '2'			=> 'Multi Grupo',
                            '1'			=> 'Multi Total',
                            '0'			=> 'Individual',
                            '3'			=> 'Registro'
                    ),
                    'default'		=> '0',
                    'derecha'		=> '2'
            )
    ),
    'importar_csv'	=> '0',
    'disabled'		=> '0',
    'edicion_completa'=> '1',
    'visibilidad'	=> '0',
    'calificacion'	=> '0'
);

$objeto_tabla_comp['CONFIGURACIONES_ROOT']=array(
    'grupo'			=> 'sistema',
    'titulo'		=> 'Configuración root',
    'nombre_singular'=> 'variable',
    'nombre_plural'	=> 'variables',
    'tabla'			=> 'configuraciones_root',
    'archivo'		=> 'configuraciones_root',
    'prefijo'		=> 'conr',
    'eliminar'		=> '0',
    'ocultar'		=> '0',
    'crear'			=> '1',
    'editar'		=> '1',
    'buscar'		=> '0',
    'bloqueado'		=> '0',
    'crear_label'	=> '100px',
    'crear_txt'		=> '400px',
    'menu'			=> '0',
    'menu_label'	=> 'Configuración root',
    'me'			=> 'CONFIGURACIONES_ROOT',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'calificacion'	=>array(
                    'campo'			=> 'calificacion',
                    'tipo'			=> 'cal'
            ),
            'variable'		=>array(
                    'campo'			=> 'variable',
                    'label'			=> 'Variable',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'constante'		=> '1',
                    'width'			=> '300px'
            ),
            'valor'			=>array(
                    'campo'			=> 'valor',
                    'label'			=> 'Valor',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'width'			=> '300px'
            )
    )
);

$objeto_tabla_comp['CONFIGURACIONES']=array(
    'grupo'			=> 'sistema',
    'titulo'		=> 'Configuración',
    'nombre_singular'=> 'variable',
    'nombre_plural'	=> 'variables',
    'tabla'			=> 'configuraciones',
    'archivo'		=> 'configuraciones',
    'prefijo'		=> 'con',
    'eliminar'		=> '0',
    'ocultar'		=> '0',
    'crear'			=> '0',
    'editar'		=> '1',
    'buscar'		=> '0',
    'bloqueado'		=> '0',
    'crear_label'	=> '100px',
    'crear_txt'		=> '400px',
    'menu'			=> '0',
    'menu_label'	=> 'Configuración',
    'me'			=> 'CONFIGURACIONES',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'calificacion'	=>array(
                    'campo'			=> 'calificacion',
                    'tipo'			=> 'cal'
            ),
            'variable'		=>array(
                    'campo'			=> 'variable',
                    'label'			=> 'Variable',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'constante'		=> '1',
                    'width'			=> '300px'
            ),
            'valor'			=>array(
                    'campo'			=> 'valor',
                    'label'			=> 'Valor',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1',
                    'width'			=> '300px'
            )
    )
);

$objeto_tabla_comp['WEB_CONFIG']=array(
    'grupo'			=> 'sistema',
    'titulo'		=> 'Webs',
    'nombre_singular'=> 'web',
    'nombre_plural'	=> 'webs',
    'tabla'			=> 'web_config',
    'archivo'		=> 'web_config',
    'prefijo'		=> 'webcon',
    'eliminar'		=> '1',
    'editar'		=> '1',
    'buscar'		=> '0',
    'menu'			=> '0',
    'menu_label'	=> 'Webs',
    'me'			=> 'WEB_CONFIG',
    'orden'			=> '1',
    'campos'		=>array(
            'id'			=>array(
                    'campo'			=> 'id',
                    'tipo'			=> 'id'
            ),
            'fecha_creacion'	=>array(
                    'campo'			=> 'fecha_creacion',
                    'tipo'			=> 'fcr'
            ),
            'fecha_edicion'	=>array(
                    'campo'			=> 'fecha_edicion',
                    'tipo'			=> 'fed'
            ),
            'posicion'		=>array(
                    'campo'			=> 'posicion',
                    'tipo'			=> 'pos'
            ),
            'visibilidad'	=>array(
                    'campo'			=> 'visibilidad',
                    'tipo'			=> 'vis'
            ),
            'calificacion'	=>array(
                    'campo'			=> 'calificacion',
                    'tipo'			=> 'cal'
            ),
            'nombre'		=>array(
                    'campo'			=> 'nombre',
                    'label'			=> 'Nombre',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '0',
                    'width'			=> '300px'
            ),
            'proyecto'		=>array(
                    'campo'			=> 'proyecto',
                    'label'			=> 'ID Proyecto',
                    'tipo'			=> 'inp',
                    'listable'		=> '1',
                    'validacion'	=> '1'
            )
    ),
    'importar_csv'	=> '0',
    'disabled'		=> '0'
);

return $objeto_tabla_comp;