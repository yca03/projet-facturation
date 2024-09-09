<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\Facture;
use App\Statut\Statut;
use App\Form\Facture\FactureType;
use App\Repository\ClientsRepository;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/facture')]
class FactureController extends AbstractController
{
    #[Route('/', name: 'app_facture_index_pending', methods: ['GET'])]
    public function index(FactureRepository $factureRepository): Response
    {

        return $this->render('facture/index_valide.html.twig', [
            'factures' => $factureRepository->findFacturePending(),
        ]);
    }

    #[Route('/facture/valider', name: 'app_facture_show_valider', methods: ['GET'])]
    public function valided(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/show.html.twig', [
            'factures' => $factureRepository->findFactureValided(),
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

            // pour set la valeur en attente dans le champs status
            $facture->setStatut(Statut::BROUILLON);


            foreach ($facture->getDetailFactures() as $detailFacture) {
                $detailFacture->setFacture($facture);
                $entityManager->persist($detailFacture);
            }

            $entityManager->flush();

            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations enregistrées avec succès.');

            return $this->redirectToRoute('app_facture_info', [], Response::HTTP_SEE_OTHER);
        }


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
                    'timeout' => 3000,
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
                    'statut'=>$facture->getStatut(),
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
                    'statutPaye'=>$facture->getStatutPaye(),
                    'remise' => $detail->getRemise(),
                ];
            }
        }

        return $this->render('facture/info.html.twig', [
            'factures' => $data,
        ]);

    }







    #[Route('/{id}/facture/valider', name: 'app_facture_valider', methods: ['POST'])]
    public function valider(Facture $facture, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, Security $security): Response {

        if ($security->isGranted('ROLE_VALIDED_FACTURE')) {
            $facture->setStatut(Statut::VALIDATED);
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000,
                    'position' => 'bottom-right',
                ])
                ->success('La facture a été validée avec succès.');

            $url = $urlGenerator->generate('app_facture_index_pending', ['id' => $facture->getId()]);
            return new RedirectResponse($url);
        }
        if ($facture->getStatut() !== Statut::EN_ATTENTE) {
            flash()
                ->options([
                    'timeout' => 3000,
                    'position' => 'bottom-right',
                ])
                ->warning('La facture doit être soumise avant la validation.');

            $url = $urlGenerator->generate('app_facture_index_pending', ['id' => $facture->getId()]);
            return new RedirectResponse($url);
        }

        $facture->setStatut(Statut::VALIDATED);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000,
                'position' => 'bottom-right',
            ])
            ->success('La facture a été validée avec succès.');

        $url = $urlGenerator->generate('app_facture_index_pending', ['id' => $facture->getId()]);
        return new RedirectResponse($url);
    }


    #[Route('/{id}/facture/soumission', name: 'app_facture_soumission', methods: ['POST'])]
    public function soumission(Facture $facture, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        $facture->setStatut(Statut::EN_ATTENTE);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000,
                'position' => 'bottom-right',
            ])
            ->success('la facture   soumise  avec succès .');

        $url1 = $urlGenerator->generate('app_facture_info', ['id' => $facture->getId()]);

        return new RedirectResponse($url1);
    }

    #[Route('/{id}/facture/annulation', name: 'app_facture_annulation', methods: ['POST'])]
    public function annulation(Facture $facture, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        $facture->setStatut(Statut::CANCELLED);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000,
                'position' => 'bottom-right',
            ])
            ->success('la facture annulée avec succès .');

        $url2 = $urlGenerator->generate('app_facture_index_pending', ['id' => $facture->getId()]);
        return new RedirectResponse($url2);
    }



    #[Route('{id}/tableFacture', name: 'app_table_facture')]
    public function vueFacture($id, FactureRepository $factureRepository): Response
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
            'dateExpirationFacture'=>$facture->getDateExpiration(),
            'clientcontact'=>$facture->getIdClient()->getContact(),
            'codeFacture' => $facture->getCodeFacture(),
            'reference' => $facture->getReference(),
            'modePayement'=>$facture->getModePayement(),
            'dateFacture' => $facture->getDate()->format('y-m-d'),
            'statut'=>$facture->getStatut(),
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
        return $this->render('facture/table_facture.html.twig', [
            'facture' => $data,
        ]);
    }


    #[Route('/get/references', name: 'get_facture_references', methods: ['GET'])]
    public function getReferences(Request $request, FactureRepository $factureRepository): JsonResponse
    {
        $clientId = $request->query->get('clientId');
        if (!$clientId) {
            return new JsonResponse(['error' => 'Client ID non fourni'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $factures = $factureRepository->findByClientAndStatut(['IdClient' => $clientId], 'validée');

        // Formater les données pour la réponse JSON
        $data = array_map(function($facture) {
            return [
                'id' => $facture->getId(),
                'label' => $facture->getReference(),
                'totalTTC' => $facture->getTotalTTC(),
                'reste'=>$facture->getReste(),
            ];
        }, $factures);

        return new JsonResponse($data);
    }



}
