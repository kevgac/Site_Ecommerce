<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\ConnectionType;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // if ($this->isGranted('ROLE_ADMIN')){
        //     return $this->redirect('app_admin');
        // }

        return $this->render('home/homepage.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
}
