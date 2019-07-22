<?php
class loginEstModel extends Model{
   public function __construct()
 {
 parent::__construct();
 }

 
    public function getUsuario($carnetEst, $passEst){
        $datos = $this->_db->query(
                "select * from estudiante " . 
                "where carnet='$carnetEst' " .
                "and pass ='$passEst' " 
                );
        return $datos->fetch();
    }
}
?>