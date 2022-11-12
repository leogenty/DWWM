<?php

namespace App\Entity;

use App\Repository\ResetPasswordRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResetPasswordRepository::class)]
class ResetPassword
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $old_password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $new_password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldPassword(): ?string
    {
        return $this->old_password;
    }

    public function setOldPassword(?string $old_password): self
    {
        $this->old_password = $old_password;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->new_password;
    }

    public function setNewPassword(?string $new_password): self
    {
        $this->new_password = $new_password;

        return $this;
    }
}
