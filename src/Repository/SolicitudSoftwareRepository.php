<?php

namespace App\Repository;

use App\Entity\SolicitudSoftware;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SolicitudSoftware|null find($id, $lockMode = null, $lockVersion = null)
 * @method SolicitudSoftware|null findOneBy(array $criteria, array $orderBy = null)
 * @method SolicitudSoftware[]    findAll()
 * @method SolicitudSoftware[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitudSoftwareRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SolicitudSoftware::class);
    }

//    /**
//     * @return SolicitudSoftware[] Returns an array of SolicitudSoftware objects
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
    public function findOneBySomeField($value): ?SolicitudSoftware
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
