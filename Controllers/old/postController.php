<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 31/03/2017
 * Time: 08:39 AM
 */
class postController extends Controller
{
    private $_post;
    public function __construct()
    {
        parent::__construct();
       $this->_post= $this->loadModel('post');
    }

    public function index()
    {

        $datos= $this->_post->getReporte();

        $matricula=0;
        $imi=0;
        $ibi=0;
        $retenciones=0;
        $basura=0;
        $rotulo=0;
        $reporte_matricula="<h5>Tributo: Matrícula</h5>";
        $reporte_rotulo="<h5>Tributo: Rótulos</h5>";
        $reporte_imi="<h5>Tributo: Impuesto Sobre Ingresos</h5>";
        $reporte_ibi="<h5>Tributo: Impuesto Sobre Bienes Inmuebles</h5>";
        $reporte_retenciones="<h5>Tributo: Retenciones</h5>";
        $reporte_basura="<h5>Tributo: Basura</h5>";

        $reporte_rotulo=$reporte_rotulo."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";
        $reporte_matricula=$reporte_matricula."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";
        $reporte_imi=$reporte_imi."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";
        $reporte_ibi=$reporte_ibi."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";
        $reporte_retenciones=$reporte_retenciones."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";
        $reporte_basura= $reporte_basura."<table class='table table-hover'><tr><th>Factura</th><th>Contribuyente</th><th>Concepto</th><th>Monto</th><th>Fecha</th></tr>";

        for($i=0;$i<count($datos);$i++)
        {
            if($datos[$i]['Tributo']=='Matricula')
            {
                $matricula=$matricula+$datos[$i]['Monto'];
                $reporte_matricula=$reporte_matricula."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }

            if($datos[$i]['Tributo']=='Impuesto de Bienes Inmuebles')
            {
                $ibi=$ibi+$datos[$i]['Monto'];
                $reporte_ibi=$reporte_ibi."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }


            if($datos[$i]['Tributo']=='Impuesto Sobre Ingresos')
            {
                $imi=$imi+$datos[$i]['Monto'];
                $reporte_imi=$reporte_imi."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }

            if($datos[$i]['Tributo']=='Retenciones')
            {
                $retenciones=$retenciones+$datos[$i]['Monto'];
                $reporte_retenciones=$reporte_retenciones."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }

            if($datos[$i]['Tributo']=='Basura')
            {
                $basura=$basura+$datos[$i]['Monto'];
                $reporte_basura=$reporte_basura."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }

            if($datos[$i]['Tributo']=='Rotulo')
            {
                $rotulo=$rotulo+$datos[$i]['Monto'];
                $reporte_rotulo=$reporte_rotulo."<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            }
        }
        $reporte_matricula=$reporte_matricula."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$matricula."</b> </td><td></td></tr></table>";
        $reporte_basura=$reporte_basura."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$basura."</b> </td><td></td></tr></table>";
        $reporte_ibi=$reporte_ibi."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$ibi."</b> </td><td></td></tr></table>";
        $reporte_imi=$reporte_imi."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$imi."</b> </td><td></td></tr></table>";
        $reporte_retenciones=$reporte_retenciones."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$retenciones."</b> </td><td></td></tr></table>";
        $reporte_rotulo=$reporte_rotulo."<tr><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$rotulo."</b> </td><td></td></tr></table>";


        $this->_view->reporte=$reporte_matricula.$reporte_imi.$reporte_ibi.$reporte_basura.$reporte_rotulo.$reporte_retenciones;


        $this->_view->setJs(array('highcharts'));
        $this->_view->setJs(array('exporting'));

    $this->_view->titulo='Alcaldia Municipal de Ocotal';
    $this->_view->renderizar('index','inicio');





    }

    public function nuevo()
    {

        $this->_view->titulo='Nuevo Post';
        $this->_view->setJs(array('nuevo'));

        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;

            if(!$this->getTexto('titulo')){
                $this->_view->error='Debe Llenar el campo Titulo';
                $this->_view->renderizar('nuevo','post');
                exit;
            }
            if(!$this->getTexto('cuerpo')){
                $this->_view->error='Debe Llenar el campo Cuerpo';
                $this->_view->renderizar('nuevo','post');
                exit;
            }
            $this->_post->insertarPost($this->getTexto('titulo'),$this->getTexto('cuerpo'));
            $this->redireccionar('post');
        }

        $this->_view->renderizar('nuevo','post');
    }

    public function editar($id)
    {
        $this->_view->prueba=$id;

        if(!$this->filtarInt($id))
        {
            $this->redireccionar('post');
        }
        if(! $this->_post->obtenerPost($this->filtarInt($id)))
        {
            $this->redireccionar('post');
        }
        $this->_view->titulo='Editar Post';
        $this->_view->setJs(array('nuevo'));

        if($this->getInt('guardar')==1)
        {

            $this->_view->prueba="LLega aqui";
            $this->_view->datos=$_POST;

            if(!$this->getTexto('titulo')){
                $this->_view->error='Debe Llenar el campo Titulo';
                $this->_view->renderizar('editar','post');
                exit;
            }
            if(!$this->getTexto('cuerpo')){
                $this->_view->error='Debe Llenar el campo Cuerpo';
               $this->_view->renderizar('editar','post');
                exit;
            }

        // $resul=   $this->_post->editarPost($this->filtarInt($id),$this->getTexto('titulo'),$this->getTexto('cuerpo'));
            $resul=   $this->_post->editarPost($this->filtarInt($id),$this->getTexto('titulo'),$this->getTexto('cuerpo'));
                 $this->redireccionar('post');
        }
        $this->_view->datos=$this->_post->obtenerPost($this->filtarInt($id));
     $this->_view->renderizar('editar','post');


    }




    public function eliminar($id)
    {


        if(!$this->filtarInt($id))
        {
            $this->redireccionar('post');
        }
        if(! $this->_post->obtenerPost($this->filtarInt($id)))
        {
            $this->redireccionar('post');
        }

        $this->_post->eliminarPost($this->filtarInt($id));
        $this->redireccionar('post');


    }





}