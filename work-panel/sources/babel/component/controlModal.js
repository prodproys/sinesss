import * as lib from '../libs';

const vendor='controlModal';

// loaders
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/controlModal.css?4`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/controlModal.js?2`);


window.addEventListener("load",function(){

    lib.loadScript(`
        new ControlModal({
            container:document.querySelector("#inner_after")
        })
    `);
	console.log(vendor);

});
