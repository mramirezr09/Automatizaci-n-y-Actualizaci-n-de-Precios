$(document).ready(
  function(){
    conh(pkid,par,em);
  }
);


function conh(pkid,par,em){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-historicoExcel.php?action=ajax&pkid='+pkid+'&par='+par+'&em='+em,
		success:function(data){
			$(".archivosh").html(data);
		}
	});
}
