<?php

namespace App\Entity;

use App\Repository\CourrierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourrierRepository::class)]
class Courrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deliveryDate = null;

   

    //#[ORM\Column(length: 255)]
    //private ?string $deliveryMan = null;

    #[ORM\Column(length: 255)]
    private ?string $deliverySituation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $barcode = null;

    #[ORM\ManyToOne(inversedBy: 'courriersDept')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $startingPost = null;

    #[ORM\ManyToOne(inversedBy: 'courriersDest')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $arrivalPost = null;

   
   #[ORM\ManyToOne(inversedBy: 'courriers')]
   #[ORM\JoinColumn(nullable: false)]
   private ?Livreur $deliveryMan = null;

   #[ORM\Column(length: 255)]
   private ?string $postalSituation = null;

   #[ORM\Column(length: 255)]
   private ?string $typecourrier = null;

   #[ORM\OneToMany(mappedBy: 'courrier', targetEntity: Historique::class)]
   private Collection $historiques;

   #[ORM\Column]
   private ?bool $isDeleted = null;

   public function __construct()
   {
       $this->historiques = new ArrayCollection();
   }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

 

    public function getDeliverySituation(): ?string
    {
        return $this->deliverySituation;
    }

    public function setDeliverySituation(string $deliverySituation): self
    {
        $this->deliverySituation = $deliverySituation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getStartingPost(): ?Post
    {
        return $this->startingPost;
    }

    public function setStartingPost(?Post $startingPost): self
    {
        $this->startingPost = $startingPost;

        return $this;
    }

    public function getArrivalPost(): ?Post
    {
        return $this->arrivalPost;
    }

    public function setArrivalPost(?Post $arrivalPost): self
    {
        $this->arrivalPost = $arrivalPost;

        return $this;
    }

    public function getDeliveryMan(): ?User
    {
        return $this->deliveryMan;
    }

    public function setDeliveryMan(?User $deliveryMan): self
    {
        $this->deliveryMan = $deliveryMan;

        return $this;
    }



public function getPostalSituation(): ?string
{
    return $this->postalSituation;
}

public function setPostalSituation(string $postalSituation): self
{
    $this->postalSituation = $postalSituation;

    return $this;
}



public function getTypecourrier(): ?string
{
    return $this->typecourrier;
}

public function setTypecourrier(string $typecourrier): self
{
    $this->typecourrier = $typecourrier;

    return $this;
}

/**
 * @return Collection<int, Historique>
 */
public function getHistoriques(): Collection
{
    return $this->historiques;
}

public function addHistorique(Historique $historique): self
{
    if (!$this->historiques->contains($historique)) {
        $this->historiques->add($historique);
        $historique->setCourrier($this);
    }

    return $this;
}

public function removeHistorique(Historique $historique): self
{
    if ($this->historiques->removeElement($historique)) {
        // set the owning side to null (unless already changed)
        if ($historique->getCourrier() === $this) {
            $historique->setCourrier(null);
        }
    }

    return $this;
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
}
