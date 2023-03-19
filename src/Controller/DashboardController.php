<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

//#[
   
 //   IsGranted("ROLE_ADMIN") 
//]

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/gerer-admins', name: 'gerer_admins')]
    public function generAdmins(UserRepository $userRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
       
        $form = $this->createForm(RegistrationFormType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setPassword($hasher->hashPassword(
                $admin,
                $admin->getPassword()
            ));
            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('gerer_admins');
        }
        
        $admins = $userRepository->findByRole('ROLE_ADMIN');
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
            'admins'           => $admins
        ]);
    }

    #[Route('/ajouter-admin', name: 'ajouter_admin')]
    public function ajouter_admin(UserRepository $userRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
       
        $form = $this->createForm(RegistrationFormType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setPassword($hasher->hashPassword(
                $admin,
                $admin->getPassword()
            ));
            $em->persist($admin);
            $em->flush();
            return $this->redirectToRoute('gerer_admins');
        }
        return $this->render('admin/ajouter-admin.html.twig', [
            'form' => $form->createView(),
        ]);
    }

       

   



    #[Route('/modifier-admin/{id}', name: 'modifierAdmin')]
    public function modifierAdmin(User $admin,Request $request, EntityManagerInterface $em ): Response {
        $admin->setRoles(['ROLE_ADMIN']);
        /* $admin->setPassword($hasher->hashPassword(
            $admin,
            'admin1234'
        ));*/
        $form = $this->createForm(RegistrationFormType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('gerer_admins');
        }
        return $this->render('admin/modifier-admin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer-admin/{id}', name: 'supprimer_admin')]
    public function supprimerAdmin(User $user,EntityManagerInterface $em): Response {
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('gerer_admins');
    }
}
