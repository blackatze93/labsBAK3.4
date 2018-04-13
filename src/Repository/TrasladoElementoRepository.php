<?php

namespace App\Repository;

use App\Entity\TrasladoElemento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrasladoElemento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrasladoElemento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrasladoElemento[]    findAll()
 * @method TrasladoElemento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrasladoElementoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrasladoElemento::class);
    }

//    /**
//     * @return TrasladoElemento[] Returns an array of TrasladoElemento objects
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
    public function findOneBySomeField($value): ?TrasladoElemento
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
