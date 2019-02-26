<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 04/05/2017
 * Time: 11:53 AM
 */
class registroController extends Controller
{
    private $_registro;
    public function __construct()
    {
        parent::__construct();
        $this->_registro=$this->loadModel('registro');
    }

    public function index()
    {

        Session::acceso('especial');
        $listaUsuarios="";
      if(! Session::get('autenticado')){
            $this->redireccionar();
        }

        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));


        $usuariosRegistrados=$this->_registro->obtenerUsuarios();
        if(isset($usuariosRegistrados) && count($usuariosRegistrados)>0)
        {
            for($i=0;$i<count($usuariosRegistrados);$i++)
            {
                $listaUsuarios=$listaUsuarios. '<tr><td>'.$usuariosRegistrados[$i]['nombre'].'</td>
                    <td>'.$usuariosRegistrados[$i]['usuario'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['role'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['email'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['fecha_registro'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['estado'].'</td>'."
                <td><a  title='Editar'  class='btn btn-primary hidden-print' href='".BASE_URL."registro/editar/". $usuariosRegistrados[$i]['id']. "'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                <a onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\"  title='Eliminar' class='btn btn-warning hidden-print' href='".BASE_URL."registro/eliminar/". $usuariosRegistrados[$i]['id']. "'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
            }
        }
        $this->_view->listaUsuarios=$listaUsuarios;
        $this->_view->titulo=APP_COMPANY;

        if($this->getInt('registrar')==1)
        {
            if($this->_registro->verificarUsuario($this->getTexto('usuario')))
            {
                $this->_view->error="El usuario ya se ecuentra Registrado";
                $this->_view->renderizar('index','registro');
                exit;
            }
            if($this->_registro->verificarEmail($this->getTexto('email')))
            {
                $this->_view->error="El correo ya se ecuentra Registrado";
                $this->_view->renderizar('index','registro');
                exit;
            }
            $this->_registro->registroUsuario($this->getTexto('nombre'),$this->getTexto('usuario'),$this->getTexto('pass'),$this->getTexto('email'),$this->getTexto('role'),$this->getTexto('estado'),$this->getTexto('fecha'));
            $this->redireccionar('registro');
        }



        $this->_view->renderizar('index','registro');
    }


    public function editar($idu=false)
    {


        Session::acceso('especial');
        $listaUsuarios="";
        if(! Session::get('autenticado')){
            $this->redireccionar();
        }

        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));
        if($this->filtarInt($idu))
        {
            $usuarioe=$this->_registro->obtenerUsuario($this->filtarInt($idu));
            $this->_view->usuarioe=$usuarioe;
        }

        $usuariosRegistrados=$this->_registro->obtenerUsuarios();
        if(isset($usuariosRegistrados) && count($usuariosRegistrados)>0)
        {
            for($i=0;$i<count($usuariosRegistrados);$i++)
            {
                $listaUsuarios=$listaUsuarios. '<tr><td>'.$usuariosRegistrados[$i]['nombre'].'</td>
                    <td>'.$usuariosRegistrados[$i]['usuario'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['role'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['email'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['fecha_registro'].'</td>'.'
                    <td>'.$usuariosRegistrados[$i]['estado'].'</td>'."
                <td><a  title='Editar'  class='btn btn-primary hidden-print' href='".BASE_URL."registro/editar/". $usuariosRegistrados[$i]['id']. "'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                <a onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\"  title='Eliminar' class='btn btn-warning hidden-print' href='".BASE_URL."registro/eliminar/". $usuariosRegistrados[$i]['id']. "'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
            }
        }
        $this->_view->listaUsuarios=$listaUsuarios;
        $this->_view->titulo=APP_COMPANY;

        if($this->getInt('registrar')==1)
        {
            $pass_up=$usuarioe['pass'];
            if($pass_up!=$this->getTexto('pass'))
            $this->_registro->actualizarUsuario($this->getTexto('nombre'),$this->filtarInt($idu),$this->getTexto('pass'),$this->getTexto('email'),$this->getTexto('role'),$this->getTexto('estado'),$this->getTexto('fecha'));
            else
                $this->_registro->actualizarUsuario2($this->getTexto('nombre'),$this->filtarInt($idu),$this->getTexto('email'),$this->getTexto('role'),$this->getTexto('estado'),$this->getTexto('fecha'));

            $this->_view->renderizar('index','registro');
            exit;
        }



        $this->_view->renderizar('editar','registro');
    }

























    public function eliminar($id)
    {
        Session::acceso('especial');

        if(!$this->filtarInt($id))
        {
            $this->redireccionar('registro');
        }

        $this->_registro->eliminarUsuario($this->filtarInt($id));
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
}