<?php

namespace App\Repository\Encaissement;

use App\Entity\Encaissement\Encaissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Encaissement>
 */
class EncaissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Encaissement::class);
    }

    //    /**
    //     * @return Encaissement[] Returns an array of Encaissement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Encaissement
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function findEncaissementsWithDetails()
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detatilEncaissements', 'de')
            ->leftJoin('de.facture', 'f')
            ->leftJoin('e.detailModePayements', 'dmp')
            ->leftJoin('dmp.banque', 'b')
            ->addSelect('de', 'f', 'dmp', 'b')
            ->getQuery()
            ->getResult();
    }
}
