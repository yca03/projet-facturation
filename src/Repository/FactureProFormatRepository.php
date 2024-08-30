<?php

namespace App\Repository;

use App\Entity\FactureProFormat;
use App\Statut\Statut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FactureProFormat>
 */
class FactureProFormatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactureProFormat::class);
    }

    //    /**
    //     * @return FactureProFormat[] Returns an array of FactureProFormat objects
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

    //    public function findOneBySomeField($value): ?FactureProFormat
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findFactureProPending()
    {
        $qb = $this->createQueryBuilder('f');
        $qb->where('f.statut = :statut')
            ->setParameter('statut',Statut::EN_ATTENTE);
        return $qb->getQuery()->getResult();
    }

    public function findFactureProValided()
    {
        $qb = $this->createQueryBuilder('f');
        $qb->where($qb->expr()->orX(
            $qb->expr()->eq('f.statut', ':validated'),
            $qb->expr()->eq('f.statut', ':converted')
        ))
            ->setParameter('validated', Statut::VALIDATED)
            ->setParameter('converted', Statut::CONVERTED);

        return $qb->getQuery()->getResult();
    }

}
