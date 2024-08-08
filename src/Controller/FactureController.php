<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\Facture;
use App\Form\Facture\FactureType;
use App\Repository\ClientsRepository;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/facture')]
class FactureController extends AbstractController
{
    #[Route('/', name: 'app_facture_index', methods: ['GET'])]
    public function index(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);
    }




    //pour la recuperation de la remise du client

    #[Route('/client/{id}/remise', name: 'app_client_remise', methods: ['GET'])]
    public function getRemise(Clients $clients): JsonResponse
    {
        return new JsonResponse(['remise' => $clients->getRemise()]);
    }





    #[Route('/new', name: 'app_facture_new', methods: ['GET', 'POST'])]
    public function new( FactureRepository $factureRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($facture);

            foreach ($facture->getDetailFactures() as $detailFacture) {
                $detailFacture->setFacture($facture);
                $entityManager->persist($detailFacture);
            }

            $entityManager->flush();

//flasher
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations enregistrées avec succès.');


            return $this->redirectToRoute('app_facture_info', [], Response::HTTP_SEE_OTHER);
        }

        //pour recuperer  la donnee de tva

        // Obtenir toutes les factures avec les détails et les clients associés
        $facture1 = $factureRepository->createQueryBuilder('f')
            ->leftJoin('f.IdClient', 'c')
            ->leftJoin('f.modePayement', 'fm')
            ->leftJoin('f.detailFactures', 'df')
            ->leftJoin('df.produit', 'p')
            ->addSelect('c', 'df', 'p')
            ->getQuery()
            ->getResult();

        // Préparer les données pour la vue
        $data1 = [];
        foreach ($facture1 as $facture) {
            foreach ($facture->getDetailFactures() as $detail) {
                $data1[] = [

                    'tva' => $detail->getProduit()->getTva(),

                ];
            }
        }




    return $this->render('facture/new.html.twig', [
        'facture' => $facture,
        'form' => $form,
        'facture1' => $data1,
    ]);
    }

    #[Route('/{id}', name: 'app_facture_show', methods: ['GET'])]
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_facture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations modifiées avec succès.');

            return $this->redirectToRoute('app_facture_info', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form,

        ]);
    }

    #[Route('/{id}', name: 'app_facture_delete', methods: ['POST'])]
    public function delete(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($facture);
            $entityManager->flush();


            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations supprimées avec succès.');
        }

        return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/facture/all_info', name: 'app_facture_info', methods: ['GET'])]
    public function allFactureInfo(FactureRepository $factureRepository): Response
    {
        // Obtenir toutes les factures avec les détails et les clients associés
        $factures = $factureRepository->createQueryBuilder('f')
            ->leftJoin('f.IdClient', 'c')
            ->leftJoin('f.modePayement', 'fm')
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
                    'dateExpirationFacture'=>$facture->getDateExpiration()->format('Y-m-d'),
                    'clientcontact' => $facture->getIdClient()->getContact(),
                    'clientnumeroCompteContribuable' => $facture->getIdClient()->getNumeroCompteContribuable(),

                    'modePayement'=>$facture->getModePayement(),
                    'codeFacture' => $facture->getCodeFacture(),
                    'reference'=>$facture->getReference(),
                    'dateFacture' => $facture->getDate()->format('Y-m-d'),
                    'produit' => $detail->getProduit()->getLibelle(),
                    'quantite' => $detail->getQuantite(),
                    'prix' => $detail->getPrix(),
                    'tva' => $detail->getProduit(),
                    'totalTTC' => $facture->getTotalTTC(),
                    'totalHT'=>$facture->getTotalHT(),
                    'totalTVA' => $facture->getTotalTVA(),
                    'remise' => $detail->getRemise(),
                ];
            }
        }

        return $this->render('facture/info.html.twig', [
            'factures' => $data,
        ]);


    }






}
