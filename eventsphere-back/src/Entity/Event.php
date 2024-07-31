<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $event_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $event_date = null;

    #[ORM\Column(length: 150)]
    private ?string $event_address = null;

    #[ORM\Column(length: 100)]
    private ?string $event_city = null;

    #[ORM\Column(length: 50)]
    private ?string $event_region = null;

    #[ORM\Column(length: 255)]
    private ?string $event_type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $event_description = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $event_host = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $event_banner = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $event_assets = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $event_attendees = null;

    #[ORM\Column]
    private ?bool $is_free_event = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ticket_link = null;

    #[ORM\ManyToMany(targetEntity: OrganizationAccount::class, inversedBy: 'events')]
    private Collection $organization_account_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToOne(mappedBy: 'event_id', cascade: ['persist', 'remove'])]
    private ?EventFeedback $eventFeedback = null;

    public function __construct()
    {
        $this->organization_account_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): static
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->event_date;
    }

    public function setEventDate(\DateTimeInterface $event_date): static
    {
        $this->event_date = $event_date;

        return $this;
    }

    public function getEventAddress(): ?string
    {
        return $this->event_address;
    }

    public function setEventAddress(string $event_address): static
    {
        $this->event_address = $event_address;

        return $this;
    }

    public function getEventCity(): ?string
    {
        return $this->event_city;
    }

    public function setEventCity(string $event_city): static
    {
        $this->event_city = $event_city;

        return $this;
    }

    public function getEventRegion(): ?string
    {
        return $this->event_region;
    }

    public function setEventRegion(string $event_region): static
    {
        $this->event_region = $event_region;

        return $this;
    }

    public function getEventType(): ?string
    {
        return $this->event_type;
    }

    public function setEventType(string $event_type): static
    {
        $this->event_type = $event_type;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->event_description;
    }

    public function setEventDescription(string $event_description): static
    {
        $this->event_description = $event_description;

        return $this;
    }

    public function getEventHost(): ?string
    {
        return $this->event_host;
    }

    public function setEventHost(?string $event_host): static
    {
        $this->event_host = $event_host;

        return $this;
    }

    public function getEventBanner(): ?string
    {
        return $this->event_banner;
    }

    public function setEventBanner(?string $event_banner): static
    {
        $this->event_banner = $event_banner;

        return $this;
    }

    public function getEventAssets(): ?array
    {
        return $this->event_assets;
    }

    public function setEventAssets(?array $event_assets): static
    {
        $this->event_assets = $event_assets;

        return $this;
    }

    public function getEventAttendees(): ?int
    {
        return $this->event_attendees;
    }

    public function setEventAttendees(?int $event_attendees): static
    {
        $this->event_attendees = $event_attendees;

        return $this;
    }

    public function isIsFreeEvent(): ?bool
    {
        return $this->is_free_event;
    }

    public function setIsFreeEvent(bool $is_free_event): static
    {
        $this->is_free_event = $is_free_event;

        return $this;
    }

    public function getTicketLink(): ?string
    {
        return $this->ticket_link;
    }

    public function setTicketLink(?string $ticket_link): static
    {
        $this->ticket_link = $ticket_link;

        return $this;
    }

    /**
     * @return Collection<int, OrganizationAccount>
     */
    public function getOrganizationAccountId(): Collection
    {
        return $this->organization_account_id;
    }

    public function addOrganizationAccountId(OrganizationAccount $organizationAccountId): static
    {
        if (!$this->organization_account_id->contains($organizationAccountId)) {
            $this->organization_account_id->add($organizationAccountId);
        }

        return $this;
    }

    public function removeOrganizationAccountId(OrganizationAccount $organizationAccountId): static
    {
        $this->organization_account_id->removeElement($organizationAccountId);

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

    public function getEventFeedback(): ?EventFeedback
    {
        return $this->eventFeedback;
    }

    public function setEventFeedback(?EventFeedback $eventFeedback): static
    {
        // unset the owning side of the relation if necessary
        if ($eventFeedback === null && $this->eventFeedback !== null) {
            $this->eventFeedback->setEventId(null);
        }

        // set the owning side of the relation if necessary
        if ($eventFeedback !== null && $eventFeedback->getEventId() !== $this) {
            $eventFeedback->setEventId($this);
        }

        $this->eventFeedback = $eventFeedback;

        return $this;
    }
}
