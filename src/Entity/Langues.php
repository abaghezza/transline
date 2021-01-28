<?php

namespace App\Entity;

use App\Repository\LanguesRepository;
use App\Repository\DemandesRepository;
use App\Entity\Demandes;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=LanguesRepository::class)
 */
class Langues
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $combination;

    

    


	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCombination(): ?string
    {
        return $this->combination;
    }

    public function setCombination(string $combination): self
    {
        $this->combination = $combination;

        return $this;
    }

    

}