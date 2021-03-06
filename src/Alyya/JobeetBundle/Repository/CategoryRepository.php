<?php

namespace Alyya\JobeetBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getWithJobs(){
        $query = $this->getEntityManager()->createQuery(
            ' SELECT c FROM AlyyaJobeetBundle:Category as c 
              JOIN c.jobs j 
              WHERE j.expires_at > :date 
              AND j.is_activated = :is_activated')
            ->setParameter('date',date('Y-m-d H:s:i',time()))
            ->setParameter('is_activated',1);
        return $query->getResult();
    }
}
