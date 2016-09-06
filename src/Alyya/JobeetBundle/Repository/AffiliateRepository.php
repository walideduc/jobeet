<?php

namespace Alyya\JobeetBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AffiliateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AffiliateRepository extends EntityRepository
{
    public function getForToken($token){

        $qb = $this->createQueryBuilder('a')
            ->where('a.token = :token')
            ->setParameter('token',$token)
            ->andwhere('a.is_active = :active')
            ->setParameter('active', 1);

        return $qb->getQuery()->getOneOrNullResult();
    }
}