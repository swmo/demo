<?php

namespace App\Repository;

use App\Entity\ResourceGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResourceGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResourceGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResourceGroup[]    findAll()
 * @method ResourceGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResourceGroup::class);
    }

    // /**
    //  * @return ResourceGroup[] Returns an array of ResourceGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResourceGroup
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
