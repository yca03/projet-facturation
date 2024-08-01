<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\FactureProFormat;
use App\Form\FactureProFormatType;
use App\Repository\FactureProFormatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/facture/pro/format')]
class FactureProFormatController extends AbstractController
{
    #[Route('/', name: 'app_facture_pro_format_index', methods: ['GET'])]
    public function index(FactureProFormatRepository $factureProFormatRepository): Response
    {
        return $this->render('facture_pro_format/index.html.twig', [
            'facture_pro_formats' => $factureProFormatRepository->findAll(),
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

            return $this->redirectToRoute('app_facture_pro_format_index', [], Response::HTTP_SEE_OTHER);
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
        }

        return $this->redirectToRoute('app_facture_pro_format_index', [], Response::HTTP_SEE_OTHER);
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




}
