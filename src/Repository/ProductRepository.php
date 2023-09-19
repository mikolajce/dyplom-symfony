<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return ProductController[] Returns an array of ProductController objects
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

    public function findAllCheaperThanPrice(int $price): array
    {
//        $em = $this->getEntityManager();
//        $q = $em->createQuery(
//          'SELECT p
//            FROM App\Entity\Product p
//            WHERE p.price <= :price
//            ORDER BY p.price ASC'
//        )->setParameter('price', $price);
//
//        return $q->getResult();

        $qb = $this->createQueryBuilder('p')
            ->where('p.price <= :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC');

        $q = $qb->getQuery();
        return $q->execute();
    }

//    public function findOneBySomeField($value): ?ProductController
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
