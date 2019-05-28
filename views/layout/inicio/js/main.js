
$(document).ready(function(){
/***** Abrir link en una nueva ventana *****/
  $(".open-link-newTab").click(function(e){
 		e.preventDefault();
 		var HrefLink=$(this).attr("href");
 		window.open(HrefLink,'_blank');
  });
});