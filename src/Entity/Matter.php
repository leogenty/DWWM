<?php

namespace App\Entity;

use App\Repository\MatterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatterRepository::class)]
class Matter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'matters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'matter', targetEntity: Type::class)]
    private Collection $types;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'matter', targetEntity: OnlineLesson::class)]
    private Collection $onlineLessons;

    public function __construct()
    {
        $this->types = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
            $chapter->setMatter($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getMatter() === $this) {
                $chapter->setMatter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setMatter($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getMatter() === $this) {
                $type->setMatter(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $onlineLesson->setMatter($this);
        }

        return $this;
    }

    public function removeOnlineLesson(OnlineLesson $onlineLesson): self
    {
        if ($this->onlineLessons->removeElement($onlineLesson)) {
            // set the owning side to null (unless already changed)
            if ($onlineLesson->getMatter() === $this) {
                $onlineLesson->setMatter(null);
            }
        }

        return $this;
    }
}
