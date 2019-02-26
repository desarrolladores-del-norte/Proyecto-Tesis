<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 04/04/2017
 * Time: 03:14 PM
 */
class errorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->titulo='Error';
        $this->_view->mensaje=$this->_getError();
        $this->_view->renderizar('index');
    }
    public function access($codigo='default')
    {
        $this->_view->titulo='Error';
        $this->_view->mensaje=$this->_getError($codigo);
        $this->_view->renderizar('access');
    }

    private function _getError($codigo=false)
    {
        $error['default']="Ha ocurrido un Error y la la página no puede Mostrarse";
        $error['5050']="Acceso Restringido";
        $error['5051']="No tiene suficientes privilegios";
        $error['5052']="El tiempo de Sesion se ha agotado";

        if($codigo)
        {
            $codigo=$this->filtarInt($codigo);


        }
        else{

            return $error['default'];
        }

        if ((array_key_exists($codigo,$error)))
            return $error[$codigo];
        else
            return $error['default'];
    }

}