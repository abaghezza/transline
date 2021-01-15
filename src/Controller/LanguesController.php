<?php

namespace App\Controller;

use App\Entity\Langues;
use App\Form\LanguesType;
use App\Repository\LanguesRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/langues")
 */
class LanguesController extends AbstractController
{
    /**
     * @Route("/", name="langues_index", methods={"GET"})
     */
    public function index(LanguesRepository $languesRepository ): Response
    {		
        return $this->render('langues/index.html.twig', [
            'langue' => $languesRepository->findAll()
        ]);
    }
	
	/**
     * @Route("/new", name="new_language", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $langue = new Langues();
        $form = $this->createForm(LanguesType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($langue);
            $entityManager->flush();

            return $this->redirectToRoute('langues_index');
        }

        return $this->render('langues/new.html.twig', [
            'langue' => $langue,
            'form' => $form->createView(),
        ]);
    }
	
	/**
     * @Route("/{id}", name="show_language", methods={"GET"})
     */
    public function show(Langues $langue): Response
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('langues/show.html.twig', [
            'langue' => $langue,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="edit_language", methods={"GET","POST"})
     */
    public function edit(Request $request, Langues $langue): Response
    {
        $form = $this->createForm(LanguesType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('langues_index');
        }

        return $this->render('langues/edit.html.twig', [
            'langue' => $langue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="delete_language", methods={"DELETE"})
     */
    public function delete(Request $request, Langues $langue): Response
    {
        if ($this->isCsrfTokenValid('delete' . $langue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($langue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('langues_index');
    }
	
}
