<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ThemeController
 * @package ForumBundle\Controller
 * @Route("/theme")
 */
class ThemeController extends Controller
{
    public function listThemeAction()
    {
        return $this->render('Theme/index.html.twig');
    }
}
