<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Post;
use ForumBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package ForumBundle\Controller
 * @Route("/user)
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addEditPostAction(Request $request, Post $post=null)
    {
        if (!$post){
            //Instanciation d'une entité post
            $newPost = new Post();
        } else {
            //Récupération de l'instance existante
            $newPost = $post;
        }
        $user = $this
            ->getDoctrine()
            ->getRepository("ForumBundle:User")
            ->findOneByEmail("user1@mail.com");
        //Liaison entre le commentaire et le post
        $newPost->setUser($user);

        //Création du formulaire
        $form = $this->createForm(PostType::class, $newPost);

        //Hydratation du formulaire, dans le cas où le formulaire de nouveau commentaire est renseigné
        $form->handleRequest($request);

        //Traitement du formulaire

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPost);// persist détermine si l'action doit être un UPDATE ou un INSERT INTO
            $em->flush();
            $response = $this->redirectToRoute('forum_post_list');

        } else {

            $response = $this->render('Author/new-post.html.twig', ['postForm' => $form->createView()]);
        }
        return $response;
    }
}
