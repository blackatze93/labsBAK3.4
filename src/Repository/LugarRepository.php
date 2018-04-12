<?php

namespace App\Repository;

use App\Entity\Lugar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lugar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lugar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lugar[]    findAll()
 * @method Lugar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LugarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lugar::class);
    }

    /**
     * @return array
     */
    public function findAllVisibles()
    {
        return $this
            ->createQueryBuilder('lugares')
            ->where('lugares.visible = 1')
            ->orderBy('lugares.nombre', 'ASC')
            ->getQuery()->getResult();
    }

//    /**
//     * @return Lugar[] Returns an array of Lugar objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lugar
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
