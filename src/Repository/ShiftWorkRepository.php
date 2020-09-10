<?php

namespace App\Repository;

use App\Entity\ShiftWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShiftWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShiftWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShiftWork[]    findAll()
 * @method ShiftWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShiftWorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShiftWork::class);
    }

    // /**
    //  * @return ShiftWork[] Returns an array of ShiftWork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShiftWork
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
