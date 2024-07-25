<?php

namespace App\Controller;

use App\Repository\ClientsRepository;
use App\Repository\FactureRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FactureRepository $factureRepository, ProduitRepository $produitRepository, ClientsRepository $clientsRepository, UserRepository $userRepository): Response
    {
        $nombreDeFactures = $factureRepository->count();
        $nombreProduits = $produitRepository->count();
        $nomUsers = $userRepository->count();
        $nombreClients = $clientsRepository->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nomUsers'=>$nomUsers,
            'nombreDeFactures' => $nombreDeFactures,
            'nombreProduits' => $nombreProduits,
            'nombreClients' => $nombreClients,
        ]);
    }
}
