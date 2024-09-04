# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Base de datos: panel_sines
# Tiempo de Generación: 2021-02-19 12:42:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla administradores
# ------------------------------------------------------------

CREATE TABLE `administradores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'Nombre del administrador',
  `email` varchar(80) DEFAULT NULL COMMENT 'Email del administrador',
  `usuarios_acceso_nombre` varchar(80) DEFAULT NULL COMMENT 'Usuario de acceso ',
  `usuarios_acceso_password` varchar(80) DEFAULT NULL COMMENT 'Clave de acceso',
  `usuarios_acceso_id_permisos` int(10) DEFAULT NULL COMMENT 'id de la tabla usuarios_permisos',
  `id_sesion` int(10) DEFAULT NULL COMMENT 'id de sesion',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_acceso_nombre` (`usuarios_acceso_nombre`),
  UNIQUE KEY `id_sesion` (`id_sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los usuarios administradores';



# Volcado de tabla asigments
# ------------------------------------------------------------

CREATE TABLE `asigments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `id_document` int(10) DEFAULT NULL COMMENT 'id de la tabla documents',
  `amount` decimal(10,4) DEFAULT NULL COMMENT 'Monto de la asignación',
  `operation_bank` varchar(80) DEFAULT NULL COMMENT 'Número de operación bancaria',
  `transaction_date` datetime DEFAULT NULL COMMENT 'Fecha de la transacción',
  `created_by` varchar(80) DEFAULT NULL COMMENT 'Creado por',
  `can_view_assignation` tinyint(1) DEFAULT NULL COMMENT 'bit de visibilidad de la asignación (campo heredado del antiguo sistema)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las asignaciones de los documentos';



# Volcado de tabla conceptos
# ------------------------------------------------------------

CREATE TABLE `conceptos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',  
  `code` varchar(80) DEFAULT NULL COMMENT 'código del concepto',
  `nombre` varchar(140) DEFAULT NULL COMMENT 'nombre del concepto',
  `description` longtext COMMENT 'descripción del concepto',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra conceptos para la importación por excel';



# Volcado de tabla configuraciones
# ------------------------------------------------------------

CREATE TABLE `configuraciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `variable` varchar(80) DEFAULT NULL COMMENT 'variable',
  `valor` varchar(80) DEFAULT NULL COMMENT 'valor',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las configuraciones';



# Volcado de tabla configuraciones_root
# ------------------------------------------------------------

CREATE TABLE `configuraciones_root` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `variable` varchar(80) DEFAULT NULL COMMENT 'variable',
  `valor` varchar(80) DEFAULT NULL COMMENT 'valor',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las configuraciones de usuario root';



# Volcado de tabla contadores
# ------------------------------------------------------------

CREATE TABLE `contadores` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `usuarios_acceso_nombre` varchar(80) DEFAULT NULL  COMMENT 'usuario de acceso',
  `usuarios_acceso_password` varchar(80) DEFAULT NULL COMMENT 'clave de acceso',
  `usuarios_acceso_id_permisos` varchar(80) DEFAULT NULL COMMENT 'id de la tabla usuarios_permisos',
  `id_sesion` int(10) DEFAULT NULL COMMENT 'id de sesion',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_acceso_nombre` (`usuarios_acceso_nombre`),
  UNIQUE KEY `id_sesion` (`id_sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los usuarios contadores';



# Volcado de tabla documents
# ------------------------------------------------------------

CREATE TABLE `documents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `classifier_a` varchar(80) DEFAULT NULL COMMENT 'ficha de cancelación',
  `classifier_b` varchar(80) DEFAULT NULL COMMENT 'resolución',
  `document_entry_date` datetime DEFAULT NULL COMMENT 'fecha de recepción',
  `event_date` datetime DEFAULT NULL COMMENT 'fecha del evento',
  `code` varchar(80) DEFAULT NULL COMMENT 'código del documento',
  `created_by` varchar(80) DEFAULT NULL COMMENT 'registrado por',
  `can_edit` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `can_create_assignation` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `can_create_attachment` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `can_delete_attachment` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `can_delete` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `document_type_id` varchar(80) DEFAULT NULL COMMENT 'tipo de requerimiento',
  `document_type_has_assigments` tinyint(1) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `document_type_value_id` varchar(80) DEFAULT NULL COMMENT 'tipo de documento',
  `on_start_state` varchar(80) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `on_end_state` varchar(80) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `state_id` int(10) DEFAULT NULL COMMENT 'estado del documento',
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`),
  KEY `state_id` (`state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los documentos de un agremiado';



# Volcado de tabla geo_departamentos
# ------------------------------------------------------------

CREATE TABLE `geo_departamentos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'departamento',
  `geo` varchar(80) DEFAULT NULL COMMENT 'codigo geo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los departamentos del sistema';



# Volcado de tabla geo_distritos
# ------------------------------------------------------------

CREATE TABLE `geo_distritos` (
  `id_provincia` int(10) DEFAULT NULL COMMENT 'id de provincia / tabla geo_provincias',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'distrito',
  `geo` varchar(80) DEFAULT NULL COMMENT 'codigo geo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los distritos del sistema';



# Volcado de tabla geo_provincias
# ------------------------------------------------------------

CREATE TABLE `geo_provincias` (
  `id_departamento` int(10) DEFAULT NULL COMMENT 'id de departamento / tabla geo_departamentos',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'provincia',
  `geo` varchar(80) DEFAULT NULL COMMENT 'codigo geo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las provincias del sistema';



# Volcado de tabla locations
# ------------------------------------------------------------

CREATE TABLE `locations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(140) DEFAULT NULL COMMENT 'nombre de ente',
  `code` varchar(80) DEFAULT NULL COMMENT 'código de ente',
  `description` longtext COMMENT 'descripción',
  `id_zone` int(10) DEFAULT NULL COMMENT 'id de red asistencial / tabla zones',
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  PRIMARY KEY (`id`),
  KEY `id_zone` (`id_zone`),
  KEY `id_settlement` (`id_settlement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los entes de los agremiados';




# Volcado de tabla operations
# ------------------------------------------------------------

CREATE TABLE `operations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `total_amount` decimal(10,4) DEFAULT NULL COMMENT 'monto total',
  `share_type` varchar(80) DEFAULT NULL COMMENT 'tipo de aporte',
  `total_shares` int(10) DEFAULT NULL COMMENT 'número total de aportes',
  `monthly_amount_label` decimal(10,4) DEFAULT NULL,
  `submitted_at_label` datetime DEFAULT NULL,
  `deposit_at_label` datetime DEFAULT NULL,
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las operaciones de los agremiados';



# Volcado de tabla payments
# ------------------------------------------------------------

CREATE TABLE `payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `type` varchar(80) DEFAULT NULL COMMENT 'tipo de pago',
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `registered_by` varchar(80) DEFAULT NULL COMMENT 'registrado por',
  `operation_id` varchar(80) DEFAULT NULL COMMENT 'id de operación / tabla operations',
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `voucher` varchar(80) DEFAULT NULL COMMENT 'número de voucher del deposito bancario',
  `comment` longtext COMMENT 'comentario',
  `amount` decimal(10,4) DEFAULT NULL COMMENT 'monto',
  `can_view_aporation_amount` tinyint(1) DEFAULT NULL,
  `concept` varchar(80) DEFAULT NULL COMMENT 'concepto',
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT NULL COMMENT 'esta revisado?',
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`),
  KEY `id_settlement` (`id_settlement`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los `otros pagos` de los agremiados';



# Volcado de tabla people
# ------------------------------------------------------------

CREATE TABLE `people` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `code` int(10) DEFAULT NULL COMMENT 'códido de agremiado',
  `id_location` int(10) DEFAULT NULL COMMENT 'id de entes / tabla locations',
  `is_member` tinyint(1) DEFAULT NULL COMMENT 'estado de agremiado',
  `id_group` varchar(3) DEFAULT NULL COMMENT 'régimen laboral',
  `other_organization1` tinyint(1) DEFAULT NULL COMMENT '¿Afiliado a FEDCUT?',
  `other_organization2` tinyint(1) DEFAULT NULL COMMENT '¿Afiliado a FAMENSALUD?',
  `other_organization3` tinyint(1) DEFAULT NULL COMMENT '¿Afiliado a CUT?',
  `other_organization4` tinyint(1) DEFAULT NULL COMMENT '¿Afiliado a otros sindicatos?',
  `document_number` varchar(80) DEFAULT NULL COMMENT 'DNI',
  `s_activity_1` varchar(80) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `s_activity_2` varchar(80) DEFAULT NULL COMMENT '(campo heredado del antiguo sistema / no se usa)',
  `speciality` varchar(80) DEFAULT NULL COMMENT 'Especialidad',
  `publications` longtext COMMENT 'Publicaciones',
  `apellidos` varchar(80) DEFAULT NULL COMMENT 'apellido del agremiado',
  `phone` varchar(80) DEFAULT NULL COMMENT 'teléfono',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre del agremiado',
  `birthday` datetime DEFAULT NULL COMMENT 'fecha de nacimiento',
  `is_caee` tinyint(1) DEFAULT NULL COMMENT 'está afiliado a CAEE o No',
  `last_primary` datetime DEFAULT NULL COMMENT 'fecha del último aporte regular',
  `last_secondary` datetime DEFAULT NULL COMMENT 'fecha del último aporte CAEE',
  `id_personalink` int(10) DEFAULT NULL,
  `codeold` int(10) DEFAULT NULL,
  `rango_edad` varchar(80) DEFAULT NULL COMMENT 'rango de edad',
  `edad` varchar(80) DEFAULT NULL COMMENT 'edad',
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `id_location` (`id_location`),
  KEY `is_member` (`is_member`),
  KEY `is_caee` (`is_caee`),
  KEY `last_primary` (`last_primary`),
  KEY `last_secondary` (`last_secondary`) USING BTREE,
  KEY `id_group` (`id_group`) USING BTREE,
  KEY `birthday` (`birthday`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra a las personas agremiadas';



# Volcado de tabla people_evo
# ------------------------------------------------------------

CREATE TABLE `people_evo` (
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `is_caee` tinyint(1) DEFAULT NULL COMMENT 'esta afiliado a caee?',
  `id_group` varchar(3) DEFAULT NULL COMMENT 'regimen laboral',
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `total` int(10) DEFAULT NULL COMMENT 'total',
  `amount` decimal(10,4) DEFAULT NULL COMMENT 'monto',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  PRIMARY KEY (`id`),
  KEY `id_settlement` (`id_settlement`),
  KEY `is_caee` (`is_caee`),
  KEY `id_group` (`id_group`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra la evolucion de las personas';



# Volcado de tabla people_evolution
# ------------------------------------------------------------

CREATE TABLE `people_evolution` (
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `is_caee` varchar(80) DEFAULT NULL COMMENT 'esta afiliado a caee?',
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `total` int(10) DEFAULT NULL COMMENT 'total',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  PRIMARY KEY (`id`),
  KEY `id_settlement` (`id_settlement`),
  KEY `is_caee` (`is_caee`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra de a evolución de las personas';



# Volcado de tabla people_evolution_general
# ------------------------------------------------------------

CREATE TABLE `people_evolution_general` (
  `is_caee` varchar(80) DEFAULT NULL COMMENT 'esta afiliado a caee?',
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `total` int(10) DEFAULT NULL COMMENT 'total',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  PRIMARY KEY (`id`),
  KEY `is_caee` (`is_caee`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra ';



# Volcado de tabla people_evolution_group
# ------------------------------------------------------------

CREATE TABLE `people_evolution_group` (
  `id_group` varchar(80) DEFAULT NULL COMMENT 'regimen laboral',
  `is_caee` varchar(80) DEFAULT NULL COMMENT 'esta afiliado a caee?',
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `total` int(10) DEFAULT NULL COMMENT 'total',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  PRIMARY KEY (`id`),
  KEY `id_group` (`id_group`),
  KEY `is_caee` (`is_caee`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra ';



# Volcado de tabla peopleold
# ------------------------------------------------------------

CREATE TABLE `peopleold` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `code` int(10) DEFAULT NULL,
  `id_location` int(10) DEFAULT NULL,
  `is_member` tinyint(1) DEFAULT NULL,
  `id_group` varchar(80) DEFAULT NULL,
  `other_organization1` tinyint(1) DEFAULT NULL,
  `other_organization2` tinyint(1) DEFAULT NULL,
  `other_organization3` tinyint(1) DEFAULT NULL,
  `other_organization4` tinyint(1) DEFAULT NULL,
  `document_number` varchar(80) DEFAULT NULL,
  `s_activity_1` varchar(80) DEFAULT NULL,
  `s_activity_2` varchar(80) DEFAULT NULL,
  `speciality` varchar(80) DEFAULT NULL,
  `publications` longtext,
  `apellidos` varchar(80) DEFAULT NULL,
  `phone` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `birthday` datetime DEFAULT NULL,
  `is_caee` tinyint(1) DEFAULT NULL,
  `last_primary` datetime DEFAULT NULL,
  `last_secondary` datetime DEFAULT NULL,
  `codeold` int(10) DEFAULT NULL,
  `id_personalink` int(10) DEFAULT NULL,
  `edad` int(10) DEFAULT NULL,
  `rango_edad` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `id_location` (`id_location`),
  KEY `is_member` (`is_member`),
  KEY `is_caee` (`is_caee`),
  KEY `last_primary` (`last_primary`),
  KEY `last_secondary` (`last_secondary`) USING BTREE,
  KEY `id_group` (`id_group`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra ';



# Volcado de tabla primaryshares
# ------------------------------------------------------------

CREATE TABLE `primaryshares` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `type` varchar(80) DEFAULT NULL,
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `registered_by` varchar(80) DEFAULT NULL COMMENT 'registrado por',
  `operation_id` varchar(80) DEFAULT NULL COMMENT 'id de operación / tabla operations',
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `voucher` varchar(80) DEFAULT NULL COMMENT 'número de voucher del deposito bancario',
  `comment` longtext COMMENT 'comentario',
  `amount` decimal(10,4) DEFAULT NULL COMMENT 'monto',
  `can_view_aporation_amount` tinyint(1) DEFAULT NULL,
  `concept` varchar(80) DEFAULT NULL COMMENT 'concepto',
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  `id_group` varchar(3) DEFAULT NULL COMMENT 'regimen laboral',
  `revisado` tinyint(1) DEFAULT NULL COMMENT 'esta revisado?',
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`),
  KEY `month` (`month`),
  KEY `id_settlement` (`id_settlement`),
  KEY `type` (`type`),
  KEY `id_group` (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los aportes regulares de los agremiados';



# Volcado de tabla product_managers
# ------------------------------------------------------------

CREATE TABLE `product_managers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre del product manager',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `usuarios_acceso_nombre` varchar(80) DEFAULT NULL  COMMENT 'usuario de acceso',
  `usuarios_acceso_password` varchar(80) DEFAULT NULL COMMENT 'clave de acceso',
  `usuarios_acceso_id_permisos` varchar(80) DEFAULT NULL COMMENT 'id de la tabla usuarios_permisos',
  `id_sesion` int(10) DEFAULT NULL COMMENT 'id de sesion',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_acceso_nombre` (`usuarios_acceso_nombre`),
  UNIQUE KEY `id_sesion` (`id_sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los usuarios Product Managers';



# Volcado de tabla records
# ------------------------------------------------------------

CREATE TABLE `records` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `description` longtext COMMENT 'descripción',
  `type` varchar(80) DEFAULT NULL COMMENT 'tipo de registro histórico ',
  `label` varchar(80) DEFAULT NULL,
  `state` varchar(80) DEFAULT NULL COMMENT 'estado : closed, active',
  `state_label` varchar(80) DEFAULT NULL,
  `start_location_label` varchar(80) DEFAULT NULL COMMENT 'en trasaldo, ente inicial',
  `end_location_label` varchar(80) DEFAULT NULL COMMENT 'en traslado, ente final',
  `changed_settlement` varchar(80) DEFAULT NULL,
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  `start_location` int(10) DEFAULT NULL COMMENT 'en trasaldo, id de ente inicial',
  `end_location` int(10) DEFAULT NULL COMMENT 'en trasaldo, id de ente final',
  `registered_by` varchar(80) DEFAULT NULL COMMENT 'registrado por',
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los registros históricos de los agremiados';



# Volcado de tabla secondaryshares
# ------------------------------------------------------------

CREATE TABLE `secondaryshares` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `rowid` int(10) DEFAULT NULL,
  `type` varchar(80) DEFAULT NULL,
  `month` datetime DEFAULT NULL COMMENT 'mes',
  `registered_by` varchar(80) DEFAULT NULL COMMENT 'registrado por',
  `operation_id` varchar(80) DEFAULT NULL COMMENT 'id de operación / tabla operations',
  `id_persona` int(10) DEFAULT NULL COMMENT 'id de agremiado / tabla people',
  `voucher` varchar(80) DEFAULT NULL COMMENT 'número de voucher del deposito bancario',
  `comment` longtext COMMENT 'comentario',
  `amount` decimal(10,4) DEFAULT NULL COMMENT 'monto',
  `can_view_aporation_amount` tinyint(1) DEFAULT NULL,
  `concept` varchar(80) DEFAULT NULL COMMENT 'concepto',
  `id_personaold` int(10) DEFAULT NULL,
  `new_imported` tinyint(1) DEFAULT NULL,
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `settlement_label` varchar(80) DEFAULT NULL,
  `id_group` varchar(3) DEFAULT NULL COMMENT 'regimen laboral',
  `revisado` tinyint(1) DEFAULT NULL COMMENT 'esta revisado?',
  PRIMARY KEY (`id`),
  KEY `person_id` (`id_persona`),
  KEY `month` (`month`),
  KEY `id_settlement` (`id_settlement`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los aportes CAEE';



# Volcado de tabla settlement_managment_group
# ------------------------------------------------------------

CREATE TABLE `settlement_managment_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  `beggin_on` datetime DEFAULT NULL COMMENT 'fecha de inicio',
  `end_on` datetime DEFAULT NULL COMMENT 'fecha de fin',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `phone` longtext COMMENT 'teléfono',
  `description` longtext COMMENT 'descripción',
  `expired` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_settlement` (`id_settlement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra miembro de junta de base';



# Volcado de tabla settlements
# ------------------------------------------------------------

CREATE TABLE `settlements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(140) DEFAULT NULL COMMENT 'nombre de la base',
  `code` varchar(80) DEFAULT NULL COMMENT 'código de la base',
  `description` longtext COMMENT 'descripción',
  `is_closed` tinyint(1) DEFAULT NULL COMMENT 'si está cerrada la base',
  `id_zone` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `is_closed` (`is_closed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las Bases de los asignados';



# Volcado de tabla superadmin
# ------------------------------------------------------------

CREATE TABLE `superadmin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `usuarios_acceso_nombre` varchar(80) DEFAULT NULL  COMMENT 'usuario de acceso',
  `usuarios_acceso_password` varchar(80) DEFAULT NULL COMMENT 'clave de acceso',
  `usuarios_acceso_id_permisos` varchar(80) DEFAULT NULL COMMENT 'id de la tabla usuarios_permisos',
  `id_sesion` int(10) DEFAULT NULL COMMENT 'id de sesion',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_acceso_nombre` (`usuarios_acceso_nombre`),
  UNIQUE KEY `id_sesion` (`id_sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los usuarios superadministradores';



# Volcado de tabla usuarios_acceso
# ------------------------------------------------------------

CREATE TABLE `usuarios_acceso` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre de acceso',
  `password` varchar(80) DEFAULT NULL COMMENT 'clave de acceso',
  `nombre_completo` varchar(80) DEFAULT NULL COMMENT 'nombre completo',
  `id_permisos` int(10) DEFAULT NULL COMMENT "id de permisos / tabla usuarios_permisos",
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los datos de usuario para accesos';



# Volcado de tabla usuarios_base
# ------------------------------------------------------------

CREATE TABLE `usuarios_base` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `email` varchar(80) DEFAULT NULL COMMENT 'email',
  `usuarios_acceso_nombre` varchar(80) DEFAULT NULL  COMMENT 'usuario de acceso',
  `usuarios_acceso_password` varchar(80) DEFAULT NULL COMMENT 'clave de acceso',
  `usuarios_acceso_id_permisos` varchar(80) DEFAULT NULL COMMENT 'id de la tabla usuarios_permisos',
  `id_sesion` int(10) DEFAULT NULL COMMENT 'id de sesion',
  `id_settlement` int(10) DEFAULT NULL COMMENT 'id de base / tabla settlements',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_acceso_nombre` (`usuarios_acceso_nombre`),
  UNIQUE KEY `id_sesion` (`id_sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los usuarios de cada base';



# Volcado de tabla usuarios_permisos
# ------------------------------------------------------------

CREATE TABLE `usuarios_permisos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'usuario de acceso',
  `texto` longtext COMMENT 'string de los permisos',
  `multiusuario` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra los tipos de usuario y los permisos';



# Volcado de tabla variables
# ------------------------------------------------------------

CREATE TABLE `variables` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `variable` varchar(80) DEFAULT NULL COMMENT 'variable',
  `valor` varchar(80) DEFAULT NULL COMMENT 'valor',
  `web` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra variables del sistema';



# Volcado de tabla web_config
# ------------------------------------------------------------

CREATE TABLE `web_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `nombre` varchar(80) DEFAULT NULL COMMENT 'nombre',
  `proyecto` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las configuraciones web del sistema';



# Volcado de tabla zones
# ------------------------------------------------------------

CREATE TABLE `zones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL COMMENT 'Fecha de creación',
  `fecha_edicion` datetime DEFAULT NULL COMMENT 'Fecha de la última edición',
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'bit de visibilidad',
  `nombre` varchar(140) DEFAULT NULL COMMENT 'nombre de la red asistencial',
  `code` varchar(80) DEFAULT NULL COMMENT 'código de la red asistencial',
  `description` longtext COMMENT 'descripción de la red asistencial',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT 'Tabla que registra las Redes Asistenciales de los agremiados';




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
