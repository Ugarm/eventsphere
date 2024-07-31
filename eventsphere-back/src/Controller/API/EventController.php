<?php

namespace App\Controller\API;

use App\Entity\Event;
use App\Entity\OrganizationAccount;
use App\Services\DataValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;

class EventController extends AbstractController
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
    #[Route('/event', name: 'app_event', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $eventData = json_decode($request->getContent(), true);

        $eventDate = new \DateTime($eventData['event_date']);
        $event = new Event();

        $organization = $this->entityManager->getRepository(OrganizationAccount::class)->findOneBy([
            'id' => 11
        ]);

        if (!$organization) {
            return new JsonResponse([
                'Message' => 'Organization not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if (!isset($eventData['event_name']) || 
            !isset($eventData['event_date']) || 
            !isset($eventData['event_address']) || 
            !isset($eventData['event_city']) || 
            !isset($eventData['event_region']) ||
            !isset($eventData['event_type']) ||
            !isset($eventData['event_description']) || 
            !isset($eventData['event_host']) || 
            !isset($eventData['event_banner']) || 
            !isset($eventData['event_assets']) || 
            !isset($eventData['event_attendees']) || 
            !isset($eventData['is_free_event']) || 
            !isset($eventData['ticket_link']))
        {

            return new JsonResponse([
                'Message' => 'missing data',
                'Code' => Response::HTTP_BAD_REQUEST
            ]);
        }

        // if ($this->dataValidator->verifyEvents($eventData, 'event')){
            $event->setEventName($eventData['event_name'])
            // ->addOrganizationAccountId($eventData['organization_account_id'])
            ->seteventDate($eventDate)
            ->setEventAddress($eventData['event_address'])
            ->setEventCity($eventData['event_city'])
            ->setEventRegion($eventData['event_region'])
            ->setEventType($eventData['event_type'])
            ->setEventDescription($eventData['event_description'])
            ->setEventHost($eventData['event_host'])
            ->setEventBanner($eventData['event_banner'])
            ->setEventAssets($eventData['event_assets'])
            ->setEventAttendees($eventData['event_attendees'])
            ->setIsFreeEvent($eventData['is_free_event'])
            ->setTicketLink($eventData['ticket_link'])
            // ->setEventFeedback($eventData['event_feedback'])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
            // ->setEventGpsCoordinates($eventData['event_gps_coordinates']); 
            
            //TODO: Implements Geolocalisation API


        try {
            $this->entityManager->persist($event);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse([
                'Code' => $e->getCode(),
                'Message' => $e->getMessage(),
            ]);
        }

        return new JsonResponse([
            'Message' => 'event created successfully',
            'Code' => Response::HTTP_OK,
            ]);
        // };

        // return new JsonResponse([
        //     'Message' => 'One or more illegal value', 
        //     'Code' => Response::HTTP_BAD_REQUEST
        // ]);
    } 

    #[Route('/event/show/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(SerializerInterface $serializer, Event $event): JsonResponse
    {

        $data = $serializer->serialize($event, 'json');

        return new JsonResponse($data, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/event/update/{id}', name: 'app_event_update', methods: ['PUT'])]
    public function update(Request $request, $id): JsonResponse
    {

        $eventData = json_decode($request->getContent(), true);
        $event = $this->entityManager->getRepository(Event::class)->findOneBy([
            'id' => $id
        ]);

        $event->setEventName($eventData['event_name']);
        $event->setEventDescription($eventData['event_description']);
        // TODO coder la suite des setter !!!

        $this->entityManager->flush();

        return new JsonResponse('Event updated!', 200);
    }

    #[Route('/event/delete/{id}', name: 'app_event_delete', methods: ['DELETE'])]
    public function delete(Event $event): JsonResponse
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return new JsonResponse('Event deleted!', 200);
    }
    

}
