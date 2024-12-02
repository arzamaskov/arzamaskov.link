<?php

namespace App\Auth\Infrastructure\Controller;

use App\Auth\Application\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request};
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent());
        $email = $requestData->email;
        $password = $requestData->password;

        if (!$email || !$password) {
            return new JsonResponse(['message' => 'Invalid data', 400]);
        }

        $user = $this->userService->registerUser($email, $password);

        return new JsonResponse(['message' => 'User successfully registered'], 201);
    }
}
