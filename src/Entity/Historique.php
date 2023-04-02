<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Courrier $courrier = null;

    /*#[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

   /* public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }*/

   public function getUtilisateur(): ?User
   {
       return $this->utilisateur;
   }

   public function setUtilisateur(?User $utilisateur): self
   {
       $this->utilisateur = $utilisateur;

       return $this;
   }

   public function getCourrier(): ?Courrier
   {
       return $this->courrier;
   }

   public function setCourrier(?Courrier $courrier): self
   {
       $this->courrier = $courrier;

       return $this;
   }
}
