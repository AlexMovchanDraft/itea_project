<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Link;

class LinkController extends AbstractController
{
    /**
     * @Route("/link", name="link")
     */
    public function index()
    {
        return $this->render('link/link.html.twig', []);
    }

    /**
     * @Route("/link/add_link/{addedLink}", name="add_link")
     */
    public function addLink($addedLink)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $link = new Link();
        $link->setHashedLink('##3213#2');
        $link->setOriginalLink($addedLink);

        $entityManager->persist($link);

        $entityManager->flush();

        return new Response('Added to database! Thanx! Use this to open original - ' . $link->getHashedLink());
    }

    /**
     * @Route("/link/{hashedLink}", name="link_redirect_to_origin")
     */
    public function getLinkByOriginal($hashedLink)
    {
        $repository = $this->getDoctrine()->getRepository(Link::class);

        $findedLink = $repository->findOneBy(["hashed_link" => $hashedLink]);

        if (!$findedLink) {
           throw $this->createNotFoundException(
               'No hashed links found by hashed - ' . $hashedLink
           );
        }

        return new Response('Check out this : ' .$findedLink->getOriginalLink());
    }

}
