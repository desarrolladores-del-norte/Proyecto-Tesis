<?php
class registrarModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verificarCarnet($carnet)
    {
        $veri=$this->_db->query(
                  "select carnet from estudiante where carnet='$carnet'"
        );
        if ($veri->fetch()) {
             return true;
         }
         return false;
    }
    public function  verificarEmail($email)
    {
        $correo=$this->_db->query(
                  "select email from estudiante where email='$email'  "
        );
         if ($correo->fetch()){
             return true;
         }
         return false;
    }

   
    public function insertarestudiante($carnet,$pnombre,$snombre,$pape,$sape,$sexo,$num,$dep,$ciud,$email,$carrera,$pass,$FechaNac)
    {

 $this->_db->prepare("insert into estudiante(carnet,primerNombre,segundoNombre,primerApellido,segundoApellido,sexo,telefono,departamento,ciudad,email,carrera,pass,FechaNac,Estado)
  VALUES (:carnet,:pnom,:snom,:pape,:sape,:sexo,:tel,:depa,:ciu,:email,:carr,:pass,:fna ,1)")
            ->execute(
                array(
                    'carnet' => $carnet,
                    'pnom' => $pnombre,
                    'snom' => $snombre,
                    'pape' => $pape,
                    'sape' => $sape,
                    'sexo' => $sexo,
                    'tel' => $num,
                    'depa' => $dep,
                    'ciu' => $ciud,
                    'email' => $email,
                    'carr' => $carrera,
                    'pass' => $pass,
                    'fna' => $FechaNac
                    
                )
            );
     }

}
?>