<?php
class indexController extends Controller
{
    private $_login;
 public function __construct()
 {
 parent::__construct();
 $this->_login=$this->loadModel('login');
 }

public function index()
    {
         /*if (Session::get('autenticado')) 
        {
      $this->_view->renderlon('index');
    }*/
        
        $this->_view->titulo = 'Iniciar Sesion';
       
      if($this->getInt('enviar')==1){
          $this->_view->datos=$_POST;
           if(!$this->getAlphaNum('usuario')){
               $this->_view->_error='Deve introducir el nombre de usuario';
               $this->_view->renderizar('index'); 
               exit;
           }
            if(!$this-> getSql('password')){
               $this->_view->_error='Deve introducir la contrase&ntilde;a de usuario';
               $this->_view->renderizar('index');
               exit; 
           }
          $row=$this->_login->getUsuario(
              $this->getAlphaNum('usuario'),
              $this->getSql('password')
         );

         if(!$row){
              $this->_view->_error='Usuario y/o contrase&ntilde;a incorrecto';
               $this->_view->renderizar('index');
               exit; 
         } 
        if($row['estado'] !=1){
            $this->_view->_error='Este usuario no esta habilitado';
               $this->_view->renderizar('index');
               exit; 
        } 
               Session::set('autenticado', true);
            //Session::set('level', $row['usuario']);
            Session::set('usuario', $row['usuario']);
           // Session::set('id_usuario', $row['id']);
            
             $this->redireccionar('student');   //pasar la siguiente vista si esta logiado          
          }
          $this->_view->renderizar('index');
     }


     public function cerrar()
     {
        
    Session::destroy();
        $this->renderizar('index');
     }
 



}//fin de la clase indexController
?>
 
 