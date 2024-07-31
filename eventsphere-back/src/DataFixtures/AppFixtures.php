<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Meetup;
use App\Entity\OrganizationAccount;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('test' . $i . '@test.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword('password' . $i);
            $user->setLastname('Lastname' . $i);
            $user->setFirstname('Firstname' . $i);
            $user->setAddress($i . ' Rue de la Paix');
            $user->setCity('City' . $i);
            $user->setPostalCode('13000');
            $user->setIpAddress('127.0.0.1');

            $now = new \DateTimeImmutable();
            $user->setCreatedAt($now);
            $user->setUpdatedAt($now);
            $manager->persist($user);
        }
        
        for ($i = 0; $i < 10; $i++) {
            $meetup = new Meetup();
            $meetup->setMeetupName('Meetup' . $i);
            $meetup->setMeetupDate(new \DateTimeImmutable());
            $meetup->setMeetupCity('City' . $i);
            $meetup->setMeetupRegion('Region' . $i);
            $meetup->setMeetupAddress($i . ' Rue de la Place');
            $meetup->setMeetupGpsCoordinates($i . $i);
            $meetup->setMeetupEventType('event_type' . $i);
            $meetup->setMeetupMaxParticipant('10');
            $meetup->setCreatedAt(new \DateTimeImmutable());
            $meetup->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($meetup);
        }

        for ($i = 0; $i < 10; $i++) {
            $event = new Event();
            $event->setEventName('Event' . $i);
            $event->setEventDate(new \DateTimeImmutable());
            $event->setEventCity('Paris' . $i);
            $event->setEventRegion('Nord' . $i);
            $event->setEventAddress($i . ' Rue de la Place');
            $event->setEventType('event_type' . $i);
            $event->setEventDescription("La diarrhée du voyageur, appelée également tourista ou encore turista, est une gastro-entérite aiguë qui se manifeste par une diarrhée associée à des symptômes tels que fatigue, douleurs et crampes abdominales, nausées, vomissements ou malaises, survenant chez le voyageur à destination d'un pays à faible niveau d'hygiène alimentaire ou hydrique. En moyenne un vacancier sur trois peut souffrir de cette infection aiguë, souvent autorésolutive. La tourista peut se chroniciser si elle est due à une bactérie capable de coloniser durablement le colon comme Brachyspira spp.");
            $event->setEventAttendees("346");
            $event->setCreatedAt(new \DateTimeImmutable());
            $event->setUpdatedAt(new \DateTimeImmutable());
            $event->setIsFreeEvent(true);


            $manager->persist($event);
        }

        for ($i = 0; $i < 10; $i++) {
            $organization = new OrganizationAccount();
            $organization->setPersonnalLastname('Nom' . $i);
            $organization->setPersonalFirstname('Prénom' . $i);
            $organization->setPersonalEmail('email' . $i . '@example.com');
            $organization->setPersonalAddress($i . ' Rue de la Place');
            $organization->setPersonalCity('City' . $i);
            $organization->setPersonalRegion('Region' . $i);
            $organization->setPersonalPhone('123456789' . $i);
            $organization->setPassword('password' . $i);
            $organization->setOrganizationName('Organization' . $i);
            $organization->setOrganizationEmail('organization' . $i . '@example.com');
            $organization->setOrganizationPhone('987654321' . $i);
            $organization->setOrganizationAddress($i . ' Rue de la Place');
            $organization->setOrganizationCity('City' . $i);
            $organization->setOrganizationPostalCode(12345 + $i);
            $organization->setOrganizationRegion('Region' . $i);
            $organization->setOrganizationType('Type' . $i);
            $organization->setIpAddress('127.0.0.1');
            $organization->setCreatedAt(new \DateTimeImmutable());
            $organization->setUpdatedAt(new \DateTimeImmutable());
        
            $manager->persist($organization);
        }

        $manager->flush();
    }
}

