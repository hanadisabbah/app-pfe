<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Entity\User;
use App\Form\LivreurType;
use App\Repository\LivreurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class LivreurController extends AbstractController
{
    #[Route('/livreur', name: 'app_livreur')]
    public function index(): Response
    {
        return $this->render('livreur/index.html.twig', [
            'controller_name' => 'LivreurController',
        ]);
    }

    #[Route('/gerer-livreurs', name: 'gerer_livreurs')]
    public function generLivreurs(LivreurRepository $livreurRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $livreur = new Livreur();
        $livreur->setRoles(['ROLE_LIVREUR']);

        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $livreur->setPassword($hasher->hashPassword(
                $livreur,
                $livreur->getPassword()
            ));
            $em->persist($livreur);
            $em->flush();
            return $this->redirectToRoute('gerer_livreurs');
        }
        $livreurs = $livreurRepository->findAll();
        return $this->render('livreur/liv.html.twig', [
            'form' => $form->createView(),
            'livreurs'           => $livreurs
        ]);
    }




    #[Route('/ajouter-livreurs', name: 'ajouter_livreur')]
    public function ajouterLivreur(LivreurRepository $livreurRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $livreur = new Livreur();
        $livreur->setRoles(['ROLE_LIVREUR']);
        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $livreur->setPassword($hasher->hashPassword(
                $livreur,
                $livreur->getPassword()
            ));
            $em->persist($livreur);
            $em->flush();
            return $this->redirectToRoute('gerer_livreurs');
        }
        $livreurs = $livreurRepository->findAll();
        return $this->render('livreur/ajouter-livreur.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/modifier-livreur/{id}', name: 'modifierLivreur')]
    public function modifierLivreur(Livreur $livreur, Request $request, EntityManagerInterface $em): Response
    {
        $livreur->setRoles(['ROLE_LIVREUR']);
        /* $admin->setPassword($hasher->hashPassword(
            $admin,
            'admin1234'
        ));*/
        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('gerer_livreurs');
        }
        return $this->render('livreur/modifier-livreur.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer-livreur/{id}', name: 'supprimer_livreur')]
    public function supprimerLivreur(Livreur $livreur, EntityManagerInterface $em): Response
    {
        $em->remove($livreur);
        $em->flush();
        return $this->redirectToRoute('gerer_livreurs');
    }
}
