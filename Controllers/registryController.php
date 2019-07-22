<?php
class registryController extends Controller
{
 private $_regist;
    public function __construct()
    {
        parent::__construct();
        $this->_regist = $this->loadModel("registry");
    }

public function verificaruser()
{
    if($this->_regist-> verificaruser($this->getsql('user')))
        echo "El usuario ya existe";
    else
        echo '0';
}

public function verificarEmailp()
{
    if($this->_regist->verificarEmailp($this->getPostParam('EMAIL')))
        echo "El Correo ya existe";
    else
        echo '0';
}

    public function index()
    {
        $this->_view->titulo='Registro profesor';
        $this->_view->setJs(array("validacion"));

        if($this->getInt('enviarRegistro')==1){
            $this->_view->datos=$_POST;
             
    
            $this->_regist->insertarProfesor(
                   
                    $this->getsql('nameProf'),
                    $this->getsql('segNameProf'),
                    $this->getsql('apeProf'),
                    $this->getsql('segApeProf'),
                    $this->getsql('user'), 
                    $this->getsql('pass2'),
                    $this->getPostParam('EMAIL'),
                    $this->getsql('genero')
                   
                    );
                   if(!$this->_regist->verificaruser($this->getsql('user'))){
                        $this->_view->_error=  "Error al registrar el usuario";
                       $this->_view->renderizar('registry');
                        exit;
                        }   
                    $this->_view->datos = false;
                     $this->_view->_mensaje = "Registro Completado";
         
        
              } 
         $this->_view->renderizar('registry');
        
    }

   
}

?>