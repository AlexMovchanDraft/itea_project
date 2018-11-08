<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.11.18
 * Time: 14:54
 */

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('homepage/homepage.html.twig', [

        ]);
    }

    /**
     * @Route("/information/{lang}", name="homepage_show_info")
     */
    public function showInfo($lang)
    {
        return $this->render('homepage/show_info.html.twig', [
            'lang'=>$lang
//            'description'=>$description
        ]);
    }
}