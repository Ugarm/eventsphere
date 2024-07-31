<?php

namespace App\Controller\API;

use App\Entity\Event;
use App\Entity\Meetup;
use App\Services\EventFinder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\DataValidator;
use App\Entity\ExternalPartner;

class ExternalPartnerController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private DataValidator $dataValidator;

    public function __construct(
        EntityManagerInterface $entityManager,
        DataValidator $dataValidator
        ) 
    {
        $this->entityManager = $entityManager;
        $this->dataValidator = $dataValidator;
    }

    #[Route('/datareq', name: 'data_request', methods: ['GET'])]
    public function processExternalRequest(Request $request): JsonResponse
    {
        $requestContent = json_decode($request->getContent(), true);

        try {
            $partner = $this->entityManager->getRepository(ExternalPartner::class)->findOneBy([
                'token' => str_replace('Bearer ', '', $request->headers->get('Authorization'))
            ]);
        } catch (\Exception $e) {

            return new JsonResponse([
                'Message' => $e->getMessage(),
                'Code' => $e->getCode()
            ]);
        }

        if ($partner->getPartnername() != $requestContent['partnername'] || !password_verify($requestContent['password'], $partner->getPassword())) {

            return new JsonResponse([
                "Message" => "Error, invalid credentials."
            ]);
        }
        $events = $this->entityManager->getRepository(Event::class);
        $meetups = $this->entityManager->getRepository(Meetup::class);

        if ($requestContent['request'] == 'single') {
            if ($requestContent['type'] == 'event') {
                try {
                    $event = $events->findOneBy([
                        'id' => $requestContent['id']
                    ]);

                    return new JsonResponse($event);
                } catch (\Exception $e) {

                    return new JsonResponse([
                        'Message' => $e->getMessage(),
                        'Code' => $e->getCode()
                    ]);
                }
            }

            if ($requestContent['type'] == 'meetup') {
                try {
                    $event = $meetups->findOneBy([
                        'id' => $requestContent['id']
                    ]);

                    return new JsonResponse($event);
                } catch (\Exception $e) {

                return new JsonResponse([
                    'Message' => $e->getMessage(),
                    'Code' => $e->getCode()
                ]);
                }
            }
        } elseif ($requestContent['request'] == 'filtered') {
            $eventFinder = new EventFinder($this->entityManager);
            return $eventFinder->findEvents($requestContent);
        }
    }
}