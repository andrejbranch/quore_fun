<?php

namespace QuoreFun\Entity;

use Doctrine\ORM\EntityRepository;

class PropertyRepository extends EntityRepository
{
    public function findByRegionToArray($regionId)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.region', 'r')
            ->where('r.id = :regionId')
            ->setParameter('regionId', $regionId)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findByRegionId($regionId)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.region', 'r')
            ->where('r.id = :regionId')
            ->setParameter('regionId', $regionId)
            ->getQuery()
            ->execute()
        ;
    }
}
