<?php

namespace App\Entity;

use App\Repository\LanguesRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private $comblinguistique;

    /**
     * @ORM\OneToOne(targetEntity=Demandes::class, mappedBy="langue", cascade={"persist", "remove"})
     */
    private $demande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComblinguistique(): ?string
    {
        return $this->comblinguistique;
    }

    public function setComblinguistique(string $comblinguistique): self
    {
        $this->comblinguistique = $comblinguistique;

        return $this;
    }

    public function getDemande(): ?Demandes
    {
        return $this->demande;
    }

    public function setDemande(Demandes $demande): self
    {
        $this->demande = $demande;

        // set the owning side of the relation if necessary
        if ($demande->getLangue() !== $this) {
            $demande->setLangue($this);
        }

        return $this;
    }
}
