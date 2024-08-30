<?php

namespace App\Entity;

use App\Entity\Encaissement\Encaissement;
use App\Repository\ModePayementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModePayementRepository::class)]
class ModePayement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'modePayement')]
    private Collection $factures;

    #[ORM\ManyToOne(inversedBy: 'modePayement')]
    private ?FactureProFormat $factureProFormat = null;

    /**
     * @var Collection<int, FactureProFormat>
     */
    #[ORM\OneToMany(targetEntity: FactureProFormat::class, mappedBy: 'modePayement')]
    private Collection $factureProFormats;

    /**
     * @var Collection<int, Encaissement>
     */
    #[ORM\OneToMany(targetEntity: Encaissement::class, mappedBy: 'modePayement')]
    private Collection $encaissements;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
        $this->factureProFormats = new ArrayCollection();
        $this->encaissements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): static
    {
        if (!$this->factures->contains($facture)) {
            $this->factures->add($facture);
            $facture->setModePayement($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getModePayement() === $this) {
                $facture->setModePayement(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getFactureProFormat(): ?FactureProFormat
    {
        return $this->factureProFormat;
    }

    public function setFactureProFormat(?FactureProFormat $factureProFormat): static
    {
        $this->factureProFormat = $factureProFormat;

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
            $factureProFormat->setModePayement($this);
        }

        return $this;
    }

    public function removeFactureProFormat(FactureProFormat $factureProFormat): static
    {
        if ($this->factureProFormats->removeElement($factureProFormat)) {
            // set the owning side to null (unless already changed)
            if ($factureProFormat->getModePayement() === $this) {
                $factureProFormat->setModePayement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Encaissement>
     */
    public function getEncaissements(): Collection
    {
        return $this->encaissements;
    }

    public function addEncaissement(Encaissement $encaissement): static
    {
        if (!$this->encaissements->contains($encaissement)) {
            $this->encaissements->add($encaissement);
            $encaissement->setModePayement($this);
        }

        return $this;
    }

    public function removeEncaissement(Encaissement $encaissement): static
    {
        if ($this->encaissements->removeElement($encaissement)) {
            // set the owning side to null (unless already changed)
            if ($encaissement->getModePayement() === $this) {
                $encaissement->setModePayement(null);
            }
        }

        return $this;
    }
}
