<?php

namespace App\Repository;

use App\Entity\ProductExemplary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductExemplary>
 *
 * @method ProductExemplary|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductExemplary|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductExemplary[]    findAll()
 * @method ProductExemplary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductExemplaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductExemplary::class);
    }

    //    /**
    //     * @return ProductExemplary[] Returns an array of ProductExemplary objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProductExemplary
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
