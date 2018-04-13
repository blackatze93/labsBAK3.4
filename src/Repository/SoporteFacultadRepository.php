<?php

namespace App\Repository;

use App\Entity\SoporteFacultad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SoporteFacultad|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoporteFacultad|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoporteFacultad[]    findAll()
 * @method SoporteFacultad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoporteFacultadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SoporteFacultad::class);
    }

//    /**
//     * @return SoporteFacultad[] Returns an array of SoporteFacultad objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SoporteFacultad
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
