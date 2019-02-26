<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 30/03/2017
 * Time: 11:32 AM
 */
class ibiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        $this->_view->titulo='Alcaldia de Ocotal';

        $this->_view->renderizar('index','ibi');
    }

    public function ejemplo()
    {
        echo 'hola mundo';
    }

}