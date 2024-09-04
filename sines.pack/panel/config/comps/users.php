<?php
unset($objeto_tabla_comp);


$objecto_tabla_common['person']['config']=[

	'eliminar'		=> '0',
	'editar'		=> '1',
	'crear'			=> '1',
	'crear_quick'	=> '0',
	'altura_listado'	=> 'auto',
	'visibilidad'	=> '0',
	'buscar'		=> '0',
	'bloqueado'		=> '0',
	'menu'			=> '1',
	'orden'			=> '1',
	'width_listado'	=> '800px',
	'edicion_completa'=> '1',
	'expandir_vertical'=> '0',
	'edicion_rapida'	=> '0',
	'calificacion'	=> '0',
	// 'set_fila_fijo'	=> '3',
	'disabled'		=> '0'

];

$objeto_tabla_common['person']['campos']=array_merge(
	// basico
	[
		'nombre'		=>array(
				'campo'			=> 'nombre',
				'label'			=> 'Nombre',
				'tipo'			=> 'inp',
				'listable'		=> '1',
				'validacion'	=> '1',
				'width'			=> '150px',
				'style'			=> 'width:150px;',
				'derecha'		=> '1',
				'like'			=> '0',
				'tags'			=> '1',
				'queries'		=> '0',
				'dlquery'		=> '0',
				// 'noedit'			=> '1'
		),
		/*
		'apellidos'		=>array(
				'campo'			=> 'apellidos',
				'label'			=> 'Apellidos',
				'tipo'			=> 'inp',
				'listable'		=> '1',
				'validacion'	=> '0',
				'width'			=> '130px',
				'style'			=> 'width:150px;',
				'derecha'		=> '2',
				'like'			=> '0',
				'tags'			=> '1',
				'noedit'			=> '1'						
		),
		*/
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
	]

	/*

	// ubi
	chain_campos(
		$objeto_tabla,
		$objeto_chain['ubi']
	)	
	// more

	[
		'direccion'		=>array(
				'campo'			=> 'direccion',
				'label'			=> 'Dirección',
				'tipo'			=> 'inp',
				'listable'		=> '0',
				'validacion'	=> '0',
				'width'			=> '150px',
				'style'			=> 'width:300px;',
				'derecha'		=> '1'
		),
		'telefono'		=>array(
				'campo'			=> 'telefono',
				'label'			=> 'Teléfono Casa',
				'tipo'			=> 'inp',
				'listable'		=> '0',
				'validacion'	=> '0',
				'width'			=> '70px',
				'style'			=> 'width:70px;',
				'derecha'		=> '1'
		),
		'celular'=>array(
				'campo'			=> 'celular',
				'label'			=> 'Teléfono Celular',
				'tipo'			=> 'inp',
				'listable'		=> '0',
				'validacion'	=> '0',
				'width'			=> '70px',
				'style'			=> 'width:70px;',
				'derecha'		=> '2'
		),
	]
	*/

);





$objeto_tabla_comp['ADMINISTRADORES']=array_merge(
	[
		'grupo'			=> 'usuarios',
		'me'			=> 'ADMINISTRADORES',
		'titulo'		=> 'Administradores',
		'menu_label'	=> 'Administradores',
		'nombre_singular'=> 'administrador',
		'nombre_plural'	=> 'administradores',
		'tabla'			=> 'administradores',
		'archivo'		=> 'administradores',
		'prefijo'		=> 'adm',
		'archivo_sub'	=> 'usuarios_acceso',
		'campos'		=>array_merge(
			$objeto_tabla_common['base'],
			$objeto_tabla_common['person']['campos'],
			objeto_tabla_sesion(1)
		),	
	],
	$objecto_tabla_common['person']['config']
);

