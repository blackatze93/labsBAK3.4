<?php

namespace App\Repository;

use App\Entity\Pagina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pagina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pagina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pagina[]    findAll()
 * @method Pagina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaginaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pagina::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
