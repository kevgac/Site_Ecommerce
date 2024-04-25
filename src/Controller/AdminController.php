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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;

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
    public function upload(Request $request, ImageManager $imageManager, EntityManagerInterface $em): Response
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

            $em->persist($file);
            $em->flush();
        }
       
        return $this->render('admin/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/admin/download', name: 'app_admin_download')]
    public function download(EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $images = $em->getRepository(File::class)->findAll();

        return $this->render('admin/download.html.twig', [
            'images' => $images
        ]);
        
    }

    #[Route('/image/stream/{id}', name: 'app_image_stream')]
    public function imageStream(int $id, ImageManager $imageManager, EntityManagerInterface $em):Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $image = $em->getRepository(File::class)->find($id);
        $path = $image->getPath();

        return $imageManager->stream($path);
    }
}
