<?php

namespace App\Repository;

use App\Entity\BajaElemento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BajaElemento|null find($id, $lockMode = null, $lockVersion = null)
 * @method BajaElemento|null findOneBy(array $criteria, array $orderBy = null)
 * @method BajaElemento[]    findAll()
 * @method BajaElemento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BajaElementoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BajaElemento::class);
    }

//    /**
//     * @return BajaElemento[] Returns an array of BajaElemento objects
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
    public function findOneBySomeField($value): ?BajaElemento
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
