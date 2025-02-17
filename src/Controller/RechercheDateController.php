<?php

namespace App\Controller;

use App\Repository\FactureRepository;
use App\Statut\Statut;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RechercheDateController extends AbstractController
{
    #[Route('/search', name: 'app_recherche_date', methods: ['GET'])]
    public function searchByDate(Request $request, FactureRepository $factureRepository): Response
    {
        $dateDebut = $request->query->get('dateDebut');
        $dateFin = $request->query->get('dateFin');


        $queryBuilder = $factureRepository->createQueryBuilder('f')
            ->leftjoin('f.IdClient', 'c')
            ->leftjoin('f.detailFactures', 'df')
            ->leftjoin('df.produit', 'p')
//            ->where('f.StatutPaye = :statutPaye')
//            ->setParameter('statutPaye',Statut::PAID)
            ->addSelect('c', 'df', 'p');

        if ($dateDebut) {
            $queryBuilder->andWhere('   DATE(f.date) >= :dateDebut')
                ->setParameter('dateDebut', $dateDebut);
        }

        if ($dateFin) {
            $queryBuilder->andWhere('DATE(f.date) <= :dateFin')
                ->setParameter('dateFin', $dateFin);
        }

        $factures = $queryBuilder->getQuery()->getResult();

        $data = [];
        foreach ($factures as $facture) {
            foreach ($facture->getDetailFactures() as $detail) {
                $data[] = [
                    'idFacture' => $facture->getId(),
                    'clientNom' => $facture->getIdClient()->getNom(),
                    'clientadresse' => $facture->getIdClient()->getAdresse(),
                    'clientTypeSociete' => $facture->getIdClient()->getTypeSociete(),
                    'clientcontact' => $facture->getIdClient()->getContact(),
                    'clientnumeroCompteContribuable' => $facture->getIdClient()->getNumeroCompteContribuable(),
                    'codeFacture' => $facture->getCodeFacture(),
                    'reference'=>$facture->getReference(),
                    'dateFacture' => $facture->getDate()->format('d-m-Y'),
                    'statut'=>$facture->getStatutPaye(),
                    'produit' => $detail->getProduit()->getLibelle(),
                    'quantite' => $detail->getQuantite(),
                    'prix' => $detail->getPrix(),
                    'montantTTC' => $detail->getMontantTTC(),
                    'montantHT' => $detail->getMontantHT(),
                    'montantTVA' => $detail->getMontantTVA(),
                    'remise' => $detail->getRemise(),
                    'totalHT'=>$facture->getTotalHT(),
                    'totalTVA'=>$facture->getTotalTVA(),
                    'totalTTC'=>$facture->getTotalTTc()
                ];
            }
        }

        return $this->render('recherche_date/index.html.twig', [
            'factures' => $data,
        ]);
    }
}
