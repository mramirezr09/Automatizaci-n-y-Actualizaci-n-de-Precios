$(document).ready(
  function(){
    cargaPafh();
  }
);

function cargaPafh(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-historicoPaf.php?action=ajax',
		success:function(data){
			$(".archivosPafh").html(data);
		}
	})
}
