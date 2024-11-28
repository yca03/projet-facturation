<?php

namespace App\Entity;

use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Repository\DetailFactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailFactureRepository::class)]
class DetailFacture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $montantTTC = null;

    #[ORM\Column(length: 255)]
    private ?string $montantHT = null;

    #[ORM\Column(length: 255)]
    private ?string $montantTVA = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remise = null;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'detailFactures')]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(targetEntity: Facture::class, inversedBy: 'detailFactures')]
    private ?Facture $facture = null;

    #[ORM\ManyToOne(targetEntity: FactureProFormat::class, inversedBy: 'detailFactures')]
    private ?FactureProFormat $factureProformat = null;

    #[ORM\Column(length: 255)]
    private ?string $montantBrut = null;

    #[ORM\ManyToOne(inversedBy: 'offreCommerciale')]
    private ?OffreCommerciale $offreCommerciale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function getMontantTTC(): ?string
    {
        return $this->montantTTC;
    }

    public function setMontantTTC(string $montantTTC): static
    {
        $this->montantTTC = $montantTTC;
        return $this;
    }

    public function getMontantHT(): ?string
    {
        return $this->montantHT;
    }

    public function setMontantHT(string $montantHT): static
    {
        $this->montantHT = $montantHT;
        return $this;
    }

    public function getMontantTVA(): ?string
    {
        return $this->montantTVA;
    }

    public function setMontantTVA(string $montantTVA): static
    {
        $this->montantTVA = $montantTVA;
        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): static
    {
        $this->remise = $remise;
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

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): static
    {
        $this->facture = $facture;
        return $this;
    }

    public function getFactureProformat(): ?FactureProFormat
    {
        return $this->factureProformat;
    }

    public function setFactureProformat(?FactureProFormat $factureProformat): static
    {
        $this->factureProformat = $factureProformat;
        return $this;
    }

    public function getMontantBrut(): ?string
    {
        return $this->montantBrut;
    }

    public function setMontantBrut(string $montantBrut): static
    {
        $this->montantBrut = $montantBrut;
        return $this;
    }

    public function getOffreCommerciale(): ?OffreCommerciale
    {
        return $this->offreCommerciale;
    }

    public function setOffreCommerciale(?OffreCommerciale $offreCommerciale): static
    {
        $this->offreCommerciale = $offreCommerciale;

        return $this;
    }
}
