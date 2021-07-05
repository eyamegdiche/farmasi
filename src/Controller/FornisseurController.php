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
 * @Route("/fornisseur")
 */
class FornisseurController extends AbstractController
{
    /**
     * @Route("/", name="fornisseur_index", methods={"GET"})
     */
    public function index(FornisseurRepository $fornisseurRepository): Response
    {
        return $this->render('fornisseur/index.html.twig', [
            'fornisseurs' => $fornisseurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fornisseur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fornisseur = new Fornisseur();
        $form = $this->createForm(FornisseurType::class, $fornisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fornisseur);
            $entityManager->flush();

            return $this->redirectToRoute('fornisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fornisseur/new.html.twig', [
            'fornisseur' => $fornisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fornisseur_show", methods={"GET"})
     */
    public function show(Fornisseur $fornisseur): Response
    {
        return $this->render('fornisseur/show.html.twig', [
            'fornisseur' => $fornisseur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fornisseur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fornisseur $fornisseur): Response
    {
        $form = $this->createForm(FornisseurType::class, $fornisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fornisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fornisseur/edit.html.twig', [
            'fornisseur' => $fornisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fornisseur_delete", methods={"POST"})
     */
    public function delete(Request $request, Fornisseur $fornisseur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fornisseur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fornisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fornisseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
