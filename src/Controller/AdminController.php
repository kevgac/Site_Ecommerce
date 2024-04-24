<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Service\ImageManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\FileType;

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

    #[Route('/admin/upload', name: 'app_admin_upload')]
    public function upload(Request $request, ImageManager $imageManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $file = new File();

        $form = $this -> createForm(FileType::class, $file);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $uploadFile = $form->get('file')->getData();
            $fileName = $imageManager->upload($uploadFile, $file->isPublic());
            
            $file->setPath($fileName);
            $file->setType('image');
            $file->setCreatedOn  (new \DateTimeImmutable());
        }
       
        return $this->render('admin/upload.html.twig', [
            'form' => $form->createView(),
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
