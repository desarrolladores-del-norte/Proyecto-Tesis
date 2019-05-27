<?php
class loginEstController extends Controller
{
    private $_login;
 public function __construct()
 {
 parent::__construct();
 $this->_login=$this->loadModel('loginEst');
 }

public function index()
    {
         /*if (Session::get('autenticado')) 
        {
      $this->_view->renderlon('index');
    }*/
        
        $this->_view->titulo = 'Iniciar Sesion Estudiante';
       
      if($this->getInt('enviar')==1){
          $this->_view->datos=$_POST;
           if(!$this->getsql('carnet')){
               $this->_view->_error='Deve introducir el Carnet ';
               $this->_view->renderizar('loginEst'); 
               exit;
           }
            if(!$this-> getSql('password')){
               $this->_view->_error='Deve introducir la contrase&ntilde;a de usuario';
               $this->_view->renderizar('loginEst');
               exit; 
           }
          $row=$this->_login->getUsuario(
              $this->getsql('carnet'),
              $this->getSql('password')
         );

         if(!$row){
              $this->_view->_error='Carnet y/o contrase&ntilde;a incorrecto';
               $this->_view->renderizar('loginEst');
               exit; 
         } 
        if($row['Estado'] !=1){
            $this->_view->_error='Este usuario no esta habilitado';
               $this->_view->renderizar('loginEst');
               exit; 
        } 
               Session::set('autenticado', true);
            //Session::set('level', $row['usuario']);
           // Session::set('usuario', $row['usuario']);
            Session::set('id_usuario', $row['carnet']);
            
             $this->redireccionar('student');   //pasar la siguiente vista si esta logiado          
          }
          $this->_view->renderizar('loginEst');
     }


     public function cerrar()
     {
        
    Session::destroy();
        $this->renderizar('loginEst');
     }
 



}//fin de la clase indexController
?>
 
 