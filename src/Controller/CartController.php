<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\Cart1Type;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_cart_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        return $this->render('cart/index.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }
        
        // Code de Milan
    // #[Route("/add-to-cart/{productId}", name:"add_to_cart", methods:["POST"])]
    // public function addToCart($productId, CartRepository $cartRepository): Response
    // {
    //     $product = $this->productRepository->find($productId);

    //     if (!$product) {
    //         return $this->redirectToRoute('app_home');// RENVOYER VERS PAGE PRODUIT INEXISTANT
    //     }

    //     $user = $this->getUser();

    //     if (!$user) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     //var_dump($user);
    //     $cart = $this->cartRepository->findOneBy(['user' => $user]); // LE PB

    //     //var_dump($cart);
    //     if (!$cart) {
    //         $cart = new Cart();
    //         $cart->setUser($user);  //A MODIFIER
    //         $cart->setTotal(0);
    //         $cart->setCreatedAt(new DateTimeImmutable());
    //         $this->entityManager->persist($cart);
    //         $this->entityManager->flush();
    //     }

         
    //     $cartProduct = $this->productCartRepository->findOneBy(['cart' => $cart, 'product' => $product]);

    //     if ($cartProduct) {
    //         $cartProduct->setQuantity($cartProduct->getQuantity() + 1);
    //     } else {
    //         $cartProduct = new ProductCart();
    //         $cartProduct->setCart($cart);
    //         $cartProduct->setProduct($product);
    //         $cartProduct->setQuantity(1);  
    //         $this->entityManager->persist($cartProduct);
    //     }

    //     $this->entityManager->flush();

    //     return $this->redirectToRoute('app_home');  //A MODIFIER SI ON VEUT REDIRIGER VERS UNE PAGE BIEN SPECIFIQUE
        
    // }

    // #[Route('/new', name: 'app_cart_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $cart = new Cart();
    //     $form = $this->createForm(Cart1Type::class, $cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($cart);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('cart/new.html.twig', [
    //         'cart' => $cart,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_cart_show', methods: ['GET'])]
    public function show(Cart $cart): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_cart_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(Cart1Type::class, $cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('cart/edit.html.twig', [
    //         'cart' => $cart,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_cart_delete', methods: ['POST'])]
    public function delete(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
