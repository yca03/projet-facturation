<?php

namespace App\Controller\Banque\BanqueOnly;

use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Form\Banque\BanqueOnly\BanqueOnlyType;
use App\Repository\Banque\BanqueOnly\BanqueOnlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/banque/only')]
class BanqueOnlyController extends AbstractController
{
    #[Route('/', name: 'app_banque_only_index', methods: ['GET'])]
    public function index(BanqueOnlyRepository $banqueOnlyRepository): Response
    {
        return $this->render('Banque/banque_only/index.html.twig', [
            'banque_onlies' => $banqueOnlyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_banque_only_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banqueOnly = new BanqueOnly();
        $form = $this->createForm(BanqueOnlyType::class, $banqueOnly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banqueOnly);
            $entityManager->flush();

            return $this->redirectToRoute('app_banque_only_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Banque/banque_only/new.html.twig', [
            'banque_only' => $banqueOnly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banque_only_show', methods: ['GET'])]
    public function show(BanqueOnly $banqueOnly): Response
    {
        return $this->render('Banque/banque_only/show.html.twig', [
            'banque_only' => $banqueOnly,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_banque_only_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BanqueOnly $banqueOnly, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BanqueOnlyType::class, $banqueOnly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_banque_only_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Banque/banque_only/edit.html.twig', [
            'banque_only' => $banqueOnly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banque_only_delete', methods: ['POST'])]
    public function delete(Request $request, BanqueOnly $banqueOnly, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banqueOnly->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($banqueOnly);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_banque_only_index', [], Response::HTTP_SEE_OTHER);
    }
}
