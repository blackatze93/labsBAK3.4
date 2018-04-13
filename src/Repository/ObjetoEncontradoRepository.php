<?php

namespace App\Repository;

use App\Entity\ObjetoEncontrado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ObjetoEncontrado|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjetoEncontrado|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjetoEncontrado[]    findAll()
 * @method ObjetoEncontrado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetoEncontradoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ObjetoEncontrado::class);
    }

//    /**
//     * @return ObjetoEncontrado[] Returns an array of ObjetoEncontrado objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ObjetoEncontrado
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
