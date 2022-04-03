$(document).ready(
  function(){
    let f1 = document.querySelector('#f1');
    let bf1 = document.querySelector('#bf1');

    let f2 = document.querySelector('#f2');
    let bf2 = document.querySelector('#bf2');

    let f3 = document.querySelector('#f3');
    let bf3 = document.querySelector('#bf3');
  }
);

f1.addEventListener('input', search);
bf1.addEventListener('click', search);

f2.addEventListener('input', search);
bf2.addEventListener('click', search);

f3.addEventListener('input', search);
bf3.addEventListener('click', search);

function search(){
  let ar = par;
  em;
	let fcp = f1.value;
  let bfcp = bf1.value;

  let fd = f2.value;
  let bfd = bf2.value;

  let fp = f3.value;
  let bfp = bf3.value;

  $.ajax({
    url:'/Proyecto/App/Controller/Controller-editarExcel.php?action=ajax&pkid='+pkid+'&fcp='+fcp+'&bfcp='+bfcp+'&fd='+fd+'&bfd='+bfd+'&fp='+fp+'&bfp='+bfp+'&par='+ar+'&em='+em,
		success:function(data){
			$(".updRegistros").html(data);
		}
	});
}
