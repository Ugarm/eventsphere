<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Security\APIAuthenticator;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoginController extends AbstractController
{
    private $jwtManager;
    private $loginAuthenticator;
    private $apiAuthenticator;
    private $entityManager;
    private $tokenStorage;

    public function __construct(
        JWTTokenManagerInterface                $jwtManager,
        LoginAuthenticator                      $loginAuthenticator,
        APIAuthenticator                        $apiAuthenticator,
        EntityManagerInterface                  $entityManager,
        TokenStorageInterface                   $tokenStorage
        
        )
    {
        $this->jwtManager = $jwtManager;
        $this->loginAuthenticator = $loginAuthenticator;
        $this->apiAuthenticator = $apiAuthenticator;
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    // #[Route('/login', name: 'api_login', methods: ['POST'])]
    // public function index(#[CurrentUser] ?User $user): Response
    // {
    //     if (null === $user) {
    //         return $this->json([
    //             'message' => 'missing credentials',
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $token = $this->jwtManager->create($user);

    //     return $this->json($this->getUser(), 200, [
    //             'Authorization' => $token
    //         ],
    //         [
    //             'groups' => ['users.read'],
    //         ]
    //     );
    // }

    #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, UserInterface $userInterface): JsonResponse
    {
        $request = json_decode($request->getContent());
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);

        if (password_verify($credentials['password'], $user->getPassword())) {
                $token = $this->jwtManager->create($user);
                // $bearerToken = 'Bearer ' . $token;

                try {
                    $user->setToken($token);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                } catch (\Exception $e) {
                    return new JsonResponse([
                        'code' => $e->getCode(),
                        'message' => $e->getMessage()
                    ]);
                }

                // return new JsonResponse(['token' => $bearerToken], Response::HTTP_OK, ['Authorization' => $bearerToken]);
                return $this->json([
                    "user" => $this->getUser(),
                    "token" => $token
                ], 200, [
                    'Authorization' => $token
                    ],
                    [
                    'groups' => ['users.read'],
                    ]
                );
        } else {
            throw new BadCredentialsException('User or password incorrect.');
        }
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(Request $request, Security $security): JsonResponse
    {

        $token = $request->headers->get('Authorization');

        $currentUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'token' => $token
        ]);
            
            try {
            $currentUser->setToken(null);
            $this->entityManager->persist($currentUser);
            $this->entityManager->flush();
            
            return new JsonResponse(['message' => 'User logged out successfully.'], Response::HTTP_OK);

        } catch (\Exception $e) {

            return new JsonResponse(['code' => $e->getMessage(), 'message' => 'Something\'s wrong.'], Response::HTTP_OK);
        } 
            
        return new JsonResponse(['Oops' => 'Bad luck'], Response::HTTP_BAD_REQUEST, ['Message' => 'Something\'s wrong']);
    }

}

