<?php

namespace App\Repository\OffreCommerciale;

use App\Entity\OffreCommerciale\OffreCommerciale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OffreCommerciale>
 */
class OffreCommercialeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreCommerciale::class);
    }

    //    /**
    //     * @return OffreCommerciale[] Returns an array of OffreCommerciale objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OffreCommerciale
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findproduitother(): array
    {
        return $this->createQueryBuilder('o')
            ->join('o.typeProduit','ot')
            ->join('ot.produits','otp')
            ->join('otp.detailProduits','otpd')
            ->join('otpd.relationDetailPSousDetailPs','otpdr')
            ->groupBy('otpdr.id')
            ->getQuery()
            ->getResult();
    }
}
