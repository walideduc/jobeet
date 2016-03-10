<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 09/03/16
 * Time: 16:50
 */
namespace Alyya\JobeetBundle\Utils;
class Jobeet {
    public static function suglify($text){
        $text = preg_replace('/\W+/','-',$text);
        $text = strtolower(trim($text,'-'));
        return $text ;
    }
}