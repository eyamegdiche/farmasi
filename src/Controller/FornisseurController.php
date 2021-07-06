<?php

namespace App\Controller;

use App\Entity\Fornisseur;
use App\Form\FornisseurType;
use App\Repository\FornisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Fornisseur")
 */
class FornisseurController extends AbstractController
{
    /**
     * @Route("/", name="Fornisseur_index", methods={"GET"})
     */
    public function index(FornisseurRepository $FornisseurRepository): Response
    {
        return $this->render('Fornisseur/index.html.twig', [
            'Fornisseurs' => $FornisseurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Fornisseur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Fornisseur = new Fornisseur();
        $form = $this->createForm(FornisseurType::class, $Fornisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Fornisseur);
            $entityManager->flush();

            return $this->redirectToRoute('Fornisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Fornisseur/new.html.twig', [
            'Fornisseur' => $Fornisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Fornisseur_show", methods={"GET"})
     */
    public function show(Fornisseur $Fornisseur): Response
    {
        return $this->render('Fornisseur/show.html.twig', [
            'Fornisseur' => $Fornisseur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Fornisseur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fornisseur $Fornisseur): Response
    {
        $form = $this->createForm(FornisseurType::class, $Fornisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Fornisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Fornisseur/edit.html.twig', [
            'Fornisseur' => $Fornisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Fornisseur_delete", methods={"POST"})
     */
    public function delete(Request $request, Fornisseur $Fornisseur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Fornisseur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Fornisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Fornisseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
