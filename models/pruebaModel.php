<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 09:47 AM
 */
class pruebaModel extends Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function mostrar_datos()
    {
        $datos=$this->_db->query("select * from persona");
        return $datos->fetchAll();
    }
}