<?php

namespace App\Repository;

use App\Entity\Author2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author2>
 *
 * @method Author2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author2[]    findAll()
 * @method Author2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Author2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author2::class);
    }

//    /**
//     * @return Author2[] Returns an array of Author2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Author2
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
