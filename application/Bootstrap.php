<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 24/03/2017
 * Time: 10:48 AM
 */
class Bootstrap
{
    /**
     * @param Request $peticion
     * @throws Exception
     */
    public static function run(Request $peticion)
    {
        $controller=$peticion->getControlador().'Controller';
        $rutaControlador=ROOT.'Controllers'.DS.$controller.'.php';
        $metodo=$peticion->getMetodo();
        $args=$peticion->getArgs();
        if(is_readable($rutaControlador)){
            require_once $rutaControlador;
            $controller= new $controller;
            if(is_callable(array($controller,$metodo))){
                $metodo=$peticion->getMetodo();
            }
            else{
                $metodo='index';
            }
            if(isset($args)){
                call_user_func_array(array($controller,$metodo),$args);

            }
            else{
                call_user_func_array(array($controller,$metodo));

            }

        }
        else{

           throw new Exception("No encontrado".$rutaControlador);
        }
    }//fin de la funcion run
}//fin de la clase