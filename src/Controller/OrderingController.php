<?php

namespace App\Controller;

use App\Entity\Ordering;
use App\Entity\Status;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderingController extends AbstractController
{
    #[Route('/orders', name: 'all_orders')]
    public function allOrders(EntityManagerInterface $em): Response
    {

        $orders = $em->getRepository(Ordering::class)->findAll();

        return $this->render('/orders-all.html.twig', parameters: [
            'orderings' => $orders
        ]);
    }

    #[Route('/orders/status/{id}', name: 'orders_with_status')]
    public function ordersWithStatus(EntityManagerInterface $em, int $id): Response
    {
        $status = $em->getRepository(Status::class)->find($id);
        $code = $status->getCode();
        $orders = $status->getOrderings();

        return $this->render('/orders-status.html.twig', parameters: [
            'status' => $code,
            'orders' => $orders
        ]);
    }

    #[Route('/orders/{id}', name: 'order_details')]
    public function oneOrder(EntityManagerInterface $em, int $id): Response
    {
        $start = microtime(true);

        {
            $order = $em->getRepository(Ordering::class)->find($id);
            $client = $order->getClient();
            $status = $order->getStatus();
            $products = $order->getProducts();
        }

        $time = floor(100000*(microtime(true) - $start))/100;
        file_put_contents(__DIR__ . '/../../public/symfony_dbs.txt', round($time).PHP_EOL, FILE_APPEND);
        file_put_contents(__DIR__ . '/../../public/symfony_views.txt', htmlspecialchars($_COOKIE["time"]).PHP_EOL, FILE_APPEND);

        return $this->render('/orders-detail.html.twig', parameters: [
            'order' => $order,
            'client' => $client,
            'status' => $status,
            'products' => $products
        ]);
    }
}
