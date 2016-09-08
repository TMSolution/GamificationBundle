<?php

namespace TMSolution\GamificationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 */
class LevelRepository extends EntityRepository
{
    /*
      select * from gamification_level
      where points <=990
      order by points desc
      limit 1
     */

    public function findOneLevelByPoints($userPoints)
    {
        
        
        $levels= $this->createQueryBuilder('lvl')
                        ->where('lvl.points <= :points')
                        ->setParameter('points', $userPoints)
                        ->orderBy("lvl.points", "DESC")
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getResult();
        if(count($levels)>0){
            return $levels[0];
        }
        return false;
    }

}
