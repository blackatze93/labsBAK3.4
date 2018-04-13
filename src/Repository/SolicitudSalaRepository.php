<?php

namespace App\Repository;

use App\Entity\SolicitudSala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SolicitudSala|null find($id, $lockMode = null, $lockVersion = null)
 * @method SolicitudSala|null findOneBy(array $criteria, array $orderBy = null)
 * @method SolicitudSala[]    findAll()
 * @method SolicitudSala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitudSalaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SolicitudSala::class);
    }

//    /**
//     * @return SolicitudSala[] Returns an array of SolicitudSala objects
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
    public function findOneBySomeField($value): ?SolicitudSala
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
