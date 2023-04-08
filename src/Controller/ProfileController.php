<?php

namespace App\Controller;

use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/myprofile', name: 'user_profile', methods: ['GET','POST'])]
    public function getProfile(Request $request, EntityManagerInterface $em){
      $userConnecte = $this->getUser();
      $form = $this->createForm(ProfileType::class, $userConnecte);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $em->flush();
        return $this->redirectToRoute('user_profile');
      }
      return $this->render('security/profile.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
