<?php

namespace App\Controller;

use App\Entity\Classification;
use App\Form\ClassificationType;
use App\Repository\ClassificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class LandingPageController extends AbstractController
{
    /**
     * @Route("/", name="landingPage_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('landingPage/landingPage.html.twig',[]);
    }

}
