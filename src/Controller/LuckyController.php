<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number', name: 'lucky_number')]
    public function number(): Response
    {
        $number = random_int(0,100);

        return $this->render('lucky/number.html.twig',[
            'number' => $number
        ]);
    }

    #[Route('/lucky/{id}', name: 'exact_number')]
    public function exactNumber(int $id): Response
    {
        return $this->render('lucky/number.html.twig',[
            'number' => $id
        ]);
    }

    #[Route('/products/new', name: 'add_product')]
    public function newProduct(EntityManagerInterface $em): Response
    {
        $p = new Product();
        $p->setName('srubeczki');
        $p->setPrice(19);
        $p->setManufacturer('Corsair');
        $p->setStock(3);

        $em->persist($p);
        $em->flush();

//        return $this->render('entry/index.html.twig',[
//
//        ]);

        return new Response('zapisano' .$p->getId());
    }
}
