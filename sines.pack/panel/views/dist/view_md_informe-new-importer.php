<h1 id="importaror-de-aportaciones-versión-20">IMPORTAROR DE APORTACIONES VERSIÓN 2.0</h1>
<h2 id="importador-versión-1">Importador Versión 1</h2>
<ul>
<li>Se desarrolló un proceso de Importar Aportaciones desde 1 arhivo.</li>
<li>El programa acepta archivos TXT y XLSX y los procesa según los formatos que nos entregaron.</li>
<li>Todo se realiza en 1 único paso</li>
<li>El programa requiere cierta cantidad de memoria del servidor, por las múltiples consultas que realiza.</li>
<li>El uso de la memoria depende del número de filas sumadas en todas las pestañas del archivo. Por lo tanto si el archivo es muy grande, se produce el agotamiento de memoria y error en el proceso.</li>
<li>Se procedió a mejorar esta herramiento.</li>
</ul>
<h2 id="importador-versión-2-para-excel">Importador Versión 2, para excel</h2>
<ul>
<li>Se reprogramó el importador para evitr el problema agotamiento de la memoria, dividiento el proceso en varios pasos.</li>
<li>Paso 1 : Ingrear archivo, Ingresar año y mes, y click ENVIAR</li>
<li>El sistema inicia el proceso de reconocimiento de persona, y disponibilidad para ingresar la aportación:<ul>
<li>se reconoce a la persona por medio del código, y/o del nombre y apellido</li>
<li>se reconoce el régimen laboral, por medio de la pestaña del excel.</li>
<li>se reconoce tipo de aportación por la columna del código de nómina, si es caee (8403) o regular (8393).</li>
<li>se verifica si es que ya hay una aportación ingresada de ese tipo para ese mes para esta persona. si no la hay el sistema se prepara para ingresar la aportación.</li>
</ul>
</li>
<li>El resultado del Paso 1 es el Excel dividido en Pestañas ( cada pestaña representa un régimen laboral ) y el listado de filas de cada pestaña como en el excel, pero coloreados según lo que reconozca el sistema. Todo esto se entiende mejors con la leyenda.</li>
<li>Prestar atención en los colores, para saber qué filas estan listas para ser ingresadas.</li>
<li>También prestar atención en la &quot;personas no reconocidas&quot;, verificar porqué motivo esta persona no se encuentra en el sistema. y ver la manera de solucionarlo modificando el nombre o el código en el archivo EXCEL y volviendo a realizar al Paso 1.</li>
<li>Si todo está conforme, se procede al PASO 2: IMPORTAR, </li>
<li>El botón IMPORTAR está presenta junto al nombre de la pestaña actual, siempre y cuando tengamos algo por IMPORTAR. Si no nay nada que importar, click en la siguiente pestaña, y probar si hay algo para IMPORTAR. Y así hasta terminar.</li>
</ul>
