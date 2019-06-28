<?php
class loginProfModel extends Model{
   public function __construct()
 {
 parent::__construct();
 }

 
    public function getprof($user, $passprof){
        $datos = $this->_db->query(
                "select * from profesor " . 
                "where usuario='$user' " .
                "and pass_prof ='$passprof' " 
                );
        return $datos->fetch();
    }
}
?>