<?php

namespace App\Repository;

use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
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

    public function findByResourceGroupAndAvailableForShift($resourceGroups,Shift $shift = null){
        $qb = $this->createQueryBuilder('resource');
        $resourceGroupIds=array();
        foreach($resourceGroups as $resourceGroup){
            $resourceGroupIds[] = $resourceGroup->getId();
        }

        $qb->leftJoin('resource.resourceGroups', 'resourceGroup')
        ;

        $qb->leftJoin('resource.shiftWorks', 'shiftWork')
        ;
        $qb->leftJoin('shiftWork.shift', 'shift')
        ;


        /*

        You need to use query builder expressions, and this means you need access to the query builder object. Also, the code is easier to write if you generate the subselect list ahead of time:
*/
$qbResourcesAlreadyBookedDuringShiftTime = $this->createQueryBuilder('resource');

$resultResourcesAlreadyBookedDuringShiftTime = $qbResourcesAlreadyBookedDuringShiftTime
->select(['resource.id'])
        ->leftJoin('resource.shiftWorks', 'shiftWork')
        ->leftJoin('shiftWork.shift', 'shift')
    
          ->where($qbResourcesAlreadyBookedDuringShiftTime->expr()->eq('resource.id',60))
          ->getQuery()
          ->getResult();

          $qb->andWhere($qb->expr()->notIn('resource.id', ':subQuery'))
            ->setParameter('subQuery', $resultResourcesAlreadyBookedDuringShiftTime)
            ;
              
          /*

$linked = $qb->select('rl')
             ->from('MineMyBundle:MineRequestLine', 'rl')
             ->where($qb->expr()->notIn('rl.request_id', $resourcesAlreadyBookedDuringShiftTime))
             ->getQuery()
             ->getResult();

             */

/*
        
        $qb->andWhere(
            $qb->expr()->orX(
                $qb->expr()->isNull('shift.end'),
                $qb->expr()->gt('shift.end', ':end')   
            )
        )->setParameter('end', $shift->getEnd());
       

        $qb->andWhere(
            $qb->expr()->orX(
                $qb->expr()->isNull('shift.start'),
                $qb->expr()->lte('shift.start', ':start')   
            )
        )->setParameter('start', $shift->getStart());

        */

        $qb->andWhere(
            $qb->expr()->in('resourceGroup.id', $resourceGroupIds)
        );




            
           // $qb->expr()->notIn('resource.id', $resultResourcesAlreadyBookedDuringShiftTime));

         

        


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
