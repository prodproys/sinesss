
const days=['Do','Lu','Ma','Mi','Ju','Vi','Sá'];

const months=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];

class ControlCalendar {

  constructor(options){

    this.inputDate = options.container
    this.calendarDiv= this.inputDate.parentElement;
    let idv=this.inputDate.value
    if(idv!=''){
      this.date = new Date(idv.substr(0,4),idv.substr(5,2)-1,idv.substr(8,2)-1);
    } else {
      this.date = options.date || new Date();
    }
    this.container = null;
    this.calendarTable=null;
    this.onselect=options.onselect;
    this.buildTable();
    this.updateTable();
    this.bindEvents();
    
  }
  updateTable(){
    this.calculateDates();
    let firstDayInWeek=this.monthStart.getDay();
    let trs=this.calendarTable.querySelectorAll('tr');
    for(var i=0; i<5; i++){
      let tr=trs[i];
      let tds=tr.querySelectorAll('a');
      for(var j=0; j<7; j++){
        let td=tds[j];
        let day=(i*7)+j;
        if(day>=firstDayInWeek && day<this.monthLenth+firstDayInWeek){
          let day_number= day-firstDayInWeek + 1;
          td.innerHTML= day_number;
          // td.style.borderStyle='solid';
          td.dataset.day=day_number;
        } else {
          td.innerHTML='';
          // td.style.borderStyle='none';
          td.removeAttribute('date-day');
        }
      }
    }  
    this.container.querySelector('header').innerHTML=`${months[this.date.getMonth()]} - ${this.date.getFullYear()}`;
  }
  bindEvents(){
    
    this.buttons={};
    this.buttons.prev=document.createElement('a');
    this.buttons.next=document.createElement('a');
    this.buttons.prev.classList.add('calendar-control')
    this.buttons.next.classList.add('calendar-control')
    this.buttons.prev.innerHTML='Anterior';
    this.buttons.next.innerHTML='Siguiente';
    this.container.querySelector('.body').appendChild(this.buttons.prev);
    this.container.querySelector('.body').appendChild(this.buttons.next);

    this.buttons.prev.addEventListener('click',()=>this.prev());
    this.buttons.next.addEventListener('click',()=>this.next());

    
    document.body.addEventListener('mousedown',this.destroy,false);
    
    this.container.addEventListener('mousedown',(event)=>{
      event.stopPropagation();  
    });
    

  }
  calculateDates(){
    this.monthStart=new Date (this.date.getFullYear(),this.date.getMonth(),1)
    this.monthEnd=new Date (this.date.getFullYear(),this.date.getMonth()+1,1)
    this.monthLenth=Math.floor((this.monthEnd-this.monthStart) / (1000*60*60*24));
  }
  next(){
    let month=this.date.getMonth();
    if(month==11){
      this.date=new Date(this.date.getFullYear()+1,0,1);
    } else {
      this.date=new Date(this.date.getFullYear(),month+1,1);
    }
    this.updateTable();
  }
  prev(){
    let month=this.date.getMonth();
    if(month==0){
      this.date=new Date(this.date.getFullYear()-1,11,1);
    } else {
      this.date=new Date(this.date.getFullYear(),month-1,1);
    }
    this.updateTable();
  }
  destroy(){
    // console.log('destroy calendar');
    document.body.removeEventListener('click',this.destroy,false);
    document.querySelector('#modal-calendar').remove();

  }
  select(el){
    if(!el.dataset.day) return;
    let f = new Date(this.date.getFullYear(),this.date.getMonth(),el.dataset.day);
    let fm = ( f.getMonth() < 9) ? '0'+ ( f.getMonth() + 1 ) : ( f.getMonth() + 1 )
    let fd = ( f.getDate() < 10) ? '0'+ f.getDate() : f.getDate()
    let date =  f.getFullYear() + "-" + fm + "-" + fd
    this.onselect(date);
    this.destroy();
  }
  buildTable(){
    let table = document.createElement('table');
    let thead = document.createElement('thead');
    for(var i=0; i<7; i++){
      let td=document.createElement('td');
      td.innerHTML=days[i];
      thead.appendChild(td);
    }
    for(var i=0; i<5; i++){
      let tr=document.createElement('tr');
      for(var j=0; j<7; j++){
        let td=document.createElement('td');
        tr.appendChild(td);
        let aa=document.createElement('a');
        aa.addEventListener('click',()=>this.select(aa))
        td.appendChild(aa);

      }
      table.appendChild(tr)
    }    
    this.calendarTable=table; 
    table.appendChild(thead);

    this.container=document.createElement("div");
    this.container.setAttribute("id", "modal-calendar");
    this.calendarDiv.appendChild(this.container);   

    let body = document.createElement('div');
    body.classList.add('body');
    body.appendChild(table);
     
    // this.container.classList.add('custom-calendar');
    this.container.appendChild(document.createElement('header'));
    this.container.appendChild(body);

 

  }

}
export class ControlPage {

