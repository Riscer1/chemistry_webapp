<?php

namespace App\Repository;

use App\Entity\OscillatorStrength;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OscillatorStrength|null find($id, $lockMode = null, $lockVersion = null)
 * @method OscillatorStrength|null findOneBy(array $criteria, array $orderBy = null)
 * @method OscillatorStrength[]    findAll()
 * @method OscillatorStrength[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OscillatorStrengthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OscillatorStrength::class);
    }

    // /**
    //  * @return OscillatorStrength[] Returns an array of OscillatorStrength objects
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
    public function findOneBySomeField($value): ?OscillatorStrength
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
