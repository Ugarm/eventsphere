<?php

namespace App\Controller\API;

use App\Repository\UserRepository;
use App\Entity\ExternalPartner;
use App\Services\DataValidator;
use App\Services\ExternalPartnerPasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
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
    #[Route('/api/me', name: 'app_me')]
    public function me()
    {

        return $this->json($this->getUser(), 200, [], [
            'groups' => ['users.read']
        ]);
    }

    #[Route('/api/users', name: 'app_users')]
    public function users(UserRepository $userRepository)
    {
        try {
            $users = $userRepository->findAll();
        } catch (\Exception $e) {
            return new JsonResponse([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }

        return $this->json($users, 200, [], [
            'groups' => ['users.read']
        ]);

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
