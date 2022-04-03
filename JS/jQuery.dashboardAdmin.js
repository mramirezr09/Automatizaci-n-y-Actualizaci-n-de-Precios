$(document).ready(
  function(){
    carga();
  }
);

function carga(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-dashboardAdmin.php?action=ajax',
		success:function(data){
			$(".actualizar").html(data).fadeIn('slow');
      console.log('funciona');
		}
	})
}
