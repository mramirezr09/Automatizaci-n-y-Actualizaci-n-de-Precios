//validacion de formulario
const user = document.querySelector('#user'); //para seleccionar un id se antepone el simbolo de # seguido del id #nombre
const pass = document.querySelector('#pass');
const formulario = document.querySelector('.formulario');
const datos = { //objeto de tipo arreglo llamado "datos"
  user: '', //para asociar al objeto el valor del id se deben llamar igual "nombre" y "#nombre"
  pass: ''
}

user.addEventListener('change', leerTexto); //
pass.addEventListener('change', leerTexto); //se puede usar "input" en lugar de change y este revisara cada caracter ingresado
formulario.addEventListener('submit', function(e){
  //validacion
  const {user,pass} = datos; //extrae los valores de un objeto de un arreglo y los declara en nuevas varibales el = indica que vienen de otra variable "datos"
  if(user == '' || pass == ''){ //si user o pass estan vacios
    e.preventDefault(); //detiene la ejecucion
    mensaje('Datos Incompletos, llene todos los campos','mensaje-error'); // crea el mensaje
    return; // y detiene la ejecucion del código
  }
  // else if(user == '' && pass == ''){
  //   e.preventDefault(); //detiene la ejecucion
  //   mensaje(); // crea el mensaje
  //   return; // y detiene la ejecucion del código
  // }
});

//fuciones
function leerTexto(e){
  datos[e.target.id] = e.target.value;
  //el parametro "value" guarda el valor del campo
  //el parametro "id" hace referencia al identificador o cambia el identificador
}

//mostrar texto de error en pantalla
function mensaje(texto, tipo){
  const textoMensaje = document.createElement('P');
  textoMensaje.classList.add(tipo);
  textoMensaje.textContent = texto;
  formulario.appendChild(textoMensaje);
  //---ocultar texto despues de 5s-------------
  setTimeout( () => {
    textoMensaje.remove();
  }, 5000);
  return formulario;
}
