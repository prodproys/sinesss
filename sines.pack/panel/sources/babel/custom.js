// ---- 
// Archivo: custom.js
// Archivo Transpilado: work-panel/public/js/bundle.js
// Autor: Sinesss
// Tipo: Plantilla de Javascript
// Lenguaje: Javacript Ecmascript 6
// Descripción: Este archivo tiene contiene la programación de la lógica de campos y calendario en los FORMULARIOS flotantes
// ---- 
// 



import './highcharts';




window.addEventListener("load", () => {


    if(document.querySelector('body.page_import2')){
        
        let status=['unreconized','hubo_primary','hubo_secondary','habra_primary','habra_secondary'];

        let tabla_csv=document.querySelector('.tabla_csv');


        status.forEach( (item)=> {
            document.querySelector('.leyenda .'+item).addEventListener("click",  () => {

                status.forEach( ite => tabla_csv.classList.remove(ite) );
                tabla_csv.classList.add(item);

            });

            document.querySelector('#num_'+item).innerHTML=document.querySelectorAll('.tabla_csv tbody tr.'+item).length

        });

        document.querySelector('#num_todos').innerHTML=document.querySelectorAll('.tabla_csv tbody tr').length

        document.querySelector('.leyenda .todos').addEventListener("click",  () => {

            status.forEach( ite => tabla_csv.classList.remove(ite) );

        });

        document.querySelector('#button-import').addEventListener("click",  () => { 
            document.querySelector("#importform").submit(); 
        });

        document.querySelector("#cargando").style.display = "none";
        if( 
            ( document.querySelector('#num_habra_primary').innerHTML*1 + document.querySelector('#num_habra_secondary').innerHTML*1 ) > 0
            ){

            document.querySelector("#button-import").style.display = "inline-block";

        }


    }


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get('sub')=='documents' && urlParams.get('i')!=''){

        ax('paginaUrl','','1','DOCUMENTOS','inner_after','&id_persona='+urlParams.get('i'),'sub','3');
        
    }

    //? Fire click de la primera pestaña del menu de sub listados
    if (false) //! decrecated
        (() => {

            const $menuDetailSub = document.querySelectorAll('.menu_detail.nav-tabs .nav-item a');
            $menuDetailSub[0].click();

        })();


    //? En detail, convertir en click, en un fireflick, de manu de sub listas
    (() => {

        const $menuDetailRight = document.querySelectorAll('.detail .li_cabecera > li > a.control-menu-item');
        $menuDetailRight.forEach((element) => {


            element.setAttribute("href", "#");
            element.setAttribute("onclick", "javascript:return false;");


            element.addEventListener("click", function () {

                let $menuDetailSubLink = document.querySelectorAll('.menu_detail.nav-tabs .nav-link.link-' + element.dataset.item);
                $menuDetailSubLink[0].click();

                $menuDetailSubLink[0].scrollIntoView({ behavior: 'smooth', block: 'start' });

            });


        });
        // console.log($menuDetailRight);
    })();


});

