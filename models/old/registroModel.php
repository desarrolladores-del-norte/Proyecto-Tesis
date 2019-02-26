<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 04/05/2017
 * Time: 11:16 AM
 */
class registroModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function verificarUsuario($usuario)
    {
        $id=$this->_db->query("select id from usuarios where usuario='$usuario'");
        if($id->fetch()){
            return true;
        }
        return false;
    }

    public function verificarEmail($email)
    {
        $id=$this->_db->query("select id from usuarios where usuario='$email'");
        if($id->fetch()){
            return true;
        }
        return false;
    }

    public function registroUsuario($nombre,$usuario,$pass,$email,$role,$estado,$fecha)
    {
        $this->_db->prepare(
            "insert into usuarios(nombre,usuario,pass,email,role,estado,fecha_registro) values ( :nombre, :usuario , :pass , :email , :role , :estado , :fecha_registro)"
        )->execute(array(
            ':nombre'=>$nombre,
            ':usuario'=>$usuario,
            ':pass'=>Hash::getHash('sha1',$pass,HASH_KEY),
            ':email'=>$email,
            ':role'=>$role,
            ':estado'=>$estado,
            ':fecha_registro'=>$fecha,

        ));
    }


    public function actualizarUsuario($nombre,$id,$pass,$email,$role,$estado,$fecha)
    {
        $this->_db->prepare(
            "update usuarios set nombre= :nombre ,pass= :pass ,email= :email ,role= :role ,estado= :estado ,fecha_registro= :fecha_registro where id= :id"
        )->execute(array(
            ':nombre'=>$nombre,
            ':id'=>$id,
            ':pass'=>Hash::getHash('sha1',$pass,HASH_KEY),
            ':email'=>$email,
            ':role'=>$role,
            ':estado'=>$estado,
            ':fecha_registro'=>$fecha

        ));
    }

    public function actualizarUsuario2($nombre,$id,$email,$role,$estado,$fecha)
    {
        $this->_db->prepare(
            "update usuarios set nombre= :nombre ,email= :email ,role= :role ,estado= :estado ,fecha_registro= :fecha_registro where id= :id"
        )->execute(array(
            ':nombre'=>$nombre,
            ':id'=>$id,
             ':email'=>$email,
            ':role'=>$role,
            ':estado'=>$estado,
            ':fecha_registro'=>$fecha

        ));
    }

    public function obtenerUsuarios()
    {
        $usuarios=$this->_db->query("select * from usuarios ");
        return $usuarios->fetchAll();

    }

    public function obtenerUsuario($idu)
    {
        $usuarios=$this->_db->query("select * from usuarios where id=".$idu);
        return $usuarios->fetch();

    }


    public function eliminarUsuario($id)
    {
        try{


            $id=(int)$id;

            $this->_db->prepare("delete from usuarios where id= :id")
                ->execute(
                    array(
                        ':id'=>$id

                    )
                );

            return "Todo bien";
        }
        catch (Exception $e){return "Error :".$e;

        }
    }

}
//
//rubenlaufo@gmail.com