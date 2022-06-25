<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * This controller display all tricks
     *
     * @param TrickRepository $repository
     * @return void
     */
    #[Route('/trick', name: 'app_trick')]
    public function index(TrickRepository $repository): Response //injection de dépendance:on va injecter un secrvice dans les paramétre du controller
    {
      //récuperer tt les tricks dans la bdd
      

        return $this->render('trick/index.html.twig', [
            // 'controller_name' => 'TrickController',
            'tricks' => $repository->findBy([], ['id' => 'DESC']),
        ]);

      

    }

    #[Route('/trick/{id}', name: 'app_trick_show', methods: ['GET'])]
    public function show(Trick $trick)
    {
        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
        ]); 
    }
   
    /**
     *This controller show a form which creat an trick
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/trick/nouveau', 'trick.new', methods: ['GET', 'POST'])]
    public function new( Request $request , EntityManagerInterface $manager): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $trick = $form->getData();

            $manager->persist($trick);//persister la donnee dire qu'elle doit s'ajouter en bdd 
            $manager->flush();//ajouter la donnee  en bdd  
          
            $this->addFlash(
                'success',
                'Votre figure a été bien crée avec succés !!'
            );
            return $this->redirectToRoute('app_page');
        }

        return $this->render('trick/new.html.twig', [
            'form' => $form->createView()

        ]);
    }

    #[Route('/trick/edit/{name}', 'trick.edit', methods: ['GET', 'POST'])]
    public function edit(TrickRepository $repository, Trick $trick, Request $request, EntityManagerInterface $manager):Response
    {
       
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $trick = $form->getData();

            $manager->persist($trick);//persister la donnee dire qu'elle doit s'ajouter en bdd 
            $manager->flush();//ajouter la donnee  en bdd  
          
            $this->addFlash(
                'success',
                'Votre figure a été bien modifiée avec succés !!'
            );
            return $this->redirectToRoute('app_page');
        }

        return $this->render('trick/new.html.twig', [
            'form' => $form->createView()

        ]);
        return $this->render('trick/edit.html.twig', [
            'form' => $form->createView()
        ]);
        
    }


    #[Route('/trick/delete/{name}', 'trick.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Trick $trick): Response
    {

        $manager->remove($trick);
        $manager->flush();
        
        $this->addFlash(
            'danger',
            'Votre figure a été supprimée avec succés !!'
        );
        return $this->redirectToRoute('app_page');
    }
    

}
