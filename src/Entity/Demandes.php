<?php

namespace App\Entity;

use App\Repository\DemandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandesRepository::class)
 */
class Demandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

/**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="demandes")
     */
    private $user;
	
    /**
     * @ORM\OneToMany(targetEntity=Files::class, mappedBy="demandes")
	 * @ORM\JoinColumn(nullable=false)
     */
    private $file;



    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

/**
     * @ORM\Column(type="text", nullable=false)
     */
    private $label;
	
	/**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mail;
	


    /**
     * @ORM\Column(type="string", length=60)
     */
    private $status = "initialisée";

    /**
     * @ORM\ManyToOne(targetEntity=Langues::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $langue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montant;

    

    public function __construct()
    {
		
        $this->file = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Files[]
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    public function addFile(Files $file): self
    {
        if (!$this->file->contains($file)) {
            $this->file[] = $file;
            $file->setDemande($this);
        }

        return $this;
    }

    public function removeFile(Files $file): self
    {
        if ($this->file->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getDemande() === $this) {
                $file->setDemande(null);
            }
        }

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }
		
	public function getMail(): ?string
                                              {
                                                  return $this->mail;
                                              }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
	
	

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getLangue(): ?Langues
    {
        return $this->langue;
    }

    public function setLangue(?Langues $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

public function __toString(): string
    {
        return $this->getLabel();
    }

public function getUpdatedAt(): ?\DateTimeInterface
{
    return $this->updatedAt;
}

public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
{
    $this->updatedAt = $updatedAt;

    return $this;
}

public function getMontant(): ?float
{
    return $this->montant;
}

public function setMontant(?float $montant): self
{
    $this->montant = $montant;

    return $this;
}
}
