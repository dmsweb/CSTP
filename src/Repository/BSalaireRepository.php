<?php

namespace App\Repository;

use App\Entity\BSalaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BSalaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method BSalaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method BSalaire[]    findAll()
 * @method BSalaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BSalaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BSalaire::class);
    }

    // /**
    //  * @return BSalaire[] Returns an array of BSalaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BSalaire
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
