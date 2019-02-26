<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 25/04/2017
 * Time: 05:04 PM
 */
class usuariosModel extends Model
{
    public function __construct()
    {
        parent::__construct();

    }
    public function obtenerContribuyente($id)
    {

        $post = $this->_db->query("call obtener_contribuyente(".$id.')');
        return $post->fetch();
    }

    public function obtenerNegocios($idco)
    {
        $post = $this->_db->query("call obtener_negocios(".$idco.")");
        return  $post->fetchall();
    }


    public function obtenerPropiedades($idco)
    {
        $post = $this->_db->query("call obtener_propiedades(".$idco.")");
        return  $post->fetchall();
    }

    public function obtenerTributoNegocio($idn,$idfa=false)
    {
        if(!$idfa)
        $post = $this->_db->query("call obtener_tributos_negocio(".$idn.")");
        else
        $post = $this->_db->query("select * from tributos_negocio as tn inner join R_fa_tn as r on(tn.idtn=r.idtn) where  tn.idn=".$idn." and r.idf=".$idfa);
        return  $post->fetchall();

    }

    public function obtenerTributoNegocioPendiente($idn)
    {



        $post = $this->_db->query("select * from tributos_negocio where estado='Pendiente' and idn=".$idn);
        return  $post->fetchall();

    }


    public function obtenerTributoPropiedad($idp,$idfa=false)
    {
        if(!$idfa)
        $post = $this->_db->query("call obtener_tributos_negocio(".$idp.")");
        else
        $post = $this->_db->query("select * from tributos_propiedad as tp inner join R_fa_tp as r on (tp.idtp=r.idtp) where tp.idp=".$idp." and r.idf=".$idfa);

        return  $post->fetchall();
    }

    public function obtenerTributoPropiedadPendiente($idp)
    {

        $post = $this->_db->query("select * from tributos_propiedad where estado='Pendiente' and idp=".$idp);
        return  $post->fetchall();

    }


    public function insertarFactura($fechagenerado,$total_pagar)
    {


        $id_insertado=0;
        $this->_db->prepare("insert into facturacion(fechagenerado,total_pagar,estado) values ( :fechagenerado , :total_pagar , 'Pendiente')")
            ->execute(
                array(
                    'fechagenerado'=>$fechagenerado,
                    'total_pagar'=>$total_pagar
                )
            );
        $id_insertado=$this->_db->lastInsertId();

        return $id_insertado;

    }

    public function insertarR_FA_NP($idco,$idfa)
    {



          $this->_db->prepare("insert into R_fa_tn(idf,idtn)
           select :idfa , tn.idtn from tributos_negocio as tn inner join (negocio as ne inner join contribuyentes as co on (ne.idco=co.idc)) on (tn.idn=ne.idn) and co.idc= :idco and tn.estado='Pendiente' ")
              ->execute(
                  array(
                      'idfa'=>$idfa,
                      'idco'=>$idco
                  )
              );


        $this->_db->prepare("insert into R_fa_tp(idf,idtp)
           select :idfa , tp.idtp from tributos_propiedad as tp inner join (propiedades as po inner join contribuyentes as co on (po.idco=co.idc)) on (tp.idp=po.idp) and co.idc= :idco and tp.estado='Pendiente' ")
            ->execute(
                array(
                    'idfa'=>$idfa,
                    'idco'=>$idco
                )
            );



    }

    public function obtenerFacturasPendientes($idco)
    {
        $post = $this->_db->query("select fa.idf as idfa, fa.fechagenerado as fechag,fa.total_pagar as totalp, fa.estado as estad from facturacion as fa inner join
        (R_fa_tn as rftn inner join (tributos_negocio as tn inner join (negocio as ne inner join contribuyentes as co on(co.idc=ne.idco)) on(ne.idn=tn.idn) ) on(tn.idtn=rftn.idtn)) on
        (fa.idf=rftn.idf) and co.idc=$idco union select fa.idf as idfa, fa.fechagenerado as fechag,fa.total_pagar as totalp, fa.estado as estad from facturacion as fa inner join (R_fa_tp as rftp inner join
        (tributos_propiedad as tp inner join (propiedades as po inner join contribuyentes as co on(co.idc=po.idco)) on(po.idp=tp.idp) ) on(tp.idtp=rftp.idtp)) on (fa.idf=rftp.idf) and co.idc=$idco");
        return  $post->fetchall();
    }

    public function eliminarFactura($idfa)
    {

        $this->_db->prepare("delete from facturacion where idf=:idfa")
            ->execute(
                array(
                   'idfa'=>$idfa
                )
            );
    }

}