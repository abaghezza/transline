<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilesRepository::class)
 */
class Files
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Demandes::class, inversedBy="file")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemande(): ?Demandes
    {
        return $this->demande;
    }

    public function setDemande(?Demandes $demande): self
    {
        $this->demande = $demande;

        return $this;
    }
}
