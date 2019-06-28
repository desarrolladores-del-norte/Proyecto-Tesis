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

<<<<<<< HEAD
    private $_login;
 public function __construct()
 {
 parent::__construct();
 $this->_login=$this->loadModel('inicio');
 }

public function index()
    {
         $this->_view->titulo = 'SACUR';
         $this->_view->setJs(array('validar'));
       // $this->_view->setJs(array("validarLogin"));
        $this->_view->render('index');

// registrar estudiante
        if($this->getInt('enviarRegisEst')==1){
            $this->_view->datos=$_POST;
              $this->_login->insertarestudiante(
                   
                    $this->getsql('carnetReg'),
                    $this->getsql('Name'),
                    $this->getsql('apellido'), 
                    $this->getsql('genero'),
                    $this->getsql('number'),
                    $this->getsql('departamento'),
                    $this->getsql('ciud'),
                    $this->getPostParam('EMAIL'),
                    $this->getsql('carrera'),
                    $this->getsql('pass2'),
                    $this->getsql('fnac') 
                   
                    );
                    if(!$this->_login->verificarCarnet($this->getsql('carnetReg'))){
                        $this->_view->_error=  "Error al registrar el usuario";
                       $this->_view->render('registrar');
                        exit;
                        }   
                    $this->_view->datos = false;
                     $this->_view->_mensaje = "Registro Completado";
         
        
              } //fin del if enviarRegisEst
       //  $this->_view->render('registrar');
        
     // Registro Profesor
     if($this->getInt('env_regist_prof')==1){
        $this->_view->datos=$_POST;
         

        $this->_login->insertarProfesor(
               
                $this->getsql('nameProf'),
                $this->getsql('apellidoProf'),
                $this->getsql('user'), 
                $this->getsql('pass2'),
                $this->getsql('genero'),
                $this->getPostParam('EMAIL'),
                $this->getsql('carrera')
               
                );
               if(!$this->_login->verificaruser($this->getsql('user'))){
                    $this->_view->_error=  "Error al registrar el usuario";
               //    $this->_view->renderizar('registry');
                    exit;
                    }   
                $this->_view->datos = false;
                 $this->_view->_mensaje = "Registro Completado";
     
    
          } 
     $this->_view->render('index');  
    } 
      
                        
public function cerrar()
     {
         Session::destroy();
        $this->render('index');
     }
  
public function verificarCarnet()
     {
         if($this->_login->verificarCarnet($this->getsql('carnetReg')))
             echo "El carnet ya existe";
         else
             echo '0';
     }
     
public function verificarEmail()
     {
         if($this->_login->verificarEmail($this->getPostParam('EMAIL')))
             echo "El Correo ya existe";
         else
             echo '0';
     }
public function verificaruser()
     {
         if($this->_login-> verificaruser($this->getsql('user')))
             echo "El usuario ya existe";
         else
             echo '0';
     }
     
public function verificarEmailp()
     {
         if($this->_login->verificarEmailp($this->getPostParam('EMAIL')))
             echo "El Correo ya existe";
         else
             echo '0';
     }


}//fin de la clase indexController
?>
 
=======

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
>>>>>>> 1f1356aebe58dd2af9110cccd2dbd722c7601c42
