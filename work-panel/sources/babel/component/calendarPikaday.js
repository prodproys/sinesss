import * as lib from '../libs';

const vendor='calendarPikaday';

// docs
// https://github.com/Pikaday/Pikaday

// loaders
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/pikaday.css`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/pikaday.js`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/moment.min.js`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/es.js`);

window.addEventListener("load",function(){

    lib.loadScript(`
    function load_calendar(id,min,max){
        
        picker = new Pikaday({ 
            field: document.getElementById(id),
            bound: true,
            reposition: true,
            firstDay: 1,
            yearRange: [min,max],
            i18n: {
                previousMonth : 'mes anterior',
                nextMonth     : 'siguiente mes',
                months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                weekdays      : ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                weekdaysShort : ['Dom','Lun','Mar','Mie','Jue','Vie','Sab']
            }
        });

        eval('Fields.'+id+'=picker;');
    
    }
    `);

        
	console.log(vendor);

});
