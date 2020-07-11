<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

      /**
     * @Route("/user/create", name="user_create", methods={"POST", "GET"})
     */
    public function create(Request $request, EntityManagerInterface $em):Response{
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user');
        }
        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
       ]);
        
    }

    
    /**
     * @Route("/user/list", name="user_list", methods={"POST", "GET"})
     */
    public function usersList(UserRepository $userRepository){
        $users = $userRepository->findAll();
        return $this->render('user/listUsers.html.twig', compact('users')); 
    }
}
