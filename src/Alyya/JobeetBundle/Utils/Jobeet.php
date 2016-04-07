<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 09/03/16
 * Time: 16:50
 */
namespace Alyya\JobeetBundle\Utils;
class Jobeet {
    public static function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            setlocale(LC_ALL, 'en_US.UTF8'); // iconv does not working without this line
            $text = iconv('utf-8', 'ASCII//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
}