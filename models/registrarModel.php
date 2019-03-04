<?php
class registrarModel extends Model
{
    private $carnet;


    public function __construct()
    {
        parent::__construct();
    }

    public function set($atributo, $contenido)
    {
        $this->$atributo=$contenido;
    }
    public function get($atributo)
    {
        return $atributo;
    }

    public function insertarestudiante($carnet,$nom1,$nom2,$ap1,$ap2,$sexo,$tel,$dep,$ciudad,$email,$carrera,$pass)
    {


        $this->_db->prepare("insert into estudiante(carnet, primerNombre, segundoNombre, primerApellido, segundoApellido,
        sexo, telefono, departamento, ciudad,email, carrera, pass) 
        VALUES (:carenet, :nom1, :nom2, :ap1, :ap2, :sexo, :tel, :dep, :ciudad, :email , :carrera , :pass)")
            ->execute(
                array(
                    'carnet'=> $carnet,
                    'primerNombre' => $nom1,
                    'segundoNombre' => $nom2,
                    'primerApellido' => $ap1,
                    'segundoApellido' => $ap2,
                    'sexo' => $sexo,
                    'telefono' => $tel,
                    'departamento' => $dep,
                    'ciudad' => $ciudad,
                    'email' => $email,
                    'carrera' => $carrera,
                    'pass' => $pass
                )
            );
            

    }
}



?>