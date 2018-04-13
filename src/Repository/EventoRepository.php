<?php

namespace App\Repository;

use App\Entity\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evento[]    findAll()
 * @method Evento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findRangoEvento(array $criteria)
    {
        return $this
            ->createQueryBuilder('eventos')
            ->where(':horaInicio >= eventos.horaInicio AND :horaInicio < eventos.horaFin')
            ->orWhere(':horaFin > eventos.horaInicio AND :horaFin <= eventos.horaFin')
            ->andWhere('eventos.lugar = :lugar')
            ->andWhere('eventos.fecha = :fecha')
            ->setParameters($criteria)
            ->getQuery()->getResult()
            ;
    }

//    /**
//     * @return Evento[] Returns an array of Evento objects
//     */
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
    public function findOneBySomeField($value): ?Evento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
