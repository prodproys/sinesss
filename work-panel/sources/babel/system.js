

// carga archivos CSS
export const loadPageByURLButtom = (url, where) => {

    document.getElementById("refresh").style.display = "block";
    document.getElementById("refresh-cover").style.display = "block";

    new Request({
        url: url,
        method: 'get',
        onSuccess: function (ee) {

            document.getElementById(where).innerHTML = ee;
            document.getElementById("refresh").style.display = "none";
            document.getElementById("refresh-cover").style.display = "none";
        }
    }).send();

};

export const mensajDePrueba = (mensaje) => {

    alert(mensaje);

}