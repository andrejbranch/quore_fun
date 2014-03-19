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

    public function findByIdToArray($id)
    {
        $result = $this->createQueryBuilder('r')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
        ;

        return $result[0];
    }
}
