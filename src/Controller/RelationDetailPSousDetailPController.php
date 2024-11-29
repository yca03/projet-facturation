<?php

namespace App\Controller;

use App\Entity\RelationDetailPSousDetailP;
use App\Entity\SousDetailProduit;
use App\Form\RelationDetailPSousDetailPType;
use App\Repository\RelationDetailPSousDetailPRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/relation/detail/p/sous/detail/p')]
final class RelationDetailPSousDetailPController extends AbstractController
{
    #[Route(name: 'app_relation_detail_p_sous_detail_p_index', methods: ['GET'])]
    public function index(RelationDetailPSousDetailPRepository $relationDetailPSousDetailPRepository): Response
    {
        return $this->render('relation_detail_p_sous_detail_p/index.html.twig', [
            'relation_detail_p_sous_detail_ps' => $relationDetailPSousDetailPRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_relation_detail_p_sous_detail_p_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $relationDetailPSousDetailP = new RelationDetailPSousDetailP();
        $form = $this->createForm(RelationDetailPSousDetailPType::class, $relationDetailPSousDetailP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($relationDetailPSousDetailP->getSousDetailProduit() as $detailProduit) {
                $detailProduit->setRelationDetailPSousDetailP($relationDetailPSousDetailP);
                $entityManager->persist($detailProduit);
            }
            $entityManager->persist($relationDetailPSousDetailP);
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('Information  enregistrée avec succès.');

            return $this->redirectToRoute('app_relation_detail_p_sous_detail_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('relation_detail_p_sous_detail_p/new.html.twig', [
            'relation_detail_p_sous_detail_p' => $relationDetailPSousDetailP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_relation_detail_p_sous_detail_p_show', methods: ['GET'])]
    public function show(RelationDetailPSousDetailP $relationDetailPSousDetailP): Response
    {
        return $this->render('relation_detail_p_sous_detail_p/show.html.twig', [
            'relation_detail_p_sous_detail_p' => $relationDetailPSousDetailP,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_relation_detail_p_sous_detail_p_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RelationDetailPSousDetailP $relationDetailPSousDetailP, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelationDetailPSousDetailPType::class, $relationDetailPSousDetailP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($relationDetailPSousDetailP->getSousDetailProduit() as $detailProduit) {
                $detailProduit->setRelationDetailPSousDetailP($relationDetailPSousDetailP);
                $entityManager->persist($detailProduit);
            }

            // Traiter les suppressions (si vous avez supprimé des éléments de la collection)
            $existingSousDetailProduits = $entityManager->getRepository(SousDetailProduit::class)->findBy([
                'relationDetailPSousDetailP' => $relationDetailPSousDetailP
            ]);

            // Vérifier et supprimer les éléments qui ne sont plus dans la collection
            foreach ($existingSousDetailProduits as $existingDetailProduit) {
                if (!$relationDetailPSousDetailP->getSousDetailProduit()->contains($existingDetailProduit)) {
                    // L'élément n'est plus dans la collection, donc il doit être supprimé
                    $entityManager->remove($existingDetailProduit);
                }
            }
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000,
                    'position' => 'bottom-right',
                ])
                ->success('informations  modifiées avec succès.');

            return $this->redirectToRoute('app_relation_detail_p_sous_detail_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('relation_detail_p_sous_detail_p/edit.html.twig', [
            'relation_detail_p_sous_detail_p' => $relationDetailPSousDetailP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_relation_detail_p_sous_detail_p_delete', methods: ['POST'])]
    public function delete(Request $request, RelationDetailPSousDetailP $relationDetailPSousDetailP, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relationDetailPSousDetailP->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($relationDetailPSousDetailP);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_relation_detail_p_sous_detail_p_index', [], Response::HTTP_SEE_OTHER);
    }
}
