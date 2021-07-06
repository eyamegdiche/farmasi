<?php

namespace App\Entity;

use App\Repository\ClassificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassificationRepository::class)
 */
class Classification
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Medicaments::class, mappedBy="classification")
     */
    private $Medicaments;

    public function __construct()
    {
        $this->Medicaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Medicaments[]
     */
    public function getMedicaments(): Collection
    {
        return $this->Medicaments;
    }

    public function addMedicament(Medicaments $medicament): self
    {
        if (!$this->Medicaments->contains($medicament)) {
            $this->Medicaments[] = $medicament;
            $medicament->setClassification($this);
        }

        return $this;
    }

    public function removeMedicament(Medicaments $medicament): self
    {
        if ($this->Medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getClassification() === $this) {
                $medicament->setClassification(null);
            }
        }

        return $this;
    }
}
