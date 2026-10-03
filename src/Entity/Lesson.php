<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $orderIndex = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdfWorksheetUrl = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    private ?Course $course = null;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'lesson')]
    private Collection $video;

    /**
     * @var Collection<int, TranscriptLine>
     */
    #[ORM\OneToMany(targetEntity: TranscriptLine::class, mappedBy: 'lesson')]
    private Collection $transcriptLines;

    /**
     * @var Collection<int, Note>
     */
    #[ORM\OneToMany(targetEntity: Note::class, mappedBy: 'lesson')]
    private Collection $notes;

    public function __construct()
    {
        $this->video = new ArrayCollection();
        $this->transcriptLines = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getOrderIndex(): ?int
    {
        return $this->orderIndex;
    }

    public function setOrderIndex(?int $orderIndex): static
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    public function getPdfWorksheetUrl(): ?string
    {
        return $this->pdfWorksheetUrl;
    }

    public function setPdfWorksheetUrl(?string $pdfWorksheetUrl): static
    {
        $this->pdfWorksheetUrl = $pdfWorksheetUrl;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->video->contains($video)) {
            $this->video->add($video);
            $video->setLesson($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->video->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getLesson() === $this) {
                $video->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TranscriptLine>
     */
    public function getTranscriptLines(): Collection
    {
        return $this->transcriptLines;
    }

    public function addTranscriptLine(TranscriptLine $transcriptLine): static
    {
        if (!$this->transcriptLines->contains($transcriptLine)) {
            $this->transcriptLines->add($transcriptLine);
            $transcriptLine->setLesson($this);
        }

        return $this;
    }

    public function removeTranscriptLine(TranscriptLine $transcriptLine): static
    {
        if ($this->transcriptLines->removeElement($transcriptLine)) {
            // set the owning side to null (unless already changed)
            if ($transcriptLine->getLesson() === $this) {
                $transcriptLine->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setLesson($this);
        }

        return $this;
    }

    public function removeNote(Note $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getLesson() === $this) {
                $note->setLesson(null);
            }
        }

        return $this;
    }
}
