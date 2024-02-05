<?php

namespace App\Controller;

use App\Entity\Vehicles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome from Symfony!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }

    #[Route('/vehicles', name: 'dummy_vehicle', methods: ['GET'])]
    public function dummyVehicle(EntityManagerInterface $entityManager): JsonResponse
    {
        $repository = $entityManager->getRepository(Vehicles::class);
        $allMessages = $repository->findAll();
        $result = [];
        foreach ($allMessages as $message) {
            $result[] = [
                'id' => $message->getId(),
                'name' => $message->getName(),
                'type' => $message->getType(),
                'size'=> $message->getSize(),
                'color' => $message->getColor(),
                'image' => $message->getImage(),
                'quantity' => $message->getQuantity(),
                'available'=> $message->getAvailable(),
                'wheel_size' => $message->getWheelSize(),
                'price' => $message->getPrice()
            ];
        }

        return $this->json($result);
    }
}
