<?php

namespace App\Controller\API;

use App\Entity\ExternalPartner;
use App\Entity\User;
use App\Services\ExternalPartnerPasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Random\RandomException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Services\DataValidator;

class RegistrationController extends AbstractController

{
    private EntityManagerInterface $entityManager;
    private DataValidator $dataValidator;
    private ExternalPartnerPasswordHasher $externalPartnerPasswordHasher;

    public function __construct(
        EntityManagerInterface          $entityManager,
        DataValidator                   $dataValidator,
        ExternalPartnerPasswordHasher   $externalPartnerPasswordHasher
        )
    {
        $this->entityManager = $entityManager;
        $this->dataValidator = $dataValidator;
        $this->externalPartnerPasswordHasher = $externalPartnerPasswordHasher;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws RandomException
     */
    #[Route('/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $userData = json_decode($request->getContent(), true);
        $user = new User();

        if (!isset($userData['email']) || !isset($userData['password']) || !isset($userData['firstname']) || !isset($userData['lastname']) || !isset($userData['city']) || !isset($userData['postal_code'])) {
            
            return new JsonResponse(['message' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        };

        if ($this->dataValidator->registrationDataValidation($userData)) {
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $userData['password']
            );
          

            $user->setPassword($hashedPassword)
                ->setEmail($userData['email'])
                ->setLastname($userData['lastname'])
                ->setFirstname($userData['firstname'])
                ->setNickname($userData['nickname'])
                ->setAddress($userData['address'])
                ->setCity($userData['city'])
                ->setPostalCode(($userData['postal_code']))
                ->setIpAddress($userData['ip_address'])
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setIpAddress('127.0.0.1');

            try {
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            } catch (\Exception $e) {
                return new JsonResponse([
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
            }

            return new JsonResponse(['message' => 'User registered successfully'], Response::HTTP_CREATED);
        } else {

            return $this->dataValidator->registrationDataValidation($userData);
        }
    }

    #[Route('/partners/creation', name: 'partner_creation')]
    public function newPartner(Request $request): JsonResponse
    {
        $partnerData = json_decode($request->getContent(), true);
        $partner = new ExternalPartner();

        if (!isset($partnerData['email']) || !isset($partnerData['password']) || !isset($partnerData['firstname']) || !isset($partnerData['lastname']) || !isset($partnerData['city']) || !isset($partnerData['postal_code'])) {
            
            return new JsonResponse(['message' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        };

        if ($this->dataValidator->partnerRegistrationDataValidation($partnerData)) {
            // sets hashed password for partner
            $this->externalPartnerPasswordHasher->hashPartnerPassword($partner, $partnerData['password']);
          
            $partner->setEmail($partnerData['email'])
                ->setLastname($partnerData['lastname'])
                ->setFirstname($partnerData['firstname'])
                ->setPartnername($partnerData['partnername'])
                ->setAddress($partnerData['address'])
                ->setCity($partnerData['city'])
                ->setPostalCode(($partnerData['postal_code']))
                ->setIpAddress($partnerData['ip_address'])
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setIpAddress('127.0.0.1');

            try {
                $this->entityManager->persist($partner);
                $this->entityManager->flush();
            } catch (\Exception $e) {
                return new JsonResponse([
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
            }

            return new JsonResponse(['message' => 'Partner registered successfully'], Response::HTTP_CREATED);
        } else {

            return $this->dataValidator->partnerRegistrationDataValidation($partnerData);
        }
    }
}