<?php

namespace App\Entity;

use App\Repository\OrganizationAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganizationAccountRepository::class)]
class OrganizationAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $personnal_lastname = null;

    #[ORM\Column(length: 50)]
    private ?string $personal_firstname = null;

    #[ORM\Column(length: 180)]
    private ?string $personal_email = null;

    #[ORM\Column(length: 150)]
    private ?string $personal_address = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $personal_address_two = null;

    #[ORM\Column(length: 100)]
    private ?string $personal_city = null;

    #[ORM\Column(length: 50)]
    private ?string $personal_region = null;

    #[ORM\Column(length: 30)]
    private ?string $personal_phone = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $organization_name = null;

    #[ORM\Column(length: 180)]
    private ?string $organization_email = null;

    #[ORM\Column(length: 30)]
    private ?string $organization_phone = null;

    #[ORM\Column(length: 150)]
    private ?string $organization_address = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $organization_address_two = null;

    #[ORM\Column(length: 100)]
    private ?string $organization_city = null;

    #[ORM\Column]
    private ?int $organization_postal_code = null;

    #[ORM\Column(length: 50)]
    private ?string $organization_region = null;

    #[ORM\Column(length: 70)]
    private ?string $organization_type = null;

    #[ORM\Column(length: 250)]
    private ?string $ip_address = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'organization_account_id')]
    private Collection $events;

    #[ORM\OneToOne(mappedBy: 'Organization_id', cascade: ['persist', 'remove'])]
    private ?EventFeedback $eventFeedback = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnalLastname(): ?string
    {
        return $this->personnal_lastname;
    }

    public function setPersonnalLastname(string $personnal_lastname): static
    {
        $this->personnal_lastname = $personnal_lastname;

        return $this;
    }

    public function getPersonalFirstname(): ?string
    {
        return $this->personal_firstname;
    }

    public function setPersonalFirstname(string $personal_firstname): static
    {
        $this->personal_firstname = $personal_firstname;

        return $this;
    }

    public function getPersonalEmail(): ?string
    {
        return $this->personal_email;
    }

    public function setPersonalEmail(string $personal_email): static
    {
        $this->personal_email = $personal_email;

        return $this;
    }

    public function getPersonalAddress(): ?string
    {
        return $this->personal_address;
    }

    public function setPersonalAddress(string $personal_address): static
    {
        $this->personal_address = $personal_address;

        return $this;
    }

    public function getPersonalAddressTwo(): ?string
    {
        return $this->personal_address_two;
    }

    public function setPersonalAddressTwo(?string $personal_address_two): static
    {
        $this->personal_address_two = $personal_address_two;

        return $this;
    }

    public function getPersonalCity(): ?string
    {
        return $this->personal_city;
    }

    public function setPersonalCity(string $personal_city): static
    {
        $this->personal_city = $personal_city;

        return $this;
    }

    public function getPersonalRegion(): ?string
    {
        return $this->personal_region;
    }

    public function setPersonalRegion(string $personal_region): static
    {
        $this->personal_region = $personal_region;

        return $this;
    }

    public function getPersonalPhone(): ?string
    {
        return $this->personal_phone;
    }

    public function setPersonalPhone(string $personal_phone): static
    {
        $this->personal_phone = $personal_phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getOrganizationName(): ?string
    {
        return $this->organization_name;
    }

    public function setOrganizationName(string $organization_name): static
    {
        $this->organization_name = $organization_name;

        return $this;
    }

    public function getOrganizationEmail(): ?string
    {
        return $this->organization_email;
    }

    public function setOrganizationEmail(string $organization_email): static
    {
        $this->organization_email = $organization_email;

        return $this;
    }

    public function getOrganizationPhone(): ?string
    {
        return $this->organization_phone;
    }

    public function setOrganizationPhone(string $organization_phone): static
    {
        $this->organization_phone = $organization_phone;

        return $this;
    }

    public function getOrganizationAddress(): ?string
    {
        return $this->organization_address;
    }

    public function setOrganizationAddress(string $organization_address): static
    {
        $this->organization_address = $organization_address;

        return $this;
    }

    public function getOrganizationAddressTwo(): ?string
    {
        return $this->organization_address_two;
    }

    public function setOrganizationAddressTwo(?string $organization_address_two): static
    {
        $this->organization_address_two = $organization_address_two;

        return $this;
    }

    public function getOrganizationCity(): ?string
    {
        return $this->organization_city;
    }

    public function setOrganizationCity(string $organization_city): static
    {
        $this->organization_city = $organization_city;

        return $this;
    }

    public function getOrganizationPostalCode(): ?int
    {
        return $this->organization_postal_code;
    }

    public function setOrganizationPostalCode(int $organization_postal_code): static
    {
        $this->organization_postal_code = $organization_postal_code;

        return $this;
    }

    public function getOrganizationRegion(): ?string
    {
        return $this->organization_region;
    }

    public function setOrganizationRegion(string $organization_region): static
    {
        $this->organization_region = $organization_region;

        return $this;
    }

    public function getOrganizationType(): ?string
    {
        return $this->organization_type;
    }

    public function setOrganizationType(string $organization_type): static
    {
        $this->organization_type = $organization_type;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(string $ip_address): static
    {
        $this->ip_address = $ip_address;

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

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->addOrganizationAccountId($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            $event->removeOrganizationAccountId($this);
        }

        return $this;
    }

    public function getEventFeedback(): ?EventFeedback
    {
        return $this->eventFeedback;
    }

    public function setEventFeedback(EventFeedback $eventFeedback): static
    {
        // set the owning side of the relation if necessary
        if ($eventFeedback->getOrganizationId() !== $this) {
            $eventFeedback->setOrganizationId($this);
        }

        $this->eventFeedback = $eventFeedback;

        return $this;
    }
}
