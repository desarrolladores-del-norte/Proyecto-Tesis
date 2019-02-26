<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 5/06/17
 * Time: 08:09 AM
 */
class pagosController extends Controller
{
    private $_clientes;
    public function __construct()
    {
        parent::__construct();
        $this->_clientes=$this->loadModel('pagos');
    }

    public function index()
    {
        Session::acceso('especial');

      if($this->getInt('buscarf')==1)
        {

            if($this->getTexto('nfactura'))
            {
            $facturacliente= $this->_clientes->obtenerFactura($this->getTexto('nfactura'));
            if(isset($facturacliente) && count($facturacliente)>0)
            {
                $this->_view->datos= count($facturacliente);
                if($facturacliente['estado']=='Pendiente')
                {
                $this->_view->factura=$this->getTexto('nfactura');
                $this->_view->datos=count($facturacliente);
                $this->_view->estado=$facturacliente['estado'];
                $this->_view->total_pagar=$facturacliente['total_pagar'];
                $this->_view->fechagenerado=$facturacliente['fechagenerado'];
                }
                else
                  $this->_view->datos=2;
            }
                else
                    $this->_view->datos=1;

            }
        }

        if($this->getInt('pagarf')==1)
        {
            if($this->getTexto('boleta') || $this->getTexto('forma_pago') )
            {
            $resul=$this->_clientes->actualizarFactura($this->getTexto('nfacturap'),$this->getTexto('boleta'),$this->getTexto('forma_pago'),$this->getTexto('observacion'));
            if($resul)
            $this->_view->mensaje= "<script>alert('Operación realizada con Exito...');</script>";
            else
            $this->_view->mensaje= "<script>alert('Operación Fallida...');</script>";
            }
            else
            $this->_view->mensaje= "<script>alert('Operación Fallida, Debe llenar los Campos...');</script>";
        }


        $this->_view->renderizar('index');


    }

    public function pagos($idfa=false)
    {



    }

}