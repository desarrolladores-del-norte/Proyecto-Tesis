<?php
class loginModel extends Model{
   public function __construct()
 {
 parent::__construct();
 }

 
    public function getUsuario($usuario, $password){
        $datos = $this->_db->query(
                "select * from usuario " . 
                "where usuario = '$usuario' " .
                "and pass ='$password' " 
                );
        return $datos->fetch();
    }
}
?>