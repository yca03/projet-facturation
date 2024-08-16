<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtatFactureProController extends AbstractController
{
    #[Route('/etat/facture/pro', name: 'app_etat_facture_pro')]
    public function index(): Response
    {
        return $this->render('etat_facture_pro/index.html.twig', [
            'controller_name' => 'EtatFactureProController',
        ]);
    }
}
