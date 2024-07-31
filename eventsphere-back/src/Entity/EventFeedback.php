<?php

namespace App\Entity;

use App\Repository\EventFeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventFeedbackRepository::class)]
class EventFeedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $feedback_text = null;

    #[ORM\Column]
    private ?float $feedback_note = null;

    #[ORM\OneToOne(inversedBy: 'eventFeedback', cascade: ['persist', 'remove'])]
    private ?Event $event_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToOne(inversedBy: 'eventFeedback', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrganizationAccount $Organization_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeedbackText(): ?string
    {
        return $this->feedback_text;
    }

    public function setFeedbackText(?string $feedback_text): static
    {
        $this->feedback_text = $feedback_text;

        return $this;
    }

    public function getFeedbackNote(): ?float
    {
        return $this->feedback_note;
    }

    public function setFeedbackNote(float $feedback_note): static
    {
        $this->feedback_note = $feedback_note;

        return $this;
    }

    public function getEventId(): ?Event
    {
        return $this->event_id;
    }

    public function setEventId(?Event $event_id): static
    {
        $this->event_id = $event_id;

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

    public function getOrganizationId(): ?OrganizationAccount
    {
        return $this->Organization_id;
    }

    public function setOrganizationId(OrganizationAccount $Organization_id): static
    {
        $this->Organization_id = $Organization_id;

        return $this;
    }
}
