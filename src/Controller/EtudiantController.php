<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

     /**
     * @Route("/etudiant/create", name="etudiant_create", methods={"POST", "GET"})
     */
    public function create(Request $request, EntityManagerInterface $em):Response{
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('etudiant');
        }
        return $this->render('etudiant/create.html.twig', [
            'form' => $form->createView()
       ]);
        
    }

    /**
     * @Route("/etudiant/list", name="etudiant_list")
     */
    public function etudiantsList(EtudiantRepository $etudiantRepository){
        $etudiants = $etudiantRepository->findAll();
        return $this->render('etudiant/listEtudiants.html.twig', compact('etudiants')); 
    }
    /**
     * @Route("/etudiant/{id<[0-9]+>}/update", name="etudiant_update", methods={"POST", "GET"})
     */
   public function update(Request $request, Etudiant $etudiant, EntityManagerInterface $em):Response{
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute('etudiant_list');
        }
        return $this->render('etudiant/update.html.twig', [
            'etudiant'=>$etudiant,
            'form' => $form->createView()
       ]);
   }

  
   /**
     * @Route("/etudiant/{id<[0-9]+>}/delete", name="etudiant_delete", methods={"GET"})
     */

    public function delete(Etudiant $etudiant, EntityManagerInterface $em):Response{
            $em->remove($etudiant);
            $em->flush();
         return $this->redirectToRoute('etudiant_index');
       
    }

}
