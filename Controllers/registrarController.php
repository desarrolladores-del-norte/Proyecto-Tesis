<?php
class registrarController extends Controller
{
 private $_registro;
    public function __construct()
    {
        parent::__construct();
        $this->_registro = $this->loadModel("registrar");
    }

public function verificarCarnet()
{
    if($this->_registro->verificarCarnet($this->getsql('carnetReg')))
        echo "El carnet ya existe";
    else
        echo '0';
}

public function verificarEmail()
{
    if($this->_registro->verificarEmail($this->getPostParam('EMAIL')))
        echo "El Correo ya existe";
    else
        echo '0';
}

    public function index()
    {
        $this->_view->titulo='Registro';
        $this->_view->setJs(array("validar"));

        if($this->getInt('enviarRegis')==1){
            $this->_view->datos=$_POST;
             
    
            $this->_registro->insertarestudiante(
                   
                    $this->getsql('carnetReg'),
                    $this->getsql('firstName'),
                    $this->getsql('segnom'),
                    $this->getsql('lastName'),
                    $this->getsql('segap'), 
                    $this->getsql('genero'),
                    $this->getsql('number'),
                    $this->getsql('departamento'),
                    $this->getsql('ciud'),
                    $this->getPostParam('EMAIL'),
                    $this->getsql('carrera'),
                    $this->getsql('pass2'),
                    $this->getsql('fnac') 
                   
                    );
                    if(!$this->_registro->verificarCarnet($this->getsql('carnetReg'))){
                        $this->_view->_error=  "Error al registrar el usuario";
                       $this->_view->render('registrar');
                        exit;
                        }   
                    $this->_view->datos = false;
                     $this->_view->_mensaje = "Registro Completado";
         
        
              } 
         $this->_view->render('registrar');
        
    }

   
}

?>