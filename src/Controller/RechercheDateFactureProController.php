<?php

namespace App\Controller;

use App\Entity\FactureProFormat;
use App\Repository\FactureProFormatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RechercheDateFactureProController extends AbstractController
{
    #[Route('/recherche/date/facture/pro', name: 'app_recherche_date_facture_pro')]
    public function searchByDate( Request $request, FactureProFormatRepository $factureProFormatRepository ): Response
    {

        $dateDebut = $request->query->get('dateDebut');
        $dateFin = $request->query->get('dateFin');

        $queryBuilder = $factureProFormatRepository->createQueryBuilder('f')
            ->leftjoin('f.clients', 'c')
            ->leftjoin('f.detailFacture', 'df')
            ->leftjoin('df.produit', 'p')
            ->addSelect('c', 'df', 'p');

        if ($dateDebut) {
            $queryBuilder->andWhere('   DATE(f.date) >= :dateDebut')
                ->setParameter('dateDebut', $dateDebut);
        }

        if ($dateFin) {
            $queryBuilder->andWhere('DATE(f.date) <= :dateFin')
                ->setParameter('dateFin', $dateFin);
        }

        $facturePros = $queryBuilder->getQuery()->getResult();

        $data = [];
        foreach ($facturePros as $facturePro) {
            foreach ($facturePro->getDetailFacture() as $detail) {
                $data[] = [
                    'id' => $facturePro->getId(),
                    'nom' => $facturePro->getClients()->getNom(),
                    'typeSociete' => $facturePro->getClients()->getTypeSociete(),
                    'contact' => $facturePro->getClients()->getContact(),
                    'reference'=>$facturePro->getReference(),
                    'date' => $facturePro->getDate()->format('Y-m-d'),
                    'dateExpiration' => $facturePro->getDateEcheance()->format('Y-m-d'),
                    'produit' => $detail->getProduit()->getLibelle(),
                    'quantite' => $detail->getQuantite(),
                    'remise'=>$detail->getRemise(),
                    'prix' => $detail->getPrix(),
                    'totalTTC' => $facturePro->getTotalTTC(),
                    'totalHT' => $facturePro->getTotalHT(),
                    'totalTVA' => $facturePro->getTotalTVA(),

                ];
            }
        }
        return $this->render('recherche_date_facture_pro/index.html.twig', [
            'facturePro' => $data,

        ]);
    }
}
