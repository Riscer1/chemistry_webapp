<?php

namespace App\Repository;

use App\Entity\AkiRef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AkiRef|null find($id, $lockMode = null, $lockVersion = null)
 * @method AkiRef|null findOneBy(array $criteria, array $orderBy = null)
 * @method AkiRef[]    findAll()
 * @method AkiRef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AkiRefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AkiRef::class);
    }

    // /**
    //  * @return AkiRef[] Returns an array of AkiRef objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AkiRef
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
