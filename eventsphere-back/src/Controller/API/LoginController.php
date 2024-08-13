<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Managers\SessionManager;
use App\Security\APIAuthenticator;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController extends AbstractController
{
    private $jwtManager;
    private $loginAuthenticator;
    private $apiAuthenticator;
    private $entityManager;
    private $tokenStorage;
    private $sessionManager;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        LoginAuthenticator       $loginAuthenticator,
        APIAuthenticator         $apiAuthenticator,
        EntityManagerInterface   $entityManager,
        TokenStorageInterface    $tokenStorage,
        SessionManager           $sessionManager,
        )
    {
        $this->jwtManager = $jwtManager;
        $this->loginAuthenticator = $loginAuthenticator;
        $this->apiAuthenticator = $apiAuthenticator;
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->sessionManager = $sessionManager;
    }

     #[Route('/api/login', name: 'api_login', methods: ['POST'])]
     public function index(#[CurrentUser] ?User $user): Response
     {
         if (null === $user) {
             return $this->json([
                 'message' => 'missing credentials',
             ], Response::HTTP_UNAUTHORIZED);
         }

         return $this->json($this->getUser(), 200, [
                 'Authorization' => $token
             ],
             [
                 'groups' => ['users.read'],
             ]
         );
     }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        // Executes login method
        try {
        $response = $this->sessionManager->login(json_decode($request->getContent()));
        } catch (\Exception $e) {
        return new JsonResponse([
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ]);
        }

        // Returns the right data if everything is alright, else returns an error
        if ($response){

            return $this->json([
                "user" => $response['user'],
                "token" => $response['token']
            ], 200, [
                  'Authorization' => $response['token']
            ],
            [
                  'groups' => ['users.read'],
            ]
            );
        } else {

            return throw new BadCredentialsException('User or password incorrect.');
        }
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(Request $request): JsonResponse
    {
        // fetches user token and unlog them
        $token = $request->headers->get('Authorization');

        return $this->sessionManager->logout($token, json_decode($request->getContent()));
    }

}

