<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 22/06/17
 * Time: 11:45 AM
 */
class reporteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getReporte($fecha1,$fecha2,$contribuyente)
    {
        $fecha1= date_create($fecha1);
        $fecha2= date_create($fecha2);
        $fecha1=date_format($fecha1,'d/m/Y');
        $fecha2=date_format($fecha2,'d/m/Y');

        if($contribuyente=="")
        $post = $this->_db->query("SELECT boleta, tn.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tn.descripcion as Concepto,tn.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (negocio as ne INNER JOIN (tributos_negocio as tn INNER JOIN (R_fa_tn as rftn INNER join facturacion as f on f.idf=rftn.idf) on tn.idtn=rftn.idtn) on ne.idn=tn.idn ) on co.idc=ne.idco and f.estado='Pagado' and f.fechap between '". $fecha1."' and '".$fecha2."'
                                  union
                                  SELECT boleta, tp.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tp.descripcion as Concepto,tp.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (propiedades as pr INNER JOIN (tributos_propiedad as tp INNER JOIN (R_fa_tp as rftp INNER join facturacion as f on f.idf=rftp.idf) on tp.idtp=rftp.idtp) on pr.idp=tp.idp ) on co.idc=pr.idco and f.estado='Pagado' and f.fechap between '". $fecha1."' and '".$fecha2."'
                                  ");
        else
        $post = $this->_db->query("SELECT boleta, tn.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tn.descripcion as Concepto,tn.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (negocio as ne INNER JOIN (tributos_negocio as tn INNER JOIN (R_fa_tn as rftn INNER join facturacion as f on f.idf=rftn.idf) on tn.idtn=rftn.idtn) on ne.idn=tn.idn ) on co.idc=ne.idco and f.estado='Pagado' and f.fechap between '". $fecha1."' and '".$fecha2."' and co.nombre like '%".$contribuyente."%'
                                 union
                                 SELECT boleta, tp.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tp.descripcion as Concepto,tp.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (propiedades as pr INNER JOIN (tributos_propiedad as tp INNER JOIN (R_fa_tp as rftp INNER join facturacion as f on f.idf=rftp.idf) on tp.idtp=rftp.idtp) on pr.idp=tp.idp ) on co.idc=pr.idco and f.estado='Pagado' and f.fechap between '". $fecha1."' and '".$fecha2."' and co.nombre like '%".$contribuyente."%'
                                  ");
        return $post->fetchall();
    }

}