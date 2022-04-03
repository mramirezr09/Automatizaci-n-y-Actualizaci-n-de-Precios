$(document).ready(
  function(){
    carga2();
  }
);

function carga2(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-dashboardUsuarioPaf.php?action=ajax',
		success:function(data){
			$(".archivosPaf").html(data);
		}
	})
}
