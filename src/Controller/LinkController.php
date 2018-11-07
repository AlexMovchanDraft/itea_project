<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/link/add_link")
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function ajaxAction(Request $request)
    {
        $originalLink = $request->request->get('original');
        $encodedLink = $request->request->get('encoded');


        $repository = $this->getDoctrine()->getRepository(Link::class);

        if (isset($originalLink) && isset($encodedLink)) {
            $entityManager = $this->getDoctrine()->getManager();

            $isLinkExistInDb = $repository->findOneBy(["original_link" => $originalLink]);

//            return new JsonResponse($isLinkExistInDb, 400);
            if (!isSet($isLinkExistInDb)) {
                $link = new Link();
                $link->setHashedLink($encodedLink);
                $link->setOriginalLink($originalLink);

                $entityManager->persist($link);
                $entityManager->flush();

                return new JsonResponse(array('encoded'=>$encodedLink, 'original'=>$originalLink), 200);

            } else {
                return new JsonResponse('Link is exist', 400);
            }

        } else {
            return new Response('Fields is empty', 400);
        }
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

        return $this->redirect($findedLink->getOriginalLink());
    }

}
