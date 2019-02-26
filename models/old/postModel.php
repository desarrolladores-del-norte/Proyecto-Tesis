<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 30/03/2017
 * Time: 02:33 PM
 */
class postModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getPost()
    {

      $post = $this->_db->query("select * from post");
      return $post->fetchall();
    }

    public function getReporte()
    {

        $post = $this->_db->query("SELECT tn.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tn.descripcion as Concepto,tn.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (negocio as ne INNER JOIN (tributos_negocio as tn INNER JOIN (R_fa_tn as rftn INNER join facturacion as f on f.idf=rftn.idf) on tn.idtn=rftn.idtn) on ne.idn=tn.idn ) on co.idc=ne.idco and f.estado='Pagado'
                                  union
                                  SELECT tp.tributo as Tributo,f.idf as fact, co.nombre as Contribuyente, tp.descripcion as Concepto,tp.monto as Monto,f.fechap as fechapago from contribuyentes as co INNER JOIN (propiedades as pr INNER JOIN (tributos_propiedad as tp INNER JOIN (R_fa_tp as rftp INNER join facturacion as f on f.idf=rftp.idf) on tp.idtp=rftp.idtp) on pr.idp=tp.idp ) on co.idc=pr.idco and f.estado='Pagado';
                                  ");
        return $post->fetchall();
    }


    public function insertarPost($titulo,$cuerpo)
    {
        $this->_db->prepare("insert into post(titulo,cuerpo) values( :titulo , :cuerpo )")
            ->execute(
              array(
                  'titulo'=>"'".$titulo."'",
                  'cuerpo'=>"'".$cuerpo."'"
              )
            );
    }

    public function obtenerPost($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("select * from post where id=".$id);
        return $post->fetch();

    }

    public function editarPost($id,$titulo,$cuerpo)
    {
        try{


        $id=(int)$id;

        $this->_db->prepare("update post set titulo= :titulo , cuerpo= :cuerpo where id= :id")
       ->execute(
                array(
                    ':id'=>$id,
                    ':titulo'=>"'".$titulo."'",
                    ':cuerpo'=>"'".$cuerpo."'"
                )
            );

        return "Todo bien";
        }
        catch (Exception $e){return "Error :".$e;

    }

    }



    public function eliminarPost($id)
    {
        try{


            $id=(int)$id;

            $this->_db->prepare("delete from post where id=:id")
                ->execute(
                    array(
                        ':id'=>$id

                    )
                );

            return "Todo bien";
        }
        catch (Exception $e){return "Error :".$e;

        }

    }



}