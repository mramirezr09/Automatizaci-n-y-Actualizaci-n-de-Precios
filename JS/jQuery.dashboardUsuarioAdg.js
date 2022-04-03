$(document).ready(
  function(){
    carga1();
  }
);

function carga1(){
	$.ajax({
    url:'/Proyecto/App/Controller/Controller-dashboardUsuarioAdg.php?action=ajax',
		success:function(data){
			$(".archivosAdg").html(data);
		}
	})
}
