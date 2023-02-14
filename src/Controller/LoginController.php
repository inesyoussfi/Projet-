<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: '_form')]
    public function login(AuthenticationUtils $authenticationUtils) : Response
    { if($this->getUser()){
        return $this->redirectToRoute('login/index') ;
    }
     $error = $authenticationUtils->getLastAuthenticationError();
        $lastName = $authenticationUtils -> getLastName() ;
        return $this->render('login/index.html.twig' , ['lastName ' => $lastName , 'error' => $error]);
    }

   #[Route(path: '/logout', name:'app_logout')]
    public function logout() : void {
        throw new \LogicException('Cette méthode peut être vide - elle sera interceptée par la clé de déconnexion de votre pare-feu') ;
   }
}
