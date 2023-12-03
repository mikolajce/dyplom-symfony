<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home(EntityManagerInterface $em): Response
    {
        $pid = random_int(1,500);
        $cid = random_int(1,50);
        $oid = random_int(1,100);

        $data = $em->getRepository(Product::class)->find($pid);

        return $this->render('/index.html.twig', parameters: [
            'product' => $data,
            'pid' => $pid,
            'cid' => $cid,
            'oid' => $oid
        ]);
    }
}