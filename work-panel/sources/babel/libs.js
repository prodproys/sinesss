
// export const vendor_dir = 'js/babel/vendor';
export const vendor_dir = '../../work-panel/sources/babel/vendor';

// carga archivos CSS
export const loadCss = (urlcss) => {
    let newCSS = document.createElement("link");
    newCSS.type = "text/css";
    newCSS.rel = "stylesheet";
    newCSS.href = encodeURI(urlcss);
    document.getElementsByTagName("head")[0].appendChild(newCSS);
};

// carga archivos JS
export const loadJs = (urlJs) => {
    let newJs = document.createElement("script");
    newJs.type = "text/javascript";
    newJs.src = encodeURI(urlJs);
    document.getElementsByTagName("head")[0].appendChild(newJs);
};

// inserta script en el documento
export const loadScript = (script) => {

    // document.write('<script>'+script+'</script>');
    let scriptEle = document.createElement("script");
    scriptEle.innerHTML = script;
    document.body.appendChild(scriptEle);

}

