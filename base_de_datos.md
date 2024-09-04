# BASE DE DATOS

# Obtener la base de datos del servidor
Exportar la última base datos actualizada, desde el panel de SINESSS

paso 1: ingresar al panel
- http://sinesss.com:2083
- usuario : sindenf
- clave : $$$sine%sss%20%24

paso 2 : click en Phpmyadmin

paso 3 : seleccionar base de datos sindenf_panel

paso 4 : Export

paso 5 : marcar CUSON

paso 6 : marcar Add DROP TABLE / VIEW / PROCEDURE / FUNCTION / EVENT / TRIGGER statement

paso 7 : click en GO

# Últimas copias de base de datos quincenal

Se accede a las últimas copias de las base de datos por FTP 
- servidor : sinesss.com
- usuario : sindenf
- clave : \$sindicato\$deenfermeras
- carpeta : /ultimas_copias_de_base_datos_quincenal

# Diagrama UML

Modelo de base de datos de elementos del sistema, relaciones con la tabla personas
![UML1](https://sinesss.com/panel/public/img/uml1.png)


Modelo de base datos de usurios, permisos y ubivacion
![UML2](https://sinesss.com/panel/public/img/uml2.png)


# BASE DE DATOS SQL

- [ESTRUCTURA DE LA DATOS COMPLETA EN SQL, COMENTADA](https://github.com/sinesss/sinesss/blob/main/sines.pack/panel_sines_2021-02-19.sql)



# administradores


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : Nombre del administrador
* **email** : Email del administrador
* **usuarios_acceso_nombre** : Usuario de acceso 
* **usuarios_acceso_password** : Clave de acceso
* **usuarios_acceso_id_permisos** : id de la tabla usuarios_permisos
* **id_sesion** : id de sesion

# asigments


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **id_document** : id de la tabla documents
* **amount** : Monto de la asignación
* **operation_bank** : Número de operación bancaria
* **transaction_date** : Fecha de la transacción
* **created_by** : Creado por
* **can_view_assignation** : bit de visibilidad de la asignación (campo heredado del antiguo sistema)

# conceptos


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **code** : código del concepto
* **nombre** : nombre del concepto
* **description** : descripción del concepto

# configuraciones


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **variable** : variable
* **valor** : valor

# configuraciones_root


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **variable** : variable
* **valor** : valor

# contadores


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre
* **email** : email
* **usuarios_acceso_nombre** : usuario de acceso
* **usuarios_acceso_password** : clave de acceso
* **usuarios_acceso_id_permisos** : id de la tabla usuarios_permisos
* **id_sesion** : id de sesion

# documents


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **id_persona** : id de agremiado / tabla people
* **classifier_a** : ficha de cancelación
* **classifier_b** : resolución
* **document_entry_date** : fecha de recepción
* **event_date** : fecha del evento
* **code** : código del documento
* **created_by** : registrado por
* **can_edit** : (campo heredado del antiguo sistema / no se usa)
* **can_create_assignation** : (campo heredado del antiguo sistema / no se usa)
* **can_create_attachment** : (campo heredado del antiguo sistema / no se usa)
* **can_delete_attachment** : (campo heredado del antiguo sistema / no se usa)
* **can_delete** : (campo heredado del antiguo sistema / no se usa)
* **document_type_id** : tipo de requerimiento
* **document_type_has_assigments** : (campo heredado del antiguo sistema / no se usa)
* **document_type_value_id** : tipo de documento
* **on_start_state** : (campo heredado del antiguo sistema / no se usa)
* **on_end_state** : (campo heredado del antiguo sistema / no se usa)
* **state_id** : estado del documento
* **id_settlement** : id de base / tabla settlements

# geo_departamentos


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : departamento
* **geo** : codigo geo

# geo_distritos


* **id_provincia** : id de provincia / tabla geo_provincias
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : distrito
* **geo** : codigo geo

# geo_provincias


* **id_departamento** : id de departamento / tabla geo_departamentos
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : provincia
* **geo** : codigo geo

# locations


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre de ente
* **code** : código de ente
* **description** : descripción
* **id_zone** : id de red asistencial / tabla zones
* **id_settlement** : id de base / tabla settlements

# operations


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **id_persona** : id de agremiado / tabla people
* **total_amount** : monto total
* **share_type** : tipo de aporte
* **total_shares** : número total de aportes
* **id_settlement** : id de base / tabla settlements

# payments


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **type** : tipo de pago
* **month** : mes
* **registered_by** : registrado por
* **operation_id** : id de operación / tabla operations
* **id_persona** : id de agremiado / tabla people
* **voucher** : número de voucher del deposito bancario
* **comment** : comentario
* **amount** : monto
* **concept** : concepto
* **id_settlement** : id de base / tabla settlements
* **revisado** : esta revisado?

# people


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **code** : códido de agremiado
* **id_location** : id de entes / tabla locations
* **is_member** : estado de agremiado
* **id_group** : régimen laboral
* **other_organization1** : ¿Afiliado a FEDCUT?
* **other_organization2** : ¿Afiliado a FAMENSALUD?
* **other_organization3** : ¿Afiliado a CUT?
* **other_organization4** : ¿Afiliado a otros sindicatos?
* **document_number** : DNI
* **s_activity_1** : (campo heredado del antiguo sistema / no se usa)
* **s_activity_2** : (campo heredado del antiguo sistema / no se usa)
* **speciality** : Especialidad
* **publications** : Publicaciones
* **apellidos** : apellido del agremiado
* **phone** : teléfono
* **email** : email
* **nombre** : nombre del agremiado
* **birthday** : fecha de nacimiento
* **is_caee** : está afiliado a CAEE o No
* **last_primary** : fecha del último aporte regular
* **last_secondary** : fecha del último aporte CAEE
* **rango_edad** : rango de edad
* **edad** : edad

# people_evo


* **id_settlement** : id de base / tabla settlements
* **is_caee** : esta afiliado a caee?
* **id_group** : regimen laboral
* **month** : mes
* **total** : total
* **amount** : monto
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad

# people_evolution


* **id_settlement** : id de base / tabla settlements
* **is_caee** : esta afiliado a caee?
* **month** : mes
* **total** : total
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad

# people_evolution_general


* **is_caee** : esta afiliado a caee?
* **month** : mes
* **total** : total
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad

# people_evolution_group


* **id_group** : regimen laboral
* **is_caee** : esta afiliado a caee?
* **month** : mes
* **total** : total
* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad

# primaryshares


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **month** : mes
* **registered_by** : registrado por
* **operation_id** : id de operación / tabla operations
* **id_persona** : id de agremiado / tabla people
* **voucher** : número de voucher del deposito bancario
* **comment** : comentario
* **amount** : monto
* **concept** : concepto
* **id_settlement** : id de base / tabla settlements
* **id_group** : regimen laboral
* **revisado** : esta revisado?

# product_managers


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre del product manager
* **email** : email
* **usuarios_acceso_nombre** : usuario de acceso
* **usuarios_acceso_password** : clave de acceso
* **usuarios_acceso_id_permisos** : id de la tabla usuarios_permisos
* **id_sesion** : id de sesion

# records


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **id_persona** : id de agremiado / tabla people
* **description** : descripción
* **type** : tipo de registro histórico 
* **state** : estado : closed active
* **start_location_label** : en trasaldo ente inicial
* **end_location_label** : en traslado ente final
* **id_settlement** : id de base / tabla settlements
* **start_location** : en trasaldo id de ente inicial
* **end_location** : en trasaldo id de ente final
* **registered_by** : registrado por

# secondaryshares


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **month** : mes
* **registered_by** : registrado por
* **operation_id** : id de operación / tabla operations
* **id_persona** : id de agremiado / tabla people
* **voucher** : número de voucher del deposito bancario
* **comment** : comentario
* **amount** : monto
* **concept** : concepto
* **id_settlement** : id de base / tabla settlements
* **id_group** : regimen laboral
* **revisado** : esta revisado?

# settlement_managment_group


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **id_settlement** : id de base / tabla settlements
* **beggin_on** : fecha de inicio
* **end_on** : fecha de fin
* **nombre** : nombre
* **email** : email
* **phone** : teléfono
* **description** : descripción

# settlements


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre de la base
* **code** : código de la base
* **description** : descripción
* **is_closed** : si está cerrada la base

# superadmin


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre
* **email** : email
* **usuarios_acceso_nombre** : usuario de acceso
* **usuarios_acceso_password** : clave de acceso
* **usuarios_acceso_id_permisos** : id de la tabla usuarios_permisos
* **id_sesion** : id de sesion

# usuarios_acceso


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre de acceso
* **password** : clave de acceso
* **nombre_completo** : nombre completo
* **id_permisos** : "id de permisos / tabla usuarios_permisos"

# usuarios_base


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre
* **email** : email
* **usuarios_acceso_nombre** : usuario de acceso
* **usuarios_acceso_password** : clave de acceso
* **usuarios_acceso_id_permisos** : id de la tabla usuarios_permisos
* **id_sesion** : id de sesion
* **id_settlement** : id de base / tabla settlements

# usuarios_permisos


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : usuario de acceso
* **texto** : string de los permisos

# variables


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **variable** : variable
* **valor** : valor

# web_config


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre

# zones


* **fecha_creacion** : Fecha de creación
* **fecha_edicion** : Fecha de la última edición
* **visibilidad** : bit de visibilidad
* **nombre** : nombre de la red asistencial
* **code** : código de la red asistencial
* **description** : descripción de la red asistencial

