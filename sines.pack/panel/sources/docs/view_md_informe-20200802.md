# INFORME DE CIERRE - Proyecto SINESS

## Sistema de gestión de agremiados
- Programación mismas características, funcionalidades y procesos del sistema previo.
- Migración de los modelos de datos del sistema previo.

## Nuevas características del sistema
- Importador de aportaciones por TXT y por XLSX
- Corrección - Unificación de personas repetidas en el sistema
- Reporte de Deducciones, impresión y exportar excel
- Editar aportaciones
- Opción de Impresión en todos los listados y reportes
- Módulo para crear Usuarios para que pueda visualizar determinada base


## Deducciones
> Considerar Régimen Laboral en los Reportes de Deducciones

- Inicialmente se extrajeron más de 990 mil aportaciones regulares y CAEE del anterior sistema, en los cuales no encontramos la variable Régimen Laboral de cada Aportación, por lo cual no se consideró este campo en las deducciones.
- En la primera versión del IMPORTADOR DE EXCEL también obviamos el régimen laboral.
- Al detectar esta falta se hizo el proceso de REPROCESAR los archivo importados para actualizar las aportaciones con el régimen ahora sí correctamente.
- Actualmente estamos considerando el campo régimen en el proceso de importación de excel, la pestaña lo indica : si es cas, o si es 276 y 728 corresponde "Contratados/Nombrados".
- Actualmente estamos considerando el campo régimen en el proceso de Registro Manual de aportaciones Regulares y CAEE. En estod casos, el régimen de la aportación lo determina el régimen de la PERSONA.
- Por estos motivos, en el Reporte de deducciones podemos visualizar las columnas de Régimen Laboral SÓLO EN LOS MESES A PARTIR DE MARZO, porque es desde esta fecha que se puede alimentar el sistema con las datos correctos.
- En los meses previos a MARZO y en el año 2020, se mostrará "sin datos" en estas columnas.

## Gráficas y Evoluciones
> Las gráficas y reporte de evoluciones no actualizaban correctamente, luego de los procesos de Importación y registro manual de aportaciones
- Inicialmente se desarrolló los procesos de Importación desde Excel, TXT, así como registro manual de aportaciones tanto Regulares como CAEE, pero se detectó que no estaba actualizando correctamente las tablas de evoluciones , la cual alimenta a los distintos reportes y gráficas.
- Actualmente se corrigió eso.

## Edición y Eliminación de Aportaciones
> En una primera versión del sistema se permitió la edición y eliminación de las aportaciones ( por un error ) ya que no se consideraban validaciones ni actualización de evoluciones, por ese motivo se retiró, además porque no era una propiedad del sistema anterior.

- A solicitud, se desarrollaron estos procesos con todas las consideraciones respectivas.
  
- La edición de Aportaciones desarrollada, tanto CAEE como Regulares, no considera LA EDICIÓN DE BASE, debido a que esto podría traer inconsistencias en el sistema : "La base de una aportación corresponde a la Base de la Persona en el momento de su registro".
- Al final de la Creación y Edición de una aportación CAEE, Regulares y Pagos aparecerá el botón VER OPERACIÓN, donde se puede viaulizar e imprimir la operación.
- La operación se encuentra disponible en la sección Operaciones de la ficha de la persona. Desde la cual se puede visualizar e imprimir.


## Gestión Documentaria
- En Gestión Documentario. Se desarrolló el buscador rápido, con los siguientes criterios: número de seguimiento, dni, nombre, apellido y código de persona.
- Al hacer click en el código de seguimiento y en el link de la persona envía diretamente a la sección Documentos en la ficha de la persona.
- En la sección Documentos en la ficha de una Persona se desarrollaron los formularios para crear y editar los registros de documentos.
- En la sección Documentos se puede Agregrar Asignaciónes en cada documento.
- Se descargaron todas las asignaciones del sistema previo. De este modo el sistema también esta actualizado en asginaciones.

