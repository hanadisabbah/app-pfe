<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent extends User
{

  #[ORM\ManyToOne(inversedBy: 'agent')]
  private ?Post $post = null;

  //// #[ORM\ManyToOne(inversedBy: 'agent')]
  //     private ?Post $post = null;

  // #[ORM\Column(length: 255)]
  //  private ?string $post = null;


  //#[ORM\Column(length: 255)]
  //private ?string $role = null;

  //    #[ORM\Id]
  //   #[ORM\GeneratedValue]
  //    #[ORM\Column]
  //  private ?int $id = null;



  //  public function getId(): ?int
  //  {
  //      return $this->id;
  //  }


  // public function getPost(): ?string
  //   {
  //       return $this->post;
  //   }

  //   public function setPost(string $post): self
  //    {
  //     $this->post = $post;

  //       return $this;

  //}

  //public function getRole(): ?string
  //{
  //   return $this->role;
  //}

  //public function setRole(string $role): self
  //{
  //   $this->role = $role;

  //   return $this;
  //
  //}

  //public function getPost(): ?Post
  //{
  ////   return $this->post;
  //}

  //public function setPost(?Post $post): self
  //{
  //   $this->post = $post;

  //  return $this;
  //}

  public function getPost(): ?Post
  {
    return $this->post;
  }

  public function setPost(?Post $post): self
  {
    $this->post = $post;

    return $this;
  }
}
