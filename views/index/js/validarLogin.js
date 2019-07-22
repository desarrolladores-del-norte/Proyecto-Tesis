$(document).ready(function(){
<<<<<<< HEAD
     

    $("#form_log_est").submit(function(e){
        var est=true;
        e.preventDefault();
        $.ajax({
             async: false,
            url: "index/logEst",
            type:"post",
            data:$(this).serialize(),
            success: function(data){
                if(data !=0){
                    $("#Errorlog").html(data).fadeIn(500).fadeOut(7000);
                    est=false;
                }
                    
                if(est==true){
                    window.location.replace('student');
                }
                else {
                    console.log("No es Correcto");
                }
            return est;
                
            } 
         });
     
    });

    // Validación de Profesor
    $("form_log_prof").submit(function(p){
        var pr=true;
        p=preventDefault();
        $.ajax({
            async:false,
            url:"index/loginProf",
            type: "post",
            data:$(this).serialize(),
            success:function(data){
                if(data !=0){
                    $("Errorlogp").html(data).fadeIn(500).fadeOut(7000);
                    prf=false;
                }
                if(pr==true){
                    window.location.replace('profesor');
                }
                else{
                    console.log("Incorrecto");
                }
            }
        });

    });



});
=======
    
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
 
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
