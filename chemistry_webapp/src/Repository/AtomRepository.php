<?php

namespace App\Repository;

use App\Entity\Atom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Atom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Atom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Atom[]    findAll()
 * @method Atom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atom::class);
    }

    public function findAllAtoms(): array
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getArrayResult();
    }

    public function findOneByAtomSymbol($value): ?Atom
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'd')
            ->andWhere('a.symbol = :val')
            ->setParameter('val', $value)
            ->leftJoin('a.images', 'd')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByName($value): ?Atom
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'd')
            ->andWhere('a.name = :val')
            ->setParameter('val', $value)
            ->leftJoin('a.images', 'd')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
