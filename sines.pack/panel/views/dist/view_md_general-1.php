<h1 id="informe-general">Informe General</h1>
<h2 id="1-datos">1. Datos</h2>
<p>El <strong>Sistema Desarrolladao</strong> está basado en la información recuperada del <strong>Sistema Previo</strong>.</p>
<h3 id="web-scraping--extracción-de-data">Web Scraping : Extracción de Data</h3>
<p>Toda esta información ha sido reconstruída del sistema previo, a través de una estrategia de web scraping, analizando y procesando:</p>
<ul>
<li>Páginas html</li>
<li>Descargas de reportes CSV</li>
<li>Peticiones json masivas, programadas</li>
</ul>
<p>Con lo cual se ha obtenido toda la información que desde la web se podía obtener. Está información ha ingresada a una base de datos relacionadas SQL.</p>
<p>Esta información ha sido verificada y comparada con la actual, con la cual reconstruimos lo siguientes módulos</p>
<ul>
<li>Personas<ul>
<li>Aportaciones Regulares</li>
<li>Aportaciones CAEE</li>
<li>Otros Pagos</li>
<li>Documentos</li>
<li>Historial</li>
<li>Operaciones</li>
</ul>
</li>
<li>Entes</li>
<li>Bases</li>
<li>Redes Asistenciales</li>
</ul>
<h2 id="2-usabilidad">2. Usabilidad</h2>
<p>Se programó el sistema usando considerando lo siguiente:</p>
<ul>
<li>Tratamos de mantener el mismo orden de los campos del sistema previo</li>
<li>Tratamos de mantener el mismo nombre de los campos del sistema previo</li>
<li>Tratamos de mantener la misma navegación del sistema previo, pero mejorándola.</li>
<li>Todos los listados de los módulos, tienen la opción de ver en modo fila y en modo resúmen</li>
<li>Todos los listados de los módulos, tienen los filtros del sistema previo, pero ampliando las opciones y ampliando los filtros.</li>
<li>Todos los listados de los módulos tienen la opción de Exportar Excel</li>
<li>En cada caso la exportación del Excel es instantánea, la descarga es inmediata, pero podría demorar en el caso de archivos muy grandes, pero en el peor de los caos no demora mas de 10 segundos.</li>
<li>Con respecto a las gráficas se han mantenido las mismas librerías gráficas</li>
<li>Sistema funciona perfecto en móviles</li>
<li>Sistema puede alternar, de modo oscuro a modo claro.</li>
</ul>
<h2 id="3-unificación-de-personas-repetidas">3. Unificación de personas repetidas</h2>
<p>Se encontraron en el sistema 323 casos de personas duplicadas, es decir que hasta cierta fecha tenían un código y luego se ingresó al sistema a la misma persona con otro código. ambos registros tenían: 
aportaciones regulares, aportaciones caee, otras aportaciones, historial, operaciones, documentos</p>
<p><a href="pages.php?page=informe">Informe de casos Repetidos</a></p>
<p>Se realizó un programa para fusionar estos 2 registros en uno solo. </p>
<ul>
<li>Se elimina un registro, se conserva el que tiene los datos mas recientes. </li>
<li>Se movieron todas las aportaciones y otros datos, del código que se va a eliminar hacia el código que se va a conservar.</li>
<li>Se respaldo respaldó toda la información del código eliminado en un tabla. De este modo el procesos podría ser reversible si se desea.</li>
</ul>
<h2 id="4-actualización-de-aportaciones">4. Actualización de aportaciones</h2>
<p><a href="pages.php?page=import">Formulario para Importar Aportaciones desde un archivo</a></p>
<ol>
<li><p>Seleccionar archivo</p>
<blockquote>
<p>Archivo con extensión TXT o XLSX</p>
</blockquote>
</li>
<li><p>Seleccionar Año y Mes</p>
<blockquote>
<p>Es muy importante seleccionar correctamente el año y el mes, porque es precisamente donde el programa ingresará los montos.</p>
</blockquote>
<blockquote>
<p>El sistema sólo ingresa los montos a un código de persona, cuando no encuentra un registro previo. Si se ingresa el archivo por segunda vez al mismo mes y año el sistema no vuelve a hacer esos ingresos.</p>
</blockquote>
</li>
</ol>
<p>El programa detecta el tipo de archivo y ejecuta el procesos respectivo.</p>
<ul>
<li><p>En el caso de los TXT, encontramos ingresos para 2 tipos de aportes, CAEE y Regulares, se procede a actualizar de acuerdo al código de persona.</p>
</li>
<li><p>En el caso de los XLS, no encontramos ningún dato que identifique el tipo de aporte, por lo tanto lo ingresamos en las aportaciones regulares de acuerdo al código.</p>
</li>
</ul>
<p>En este proceso se reconocimiento de la persona, se consideró el código repetido, del caso de duplicidad de usuarios.</p>
<p>En ambos casos, puede ocurrir que el sistema no reconozca el código del archivo. Ese informe de códigos no reconocidos se presenta al final del proceso.</p>
<p>El programa al final muestra el reporte de aportaciones actualizadas.</p>
<h2 id="5-reportes-especiales">5. Reportes Especiales</h2>
<p>Los reportes de las evoluciones son un caso especial
Estos muestran los totales, agrupados por mes, por año, por tipo de aportante, por base, por tipo de regimen.</p>
<p>Saber cuantos aportantes CAEE había en enero de 2016, no es una data que pudiéramos obtener de la base datos que ya teníamos.</p>
<p>Pensamos una estrategia de obtener estos totales, usando los históricos de todos las personas, pero luego de intentarlo los números no coincidían con los reportes.</p>
<p>Así que usamos los reportes de evoluciones para reconstruir las siguientes tablas.</p>
<ul>
<li>personas_evolucion_por_base</li>
<li>personas_evolucion_por_regimen</li>
<li>personas_evolusion_general</li>
</ul>
<p>para continuar con estos reportes por evolución, se actualizarán esos totales el 1er dia de cada mes.</p>
<h2 id="6-tecnologías">6. Tecnologías</h2>
<ul>
<li>Backend en : php 7.3.19 y mysql 5.0.12</li>
<li>Charts : highchartsjs</li>
<li>Iconos : fontawesome</li>
<li>Preprocesadores: jade, stylus, babel</li>
<li>Javascript empacado en : webpack</li>
</ul>
