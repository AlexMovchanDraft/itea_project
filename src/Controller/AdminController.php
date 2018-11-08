<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.11.18
 * Time: 21:01
 */

namespace App\Controller;


use App\Entity\Biography;
use App\Entity\Skills;
use App\Entity\WorkExperience;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function admin()
    {
        $biography = $this->getDoctrine()->getRepository(Biography::class);
        $skills = $this->getDoctrine()->getRepository(Skills::class);
        $workExperience = $this->getDoctrine()->getRepository(WorkExperience::class);

        $biographyData = $biography->findAll();
        $skillsData = $skills->findAll();
        $workExperienceData = $workExperience->findAll();

        return $this->render('admin/admin.html.twig', [
            'biography'     =>$biographyData[0]->getBiography(),
            'skills'        =>$skillsData,
            'workExperience'=>$workExperienceData
        ]);
    }
}