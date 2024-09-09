<?php

namespace App\Repository;

use App\Entity\DetailFacture;
use App\Entity\FactureProFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<DetailFacture>
 */
class DetailFactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailFacture::class);
    }


    public function findDetailFactureByFacture(FactureProFormat $factureProFormat): array
    {
        $qb = $this->createQueryBuilder('df');
        $qb
            ->where($qb->expr()->eq('df.factureProformat', $factureProFormat))
        ;
        return  $qb->getQuery()->getResult();
    }
}
