<?php

namespace App\Repository;

use App\Entity\JonizationLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JonizationLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method JonizationLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method JonizationLevel[]    findAll()
 * @method JonizationLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JonizationLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JonizationLevel::class);
    }

    // /**
    //  * @return JonizationLevel[] Returns an array of JonizationLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JonizationLevel
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
