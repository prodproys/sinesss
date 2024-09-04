import * as lib from '../libs';

const vendor='selectSlim';

// foopicker
lib.loadCss(`${lib.vendor_dir}/${vendor}/css/slimselect.min.css`);
lib.loadJs(`${lib.vendor_dir}/${vendor}/js/slimselect.min.js`);

window.addEventListener("load",function(){

    console.log('increible');
    new SlimSelect({
        select: '#slim-select'
    })

});