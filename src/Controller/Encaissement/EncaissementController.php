<?php

namespace App\Controller\Encaissement;

use App\Entity\Encaissement\Encaissement;
use App\Form\Encaissement\EncaissementType;
use App\Repository\Encaissement\EncaissementRepository;
use App\Statut\Statut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/encaissement')]
class EncaissementController extends AbstractController
{
    #[Route('/', name: 'app_encaissement_index', methods: ['GET'])]
    public function index(EncaissementRepository $encaissementRepository): Response
    {
        return $this->render('encaissement/index.html.twig', [
            'encaissements' => $encaissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_encaissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $encaissement = new Encaissement();
        $form = $this->createForm(EncaissementType::class, $encaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encaissement->setStatut(Statut::EN_ATTENTE);

            foreach ($encaissement->getDetatilEncaissements() as $detailEncaissement) {
                $detailEncaissement->setEncaissement($encaissement);
            }

            $entityManager->persist($encaissement);
            $entityManager->flush();

            $facturesTraitees = [];
            foreach ($encaissement->getDetatilEncaissements() as $detailEncaissement) {
                $facture = $detailEncaissement->getFacture();

                if ($facture && !in_array($facture->getId(), $facturesTraitees)) {
                    $facturesTraitees[] = $facture->getId();

                    $solde = $detailEncaissement->getSolde();
                    $facture->setReste($solde);

                    $statutPaye = ($solde == 0) ? Statut::PAID : Statut::PARTIAL_PAID;
                    $facture->setStatutPaye($statutPaye);

                    $entityManager->persist($facture);
                }
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_encaissement_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('encaissement/new.html.twig', [
            'encaissement' => $encaissement,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'app_encaissement_show', methods: ['GET'])]
    public function show(Encaissement $encaissement): Response
    {
        return $this->render('encaissement/show.html.twig', [
            'encaissement' => $encaissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_encaissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Encaissement $encaissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EncaissementType::class, $encaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_encaissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encaissement/edit.html.twig', [
            'encaissement' => $encaissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_encaissement_delete', methods: ['POST'])]
    public function delete(Request $request, Encaissement $encaissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encaissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($encaissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_encaissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
