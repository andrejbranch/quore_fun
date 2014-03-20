<?php

namespace QuoreFun\Entity; 

use Doctrine\ORM\EntityRepository;

class RegionRepository extends EntityRepository
{
    public function findAllToArray()
    {
        return $this->createQueryBuilder('r')
            ->getQuery()
            ->getArrayResult()
        ;
    }
}
