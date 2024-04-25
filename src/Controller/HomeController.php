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
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, ImageManager $imageManager): Response
    {
        $targerDirectory = $imageManager->getTargetDirectory();
        $categories = $categoryRepository->findAll();
        $products = $productRepository->findAll();
       
        return $this->render('home/homepage.html.twig', [
            'products' => $products,
            'controller_name' => 'HomeController',
            'categories' => $categories,
            'target_directory' => $targerDirectory  
        ]);
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('admin/admin.html.twig'); 
        } else {
            return $this->render('home/home.html.twig'); // Rediriger vers le tableau de bord utilisateur
        }
    }
    
}
