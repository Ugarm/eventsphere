<?php

namespace App\Entity;

use App\Repository\MeetupFeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetupFeedbackRepository::class)]
class MeetupFeedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $feedback_text = null;

    #[ORM\Column]
    private ?float $feedback_note = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Meetup $meetup_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeedbackText(): ?string
    {
        return $this->feedback_text;
    }

    public function setFeedbackText(string $feedback_text): static
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMeetupId(): ?Meetup
    {
        return $this->meetup_id;
    }

    public function setMeetupId(?Meetup $meetup_id): static
    {
        $this->meetup_id = $meetup_id;

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
