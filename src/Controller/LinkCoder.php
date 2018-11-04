<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.11.18
 * Time: 15:21
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkCoder extends AbstractController
{

    /**
     * @Route("link-coder", name="app_link_coder")
     */
    public function linkCoder()
    {
        return $this->render('link_coder/link_coder.html.twig');
    }
}