$objeto_tabla_comp['PRODUCT_MANAGERS']=array_merge(
	[
		'me'			=> 'PRODUCT_MANAGERS',
		'grupo'			=> 'usuarios',
		'titulo'		=> 'product_managers',
		'menu_label'	=> 'Product Managers',
		'nombre_singular'=> 'product_managers',
		'nombre_plural'	=> 'product_managers',
		'tabla'			=> 'product_managers',
		'archivo'		=> 'product_managers',
		'prefijo'		=> 'proman',
		'archivo_sub'	=> 'usuarios_acceso',
		'campos'		=>array_merge(
			$objeto_tabla_common['base'],
			$objeto_tabla_common['person']['campos'],
			objeto_tabla_sesion(4)
		),	
	],
	$objecto_tabla_common['person']['config']
);

$objeto_tabla_comp['CONTADORES']=array_merge(
	[
		'me'			=> 'CONTADORES',
		'grupo'			=> 'usuarios',
		'titulo'		=> 'contadores',
		'menu_label'	=> 'Contadores',
		'nombre_singular'=> 'contador',
		'nombre_plural'	=> 'contadores',
		'tabla'			=> 'contadores',
		'archivo'		=> 'contadores',
		'prefijo'		=> 'cont',
		'archivo_sub'	=> 'usuarios_acceso',
		'campos'		=>array_merge(
			$objeto_tabla_common['base'],
			$objeto_tabla_common['person']['campos'],
			objeto_tabla_sesion(5)
		),	
	],
	$objecto_tabla_common['person']['config']
);

$objeto_tabla_comp['USUARIOS_BASE']=array_merge(
	[
		'grupo'			=> 'usuarios',
		'me'			=> 'USUARIOS_BASE',
		'titulo'		=> 'Usuarios de Base',
		'menu_label'	=> 'Usuarios de Base',
		'nombre_singular'=> 'usuario de base',
		'nombre_plural'	=> 'usuarios de base',
		'tabla'			=> 'usuarios_base',
		'archivo'		=> 'usuarios_base',
		'prefijo'		=> 'usu_bas',
		'archivo_sub'	=> 'usuarios_acceso',
		'campos'		=>array_merge(
			$objeto_tabla_common['base'],
			$objeto_tabla_common['person']['campos'],
			objeto_tabla_sesion(2),
			[
				'id_settlement'		=>array(
                    'campo'			=> 'id_settlement',
                    'label'			=> 'Base',
                    'width'			=> '120px',
                    'listable'		=> '1',
                    'tipo'			=> 'hid',
                    'opciones'		=> 'id,nombre|settlements|order by nombre asc',
                    'derecha'		=> '1',
                    'tags'			=> '1',
                    'queries'		=> '1',
                    'validacion'	=> '1',
                    'tip_foreig'	=> '1',
                    //! LINK EXTERNO
                    'foreigkey'     => 'SETTLEMENTS',
                    'foreig'        => '1',
                    'default'       => '[id_settlement]',                    
                    // 'select_multiple'=> '1',
                )
			]
		),
	],
	$objecto_tabla_common['person']['config'],
	[
		'group'=>'id_settlement'
	]
);
$objeto_tabla_comp['SUPERADMIN']=array_merge(
	[
		'grupo'			=> 'usuarios',
		'me'			=> 'SUPERADMIN',
		'titulo'		=> 'Super Administradores',
		'menu_label'	=> 'Super Administradores',
		'nombre_singular'=> 'super administrador',
		'nombre_plural'	=> 'super administradores',
		'tabla'			=> 'superadmin',
		'archivo'		=> 'superadmin',
		'prefijo'		=> 'supadm',
		'archivo_sub'	=> 'usuarios_acceso',
		'campos'		=>array_merge(
			$objeto_tabla_common['base'],
			$objeto_tabla_common['person']['campos'],
			objeto_tabla_sesion(3)
		),	
	],
	$objecto_tabla_common['person']['config']
);

// prinx($objeto_tabla_comp['USUARIOS_BASE']);

return $objeto_tabla_comp;