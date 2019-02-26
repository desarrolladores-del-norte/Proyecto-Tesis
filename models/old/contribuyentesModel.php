<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 06/04/2017
 * Time: 08:58 AM
 */
class contribuyentesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getContribuyentes()
    {

        $post = $this->_db->query("call mostrar_contribuyentes");
        return $post->fetchall();
    }

    public function getListaNegocios()
    {

        $post = $this->_db->query("call mostrar_lista_negocios");
        return $post->fetchall();
    }

    public function getListaPropiedades()
    {

        $post = $this->_db->query("select * from propiedades");
        return $post->fetchall();
    }

    public function obtenerContribuyente($id)
    {

        $post = $this->_db->query("call obtener_contribuyente(".$id.')');
        return $post->fetch();
    }

    public function obtenerRUC($ruc)
    {

        $post = $this->_db->query("select idc from contribuyentes where RUC='".$ruc."'");
        return $post->fetch();
    }

    public function obtenerExpediente($expediente)
    {

        $post = $this->_db->query("select idc from contribuyentes where expediente='".$expediente."'");
        return $post->fetch();
    }

    public function obtenerMatricula($matricula)
    {

        $post = $this->_db->query("select idn from negocio where matricula='".$matricula."'");
        return $post->fetch();
    }

    public function obtenerCodigoCatastral($codigo)
    {

        $post = $this->_db->query("select idp from propiedades where codigo='".$codigo."'");
        return $post->fetch();
    }


    public function insertarContribuyente($ruc,$nombre,$direccion,$telefono,$correo,$tipo_persona,$clave,$fecha,$expediente)
    {
        $id_insertado=0;
            $this->_db->prepare("call insertar_contribuyente( :ruc , :nombre , :direccion , :telefono , :correo , :tipo_persona , :clave , :fecha , :expediente )")
            ->execute(
                array(
                    'ruc'=>"'".$ruc."'",
                    'nombre'=>"'".$nombre."'",
                    'direccion'=>"'".$direccion."'",
                    'telefono'=>"'".$telefono."'",
                    'correo'=>"'".$correo."'",
                    'tipo_persona'=>"'".$tipo_persona."'",
                    'clave'=>"'".$clave."'",
                    'fecha'=>"'".$fecha."'",
                    'expediente'=>"'".$expediente."'"
                )
            );


    if($correo=='')
    $correo='niguno@ninguno.com';

        $this->_db->prepare("call insertar_usuario( :nom , :usu , :contra , :email , :role , :estad )")
            ->execute(
                array(
                    'nom'=>"'".$nombre."'",
                    'usu'=>"'".$ruc."'",
                    'contra'=>"'".Hash::getHash('sha1',$clave,HASH_KEY)."'",
                    'email'=>"'".$correo."'",
                    'role'=>"'".'usuario'."'",
                    'estad'=>1
                )
            );



    }


    public function actualizarContribuyente($ruc,$nombre,$direccion,$telefono,$correo,$tipo_persona,$clave,$fecha,$id,$expediente)
    {

        $this->_db->prepare("call actualizar_contribuyente( :ruc , :nombre , :direccion , :telefono , :correo , :tipo_persona , :clave , :fecha , :id , :expediente)")
            ->execute(
                array(
                    'ruc'=>"'".$ruc."'",
                    'nombre'=>"'".$nombre."'",
                    'direccion'=>"'".$direccion."'",
                    'telefono'=>"'".$telefono."'",
                    'correo'=>"'".$correo."'",
                    'tipo_persona'=>"'".$tipo_persona."'",
                    'clave'=>"'".$clave."'",
                    'fecha'=>"'".$fecha."'",
                    'id'=>$id,
                    'expediente'=>"'".$expediente."'"
                )
            );



    }







    public function insertarNegocio($idco,$tipo,$clasificacion,$barrio,$nombrenegocio,$direccion,$matricula,$telefono,$email,$descripcion)
    {


        $this->_db->prepare("call insertar_negocio( :idco , :tipo , :clasificacion , :barrio , :nombrenegocio , :direccion , :matricula , :telefono , :email , :descripcion )")
            ->execute(
                array(
                    'idco'=>$idco,
                    'tipo'=>"'".$tipo."'",
                    'clasificacion'=>"'".$clasificacion."'",
                    'barrio'=>"'".$barrio."'",
                    'nombrenegocio'=>"'".$nombrenegocio."'",
                    'direccion'=>"'".$direccion."'",
                    'matricula'=>"'".$matricula."'",
                    'telefono'=>"'".$telefono."'",
                    'email'=>"'".$email."'",
                    'descripcion'=>"'".$descripcion."'"
                )
            );


    }


    public function actualizarNegocio($idn,$tipo,$clasificacion,$barrio,$nombrenegocio,$direccion,$matricula,$telefono,$email,$descripcion)
    {


        $this->_db->prepare("update negocio set  tipo= :tipo , clasificacion = :clasificacion , barrio = :barrio , nombrenegocio = :nombrenegocio , direccion = :direccion , matricula = :matricula , telefono = :telefono , email = :email , descripcion = :descripcion  where idn= :idn")

            ->execute(
                array(
                    'idn'=>$idn,
                    'tipo'=>$tipo,
                    'clasificacion'=>$clasificacion,
                    'barrio'=>$barrio,
                    'nombrenegocio'=>$nombrenegocio,
                    'direccion'=>$direccion,
                    'matricula'=>$matricula,
                    'telefono'=>$telefono,
                    'email'=>$email,
                    'descripcion'=>$descripcion
                )
            );


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


    public function obtenerIdnco($ruc)
    {
        try{
        $post = $this->_db->query("call obtener_idco(\"'".$ruc."'\")");
        return $post->fetch();
        }
        catch (Exception $e)
        {
            return false;
        }
    }



    public function eliminarContribuyente($idco)
    {
        try{


            $id=(int)$idco;

            $this->_db->prepare("delete from usuarios where usuario=(select RUC from contribuyentes where idc=:id)")
                ->execute(
                    array(
                        ':id'=>$id

                    )
                );

            $this->_db->prepare("delete from contribuyentes where idc= :id")
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



    public function eliminarNegocio($idn)
    {
        try{


            $id=(int)$idn;

            $this->_db->prepare("delete from negocio where idn= :id")
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


    public function eliminarPropiedad($idp)
    {
        try{


            $id=(int)$idp;

            $this->_db->prepare("delete from propiedades where idp= :id")
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


    public function insertarPropiedad($idco,$codigo,$valor,$excepcion,$direccion,$barrio,$descripcion)
    {

      //  in idco int,in codigo text,in valor int,in excepcion text,in direccion text,in barrio text

        $this->_db->prepare("call insertar_propiedad( :idco , :codigo , :valor , :excepcion , :direccion , :barrio , :descripcion )")
            ->execute(
                array(
                    'idco'=>$idco,
                    'codigo'=>"'".$codigo."'",
                    'valor'=>$valor,
                    'excepcion'=>"'".$excepcion."'",
                    'direccion'=>"'".$direccion."'",
                    'barrio'=>"'".$barrio."'",
                    'descripcion'=>"'".$descripcion."'"
                )
            );


    }


    public function actualizarPropiedad($idp,$codigo,$valor,$excepcion,$direccion,$barrio,$descripcion)
    {


        $this->_db->prepare("update propiedades set  codigo= :codigo ,valor= :valor ,excepcion= :excepcion ,direccion= :direccion ,barrio= :barrio ,descripcion= :descripcion where idp= :idp")
            ->execute(
                array(
                    'idp'=>$idp,
                    'codigo'=>$codigo,
                    'valor'=>$valor,
                    'excepcion'=>$excepcion,
                    'direccion'=>$direccion,
                    'barrio'=>$barrio,
                    'descripcion'=>$descripcion
                )
            );


    }

    public function obtenerDatosNegocio($id)
    {


            $post = $this->_db->query("call obtener_datos_negocio('".$id."')");
            return $post->fetch();

    }



    public function insertarTributoNegocio($idn,$tributo,$descripcion,$periodo,$monto,$multa,$deduccion,$fechae,$fechac,$estado)
    {


        $this->_db->prepare("call insertar_tributos_negocio( :idn , :tributo , :descripcion , :periodo , :monto , :multa , :deduccion , :fechae , :fechac , :estado )")
            ->execute(
                array(
                    'idn'=>$idn,
                    'tributo'=>"'".$tributo."'",
                    'descripcion'=>"'".$descripcion."'",
                    'periodo'=>"'".$periodo."'",
                    'monto'=>$monto,
                    'multa'=>$multa,
                    'deduccion'=>$deduccion,
                    'fechae'=>"'".$fechae."'",
                    'fechac'=>"'".$fechac."'",
                    'estado'=>"'".$estado."'"
                )
            );


    }

    public function obtenerTributoNegocio($idn)
    {

        $post = $this->_db->query("select * from tributos_negocio where idn=$idn order by estado desc;");
        return  $post->fetchall();

    }




    public function eliminarTributoNegocio($idt)
    {
        try{


            $id=(int)$idt;

            $this->_db->prepare("delete from tributos_negocio where idtn= :id")
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




    public function obtenerDatosPropiedad($id)
    {


        $post = $this->_db->query("call obtener_datos_propiedad('".$id."')");
        return $post->fetch();

    }





    public function insertarTributoPropiedad($idp,$tributo,$descripcion,$periodo,$monto,$multa,$deduccion,$fechae,$fechac,$estado)
    {

        $this->_db->prepare("call insertar_tributos_propiedad( :idp , :tributo , :descripcion , :periodo , :monto , :multa , :deduccion , :fechae , :fechac , :estado )")
            ->execute(
                array(
                    'idp'=>$idp,
                    'tributo'=>"'".$tributo."'",
                    'descripcion'=>"'".$descripcion."'",
                    'periodo'=>"'".$periodo."'",
                    'monto'=>$monto,
                    'multa'=>$multa,
                    'deduccion'=>$deduccion,
                    'fechae'=>"'".$fechae."'",
                    'fechac'=>"'".$fechac."'",
                    'estado'=>"'".$estado."'"
                )
            );


    }

    public function obtenerTributoPropiedad($idp)
    {
        $post = $this->_db->query("select * from tributos_propiedad where idp=$idp;");
        return  $post->fetchall();

    }




    public function eliminarTributoPropiedad($idt)
    {
        try{


            $id=(int)$idt;

            $this->_db->prepare("delete from tributos_propiedad where idtp= :id")
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