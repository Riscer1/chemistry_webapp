<?php

namespace App\Repository;

use App\Entity\EnergyLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnergyLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnergyLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnergyLevel[]    findAll()
 * @method EnergyLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnergyLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnergyLevel::class);
    }

    // /**
    //  * @return EnergyLevel[] Returns an array of EnergyLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnergyLevel
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function deleteAllEnergyByJonizationLevelId($id)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e. = :id')
            ->setParameter('id', $id)
            ->delete()
            ->getQuery()
            ->getResult()
            ;
    }
}
