<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'all_products', priority: 2)]
    public function allProducts(EntityManagerInterface $em): Response
    {
        $p = $em->getRepository(Product::class)->findAll();

        if(!$p){
            throw $this->createNotFoundException(
                'nie znaleziono produktów'
            );
        }

        return $this->render('/product-all.html.twig', parameters: [
            'products' => $p
        ]);
    }

    #[Route('/products/{id}', name: 'get_product')]
    public function getProduct(EntityManagerInterface $em, int $id): Response
    {
        $p = $em->getRepository(Product::class)->find($id);

        if(!$p) {
            throw $this->createNotFoundException(
                'nie znaleziono produktu'
            );
        }

        return $this->render('/product-one.html.twig', parameters: [
            'product' => $p
        ]);
    }
}