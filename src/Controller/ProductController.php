<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Product;
use App\Form\FileType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\ImageManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/admin/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ImageManager $imageManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        
        $file = new File();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $formData = $form->getData();     
            $uploadFile = $form->get('file')->getData();     
            $public = $formData->getPublic(); 
        
            $fileName = $imageManager->upload($uploadFile, 1);
            $file->setPath($fileName);
            $file->setType('image');
            $file->setCreatedOn(new \DateTimeImmutable());
            $file->setPublic($public);
            //$file->setPublic(true);  //Pour supprimer dans ProductType le champs pulic
            $file->setName($uploadFile->getClientOriginalName());
            $file->setCreatedOn(new \DateTimeImmutable());

            $product->setImage($file);

            $entityManager->persist($file);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/detail', name: 'app_product_show_detail', methods: ['GET'])]
    public function showDetail(Product $product): Response
    {
        return $this->render('product/show_detail.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/admin/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }

    
}


// #[Route('/produits', name: 'app_product_')]
// class ProductUserController extends AbstractController{

//     #[Route('/', name: 'list')]
//     public function list(EntityManagerInterface $em, ProductRepository $pr): Response
//     {
//         //$products = $em -> getRepository(Product::class) -> findAll();
//         $products = $em -> getRepository(Product::class) -> findby(['deleteDate' => null]);
//         return $this->render('product/list.html.twig');
//     }

//     #[Route('/{slug}', name: 'view')]
//     public function view(String $slug): Response
//     {
//         return $this->render('product/view.html.twig');
//     }


// }