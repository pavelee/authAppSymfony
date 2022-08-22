<?php

namespace App\Entity\AdditionalFields;

use App\Entity\Users\User;
use App\Repository\AdditionalFields\TestingSystemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestingSystemRepository::class)]
class TestingSystem extends System
{
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'testingSystems')]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function addUsers(User ...$users): self
    {
        foreach ($users as $user) {
            if (!$this->users->contains($user)) {
                $this->users->add($user);
            }
        }
    }
}
