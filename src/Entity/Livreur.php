<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur extends User
{

 // #[ORM\Column(length: 255)]
 // private ?string $role = null;
 //   #[ORM\Id]
 //   #[ORM\GeneratedValue]
//    #[ORM\Column]
 //   private ?int $id = null;

    

//    public function getId(): ?int
  //  {
    //    return $this->id;
   // }

 //  public function getRole(): ?string
//{
  //  return $this->role;
//}

//public function setRole(string $role): self
//{
  //  $this->role = $role;

 //   return $this;

//}

   
}
