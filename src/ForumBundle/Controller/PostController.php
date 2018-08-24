<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package ForumBundle\Controller
 * @Route("/post)
 */
class PostController extends Controller
{
    /**
     * @param $page
     * @Route("/list/{page}",
     *       requirements =  {"page" : "\d+"},
     *     defaults = {"page" : "1"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page)
    {
        $nbOfElementPerPage = 10;
        //$offsetPage = ($page - 1) * $nbOfElementPerPage;

        $postRepository = $this
            ->getDoctrine()
            ->getRepository("ForumBundle:Post");

        $nbOfPosts = $postRepository
            ->getPostCount();
        /*$postsPerPage = $postRepository
            ->findBy([], ['title' => 'ASC'], $nbOfElementPerPage, $offsetPage);*/
        $nbOfPages = ceil($nbOfPosts / $nbOfElementPerPage); //(ceil) entier le plus proche superieur

        $postsPerPage = $postRepository->getPostsPaginated($page,$nbOfElementPerPage);

        $params = $this->getParamsForAside();
        $params['postList'] = $postsPerPage;
        $params['currentPage'] = $page;
        $params['totalPage'] = $nbOfPages;

        $response = $this->render('Post/index.html.twig', $params);
        return $response;
    }
}