  constructor(options){

    this.containers = options.containers;
    // this.launchModal('modal.php?page=form_user_edit');
    // this.block=this.block.bind(this); // hack
    this.bindEvents();

  }

  bindEvents(){

    this.containers.forEach((ele)=>{
      
      if(ele.dataset.event!='true'){

        let url = ele.dataset.url;
        ele.dataset.event='true';
        ele.addEventListener('click',()=>this.launchModal(url));
        
      }

    });
    
  }

  async launchModal(url){

    if(document.querySelector("#modal-container")!=null){

      document.body.classList.remove('modeModal');
      document.querySelector('#modal-container').remove();

    }
    
    this.urlForm=url;
    document.body.classList.add('modeModal');

    let modalContainer=document.createElement("div");
    modalContainer.setAttribute("id", "modal-container");
    document.body.appendChild(modalContainer);    

    let backModal=document.createElement("div");
    backModal.classList.add('backModal');
    backModal.addEventListener('click',()=>this.destroyModal());
    modalContainer.appendChild(backModal);

    let divModal=document.createElement("div");
    divModal.classList.add('controModal');
    divModal.classList.add('modal');


    divModal.innerHTML=`<div id="new_refreshing"></div>`;

    modalContainer.appendChild(divModal);

    await fetch(this.urlForm)
      .then( response => response.text() )
      .then( response => {

        if(divModal)
        divModal.innerHTML=response;

        /*
        888888 Yb    dP 888888 88b 88 888888 .dP"Y8
        88__    Yb  dP  88__   88Yb88   88   `Ybo."
        88""     YbdP   88""   88 Y88   88   o.`Y8b
        888888    YP    888888 88  Y8   88   8bodP'
        */
        document.querySelector('.modal-header button.close')
          .addEventListener('click',()=>this.destroyModal());

        document.querySelector('.modal-footer button.btn-secondary')
          .addEventListener('click',()=>this.destroyModal());

      }) 

  }

  destroyModal(){

    /*
    if(
      document.querySelector("#modal-container").dataset.eval &&
      document.querySelector("#modal-container").dataset.eval!=''
      ){ 
      eval(document.querySelector("#modal-container").dataset.eval)
    }
    */
    document.body.classList.remove('modeModal');
    document.querySelector('#modal-container').remove();
    return; 
  
  }



}

export class ControlModal {

  constructor(options){

    this.containers = options.containers;
    // this.launchModal('modal.php?page=form_user_edit');
    // this.block=this.block.bind(this); // hack
    this.bindEvents();
    this.urlForm;
    this.buttonSubmit;
    this.dataArray=[];

  }

  bindEvents(){

    this.containers.forEach((ele)=>{
      
      if(ele.dataset.event!='true'){

        let url = ele.dataset.url;
        ele.dataset.event='true';
        ele.addEventListener('click',()=>this.launchModal(url));
        
      }

    });
    
  }

  block(){

    document.querySelectorAll('form.modalForm .form-control').forEach((ele)=>{
      
      ele.setAttribute('disabled','disabled');

    })
    this.buttonSubmit.dataset.text=this.buttonSubmit.innerHTML;
    this.buttonSubmit.innerHTML='Enviando....';
    this.buttonSubmit.setAttribute('disabled','disabled')
  }

