import * as lib from '../libs';

const vendor='calendarSalsa';

// docs
// https://www.cssscript.com/simple-standalone-js-date-picker-salsa-calendar/

lib.loadCss(`${lib.vendor_dir}/${vendor}/css/SalsaCalendar.min.css`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/SalsaCalendar.min.js`);

window.addEventListener("load",function(){


	lib.loadScript(`
		function load_calendar(id,min,max){

			var picker = new SalsaCalendar({
				// connectCalendar: true
				fixed: false,
				inputId: id,
				lang: 'en',
				range: {
				min: 'today'
				},
				calendarPosition: 'bottom'
			});

			eval('Fields.'+id+'=picker;');

		}
	`);


	console.log(vendor);

});
