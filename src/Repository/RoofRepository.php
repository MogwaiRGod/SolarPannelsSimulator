<?php

namespace App\Repository;

use App\Entity\Roof;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Roof>
 *
 * @method Roof|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roof|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roof[]    findAll()
 * @method Roof[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoofRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roof::class);
    }

//    /**
//     * @return Roof[] Returns an array of Roof objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Roof
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
