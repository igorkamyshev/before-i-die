<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class PostRepository extends EntityRepository
{
    public function findLastPosts($limit = 15)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('p');

        $result = $qb
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->setMaxResults($limit)
            ->getArrayResult();

        return $result;
    }

}