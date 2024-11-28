<?php

namespace App\Entity\OffreCommerciale;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\FactureProFormat;
use App\Entity\Produit;
use App\Entity\TypeProduit;
use App\Repository\OffreCommerciale\OffreCommercialeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var Collection<int, FactureProFormat>
     */
    #[ORM\OneToMany(targetEntity: FactureProFormat::class, mappedBy: 'offreCommerciale')]
    private Collection $factureProFormats;

    /**
     * @var Collection<int, DetailFacture>
     */
    #[ORM\OneToMany(targetEntity: DetailFacture::class, mappedBy: 'offreCommerciale')]
    private Collection $offreCommerciale;


    public function __construct()
    {
        $this->factureProFormats = new ArrayCollection();
        $this->offreCommerciale = new ArrayCollection();
    }

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, FactureProFormat>
     */
    public function getFactureProFormats(): Collection
    {
        return $this->factureProFormats;
    }

    public function addFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if (!$this->factureProFormats->contains($factureProFormat)) {
            $this->factureProFormats->add($factureProFormat);
            $factureProFormat->setOffreCommerciale($this);
        }

        return $this;
    }

    public function removeFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if ($this->factureProFormats->removeElement($factureProFormat)) {
            // set the owning side to null (unless already changed)
            if ($factureProFormat->getOffreCommerciale() === $this) {
                $factureProFormat->setOffreCommerciale(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailFacture>
     */
    public function getOffreCommerciale(): Collection
    {
        return $this->offreCommerciale;
    }

    public function addOffreCommerciale(DetailFacture $offreCommerciale): static
    {
        if (!$this->offreCommerciale->contains($offreCommerciale)) {
            $this->offreCommerciale->add($offreCommerciale);
            $offreCommerciale->setOffreCommerciale($this);
        }

        return $this;
    }

    public function removeOffreCommerciale(DetailFacture $offreCommerciale): static
    {
        if ($this->offreCommerciale->removeElement($offreCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($offreCommerciale->getOffreCommerciale() === $this) {
                $offreCommerciale->setOffreCommerciale(null);
            }
        }

        return $this;
    }




}
