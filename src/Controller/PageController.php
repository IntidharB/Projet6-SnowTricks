<?php

namespace App\Controller;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('', name: 'app_home')]
    #[Route('/accueil', name: 'app_page')]
    public function index(TrickRepository $trickRepository): Response //injection de dépendance:on va injecter un secrvice dans les paramétre du controller
    {
        // $tricks =  //récuperer tt les tricks dans la bdd
        

        return $this->render('page/index.html.twig', [
            // 'controller_name' => 'TrickController',
            'tricks' => $trickRepository->findBy([], ['createdAt' => 'DESC'], 10),
        ]);
    }
}

    // #[Route('/page', name: 'app_page')]
    // public function index(): Response
    // {
    //     return $this->render('page/index.html.twig', [
    //         'controller_name' => 'PageController',
    //     ]);
    // }
