<?php

namespace Alyya\JobeetBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * JobRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobRepository extends EntityRepository
{
    public function getActiveJobs($category_id = null,$max = null){
        $query = $this->getActiveJobsQuery($category_id,$max);
        return $query->getResult();
    }

    public function getActiveJobsQuery($category_id = null,$max = null){
        $queryBuilder = $this->createQueryBuilder('j')
            ->where('j.expires_at >:date')
            ->andWhere('j.is_activated = :is_activated')
            ->setParameter('date',date('Y-m-d',time()))
            ->setParameter('is_activated',1)
            ->orderBy('j.expires_at','DESC');
        if($category_id){
            $queryBuilder->andWhere('j.category = :category_id');
            $queryBuilder->setParameter('category_id',$category_id);
        }
        if($max){
            $queryBuilder->setMaxResults($max);
        }
         return $queryBuilder->getQuery();
    }

/*    public function getActiveJob($id){
        $query = $this->createQueryBuilder('j')
                ->where('j.id = :id')
                ->setParameter('id',$id)
                ->andWhere('j.expires_at > :date')
                ->setParameter('date',date('Y-m-d H:i:s',time()))
                ->setMaxResults(1)
            ->getQuery();
        try {
            $job = $query->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $job = null;
        }

        return $job;
    }*/

    public function countActiveJobs($category_id = null ){
        $queryBuilder = $this->createQueryBuilder('j')
            ->select('count(j.id)')
            ->where('j.expires_at > :date')
            ->setParameter('date',date('Y-m-d H:i:s',time()));
        if($category_id){
            $queryBuilder->andWhere('j.category = :category_id')
                ->andWhere('j.is_activated = :is_activated')
                ->setParameter('is_activated',1)
                ->setParameter(':category_id',$category_id);
        }
        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function cleanup($day){
        $query = $this->createQueryBuilder('j')
            ->delete()
            ->where('j.created_at < :date')
            ->andWhere('j.is_activated IS NULL')
            ->setParameter('date', date('Y-m-d H:i:s',time() - 86400 * $day ))
            ->getQuery();
       ;
        return $query->execute();

    }
}
