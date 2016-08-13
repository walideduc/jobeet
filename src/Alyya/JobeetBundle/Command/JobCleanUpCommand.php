<?php

/**
 * Created by PhpStorm.
 * User: walid
 * Date: 13/08/16
 * Time: 11:34
 */
namespace Alyya\JobeetBundle\Command ;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument ;

class JobCleanUpCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('jobeet:clean-up:jobs');
        $this->setDescription('To clean up all unused jobs');
        $this->addArgument('days',InputArgument::OPTIONAL,'Number of days');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $days = $input->getArgument('days');
        !$days ? $days = 90 : $days;
        $em = $this->getContainer()->get('doctrine')->getManager();
        $nb = $em->getRepository("AlyyaJobeetBundle:Job")->cleanup($days);
        $output->writeln(sprintf(' %s stale job were removed',$nb));
    }

}