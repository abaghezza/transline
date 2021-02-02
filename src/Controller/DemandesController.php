<?php

namespace App\Controller;

use App\Entity\Demandes;
use App\Entity\Langues;
use App\Entity\Users;
use App\Entity\Files;
use App\Repository\FilesRepository;
use App\Repository\UsersRepository;
use App\Repository\LanguesRepository;
use App\Form\DemandesType;
use App\Form\ApprovalType;
use App\Repository\DemandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 *
 * @Route("/demandes")
 */
 
class DemandesController extends AbstractController
{
    /**
     * @Route("/", name="demandes_indexAll", methods={"GET"})
     */
	 
    public function indexAll(DemandesRepository $demandesRepository): Response
    {
        return $this->render('demandes/index.html.twig', [
            'demandes' => $demandesRepository->findAll(),
        ]);
    }

/**
     * Note: Cela affichera toutes les demandes pour un utilisateur
     * @Route("/", name="demandes_index", methods={"GET"})
     */
    public function index(DemandesRepository $demandesRepository): Response
    {
        return $this->render('demandes/index.html.twig', [
            'demandes' => $demandesRepository->findDemandesByUser(
                $this->getUser()
            ),
        ]);
    }


    /**
     * @Route("/new", name="new_demande", methods={"GET","POST"})
     */
	 
    public function new_demande(Request $request, UsersRepository $reposUser): Response
 {
        $demandes = new Demandes();
		
		$form = $this->createForm(DemandesType::class, $demandes);
		$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$demandes->setCreatedAt(new \DateTime('now'));
			$demandes->setUser($this->getUser());
						//$demandes->setStatus($this->getStatus());
			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandes);
            $entityManager->flush();
			 //return $this->redirectToRoute('demandes_index');
            return $this->redirectToRoute('new_file', ['d'=>$demandes->getId()]);
            }

        return $this->render('demandes/new.html.twig', [
            'demandes' => $demandes,
            'form' => $form->createView(),
        ]);
    }

	
	/**
     * @Route("/{id}", name="show_demandes", methods={"GET"})
     */
	 
    public function show(Demandes $demandes,  FilesRepository $filesRepository): Response
    {
      
        return $this->render('demandes/show.html.twig', [
            'demandes' => $demandes,
            'file' => $filesRepository->findAllFilesByDemande($demandes->getId()),
        ]);
    }

/**
     * @Route("/{id}/edit", name="demandes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Demandes $demandes): Response
    {
        $form = $this->createForm(DemandesType::class, $demandes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('demandes_index');
        }

        return $this->render('demandes/edit.html.twig', [
            'demandes' => $demandes,
            'form' => $form->createView(),
        ]);
    }
	
	/**
	*@Route("/{id}/delete", name="demandes_delete", methods={"DELETE"})
	*/
	 
    public function delete(Request $request, Demandes $demandes): Response
    {
        if (
            $this->isCsrfTokenValid(
                'delete' . $demandes->getId(),
                $request->request->get('_token')
            )
        ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandes);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demandes_index');
    }
   
   //Fonction pour etablir un devis
   
   /**
     * @Route("/{id}/approve_demande", name="approve_demande", methods={"GET","POST"})
     */
	 
   public function approval(Request $request, Demandes $demandes, UsersRepository $users): Response
    {
        $form = $this->createForm(ApprovalType::class, $demandes);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$demandes->setUpdatedAt(new \DateTime('now'));
			$demandes->setStatus('validee');
            $this->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('demandes_index');
        }

        return $this->render('demandes/edit.html.twig', [
            'demandes' => $demandes,
            'form' => $form->createView(),
        ]);
    }
}