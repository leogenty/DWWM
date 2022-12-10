<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: OnlineLesson::class, mappedBy: 'language')]
    private Collection $onlineLessons;

    public function __construct()
    {
        $this->onlineLessons = new ArrayCollection();
    }

    // add this function manually to render string in Admin Dashboard
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, OnlineLesson>
     */
    public function getOnlineLessons(): Collection
    {
        return $this->onlineLessons;
    }

    public function addOnlineLesson(OnlineLesson $onlineLesson): self
    {
        if (!$this->onlineLessons->contains($onlineLesson)) {
            $this->onlineLessons->add($onlineLesson);
            $onlineLesson->addLanguage($this);
        }

        return $this;
    }

    public function removeOnlineLesson(OnlineLesson $onlineLesson): self
    {
        if ($this->onlineLessons->removeElement($onlineLesson)) {
            $onlineLesson->removeLanguage($this);
        }

        return $this;
    }
}
