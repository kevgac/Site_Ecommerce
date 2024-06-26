<?php

namespace App\Controller;

use App\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\ConnectionType;
use App\Form\InscriptionType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\ImageManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, ImageManager $imageManager, EntityManagerInterface $em): Response
    {
        $targetDirectory = $imageManager->getTargetDirectory(); 
        $categories = $categoryRepository->findAll();
        $products = $productRepository->findAll();
        $images = $em->getRepository(File::class)->findAll();
        
        $templateData = [
            'products' => $products,
            'controller_name' => 'HomeController',
            'categories' => $categories,
            'target_directory' => $targetDirectory,
            'images' => $images
        ];
        
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('admin/admin.html.twig', $templateData); 
        } else {
            return $this->render('home/homepage.html.twig', $templateData);
        }
    }
}
