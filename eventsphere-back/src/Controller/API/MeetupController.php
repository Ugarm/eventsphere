<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\Meetup;
use App\Services\DataValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MeetupController extends AbstractController
{
    private $entityManager;

    private $dataValidator;
    public function __Construct(
        EntityManagerInterface $entityManager,
        DataValidator          $dataValidator
    ) {
        $this->entityManager = $entityManager;
        $this->dataValidator = $dataValidator;
    }
    #[Route('/meetup', name: 'app_meetup', methods: ['POST'])]
    public function newMeetup(Request $request): JsonResponse
    {
        $meetupData = json_decode($request->getContent(), true);

        $meetupDate = new \DateTime($meetupData['meetup_date']);
        $meetup = new Meetup();

        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'id' => 53
        ]);

        if (!$user) {
            return new JsonResponse([
                'Message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if (!isset($meetupData['meetup_name']) || 
            !isset($meetupData['meetup_date']) || 
            !isset($meetupData['meetup_city']) || 
            !isset($meetupData['meetup_region']) ||
            !isset($meetupData['meetup_address']) || 
            !isset($meetupData['meetup_event_type'])) {
                
            return new JsonResponse([
                'Message' => 'missing data',
                'Code' => Response::HTTP_BAD_REQUEST
            ]);
        }

        if ($this->dataValidator->verifyEvents($meetupData, 'meetup')){
            $meetup->setMeetupName($meetupData['meetup_name'])
            ->setMeetupDate($meetupDate)
            ->setMeetupCity($meetupData['meetup_city'])
            ->setMeetupRegion($meetupData['meetup_region'])
            ->setMeetupAddress($meetupData['meetup_address'])
            ->setMeetupEventType($meetupData['meetup_event_type'])
            ->setMeetupMaxParticipant($meetupData['meetup_max_participant'])
            ->addUserId($user)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
            // ->setMeetupGpsCoordinates($meetupData['meetup_gps_coordinates']); TODO: Implements Geolocalisation API


        try {
            $this->entityManager->persist($meetup);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse([
                'Code' => $e->getCode(),
                'Message' => $e->getMessage(),
            ]);
        }

        return new JsonResponse([
            'Message' => 'Meetup created successfully',
            'Code' => Response::HTTP_OK,
            ]);
        };

        return new JsonResponse([
            'Message' => 'One or more illegal value', 
            'Code' => Response::HTTP_BAD_REQUEST
        ]);
    } 

}
