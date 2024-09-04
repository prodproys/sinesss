import * as system from "./system";
import * as lib from "./libs";
import * as custom from "../../../sines/panel/sources/babel/custom";

import "./component/calendarTail";
import * as control from "./controlModal"

// import * as controlSh from "./controlModalShares"
// import defaultExport from "./controlModalShares"
// import from "./controlModalShares"
// import './component/calendarFlatpickr';
// import './component/calendarPikaday';
// import './component/calendarSalsa';
// import './component/calendarDatepicker';
// import './component/selectorSlim';
// import './component/modalTingle';
function loadModals() {

  new control.ControlPage({
    containers:document.querySelectorAll(".modal-page")
  })

  new control.ControlModal({
    containers:document.querySelectorAll(".modal-link")
  })
  
  new control.ControlModalShares({
    containers:document.querySelectorAll(".modal-share-link")
  })

  new control.ControlModalMassive({
    containers:document.querySelectorAll(".modal-share-massive")
  })

  new control.ControlModalNewDocument({
    containers:document.querySelectorAll(".modal-new-document-link")
  })

  // console.log('loadingModals...');

}


global.loadModals=loadModals;

// window.adal='camote';



window.addEventListener("load", function () {

  lib.loadScript(`
    var Fields={};
    `);

  let $nav_links = document.querySelectorAll(".menu_detail .nav-link");
  $nav_links.forEach((item) => {
    item.addEventListener("click", function (el) {
      $nav_links.forEach((ite) => {
        ite.classList.remove("active");
      });
      item.classList.add("active");
    });
  }, false);
  

  loadModals();

  // exports.adal = 'visual';


  // let conAuto =new control.ControlAutocomplete({
  //   container:document.querySelector("#main-search")
  // })  
  
  let memberA=['<span class="member_0">no agremiado</span>','<span class="member_1">agremiado</span>'];
  
  let caeeA=['<span class="caee_0">no caee</span>','<span class="caee_1">caee</span>'];

  new Meio.Autocomplete.Select(
    document.querySelector("#main-search_dl"),
    "load_json.php?s=id,code;nombre;apellidos;document_number;is_member;is_caee|people|",
    {
      minChars: 3,
      selectOnTab: true,
      maxVisibleItems: 20,
      requestOptions: { method: "get" },
      valueField: document.querySelector("#main-search"),
      valueFilter : function (data) {
        location.href='custom/people.php?i='+data.i
      },
      syncName: false,
      filter: { 
        /*
        type: "contains", 
        path: "v" ,
        */
        filter: function(text, data) {
          return true;
        },
        
        formatMatch: function(text, data) {
          return text;
        },
        formatItem: function(text, data, i) {

          let texA=data.v.split(' ');
          let texAL=texA.length;
          let codeS=texA[0];
          let memberS=memberA[texA[texAL-2]];
          let caeeS=caeeA[texA[texAL-1]];
          texA.pop();
          texA.pop();

          let newText= texA.join(' ');

          newText=newText.replace(codeS,`<span class="code_">código:${codeS}</span>`);

          newText= newText.replace(new RegExp('(' + text.escapeRegExp() + ')', 'gi'), '<strong>$1</strong>') ;          
          

          return newText + ' ' + memberS + ' ' + caeeS;
          // return text ? self._getValueFromKeys(data, keys).replace(new RegExp('(' + text.escapeRegExp() + ')', 'gi'), '<strong>$1</strong>') : self._getValueFromKeys(data, keys);
        }
        
      },
      /*
      requestOptions: { 
        formatResponse: function(jsonResponse){ 
            console.log(jsonResponse);
            return jsonResponse; 
        } 
      }
      */
    }
  );




//   lib.loadScript(`
//   new ControlModal({
//       container:document.querySelector("#inner_after")
//   })
// `);

  // custom.mensajDePrueba('que bacan');
});

// export const loadPageByURLButtom = system.loadPageByURLButtom;
