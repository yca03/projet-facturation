<?php

namespace App\Entity\OffreCommerciale;

use App\Entity\Clients;
use App\Entity\Produit;
use App\Entity\TypeProduit;
use App\Repository\OffreCommerciale\OffreCommercialeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreCommercialeRepository::class)]
class OffreCommerciale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeContrat = null;

    #[ORM\Column(length:255)]
    private ?string $dureeOffre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $dureePeriodeTest = null;

    #[ORM\ManyToOne(inversedBy: 'clientsOffre')]
    private ?Clients $clients = null;

    #[ORM\ManyToOne(inversedBy: 'typeProduits')]
    private ?TypeProduit $typeProduit = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): static
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDureeOffre(): ?string
    {
        return $this->dureeOffre;
    }

    public function setDureeOffre(string $dureeOffre): static
    {
        $this->dureeOffre = $dureeOffre;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDureePeriodeTest(): ?string
    {
        return $this->dureePeriodeTest;
    }

    public function setDureePeriodeTest(string $dureePeriodeTest): static
    {
        $this->dureePeriodeTest = $dureePeriodeTest;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): static
    {
        $this->clients = $clients;

        return $this;
    }

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(?TypeProduit $typeProduit): static
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

}
