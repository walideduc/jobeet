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
use Alyya\JobeetBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $design = new Category();
        $design->setName('Design');

        $programming = new Category();
        $programming->setName('Programming');

        $manager = new Category();
        $manager->setName('Manager');

        $administrator = new Category();
        $administrator->setName('Administrator');

        $objectManager->persist($design);
        $objectManager->persist($programming);
        $objectManager->persist($manager);
        $objectManager->persist($administrator);
        $objectManager->flush();

        $this->addReference('category-design', $design);
        $this->addReference('category-programming', $programming);
        $this->addReference('category-manager', $manager);
        $this->addReference('category-administrator', $administrator);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1 ;
    }
}