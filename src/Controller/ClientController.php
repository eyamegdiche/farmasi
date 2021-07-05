<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="Client_index", methods={"GET"})
     */
    public function index(ClientRepository $ClientRepository): Response
    {
        return $this->render('Client/index.html.twig', [
            'Clients' => $ClientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Client = new Client();
        $form = $this->createForm(ClientType::class, $Client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Client);
            $entityManager->flush();

            return $this->redirectToRoute('Client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Client/new.html.twig', [
            'Client' => $Client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Client_show", methods={"GET"})
     */
    public function show(Client $Client): Response
    {
        return $this->render('Client/show.html.twig', [
            'Client' => $Client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $Client): Response
    {
        $form = $this->createForm(ClientType::class, $Client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Client/edit.html.twig', [
            'Client' => $Client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Client_delete", methods={"POST"})
     */
    public function delete(Request $request, Client $Client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Client_index', [], Response::HTTP_SEE_OTHER);
    }
}
