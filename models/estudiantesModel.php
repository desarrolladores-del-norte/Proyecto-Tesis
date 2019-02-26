<?php



class estudiantesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertarestudiante($nombre,$email,$telefono,$estado)
    {


        $this->_db->prepare("insert into Estudiante(nombre,email,telefono,activo) VALUES (:nombre  , :email , :telefono , :estado)")
            ->execute(
                array(
                    'nombre' => $nombre,
                    'email' => $email,
                    'telefono' => $telefono,
                    'estado' => $estado
                )
            );


    }




    public function asistir_clase($id_e)
    {
        $fecha=date("Y-m-d");

        $estado=$this->_db->query("select * from asistencia where idE=$id_e and fecha='$fecha'");

        if(!$estado->fetch()) {


            $this->_db->prepare("insert into asistencia(idE,fecha) VALUES (:idE  , :fecha )")
                ->execute(
                    array(
                        'idE' => $id_e,

                        'fecha' => $fecha
                    )
                );
            return "Bienvenido a Clase";
        }
        else
            return "Ya marco Asistencia";

    }





    public function obtener_notas($id_e,$fecha_i,$fecha_f){
        $datos=$this->_db->query("select DATE_FORMAT(fecha,'%Y-%m-%d') as fechas,sum(puntaje) as puntos_e,sum(p.puntos) as puntos_acumulados from estudiante as e inner join (r_p_e as r inner join preguntas as p on(r.idP=p.idPreguntas)) on(e.idEstudiante=r.idE) where DATE_FORMAT(fecha,'%Y-%m-%d') between '$fecha_i' and '$fecha_f' and e.idEstudiante=$id_e group by fechas;");
        return $datos->fetchAll();

    }


    public function obtener_notas_trabajos($id_e,$fecha_i,$fecha_f){
        $datos=$this->_db->query("select DATE_FORMAT(fecha,'%Y-%m-%d') as fechas,sum(puntaje) as puntos_e,sum(t.puntos) as puntos_acumulados,t.nombre as nombret from estudiante as e inner join (r_t_e as r inner join trabajos as t on(r.idT=t.idtrabajos)) on(e.idEstudiante=r.idE) where DATE_FORMAT(fecha,'%Y-%m-%d') between '$fecha_i' and '$fecha_f' and e.idEstudiante=$id_e group by fechas;");
        return $datos->fetchAll();

    }



    public function obtenerarchivodata(){ return dirname(__FILE__).'/data.txt';}


public function preguntas_opciones($idp)
{
    $fecha=date("Y-m-d");
    $pregunta=$this->_db->query("select idP,pregunta,op1,op2,op3,op4 from preguntas as p inner join opciones_respuestas as o on(p.idPreguntas=o.idP) where p.idPreguntas=$idp and DATE_FORMAT(fecha,'%Y-%m-%d')='$fecha'");
    return $pregunta->fetch();
}

public function responder_pregunta($idP,$respuesta,$idE)
{

    $estado_pregunta=$this->_db->query("select activa from preguntas where idPreguntas=$idP");
    $esta_activa=$estado_pregunta->fetch();
    if($esta_activa['activa']==1)
    {
    $participado=$this->_db->query("select idR_P_E from r_p_e where idP=$idP and idE=$idE");
   if(!$participado->fetch())
   {
        $puntos=0;
            $res=$this->_db->query("select respuesta,puntos from preguntas where idPreguntas=$idP");
            $respuesta_correcta= $res->fetch();
            if($respuesta_correcta['respuesta']==$respuesta)
                $puntos=$respuesta_correcta['puntos'];

            $this->_db->prepare("insert into r_p_e(idE,idP,respuesta,puntaje) VALUES (:idE , :idP, :respuesta, :puntaje )")
                ->execute(
                    array(
                        'idE' => $idE,
                        'idP' => $idP,
                        'respuesta' => $respuesta,
                        'puntaje' => $puntos
                    )
                );
    return  "Pregunta Contestada";
   }
   else
       return "El Estudiante ya Contesto esta Pregunta";
    }
    else
       return "Ya no Puede Contestar esta pregunta";

}


    public function verificarEmail($email)
    {
        $id=$this->_db->query("select idEstudiante from estudiante where email='$email'");
        if($id->fetch()){
            return true;
        }
        return false;
    }

public function obtener_id_estudiante($email){
    $id=$this->_db->query("select idEstudiante from estudiante where email='$email'");
    return $id->fetch();

}






}