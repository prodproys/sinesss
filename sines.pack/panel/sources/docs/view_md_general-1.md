

# Informe General

## 1. Datos

El **Sistema Desarrolladao** está basado en la información recuperada del **Sistema Previo**.

### Web Scraping : Extracción de Data

Toda esta información ha sido reconstruída del sistema previo, a través de una estrategia de web scraping, analizando y procesando:

- Páginas html
- Descargas de reportes CSV
- Peticiones json masivas, programadas

Con lo cual se ha obtenido toda la información que desde la web se podía obtener. Está información ha ingresada a una base de datos relacionadas SQL.

Esta información ha sido verificada y comparada con la actual, con la cual reconstruimos lo siguientes módulos

- Personas
    - Aportaciones Regulares
    - Aportaciones CAEE
    - Otros Pagos
    - Documentos
    - Historial
    - Operaciones
- Entes
- Bases
- Redes Asistenciales

## 2. Usabilidad

Se programó el sistema usando considerando lo siguiente:

- Tratamos de mantener el mismo orden de los campos del sistema previo
- Tratamos de mantener el mismo nombre de los campos del sistema previo
- Tratamos de mantener la misma navegación del sistema previo, pero mejorándola.
- Todos los listados de los módulos, tienen la opción de ver en modo fila y en modo resúmen
- Todos los listados de los módulos, tienen los filtros del sistema previo, pero ampliando las opciones y ampliando los filtros.
- Todos los listados de los módulos tienen la opción de Exportar Excel
- En cada caso la exportación del Excel es instantánea, la descarga es inmediata, pero podría demorar en el caso de archivos muy grandes, pero en el peor de los caos no demora mas de 10 segundos.
- Con respecto a las gráficas se han mantenido las mismas librerías gráficas
- Sistema funciona perfecto en móviles
- Sistema puede alternar, de modo oscuro a modo claro.




## 3. Unificación de personas repetidas

Se encontraron en el sistema 323 casos de personas duplicadas, es decir que hasta cierta fecha tenían un código y luego se ingresó al sistema a la misma persona con otro código. ambos registros tenían: 
aportaciones regulares, aportaciones caee, otras aportaciones, historial, operaciones, documentos

[Informe de casos Repetidos](pages.php?page=informe)

Se realizó un programa para fusionar estos 2 registros en uno solo. 
- Se elimina un registro, se conserva el que tiene los datos mas recientes. 
- Se movieron todas las aportaciones y otros datos, del código que se va a eliminar hacia el código que se va a conservar.
- Se respaldo respaldó toda la información del código eliminado en un tabla. De este modo el procesos podría ser reversible si se desea.


## 4. Actualización de aportaciones

[Formulario para Importar Aportaciones desde un archivo](pages.php?page=import)
1. Seleccionar archivo
    > Archivo con extensión TXT o XLSX
2. Seleccionar Año y Mes
    > Es muy importante seleccionar correctamente el año y el mes, porque es precisamente donde el programa ingresará los montos.

    > El sistema sólo ingresa los montos a un código de persona, cuando no encuentra un registro previo. Si se ingresa el archivo por segunda vez al mismo mes y año el sistema no vuelve a hacer esos ingresos.
    


El programa detecta el tipo de archivo y ejecuta el procesos respectivo.

* En el caso de los TXT, encontramos ingresos para 2 tipos de aportes, CAEE y Regulares, se procede a actualizar de acuerdo al código de persona.

* En el caso de los XLS, no encontramos ningún dato que identifique el tipo de aporte, por lo tanto lo ingresamos en las aportaciones regulares de acuerdo al código.

En este proceso se reconocimiento de la persona, se consideró el código repetido, del caso de duplicidad de usuarios.

En ambos casos, puede ocurrir que el sistema no reconozca el código del archivo. Ese informe de códigos no reconocidos se presenta al final del proceso.

El programa al final muestra el reporte de aportaciones actualizadas.



## 5. Reportes Especiales

Los reportes de las evoluciones son un caso especial
Estos muestran los totales, agrupados por mes, por año, por tipo de aportante, por base, por tipo de regimen.

Saber cuantos aportantes CAEE había en enero de 2016, no es una data que pudiéramos obtener de la base datos que ya teníamos.

Pensamos una estrategia de obtener estos totales, usando los históricos de todos las personas, pero luego de intentarlo los números no coincidían con los reportes.

Así que usamos los reportes de evoluciones para reconstruir las siguientes tablas.

- personas_evolucion_por_base
- personas_evolucion_por_regimen
- personas_evolusion_general

para continuar con estos reportes por evolución, se actualizarán esos totales el 1er dia de cada mes.

## 6. Tecnologías

- Backend en : php 7.3.19 y mysql 5.0.12
- Charts : highchartsjs
- Iconos : fontawesome
- Preprocesadores: jade, stylus, babel
- Javascript empacado en : webpack


