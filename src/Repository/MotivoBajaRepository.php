<?php

namespace App\Repository;

use App\Entity\MotivoBaja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MotivoBaja|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotivoBaja|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotivoBaja[]    findAll()
 * @method MotivoBaja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotivoBajaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MotivoBaja::class);
    }

//    /**
//     * @return MotivoBaja[] Returns an array of MotivoBaja objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotivoBaja
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
