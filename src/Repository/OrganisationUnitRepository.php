<?php

namespace App\Repository;

use App\Entity\OrganisationUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrganisationUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrganisationUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrganisationUnit[]    findAll()
 * @method OrganisationUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganisationUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganisationUnit::class);
    }

    // /**
    //  * @return OrganisationUnit[] Returns an array of OrganisationUnit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrganisationUnit
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
