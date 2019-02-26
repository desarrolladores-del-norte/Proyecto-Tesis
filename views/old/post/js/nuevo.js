/**
 * Created by JCPONCE on 31/03/2017.
 */
$(document).ready(function(){

    $('#form1').validate({
        rules:{
            titulo:{
        required: true
            },
    cuerpo:{
        required: true
    }
},
    messages:{
        titulo:{
        required:"Debe introducir el Titulo del Post"
        },
    cuerpo:{
        required:"Debe introducir el Cuerpo del Post"

    }
    }
});
});