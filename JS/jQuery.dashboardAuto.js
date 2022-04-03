$(document).ready(
  function(){
    carga();
  }
);

function carga(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-dashboardUsuario.php?action=ajax',
		success:function(data){
			$(".productos").html(data);
		}
	})
}
