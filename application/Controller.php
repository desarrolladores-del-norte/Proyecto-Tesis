<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 24/03/2017
 * Time: 10:46 AM
 */

abstract class Controller
{
    protected $_view;

    public function __construct()
    {
        $this->_view=new View(new Request());
    }

    abstract public function index();

    protected function loadModel($modelo)
    {
        $modelo=$modelo.'Model';
        $rutaModelo=ROOT.'models'.DS.$modelo.'.php';
        if(is_readable($rutaModelo))
        {
            require_once $rutaModelo;
            $modelo=new $modelo;
            return $modelo;
        }
        else
        {
            throw new Exception('Error en el modelo');
        }
    }


    protected function getLibrary($libreria)
    {
        $rutaLibreria=ROOT.'libs'.DS.$libreria.'.php';
        if(is_readable($rutaLibreria))
        {
            require_once $rutaLibreria;
        }
        else
        {
            throw new Exception('Error de Libreria');
        }
    }

    protected function getTexto($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))
        {
            $_POST[$clave]=htmlspecialchars($_POST[$clave],ENT_QUOTES);
            return $_POST[$clave];
        }
        else
            return '';
    }

    protected function getInt($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))
        {
            $_POST[$clave]=filter_input(INPUT_POST,$clave,FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }
        else
            return 0;
    }
    protected function redireccionar($ruta=false)
    {
        if ($ruta)
        {
            header('location:'.BASE_URL.$ruta);
            exit;
        }
        else{
            header('location:'.BASE_URL);
            exit;
        }

    }
protected function filtarInt($int)
    {
            $int=(int) $int;
            if(is_int($int))
                return $int;
            else
                return 0;
    }




   // protected function getSql($c){
     //   if(isset($_POST[$c]) && !empty($_POST[$c])){
       //     $_POST[$c] = strip_tags($_POST[$c]);
        //}
        //if(! get_magic_quotes_gpc()){
          //  $_POST[$c]=mysql_escape_string($_POST[$c]);
        //}
        //return trim($_POST[$c]);
    //}
    // captura el pass y usuario
 protected function getSql($c){
    if(isset($_POST[$c]) && !empty($_POST[$c])){
        $_POST[$c] = strip_tags($_POST[$c]);
    }
    return trim($_POST[$c]);
}

    protected function getAlphaNum($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }

    }

public function validarEmail($email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        return true;
    }

    protected function getPostParam($clave)
    {
        if(isset($_POST[$clave])){
            return $_POST[$clave];
        }
    }
    protected function getfecha($fecha)
    {
        if(isset($_POST[$fecha])){
         //  $fecha=strtotime($fecha);
           // $fecha=date("Y-m-d",$fecha);
            return $fecha;
        }
    }

}