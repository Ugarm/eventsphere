<?php

namespace App\Entity;

use App\Repository\MeetupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetupRepository::class)]
class Meetup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $meetup_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $meetup_date = null;

    #[ORM\Column(length: 100)]
    private ?string $meetup_city = null;

    #[ORM\Column(length: 50)]
    private ?string $meetup_region = null;

    #[ORM\Column(length: 100)]
    private ?string $meetup_address = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $meetup_gps_coordinates = null;

    #[ORM\Column(length: 255)]
    private ?string $meetup_event_type = null;

    #[ORM\Column(nullable: true)]
    private ?int $meetup_max_participant = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'meetups')]
    private Collection $user_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeetupName(): ?string
    {
        return $this->meetup_name;
    }

    public function setMeetupName(string $meetup_name): static
    {
        $this->meetup_name = $meetup_name;

        return $this;
    }

    public function getMeetupDate(): ?\DateTimeInterface
    {
        return $this->meetup_date;
    }

    public function setMeetupDate(\DateTimeInterface $meetup_date): static
    {
        $this->meetup_date = $meetup_date;

        return $this;
    }

    public function getMeetupCity(): ?string
    {
        return $this->meetup_city;
    }

    public function setMeetupCity(string $meetup_city): static
    {
        $this->meetup_city = $meetup_city;

        return $this;
    }

    public function getMeetupRegion(): ?string
    {
        return $this->meetup_region;
    }

    public function setMeetupRegion(string $meetup_region): static
    {
        $this->meetup_region = $meetup_region;

        return $this;
    }

    public function getMeetupAddress(): ?string
    {
        return $this->meetup_address;
    }

    public function setMeetupAddress(string $meetup_address): static
    {
        $this->meetup_address = $meetup_address;

        return $this;
    }

    public function getMeetupGpsCoordinates(): ?string
    {
        return $this->meetup_gps_coordinates;
    }

    public function setMeetupGpsCoordinates(?string $meetup_gps_coordinates): static
    {
        $this->meetup_gps_coordinates = $meetup_gps_coordinates;

        return $this;
    }

    public function getMeetupEventType(): ?string
    {
        return $this->meetup_event_type;
    }

    public function setMeetupEventType(string $meetup_event_type): static
    {
        $this->meetup_event_type = $meetup_event_type;

        return $this;
    }

    public function getMeetupMaxParticipant(): ?int
    {
        return $this->meetup_max_participant;
    }

    public function setMeetupMaxParticipant(?int $meetup_max_participant): static
    {
        $this->meetup_max_participant = $meetup_max_participant;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        $this->user_id->removeElement($userId);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
