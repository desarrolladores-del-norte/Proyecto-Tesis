<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 15/04/2017
 * Time: 04:39 PM
 */
class Hash
{
    public static function getHash($algoritmo,$data,$key)
        {
         $hash=hash_init($algoritmo,HASH_HMAC,$key);
         hash_update($hash,$data);
         return hash_final($hash);
        }
}