  unBlock(){
    document.querySelectorAll('form.modalForm .form-control').forEach((ele)=>{
      
      ele.removeAttribute('disabled');

    })
    this.buttonSubmit.innerHTML=this.buttonSubmit.dataset.text;
    this.buttonSubmit.removeAttribute('data-text');
    this.buttonSubmit.removeAttribute('disabled')
  }

  getData(){

    let postArray=[];
    // let data={};
    document.querySelectorAll('form.modalForm .form-control,form.modalForm input[type=hidden]').forEach((ele)=>{
      
      postArray.push(ele.name+'='+encodeURI(ele.value));

    })

    return postArray;

  }

  sendForm(){

    this.block();

    let gatData=this.getData();
    

    

    let xhr = new XMLHttpRequest();
    xhr.open("POST", this.urlForm, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(gatData.join('&'));
    xhr.onload = function() {
      if (xhr.status === 200) {

        let rex = JSON.parse(xhr.responseText);
        // document.querySelector("#modal-container").dataset.onprint=(rex.onprint)?rex.onprint:'';
        document.querySelector("#modal-container").dataset.eval=(rex.eval)?rex.eval:'';
        let more = (rex.more)?rex.more:'';
        document.querySelector("#modal_response").innerHTML=`<div class="alert alert-${rex.status}" role="alert">${rex.text}</div>${more}`;
        loadModals();

        if(rex.status=='danger'){``
          this.unBlock();
        }
        if(rex.status=='success'){
          this.buttonSubmit.style.display='none';
        }

      }
    }.bind(this);
    
    /*
    fetch(this.url, {
      method: "POST", 
      body: data
    })
      .then( response => response.text() )  
      .then( response => {
        document.querySelector("#modal_response").innerHTML=`<div class="alert alert-success" role="alert">${response}</div>`;
    });      
    */
    
  }

  destroyModal(){

    if(
      document.querySelector("#modal-container").dataset.eval &&
      document.querySelector("#modal-container").dataset.eval!=''
      ){ 
      // console.log(document.querySelector("#modal-container").dataset.eval);
      eval(document.querySelector("#modal-container").dataset.eval)
    }
    document.body.classList.remove('modeModal');
    document.querySelector('#modal-container').remove();
    return; 
  
  }

  eventFields(){

    // date
    let $date_elements=document.querySelectorAll('.form-control[type=date]'); 
    $date_elements.forEach((ele)=>{
    
      ele.addEventListener('click',()=> {

        new ControlCalendar({
          container:ele,
          // date:new Date(2020,5,1),
          onselect:(date)=>{
            ele.value=date;
          }
          
        });

      });
    
    });

  }

  async launchModal(url){

    this.urlForm=url;

    if(document.querySelector("#modal-container")!=null){

      document.body.classList.remove('modeModal');
      document.querySelector('#modal-container').remove();

    }

    document.body.classList.add('modeModal');

    let modalContainer=document.createElement("div");
    modalContainer.setAttribute("id", "modal-container");
    document.body.appendChild(modalContainer);    

    let backModal=document.createElement("div");
    backModal.classList.add('backModal');
    backModal.addEventListener('click',()=>this.destroyModal());
    modalContainer.appendChild(backModal);

    let divModal=document.createElement("div");
    divModal.classList.add('controModal');
    divModal.classList.add('modal');


    divModal.innerHTML=`<div id="new_refreshing"></div>`;

    modalContainer.appendChild(divModal);

    await fetch(this.urlForm)
      .then( response => response.text() )
      .then( response => {

        if(divModal)
        divModal.innerHTML=response;

        /*
        888888 Yb    dP 888888 88b 88 888888 .dP"Y8
        88__    Yb  dP  88__   88Yb88   88   `Ybo."
        88""     YbdP   88""   88 Y88   88   o.`Y8b
        888888    YP    888888 88  Y8   88   8bodP'
        */
       this.buttonSubmit=document.querySelector('#btn-submit');

       this.buttonSubmit
          .addEventListener('click',()=>this.sendForm());

        document.querySelector('.modal-header button.close')
          .addEventListener('click',()=>this.destroyModal());

        document.querySelector('.modal-footer button.btn-secondary')
          .addEventListener('click',()=>this.destroyModal());

      }) 
      .then( () => this.eventFields() );




  }

}
  

export class ControlModalShares extends ControlModal {

