<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('pages/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
	
	/** showing page about Transline
     * @Route("/about", name="about")
     */
   
   public function about(): Response 
   {
   return $this->render('pages/agency/about.html.twig', [
            'controller_name' => 'HomeController',
   ]);
  }
  
  	/**
     * @Route("/services", name="services")
     */
   
   public function services(): Response 
   {
   return $this->render('pages/agency/services.html.twig', [
            'controller_name' => 'HomeController',
   ]);
  }
}
