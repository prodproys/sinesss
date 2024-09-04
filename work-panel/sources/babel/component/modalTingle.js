import * as lib from '../libs';

const vendor='modalTingle';

// foopicker
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/tingle.min.css`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/tingle.min.js`);

window.addEventListener("load",function(){

	var calendar_from = new SalsaCalendar({
		inputId: 'checkin',
		lang: 'en',
		range: {
		  min: 'today'
		},
		calendarPosition: 'top',
		fixed: false,
		connectCalendar: true
    });

});