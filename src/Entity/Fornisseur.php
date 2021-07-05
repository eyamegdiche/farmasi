<?php

namespace App\Entity;

use App\Repository\FornisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FornisseurRepository::class)
 */
class Fornisseur
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\ManyToMany(targetEntity=medicaments::class, inversedBy="fornisseurs")
     */
    private $idMedi;

    /**
     * @ORM\OneToMany(targetEntity=Pharmacie::class, mappedBy="Fornisseur")
     */
    private $pharmacies;

    public function __construct()
    {
        $this->idMedi = new ArrayCollection();
        $this->pharmacies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|medicaments[]
     */
    public function getIdMedi(): Collection
    {
        return $this->idMedi;
    }

    public function addIdMedi(medicaments $idMedi): self
    {
        if (!$this->idMedi->contains($idMedi)) {
            $this->idMedi[] = $idMedi;
        }

        return $this;
    }

    public function removeIdMedi(medicaments $idMedi): self
    {
        $this->idMedi->removeElement($idMedi);

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
            $pharmacy->setFornisseur($this);
        }

        return $this;
    }

    public function removePharmacy(Pharmacie $pharmacy): self
    {
        if ($this->pharmacies->removeElement($pharmacy)) {
            // set the owning side to null (unless already changed)
            if ($pharmacy->getFornisseur() === $this) {
                $pharmacy->setFornisseur(null);
            }
        }

        return $this;
    }
}
