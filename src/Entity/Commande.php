<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $mat;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="Commandes")
     */
    private $idClient;

    /**
     * @ORM\ManyToMany(targetEntity=Medicaments::class, inversedBy="Commandes")
     */
    private $idMedic;

    /**
     * @ORM\OneToMany(targetEntity=Pharmacie::class, mappedBy="Commandes")
     */
    private $pharmacies;

    public function __construct()
    {
        $this->idMedic = new ArrayCollection();
        $this->pharmacies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMat(): ?string
    {
        return $this->mat;
    }

    public function setMat(string $mat): self
    {
        $this->mat = $mat;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * @return Collection|Medicaments[]
     */
    public function getIdMedic(): Collection
    {
        return $this->idMedic;
    }

    public function addIdMedic(Medicaments $idMedic): self
    {
        if (!$this->idMedic->contains($idMedic)) {
            $this->idMedic[] = $idMedic;
        }

        return $this;
    }

    public function removeIdMedic(Medicaments $idMedic): self
    {
        $this->idMedic->removeElement($idMedic);

        return $this;
    }

    /**
     * @return Collection|Pharmacie[]
     */
    public function getPharmacies(): Collection
    {
        return $this->pharmacies;
    }

    public function addPharmacy(Pharmacie $pharmacy): self
    {
        if (!$this->pharmacies->contains($pharmacy)) {
            $this->pharmacies[] = $pharmacy;
            $pharmacy->setCommandes($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->removeElement($pharmacy)) {
            // set the owning side to null (unless already changed)
            if ($pharmacy->getCommandes() === $this) {
                $pharmacy->setCommandes(null);
            }
        }

        return $this;
    }
}
