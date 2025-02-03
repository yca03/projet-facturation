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


// pour le home
    public function getTotalAmount(): float
    {
        return (float) $this->createQueryBuilder('f')
            ->select('SUM(f.totalTTC)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getTotalAmountByStatuses(array $statuses): float
    {
        return (float) $this->createQueryBuilder('f')
            ->select('SUM(f.totalTTC)')
            ->where('f.StatutPaye IN (:statuses)')
            ->setParameter('statuses', $statuses)
            ->getQuery()
            ->getSingleScalarResult();
    }


    public function countFacturesByStatuses(array $statuses): int
    {
        return (int) $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->where('f.StatutPaye IN (:statuses)')
            ->setParameter('statuses', $statuses)
            ->getQuery()
            ->getSingleScalarResult();
    }




    //end



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

    public function findByClientAndStatut(array $criteria, string $statut)
    {
        return $this->createQueryBuilder('f')
            ->where('f.IdClient = :clientId')
            ->andWhere('f.statut = :statut')
            ->andWhere('f.StatutPaye IS NULL OR f.StatutPaye = :Partielle') //2
            ->setParameter('clientId', $criteria['IdClient'])
            ->setParameter('statut', $statut)
            ->setParameter('Partielle', 'partielle') //2
            ->getQuery()
            ->getResult();
    }


    // c est requete pour la notification juste en bas
    public function countFacturesPending(): int
    {
        return (int) $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->where('f.statut = :statut')
            ->setParameter('statut', Statut::EN_ATTENTE)
            ->getQuery()
            ->getSingleScalarResult();
    }

//
//    public  function  alertHome()
//    {
//        return $this->createQueryBuilder('f')
//            ->join('f.Idclients','fc')
//            ->select('f.dateExpiration')
//    }

}
