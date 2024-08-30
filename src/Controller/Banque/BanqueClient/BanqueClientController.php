<?php

namespace App\Controller\Banque\BanqueClient;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Form\Banque\BanqueClient\BanqueClientType;
use App\Repository\Banque\BanqueClient\BanqueClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/banque/client')]
class BanqueClientController extends AbstractController
{
    #[Route('/', name: 'app_banque_client_index', methods: ['GET'])]
    public function index(BanqueClientRepository $banqueClientRepository): Response
    {
        return $this->render('Banque/banque_client/index.html.twig', [
            'banque_clients' => $banqueClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_banque_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banqueClient = new BanqueClient();
        $form = $this->createForm(BanqueClientType::class, $banqueClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banqueClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_banque_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Banque/banque_client/new.html.twig', [
            'banque_client' => $banqueClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banque_client_show', methods: ['GET'])]
    public function show(BanqueClient $banqueClient): Response
    {
        return $this->render('banque_client/show.html.twig', [
            'banque_client' => $banqueClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_banque_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BanqueClient $banqueClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BanqueClientType::class, $banqueClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_banque_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('banque_client/edit.html.twig', [
            'banque_client' => $banqueClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banque_client_delete', methods: ['POST'])]
    public function delete(Request $request, BanqueClient $banqueClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banqueClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($banqueClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_banque_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
