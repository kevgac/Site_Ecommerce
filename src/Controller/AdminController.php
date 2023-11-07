<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
       $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // $test = true;
        // if($test === true){
        //     throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette page');
        // }

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
