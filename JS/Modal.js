function salir(evt) {
  window.location.assign("'.SRVURL.$vista.'");
}

//borrar archivo
function modalb(evt,id){
  evt.preventDefault();
  const openModalb = document.querySelector(".borrar__modal");
  const modalb = document.querySelector(".modal-b");
  const closeModalb = document.querySelector(".cb");
  modalb.classList.add("modal--show");
  $('#idn').val(id);
}

function cb(){
  const openModalb = document.querySelector(".borrar__modal");
  const modalb = document.querySelector(".modal-b");
  const closeModalb = document.querySelector(".cb");
  modalb.classList.remove("modal--show");
}

function borrar(id) {
  let idn = document.querySelector('#idn').value;
  $.ajax({
    url:'/Proyecto/App/Controller/Controller-deletFile.php?action=ajax&idn='+idn,
    success:function(data){
      // console.log(data);
      location.reload();
    }
  });
}

//confirmar archivo
function modalc(evt,id){
  evt.preventDefault();
  const openModalc = document.querySelector(".confi__modal");
  const modalc = document.querySelector(".modal-c");
  const closeModalc = document.querySelector(".cc");
  modalc.classList.add("modal--show");
  $('#idnc').val(id);
}

function cc() {
  const openModalc = document.querySelector(".confi__modal");
  const modalc = document.querySelector(".modal-c");
  const closeModalc = document.querySelector(".cc");
  modalc.classList.remove("modal--show");
}

function confirmar(id) {
  let idnc = document.querySelector('#idnc').value;
  $.ajax({
    url:'/Proyecto/App/Controller/Controller-preautorizar.php?action=ajax&idnc='+idnc,
    success:function(data){
      location.reload();
    }
  });
}

//rechazar archivo
function modalr(evt,id){
  evt.preventDefault();
  const openModalr = document.querySelector(".rechazar__modal");
  const modalr = document.querySelector(".modal-r");
  const closeModalr = document.querySelector(".cr");
  modalr.classList.add("modal--show");
  $('#idr').val(id);
}

function cr() {
  const openModalr = document.querySelector(".rechazar__modal");
  const modalr = document.querySelector(".modal-r");
  const closeModalr = document.querySelector(".cr");
  modalr.classList.remove("modal--show");
}

function rechazar(id) {
  let idr = document.querySelector('#idr').value;
  $.ajax({
    url:'/Proyecto/App/Controller/Controller-rechazar.php?action=ajax&idr='+idr,
    success:function(data){
      console.log(data);
      location.reload();
    }
  });
}

//notificar archivo
function modaln(evt,id){
  evt.preventDefault();
  const openModaln = document.querySelector(".notificar__modal");
  const modaln = document.querySelector(".modal-n");
  const closeModaln = document.querySelector(".cn");
  modaln.classList.add("modal--show");
  $('#idnn').val(id);
}

function cn() {
  const openModaln = document.querySelector(".notificar__modal");
  const modaln = document.querySelector(".modal-n");
  const closeModaln = document.querySelector(".cn");
  modaln.classList.remove("modal--show");
}

function notificar(id) {
  let idnn = document.querySelector('#idnn').value;
  $.ajax({
    url:'/Proyecto/App/Controller/Controller-notificar.php?action=ajax&idnn='+idnn,
    success:function(data){
      // console.log(data);
      location.reload();
    }
  });
}

//actualizar clientes
function updc(){
  const openModalcl = document.querySelector(".upd__modal");
  const modalcl = document.querySelector(".modal-cli");
  const closeModalcl = document.querySelector(".cu");
  modalcl.classList.add("modal--show");
}

function cu() {
  const openModalcl = document.querySelector(".upd__modal");
  const modalcl = document.querySelector(".modal-cli");
  const closeModalcl = document.querySelector(".cu");
  modalcl.classList.remove("modal--show");
}

function actcli() {
   loader();
  $.ajax({
    url:'/Proyecto/App/Controller/Controller-updClientes.php?action=ajax',
    success:function(data){
      // console.log(data);
      location.reload();
    }
  });
}
