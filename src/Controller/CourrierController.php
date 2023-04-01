<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Entity\Historique;
use App\Form\CourrierStatusType;
use App\Form\CourrierType;
use App\Form\HistoriqueType;
use App\Repository\CourrierRepository;
use App\Repository\HistoriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[
    Route('/courrier'),
]
class CourrierController extends AbstractController
{
    #[Route('/', name: 'app_courrier_index', methods: ['GET', 'POST'])]
    public function listCourrier(CourrierRepository $courrierRepository, Request $request): Response
    {
        $courrier = new Courrier();
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $courrier->setDeliveryDate(new \Datetime());
            $courrier->setCreatedAt(new \DateTime());
            $courrier->setStatus('en_stock');
            $courrierRepository->save($courrier, true);

            return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('courrier/index.html.twig', [
            'courriersLivre'   => $courrierRepository->findBy(['status' => 'livré']),
            'courriersEnStock' => $courrierRepository->findBy(['status' => 'en_stock']),
            'courriersEnCours' => $courrierRepository->findBy(['status' => 'en_cours']),
            'form'      => $form->createView()
        ]);
    }

    #[Route('/ajouter-courrier', name: 'app_courrier', methods: ['GET', 'POST'])]
    public function ajouterCourrier(CourrierRepository $courrierRepository, Request $request): Response
    {
        $courrier = new Courrier();
        if($request->query->get('ref')){
            $ref = $request->query->get('ref');
            $courrier->setBarcode($ref);
        }
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $connectedAgent = $this->getUser();
            $posteAgentConnecte = $connectedAgent->getPost();
            $courrier->setStartingPost($posteAgentConnecte);
            $courrier->setPostalSituation($posteAgentConnecte->getLabel());
            $courrier->setDeliveryDate(new \Datetime());
            $courrier->setCreatedAt(new \DateTime());
            $courrier->setStatus('en_stock');
            $courrierRepository->save($courrier, true);
            /**
             * Travail a faire aprés completer les relations d'historique
             * creer une instance d'historique ( $historique = new Historique )
             * $hist->setCourrier($courrier)
             * $hist ......
             * EM->persist($hist);EM->flush();
             */
            
            return $this->redirectToRoute('app_courrier', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('courrier/ajouter-courrier.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/valider', name: 'valider', methods: ['GET', 'POST'])]
    public function valider(CourrierRepository $courrierRepository, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()->add('ref', TextType::class, ['attr' => ['class' => 'form-control']])->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ref = $form->get('ref')->getData();
            $courrierExiste = $courrierRepository->findOneBy(['barcode' => $ref]);
            if ($courrierExiste) {
                $agentConnecte = $this->getUser();
                $poste        = $agentConnecte->getPost();
                $courrierExiste->setStatus('en_cours');
                $courrierExiste->setPostalSituation($poste->getLabel());
                $em->flush();
                return $this->redirectToRoute('afficher_courrier', ['id' => $courrierExiste->getId()], Response::HTTP_SEE_OTHER);
            } else {
                
                return $this->redirectToRoute('app_courrier',['ref'=>$ref]);
               // return $this->redirectToRoute('valider', ['isExiste' => false, 'id' => false], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('courrier/valider.html.twig', [
            'form'      => $form->createView()
        ]);
    }

    #[Route('/afficher-courrier/{id}', name: 'afficher_courrier', methods: ['GET'])]
    public function afficherCourrier(Courrier $courrier): Response
    {
       
        return $this->render('courrier/affichage.html.twig', [
            'courrier'      => $courrier
        ]);
    }

    #[Route('/historique-courrier', name: 'historique_courrier', methods: ['GET', 'POST'])]
    public function generHistorique(HistoriqueRepository $historiqueRepository, Request $request): Response
    {
        $historique = new Historique();
        $form = $this->createForm(HistoriqueType::class, $historique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //  $courrier->setCreatedAt(new \DateTime());
            //  $courrier->setStatus('en_cours');
            $historiqueRepository->save($historique, true);

            return $this->redirectToRoute('historique_courrier', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('courrier/ajouter-historique.html.twig', [
            'historiques' => $historiqueRepository->findAll(),
            'form'      => $form->createView()
        ]);
    }



   // #[Route('/changeStatus/{id}', name: 'change_statue', methods: ['GET', 'POST'])]
   // public function changerStatusCourrier(Courrier $courrier, CourrierRepository $courrierRepository, Request $request): Response
 //   {
 //       $form = $this->createForm(CourrierStatusType::class, $courrier);
 //       $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            //dd($courrier);
 //           $courrierRepository->save($courrier, true);

 //           return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
//        }
//        return $this->render('courrier/changer-status.html.twig', [
//            'form'      => $form->createView()
 //       ]);
 //   }



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
        $courrierRepository->remove($courrier, true);


        return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
    }
}
