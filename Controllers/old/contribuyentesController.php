<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 06/04/2017
 * Time: 08:28 AM
 */

class contribuyentesController extends Controller
{
    private $_clientes;
    private $_ruc_clientes;

    public function __construct()
    {
        parent::__construct();
        $this->_clientes=$this->loadModel('contribuyentes');
        //$this->_ruc_clientes=0;
    }
    public function index()
    {
        $tablap='';

        Session::acceso('especial');
        $clientesc= $this->_clientes->getContribuyentes();

        $this->_view->clientes= $this->_clientes->getContribuyentes();






        if (isset($clientesc) && count($clientesc))
        {
            $tablap=$tablap. "<table class='table table-striped table-bordered' id='Jtabla'>
    <thead>
    <tr><th>Detalles</th></tr></thead><tbody>";

            for($i=0;$i<count($clientesc);$i++)
            {


                $tablap=$tablap.

                    "<tr><td><div class='container'><div class='row'>
<div class='col-lg-12 caracteristicas'>
<table class='table'>
<tr class='cabezat'><th>Nombre</th><th>Identificación</th><th>Dirección</th><th>Expediente</th><th>Tipo</th><th class='col-lg-2'>Acciones</th></tr>
<tr class='cuerpot'>
  <td>             <div>".$clientesc[$i]['nombre']."</div> </td>
  <td>         <div>".$clientesc[$i]['RUC']."</div> </td>
  <td>           <div>".$clientesc[$i]['direccion']."</div> </td>
  <td>           <div>".$clientesc[$i]['expediente']."</div> </td>
  <td>            <div>".$clientesc[$i]['tipo_persona']."</div> </td>

   <td>             <div class=''><p> <a class='btn btn-info hidden-print' title='Editar' href='".BASE_URL."contribuyentes/editar/". $clientesc[$i]['idc']. "'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                <a class='btn btn-default hidden-print' title='Estado de Cuenta' href='".BASE_URL."usuarios/usuario/". $clientesc[$i]['idc']. "'><i class='fa fa-bank ' aria-hidden='true'></i></a>
               <a  onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\" class='btn btn-danger eliminar_contribuyente hidden-print' title='Eliminar'  href='".BASE_URL."contribuyentes/eliminar/". $clientesc[$i]['idc']. "' ><i class='fa fa-trash ' aria-hidden='true'></i></a></p></div>


</td>
</tr>
</table>
</div>

<br>
      <div class='col-lg-12'>

<div class='panel-group'>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      <h4 class='panel-title'>
        <a data-toggle='collapse' href='#collapse".$i."'>Obligaciones </a>
      </h4>
    </div>
    <div id='collapse".$i."' class='panel-collapse collapse'>
      <div class='panel-body'>

 <div class='containert'>
   <!-- start header here-->
	<headert>
<div id='fdw-pricing-table'>";




$negocios_clientes= $this->_clientes->obtenerNegocios($clientesc[$i]['idc']);
if (isset($negocios_clientes) && count($negocios_clientes))
{


    for($in=0;$in<count($negocios_clientes);$in++)
    {

        $tablap=$tablap.   "<div class='plan plan3'>
        <div class='headert'>NEGOCIO</div>
        <div class=''>".$negocios_clientes[$in]['nombrenegocio']."</div>
        <div class='monthly'>NOMBRE</div>
        <ul>
            <li><b>Matrícula:</b> ".$negocios_clientes[$in]['matricula']."</li>
            <li><b>Tipo:</b> ".$negocios_clientes[$in]['tipo']."</li>
            <li><b>Clasificación:</b> ".$negocios_clientes[$in]['clasificacion']."</li>

        </ul>
        <a class='btn btn-info  hidden-print' title='Editar' href='".BASE_URL."contribuyentes/editar_negocio/". $negocios_clientes[$in]['idn'].  "'><i class='fa  fa-pencil' aria-hidden='true'></i></a>
                <a class='btn btn-default  hidden-print' title='Cargar Cobro' href='".BASE_URL."contribuyentes/pago_negocio/". $negocios_clientes[$in]['idn']. "'><i class='fa  fa-usd' aria-hidden='true'></i></a>
                <a onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\" class='btn btn-danger  hidden-print' title='Eliminar' href='".BASE_URL."contribuyentes/eliminar_negocio/". $negocios_clientes[$in]['idn']. "'><i class='fa  fa-trash' aria-hidden='true'></i></a></p>
    </div>";

        }


}

$propiedades_clientes= $this->_clientes->obtenerPropiedades(($clientesc[$i]['idc']));
 if(isset($propiedades_clientes) && count($propiedades_clientes))
 {
     for($ip=0;$ip<count($propiedades_clientes);$ip++)
     {



         $tablap=$tablap."  <div class='plan plan4'>
        <div class='headert propi'>PROPIEDAD</div>
        <div class=''>".$propiedades_clientes[$ip]['codigo']."</div>
        <div class='monthly'>Código Catastral</div>
        <ul>
            <li><b>Barrio:</b>".$propiedades_clientes[$ip]['barrio']."</li>
            <li><b>Dirección:</b>".$propiedades_clientes[$ip]['direccion']."</li>

        </ul>
        <a class='btn btn-info hidden-print' title='Editar' href='".BASE_URL."contribuyentes/editar_propiedad/". $propiedades_clientes[$ip]['idp']. "'><i class='fa  fa-pencil' aria-hidden='true'></i></a>
                <a class='btn btn-default hidden-print' title='Cargar Cobro' href='".BASE_URL."contribuyentes/pago_propiedad/". $propiedades_clientes[$ip]['idp']. "'><i class='fa  fa-usd' aria-hidden='true'></i></a>
                <a onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\" class='btn btn-danger hidden-print' title='Eliminar' href='".BASE_URL."contribuyentes/eliminar_propiedad/". $propiedades_clientes[$ip]['idp']. "'><i class='fa  fa-trash' aria-hidden='true'></i></a>
    </div>";






     }
 }






$tablap=$tablap."</div>
	</headert><!-- end header -->

</div>

  </div>
</div>

  </div>


 </div>
        </div>

        </div></td></tr>";



            }
            $tablap=$tablap. '</tbody></table>';
        }
        else
            $tablap=$tablap. 'No existen datos';




        $this->_view->tablap= $tablap;
        $this->_view->titulo='Alcaldia Municipal de Ocotal';
        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));
        $this->_view->renderizar('index','contribuyentes');

    }

    public function lista_negocios()
    {
        Session::acceso('especial');
        $this->_view->lista_negocios= $this->_clientes->getListaNegocios();
        $this->_view->titulo='Alcaldia Municipal de Ocotal';
        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));
        $this->_view->renderizar('lista_negocios','contribuyentes');

    }


    public function lista_propiedades()
    {
        Session::acceso('especial');
        $this->_view->lista_propiedades= $this->_clientes->getListaPropiedades();
        $this->_view->titulo='Alcaldia Municipal de Ocotal';
        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));
        $this->_view->renderizar('lista_propiedades','contribuyentes');

    }





    public function nuevo($ruc_con=false)
    {

        //Session::accesoEstricto(array('admin'));
        Session::acceso('especial');



        $this->_view->titulo='Nuevo Contribuyente';
        $this->_view->setJs(array('nuevo'));
        $this->_view->clase_obligacion='hide';

       if($ruc_con){
            $idco= $this->_clientes->obtenerIdnco($ruc_con);
            $this->_view->negocios_clientes= $this->_clientes->obtenerNegocios($this->filtarInt($idco['idc']));
           $this->_view->propiedades_clientes= $this->_clientes->obtenerPropiedades($this->filtarInt($idco['idc']));

           $this->_view->datos=$this->_clientes->obtenerContribuyente($this->filtarInt($idco['idc']));
           $this->_view->con_ruc=$ruc_con;
            $this->_view->clase_obligacion=false;

        }

        if($this->getInt('agregar')==1)
           {
            $this->_view->datos=$_POST;

            if(!$this->getTexto('RUC')){

                $this->_view->renderizar('nuevo','contribuyentes');
                exit;
            }
               if(!$this->getTexto('nombre')){

                   $this->_view->renderizar('nuevo','contribuyentes');
                   exit;
               }

               if(!$this->getTexto('clave_acceso')){

                   $this->_view->renderizar('nuevo','contribuyentes');
                   exit;
               }

               if($this->_clientes->obtenerRUC($this->getTexto('RUC'))){
                   $this->_view->errores="<script>alert('El Numero de Identificación ya existe');</script>";
                   $this->_view->renderizar('nuevo','contribuyentes');
                   exit;
               }



               /*if($this->_clientes->obtenerExpediente($this->getTexto('expediente'))){
                   $this->_view->errores="<script>alert('El Numero de Expediente ya existe');</script>";
                   $this->_view->renderizar('nuevo','contribuyentes');
                   exit;
               }
                */



               $this->_ruc_clientes=$this->getTexto('RUC');
               $id_insertado=$this->_clientes->insertarContribuyente($this->getTexto('RUC'),$this->getTexto('nombre'),$this->getTexto('direccion'),$this->getTexto('telefono'),$this->getTexto('email'),$this->getTexto('tipo_persona'),$this->getTexto('clave_acceso'),$this->getTexto('fecha_registro'),$this->getTexto('expediente'));
               $this->_view->clase_obligacion=false;

               $this->redireccionar('contribuyentes/nuevo/'.$this->filtarInt($ruc_con));

               exit;

        }


        if($this->getInt('agregarnegocio')==1)
        {
            if($this->_clientes->obtenerMatricula($this->getTexto('matricula'))){
                $this->_view->errores="<script>alert('El Numero de Matrícula ya existe');</script>";
                $this->_view->renderizar('nuevo','contribuyentes');
                exit;
            }

            $this->_view->titulo='Alcaldía Municipal de Ocotal';
            $idco= $this->_clientes->obtenerIdnco($ruc_con);
            $this->_view->datos=$this->_clientes->obtenerContribuyente($this->filtarInt($idco['idc']));
            $this->_clientes->insertarNegocio($this->filtarInt($idco['idc']),$this->getTexto('tipo'),$this->getTexto('clasificacion'),$this->getTexto('barrio'),$this->getTexto('nombrenegocio'),$this->getTexto('direccion'),$this->getTexto('matricula'),$this->getTexto('telefono'),$this->getTexto('email'),$this->getTexto('descripcion'));
            $this->redireccionar('contribuyentes/nuevo/'.$ruc_con);

        }


        if($this->getInt('agregarpropiedad')==1)
        {

            if($this->_clientes->obtenerCodigoCatastral($this->getTexto('codigo'))){
                $this->_view->errores="<script>alert('El Código Catastral ya existe');</script>";
                $this->_view->renderizar('nuevo','contribuyentes');
                exit;
            }

            $this->_view->titulo='Alcaldía Municipal de Ocotal';
            $idco= $this->_clientes->obtenerIdnco($ruc_con);
            $this->_view->datos=$this->_clientes->obtenerContribuyente($this->filtarInt($idco['idc']));
            $this->_clientes->insertarPropiedad($this->filtarInt($idco['idc']),$this->getTexto('codigo'),$this->getTexto('valor'),$this->getTexto('excepcion'),$this->getTexto('direccion'),$this->getTexto('barrio'),$this->getTexto('descripcion'));
            $this->redireccionar('contribuyentes/nuevo/'.$ruc_con);

        }




        $this->_view->renderizar('nuevo','contribuyentes');



    }


    public function editar($idco)
    {
        Session::acceso('especial');
        $this->_view->datos=$this->_clientes->obtenerContribuyente($this->filtarInt($idco));
        $this->_view->negocios_clientes= $this->_clientes->obtenerNegocios($idco);
        $this->_view->propiedades_clientes= $this->_clientes->obtenerPropiedades($this->filtarInt($idco));
        $this->_view->id_contribuyente=$idco;
        $this->_view->clase_obligacion=false;
        $this->_view->setJs(array('nuevo'));


        if($this->getInt('agregar')==1)
        {
            $this->_view->datos=$_POST;

            if(!$this->getTexto('RUC')){

                $this->_view->renderizar('editar','contribuyentes');
                exit;
            }
            if(!$this->getTexto('nombre')){

                $this->_view->renderizar('editar','contribuyentes');
                exit;
            }

            if(!$this->getTexto('clave_acceso')){
                $this->_view->errores="<script>alert($this->getTexto('clave_acceso'))</script>";
                $this->_view->renderizar('editar','contribuyentes');
                exit;
            }
            $this->_ruc_clientes=$this->getTexto('RUC');
            $this->_clientes->actualizarContribuyente($this->getTexto('RUC'),$this->getTexto('nombre'),$this->getTexto('direccion'),$this->getTexto('telefono'),$this->getTexto('email'),$this->getTexto('tipo_persona'),$this->getTexto('clave_acceso'),$this->getTexto('fecha_registro'),$this->filtarInt($idco),$this->getTexto('expediente'));
            $this->_view->clase_obligacion=false;

            $this->redireccionar('contribuyentes/editar/'.$this->filtarInt($idco));

            exit;

        }

        if($this->getInt('agregarnegocio')==1)
        {
            if($this->_clientes->obtenerMatricula($this->getTexto('matricula'))){
                $this->_view->errores="<script>alert('El Numero de Matrícula ya existe');</script>";
                $this->_view->renderizar('nuevo','contribuyentes');
                exit;
            }
            $this->_clientes->insertarNegocio($this->filtarInt($idco),$this->getTexto('tipo'),$this->getTexto('clasificacion'),$this->getTexto('barrio'),$this->getTexto('nombrenegocio'),$this->getTexto('direccion'),$this->getTexto('matricula'),$this->getTexto('telefono'),$this->getTexto('email'),$this->getTexto('descripcion'));
            $this->redireccionar('contribuyentes/editar/'.$this->filtarInt($idco));

        }


        if($this->getInt('agregarpropiedad')==1)
        {

            if($this->_clientes->obtenerCodigoCatastral($this->getTexto('codigo'))){
                $this->_view->errores="<script>alert('El Código Catastral ya existe');</script>";
                $this->_view->renderizar('nuevo','contribuyentes');
                exit;
            }

            $this->_clientes->insertarPropiedad($this->filtarInt($idco),$this->getTexto('codigo'),$this->getTexto('valor'),$this->getTexto('excepcion'),$this->getTexto('direccion'),$this->getTexto('barrio'),$this->getTexto('descripcion'));
            $this->redireccionar('contribuyentes/editar/'.$this->filtarInt($idco));

        }




        $this->_view->renderizar('editar','contribuyentes');
    }


    public function eliminar($idco)
    {
        Session::acceso('especial');

        if(!$this->filtarInt($idco))
        {
            $this->redireccionar('post');
        }

        if(! $this->_clientes->obtenerContribuyente($this->filtarInt($idco)))
        {
            $this->redireccionar('contribuyente');
        }

         $this->_clientes->eliminarContribuyente($this->filtarInt($idco));
        $this->redireccionar('contribuyentes');


    }



    public function eliminar_negocio($idn)
    {
        Session::acceso('especial');
        if(!$this->filtarInt($idn))
        {
            $this->redireccionar('contribuyentes');
        }


        $this->_clientes->eliminarNegocio($this->filtarInt($idn));
        header("Location:".$_SERVER['HTTP_REFERER']);


    }


    public function eliminar_propiedad($idp)
    {
        Session::acceso('especial');
        if(!$this->filtarInt($idp))
        {
            $this->redireccionar('contribuyentes');
        }


        $this->_clientes->eliminarPropiedad($this->filtarInt($idp));
        header("Location:".$_SERVER['HTTP_REFERER']);


    }




    public function negocios($ruc_con=false)
    {
        Session::acceso('especial');
        if($ruc_con){
            $idco= $this->_clientes->obtenerIdnco($ruc_con);
            $this->_view->negocios_clientes= $this->_clientes->obtenerNegocios($this->filtarInt($idco['idc']));
            $this->_view->clase_obligacion=false;
            $this->_view->renderizar('negocios','contribuyentes');
        }
        else
        $this->_view->renderizar('contribuyentes','contribuyentes');
    }


    public function pago_negocio($idne)
    {
        Session::acceso('especial');

        $dato_negocio=$this->_clientes->obtenerDatosNegocio($this->filtarInt($idne));
        $this->_view->lista_tributos_negocio = $this->_clientes->obtenerTributoNegocio($this->filtarInt($idne));
        if($dato_negocio)
            $this->_view->nombre_negocio=$dato_negocio['nombrenegocio'];
        else
            $this->_view->nombre_negocio='No retorno Datos';

        if($this->getInt('agregar')==1 )
        {

            $this->_clientes->insertarTributoNegocio($this->filtarInt($idne),$this->getTexto('tributo'),$this->getTexto('descripcion'),$this->getTexto('periodo'),$this->getTexto('monto'),$this->getTexto('multa'),$this->getTexto('deduccion'),$this->getTexto('fechae'),$this->getTexto('fechac'),$this->getTexto('estado'));
            $this->_view->lista_tributos_negocio = $this->_clientes->obtenerTributoNegocio($this->filtarInt($idne));
            $this->redireccionar('contribuyentes/pago_negocio/'.$idne);
            exit;

        }


        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));


        $this->_view->renderizar('pago_negocio','contribuyentes');

    }

    public function eliminar_tributo_negocio($id){
        Session::acceso('especial');

        if(!$this->filtarInt($id))
        {
            $this->redireccionar('contribuyentes');
        }


        $this->_clientes->eliminarTributoNegocio($this->filtarInt($id));
        header("Location:".$_SERVER['HTTP_REFERER']);

    }

    public function editar_negocio($idn)
    {
        Session::acceso('especial');
        $id=$idn;
        $dato_negocio=$this->_clientes->obtenerDatosNegocio($this->filtarInt($idn));

        if($dato_negocio){
            $this->_view->nombre_negocio=$dato_negocio['nombrenegocio'];
            $this->_view->dato_negocio=$dato_negocio;
        }
        else
            $this->_view->nombre_negocio='No retorno Datos';


        if($this->getInt('editarnegocio')==1)
        {

            $this->_clientes->actualizarNegocio($id,$this->getTexto('tipo'),$this->getTexto('clasificacion'),$this->getTexto('barrio'),$this->getTexto('nombrenegocio'),$this->getTexto('direccion'),$this->getTexto('matricula'),$this->getTexto('telefono'),$this->getTexto('email'),$this->getTexto('descripcion'));
            $this->redireccionar('contribuyentes/editar/'.$dato_negocio['idco'],'contribuyentes');
        }

        $this->_view->renderizar('editar_negocio','contribuyentes');

    }


    public function editar_propiedad($idp)
    {
        Session::acceso('especial');
        $id=$idp;
        $dato_propiedad=$this->_clientes->obtenerDatosPropiedad($this->filtarInt($idp));


        if($this->getInt('editarpropiedad')==1)
        {

        $this->_clientes->actualizarPropiedad($this->filtarInt($idp),$this->getTexto('codigo'),$this->getTexto('valor'),$this->getTexto('excepcion'),$this->getTexto('direccion'),$this->getTexto('barrio'),$this->getTexto('descripcion'));
        $this->redireccionar('contribuyentes/editar/'.$dato_propiedad['idco']);

        }

        $this->_view->datosp= $dato_propiedad;
        $this->_view->renderizar('editar_propiedad','contribuyentes');

    }




    public function pago_propiedad($idnp)
    {
        Session::acceso('especial');
        $dato_propiedad=$this->_clientes->obtenerDatosPropiedad($this->filtarInt($idnp));
        $this->_view->lista_tributos_propiedad = $this->_clientes->obtenerTributoPropiedad($this->filtarInt($idnp));
        if($dato_propiedad)
            $this->_view->codigo_propiedad=$dato_propiedad['codigo'];
        else
            $this->_view->nombre_propiedad='No retorno Datos';

        if($this->getInt('agregar')==1)
        {

            $this->_clientes->insertarTributoPropiedad($this->filtarInt($idnp),$this->getTexto('tributo'),$this->getTexto('descripcion'),$this->getTexto('periodo'),$this->getTexto('monto'),$this->getTexto('multa'),$this->getTexto('deduccion'),$this->getTexto('fechae'),$this->getTexto('fechac'),$this->getTexto('estado'));
            $this->_view->lista_tributos_propiedad = $this->_clientes->obtenerTributoPropiedad($this->filtarInt($idnp));
            $this->redireccionar('contribuyentes/pago_propiedad/'.$idnp);

        }


        $this->_view->setJs(array('datatables.min'));
        $this->_view->setJs(array('contribuyentes'));
        $this->_view->setJs(array('dataTables.bootstrap.min'));

        $this->_view->renderizar('pago_propiedad','contribuyentes');

    }

    public function eliminar_tributo_propiedad($id){
        Session::acceso('especial');

        if(!$this->filtarInt($id))
        {
            $this->redireccionar('contribuyentes');
        }


        $this->_clientes->eliminarTributoPropiedad($this->filtarInt($id));
        header("Location:".$_SERVER['HTTP_REFERER']);

    }


}