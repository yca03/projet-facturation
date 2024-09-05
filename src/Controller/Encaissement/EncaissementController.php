<?php

namespace App\Controller\Encaissement;

use App\Entity\Encaissement\Encaissement;
use App\Entity\Facture;
use App\Form\Encaissement\EncaissementType;
use App\Repository\DetailModePayement\DetailModePayementRepository;
use App\Repository\DetatilEncaissement\DetatilEncaissementRepository;
use App\Repository\Encaissement\EncaissementRepository;
use App\Statut\Statut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

            if ($encaissement->getStatut() === null) {
                $encaissement->setStatut(Statut::EN_ATTENTE);
            }

            
            foreach($encaissement->getDetailModePayements() as $detailModePayement){
                $detailModePayement->setEncaissement($encaissement);
             }

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


    #[Route('/encaissement/{id}/details', name: 'app_encaissement_details', methods: ['GET'])]
    public function details(
        EncaissementRepository $encaissementRepository,
        DetatilEncaissementRepository $detatilEncaissementRepository,
        DetailModePayementRepository $detailModePayementRepository,
        int $id
    ): Response {

        $encaissement = $encaissementRepository->find($id);

        if (!$encaissement) {
            throw $this->createNotFoundException('Encaissement non trouvé');
        }


        $detatilEncaissements = $detatilEncaissementRepository->findBy(['Encaissement' => $id]);


        $detailModePayements = $detailModePayementRepository->findBy(['encaissement' => $id]);


        return $this->render('encaissement/show_detail.html.twig', [
            'encaissement' => $encaissement,
            'detatilEncaissements' => $detatilEncaissements,
            'detailModePayements' => $detailModePayements,
        ]);
    }

    #[Route('/encaissemnt/{id}/validation', name: 'app_encaissement_valider', methods: ['POST'])]
    public function validation(Encaissement $encaissement, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        // Met à jour le statut de la facture
        $encaissement->setStatut(Statut::VALIDATED);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('Encaissement validé avec succès .');

        // Génére l'URL pour la redirection
        $url2 = $urlGenerator->generate('app_encaissement_index', ['id' => $encaissement->getId()]);

        // Redirige vers la page de la facture
        return new RedirectResponse($url2);
    }


    #[Route('/encaissemnt/{id}/annulation', name: 'app_encaissement_annule', methods: ['POST'])]
    public function annulation(Encaissement $encaissement, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        // Met à jour le statut de la facture
        $encaissement->setStatut(Statut::CANCELLED);
        $entityManager->flush();

        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('Encaissement annulé avec succès .');

        // Génére l'URL pour la redirection
        $url2 = $urlGenerator->generate('app_encaissement_index', ['id' => $encaissement->getId()]);

        // Redirige vers la page de la facture
        return new RedirectResponse($url2);
    }


}
