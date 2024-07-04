<?php

namespace App\Controller;

use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImpressionController extends AbstractController
{
    #[Route('{id}/impression', name: 'app_impression')]
    public function index($id, FactureRepository $factureRepository): Response
    {
        // Récupérer la facture par son ID
        $facture = $factureRepository->find($id);

        // Vérifier si la facture existe
        if (!$facture) {
            throw $this->createNotFoundException('Facture non trouvée');
        }

        // Calculer le montant total TTC
        $totalTTC = 0;
        foreach ($facture->getDetailFactures() as $detail) {
            $totalTTC += $detail->getMontantTTC();
        }

        // Convertir le montant total TTC en lettres
        $totalTTCInWords = convertNumberToWords($totalTTC);

        // Préparer les données pour l'affichage
        $data = [
            'idFacture' => $facture->getId(),
            'clientNom' => $facture->getIdClient()->getNom(),
            'clientadresse' => $facture->getIdClient()->getAdresse(),
            'dateExpirationFacture'=>$facture->getDateExpiration(),
            'clientcontact'=>$facture->getIdClient()->getContact(),
            'codeFacture' => $facture->getCodeFacture(),
            'reference' => $facture->getReference(),
            'modePayement'=>$facture->getModePayement(),
            'dateFacture' => $facture->getDate()->format('y-m-d'),
            'detailFactures' => [],
            'totalTTC' => $totalTTC,
            'totalTTCInWords' => $totalTTCInWords,
        ];

        // Récupérer les détails de la facture
        foreach ($facture->getDetailFactures() as $detail) {
            $data['detailFactures'][] = [
                'produit' => $detail->getProduit()->getLibelle(),
                'quantite' => $detail->getQuantite(),
                'prix' => $detail->getPrix(),
                'montantTTC' => $detail->getMontantTTC(),
                'montantHT' => $detail->getMontantHT(),
                'montantTVA' => $detail->getMontantTVA(),
                'remise' => $detail->getRemise(),

            ];
        }

        // Rendre la vue avec les données de la facture
        return $this->render('impression/index.html.twig', [
            'facture' => $data,
        ]);
    }
}