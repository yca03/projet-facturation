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
        $facture = $factureRepository->find($id);

        if (!$facture) {
            throw $this->createNotFoundException('Facture non trouvée');
        }

        $totalTTC = 0;
        foreach ($facture->getDetailFactures() as $detail) {
            $totalTTC += $detail->getMontantTTC();
        }


        // Préparer les données pour l'affichage
        $data = [
            'idFacture' => $facture->getId(),
            'clientNom' => $facture->getIdClient()->getNom(),
            'clientadresse' => $facture->getIdClient()->getAdresse(),
            'numeroClients'=>$facture->getIdClient()->getNumeroClients(),
            'adressePostale'=>$facture->getIdClient()->getAdressePostale(),
            'telephone2'=>$facture->getIdClient()->getTelephone2(),
            'dateExpirationFacture'=>$facture->getDateExpiration(),
            'clientcontact'=>$facture->getIdClient()->getContact(),
            'codeFacture' => $facture->getCodeFacture(),
            'reference' => $facture->getReference(),
            'modePayement'=>$facture->getModePayement(),
            'dateFacture' => $facture->getDate()->format('y-m-d'),
            'totalHT'=>$facture->getTotalHT(),
            'totalTVA'=>$facture->getTotalTVA(),
            'totalTTC'=>$facture->getTotalTTC(),
            'description'=>$facture->getDescription(),
            'remise'=>$facture->getRemise(),
            'periode'=>$facture->getPeriode(),
            'detailFactures' => [],
            'totalTTC' => $totalTTC,
           
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

        return $this->render('impression/index.html.twig', [
            'facture' => $data,
        ]);
    }

    // info de la facture pgp

    #[Route('{id}/printPgp', name: 'app_print_pgp')]
    public function printPgp($id, FactureRepository $factureRepository): Response
    {
        $facture = $factureRepository->find($id);

        if (!$facture) {
            throw $this->createNotFoundException('Facture non trouvée');
        }

        $totalTTC = 0;
        foreach ($facture->getDetailFactures() as $detail) {
            $totalTTC += $detail->getMontantTTC();
        }


        // Préparer les données pour l'affichage
        $data = [
            'idFacture' => $facture->getId(),
            'clientNom' => $facture->getIdClient()->getNom(),
            'clientadresse' => $facture->getIdClient()->getAdresse(),
            'numeroClients'=>$facture->getIdClient()->getNumeroClients(),
            'adressePostale'=>$facture->getIdClient()->getAdressePostale(),
            'telephone2'=>$facture->getIdClient()->getTelephone2(),
            'dateExpirationFacture'=>$facture->getDateExpiration(),
            'clientcontact'=>$facture->getIdClient()->getContact(),
            'codeFacture' => $facture->getCodeFacture(),
            'reference' => $facture->getReference(),
            'modePayement'=>$facture->getModePayement(),
            'dateFacture' => $facture->getDate()->format('y-m-d'),
            'totalHT'=>$facture->getTotalHT(),
            'totalTVA'=>$facture->getTotalTVA(),
            'totalTTC'=>$facture->getTotalTTC(),
            'description'=>$facture->getDescription(),
            'remise'=>$facture->getRemise(),
            'periode'=>$facture->getPeriode(),
            'detailFactures' => [],
            'totalTTC' => $totalTTC,

        ];

        // Récupérer les détails de la facture
        foreach ($facture->getDetailFactures() as $detail) {
            $data['detailFactures'][] = [
                'produit' => $detail->getProduit()->getLibelle(),
//                'periode' =>$detail->getPeriode(),
                'quantite' => $detail->getQuantite(),
                'prix' => $detail->getPrix(),
                'montantTTC' => $detail->getMontantTTC(),
                'montantHT' => $detail->getMontantHT(),
                'montantTVA' => $detail->getMontantTVA(),
                'remise' => $detail->getRemise(),

            ];
        }

        return $this->render('impression/print_pgp.html.twig', [
            'facture' => $data,
        ]);
    }



}