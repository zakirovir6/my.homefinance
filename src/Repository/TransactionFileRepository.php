<?php

namespace App\Repository;

use App\Entity\TransactionFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransactionFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransactionFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransactionFile[]    findAll()
 * @method TransactionFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransactionFile::class);
    }

//    /**
//     * @return TransactionFile[] Returns an array of TransactionFile objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TransactionFile
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
