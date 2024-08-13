<?php

namespace App\Managers;

use App\DBAL\UserType;
use App\Entity\User;
use App\Services\DataValidator;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationManager extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private JWTTokenManagerInterface $jwtManager;
    private UserPasswordHasherInterface $passwordHasher;

    private DataValidator $dataValidator;

    public function __construct(EntityManagerInterface      $entityManager,
                                JWTTokenManagerInterface    $jwtManager,
                                UserPasswordHasherInterface $passwordHasher,
                                DataValidator               $dataValidator)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->jwtManager = $jwtManager;
        $this->dataValidator = $dataValidator;
    }

    public function Register($userData): bool|JsonResponse {
        $user = new User();

        if (!$this->verifyRequiredData($userData)) {

            return new JsonResponse(['message' => 'Missing required fields.'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->dataValidator->registrationDataValidation($userData)) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $userData[UserType::PASSWORD]
            );

            $user->setPassword($hashedPassword)
                ->setEmail($userData[UserType::EMAIL])
                ->setLastname($userData[UserType::LASTNAME])
                ->setFirstname($userData[UserType::FIRSTNAME])
                ->setNickname($userData[UserType::NICKNAME])
                ->setAddress($userData[UserType::ADDRESS])
                ->setCity($userData[UserType::CITY])
                ->setPostalCode(($userData[UserType::POSTAL_CODE]))
                ->setIpAddress($userData[UserType::IP_ADDRESS])
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setIpAddress('127.0.0.1');
            // TODO : Remove "setIpAddress", only used in dev for testing purposes.

            try {
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            } catch (\Exception $e) {
                return new JsonResponse([
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
            }

            return new JsonResponse("User created successfully.");
        } else {

            return $this->dataValidator->registrationDataValidation($userData);
        }
    }
    private function verifyRequiredData($userData): bool {
        $requiredFields = [UserType::EMAIL, UserType::PASSWORD, UserType::FIRSTNAME, UserType::NICKNAME, UserType::LASTNAME, UserType::CITY, UserType::POSTAL_CODE];

        if (array_diff_key(array_flip($requiredFields), $userData)) {

            return false;
        }

        return true;
    }
}