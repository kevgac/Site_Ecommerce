<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    // private $session;

    // public function __construct(SessionInterface $session)
    // {
    //     $this->session = $session;
    // }

    #[Route('/panier', name: 'app_panier')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
       // $panier = $this->session->get('panier', []); // Récupérer les produits du panier depuis la session
        
        $categories = $categoryRepository->findAll();
        $products = $productRepository->findAll();
        
        // Vous pouvez également récupérer les produits ajoutés au panier en utilisant leurs IDs depuis la base de données
        // $productsInCart = $productRepository->findByIds(array_keys($panier));

        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'PanierController',
            'categories' => $categories,
            'products' => $products,
           // 'panier' => $panier,
        ]);
    }
}
