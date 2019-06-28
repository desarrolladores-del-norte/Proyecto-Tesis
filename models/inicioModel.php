<?php
class inicioModel extends Model{
   public function __construct()
 {
 parent::__construct();
 }

 
    public function getEstudiante($carnetEst, $passEst){
        $datos = $this->_db->query(
                "select * from estudiante " . 
                "where carnet='$carnetEst' " .
                "and pass ='$passEst' " 
                );
        return $datos->fetch();
    }

    public function getprof($user, $passprof){
        $datos = $this->_db->query(
                "select * from profesor " . 
                "where usuario='$user' " .
                "and pass_prof ='$passprof' " 
                );
        return $datos->fetch();
    }


    // registrar estudiante
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

   
    public function insertarestudiante($carnet,$pnombre,$ape,$sexo,$num,$dep,$ciud,$email,$carrera,$pass,$FechaNac)
    {

 $this->_db->prepare("insert into estudiante(carnet,nombres,apellidos,sexo,telefono,departamento,ciudad,email,carrera,pass,FechaNac,Estado)
  VALUES (:carnet,:nomb,:pape,:sexo,:tel,:depa,:ciu,:email,:carr,:pass,:fna ,1)")
            ->execute(
                array(
                    'carnet' => $carnet,
                    'nomb' => $pnombre,
                    'pape' => $ape,
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

     //modelo de registrar profesor

     public function verificaruser($carnet)
     {
         $verif=$this->_db->query(
                   "select usuario from profesor where usuario='$carnet'"
         );
         if ($verif->fetch()) {
              return true;
          }
          return false;
     }
     public function  verificarEmailp($email)
     {
         $correop=$this->_db->query(
                   "select emailProf from profesor where emailProf='$email'  "
         );
          if ($correop->fetch()){
              return true;
          }
          return false;
     }
 
    
     public function insertarProfesor($profnomb,$profape,$user,$pass,$sexo,$email,$car)
     {
 
  $this->_db->prepare("insert into profesor(nombres,apellidos,usuario,pass_prof,sexo,emailProf,carrera,Estado)
   VALUES (:pname,:ssurname,:use,:pas,:sex,:email,:carr,'1')")
             ->execute(
                 array(
                     
                     'pname' => $profnomb,
                     'ssurname' => $profape,
                     'use' => $user,
                     'pas' => $pass,
                     'sex' => $sexo,
                     'email' => $email,
                     'carr' => $car,
                    

                    
                     
                 )
             );
      }   

}

?>