<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 23/03/16
 * Time: 14:37
 */
use Alyya\JobeetBundle\Utils\Jobeet;

class JobeetTest extends \PHPUnit_Framework_TestCase{
    public function testslugify(){
        //$this->assertEquals('alyya',Jobeet::slugify('Alyya'));
        $this->assertEquals('alyya-marie',Jobeet::slugify('alyya marie'));
        $this->assertEquals('paris-france',Jobeet::slugify('paris,France'));
        $this->assertEquals('alyya',Jobeet::slugify(' Alyya '));
        $this->assertEquals('alyya',Jobeet::slugify('Alyya'),'fifth one');
        $this->assertEquals('n-a',Jobeet::slugify(''));
        // When a string only contains non-ASCII charactersWhen a string only contains non-ASCII characters
        $this->assertEquals('n-a',Jobeet::slugify(' - '));
        if (function_exists('iconv')) {
            $this->assertEquals('developpeur-web', Jobeet::slugify('Développeur Web'));
        }
        /*
         * You cannot think about all edge cases when writing tests, and that’s fine. But when you discover one, you need to write a test for it before fixing your code. It also means that your code will get better over time, which is always a good thing.
         */
    }
}