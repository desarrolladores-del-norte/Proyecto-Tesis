<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 24/03/2017
 * Time: 02:47 PM
 * private $_estudiantes;
 * $this->_estudiantes = $this->loadModel('estudiantes');
 */
class indexController extends Controller
{


    public function __construct()
    {
        parent::__construct();
 $this->_log=$this->loadModel('loginProf');

    }

    public function index()
    {
        $this->_view->titulo = 'SACUR';
        $this->_view->setJs(array('funciones'));

        $this->_view->render('index');




         if($this->getInt('enviarProfesor')==1){
          $this->_view->datos=$_POST;
           if(!$this->getsql('users')){
               $this->_view->_error='Deve introducir el nombre de usuario ';
               $this->_view->renderizar('loginProf'); 
               exit;
           }
            if(!$this-> getSql('password')){
               $this->_view->_error='Deve introducir la contrase&ntilde;a del usuario';
               $this->_view->renderizar('loginProf');
               exit; 
           }
          $row=$this->_log->getprof(
              $this->getsql('users'),
              $this->getSql('password')
         );

         if(!$row){
              $this->_view->_error='Usuario y/o contrase&ntilde;a incorrecto';
               $this->_view->renderizar('loginProf');
               exit; 
         } 
        if($row['Estado'] !=1){
            $this->_view->_error='Este usuario no esta habilitado';
               $this->_view->renderizar('loginProf');
               exit; 
        } 
               Session::set('autenticado', true);
            //Session::set('level', $row['usuario']);
           // Session::set('usuario', $row['usuario']);
            Session::set('id_user', $row['idprofesor']);
            
             $this->redireccionar('profesor');   //pasar la siguiente vista si esta logiado          
          }











    }

}