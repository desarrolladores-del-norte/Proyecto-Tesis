$(document).ready(function(){
    
     setTimeout(function() {
         $("#mensaje").fadeIn(500).fadeOut(5000);
     },);
     
 
 $("btn_loginEst").click(function(){
     
 var idC=$("#carnet").val();
    $.ajax({
     data: {"carnet" :idC },
     type: "POST",
     url:"getEstudiante",
     success:(function(data){
         if(data!=0){
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
         return false;
     }
     })
 });
  
 
 });
 
 
 
 })
 
