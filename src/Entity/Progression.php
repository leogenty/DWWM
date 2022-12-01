<?php

namespace App\Entity;

use App\Repository\ProgressionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressionRepository::class)]
class Progression
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $complete = null;

    #[ORM\ManyToOne(inversedBy: 'progressions')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'progressions')]
    private ?Chapter $chapter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComplete(): ?int
    {
        return $this->complete;
    }

    public function setComplete(int $complete): self
    {
        $this->complete = $complete;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    public function setChapter(?Chapter $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }
}
