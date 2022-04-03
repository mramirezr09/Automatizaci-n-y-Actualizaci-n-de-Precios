$(document).ready(
  function(){
    updA(pkid,par,em);
  }
);


function updA(pkid,par,em){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-editarExcel.php?action=ajax&pkid='+pkid+'&par='+par+'&em='+em,
		success:function(data){
			$(".updRegistros").html(data);
		}
	});
}
