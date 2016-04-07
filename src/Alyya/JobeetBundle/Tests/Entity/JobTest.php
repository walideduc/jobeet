<?php
///**
// * Created by PhpStorm.
// * User: walid
// * Date: 25/03/16
// * Time: 11:05
// */
//namespace Alyya\JobeetBundle\Entity;
//use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
//use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
//use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
//use Symfony\Bundle\FrameworkBundle\Console\Application;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\Console\Input\ArrayInput;
//use Symfony\Component\Console\Output\ConsoleOutput;
//
//class JobTest extends WebTestCase{
//    private $em ;
//    private $application;
//
//    public function setUp(){
//        static::$kernel = static::createKernel(['test', true]);
//        static::$kernel->boot();
//        $this->application = new Application(static::$kernel);
//        // drop the database
//        $command = new DropDatabaseDoctrineCommand();
//        $this->application->add($command);
//        $input = new ArrayInput(array(
//            'command' => 'doctrine:database:drop',
//            '--force'=> true
//        ));
//        $command->run($input, new ConsoleOutput());
//
//        // we have to close the connection after dropping the database so we don't get "No database selected" error
//        $connection = $this->application->getKernel()->getContainer()->get('doctrine')->getConnection();
//        if ($connection->isConnected()) {
//            $connection->close();
//        }
//
//        $command = New CreateDatabaseDoctrineCommand();
//        $this->application->add($command);
//        $input = new ArrayInput(array(
//            'command' => 'doctrine:database:create',
//        ));
//        $command->run($input, new ConsoleOutput());
//
//        $command = new CreateSchemaDoctrineCommand();
//        $this->application->add($command);
//        $input = new ArrayInput(array(
//            'command' => 'doctrine:schema:create',
//        ));
//        $command->run($input, new ConsoleOutput());
//    }
//    public function testGetCompanySlug(){
//        $this->assertEquals(1,1);
//    }
//}