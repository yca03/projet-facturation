<?php

namespace App\Controller;

use App\Entity\Facture;
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
    public function index(FactureRepository $factureRepository, ProduitRepository $produitRepository, ClientsRepository $clientsRepository, UserRepository $userRepository
    ): Response
    {


        // Calculer les montants totaux
        $montantTotalFactures = $factureRepository->getTotalAmount();
        $statuses = ['soldée', 'partielle'];
        $montantFacturesPartielleEtSoldee = $factureRepository->getTotalAmountByStatuses($statuses);


        // Compter le nombre total de factures
        $nombreDeFactures = $factureRepository->count([]);

        $nombreProduits = $produitRepository->count([]);

        $nomUsers = $userRepository->count([]);

        $nombreFacturesEncaissees = $factureRepository->countFacturesByStatuses(['soldée', 'partielle']);


        // Compter le nombre d'utilisateurs avec le rôle ROLE_ADMIN
        $nomUsersAdmin = $userRepository->countUsersByRole('ROLE_ADMIN');

        $nombreClients = $clientsRepository->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();

        // Récupérer les factures par mois
        $facturesParMois = $factureRepository->createQueryBuilder('f')
            ->select('MONTH(f.date) as month, COUNT(f.id) as count')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->getQuery()
            ->getArrayResult();

        // Liste des mois
        $moisFr = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        // Formatage des données pour JavaScript
        $formattedFacturesParMois = array_fill_keys(array_values($moisFr), 0);


        foreach ($facturesParMois as $facture) {
            $monthName = $moisFr[$facture['month']];
            $formattedFacturesParMois[$monthName] = $facture['count'];
        }



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nomUsers' => $nomUsers,
            'nomUsersAdmin' => $nomUsersAdmin,
            'nombreDeFactures' => $nombreDeFactures,
            'nombreProduits' => $nombreProduits,
            'nombreClients' => $nombreClients,
            'facturesParMois' => $formattedFacturesParMois,
            'montantTotalFactures' => $montantTotalFactures,
            'montantFacturesPartielleEtSoldee' => $montantFacturesPartielleEtSoldee,
            'nombreFacturesEncaissees'=>$nombreFacturesEncaissees,
            'alertHome' => $factureRepository->findAll(),
        ]);
    }

}
