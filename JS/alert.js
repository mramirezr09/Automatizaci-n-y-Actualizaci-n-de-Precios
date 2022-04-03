//mostrar texto de error en pantalla
const alert = document.querySelector('.alerta');
alert.addEventListener('submit',function(e){
  e.preventDefault();
  Location.reload();
  mensaje('Alerta', 'mensaje-correcto');
});

//mostrar texto de error en pantalla
function mensajea(texto, tipo, id){
  const alert = document.querySelector(id);
  const textoMensaje = document.createElement('P');
  textoMensaje.classList.add(tipo);
  textoMensaje.textContent = texto;
  formulario.appendChild(textoMensaje);
  //---ocultar texto despues de 5s-------------
  setTimeout( () => {
    textoMensaje.remove();
  }, 120000);
  return formulario;
}
