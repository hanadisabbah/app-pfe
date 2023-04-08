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
            'courriersLivre'   => $courrierRepository->findBy(['status' => 'livré', 'isDeleted' => false]),
            'courriersEnStock' => $courrierRepository->findBy(['status' => 'en_stock',  'isDeleted' => false]),
            'courriersEnCours' => $courrierRepository->findBy(['status' => 'en_cours',  'isDeleted' => false]),
            'form'      => $form->createView()
        ]);
    }

    #[Route('/ajouter-courrier', name: 'app_courrier', methods: ['GET', 'POST'])]
    public function ajouterCourrier(CourrierRepository $courrierRepository, Request $request, EntityManagerInterface $em): Response
    {
        $courrier = new Courrier();
        if ($request->query->get('ref')) {
            $ref = $request->query->get('ref');
            $courrier->setBarcode($ref);
        }
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $courrier->setIsDeleted(false);
            $connectedAgent = $this->getUser();
            $posteAgentConnecte = $connectedAgent->getPost();
            $courrier->setStartingPost($posteAgentConnecte);
            $courrier->setPostalSituation($posteAgentConnecte->getLabel());
            $courrier->setDeliveryDate(new \Datetime());
            $courrier->setCreatedAt(new \DateTime());
            
            $courrier->setStatus('en_stock');
            $courrierRepository->save($courrier, true);
            //enregistrer une historique d'ajout d'un courrier
            //1) on va instancier un objet historique

            $historique = new Historique();
            $historique->setUpdatedAt(new \DateTime());
            $historique->setCourrier($courrier);
            $historique->setUtilisateur($connectedAgent);
            $date = date('Y-m-d H:i'); //objet(1234567) 2023-04-02 Hours:minutes
            $historique->setComment("ajouter un courrier d'id: " . $courrier->getId() . " en $date");
            $historique->setStatut($courrier->getStatus());
            //2) on va appeler doctrine pour sauvegarder historique
            $em->persist($historique);
            $em->flush();

            return $this->redirectToRoute('message_courrier', ['id' => $courrier->getId()], Response::HTTP_SEE_OTHER);
            //return $this->redirectToRoute('app_courrier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('courrier/ajouter-courrier.html.twig', [
            'form' => $form->createView(),
        ]);
        

        //  return $this->render('courrier/ajouter-courrier.html.twig', [
         //   'form' => $form->createView(),
       // ]);
    }


    #[Route('/valider', name: 'valider', methods: ['GET', 'POST'])]
    public function valider(CourrierRepository $courrierRepository,  Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()->add('ref', TextType::class, ['attr' => ['class' => 'form-control']])->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ref = $form->get('ref')->getData();
            $courrierExiste = $courrierRepository->findOneBy(['barcode' => $ref]);
            if ($courrierExiste) {

                // verification selecton agent connecter howa 3end nafes poste mat3 courrier
                // agent connecte
                $agentConnecte = $this->getUser();

                    // hanadi zidtha
                    $historique = new Historique();
                    $historique->setCourrier($courrierExiste);
                    $historique->setUtilisateur($agentConnecte);
                    $date = date('Y-m-d H:i'); //objet(1234567) 2023-04-02 Hours:minutes
                    $historique->setComment("valider un courrier d'id: " . $courrierExiste->getId() . " en $date");
                    $historique->setStatut($courrierExiste->getStatus());
                    //2) on va appeler doctrine pour sauvegarder historique
                    $em->persist($historique);
                    $em->flush();
                    //hanadi zadetha
                 //poste mataa agent connecter   
                $posteAgent        = $agentConnecte->getPost();
                // poste arrive mataa courrier
                $posteArriveCourrier = $courrierExiste->getArrivalPost();
                if ($posteAgent == $posteArriveCourrier) { // agent connecter jibi menha poste teste hiya nafesha
                    $courrierExiste->setStatus('livré');
                } else {
                    $courrierExiste->setStatus('en_cours');
                }
                $courrierExiste->setPostalSituation($posteAgent->getLabel());
                $em->flush();

            
                return $this->redirectToRoute('afficher_courrier', ['id' => $courrierExiste->getId()], Response::HTTP_SEE_OTHER);
            } else {

                return $this->redirectToRoute('app_courrier', ['ref' => $ref]);
                
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



    #[Route('/message-courrier/{id}', name: 'message_courrier', methods: ['GET'])]
    public function messageCourrier(Courrier $courrier): Response
    {
        return $this->render('courrier/message-ajoute.html.twig', [
            'courrier'      => $courrier
        ]);
    }




    #[Route('/{id}/edit', name: 'app_courrier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Courrier $courrier, CourrierRepository $courrierRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CourrierType::class, $courrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courrierRepository->save($courrier, true);
            $connectedAgent = $this->getUser();
            // partie historique
            $historique = new Historique();
            $historique->setCourrier($courrier);
            $historique->setUtilisateur($connectedAgent);
            $date = date('Y-m-d H:i'); //objet(1234567) 2023-04-02 Hours:minutes
            $historique->setComment("modifier le courrier d'id: " . $courrier->getId() . " en $date");
            $historique->setStatut($courrier->getStatus());
            //2) on va appeler doctrine pour sauvegarder historique
            $em->persist($historique);
            $em->flush();
            // partie historique
            return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('courrier/edit.html.twig', [
            'courrier' => $courrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_courrier_delete', methods: ['GET'])]
    public function delete(Courrier $courrier, CourrierRepository $courrierRepository, EntityManagerInterface $em): Response
    {
       // $courrierRepository->remove($courrier, true);
       $courrier->setIsDeleted(true);
       $em->flush();
        // hanadi zadetha
        $connectedAgent = $this->getUser();
        $historique = new Historique();
        $historique->setCourrier($courrier);
        $historique->setUtilisateur($connectedAgent);
        $date = date('Y-m-d H:i'); //objet(1234567) 2023-04-02 Hours:minutes
        $historique->setComment("supprimer un courrier d'id: " . $courrier->getId() . " en $date");
        $historique->setStatut($courrier->getStatus());
        //2) on va appeler doctrine pour sauvegarder historique
        $em->persist($historique);
        $em->flush();
        

        return $this->redirectToRoute('app_courrier_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/historique/{id}', name: 'historique_courrier', methods: ['GET'])]
    public function historiqueCourrier(Courrier $courrier,Request $request): Response
    {
        $historiques = $courrier->getHistoriques();
        return $this->render('courrier/historique-timeline.html.twig',[
            'historiques' => $historiques,
            'courrier'    => $courrier
        ]);      
    }
}
