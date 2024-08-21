<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Statut\Statut;
use App\Entity\FactureProFormat;
use App\Form\FactureProFormatType;
use App\Repository\FactureProFormatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;



#[Route('/facture/pro/format')]
class FactureProFormatController extends AbstractController
{
    #[Route('/', name: 'app_facture_pro_format_index_pending', methods: ['GET'])]
    public function index(FactureProFormatRepository $factureProFormatRepository): Response
    {
        return $this->render('facture_pro_format/index.html.twig', [
            'facture_pro_formats' => $factureProFormatRepository->findFactureProPending(),
        ]);
    }

    #[Route('/index_valider/', name: 'app_facture_pro_format_index_valider', methods: ['GET'])]
    public function indexValided(FactureProFormatRepository $factureProFormatRepository): Response
    {
        return $this->render('facture_pro_format/show.html.twig', [
            'facture_pro_formats' => $factureProFormatRepository->findFactureProValided(),
        ]);
    }


    //pour la recuperation de la remise du client

    #[Route('/clients/{id}/remise', name: 'app_client_remise', methods: ['GET'])]
    public function getRemise(Clients $clients): JsonResponse
    {
        return new JsonResponse(['remise' => $clients->getRemise()]);
    }





    #[Route('/new', name: 'app_facture_pro_format_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $factureProFormat = new FactureProFormat();
        $form = $this->createForm(FactureProFormatType::class, $factureProFormat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        // pour set la valeur en attente dans le champs status
            $factureProFormat->setStatut(Statut::BROUILLON);


            //pour setté dans la facture proforma
            foreach ($factureProFormat->getDetailFacture() as $detail)
            {
                $detail->setFactureProformat($factureProFormat);
                $entityManager->persist($detail);
            }
            $entityManager->persist($factureProFormat);

            $entityManager->flush();


            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations enregistrées avec succès.');




            return $this->redirectToRoute('app_facture_pro_format_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('facture_pro_format/new.html.twig', [
            'facture_pro_format' => $factureProFormat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_facture_pro_format_show', methods: ['GET'])]
    public function show(FactureProFormat $factureProFormat): Response
    {
        return $this->render('facture_pro_format/show.html.twig', [
            'facture_pro_format' => $factureProFormat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_facture_pro_format_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FactureProFormat $factureProFormat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureProFormatType::class, $factureProFormat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations modifiées avec succès.');

            return $this->redirectToRoute('app_facture_pro_format_info', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('facture_pro_format/edit.html.twig', [
            'facture_pro_format' => $factureProFormat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_facture_pro_format_delete', methods: ['POST'])]
    public function delete(Request $request, FactureProFormat $factureProFormat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factureProFormat->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($factureProFormat);
            $entityManager->flush();


            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('informations supprimées avec succès.');
        }

        return $this->redirectToRoute('app_facture_pro_format_info', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/facture_pro/all_info', name: 'app_facture_pro_format_info', methods: ['GET'])]
    public function allFactureProInfo(FactureProFormatRepository $factureProFormatRepository): Response
    {
        // Obtenir toutes les factures avec les détails et les clients associés
        $factureProFormats = $factureProFormatRepository->createQueryBuilder('fp')
            ->leftJoin('fp.clients', 'c')
            ->addSelect('c')
            ->getQuery()
            ->getResult();

        return $this->render('facture_pro_format/info.html.twig', [
            'facture_pro_formats' => $factureProFormats,
        ]);
    }

    #[Route('/{id}/impression/facture_pro_format', name: 'app_facture_pro_format_impression')]
    public function impression( FactureProFormat $factureProFormat): Response
    {
        return $this->render('facture_pro_format/impressionFactureProFormat.html.twig', [
            'facture_pro_format' => $factureProFormat,

        ]);
    }



    #[Route('/{id}/facture/pro/valider', name: 'app_facture_pro_format_valider', methods: ['POST'])]
    public function valider(FactureProFormat $factureProFormat, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator ,  Security $security): RedirectResponse
    {

        // Vérifie si l'utilisateur a le rôle ROLE_VALIDATED_FACTURE
        if ($security->isGranted('ROLE_VALIDED_FACTURE_PRO')) {
            // Valide la facture sans vérifier le statut
            $factureProFormat->setStatut(Statut::VALIDATED);
            $entityManager->flush();
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('La facture pro-forma a été validée avec succès.');
            $url = $urlGenerator->generate('app_facture_index_pending', ['id' => $factureProFormat->getId()]);
            return new RedirectResponse($url);
        }


        // Met à jour le statut de la facture
        if ($factureProFormat->getStatut() !== Statut::EN_ATTENTE) {
            // Ajoute un message flash
            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->warning('la facture pro-forma  doit être soumise avant la validation.');

            // Génére l'URL pour la redirection
            $url = $urlGenerator->generate('app_facture_pro_format_index_pending', ['id' => $factureProFormat->getId()]);

            // Redirige vers la page de la facture avec le message flash
            return new RedirectResponse($url);
        }

       $factureProFormat->setStatut(Statut::VALIDATED);
        $entityManager->flush();
        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('la facture pro-forma  validée  avec succès .');

        // Génére l'URL pour la redirection
        $url = $urlGenerator->generate('app_facture_pro_format_index_pending', ['id' => $factureProFormat->getId()]);

        // Redirige vers la page de la facture
        return new RedirectResponse($url);
    }



    #[Route('/{id}/facture/pro/soumission', name: 'app_facture_pro_format_soumission', methods: ['POST'])]
    public function soumission(FactureProFormat $factureProFormat, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        // Met à jour le statut de la facture
        $factureProFormat->setStatut(Statut::EN_ATTENTE);
        $entityManager->flush();


        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('la facture pro-forma  soumise  avec succès .');

        // Génére l'URL pour la redirection
        $url1 = $urlGenerator->generate('app_facture_pro_format_info', ['id' => $factureProFormat->getId()]);

        // Redirige vers la page de la facture
        return new RedirectResponse($url1);
    }


    #[Route('/{id}/facture/pro/annulation', name: 'app_facture_pro_format_annulation', methods: ['POST'])]
    public function annulation(FactureProFormat $factureProFormat, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        // Met à jour le statut de la facture
        $factureProFormat->setStatut(Statut::CANCELLED);
        $entityManager->flush();


        flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'bottom-right',
            ])
            ->success('la facture pro-forma  annulée  avec succès .');

        // Génére l'URL pour la redirection
        $url2 = $urlGenerator->generate('app_facture_pro_format_info', ['id' => $factureProFormat->getId()]);

        // Redirige vers la page de la facture
        return new RedirectResponse($url2);
    }




}
