<?php

namespace App\Managers;

use App\DBAL\UserType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SessionManager extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(EntityManagerInterface $entityManager, JWTTokenManagerInterface $jwtManager)
    {
        $this->entityManager = $entityManager;
        $this->jwtManager = $jwtManager;
    }

    public function utf8ize( $mixed ) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }

    public function login($request): bool|array {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (empty($credentials[UserType::EMAIL]) || empty($credentials[UserType::PASSWORD])) {
            throw new BadRequestHttpException('Email and password must be provided.');
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'test0@test.com']);
        dd('lol');
        if (!$user) {
            throw new NotFoundHttpException('User not found.');
        }


        if (password_verify($credentials[UserType::PASSWORD], $user->getPassword())) {

            $token = $this->jwtManager->create($user);

            $user->setToken($token);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // return new JsonResponse(['token' => $bearerToken], Response::HTTP_OK, ['Authorization' => $bearerToken]);
            return [
                'token' => $token,
                'user' => $user->getNickname()
            ];
        } else {

            return false;
        }
    }

    public function logout($token, $request): JsonResponse {
        $apiToken = str_replace('Bearer ', '', $token);

        $email = $request->email ?? null;

        // Ensure the email is provided
        if (!$email) {
            throw new BadRequestHttpException('Bad credentials.');
        }

        $currentUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $request->email,
        ]);

        if (!$currentUser) {
            throw new NotFoundHttpException('User not found.');
        }

        if ($apiToken === $currentUser->getToken()){
            try {
                $currentUser->setToken(null);
                $this->entityManager->persist($currentUser);
                $this->entityManager->flush();

                return new JsonResponse(['message' => 'User logged out successfully.'], Response::HTTP_OK);

            } catch (\Exception $e) {

                return new JsonResponse(['code' => $e->getMessage(), 'message' => 'Something\'s wrong.'], Response::HTTP_OK);
            }
        } else {

            return new JsonResponse(['Code' => 'Mild pink', 'Message' => 'Trynna do something nasty innit?']);
        }
    }
}