<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function home(EntityManagerInterface $em): Response
    {

        $db = $em->getRepository(Product::class);

        $data = $db->find(random_int(1,500));

        if(!$data) throw $this->createNotFoundException(
            'blad wyswietlenia produktu'
        );

        return $this->render('/index.html.twig', parameters: [
            'product' => $data
        ]);
    }

}