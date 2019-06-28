$(document).ready(function(){
    
     setTimeout(function() {
         $("#mensaje").fadeIn(500).fadeOut(5000);
     },);
     
 
 $("#btn_registrar").click(function(){
   
   
     if( $("#pass1").val()!=$("#pass2").val() ){
         $("#Error").html("Las claves no coinciden").fadeIn(500).fadeOut(7000);
         console.log("pasa");
    return false;
 }

 
 var idC=$("#carnetReg").val();
    $.ajax({
     url:"verificarCarnet",
     data: {"carnetReg" :idC },
     type: "POST",  
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

