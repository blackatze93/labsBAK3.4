<?php

namespace App\Repository;

use App\Entity\PrestamoSemestral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrestamoSemestral|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrestamoSemestral|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrestamoSemestral[]    findAll()
 * @method PrestamoSemestral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestamoSemestralRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrestamoSemestral::class);
    }

//    /**
//     * @param array $criteria
//     *
//     * @return array
//     */
//    public function findRangoPrestamoSemestral(array $criteria)
//    {
//        return $this
//            ->createQueryBuilder('horarios')
//            ->where(':horaInicio >= horarios.horaInicio AND :horaInicio < horarios.horaFin')
//            ->orWhere(':horaFin > horarios.horaInicio AND :horaFin <= horarios.horaFin')
//            ->andWhere('horarios.lugar = :lugar')
//            ->andWhere('horarios.fecha = :fecha')
//            ->setParameters($criteria)
//            ->getQuery()->getResult()
//            ;
//    }

//    /**
//     * @return PrestamoSemestral[] Returns an array of PrestamoSemestral objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrestamoSemestral
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
