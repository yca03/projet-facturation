<?php

namespace App\Controller;

use App\Entity\Notify;
use App\Form\NotifyType;
use App\Repository\NotifyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/notify')]
final class NotifyController extends AbstractController
{
    #[Route(name: 'app_notify_index', methods: ['GET'])]
    public function index(NotifyRepository $notifyRepository): Response
    {
        return $this->render('notify/index.html.twig', [
            'notifies' => $notifyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_notify_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $notify = new Notify();
        $form = $this->createForm(NotifyType::class, $notify);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($notify);
            $entityManager->flush();

            return $this->redirectToRoute('app_notify_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('notify/new.html.twig', [
            'notify' => $notify,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_notify_show', methods: ['GET'])]
    public function show(Notify $notify): Response
    {
        return $this->render('notify/show.html.twig', [
            'notify' => $notify,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_notify_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Notify $notify, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NotifyType::class, $notify);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_notify_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('notify/edit.html.twig', [
            'notify' => $notify,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_notify_delete', methods: ['POST'])]
    public function delete(Request $request, Notify $notify, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notify->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($notify);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_notify_index', [], Response::HTTP_SEE_OTHER);
    }
}
