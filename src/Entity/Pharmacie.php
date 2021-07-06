<?php

namespace App\Entity;

use App\Repository\PharmacieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PharmacieRepository::class)
 */
class Pharmacie
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
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="pharmacies")
     */
    private $Clients;

    /**
     * @ORM\ManyToMany(targetEntity=Medicaments::class, inversedBy="pharmacies")
     */
    private $Medicaments;

    /**
     * @ORM\ManyToMany(targetEntity=Fornisseur::class, inversedBy="pharmacies")
     */
    private $Fornisseur;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="pharmacies")
     */
    private $Commandes;

    public function __construct()
    {
        $this->Clients = new ArrayCollection();
        $this->Medicaments = new ArrayCollection();
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->Clients;
    }

    public function addClient(Client $Client): self
    {
        if (!$this->Clients->contains($Client)) {
            $this->Clients[] = $Client;
        }

        return $this;
    }

    public function removeClient(Client $Client): self
    {
        $this->Clients->removeElement($Client);

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
        }

        return $this;
    }

    public function removeMedicament(Medicaments $medicament): self
    {
        $this->Medicaments->removeElement($medicament);

        return $this;
    }

    public function getFornisseur(): ?Fornisseur
    {
        return $this->Fornisseur;
    }

    public function setFornisseur(?Fornisseur $Fornisseur): self
    {
        $this->Fornisseur = $Fornisseur;

        return $this;
    }

    public function getCommandes(): ?Commande
    {
        return $this->Commandes;
    }

    public function setCommandes(?Commande $Commandes): self
    {
        $this->Commandes = $Commandes;

        return $this;
    }
}
