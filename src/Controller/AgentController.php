<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\User;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

//#[

//  IsGranted("ROLE_ADMIN")
//]

class AgentController extends AbstractController
{
    #[Route('/agent', name: 'app_agent')]
    public function index(): Response
    {
        return $this->render('agent/index.html.twig', [
            'controller_name' => 'AgentController',
        ]);
    }

    #[Route('/gerer-agents', name: 'gerer_agents')]
    public function generAgents(AgentRepository $agentRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $agent = new Agent();
        $agent->setRoles(['ROLE_AGENT']);
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $agent->setPassword($hasher->hashPassword(
                $agent,
                $agent->getPassword()
            ));
            $em->persist($agent);
            $em->flush();
            return $this->redirectToRoute('gerer_agents');
        }
        $agents = $agentRepository->findAll();
        return $this->render('agent/index.html.twig', [
            'form' => $form->createView(),
            'agents'           => $agents
        ]);
    }


 

    #[Route('/ajouter-agents', name: 'ajouter_agent')]
    public function ajouterAgent(AgentRepository $agentRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $agent = new Agent();
        $agent->setRoles(['ROLE_AGENT']);
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $agent->setPassword($hasher->hashPassword(
                $agent,
                $agent->getPassword()
            ));
            $em->persist($agent);
            $em->flush();
            return $this->redirectToRoute('gerer_agents');
        }
        $agents = $agentRepository->findAll();
        return $this->render('agent/ajouter-agent.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/modifier-agent/{id}', name: 'modifierAgent')]
    public function modifierAgent(Agent $agent, Request $request, EntityManagerInterface $em): Response
    {
        $agent->setRoles(['ROLE_AGETN']);
        /* $admin->setPassword($hasher->hashPassword(
            $admin,
            'admin1234'
        ));*/
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('gerer_agents');
        }
        return $this->render('agent/modifier-agent.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer-agent/{id}', name: 'supprimer_agent')]
    public function supprimerAgent(Agent $agent, EntityManagerInterface $em): Response
    {
        $em->remove($agent);
        $em->flush();
        return $this->redirectToRoute('gerer_agents');
    }
}
