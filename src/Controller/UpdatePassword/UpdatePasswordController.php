<?php

namespace App\Controller\UpdatePassword;

use App\Entity\UpdatePassword\UpdatePassword;
use App\Entity\User;
use App\Form\UpdatePassword\UpdatePasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('account/', name: 'account_')]
class UpdatePasswordController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    #[Route('profile', name: 'profile', methods: ['GET', 'POST'])]
    public function edit(
        Request $request
    ): Response {
        /** @var User $user */
        $user = $this->getUser();

        $account = (new User())
            ->setEmail($user->getEmail())
            ->setNom($user->getNom())
            ->setPrenom($user->getPrenom())
            ->setNomUtilisateur($user->getNomUtilisateur())
            ->setContact($user->getContact())
            ->setRoles($user->getRoles());

        $form = $this->createForm(UserType::class, $account,[
            'is_editing_self' => true, // On édite le profil de l'utilisateur connecté
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user
                ->setContact($account->getContact())
                ->setNom($account->getNom())
                ->setPrenom($account->getPrenom())
                ->setNomUtilisateur($account->getNomUtilisateur())
                ->setEmail($account->getEmail())
                ->setRoles($account->getRoles());
            $this->manager->persist($user);
            $this->manager->flush();

            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('Les informations du compte ont été mise à jour avec succès.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('update_password', name: 'update_recover', methods: ['GET', 'POST'])]
    public function updatePassword(
        Request                     $request,
        UserRepository              $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $updatePassword = new UpdatePassword();
        $form = $this->createForm(UpdatePasswordType::class, $updatePassword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $this->getUser();
            $newPasswordEncoded = $passwordHasher->hashPassword($user, $updatePassword->getNewPassword());
            $userRepository->upgradePassword($user, $newPasswordEncoded);

            flash()
                ->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'bottom-right',
                ])
                ->success('Mode de passe modifié avec succès.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/UpdatePassword.html.twig', [
            'form' => $form
        ]);
    }




    //c est pour le nouveau edit profil rien avoir avec les deux autre en haut


}
