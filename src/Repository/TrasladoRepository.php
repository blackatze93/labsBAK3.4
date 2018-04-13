<?php

namespace App\Repository;

use App\Entity\Traslado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Traslado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traslado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traslado[]    findAll()
 * @method Traslado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrasladoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Traslado::class);
    }

//    /**
//     * @return Traslado[] Returns an array of Traslado objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Traslado
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
