<?php
class registryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
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

   
    public function insertarProfesor($pnomb,$snomb,$papell,$sapell,$user,$pass,$email,$sexo)
    {

 $this->_db->prepare("insert into profesor(primerNombre,segundoNombre,primerApellido, segundoApellido,usuario,pass_prof,emailProf,sexo,Estado)
  VALUES (:pname,:sname,:psurname,:ssurname,:use,:pas,:email,:sex,'1')")
            ->execute(
                array(
                    
                    'pname' => $pnomb,
                    'sname' => $snomb,
                    'psurname' => $papell,
                    'ssurname' => $sapell,
                    'use' => $user,
                    'pas' => $pass,
                    'email' => $email,
                    'sex' => $sexo,
                    
                )
            );
     }
}
?>