/**
 * Created by JCPONCE on 31/03/2017.
 */
$(document).ready(function(){

    $('#opcion_obligacion').change(function(){

var opcion=$('#opcion_obligacion').val();


      if(opcion=="Negocio")
        {


            $('#formnegocio').removeClass('hide');
            $('#formpropiedad').addClass('hide');


        }

        if(opcion=="Propiedad")
        {
            $('#formpropiedad').removeClass('hide');
            $('#formnegocio').addClass('hide');

        }


        if(opcion=="Seleccione la Obligación")
        {

             $('#formnegocio').addClass('hide');
             $('#formpropiedad').addClass('hide');

        }





    });
});