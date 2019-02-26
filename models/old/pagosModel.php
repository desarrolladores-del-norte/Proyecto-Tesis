<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 5/06/17
 * Time: 03:35 PM
 */
class pagosModel extends Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function obtenerFactura($idfa)
    {
        $factura=$this->_db->query("select * from facturacion where idf=".$idfa);
        return $factura->fetch();
    }


    public function actualizarFactura($idf,$boleta,$forma_pago,$observacion)
    {
        $fechap=date("d/m/Y");
        $this->_db->beginTransaction();
       $resul= $this->_db->prepare("update facturacion set forma_pago= :forma_pago , estado='Pagado',fechap= :fechap , boleta= :boleta , observacion= :observacion where idf=:idf ")
            ->execute(
                array(
                'idf'=>$idf,
                'fechap'=>$fechap,
                'boleta'=>$boleta,
                'observacion'=>$observacion,
                 'forma_pago'=>$forma_pago
                )
            );

        $resul1= $this->_db->prepare(" update tributos_propiedad set estado='Pagado'  where idtp in(select idtp from R_fa_tp where idf= :idf)  ")
            ->execute(
                array(
                    'idf'=>$idf,
                    )
            );

        $resul2= $this->_db->prepare(" update tributos_negocio set estado='Pagado'  where idtn in(select idtn from R_fa_tn where idf= :idf)  ")
            ->execute(
                array(
                    'idf'=>$idf,
                )
            );
        if ($resul && $resul1 && $resul2)
        $this->_db->commit();
        else
            $this->_db->rollBack();




        if ($resul && $resul1 && $resul2)
        return true;
            else
        return false;


    }
}