$(document).ready(
  function(){
    cargaAdgh();
  }
);

function cargaAdgh(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-historicoAdg.php?action=ajax',
		success:function(data){
			$(".archivosAdgh").html(data);
		}
	})
}
