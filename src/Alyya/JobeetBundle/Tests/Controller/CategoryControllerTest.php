<?php
//namespace AppBundle\Tests\Controller;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//
//class CategoryControllerTest extends WebTestCase {
//    public function testShow(){
//        $client = static::createClient();
//        $crawler = $client->request('GET','/');
//        dump($client->getResponse());
//    }
//
//}
namespace AppBundle\Tests\Controller;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase {
    public function testShow(){
        $client = static::makeClient();
        $crawler = $client->request('GET','/');
        $this->isSuccessful($client->getResponse());
    }

}









































//
//namespace Alyya\JobeetBundle\Tests\Controller;
//
//use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
//use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Bundle\FrameworkBundle\Console\Application;
//use Symfony\Component\Console\Input\ArrayInput;
//use Symfony\Component\Console\Output\ConsoleOutput;
//
//class CategoryControllerTest extends WebTestCase
//{
//    private $em;
//    private $application;
//
//    public function setUp(){
//        static::$kernel = static::createKernel();
//        static::$kernel->boot();
//
//        $this->application = new Application(static::$kernel,true);
//
//        $command = new DropDatabaseDoctrineCommand();
//        $this->application->add($command);
//        $input = new ArrayInput(array(
//            'command' => 'doctrine:database:drop',
//            '--force' => true
//        ));
//        $command->run($input, New ConsoleOutput());
//
//        $connection = $this->application->getKernel()->getContainer()->get('doctrine')->getConnection();
//        if ($connection->isConnected()) {
//            $connection->close();
//        }
//
//        $command = new CreateDatabaseDoctrineCommand();
//        $this->application->add($command);
//        $input = new ArrayInput(array(
//            'command' => 'doctrine:schema:create',
//        ));
//        $command->run($input, New ConsoleOutput());
//
//        $this->em = static::$kernel->getContainer()
//            ->get('doctrine')
//            ->getManager();
//
//        $client = static::createClient();
//        $loader = new \Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader($client->getContainer());
//        $loader->loadFromDirectory(static::$kernel->locateResource('@AlyyaJobeetBundle/DataFixtures/ORM'));
//        $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($this->em);
//        $executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($this->em,$purger);
//        $executor->execute($loader->getFixtures());
//
//
//    }
//
//    public function testShow()
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET','/');
//        $this->assertEquals('Alyya\JobeetBundle\Controller\JobController::indexAction', $client->getRequest()->attributes->get('_controller'));
//        $this->assertGreaterThan(0,$crawler->filter('html:contains("PROGRAMMING")')->count());
//        $this->assertEquals(200 , $client->getResponse()->getStatusCode());
//    }
//
//}
