<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
       
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/admin.html.twig', [
            'users' => $users,
        ]);
    }

    // #[Route('/admin/users', name: 'app_admin_users')]
    // public function index2(EntityManagerInterface $entityManager): Response
    // {
    //     $users = $entityManager->getRepository(User::class)->findAll();
       
    //     return $this->render('admin/admin-user.html.twig', [
    //         'users' => $users,
    //     ]);
    // }
}
