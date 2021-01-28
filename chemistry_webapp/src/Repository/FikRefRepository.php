<?php

namespace App\Repository;

use App\Entity\FikRef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FikRef|null find($id, $lockMode = null, $lockVersion = null)
 * @method FikRef|null findOneBy(array $criteria, array $orderBy = null)
 * @method FikRef[]    findAll()
 * @method FikRef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FikRefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FikRef::class);
    }

    // /**
    //  * @return FikRef[] Returns an array of FikRef objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FikRef
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
