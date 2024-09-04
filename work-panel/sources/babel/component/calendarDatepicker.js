import * as lib from '../libs';

const vendor='calendarDatepicker';

// docs
// file:///Users/mac/Downloads/thedatepicker-master/index.html

// loaders
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/the-datepicker.css?1`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/the-datepicker.js?1`);


window.addEventListener("load",function(){


    lib.loadScript(`
    function load_calendar(id,min,max){
    
        var picker = new TheDatepicker.Datepicker(document.getElementById(id));
        picker.options.setInputFormat('Y-m-d');
        picker.render();

        eval('Fields.'+id+'=picker;');

    }
    `);
        
	console.log(vendor);

});
