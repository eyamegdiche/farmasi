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
     * @ORM\ManyToMany(targetEntity=medicaments::class, inversedBy="pharmacies")
     */
    private $medicaments;

    /**
     * @ORM\ManyToMany(targetEntity=fornisseur::class, inversedBy="pharmacies")
     */
    private $Fornisseur;

    /**
     * @ORM\ManyToOne(targetEntity=commande::class, inversedBy="pharmacies")
     */
    private $commandes;

    public function __construct()
    {
        $this->Clients = new ArrayCollection();
        $this->medicaments = new ArrayCollection();
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
     * @return Collection|medicaments[]
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(medicaments $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
        }

        return $this;
    }

    public function removeMedicament(medicaments $medicament): self
    {
        $this->medicaments->removeElement($medicament);

        return $this;
    }

    public function getFornisseur(): ?fornisseur
    {
        return $this->Fornisseur;
    }

    public function setFornisseur(?fornisseur $Fornisseur): self
    {
        $this->Fornisseur = $Fornisseur;

        return $this;
    }

    public function getCommandes(): ?commande
    {
        return $this->commandes;
    }

    public function setCommandes(?commande $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }
}
