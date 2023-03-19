<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $typePost = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'startingPost', targetEntity: Courrier::class)]
    private Collection $courriersDept;

    #[ORM\OneToMany(mappedBy: 'arrivalPost', targetEntity: Courrier::class)]
    private Collection $courriersDest;

    #[ORM\Column]
    private ?bool $isDeleted = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Agent::class)]
    private Collection $agent;

    public function __construct()
    {
        $this->agent = new ArrayCollection();
    }

  //  #[ORM\OneToMany(mappedBy: 'post', targetEntity: agent::class)]
  //  private Collection $agent;

 //   public function __construct()
 //   {
 //       $this->courriersDept = new ArrayCollection();
 //       $this->courriersDest = new ArrayCollection();
 //       $this->agent = new ArrayCollection();
 //   }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getTypePost(): ?string
    {
        return $this->typePost;
    }

    public function setTypePost(string $typePost): self
    {
        $this->typePost = $typePost;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Courrier>
     */
    public function getCourriersDept(): Collection
    {
        return $this->courriersDept;
    }

    public function addCourriersDept(Courrier $courriersDept): self
    {
        if (!$this->courriersDept->contains($courriersDept)) {
            $this->courriersDept->add($courriersDept);
            $courriersDept->setStartingPost($this);
        }

        return $this;
    }

    public function removeCourriersDept(Courrier $courriersDept): self
    {
        if ($this->courriersDept->removeElement($courriersDept)) {
            // set the owning side to null (unless already changed)
            if ($courriersDept->getStartingPost() === $this) {
                $courriersDept->setStartingPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Courrier>
     */
    public function getCourriersDest(): Collection
    {
        return $this->courriersDest;
    }

    public function addCourriersDest(Courrier $courriersDest): self
    {
        if (!$this->courriersDest->contains($courriersDest)) {
            $this->courriersDest->add($courriersDest);
            $courriersDest->setArrivalPost($this);
        }

        return $this;
    }

    public function removeCourriersDest(Courrier $courriersDest): self
    {
        if ($this->courriersDest->removeElement($courriersDest)) {
            // set the owning side to null (unless already changed)
            if ($courriersDest->getArrivalPost() === $this) {
                $courriersDest->setArrivalPost(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return Collection<int, agent>
     */
  //  public function getAgent(): Collection
  //  {
 //       return $this->agent;
 //   }

 //   public function addAgent(agent $agent): self
 //   {
 //       if (!$this->agent->contains($agent)) {
 //           $this->agent->add($agent);
 //           $agent->setPost($this);
//        }

 //       return $this;
 //   }

 //   public function removeAgent(agent $agent): self
 //   {
  //      if ($this->agent->removeElement($agent)) {
            // set the owning side to null (unless already changed)
   //         if ($agent->getPost() === $this) {
   //             $agent->setPost(null);
  //          }
  //      }

   //     return $this;
   // }

   /**
    * @return Collection<int, Agent>
    */
   public function getAgent(): Collection
   {
       return $this->agent;
   }

   public function addAgent(Agent $agent): self
   {
       if (!$this->agent->contains($agent)) {
           $this->agent->add($agent);
           $agent->setPost($this);
       }

       return $this;
   }

   public function removeAgent(Agent $agent): self
   {
       if ($this->agent->removeElement($agent)) {
           // set the owning side to null (unless already changed)
           if ($agent->getPost() === $this) {
               $agent->setPost(null);
           }
       }

       return $this;
   }
}
