<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 19/04/2017
 * Time: 03:38 PM
 */
class usuariosController extends Controller
{
    private $_usuarios,$_negocios_clientes,$propiedades_cliente,$lista_tributos_negocio ;
    public function __construct()
    {
        parent::__construct();
        $this->_usuarios=$this->loadModel('usuarios');

    }

    public function index($idco=false)
    {

        echo "Saludos usuario no Registrado";
    }

    public function pagos_general($idco=false,$id_fa=false,$estado)
    {


        if($idco){

        $datos_negocios="";
        $total_pagar=0;$deducciones=0; $mora=0;
        $this->_view->datos=$this->_usuarios->obtenerContribuyente($this->filtarInt($idco));
        $this->_negocios_clientes=$this->_usuarios->obtenerNegocios($this->filtarInt($idco));
        if (isset($this->_negocios_clientes) && count($this->_negocios_clientes)>0)
        {
            /********************************************************************   DATOS DE LOS TRIBUTOS DEL NEGOCIO    ***************************************************************/
            for($i=0;$i<count($this->_negocios_clientes);$i++)
            {
             //   $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Nombre del Negocio:".$this->_negocios_clientes[$i]['nombrenegocio']."</h5></div><div class='funkyradio  col-lg-2'><div class='funkyradio-warning'><input id='n".$this->_negocios_clientes[$i]['idn']."' type='checkbox' value='n".$this->_negocios_clientes[$i]['idn']."'> <label for='n".$this->_negocios_clientes[$i]['idn']."'>Agregar</label> </div></div>".
                if($estado==1)
                $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoNegocioPendiente($this->_negocios_clientes[$i]['idn']);
                else
                    $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoNegocio($this->_negocios_clientes[$i]['idn'],$id_fa);
                if(count($this->lista_tributos_negocio)>0){
                $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Nombre del Negocio:".$this->_negocios_clientes[$i]['nombrenegocio']."</h5></div>".
                "
    <table class='table table-striped'>
        <tr>
           
            <th >Tributo</th>
            <th>Descripcion</th>
            <th>Periodo</th>
            <th>Monto</th>
            <th>Mora</th>
            <th>Deduccion</th>
            <th>F_Emision</th>
            <th>F_Caducidad</th>
           
            </tr>";


                $total_negocio=0;
                $mora_negocio=0;
                $deducciones_negocio=0;
                for($a=0;$a<count($this->lista_tributos_negocio);$a++)
                {
                    $datos_negocios=$datos_negocios."<tr>
                
                <td >".$this->lista_tributos_negocio[$a]['tributo']."</td>
                <td >".$this->lista_tributos_negocio[$a]['descripcion']."</td>
                <td >".$this->lista_tributos_negocio[$a]['periodo']."</td>
                <td >C$ ".$this->lista_tributos_negocio[$a]['monto']."</td>
                <td >C$ ".$this->lista_tributos_negocio[$a]['multa']."</td>
                <td >C$ ".$this->lista_tributos_negocio[$a]['deduccion']."</td>
                <td >".$this->lista_tributos_negocio[$a]['fechaE']."</td>
                <td >".$this->lista_tributos_negocio[$a]['fechaC']."</td>
              
                </tr> ";
                    $total_pagar=$total_pagar+$this->lista_tributos_negocio[$a]['monto'];
                    $deducciones=$deducciones+$this->lista_tributos_negocio[$a]['deduccion'];
                    $deducciones_negocio=$deducciones_negocio+$this->lista_tributos_negocio[$a]['deduccion'];
                    $mora_negocio=$mora_negocio+$this->lista_tributos_negocio[$a]['multa'];
                    $mora=$mora+$this->lista_tributos_negocio[$a]['multa'];
                    $total_negocio=$total_negocio+$this->lista_tributos_negocio[$a]['monto'];
                }
                $datos_negocios=$datos_negocios.  "<tr><td></td><td></td><td></td><td><b>C$ $total_negocio</b></td><td><b>C$ $mora_negocio</b></td><td><b>C$ $deducciones_negocio</b></td><td></td><td></td></tr>";
                $datos_negocios=$datos_negocios."</table><br> <div class='hide tbn".$this->_negocios_clientes[$i]['idn']."'>$total_negocio</div>
                <div class='hide tmn".$this->_negocios_clientes[$i]['idn']."'>$mora_negocio</div>
                    <div class='hide tdn".$this->_negocios_clientes[$i]['idn']."'>$deducciones_negocio</div>";
            }
        }

            /********************************************************************   DATOS DE LOS TRIBUTOS DEL LA PROPIEDAD     ***************************************************************/
        $this->propiedades_cliente= $this->_usuarios->obtenerPropiedades($this->filtarInt($idco));
            if (isset($this->propiedades_cliente) && count($this->propiedades_cliente))
            {

               for($i=0;$i<count($this->propiedades_cliente);$i++)
                {
                             //   $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Codigo Catastral:".$this->propiedades_cliente[$i]['codigo']."</h5></div><div class='funkyradio  col-lg-2'><div class='funkyradio-warning'><input id='p".$this->propiedades_cliente[$i]['idp']."' type='checkbox' value='p".$this->propiedades_cliente[$i]['idp']."'> <label for='p".$this->propiedades_cliente[$i]['idp']."'>Agregar</label> </div></div>".
                    if($estado==1)
                    $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoPropiedadPendiente($this->propiedades_cliente[$i]['idp']);
                    else
                        $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoPropiedad($this->propiedades_cliente[$i]['idp'],$id_fa);
                    if(count($this->lista_tributos_negocio)>0){
                    $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Codigo Catastral:".$this->propiedades_cliente[$i]['codigo']."</h5></div>".
                                    "
                <table class='table table-striped'>
                    <tr >

                        <th >Tributo</th>
                        <th>Descripcion</th>
                        <th>Periodo</th>
                        <th>Monto</th>
                        <th>Mora</th>
                        <th>Deduccion</th>
                        <th>F_Emision</th>
                        <th>F_Caducidad</th>
                        
                        </tr>";


                                $total_propiedad=0;
                                $mora_propiedad=0;
                                $deducciones_propiedad=0;
                                for($a=0;$a<count($this->lista_tributos_negocio);$a++)
                                {
                                    $datos_negocios=$datos_negocios."<tr>

                            <td >".$this->lista_tributos_negocio[$a]['tributo']."</td>
                            <td >".$this->lista_tributos_negocio[$a]['descripcion']."</td>
                            <td >".$this->lista_tributos_negocio[$a]['periodo']."</td>
                            <td  >C$ ".$this->lista_tributos_negocio[$a]['monto']."</td>
                            <td >C$ ".$this->lista_tributos_negocio[$a]['multa']."</td>
                            <td >C$ ".$this->lista_tributos_negocio[$a]['deduccion']."</td>
                            <td >".$this->lista_tributos_negocio[$a]['fechaE']."</td>
                            <td >".$this->lista_tributos_negocio[$a]['fechaC']."</td>
                            
                            </tr> ";
                                    $total_pagar=$total_pagar+$this->lista_tributos_negocio[$a]['monto'];
                                    $deducciones=$deducciones+$this->lista_tributos_negocio[$a]['deduccion'];
                                    $deducciones_propiedad=$deducciones_propiedad+$this->lista_tributos_negocio[$a]['deduccion'];
                                    $mora=$mora+$this->lista_tributos_negocio[$a]['multa'];
                                    $mora_propiedad=$mora_propiedad+$this->lista_tributos_negocio[$a]['multa'];
                                    $total_propiedad=$total_propiedad+$this->lista_tributos_negocio[$a]['monto'];

                                }
                    $datos_negocios=$datos_negocios.  "<tr><td></td><td></td><td></td><td><b>C$ $total_propiedad</b></td><td><b>C$ $mora_propiedad</b></td><td><b>C$ $deducciones_propiedad</b></td><td></td><td></td></tr>";
                                $datos_negocios=$datos_negocios."</table><br><div class='hide tbp".$this->propiedades_cliente[$i]['idp']."'>$total_propiedad</div>
                                <div class='hide tmp".$this->propiedades_cliente[$i]['idp']."'>$mora_propiedad</div>
                                    <div class='hide tdp".$this->propiedades_cliente[$i]['idp']."'>$deducciones_propiedad</div>";
                }
                }

             }


}
       // setlocale(LC_MONETARY, 'en_US');
        // $total_paga= money_format('%.2n',$total_pagar);
        $this->_view->total_pagar=$total_pagar;
        $this->_view->deducciones=$deducciones;
        $this->_view->mora=$mora;
        $this->_view->total_general=$total_pagar+$mora-$deducciones;
        $this->_view->datos_negocios=$datos_negocios;
         if(!$id_fa){
        $idfa=$this->_usuarios->insertarFactura(date("d/m/Y"),($total_pagar+$mora-$deducciones));
        $this->_usuarios->insertarR_FA_NP($idco,$idfa);
         }
         else
        $idfa=$id_fa;

        $id_fa=$idfa;
        $this->_view->factura=$idfa;
            if($estado==0)
            $this->_view->estado='Pagada';
       $this->_view->renderizar('pagos_general','usuarios');

        }
        else
            echo "Error en la vista Cargada de las obligaciones";


        }



