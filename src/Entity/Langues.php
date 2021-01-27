<?php

namespace App\Entity;

use App\Repository\LanguesRepository;
use Doctrine\ORM\Mapping as ORM;
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

    /**
     * @ORM\OneToMany(targetEntity=Demandes::class, mappedBy="langue", cascade={"persist", "remove"})
     */
    private $demande;

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
/*getDemande function
    * @return Collection|Demandes[]
     */
	 
    public function getDemande(): Collection
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
