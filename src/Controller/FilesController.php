<?php

namespace App\Controller;
use App\Entity\Files;
use App\Form\FilesType;
use App\Repository\FilesRepository;
use App\Repository\DemandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Handler\DownloadHandler;

/**
 * @Route("/files_index")
 */
class FilesController extends AbstractController
{
    /**
     * @Route("/", name="files")
     */
    public function index(FilesRepository $filesRepository, DemandesRepository $demandesRepository): Response
    {
		if (isset($_GET['d'])) {
			
			//Pour un utilisateur
			
			$demande = $demandesRepository->findById($_GET['d']);
			$demande = $demande[0];
			
        return $this->render('files/index.html.twig', [
'files' => $filesRepository->findAllFilesByDemande(
                    $_GET['d']
                ),
		'd' => $_GET['d'],
                'demande' => $demande,
            ]);
        } else {
			
			return $this->render('files/index.html.twig', [
                'files' => $filesRepository->findAll(),
                'd' => 0,
                'demande' => 0,
            ]);
        }
    }
    
	/**
     * @Route("/new", name="new_file", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $file = new Files();
        $form = $this->createForm(FilesType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$file = $form->get('name')->getData();
            //dd($form);
            $d=$file->getDemandes()->getId();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();
          
            
              return $this->redirectToRoute('show_demande',['id'=>$d]);
           
           
        }
        if (isset($_GET['d'])) {
            // * user mode
            return $this->render('files/new.html.twig', [
                'file' => $file,
                'form' => $form->createView(),
                'd' => $_GET['d'],
            ]);
        } else {
            return $this->render('files/new.html.twig', [
                'file' => $file,
                'form' => $form->createView(),
                'd' => 0,
            ]);
        }
    }
	
	/**
     * @Route("/{id}", name="show_files", methods={"GET"})
     */
    public function show(Files $file): Response
    {
        return $this->render('files/show.html.twig', [
            'file' => $file,
        ]);
    }
	
	/**
     * @Route("/{id}/edit", name="files_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Files $file): Response
    {
        $form = $this->createForm(FilesType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('files_index');
        }
        if (isset($_GET['d'])) {
            // * user mode
        return $this->render('files/edit.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
            'd' => $_GET['d'],
        ]);
        }else{
            return $this->render('files/edit.html.twig', [
                'file' => $file,
                'form' => $form->createView(),
                'd' =>0,
            ]);
        }
    }
	
    /**
     * @Route("/{id}", name="delete_file", methods={"DELETE"})
     */
    public function delete(Request $request, Files $file): Response
    {
        if (
            $this->isCsrfTokenValid(
                'delete' . $file->getId(),
                $request->request->get('_token')
            )
        ) {
            //$this->get('vich_uploader.upload_handler')->remove($file, 'name');
            //$file->setFile(null);
            //$file->setName(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('files_index');
    }
	
	/**
    * @Route("/download/{file}", name="download_action")
    */
    public function downloadAction(Files $file, DownloadHandler $downloadHandler): Response
    {
        //return $downloadHandler->downloadObject($file, 'file');
        //NOTE: with options (quickview for example in browser):
        return $downloadHandler->downloadObject($file, 'file', $objectClass = null, $fileName = null, $forceDownload = false);
    }
}
