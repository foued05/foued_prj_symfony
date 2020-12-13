<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VoitureType;
use App\Entity\Voiture;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {
        $voitures=$this.getDoctrine()->getRespository(Voiture::class)->findAll();

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * @Route("/voiture/{mat}", name="voiturebymat")
     */
    public function afficher(String $mat): Response
    {
        $voitures=$this.getDoctrine()->getRespository(Voiture::class)->findBy(array('matricule '=>$mat));

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * @Route("/modifiervoiture/{mat}", name="modifiervoiture")
     */
    public function modifer(): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $voitures=$this.getDoctrine()->getRespository(Voiture::class)->findBy(array('matricule '=>$mat));

        if(!$voitures){
            throw $this->createNotFoundException(
                'pas de voiture a la marque'.$mat
            );
        }
        $voitures[0]->setMarque('polo');
        $entityManager->flush();

        return $this->redirectToRoute('voiturebymat',['mat'=>$mat]);
    }

    /**
     * @Route("/supprimervoiture/{mat}", name="suppvoiture")
     */
    public function supprimer(): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $voitures=$this.getDoctrine()->getRespository(Voiture::class)->findBy(array('matricule '=>$mat));

        if(!$voitures){
            throw $this->createNotFoundException(
                'pas de voiture a la marque'.$mat
            );
        }
        $entityManager->remove($voitures[0]);
        $entityManager->flush();

        return $this->redirectToRoute('voiturebymat',['mat'=>$mat]);
    }

    /**
     * @Route("/createvoiture", name="createvoiture")
     */
    public function createVoiture(/*Request $request*/): Response
    {
        $voitures=new Voiture();
        $form=$this->createForm(VoitureType::class,$voitures);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $voitures->setDisponibilite(1);
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($voitures);
            $entityManager->flush();
            return $this->redirectToRoute('voiture');
        }

        return $this->render('voiture/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
