<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController
{
    #[Route('/health-check', name: 'health_check', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
