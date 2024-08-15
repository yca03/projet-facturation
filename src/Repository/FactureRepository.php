<?php

namespace App\Repository;

use App\Entity\Facture;
use App\Statut\Statut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Facture>
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }

//    /**
//     * @return facture[] Returns an array of facture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?facture
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findFacturePending()
    {
        $qb = $this->createQueryBuilder('f');
        $qb->where('f.statut = :statut')
            ->setParameter('statut',Statut::EN_ATTENTE);
        return $qb->getQuery()->getResult();
    }


    public function findFactureValided()
    {
        $qb = $this->createQueryBuilder('f');
        $qb->where('f.statut = :statut')
            ->setParameter('statut',Statut::VALIDATED);
        return $qb->getQuery()->getResult();
    }
}
