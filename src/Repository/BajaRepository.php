<?php

namespace App\Repository;

use App\Entity\Baja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Baja|null find($id, $lockMode = null, $lockVersion = null)
 * @method Baja|null findOneBy(array $criteria, array $orderBy = null)
 * @method Baja[]    findAll()
 * @method Baja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BajaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Baja::class);
    }

//    /**
//     * @return Baja[] Returns an array of Baja objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Baja
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
