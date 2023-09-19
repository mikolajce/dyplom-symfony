<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/orders', name: 'all_orders')]
    public function allOrders(EntityManagerInterface $em): Response
    {
        $query = $em->createNativeQuery('
            SELECT *
            FROM diplomasymfony.order
        ',
            $rsm = new ResultSetMapping());

        $orders = $query->getResult();

        var_dump($orders);

        return $this->render('/orders-all.html.twig', parameters: [
            'orders' => $orders ?? null
        ]);
    }
}
