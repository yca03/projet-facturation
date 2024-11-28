<?php

namespace App\Controller\OffreCommerciale;

use App\Entity\DetailFacture;
use App\Entity\FactureProFormat;
use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Form\FactureProFormatType;
use App\Form\OffreCommerciale\OffreCommercialeType;
use App\Repository\OffreCommerciale\OffreCommercialeRepository;
use App\Repository\ProduitRepository;
use App\Statut\Statut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/offre/commerciale')]
final class OffreCommercialeController extends AbstractController
{
    #[Route(name: 'app_offre_commerciale_index', methods: ['GET'])]
    public function index(OffreCommercialeRepository $offreCommercialeRepository): Response
    {
        return $this->render('offre_commerciale/index.html.twig', [
            'offre_commerciales' => $offreCommercialeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offre_commerciale_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offreCommerciale = new OffreCommerciale();
        $form = $this->createForm(OffreCommercialeType::class, $offreCommerciale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($offreCommerciale->getFactureProFormats() as $factureProFormat)
            {
                $factureProFormat->setOffreCommerciale($factureProFormat);
                $entityManager->persist($factureProFormat);
            }

            $entityManager->persist($offreCommerciale);


            $offreCommerciale->setStatus(Statut::EN_ATTENTE);
            $entityManager->persist($offreCommerciale);
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('l\'offre commerciale a été enregistrée avec succès.');

            return $this->redirectToRoute('app_offre_commerciale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_commerciale/new.html.twig', [
            'offre_commerciale' => $offreCommerciale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_commerciale_show', methods: ['GET'])]
    public function show(OffreCommerciale $offreCommerciale, OffreCommercialeRepository $offreCommercialeRepository, ProduitRepository $produitRepository): Response
    {
        $otherProduits = $offreCommercialeRepository->findproduitother($offreCommerciale);

        $listeProduits = [];

        foreach ($otherProduits as $offre) {
            foreach ($offre->getTypeProduit()->getProduits() as $produit) {
                foreach ($produit->getDetailProduits() as $detailProduit) {
                    $produitData = [
                        'detailId' => $detailProduit->getId(),
                        'detailLibelle' => $detailProduit->getLibelle(),
                        'produitId' => $produit->getId(),
                        'sousDetails' => []
                    ];

                    foreach ($detailProduit->getRelationDetailPSousDetailPs() as $relationProduit) {
                        foreach ($relationProduit->getSousDetailProduit() as $sousDetailProduit) {

                            $produitData['sousDetails'][] = [
                                'libelle' => $sousDetailProduit->getLibelle(),
                                'sousDetailId'=>$sousDetailProduit->getId(),
                            ];
                        }
                    }

                    $listeProduits[] = $produitData;
                }
            }
        }
//dd($listeProduits);
        return $this->render('offre_commerciale/show.html.twig', [
            'offre_commerciale' => $offreCommerciale,
            'produits' => $produitRepository->findAll(),
            'listeProduits' => $listeProduits,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_offre_commerciale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffreCommerciale $offreCommerciale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreCommercialeType::class, $offreCommerciale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('l\'offre commerciale a été modifiée avec succès.');

            return $this->redirectToRoute('app_offre_commerciale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_commerciale/edit.html.twig', [
            'offre_commerciale' => $offreCommerciale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_commerciale_delete', methods: ['POST'])]
    public function delete(Request $request, OffreCommerciale $offreCommerciale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offreCommerciale->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($offreCommerciale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_commerciale_index', [], Response::HTTP_SEE_OTHER);
    }




    #[Route('/{id}/offre/soumission', name: 'app_offre_soumission', methods: ['POST'])]
    public function soumission(OffreCommerciale $offreCommerciale, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        $offreCommerciale->setStatus(Statut::VALIDATED);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('offre validé avec succès .');

        $url1 = $urlGenerator->generate('app_offre_commerciale_index', ['id' => $offreCommerciale->getId()]);

        return new RedirectResponse($url1);
    }


    #[Route('/{id}/convert', name: 'app_convert_to_offer', methods: ['GET', 'POST'])]
    public function convertion(
        int $id,
        OffreCommercialeRepository $offreCommercialeRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {

        $offre = $offreCommercialeRepository->find($id);

        $invoice = (new FactureProFormat())

            ->setDate($offre->getDateDebut())
            ->setClients($offre->getClients())
            ->setStatut(Statut::EN_ATTENTE)
            ->setOffreCommerciale($offre);

        $td = $offre->getFactureProFormats();

        $produits = $offre->getTypeProduit()->getProduits();

//        $produitsArray = $produits->toArray();

        foreach ($produits as $produit) {
                $newDetail = (new DetailFacture())
                    ->setProduit($produit)
                    ->setQuantite((int)
                    $produit->getQuantite())
                    ->setPrix($produit->getPrix())
                    ->setFactureProformat($invoice);

                $invoice->addDetailFacture($newDetail);
        }


        $form = $this->createForm(FactureProFormatType::class,$invoice);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $offre->setStatus(Statut::CONVERTED);
            foreach ($invoice->getDetailFacture() as $invoiceDetail)
            {
                $invoiceDetail->setFactureProformat($invoice);
                $entityManager->persist($invoiceDetail);
            }
            $entityManager->persist($invoice);
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_commerciale_index',['id'=> $invoice->getId()],Response::HTTP_SEE_OTHER) ;
        }

        return $this->render('facture_pro_format/new.html.twig',[
            'form'=>$form->createView(),
        ]);

    }
}
