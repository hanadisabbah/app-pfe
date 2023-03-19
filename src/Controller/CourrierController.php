<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Form\CourrierStatusType;
use App\Form\CourrierType;
use App\Repository\CourrierRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[
    Route('/courrier'),
    IsGranted("ROLE_AGENT")
]
class CourrierController extends AbstractController
{
    #[Route('/', name: 'app_courrier_index', methods: ['GET','POST'])]
    public function index(CourrierRepository $courrierRepository, Request $request): Response
    {
        $courrier = new Courrier();
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courrier->setDeliveryDate(new \Datetime());
            $courrier->setCreatedAt(new \DateTime());
            $courrier->setStatus('en_cours');
            $courrierRepository->save($courrier, true);

            return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('courrier/index.html.twig', [
            'courriers' => $courrierRepository->findAll(),
            'form'      => $form->createView()
        ]);
    }

    #[Route('/changeStatus/{id}', name: 'change_statue', methods: ['GET','POST'])]
    public function changerStatusCourrier(Courrier $courrier,CourrierRepository $courrierRepository, Request $request): Response
    {
        $form = $this->createForm(CourrierStatusType::class, $courrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courrierRepository->save($courrier, true);

            return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('courrier/changer-status.html.twig', [
            'form'      => $form->createView()
        ]);
    }

  

 //   #[Route('/{id}', name: 'app_courrier_show', methods: ['GET'])]
 //   public function show(Courrier $courrier): Response
 //   {
 //       return $this->render('courrier/show.html.twig', [
     //       'courrier' => $courrier,
 //       ]);
 //   }

    #[Route('/{id}/edit', name: 'app_courrier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Courrier $courrier, CourrierRepository $courrierRepository): Response
    {
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courrierRepository->save($courrier, true);

            return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('courrier/edit.html.twig', [
            'courrier' => $courrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_courrier_delete', methods: ['GET'])]
    public function delete(Request $request, Courrier $courrier, CourrierRepository $courrierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$courrier->getId(), $request->request->get('_token'))) {
            $courrierRepository->remove($courrier, true);
        }

        return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
    }
}
