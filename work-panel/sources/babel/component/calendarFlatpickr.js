import * as lib from '../libs';

const vendor='calendarFlatpickr';

// docs
// https://unpkg.com/flatpickr@1.6.5/index.html


// loaders
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/flatpickr.min.css`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/flatpickr.js`);


window.addEventListener("load",function(){

    flatpickr.init.prototype.l10n.weekdays.longhand  = ['domingo', 'lunes', 'mater', 'miércoles', 'jueves', 'viernes', 'sábado'];
    flatpickr.init.prototype.l10n.weekdays.shorthand = ['dom', 'lun', 'mar', 'mie', 'jue', 'vie', 'sab'];
    flatpickr.init.prototype.l10n.months.longhand    = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    flatpickr.init.prototype.l10n.firstDayOfWeek	 = 1;

    lib.loadScript(`
    function load_calendar(id,min,max){
    
        picker = flatpickr('#'+id,{
            // inline:true,
            mindate:min+'-01-01',
            maxdate:max+'-01-01',
            dateFormat: 'Y-m-d'
        });

        eval('Fields.'+id+'=picker;');

    }
    `);
        
	console.log(vendor);

});
