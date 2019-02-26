<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 24/03/2017
 * Time: 10:47 AM
 */

class Model
{
    protected $_db;
    public function __construct()
    {
        $this->_db= new Database();
    }
}