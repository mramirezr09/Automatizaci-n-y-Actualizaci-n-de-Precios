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

f1.addEventListener('input', searchh);
bf1.addEventListener('click', searchh);

f2.addEventListener('input', searchh);
bf2.addEventListener('click', searchh);

f3.addEventListener('input', searchh);
bf3.addEventListener('click', searchh);

function searchh(){
  let ar = par;
	var fcp = f1.value;
  var bfcp = bf1.value;

  var fd = f2.value;
  var bfd = bf2.value;

  var fp = f3.value;
  var bfp = bf3.value;

  $.ajax({
    url:'/Proyecto/App/Controller/Controller-historicoExcel.php?action=ajax&pkid='+pkid+'&fcp='+fcp+'&bfcp='+bfcp+'&fd='+fd+'&bfd='+bfd+'&fp='+fp+'&bfp='+bfp+'&par='+ar+'&em='+em,
		success:function(data){
			$(".archivosh").html(data);
		}
	});
}
