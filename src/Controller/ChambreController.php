<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="chambre")
     */
    public function index()
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }

    
    /**
     * @Route("/chambre/create", name="chambre_create", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $em):Response{
        $chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
                $alea = date("is") ;
                $numB = $chambre->getNumbatiment();
                $numch = $numB.$alea;
                $chambre->setNumch( $numch);
            $em->persist($chambre);
            $em->flush();
            return $this->redirectToRoute('chambre_create');
        }
        return $this->render('chambre/create.html.twig', [
             'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/chambre/list", name="chambre_list")
     */
    public function chambresList(ChambreRepository $chambreRepository){
        $chambres = $chambreRepository->findAll();
        return $this->render('chambre/listChambres.html.twig', compact('chambres'));
    
      
    }

}
