$(document).ready(function(){
    
 

     setTimeout(function() {
         $("#mensaje").fadeIn(500).fadeOut(5000);
     },);
     
 
 $("#form_registro").submit(function(){
    var estado_general=true;
   
     if( $("#pass1").val()!=$("#pass2").val() ){
         $("#Error").html("Las claves no coinciden").fadeIn(500).fadeOut(7000);
         console.log("pasa");
    return false;
 }

    
    var idC=$("#carnetReg").val();
    $.ajax({
        async: false,
     url:"index/verificarCarnet",
     data: {"carnetReg" :idC },
     type: "POST",  
     success:(function(data){
        
         if(data!=0){
            
         $("#Error").html(data).fadeIn(500).fadeOut(7000);
        
         estado_general= false;
     }
     })
 });



   var idE=$("#email_estudiante").val();
    $.ajax({
        async: false,
        data: {"EMAIL" :idE },
        type: "POST",
        url: "index/verificarEmail",
        success:(function(data){
            
            if(data!=0){
            
            $("#Error").html(data).fadeIn(500).fadeOut(7000);
           
            estado_general=false;
        }
        
        })
    });

if(estado_general)
alert("Registro de Estudiante Guardado");
return estado_general;


 })

// Validar Profesor
 
 $("#registroProfesor").submit(function(){
    var estado=true;
   
     if( $("#pass1p").val()!=$("#pass2p").val() ){
         $("#Errorp").html("Las claves no coinciden").fadeIn(500).fadeOut(7000);
         console.log("pasa");
    return false;
 }

    
    var idU=$("#user").val();
    $.ajax({
        async: false,
     url:"index/verificaruser",
     data: {"user" :idU },
     type: "POST",  
     success:(function(data){
        
         if(data!=0){
            
         $("#Errorp").html(data).fadeIn(500).fadeOut(7000);
        
         estado= false;
     }
     })
 });



   var idEP=$("#email_profe").val();
    $.ajax({
        async: false,
        data: {"EMAIL" :idEP },
        type: "POST",
        url: "index/verificarEmailp",
        success:(function(data){
            
            if(data!=0){
            
            $("#Errorp").html(data).fadeIn(500).fadeOut(7000);
           
            estado=false;
        }
        
        })
    });

if(estado)
alert("Registro de Estudiante Guardado");
return estado;


 })
 

 })

