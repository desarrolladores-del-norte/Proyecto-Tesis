$(document).ready(function(){
    
     setTimeout(function() {
         $("#mensaje").fadeIn(500).fadeOut(5000);
     },);
     
 
 $("#btn_registrar").click(function(){
<<<<<<< HEAD:views/index/js/validar.js
   
=======
     
>>>>>>> 1f1356aebe58dd2af9110cccd2dbd722c7601c42:views/registrar/js/validar.js
   
     if( $("#pass1").val()!=$("#pass2").val() ){
         $("#Error").html("Las claves no coinciden").fadeIn(500).fadeOut(7000);
         console.log("pasa");
    return false;
 }

 
<<<<<<< HEAD:views/index/js/validar.js
 var idC=$("#carnetReg").val();
    $.ajax({
     url:"verificarCarnet",
     data: {"carnetReg" :idC },
     type: "POST",  
=======
 
  var idC=$("#carnetReg").val();
    $.ajax({
     data: {"carnetReg" :idC },
     type: "POST",
     url:"verificarCarnet",
>>>>>>> 1f1356aebe58dd2af9110cccd2dbd722c7601c42:views/registrar/js/validar.js
     success:(function(data){
        console.log("carnet");
         if(data!=0){
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
         return false;
     }
     })
 });/*

 
 /*var idE=$("#email").val();
 $.ajax({
     data: {"EMAIL" :idE },
     type: "POST",
     url: "verificarEmail",
     success:(function(data){
         console.log("pasa");
         if(data!=0){
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
         return false;
     }
     })
 });*/
 
 
 
 })
 })
<<<<<<< HEAD:views/index/js/validar.js

=======
>>>>>>> 1f1356aebe58dd2af9110cccd2dbd722c7601c42:views/registrar/js/validar.js
