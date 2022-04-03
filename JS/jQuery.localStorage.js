function upd(pki,par){
  let iden = document.querySelector('#pre'+pki);
  iden.addEventListener('change', upd);
  var pi = pki;
	var pr = iden.value;
  var ar = par;

  $.ajax({
    url:'/Proyecto/App/Controller/Controller-updAutoriza.php?action=ajax&pi='+pi+'&pr='+pr+'&ar='+ar,
		success:function(data){
			$('#prec'+pi).html(data);
		}
	});
}

function rev(pki,par){
  let not = document.querySelector('#pre'+pki);
  not.addEventListener('change', rev);
  var pi = pki;
	var nota = not.value;
  var ar = par;

  $.ajax({
    url:'/Proyecto/App/Controller/Controller-updNota.php?action=ajax&pi='+pi+'&nota='+nota+'&ar='+ar,
		success:function(data){
      // console.log(data);
			$('#prec'+pi).html(data);
		}
	});
}
