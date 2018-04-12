<?php

namespace App\Repository;

use App\Entity\PrestamoElemento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrestamoElemento|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrestamoElemento|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrestamoElemento[]    findAll()
 * @method PrestamoElemento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestamoElementoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrestamoElemento::class);
    }

//    /**
//     * @return PrestamoElemento[] Returns an array of PrestamoElemento objects
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
    public function findOneBySomeField($value): ?PrestamoElemento
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
