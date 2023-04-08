<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[
    Route('/post'),

]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET', 'POST'])]
    public function index(PostRepository $postRepository, Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setIsDeleted(false);
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findBy(['isDeleted' => false]),
            'form'  => $form->createView()
        ]);
    }


    #[Route('/ajouter-posts', name: 'ajouter_post')]
    public function ajouterLivreur(PostRepository $postRepository, Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setIsDeleted(false);
            $postRepository->save($post, true);
            
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('app_post_index');
        }
        $livreurs = $postRepository->findAll();
        return $this->render('post/ajouter-post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //#[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    //public function show(Post $post): Response
    // {
    //    return $this->render('post/show.html.twig', [
    //        'post' => $post,
    //    ]);
    // }


    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/modifier-post.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_post_delete', methods: ['GET'])]
    public function delete(Post $post, EntityManagerInterface $em): Response
    {
        $post->setIsDeleted(true);
        $em->flush();
        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
