<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 06/03/16
 * Time: 10:00
 */
namespace Alyya\JobeetBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Alyya\JobeetBundle\Entity\Affiliate;

class LoadAffiliateData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $affiliate = new Affiliate();
        $affiliate->setEmail('address1@example.com');
        $affiliate->setToken('alyya-consulting');
        $affiliate->setUrl('http://alyya-labs.com/');
        $affiliate->setIsActive(true);
        $affiliate->addCategory($objectManager->merge($this->getReference('category-programming')));

        $objectManager->persist($affiliate);

        $affiliate = new Affiliate();

        $affiliate->setUrl('/');
        $affiliate->setEmail('address2@example.org');
        $affiliate->setToken('symfony');
        $affiliate->setIsActive(false);
        $affiliate->addCategory($objectManager->merge($this->getReference('category-programming')), $objectManager->merge($this->getReference('category-design')));

        $objectManager->persist($affiliate);
        $objectManager->flush();

        $this->addReference('affiliate',$affiliate);



    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3 ;
    }
}