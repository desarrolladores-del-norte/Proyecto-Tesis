$(document).ready(function(){
    
     setTimeout(function() {
         $("#mensaje").fadeIn(500).fadeOut(5000);
     },);
     
 
 $("#btn_regist").click(function(){
     
   
     if( $("#pass1").val()!=$("#pass2").val() ){
         $("#Error").html("Las claves no coinciden").fadeIn(500).fadeOut(7000);
 
    return false;
 }
 
 
  var idU=$("#user").val();
    $.ajax({
     data: {"user" :idU },
     type: "POST",
     url:"verificaruser",
     success:(function(data){
         if(data!=0){
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
         return false;
     }
     })
 });
  
 
 var idEp=$("#email").val();
 $.ajax({
     data: {"EMAIL" :idEp },
     type: "POST",
     url: "verificarEmailp",
     success:(function(data){
         console.log("pasa");
         if(data!=0){
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
         return false;
     }
     })
 });
 

 
 
 })
 })
