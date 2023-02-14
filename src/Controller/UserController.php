<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
                'users' => $users,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function  new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($user);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

   public function Request  (Request $request){
        $form = $this ->createForm(UserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $data = $form->getData();
        }
        return $this->render('_form.html.twig' , array(
            'form' => $form->createView() ,
        )) ;
   }
 public function user (Request $request) {
        $objet = new User();
        $form = $this->createForm(UserType::class , $objet);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $objet = $form->getData();
            var_dump($objet->getEmail());
            var_dump($objet->getFirstName());
            var_dump($objet->getLastName());
            var_dump($objet->getPhone());
            var_dump($objet->getPassword());
        }
        return $this->render('new.html.twig', array(
           'form' => $form->createView(),
        ));

 }
 public function monAction (Request $request , EntityManagerInterface $em){
        $user = new User();
        $form = $this ->createForm(UserType::class , $user);
     if ($form->isSubmitted()&&$form->isValid()){
       $user =$form->getData();
       $em->persist($user);
       $em->flush();
     }
     return $this->render('base.html.twig', array(
         'form' => $form->createView(),
     ));
 }
 public function createUser(ManagerRegistry $managerRegistry , Request $request): Response
 {
        $user = new User() ;
        $form = $this ->createForm(UserType::class ,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
         $em =$managerRegistry->getManager() ;
         $em->persist($user);
         $em->flush();
     }
     return $this->render('create.html.twig', array(
         'form' => $form->createView(),
     ));
 }
}