  async launchModal(url){

    super.launchModal(url)
    .then(()=>{

      let $modalForm_monto_mes=document.querySelector('#modalForm_monto_mes');
      let $modalForm_total_meses=document.querySelector('#modalForm_total_meses');
      let $modalForm_monto_total=document.querySelector('#modalForm_monto_total');      
      let $modalControl_shares_table=document.querySelector('.control_shares .row-table');      
    
      if($modalControl_shares_table)
      $modalControl_shares_table.scrollTop = $modalControl_shares_table.scrollHeight;

      // total_meses = numero de checks marcados
      let checks=document.querySelectorAll(".control_shares input");

      checks.forEach((ele)=>{

        ele.addEventListener('click',()=> {
                    
          document.querySelector('#modalForm_total_meses').value=document.querySelectorAll(".control_shares input:checked").length;

          $modalForm_monto_total.value=$modalForm_monto_mes.value*$modalForm_total_meses.value;

        });

      });

      // que en el campo sólo se puedan ingresar números
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {

        $modalForm_monto_mes.addEventListener(event, function() {

          $modalForm_monto_mes.value=$modalForm_monto_mes.value.replace(/[^\d\.]/,'');
  
        })

      });

      // monto_total = monto_mes x total_meses
      if($modalForm_monto_mes && $modalForm_total_meses)
      $modalForm_monto_mes.addEventListener('keyup',()=> {

        let monto_total=$modalForm_monto_mes.value*$modalForm_total_meses.value;
        $modalForm_monto_total.value=monto_total.toFixed(2)

      });





    })

    


    // contarMeses=document.querySelectorAll(".control_shares input[type='checkbox']:checked").length
    // super(options,options);

  }
  
  getData(){

    let data = super.getData();
  
    let checkeds=document.querySelectorAll(".control_shares input:checked")
    checkeds.forEach((ele)=>{
      data.push('shares[]='+ele.value);
    });

    // console.log(data);

    return data;

  }

}

export class ControlModalMassive extends ControlModal {

  async launchModal(url){

    super.launchModal(url)
    .then(()=>{

      let dataa=[];
  
      let checkeds=document.querySelectorAll(".chk:checked");
      checkeds.forEach((ele)=>{
        dataa.push(ele.dataset.chk);
      });
      let $fiel=document.querySelector('#modalForm_revisados');
      $fiel.value=dataa.join(',');
      return dataa;

    })

    


    // contarMeses=document.querySelectorAll(".control_shares input[type='checkbox']:checked").length
    // super(options,options);

  }
  
  getData(){

    let data = super.getData();
  
    let checkeds=document.querySelectorAll(".control_shares input:checked")
    checkeds.forEach((ele)=>{
      data.push('shares[]='+ele.value);
    });

    // console.log(data);

    return data;

  }

}

export class ControlModalNewDocument extends ControlModal {

  async launchModal(url){

    super.launchModal(url)
    .then(()=>{

      let $modalForm_tipo_documento=document.querySelector('#modalForm_tipo_documento');
      let $ocultosAlInicio=document.querySelectorAll('#modalForm_tipo_evento,#modalForm_fecha_evento,#modalForm_ficha_cancelacion,#modalForm_resolucion');
      $ocultosAlInicio.forEach( ele => ele.parentNode.style.display='none' );

      let mostrarOcultos = () => { 
        if($modalForm_tipo_documento.value=='1'){
          $ocultosAlInicio.forEach( ele => ele.parentNode.style.display='block' );
        }
      };

      $modalForm_tipo_documento.addEventListener('change', mostrarOcultos );

      mostrarOcultos();

    });

  }

}

/*
export class ControlAutocomplete {
  
  constructor(options) {
    this.input=options.container;
    this.bindEvents();
  }
  bindEvents() {
    
  }

}
*/