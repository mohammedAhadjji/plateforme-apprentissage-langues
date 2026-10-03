<?php

namespace App\Entity;

use App\Repository\TranscriptLineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranscriptLineRepository::class)]
class TranscriptLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $timestampStart = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $timestampEnd = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $textDE = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $textFR = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $textAR = null;

    #[ORM\ManyToOne(inversedBy: 'transcriptLines')]
    private ?Lesson $lesson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestampStart(): ?\DateTime
    {
        return $this->timestampStart;
    }

    public function setTimestampStart(?\DateTime $timestampStart): static
    {
        $this->timestampStart = $timestampStart;

        return $this;
    }

    public function getTimestampEnd(): ?\DateTime
    {
        return $this->timestampEnd;
    }

    public function setTimestampEnd(?\DateTime $timestampEnd): static
    {
        $this->timestampEnd = $timestampEnd;

        return $this;
    }

    public function getTextDE(): ?string
    {
        return $this->textDE;
    }

    public function setTextDE(?string $textDE): static
    {
        $this->textDE = $textDE;

        return $this;
    }

    public function getTextFR(): ?string
    {
        return $this->textFR;
    }

    public function setTextFR(?string $textFR): static
    {
        $this->textFR = $textFR;

        return $this;
    }

    public function getTextAR(): ?string
    {
        return $this->textAR;
    }

    public function setTextAR(?string $textAR): static
    {
        $this->textAR = $textAR;

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
}
