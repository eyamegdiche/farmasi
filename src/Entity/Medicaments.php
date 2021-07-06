<?php

namespace App\Entity;

use App\Repository\MedicamentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicamentsRepository::class)
 */
class Medicaments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $pa;

    /**
     * @ORM\Column(type="float")
     */
    private $pv;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\ManyToOne(targetEntity=Classification::class, inversedBy="Medicaments")
     */
    private $classification;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="idMedic")
     */
    private $Commandes;

    /**
     * @ORM\ManyToMany(targetEntity=Fornisseur::class, mappedBy="idMedi")
     */
    private $Fornisseurs;

    /**
     * @ORM\ManyToMany(targetEntity=Pharmacie::class, mappedBy="Medicaments")
     */
    private $pharmacies;

    public function __construct()
    {
        $this->Commandes = new ArrayCollection();
        $this->Fornisseurs = new ArrayCollection();
        $this->pharmacies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPa(): ?float
    {
        return $this->pa;
    }

    public function setPa(float $pa): self
    {
        $this->pa = $pa;

        return $this;
    }

    public function getPv(): ?float
    {
        return $this->pv;
    }

    public function setPv(float $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getClassification(): ?Classification
    {
        return $this->classification;
    }

    public function setClassification(?Classification $classification): self
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->Commandes;
    }

    public function addCommande(Commande $Commande): self
    {
        if (!$this->Commandes->contains($Commande)) {
            $this->Commandes[] = $Commande;
            $Commande->addIdMedic($this);
        }

        return $this;
    }

    public function removeCommande(Commande $Commande): self
    {
        if ($this->Commandes->removeElement($Commande)) {
            $Commande->removeIdMedic($this);
        }

        return $this;
    }

    /**
     * @return Collection|Fornisseur[]
     */
    public function getFornisseurs(): Collection
    {
        return $this->Fornisseurs;
    }

    public function addFornisseur(Fornisseur $Fornisseur): self
    {
        if (!$this->Fornisseurs->contains($Fornisseur)) {
            $this->Fornisseurs[] = $Fornisseur;
            $Fornisseur->addIdMedi($this);
        }

        return $this;
    }

    public function removeFornisseur(Fornisseur $Fornisseur): self
    {
        if ($this->Fornisseurs->removeElement($Fornisseur)) {
            $Fornisseur->removeIdMedi($this);
        }

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
            $pharmacy->addMedicament($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->removeElement($pharmacy)) {
            $pharmacy->removeMedicament($this);
        }

        return $this;
    }
}
