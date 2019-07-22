<?php
class inicioModel extends Model{
   public function __construct()
 {
 parent::__construct();
 }

 
    public function getEstudiante($carnetEst, $passEst){
<<<<<<< HEAD
        $studen = $this->_db->query(
=======
        $datos = $this->_db->query(
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
                "select * from estudiante " . 
                "where carnet='$carnetEst' " .
                "and pass ='$passEst' " 
                );
<<<<<<< HEAD
                if ($studen->fetch()){
                    return true;
                }
                return false;
    }

    public function getprof($user, $passprof){
        $profe = $this->_db->query(
=======
        return $datos->fetch();
    }

    public function getprof($user, $passprof){
        $datos = $this->_db->query(
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
                "select * from profesor " . 
                "where usuario='$user' " .
                "and pass_prof ='$passprof' " 
                );
<<<<<<< HEAD
        return $profe->fetch();
    }



=======
        return $datos->fetch();
    }


    // registrar estudiante
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
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
<<<<<<< HEAD

    

    public function  verificarEmail($email)
    {
        $correo=$this->_db->query(
                  "select email from estudiante where email='$email'"
=======
    public function  verificarEmail($email)
    {
        $correo=$this->_db->query(
                  "select email from estudiante where email='$email'  "
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
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

<<<<<<< HEAD
     public function verificaruser($users)
     {
         $verif=$this->_db->query(
                   "select usuario from profesor where usuario='$users'"
=======
     public function verificaruser($carnet)
     {
         $verif=$this->_db->query(
                   "select usuario from profesor where usuario='$carnet'"
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
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