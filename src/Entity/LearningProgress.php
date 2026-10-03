<?php

namespace App\Entity;

use App\Repository\LearningProgressRepository;
use Doctrine\ORM\Mapping as ORM;
use app\enum\CEFRLevel;

#[ORM\Entity(repositoryClass: LearningProgressRepository::class)]
class LearningProgress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $streakDays = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalXP = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $lastActiveDate = null;

    #[ORM\OneToOne(inversedBy: 'learningProgress', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(type: 'string', enumType: CEFRLevel::class)]
    private CEFRLevel $cefrlevel = CEFRLevel::A1;
    public function getCefrlevel(): CEFRLevel
    {
        return $this->cefrlevel;
    }

    public function setCefrlevel(CEFRLevel $cefrlevel): static
    {
        $this->cefrlevel = $cefrlevel;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreakDays(): ?int
    {
        return $this->streakDays;
    }

    public function setStreakDays(?int $streakDays): static
    {
        $this->streakDays = $streakDays;

        return $this;
    }

    public function getTotalXP(): ?int
    {
        return $this->totalXP;
    }

    public function setTotalXP(?int $totalXP): static
    {
        $this->totalXP = $totalXP;

        return $this;
    }

    public function getLastActiveDate(): ?\DateTimeImmutable
    {
        return $this->lastActiveDate;
    }

    public function setLastActiveDate(?\DateTimeImmutable $lastActiveDate): static
    {
        $this->lastActiveDate = $lastActiveDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
