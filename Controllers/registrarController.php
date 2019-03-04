<?php
class registrarController extends Controller
{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->renderizar('registrar');
    }

 

    public function agregar()
    {
        if($_POST)
        {
            $this->registrar->set("primerNombre",$_POST['first-name']);
            $this->registrar->set("segundoNombre",$_POST['segnom']);
            $this->registrar->set("primerApellido",$_POST['last-name']);
            $this->registrar->set("segundoApellido",$_POST['segap']);
            $this->registrar->set("primerNombre",$_POST['first-name']);
            $this->registrar->set("sexo",$_POST['first-name']);

        }
    }
}

?>