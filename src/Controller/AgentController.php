<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\User;
use App\Form\AgentType;
use App\Form\SuperAgentType;
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
        $superAgentConnecte = $this->getUser();
        if($superAgentConnecte instanceof Agent)
        $posteConnecte = $superAgentConnecte->getPost();
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
        $agentsData = $agentRepository->findAll();
        $agents = [];
        foreach ($agentsData as $agent) {
            if ($agent->getRoles()[0] == "ROLE_AGENT" && $agent->getPost() == $posteConnecte) {
                array_push($agents, $agent);
            }
        }
        return $this->render('agent/index.html.twig', [
            'form' => $form->createView(),
            'agents'           => $agents
        ]);
    }


    #[Route('/gerer-super-agents', name: 'gerer_super_agents')]
    public function generSuperAgents(AgentRepository $agentRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $agent = new Agent();
        $agent->setRoles(['ROLE_SUPER_AGENT']);
        $form = $this->createForm(SuperAgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $agent->setPassword($hasher->hashPassword(
                $agent,
                $agent->getPassword()
            ));
            $em->persist($agent);
            $em->flush();
            return $this->redirectToRoute('gerer_super_agents');
        }
        $agents = $agentRepository->findAll();
        $superAgents = [];
        foreach ($agents as $agent) {
            if ($agent->getRoles()[0] == "ROLE_SUPER_AGENT" || $agent->getRoles()[0] == "ROLE_AGENT") {
                array_push($superAgents, $agent);
            }
        }
        return $this->render('agent/index-sagents.html.twig', [
            'form' => $form->createView(),
            'agents'           => $superAgents,
        ]);
    }


    #[Route('/ajouter-agents', name: 'ajouter_agent')]
    public function ajouterAgent(AgentRepository $agentRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $superAgentConnecte = $this->getUser();
        if($superAgentConnecte instanceof Agent)
        $posteConnecte = $superAgentConnecte->getPost();
        $agent = new Agent();
        $agent->setRoles(['ROLE_AGENT']);
        // affecter l'agent avec la poste de super agent connecté
        $agent->setPost($posteConnecte);
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


    #[Route('/ajouter-super-agents', name: 'ajouter_super_agents')]
    public function ajouterSuperAgent(AgentRepository $agentRepository, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em): Response
    {
        $agent = new Agent();
        //$agent->setRoles(['ROLE_SUPER_AGENT']);
        $form = $this->createForm(SuperAgentType::class, $agent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $agent->setPassword($hasher->hashPassword(
                $agent,
                $agent->getPassword()
            ));
            $roles =[];
            array_push($roles,$form->get('role')->getData());
            $agent->setRoles($roles);
            $em->persist($agent);
            $em->flush();
            return $this->redirectToRoute('gerer_super_agents');
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
