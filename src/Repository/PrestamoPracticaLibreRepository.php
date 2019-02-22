<?php

namespace App\Repository;

use App\Entity\PrestamoPracticaLibre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrestamoPracticaLibre|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrestamoPracticaLibre|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrestamoPracticaLibre[]    findAll()
 * @method PrestamoPracticaLibre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestamoPracticaLibreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrestamoPracticaLibre::class);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findPrestamosRango(array $criteria)
    {
        return $this
            ->createQueryBuilder('prestamos')
            ->select('MONTH(prestamos.fechaPrestamo) AS mes, COUNT(prestamos.id) AS total')
            ->where(':anio = YEAR(prestamos.fechaPrestamo)')
            ->andWhere('MONTH(prestamos.fechaPrestamo) BETWEEN :mesInicio AND :mesFin')
            ->groupBy('mes')
            ->setParameters($criteria)
            ->getQuery()->getResult()
            ;
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findPrestamosMes(array $criteria)
    {
        return $this
            ->createQueryBuilder('prestamos')
            ->select('DAY(prestamos.fechaPrestamo) AS dia, COUNT(prestamos.id) AS total')
            ->where(':mes = MONTH(prestamos.fechaPrestamo)')
            ->andWhere(':anio = YEAR(prestamos.fechaPrestamo)')
            ->groupBy('dia')
            ->setParameters($criteria)
            ->getQuery()->getResult()
            ;
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findPrestamosProyecto(array $criteria)
    {
        $qb = $this->createQueryBuilder('prestamos')
            ->select('proyectos.nombre, COUNT(prestamos.id)')
            ->innerJoin('prestamos.usuarioSolicita', 'usuarios', 'WITH', 'prestamos.usuarioSolicita = usuarios.id')
            ->innerJoin('usuarios.proyectoCurricular', 'proyectos', 'WITH', 'usuarios.proyectoCurricular = proyectos.id')
            ->where('prestamos.fechaPrestamo BETWEEN :fechaInicio AND :fechaFin')
            ->groupBy('usuarios.proyectoCurricular')
            ->setParameters($criteria)
            ->getQuery()->getResult()
            ;

        $out = array();

        foreach($qb as $row) {
            $out[] = array($row['nombre'], intval($row[1]));
        }

        return $out;
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findPrestamosSala(array $criteria)
    {
        $qb = $this->createQueryBuilder('prestamos')
            ->select('lugar.nombre, COUNT(prestamos.id)')
            ->innerJoin('prestamos.lugar', 'lugar', 'WITH', 'prestamos.lugar = lugar.id')
            ->where('prestamos.fechaPrestamo BETWEEN :fechaInicio AND :fechaFin')
            ->groupBy('lugar.nombre')
            ->setParameters($criteria)
            ->getQuery()->getResult()
        ;

        $out = array();

        foreach($qb as $row) {
            $out[] = array($row['nombre'], intval($row[1]));
        }

        return $out;
    }

//    /**
//     * @return PrestamoPracticaLibre[] Returns an array of PrestamoPracticaLibre objects
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
    public function findOneBySomeField($value): ?PrestamoPracticaLibre
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
