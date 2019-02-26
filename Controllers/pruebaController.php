<?php

class pruebaController extends Controller{

    private  $_prueba;

    public function __construct()
    {
        parent::__construct();
        $this->_prueba=$this->loadModel("prueba");
    }
    public function index()
    {
        SESSION::accesoEstricto(array('admin'));
       $tabla= $this->_prueba->mostrar_datos();
        $ta="";

        for($i=0;$i<count($tabla);$i++)
            $ta=$ta."<tr><td>".$tabla[$i]['nombre']."</td><td>".$tabla[$i]['edad']."</td></tr>";
        $this->_view->ta=$ta;
       $this->_view->renderizar('index');
    }

    public function mostrar_nombre($nombre){
        echo $nombre;
    }
}