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

    public function findByClientAndStatut(array $criteria, string $statut)
    {
        return $this->createQueryBuilder('f')
            ->where('f.IdClient = :clientId')
            ->andWhere('f.statut = :statut')
            ->andWhere('f.StatutPaye IS NULL OR f.StatutPaye = :moitiePaye') //2
            ->setParameter('clientId', $criteria['IdClient'])
            ->setParameter('statut', $statut)
            ->setParameter('moitiePaye', 'moitié-payé') //2
            ->getQuery()
            ->getResult();
    }


}
