<?php

namespace App\Controller;

use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtatController extends AbstractController
{
    #[Route('/liste/etat', name: 'app_list_etat', methods: ['GET'])]
    public function allFactureInfo(FactureRepository $factureRepository): Response
    {
        // Obtenir toutes les factures avec les détails et les clients associés
        $factures = $factureRepository->createQueryBuilder('f')
            ->leftJoin('f.IdClient', 'c')
            ->leftJoin('f.detailFactures', 'df')
            ->leftJoin('df.produit', 'p')
            ->addSelect('c', 'df', 'p')
            ->getQuery()
            ->getResult();

        // Préparer les données pour la vue
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
                    'dateFacture' => $facture->getDate()->format('Y-m-d'),
                    'produit' => $detail->getProduit()->getLibelle(),
                    'quantite' => $detail->getQuantite(),
                    'prix' => $detail->getPrix(),
                    'montantTTC' => $detail->getMontantTTC(),
                    'montantHT' => $detail->getMontantHT(),
                    'montantTVA' => $detail->getMontantTVA(),
                    'remise' => $detail->getRemise(),
                ];
            }
        }

        return $this->render('etat/index.html.twig', [
            'factures' => $data,
        ]);
    }
}
