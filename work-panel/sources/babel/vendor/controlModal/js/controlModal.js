
class ControlModal {

    constructor(options){

      this.container = options.container;
      this.launchModal()
      this.bindEvents();
    }

    bindEvents(){

      this.container.addEventListener('click',()=>this.launchModal());
      
    }
  
    launchModal(){
  
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
      // divModal.setAttribute("id", "div-modal");
      divModal.innerHTML=`<div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
          onclick="javascript:document.body.classList.remove('modeModal');document.querySelector('#modal-container').remove();"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"
          onclick="javascript:document.body.classList.remove('modeModal');document.querySelector('#modal-container').remove();"
          >Cerrar</button>
        </div>
      </div>
    </div>`;
  
      modalContainer.appendChild(divModal);
  
      // document.getElementById('div-modal').innerHTML=`hola`;
  
      /*  
      let divButtonClose=document.createElement("a");
      divButtonClose.classList.add('btn');
      divButtonClose.classList.add('btn-danger');
      divButtonClose.textContent='X';
      divButtonClose.addEventListener('click',()=>this.destroyModal());
      divModal.appendChild(divButtonClose);
      */
      // divModal.setAttribute("id", "idModal");
  
    }
  
    destroyModal(){
  
      document.body.classList.remove('modeModal');
      document.querySelector('#modal-container').remove();
    
    }
  
  }
  