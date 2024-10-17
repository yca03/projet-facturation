<?php

namespace App\Controller;

use App\Entity\DetatilProduit;
use App\Form\DetatilProduitType;
use App\Repository\DetatilProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/detatil/produit')]
final class DetatilProduitController extends AbstractController
{
    #[Route(name: 'app_detatil_produit_index', methods: ['GET'])]
    public function index(DetatilProduitRepository $detatilProduitRepository): Response
    {
        return $this->render('detatil_produit/index.html.twig', [
            'detatil_produits' => $detatilProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detatil_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detatilProduit = new DetatilProduit();
        $form = $this->createForm(DetatilProduitType::class, $detatilProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detatilProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_detatil_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detatil_produit/new.html.twig', [
            'detatil_produit' => $detatilProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detatil_produit_show', methods: ['GET'])]
    public function show(DetatilProduit $detatilProduit): Response
    {
        return $this->render('detatil_produit/show.html.twig', [
            'detatil_produit' => $detatilProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detatil_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetatilProduit $detatilProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetatilProduitType::class, $detatilProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_detatil_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detatil_produit/edit.html.twig', [
            'detatil_produit' => $detatilProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detatil_produit_delete', methods: ['POST'])]
    public function delete(Request $request, DetatilProduit $detatilProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detatilProduit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($detatilProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_detatil_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
