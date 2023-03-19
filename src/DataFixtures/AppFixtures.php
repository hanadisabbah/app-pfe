<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $this->loadAdmin($manager);
        $this->loadAgents($manager);
        $this->loadLivreurs($manager);
        $manager->flush();
    }

    public function loadAdmin(ObjectManager $manager){
        $admin = new User;
        $admin->setEmail('admin@courriers.tn');
        $admin->setFirstName('admin');
        $admin->setLastName('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword(
            $admin,
            'secret123'
        ));
        $manager->persist($admin);
        
    }

    public function loadAgents(ObjectManager $manager){
        for ($i=0; $i < 3 ; $i++) { 
            $admin = new User;
            $admin->setEmail("agent$i@courriers.tn");
            $admin->setFirstName("agent$i");
            $admin->setLastName("agent$i");
            $admin->setRoles(['ROLE_AGENT']);
            $admin->setPassword($this->hasher->hashPassword(
                $admin,
                'secret123'
            ));
            $manager->persist($admin);
        }
    }
    public function loadLivreurs(ObjectManager $manager){
        for ($i=0; $i < 5; $i++) { 
            $admin = new User;
            $admin->setEmail("livreur$i@courriers.tn");
            $admin->setFirstName("livreur$i");
            $admin->setLastName("livreur$i");
            $admin->setRoles(['ROLE_LIVREUR']);
            $admin->setPassword($this->hasher->hashPassword(
                $admin,
                'secret123'
            ));
            $manager->persist($admin);
        }
    }
}
