<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 22/06/17
 * Time: 11:44 AM
 */
class reporteController extends Controller
{
private $_reporte;

    public function __construct()
    {
        parent::__construct();
        $this->_reporte= $this->loadModel('reporte');
    }

    public function index()
    {
        Session::acceso('especial');
        $this->_view->titulo='Alcaldia Municipal de Ocotal';
        $this->_view->renderizar('index','inicio');

    }


    public function reporte()
    {

        Session::acceso('especial');

        $fecha1=$this->getTexto('fecha1');
        $fecha2=$this->getTexto('fecha2');
        $contribuyente=$this->getTexto('contribuyente');

        $datos= $this->_reporte->getReporte($fecha1,$fecha2,$contribuyente);
        $reporte="";
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


        $dato_linea_0="<table class='table table-hover'><tr class='alert-success'><th class='col-lg-1'>Factura</th><th class='col-lg-1'>Boleta</th><th class='col-lg-3'>Contribuyente</th><th class='col-lg-4'>Concepto</th><th class='col-lg-2'>Monto</th><th class='col-lg-1'>Fecha</th></tr>";

        $reporte_rotulo=$reporte_rotulo.$dato_linea_0;
        $reporte_matricula=$reporte_matricula.$dato_linea_0;
        $reporte_imi=$reporte_imi.$dato_linea_0;
        $reporte_ibi=$reporte_ibi.$dato_linea_0;
        $reporte_retenciones=$reporte_retenciones.$dato_linea_0;
        $reporte_basura= $reporte_basura.$dato_linea_0;

        for($i=0;$i<count($datos);$i++)
        {
            $dato_linea="<tr><td>".$datos[$i]['fact']."</td><td>".$datos[$i]['boleta']."</td><td>".$datos[$i]['Contribuyente']."</td><td>".$datos[$i]['Concepto']."</td><td>C$ ".$datos[$i]['Monto']."</td><td>".$datos[$i]['fechapago']."</td></tr>";
            if($datos[$i]['Tributo']=='Matricula' && (isset($_POST['matricula'])||isset($_POST['todos'])))
            {
                $matricula=$matricula+$datos[$i]['Monto'];
                $reporte_matricula=$reporte_matricula.$dato_linea;
            }

            if($datos[$i]['Tributo']=='Impuesto de Bienes Inmuebles' && (isset($_POST['ibi']) ||isset($_POST['todos'])))
            {
                $ibi=$ibi+$datos[$i]['Monto'];
                $reporte_ibi=$reporte_ibi.$dato_linea;
            }


            if($datos[$i]['Tributo']=='Impuesto Sobre Ingresos' && (isset($_POST['imi']) ||isset($_POST['todos'])) )
            {
                $imi=$imi+$datos[$i]['Monto'];
                $reporte_imi=$reporte_imi.$dato_linea;
            }

            if($datos[$i]['Tributo']=='Retenciones' && (isset($_POST['retenciones']) ||isset($_POST['todos'])) )
            {
                $retenciones=$retenciones+$datos[$i]['Monto'];
                $reporte_retenciones=$reporte_retenciones.$dato_linea;
            }

            if($datos[$i]['Tributo']=='Basura' && (isset($_POST['basura']) ||isset($_POST['todos'])) )
            {
                $basura=$basura+$datos[$i]['Monto'];
                $reporte_basura=$reporte_basura.$dato_linea;
            }

            if($datos[$i]['Tributo']=='Rotulo'  && (isset($_POST['rotulo']) ||isset($_POST['todos'])))
            {
                $rotulo=$rotulo+$datos[$i]['Monto'];
                $reporte_rotulo=$reporte_rotulo.$dato_linea;
            }
        }
        $reporte_matricula=$reporte_matricula."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$matricula."</b> </td><td></td></tr></table>";
        $reporte_basura=$reporte_basura."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$basura."</b> </td><td></td></tr></table>";
        $reporte_ibi=$reporte_ibi."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$ibi."</b> </td><td></td></tr></table>";
        $reporte_imi=$reporte_imi."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$imi."</b> </td><td></td></tr></table>";
        $reporte_retenciones=$reporte_retenciones."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$retenciones."</b> </td><td></td></tr></table>";
        $reporte_rotulo=$reporte_rotulo."<tr><td> </td><td> </td><td> </td><td><b>TOTAL</b> </td><td><b>C$ ".$rotulo."</b> </td><td></td></tr></table>";



        if(isset($_POST['todos']))
        {
       $reporte=$reporte.$reporte_matricula.$reporte_imi.$reporte_ibi.$reporte_basura.$reporte_rotulo.$reporte_retenciones;

        }
        else{
       if(isset($_POST['matricula'])){
            $reporte=$reporte.$this->_view->reporte=$reporte_matricula;
       }
         if(isset($_POST['ibi']))
            $reporte=$reporte.$this->_view->reporte=$reporte_ibi;
         if(isset($_POST['imi']))
            $reporte=$reporte.$this->_view->reporte=$reporte_imi;
         if(isset($_POST['retenciones']))
            $reporte=$reporte.$this->_view->reporte=$reporte_retenciones;
         if(isset($_POST['basura']))
            $reporte=$reporte.$this->_view->reporte=$reporte_basura;
         if(isset($_POST['rotulos']))
           $reporte=$reporte.$this->_view->reporte=$reporte_rotulo;
        }
        $total_todo=($basura+$matricula+$ibi+$imi+$retenciones+$rotulo);

        $tabla="<br><br><h3>Resumen</h3><table  class='table col-lg-offset-3 table-condensed'  style='width: 500px'><tr class='alert-danger'><th>Tributo</th><th>Monto Total</th></tr>
        <tr><td>Matrícula</td><td>C$ $matricula</td></tr>
        <tr><td>Impuesto Sobre Bienes e Inmuebles</td><td>C$ $ibi</td></tr>
        <tr><td>Impuesto Sobre Ingresos</td><td>C$ $imi</td></tr>
        <tr><td>Rótulos</td><td>C$ $rotulo</td></tr>
        <tr><td>Retenciones</td><td>C$ $retenciones</td></tr>
        <tr><td>Basura</td><td>C$ $basura</td></tr>
        <tr><td><b>TOTAL</b></td><td><b>C$ $total_todo</b></td></tr>
        </table>";
        $reporte=$reporte.$tabla;

        $this->_view->reporte=$reporte;

        $this->_view->titulo='Alcaldia Municipal de Ocotal';

        $this->_view->renderizar('reporte','inicio');

    }


