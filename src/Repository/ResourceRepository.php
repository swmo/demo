<?php

namespace App\Repository;

use App\Entity\Resource;
use App\Entity\ResourceGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function findByResourceGroupAndTimeframe($resourceGroups,$timeframe = null){
        $qb = $this->createQueryBuilder('resource');
        $resourceGroupIds=array();
        foreach($resourceGroups as $resourceGroup){
            $resourceGroupIds[] = $resourceGroup->getId();
        }

        $qb->leftJoin('resource.resourceGroups', 'resourceGroup')
        ;


        $qb->andWhere(
            $qb->expr()->in('resourceGroup.id', $resourceGroupIds)
        );

        return $qb
        ->orderBy('resource.name', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return Resource[] Returns an array of Resource objects
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
    public function findOneBySomeField($value): ?Resource
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
