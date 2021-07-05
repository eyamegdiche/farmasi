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
     * @ORM\ManyToOne(targetEntity=Classification::class, inversedBy="medicaments")
     */
    private $classification;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="idMedic")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity=Fornisseur::class, mappedBy="idMedi")
     */
    private $fornisseurs;

    /**
     * @ORM\ManyToMany(targetEntity=Pharmacie::class, mappedBy="medicaments")
     */
    private $pharmacies;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->fornisseurs = new ArrayCollection();
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
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addIdMedic($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeIdMedic($this);
        }

        return $this;
    }

    /**
     * @return Collection|Fornisseur[]
     */
    public function getFornisseurs(): Collection
    {
        return $this->fornisseurs;
    }

    public function addFornisseur(Fornisseur $fornisseur): self
    {
        if (!$this->fornisseurs->contains($fornisseur)) {
            $this->fornisseurs[] = $fornisseur;
            $fornisseur->addIdMedi($this);
        }

        return $this;
    }

    public function removeFornisseur(Fornisseur $fornisseur): self
    {
        if ($this->fornisseurs->removeElement($fornisseur)) {
            $fornisseur->removeIdMedi($this);
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
