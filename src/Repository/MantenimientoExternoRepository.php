<?php

namespace App\Repository;

use App\Entity\MantenimientoExterno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MantenimientoExterno|null find($id, $lockMode = null, $lockVersion = null)
 * @method MantenimientoExterno|null findOneBy(array $criteria, array $orderBy = null)
 * @method MantenimientoExterno[]    findAll()
 * @method MantenimientoExterno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MantenimientoExternoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MantenimientoExterno::class);
    }

//    /**
//     * @return MantenimientoExterno[] Returns an array of MantenimientoExterno objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MantenimientoExterno
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
