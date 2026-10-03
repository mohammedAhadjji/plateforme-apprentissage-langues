<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $videoTimestamp = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contentText = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?Lesson $lesson = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?User $noter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoTimestamp(): ?int
    {
        return $this->videoTimestamp;
    }

    public function setVideoTimestamp(?int $videoTimestamp): static
    {
        $this->videoTimestamp = $videoTimestamp;

        return $this;
    }

    public function getContentText(): ?string
    {
        return $this->contentText;
    }

    public function setContentText(?string $contentText): static
    {
        $this->contentText = $contentText;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): static
    {
        $this->lesson = $lesson;

        return $this;
    }

    public function getNoter(): ?User
    {
        return $this->noter;
    }

    public function setNoter(?User $noter): static
    {
        $this->noter = $noter;

        return $this;
    }
}
