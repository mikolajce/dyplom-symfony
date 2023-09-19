<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/clients', name: 'all_clients')]
    public function allClients(EntityManagerInterface $em): Response
    {
        $c = $em->getRepository(Client::class)->findAll();

        return $this->render('/client-all.html.twig', parameters: [
            'clients' => $c
        ]);
    }
    #[Route('/clients/{id}', name: 'one_client')]
    public function oneClient(EntityManagerInterface $em, int $id): Response
    {
        $c = $em->getRepository(Client::class)->find($id);

        return $this->render('/client-one.html.twig', parameters: [
            'client' => $c
        ]);
    }

}