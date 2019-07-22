$(document).ready(function(){
     

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
