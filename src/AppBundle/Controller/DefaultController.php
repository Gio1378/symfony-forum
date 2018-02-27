<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Post;
use AppBundle\Form\AuthorType;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AppBundle:Theme");

        $postRepository = $this->getDoctrine()
            ->getRepository("AppBundle:Post");

        $authorRepository = $this->getDoctrine()
            ->getRepository("AppBundle:Author");

        $list = $repository->findAll();

        return $this->render('default/index.html.twig',
            [
                "themeList" => $list,
                "lastPosts" => $postRepository->getLastPosts(5)->getResult(),
                "authorSummary" => $authorRepository->getAuthorSummary()->getResult(),
                "yearSummary" => $postRepository->getNumberOfPostsByYear()->getResult()
            ]);
    }

    /**
     * @Route("/theme/{id}", name="theme_details", requirements={"id":"\d+"})
     * @param $id
     * @return Response
     */
    public function themeAction($id, Request $request){

        $repository = $this->getDoctrine()
            ->getRepository("AppBundle:Theme");
        $authorRepository = $this->getDoctrine()
            ->getRepository("AppBundle:Author");

        $theme = $repository->find($id);

        $allThemes = $repository->findAll();

        if(! $theme){
            throw new NotFoundHttpException("Thème introuvable");
        }

        if($this->getUser() != null){
            //Création du formulaire
            $post = new Post();
            $post   ->setTheme($theme)
                ->setCreatedAt(new \DateTime())
                ->setAuthor($this->getUser());

            $form = $this->createForm(PostType::class, $post, [
                'attr'=>['novalidate'=>'novalidate']
            ]);

            //Traitement du formulaire
            $form->handleRequest($request);

            //Sauvegarde des données si le formulaire est correct
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                //Redirection pour éviter de rester en POST
                return $this->redirectToRoute("theme_details", ["id"=>$id]);
            }

            $formView = $form->createView();
        } else {
            $formView = null;
        }



        return $this->render('default/theme.html.twig', [
            "theme" => $theme,
            "postList" => $theme->getPosts(),
            "all" => $allThemes,
            "newPostForm" => $formView
        ]);
    }

    /**
     * @Route("/posts-par-auteur/{id}", name="post_par_auteur")
     * @param Author $author
     */
    public function postsByAuthorAction(Author $author){
        $postRepository = $this->getDoctrine()->getRepository("AppBundle:Post");
        $posts = $postRepository->findByAuthor($author);

        return $this->render("default/posts_by_author.html.twig", [
           "postList" => $posts,
            "condition" => $author->getFullName()
        ]);
    }

    /**
     * @Route("/posts-par-annee/{year}", name="post_by_year", requirements={"year"="\d{4}"})
     * @param $year
     */
    public function postsByYearAction($year){
        $postRepository = $this->getDoctrine()->getRepository("AppBundle:Post");
        $posts = $postRepository->getPostsByYear($year)->getResult();

        return $this->render("default/posts_by_author.html.twig", [
           "condition" => "l'année $year",
            "postList" => $posts
        ]);
    }

    /**
     * @Route("/admin-login", name="admin_login_route")
     */
    public function adminLoginAction(){

        //Récupération des erreurs
        $securityUtils = $this->get('security.authentication_utils');


        return $this->render(
            "default/login-form.html.twig",
            [
                "action" => $this->generateUrl("admin_check_route"),
                "error" => $securityUtils->getLastAuthenticationError(),
                "userName" => $securityUtils->getLastUsername()
            ]
        );
    }

    /**
     * @Route("/author-login", name="author_login_route")
     */
    public function authorLoginAction(){

        //Récupération des erreurs
        $securityUtils = $this->get('security.authentication_utils');


        return $this->render(
            "default/login-form.html.twig",
            [
                "action" => $this->generateUrl("author_check_route"),
                "error" => $securityUtils->getLastAuthenticationError(),
                "userName" => $securityUtils->getLastUsername()
            ]
        );
    }
}
