<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $numbering = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Matter::class)]
    private Collection $matters;

    public function __construct()
    {
        $this->matters = new ArrayCollection();
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

    public function getNumbering(): ?int
    {
        return $this->numbering;
    }

    public function setNumbering(int $numbering): self
    {
        $this->numbering = $numbering;

        return $this;
    }

    /**
     * @return Collection<int, Matter>
     */
    public function getMatters(): Collection
    {
        return $this->matters;
    }

    public function addMatter(Matter $matter): self
    {
        if (!$this->matters->contains($matter)) {
            $this->matters->add($matter);
            $matter->setCategory($this);
        }

        return $this;
    }

    public function removeMatter(Matter $matter): self
    {
        if ($this->matters->removeElement($matter)) {
            // set the owning side to null (unless already changed)
            if ($matter->getCategory() === $this) {
                $matter->setCategory(null);
            }
        }

        return $this;
    }
}