    public function usuario($idco=false)
    {
        $datos_negocios="";
        $this->_view->idco=$this->filtarInt($idco);
        $total_pagar=0;$deducciones=0; $mora=0;
        $this->_view->datos=$this->_usuarios->obtenerContribuyente($this->filtarInt($idco));
        $this->_negocios_clientes=$this->_usuarios->obtenerNegocios($this->filtarInt($idco));
        if (isset($this->_negocios_clientes) && count($this->_negocios_clientes)>0)
        {
            /********************************************************************   DATOS DE LOS TRIBUTOS DEL NEGOCIO    ***************************************************************/
            for($i=0;$i<count($this->_negocios_clientes);$i++)
            {
                //   $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Nombre del Negocio:".$this->_negocios_clientes[$i]['nombrenegocio']."</h5></div><div class='funkyradio  col-lg-2'><div class='funkyradio-warning'><input id='n".$this->_negocios_clientes[$i]['idn']."' type='checkbox' value='n".$this->_negocios_clientes[$i]['idn']."'> <label for='n".$this->_negocios_clientes[$i]['idn']."'>Agregar</label> </div></div>".
                $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Nombre del Negocio:".$this->_negocios_clientes[$i]['nombrenegocio']."</h5></div>".
                    "
        <table class='table table-striped'>
            <tr>


                <th>Monto</th>
                <th>Mora</th>
                <th>Deduccion</th>


                </tr>";

                $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoNegocioPendiente($this->_negocios_clientes[$i]['idn']);

                $total_negocio=0;
                $mora_negocio=0;
                $deducciones_negocio=0;
                for($a=0;$a<count($this->lista_tributos_negocio);$a++)
                {
                    $total_pagar=$total_pagar+$this->lista_tributos_negocio[$a]['monto'];
                    $deducciones=$deducciones+$this->lista_tributos_negocio[$a]['deduccion'];
                    $deducciones_negocio=$deducciones_negocio+$this->lista_tributos_negocio[$a]['deduccion'];
                    $mora_negocio=$mora_negocio+$this->lista_tributos_negocio[$a]['multa'];
                    $mora=$mora+$this->lista_tributos_negocio[$a]['multa'];
                    $total_negocio=$total_negocio+$this->lista_tributos_negocio[$a]['monto'];
                }
                $datos_negocios=$datos_negocios.  "<tr><td><b>C$ $total_negocio</b></td><td><b>C$ $mora_negocio</b></td><td><b>C$ $deducciones_negocio</b></td></tr>";
                $datos_negocios=$datos_negocios."</table><br> <div class='hide tbn".$this->_negocios_clientes[$i]['idn']."'>$total_negocio</div>
                <div class='hide tmn".$this->_negocios_clientes[$i]['idn']."'>$mora_negocio</div>
                    <div class='hide tdn".$this->_negocios_clientes[$i]['idn']."'>$deducciones_negocio</div>";
            }

            /********************************************************************   DATOS DE LOS TRIBUTOS DEL LA PROPIEDAD     ***************************************************************/
            $this->propiedades_cliente= $this->_usuarios->obtenerPropiedades($this->filtarInt($idco));
            if (isset($this->propiedades_cliente) && count($this->propiedades_cliente))
            {

                for($i=0;$i<count($this->propiedades_cliente);$i++)
                {
                    //   $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Codigo Catastral:".$this->propiedades_cliente[$i]['codigo']."</h5></div><div class='funkyradio  col-lg-2'><div class='funkyradio-warning'><input id='p".$this->propiedades_cliente[$i]['idp']."' type='checkbox' value='p".$this->propiedades_cliente[$i]['idp']."'> <label for='p".$this->propiedades_cliente[$i]['idp']."'>Agregar</label> </div></div>".
                    $datos_negocios=$datos_negocios."<div class='col-lg-10'><h5>Codigo Catastral:".$this->propiedades_cliente[$i]['codigo']."</h5></div>".
                        "
    <table class='table'>
        <tr >


            <th>Monto</th>
            <th>Mora</th>
            <th>Deduccion</th>


            </tr>";

                    $this->lista_tributos_negocio = $this->_usuarios->obtenerTributoPropiedadPendiente($this->propiedades_cliente[$i]['idp']);
                    $total_propiedad=0;
                    $mora_propiedad=0;
                    $deducciones_propiedad=0;
                    for($a=0;$a<count($this->lista_tributos_negocio);$a++)
                    {

                        $total_pagar=$total_pagar+$this->lista_tributos_negocio[$a]['monto'];
                        $deducciones=$deducciones+$this->lista_tributos_negocio[$a]['deduccion'];
                        $deducciones_propiedad=$deducciones_propiedad+$this->lista_tributos_negocio[$a]['deduccion'];
                        $mora=$mora+$this->lista_tributos_negocio[$a]['multa'];
                        $mora_propiedad=$mora_propiedad+$this->lista_tributos_negocio[$a]['multa'];
                        $total_propiedad=$total_propiedad+$this->lista_tributos_negocio[$a]['monto'];

                    }
                    $datos_negocios=$datos_negocios.  "<tr><td><b>C$ $total_propiedad</b></td><td><b>C$ $mora_propiedad</b></td><td><b>C$ $deducciones_propiedad</b></td></tr>";
                    $datos_negocios=$datos_negocios."</table><br>";
                }

            }


        }
        $FAC_PENDIENTES=false;
        $ListaFacturasPendientes=$this->_usuarios->obtenerFacturasPendientes($idco);
        $listafa="<table class='table table-striped'><tr><th>Factura</th><th>Fecha de Emisión</th><th>Monto</th><th>Estado</th><th>Acción</th></tr>";
        for($i=0;$i<count($ListaFacturasPendientes);$i++)
        {
            if($ListaFacturasPendientes[$i]['estad']=='Pendiente'){
            $listafa=$listafa."<tr><td>".$ListaFacturasPendientes[$i]['idfa']."</td><td>".$ListaFacturasPendientes[$i]['fechag']."</td><td>C$ ".$ListaFacturasPendientes[$i]['totalp']."</td><td>".$ListaFacturasPendientes[$i]['estad']."</td><td><a href='".BASE_URL.'usuarios/generar_factura/'.$idco."/".$ListaFacturasPendientes[$i]['idfa']."/1'<li class='btn btn-info fa fa-eye'></li></a><a onclick=\"if (!confirm('Está seguro que desea eliminar el registro?')) return false;\" href='".BASE_URL.'usuarios/eliminar/'.$ListaFacturasPendientes[$i]['idfa']."'><li class='btn btn-danger fa fa-trash'></li></a></td></tr>";
            $FAC_PENDIENTES=true;
            }
            else
                $listafa=$listafa."<tr><td>".$ListaFacturasPendientes[$i]['idfa']."</td><td>".$ListaFacturasPendientes[$i]['fechag']."</td><td>C$ ".$ListaFacturasPendientes[$i]['totalp']."</td><td>".$ListaFacturasPendientes[$i]['estad']."</td><td><a href='".BASE_URL.'usuarios/generar_factura/'.$idco."/".$ListaFacturasPendientes[$i]['idfa']."/0'<li class='btn btn-info fa fa-eye'></li></a></td></tr>";
        }
       $listafa=$listafa."</table>";
        $this->_view->total_pagar=$total_pagar;
        if($total_pagar==0 ||  $FAC_PENDIENTES)
            $this->_view->estadoboton="hide";
        else
            $this->_view->estadoboton="";

        $this->_view->deducciones=$deducciones;
        $this->_view->mora=$mora;
        $this->_view->total_general=$total_pagar+$mora-$deducciones;
        $this->_view->datos_negocios=$datos_negocios;
        $this->_view->FacturasPendientes=$listafa;
        $this->_view->renderizar('usuario','usuarios');
    }

    public function generar_factura($idco=false,$idfa=false,$estado=0)
    {
        if($idco)
        {
            if($idfa)
                $this->pagos_general($idco,$idfa,$estado);
            else
                $this->pagos_general($idco,$idfa,1);
        exit;
        }
    }
    public function eliminar($idfa=false)
    {
        if($idfa)
        {
            $this->_usuarios->eliminarFactura($idfa);

        }
        header("Location:".$_SERVER['HTTP_REFERER']);
    }



}