    public function estadisticas(){

        Session::acceso('especial');
        if($this->getTexto('reportee')==1){
        $fecha1=$this->getTexto('fecha1');
        $fecha2=$this->getTexto('fecha2');
        $datos= $this->_reporte->getReporte($fecha1,$fecha2,'');

        $matricula=0;
        $imi=0;
        $ibi=0;
        $retenciones=0;
        $basura=0;
        $rotulo=0;
        $total_todo=0;

        for($i=0;$i<count($datos);$i++)
        {
            $total_todo=$total_todo+$datos[$i]['Monto'];
            if($datos[$i]['Tributo']=='Matricula' )
            {
                $matricula=$matricula+$datos[$i]['Monto'];

            }

            if($datos[$i]['Tributo']=='Impuesto de Bienes Inmuebles' )
            {
                $ibi=$ibi+$datos[$i]['Monto'];

            }


            if($datos[$i]['Tributo']=='Impuesto Sobre Ingresos' )
            {
                $imi=$imi+$datos[$i]['Monto'];

            }

            if($datos[$i]['Tributo']=='Retenciones'  )
            {
                $retenciones=$retenciones+$datos[$i]['Monto'];

            }

            if($datos[$i]['Tributo']=='Basura'  )
            {
                $basura=$basura+$datos[$i]['Monto'];

            }

            if($datos[$i]['Tributo']=='Rotulo'  )
            {
                $rotulo=$rotulo+$datos[$i]['Monto'];

            }

        }

        if($total_todo>0){
        $tibi=$ibi/$total_todo;
        $timi=$imi/$total_todo;
        $tmatricula=$matricula/$total_todo;
        $tretenciones=$retenciones/$total_todo;
        $tbasura=$basura/$total_todo;
        $trotulos=$rotulo/$total_todo;

if($this->getTexto('tipog')=='Pastel')
    $reporte_estaidistico="

            <script>


            Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Resumen Estadístico de los Tributos entre la fecha de $fecha1 hasta $fecha2'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>:<br> {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Valores',
                colorByPoint: true,
                data: [{
                    name: 'Impuesto Sobre Bienes Inmuebles',
                    y: $tibi
                }, {
                    name: 'Impuesto Sobre Ingresos',
                    y: $timi,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Basura',
                    y: $tbasura
                }, {
                    name: 'Matrícula',
                    y: $tmatricula
                }, {
                    name: 'Retenciones',
                    y: $tretenciones
                }, {
                    name: 'Rótulos',
                    y: $trotulos
                }]
            }]
        });


    </script>

    ";

if($this->getTexto('tipog')=='Barras')
$reporte_estaidistico="

   <script>

Highcharts.chart('container', {
    data: {
        table: 'tablat'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Resumen Estadísticos de los Tributos entre la fecha de $fecha1 hasta $fecha2'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Cantidad en Miles'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/> C$ ' +
                this.point.y ;
        }
    }
});

   </script>
    ";



            if($this->getTexto('tipog')=='Pastel')
        $tabla="<br><table id='tablat' class='table col-lg-offset-5 table-condensed'  style='width: 500px'><thead><tr class='alert-danger'><th>Tributos</th><th>Monto Total</th></tr></thead><tbody>
        <tr><th>Matrícula</th><td>C$ $matricula</td></tr>
        <tr><th>Impuesto Sobre Bienes e Inmuebles</th><td>C$ $ibi</td></tr>
        <tr><th>Impuesto Sobre Ingresos</th><td>C$ $imi</td></tr>
        <tr><th>Rótulos</th><td>C$ $rotulo</td></tr>
        <tr><th>Retenciones</th><td>C$ $retenciones</td></tr>
        <tr><th>Basura</th><td>C$ $basura</td></tr>
        <tr><th>TOTAL</th><td>C$ $total_todo</td></tr>
        </tbody></table>";

            if($this->getTexto('tipog')=='Barras')
                $tabla="<br><table id='tablat' class='table col-lg-offset-4 table-condensed'  style='width: 800px'><thead><tr class='alert-danger'><th></th>
        <th>Matrícula</th><th>Impuesto Sobre Bienes e Inmuebles</th><th>Impuesto Sobre Ingresos</th><th>Rótulos</th><th>Retenciones</th><th>Basura</th><th>TOTAL</th></tr></thead><tbody>
        <tr><th>Montos</th><td>$matricula</td><td>$ibi</td><td>$imi</td><td>$rotulo</td><td>$retenciones</td><td>$basura</td><td>$total_todo</td></tr>
        </tbody></table>";





            $this->_view->tablat=$tabla;

        $this->_view->reporte_estadistico=$reporte_estaidistico;



        }




}


        $this->_view->setJs(array('highcharts'));
        $this->_view->setJs(array('exporting'));
        $this->_view->setJs(array('data'));
        $this->_view->renderizar('estadisticas','inicio');

    }


}