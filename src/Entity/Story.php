<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $writer;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $Genre;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $type;

    #[ORM\Column(type: 'text')]
    private ?string $content;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $writingDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $dedication;

    #[ORM\Column(type: 'boolean')]
    private ?bool $publish;

    #[ORM\Column(type: 'integer')]
    private ?int $createdBy;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $updatedBy;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $deletedBy;

    #[ORM\Column(type: 'boolean')]
    private ?bool $canUpdateAll;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $writerSpeach;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $deletedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'stories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getWriter(): ?string
    {
        return $this->writer;
    }

    public function setWriter(string $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getWritingDate(): ?DateTimeImmutable
    {
        return $this->writingDate;
    }

    public function setWritingDate(?DateTimeImmutable $writingDate): self
    {
        $this->writingDate = $writingDate;

        return $this;
    }

    public function getDedication(): ?string
    {
        return $this->dedication;
    }

    public function setDedication(?string $dedication): self
    {
        $this->dedication = $dedication;

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getDeletedBy(): ?int
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(int $deletedBy): self
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    public function getCanUpdateAll(): ?bool
    {
        return $this->canUpdateAll;
    }

    public function setCanUpdateAll(bool $canUpdateAll): self
    {
        $this->canUpdateAll = $canUpdateAll;

        return $this;
    }

    public function getWriterSpeach(): ?string
    {
        return $this->writerSpeach;
    }

    public function setWriterSpeach(?string $writerSpeach): self
    {
        $this->writerSpeach = $writerSpeach;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(?User $Author): self
    {
        $this->Author = $Author;

        return $this;
    }
}
