<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numbatiment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_chambre;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="numch")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumch(): ?string
    {
        return $this->numch;
    }

    public function setNumch(string $numch): self
    {
        $this->numch = $numch;

        return $this;
    }

    public function getNumbatiment(): ?string
    {
        return $this->numbatiment;
    }

    public function setNumbatiment(string $numbatiment): self
    {
        $this->numbatiment = $numbatiment;

        return $this;
    }

    public function getTypeChambre(): ?string
    {
        return $this->type_chambre;
    }

    public function setTypeChambre(string $type_chambre): self
    {
        $this->type_chambre = $type_chambre;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setNumch($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getNumch() === $this) {
                $etudiant->setNumch(null);
            }
        }

        return $this;
    }
}
